<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver tu perfil.</p>";
    exit;
}

require 'db.php';

$usuario_id = $_SESSION['usuario_id'];
$mensaje = '';

// Traer datos del usuario
$stmt = $conexion->prepare("SELECT id, nombre, email, rol FROM usuarios WHERE id=:id");
$stmt->execute([':id' => $usuario_id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "<p>Usuario no encontrado.</p>";
    exit;
}

// Procesar actualización
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Actualizar perfil
    if (isset($_POST['actualizar_perfil'])) {
        $nombre = $_POST['nombre'] ?? '';
        $email = $_POST['email'] ?? '';

        if ($nombre && $email) {
            $stmtUpdate = $conexion->prepare("UPDATE usuarios SET nombre=:nombre, email=:email WHERE id=:id");
            $stmtUpdate->execute([':nombre'=>$nombre, ':email'=>$email, ':id'=>$usuario_id]);
            $mensaje = "Perfil actualizado correctamente.";

            // Actualizar sesión
            $_SESSION['usuario_nombre'] = $nombre;
            $usuario['nombre'] = $nombre;
            $usuario['email'] = $email;
        } else {
            $mensaje = "Completa todos los campos del perfil.";
        }
    }

    // Cambiar contraseña
    if (isset($_POST['cambiar_password'])) {
        $pass_actual = $_POST['password_actual'] ?? '';
        $pass_nueva = $_POST['password_nueva'] ?? '';
        $pass_confirm = $_POST['password_confirm'] ?? '';

        if ($pass_actual && $pass_nueva && $pass_confirm) {
            $stmtPass = $conexion->prepare("SELECT password FROM usuarios WHERE id=:id");
            $stmtPass->execute([':id'=>$usuario_id]);
            $passDB = $stmtPass->fetchColumn();

            if (password_verify($pass_actual, $passDB)) {
                if ($pass_nueva === $pass_confirm) {
                    $hash = password_hash($pass_nueva, PASSWORD_DEFAULT);
                    $stmtUpd = $conexion->prepare("UPDATE usuarios SET password=:pass WHERE id=:id");
                    $stmtUpd->execute([':pass'=>$hash, ':id'=>$usuario_id]);
                    $mensaje = "Contraseña cambiada correctamente.";
                } else {
                    $mensaje = "La nueva contraseña no coincide.";
                }
            } else {
                $mensaje = "Contraseña actual incorrecta.";
            }
        } else {
            $mensaje = "Completa todos los campos de contraseña.";
        }
    }

    // Eliminar cuenta
    if (isset($_POST['eliminar_cuenta'])) {
        $stmtDelArt = $conexion->prepare("DELETE FROM articulos WHERE autor=:autor");
        $stmtDelArt->execute([':autor' => $usuario['nombre']]);

        $stmtDelUsr = $conexion->prepare("DELETE FROM usuarios WHERE id=:id");
        $stmtDelUsr->execute([':id' => $usuario_id]);

        session_destroy();
        header('Location: registro.php?mensaje=Cuenta eliminada correctamente');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Perfil de <?php echo htmlspecialchars($usuario['nombre']); ?></title>
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
.perfil-contenedor {
    display: flex;
    justify-content: center;
    align-items: flex-start;
    flex-direction: column;
    min-height: 60vh;
    gap: 30px;
    padding: 20px;
}

.perfil-form {
    background-color: #f8f8f8;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    width: 100%;
    max-width: 500px;
}

.perfil-form h2 {
    margin-bottom: 15px;
    text-align: center;
}

.perfil-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.perfil-form input[type="text"],
.perfil-form input[type="email"],
.perfil-form input[type="password"] {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

.perfil-form input[type="submit"] {
    width: 100%;
    padding: 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 1em;
}

.perfil-form input[type="submit"]:hover {
    background-color: #0056b3;
}

.perfil-form p {
    text-align: center;
    color: green;
    font-weight: bold;
}
.mis-articulos {
    max-width: 500px;
    margin: auto;
}
.mis-articulos ul {
    list-style: none;
    padding-left: 0;
}
.mis-articulos li {
    padding: 8px 0;
    border-bottom: 1px solid #ccc;
}
.mis-articulos a {
    margin-left: 10px;
}
</style>
</head>
<body>

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

<div class="perfil-contenedor">

    <?php if ($mensaje) echo "<p>$mensaje</p>"; ?>

    <!-- Formulario editar datos -->
    <form class="perfil-form" method="post">
        <h2>Editar datos</h2>
        <input type="hidden" name="actualizar_perfil" value="1">
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre']); ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>

        <input type="submit" value="Actualizar perfil">
    </form>

    <!-- Cambiar contraseña -->
    <form class="perfil-form" method="post">
        <h2>Cambiar contraseña</h2>
        <input type="hidden" name="cambiar_password" value="1">
        <label>Contraseña actual:</label>
        <input type="password" name="password_actual" required>

        <label>Nueva contraseña:</label>
        <input type="password" name="password_nueva" required>

        <label>Confirmar nueva contraseña:</label>
        <input type="password" name="password_confirm" required>

        <input type="submit" value="Cambiar contraseña">
    </form>

    <!-- Eliminar cuenta -->
    <form class="perfil-form" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar tu cuenta? Esta acción es irreversible.');">
        <input type="hidden" name="eliminar_cuenta" value="1">
        <input type="submit" value="Eliminar cuenta" style="background-color:red; color:white;">
    </form>

    <!-- Mis artículos para redactores/administradores -->
    <?php if(in_array($usuario['rol'], ['administrador','redactor'])): ?>
    <div class="mis-articulos">
        <h2>Mis artículos</h2>
        <?php
        $stmtArt = $conexion->prepare("SELECT id, titulo, tipo, fecha_publicacion FROM articulos WHERE autor=:autor ORDER BY fecha_publicacion DESC");
        $stmtArt->execute([':autor'=>$usuario['nombre']]);
        $misArticulos = $stmtArt->fetchAll(PDO::FETCH_ASSOC);

        if($misArticulos):
        ?>
        <ul>
        <?php foreach($misArticulos as $art): ?>
            <li>
                <?php echo htmlspecialchars($art['titulo']); ?> 
                (<?php echo htmlspecialchars($art['tipo']); ?> | <?php echo $art['fecha_publicacion']; ?>)
                - <a href="ver_articulo.php?id=<?php echo $art['id']; ?>">Ver</a>
                - <a href="crear_articulo.php?editar=<?php echo $art['id']; ?>">Editar</a>
            </li>
        <?php endforeach; ?>
        </ul>
        <?php else: ?>
        <p>No has creado ningún artículo todavía.</p>
        <?php endif; ?>
    </div>
    <?php endif; ?>

</div>

</body>
</html>
