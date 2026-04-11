<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'administrador') {
    echo "<p>No tienes permisos para acceder a esta página.</p>";
    exit;
}

require 'db.php';

$mensaje = '';

// Actualizar rol si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['usuario_id'], $_POST['rol'])) {
    $usuario_id = $_POST['usuario_id'];
    $rol_nuevo = $_POST['rol'];

    if (in_array($rol_nuevo, ['administrador', 'redactor', 'usuario'])) {
        $stmt = $conexion->prepare("UPDATE usuarios SET rol=:rol WHERE id=:id");
        $stmt->execute([':rol' => $rol_nuevo, ':id' => $usuario_id]);
        $mensaje = "Rol actualizado correctamente.";
    } else {
        $mensaje = "Rol inválido.";
    }
}

// Traer todos los usuarios
$usuarios = $conexion->query("SELECT id, nombre, email, rol FROM usuarios ORDER BY nombre")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de permisos</title>
<link rel="stylesheet" href="estilos.css">
<style>
/* Cabecero */
.cabecera {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    background-color: #f8f8f8;
    border-bottom: 2px solid #ccc;
}

.cabecera .logo img {
    height: 120px;
    width: auto;
    display: block;
}

.menu {
    display: flex;
    gap: 25px;
}

.menu a {
    text-decoration: none;
    color: #333;
    font-weight: bold;
    font-size: 1em;
    padding: 5px 10px;
    border-radius: 5px;
    transition: all 0.3s;
}

.menu a:hover {
    color: #fff;
    background-color: #007BFF;
}

/* Tabla centrada */
.permisos-contenedor {
    display: flex;
    justify-content: center;
    margin: 30px 0;
}

table {
    border-collapse: collapse;
    width: 80%;
}

th, td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #eee;
}

select {
    padding: 2px;
}

input[type=submit] {
    padding: 4px 8px;
    margin-left: 5px;
}

.mensaje {
    text-align: center;
    color: green;
    font-weight: bold;
    margin-top: 15px;
}
</style>
</head>
<body>

<!-- Cabecero igual que listar_articulos.php -->
<header class="cabecera">
    <div class="logo">
        <img src="logo.png" alt="Logo del proyecto">
    </div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<?php if($mensaje) echo "<p class='mensaje'>$mensaje</p>"; ?>

<div class="permisos-contenedor">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
        <?php foreach($usuarios as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['nombre']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td>
                <form method="post">
                    <input type="hidden" name="usuario_id" value="<?php echo $user['id']; ?>">
                    <select name="rol">
                        <option value="administrador" <?php if($user['rol']=='administrador') echo 'selected'; ?>>Administrador</option>
                        <option value="redactor" <?php if($user['rol']=='redactor') echo 'selected'; ?>>Redactor</option>
                        <option value="usuario" <?php if($user['rol']=='usuario') echo 'selected'; ?>>Usuario registrado</option>
                    </select>
                    <input type="submit" value="Actualizar">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<p style="text-align:center;"><a href="listar_articulos.php">← Volver a lista de artículos</a></p>

</body>
</html>
