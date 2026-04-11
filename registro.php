<?php
session_start();
require 'db.php';

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $rol = $_POST['rol'] ?? 'usuario'; // rol opcional, por defecto 'usuario'

    if ($nombre && $email && $password) {
        // Verificar si el usuario ya existe
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE nombre=:nombre OR email=:email");
        $stmt->execute([':nombre' => $nombre, ':email' => $email]);
        if ($stmt->fetch()) {
            $mensaje = "El usuario o email ya existe";
        } else {
            // Hash de contraseña
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            // Insertar usuario
            $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, email, password, rol) VALUES (:nombre, :email, :password, :rol)");
            $stmt->execute([
                ':nombre' => $nombre,
                ':email' => $email,
                ':password' => $password_hash,
                ':rol' => $rol
            ]);
            $mensaje = "Registro exitoso. Puedes <a href='login.php'>iniciar sesión</a>.";
        }
    } else {
        $mensaje = "Completa todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registro</title>
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
.registro-contenedor {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 60vh;
}

.registro-form {
    background-color: #f8f8f8;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.registro-form h2 {
    margin-bottom: 20px;
}

.registro-form label {
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-weight: bold;
}

.registro-form input[type="text"],
.registro-form input[type="email"],
.registro-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.registro-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
}

.registro-form input[type="submit"]:hover {
    background-color: #0056b3;
}

.registro-form p {
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

<div class="registro-contenedor">
    <form class="registro-form" method="post">
        <h2>Registro de usuario</h2>

        <?php if ($mensaje) echo "<p style='color:red;'>$mensaje</p>"; ?>

        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Registrarse">
    </form>
</div>

</body>
</html>
