<?php
$host = "localhost";
$db   = "medio_videojuegos"; // nombre de tu BD
$user = "root";              // usuario por defecto en XAMPP
$pass = "";                  // contraseña por defecto en XAMPP

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Conexión OK"; // lo dejamos comentado, lo probamos en test_select.php
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
