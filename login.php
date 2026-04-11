<?php
session_start();
require 'db.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($usuario && $password) {
        $stmt = $conexion->prepare(
            "SELECT id, nombre, password, rol 
             FROM usuarios 
             WHERE nombre = :nombre"
        );
        $stmt->execute([':nombre' => $usuario]);
        $usuarioDB = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioDB && password_verify($password, $usuarioDB['password'])) {

            $rol = $usuarioDB['rol'] ?: 'usuario';

            $_SESSION['usuario_id']     = $usuarioDB['id'];
            $_SESSION['usuario_nombre'] = $usuarioDB['nombre'];
            $_SESSION['usuario_rol']    = $rol;

            header('Location: listar_articulos.php');
            exit;
        } else {
            $mensaje = 'Usuario o contraseña incorrectos';
        }
    } else {
        $mensaje = 'Por favor, introduce usuario y contraseña';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login</title>
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

/* Formulario centrado */
.login-contenedor {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
}

.login-form {
    background-color: #f8f8f8;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.login-form h2 {
    margin-bottom: 20px;
}

.login-form label {
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-weight: bold;
}

.login-form input[type="text"],
.login-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.login-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
}

.login-form input[type="submit"]:hover {
    background-color: #0056b3;
}

.login-form p {
    margin-top: 10px;
    font-size: 0.9em;
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

<div class="login-contenedor">
    <form class="login-form" method="post">
        <h2>Iniciar sesión</h2>

        <?php if ($mensaje): ?>
            <p style="color:red;"><?php echo htmlspecialchars($mensaje); ?></p>
        <?php endif; ?>

        <label>Usuario:</label>
        <input type="text" name="usuario" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Entrar">

        <p>Si no tienes cuenta, <a href="registro.php">regístrate aquí</a>.</p>
    </form>
</div>

</body>
</html>
