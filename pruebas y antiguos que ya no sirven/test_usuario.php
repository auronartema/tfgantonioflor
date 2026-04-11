<?php
require 'db.php';

try {
    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    foreach ($resultado as $usuario) {
        echo "ID: " . $usuario['id'] . " | Nombre: " . $usuario['nombre'] . " | Email: " . $usuario['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
