<?php
session_start();

// Si el usuario ya está logueado, lo mandamos a listar_articulos
if(isset($_SESSION['usuario_id'])) {
    header("Location: controllers/listar_articulos.php");
    exit();
} else {
    // Si no está logueado, vamos al login
    header("Location: controllers/login.php");
    exit();
}
