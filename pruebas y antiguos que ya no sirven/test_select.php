<?php
require 'db.php'; // incluimos la conexión

try {
    $sql = "SELECT * FROM articulos";
    $resultado = $conexion->query($sql);

    if ($resultado) {
        echo "SELECT OK, número de filas: " . $resultado->rowCount();
    } else {
        echo "Error en el SELECT";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
