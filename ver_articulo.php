<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver los artículos.</p>";
    exit;
}

require 'db.php';

if (!isset($_GET['id'])) {
    echo "<p>No se especificó ningún artículo.</p>";
    exit;
}

$id = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM articulos WHERE id=:id");
$stmt->execute([':id'=>$id]);
$articulo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$articulo) {
    echo "<p>Artículo no encontrado.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?php echo htmlspecialchars($articulo['titulo']); ?></title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="cabecera">
    <div class="logo">
        <img src="logo.png" alt="Logo del proyecto" />
        <h1>Mi Medio Digital</h1>
    </div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<div class="articulo">

<?php if (!empty($articulo['imagen'])): ?>
    <img src="<?php echo htmlspecialchars($articulo['imagen']); ?>" class="imagen-articulo" alt="Imagen del artículo">
<?php endif; ?>

<?php if($articulo['tipo'] === 'articulo'): ?>
    <span class='etiqueta etiqueta-articulo'>Artículo</span>
<?php elseif($articulo['tipo'] === 'noticia'): ?>
    <span class='etiqueta etiqueta-noticia'>Noticia</span>
<?php endif; ?>

<?php
$stmtSub = $conexion->prepare("
    SELECT s.nombre 
    FROM subcategorias s
    JOIN articulo_subcategoria asub ON s.id = asub.id_subcategoria
    WHERE asub.id_articulo=:id
");
$stmtSub->execute([':id'=>$articulo['id']]);
$subcats = $stmtSub->fetchAll(PDO::FETCH_COLUMN);

if($subcats){
    echo "<p class='subcategorias'>";
    foreach($subcats as $subcat){
        $claseSegura = str_replace(' ','-',$subcat);
        echo "<span class='sub-".htmlspecialchars($claseSegura)."'>".htmlspecialchars($subcat)."</span> ";
    }
    echo "</p>";
}
?>

<h1><?php echo htmlspecialchars($articulo['titulo']); ?></h1>

<p class='autor_fecha'>
    <em>Autor: 
        <a href='articulos_por_autor.php?autor=<?php echo urlencode($articulo['autor']); ?>'>
            <?php echo htmlspecialchars($articulo['autor']); ?>
        </a> | Fecha: <?php echo $articulo['fecha_publicacion']; ?>
    </em>
</p>

<div class="contenido-articulo">
<?php
$contenido = $articulo['contenido'];
$doc = new DOMDocument();
libxml_use_internal_errors(true);
$doc->loadHTML('<?xml encoding="UTF-8">' . $contenido, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
libxml_clear_errors();

$links = $doc->getElementsByTagName('a');
foreach ($links as $link) {
    $link->setAttribute('target', '_blank');
    $link->setAttribute('rel', 'noopener noreferrer');
}

echo $doc->saveHTML();
?>
</div>

<?php if ($articulo['tipo'] === 'articulo' && !is_null($articulo['valoracion'])): ?>
    <p class='valoracion_redactor'><strong>Valoración del redactor:</strong> <?php echo $articulo['valoracion']; ?>/10</p>
    <p class='stars'>
        <?php for ($i = 1; $i <= 10; $i++) echo ($i <= $articulo['valoracion']) ? "★" : "☆"; ?>
    </p>
<?php endif; ?>

<?php
$stmtProm = $conexion->prepare("SELECT AVG(valoracion) as promedio, COUNT(*) as total_votos FROM valoraciones WHERE id_articulo=:id_articulo");
$stmtProm->execute([':id_articulo'=>$articulo['id']]);
$datos = $stmtProm->fetch(PDO::FETCH_ASSOC);
$promedio = $datos['promedio'];
$total_votos = $datos['total_votos'];
?>

<?php if($promedio!==null && $articulo['tipo']==='articulo'): ?>
    <p class='valoracion_comunidad'><strong>Valoración de la comunidad:</strong> <?php echo number_format($promedio,1); ?>/10 (<?php echo $total_votos; ?> votos)</p>
    <p class='stars'>
        <?php
        $estrellas = round($promedio);
        for($i=1;$i<=10;$i++){
            echo ($i<=$estrellas)?"★":"☆";
        }
        ?>
    </p>
<?php elseif($articulo['tipo']==='articulo'): ?>
    <p class='valoracion_comunidad'><strong>Valoración de la comunidad:</strong> Sin votos aún</p>
<?php endif; ?>

<?php if($articulo['tipo']==='articulo'): ?>
<?php
$stmtCheck = $conexion->prepare("SELECT * FROM valoraciones WHERE id_articulo=:id_articulo AND id_usuario=:id_usuario");
$stmtCheck->execute([
    ':id_articulo'=>$articulo['id'],
    ':id_usuario'=>$_SESSION['usuario_id']
]);
$yaVoto = $stmtCheck->fetch(PDO::FETCH_ASSOC);
?>

<?php if (!$yaVoto): ?>
    <form method='post' action='valorar.php' class='form_valoracion'>
        <input type='hidden' name='id_articulo' value='<?php echo $articulo['id']; ?>'>
        <label>Valora este artículo (1-10):
            <input type='number' name='valoracion' min='1' max='10' required>
        </label>
        <input type='submit' value='Valorar'>
    </form>
<?php else: ?>
    <p>Ya has valorado este artículo.</p>
<?php endif; ?>
<?php endif; ?>
<hr>

<hr>

<h2>Comentarios</h2>

<?php
$stmtCom = $conexion->prepare("
    SELECT c.*, u.nombre AS nombre_usuario
    FROM comentarios c
    JOIN usuarios u ON c.id_usuario = u.id
    WHERE c.id_articulo = :id
    ORDER BY c.fecha DESC
");

$stmtCom->execute([':id'=>$id]);
$comentarios = $stmtCom->fetchAll(PDO::FETCH_ASSOC);

if($comentarios){
    foreach($comentarios as $c){

    echo "<div class='comentario' style='padding:10px; margin-bottom:10px; border:1px solid #ddd; border-radius:6px;'>";

    // CABECERA
    echo "<div style='display:flex; justify-content:space-between; align-items:center; margin-bottom:5px;'>";
    echo "<strong>" . htmlspecialchars($c['nombre_usuario']) . "</strong>";
    echo "<small style='color:gray;'>" . $c['fecha'] . "</small>";
    echo "</div>";

    // CONTENIDO
    echo "<p style='margin-bottom:10px;'>" . htmlspecialchars($c['contenido']) . "</p>";

    // BOTÓN (ABAJO A LA DERECHA)
    if ($_SESSION['usuario_id'] == $c['id_usuario']) {

        echo "<div style='text-align:right;'>";

        echo "<form action='eliminar_comentario.php' method='POST' style='display:inline;'>";
        echo "<input type='hidden' name='id_comentario' value='" . $c['id'] . "'>";
        echo "<input type='hidden' name='id_articulo' value='" . $id . "'>";
        echo "<button type='submit' style='font-size:12px; padding:4px 8px; background:#e74c3c; color:white; border:none; border-radius:4px; cursor:pointer;'>";
        echo "Eliminar";
        echo "</button>";
        echo "</form>";

        echo "</div>";
    }

    echo "</div><hr>";
}
} else {
    echo "<p>No hay comentarios todavía.</p>";
}
?>

<h3>Añadir comentario</h3>

<form action="insertar_comentario.php" method="POST" class="form-comentario">
    <input type="hidden" name="id_articulo" value="<?php echo $id; ?>">

    <textarea name="contenido" placeholder="Escribe tu comentario..." required></textarea><br><br>

    <button type="submit" class="btn-enviar">Enviar</button>
</form>