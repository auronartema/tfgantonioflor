<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión.</p>";
    exit;
}

if ($_SESSION['usuario_rol'] !== 'administrador' && $_SESSION['usuario_rol'] !== 'redactor') {
    echo "<p>No tienes permisos para crear o editar artículos.</p>";
    exit;
}

require 'db.php';

// Traer subcategorías de la DB
$stmtSub = $conexion->query("SELECT * FROM subcategorias ORDER BY nombre");
$subcategorias = $stmtSub->fetchAll(PDO::FETCH_ASSOC);

// Variables para edición
$editar = isset($_GET['editar']);
$articulo = [
    'titulo' => '',
    'introduccion' => '',
    'contenido' => '',
    'tipo' => 'articulo',
    'valoracion' => 5,
    'imagen' => '',
    'subcategorias' => []
];

if ($editar) {
    $id_editar = $_GET['editar'];
    $stmtArt = $conexion->prepare("SELECT * FROM articulos WHERE id=:id");
    $stmtArt->execute([':id'=>$id_editar]);
    $articuloDB = $stmtArt->fetch(PDO::FETCH_ASSOC);

    if (!$articuloDB) {
        echo "<p>Artículo no encontrado.</p>";
        exit;
    }

    if ($articuloDB['autor'] !== $_SESSION['usuario_nombre'] && $_SESSION['usuario_rol'] !== 'administrador') {
        echo "<p>No tienes permiso para editar este artículo.</p>";
        exit;
    }

    $articulo = $articuloDB;

    // Subcategorías actuales
    $stmtSubSel = $conexion->prepare("SELECT id_subcategoria FROM articulo_subcategoria WHERE id_articulo=:id");
    $stmtSubSel->execute([':id'=>$id_editar]);
    $articulo['subcategorias'] = $stmtSubSel->fetchAll(PDO::FETCH_COLUMN);
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $introduccion = $_POST['introduccion'];
    $contenido = $_POST['contenido']; // contenido HTML desde Quill
    $autor = $_SESSION['usuario_nombre'];
    $tipo = $_POST['tipo'];
    $valoracion = ($tipo === 'articulo') ? $_POST['valoracion'] : NULL;

    // Subida de imagen
    $imagen = $articulo['imagen'];
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombreTmp = $_FILES['imagen']['tmp_name'];
        $nombreArchivo = basename($_FILES['imagen']['name']);
        $destino = "imagenes/" . $nombreArchivo;
        if (!file_exists('imagenes')) mkdir('imagenes', 0777, true);
        if (move_uploaded_file($nombreTmp, $destino)) $imagen = $destino;
        else echo "<p>Error al subir la imagen.</p>";
    }

    if ($editar) {
        // Actualizar artículo
        $stmtUpd = $conexion->prepare("
            UPDATE articulos SET 
                titulo=:titulo, introduccion=:introduccion, contenido=:contenido,
                tipo=:tipo, valoracion=:valoracion, imagen=:imagen 
            WHERE id=:id
        ");
        $stmtUpd->execute([
            ':titulo' => $titulo,
            ':introduccion' => $introduccion,
            ':contenido' => $contenido,
            ':tipo' => $tipo,
            ':valoracion' => $valoracion,
            ':imagen' => $imagen,
            ':id' => $id_editar
        ]);

        // Actualizar subcategorías
        $stmtDelSub = $conexion->prepare("DELETE FROM articulo_subcategoria WHERE id_articulo=:id");
        $stmtDelSub->execute([':id'=>$id_editar]);

        if(isset($_POST['subcategorias']) && is_array($_POST['subcategorias'])) {
            $stmtInsSub = $conexion->prepare("INSERT INTO articulo_subcategoria (id_articulo,id_subcategoria) VALUES (:id_articulo,:id_subcategoria)");
            foreach($_POST['subcategorias'] as $sub_id){
                $stmtInsSub->execute([':id_articulo'=>$id_editar, ':id_subcategoria'=>$sub_id]);
            }
        }

        $mensaje = "Artículo actualizado correctamente.";
    } else {
        // Insertar nuevo artículo
        $stmt = $conexion->prepare("
            INSERT INTO articulos (titulo, introduccion, contenido, autor, valoracion, fecha_publicacion, imagen, tipo) 
            VALUES (:titulo, :introduccion, :contenido, :autor, :valoracion, NOW(), :imagen, :tipo)
        ");
        $stmt->execute([
            ':titulo' => $titulo,
            ':introduccion' => $introduccion,
            ':contenido' => $contenido,
            ':autor' => $autor,
            ':valoracion' => $valoracion,
            ':imagen' => $imagen,
            ':tipo' => $tipo
        ]);

        $articulo_id = $conexion->lastInsertId();
        if(isset($_POST['subcategorias']) && is_array($_POST['subcategorias'])) {
            $stmtInsSub = $conexion->prepare("INSERT INTO articulo_subcategoria (id_articulo,id_subcategoria) VALUES (:id_articulo,:id_subcategoria)");
            foreach($_POST['subcategorias'] as $sub_id){
                $stmtInsSub->execute([':id_articulo'=>$articulo_id, ':id_subcategoria'=>$sub_id]);
            }
        }

        $mensaje = "Artículo creado correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?php echo $editar ? "Editar artículo" : "Crear artículo"; ?></title>
<link rel="stylesheet" href="estilos.css">
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
</head>
<body>

<!-- HEADER CONSISTENTE -->
<header class="cabecera">
    <div class="logo">
        <img src="logo.png" alt="Logo del proyecto">
        <h1>Mi Medio Digital</h1>
    </div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<h1><?php echo $editar ? "Editar artículo" : "Crear artículo"; ?></h1>

<?php if(!empty($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <label>Título:</label><br>
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($articulo['titulo']); ?>" required><br><br>

    <label>Miniintroducción:</label><br>
    <textarea name="introduccion" rows="3" cols="50" required><?php echo htmlspecialchars($articulo['introduccion']); ?></textarea><br><br>

    <label>Contenido completo:</label><br>
    <div id="editor" style="height: 300px;"><?php echo $articulo['contenido']; ?></div>
    <input type="hidden" name="contenido" id="contenido_input"><br><br>

    <label>Tipo:</label><br>
    <select name="tipo" id="tipo" required onchange="mostrarValoracion()">
        <option value="articulo" <?php if($articulo['tipo']==='articulo') echo 'selected'; ?>>Artículo</option>
        <option value="noticia" <?php if($articulo['tipo']==='noticia') echo 'selected'; ?>>Noticia</option>
    </select><br><br>

    <div id="div-valoracion">
        <label>Valoración del redactor (1-10):</label><br>
        <input type="number" name="valoracion" min="1" max="10" value="<?php echo htmlspecialchars($articulo['valoracion']); ?>"><br><br>
    </div>

    <label>Plataforma(s) (subcategorías):</label><br>
    <select name="subcategorias[]" multiple size="6" required>
        <?php foreach($subcategorias as $sub): ?>
            <option value="<?php echo $sub['id']; ?>" <?php if(in_array($sub['id'],$articulo['subcategorias'])) echo 'selected'; ?>>
                <?php echo htmlspecialchars($sub['nombre']); ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>
    <small>Para seleccionar varias, mantén Ctrl o Cmd.</small><br><br>

    <label>Imagen destacada:</label><br>
    <?php if(!empty($articulo['imagen'])): ?>
        <img src="<?php echo htmlspecialchars($articulo['imagen']); ?>" style="max-width:200px;"><br>
    <?php endif; ?>
    <input type="file" name="imagen" accept="image/*"><br><br>

    <input type="submit" value="<?php echo $editar ? "Actualizar artículo" : "Crear artículo"; ?>">
</form>

<script>
var quill = new Quill('#editor', {
  theme: 'snow',
  modules: {
    toolbar: [
      [{ 'header': [1, 2, 3, false] }],
      ['bold', 'italic', 'underline', 'strike'],
      ['link', 'blockquote', 'code-block'],
      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
      [{ 'color': [] }, { 'background': [] }],
      ['clean']
    ]
  }
});

document.querySelector('form').onsubmit = function() {
  document.getElementById('contenido_input').value = quill.root.innerHTML;
};

function mostrarValoracion() {
    const tipo = document.getElementById('tipo').value;
    const divVal = document.getElementById('div-valoracion');
    divVal.style.display = (tipo === 'articulo') ? 'block' : 'none';
}
mostrarValoracion();
</script>

</body>
</html>
