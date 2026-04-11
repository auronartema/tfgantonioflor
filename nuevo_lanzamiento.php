<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión.</p>";
    exit;
}

// Solo administradores
if ($_SESSION['usuario_rol'] !== 'administrador') {
    echo "<p>No tienes permisos para crear o editar lanzamientos.</p>";
    exit;
}

require 'db.php';

// Variables para edición
$editar = isset($_GET['editar']);
$lanzamiento = [
    'titulo' => '',
    'plataforma' => '',
    'genero' => '',
    'desarrolladora' => '',
    'fecha_lanzamiento' => '',
    'comprar' => ''
];

if ($editar) {
    $id_editar = $_GET['editar'];
    $stmt = $conexion->prepare("SELECT * FROM lanzamientos WHERE id=:id");
    $stmt->execute([':id'=>$id_editar]);
    $lanzamientoDB = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$lanzamientoDB) {
        echo "<p>Lanzamiento no encontrado.</p>";
        exit;
    }
    $lanzamiento = $lanzamientoDB;
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $plataformas_guardar = isset($_POST['plataforma']) ? implode(',', $_POST['plataforma']) : '';
    $genero = $_POST['genero'];
    $desarrolladora = $_POST['desarrolladora'];
    $fecha_lanzamiento = $_POST['fecha_lanzamiento'];
    $comprar = $_POST['comprar'] ?? '';

    if ($editar) {
        $stmt = $conexion->prepare("UPDATE lanzamientos SET 
            titulo=:titulo, plataforma=:plataforma, genero=:genero, desarrolladora=:desarrolladora,
            fecha_lanzamiento=:fecha_lanzamiento, comprar=:comprar
            WHERE id=:id
        ");
        $stmt->execute([
            ':titulo' => $titulo,
            ':plataforma' => $plataformas_guardar,
            ':genero' => $genero,
            ':desarrolladora' => $desarrolladora,
            ':fecha_lanzamiento' => $fecha_lanzamiento,
            ':comprar' => $comprar,
            ':id' => $id_editar
        ]);
        $mensaje = "Lanzamiento actualizado correctamente.";
    } else {
        $stmt = $conexion->prepare("INSERT INTO lanzamientos 
            (titulo, plataforma, genero, desarrolladora, fecha_lanzamiento, comprar) 
            VALUES (:titulo, :plataforma, :genero, :desarrolladora, :fecha_lanzamiento, :comprar)
        ");
        $stmt->execute([
            ':titulo' => $titulo,
            ':plataforma' => $plataformas_guardar,
            ':genero' => $genero,
            ':desarrolladora' => $desarrolladora,
            ':fecha_lanzamiento' => $fecha_lanzamiento,
            ':comprar' => $comprar
        ]);
        $mensaje = "Lanzamiento creado correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title><?php echo $editar ? "Editar lanzamiento" : "Nuevo lanzamiento"; ?></title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

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

<h1><?php echo $editar ? "Editar lanzamiento" : "Nuevo lanzamiento"; ?></h1>

<?php if(!empty($mensaje)) echo "<p style='color:green;'>$mensaje</p>"; ?>

<form method="post">
    <label>Título:</label><br>
    <input type="text" name="titulo" value="<?php echo htmlspecialchars($lanzamiento['titulo']); ?>" required><br><br>

    <label>Plataformas:</label><br>
    <select name="plataforma[]" multiple size="6" required>
        <?php 
        $opcionesPlataforma = ['PS4','PS5','Xbox Series','Nintendo Switch','Nintendo Switch 2','PC'];
        $plataformasSeleccionadas = isset($lanzamiento['plataforma']) ? explode(',', $lanzamiento['plataforma']) : [];
        foreach($opcionesPlataforma as $p): 
        ?>
            <option value="<?php echo $p; ?>" <?php if(in_array($p, $plataformasSeleccionadas)) echo 'selected'; ?>>
                <?php echo $p; ?>
            </option>
        <?php endforeach; ?>
    </select><br>
    <small>Para seleccionar varias, mantén Ctrl o Cmd.</small><br><br>

    <label>Género:</label><br>
    <input type="text" name="genero" value="<?php echo htmlspecialchars($lanzamiento['genero']); ?>" required><br><br>

    <label>Desarrolladora:</label><br>
    <input type="text" name="desarrolladora" value="<?php echo htmlspecialchars($lanzamiento['desarrolladora']); ?>" required><br><br>

    <label>Fecha de lanzamiento:</label><br>
    <input type="date" name="fecha_lanzamiento" value="<?php echo htmlspecialchars($lanzamiento['fecha_lanzamiento']); ?>" required><br><br>

    <label>Enlace de compra:</label><br>
    <input type="url" name="comprar" value="<?php echo htmlspecialchars($lanzamiento['comprar']); ?>"><br><br>

    <input type="submit" value="<?php echo $editar ? "Actualizar lanzamiento" : "Crear lanzamiento"; ?>">
</form>

</body>
</html>
