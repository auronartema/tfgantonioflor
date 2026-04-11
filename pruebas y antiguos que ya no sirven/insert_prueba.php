<?php
require 'db.php';

try {
    $sql = "INSERT INTO articulos (titulo, contenido, fecha_publicacion, autor, valoracion)
            VALUES ('Primer artículo', 'Este es el contenido de prueba', NOW(), 'Antonio Flor', 9)";
    
    $conexion->exec($sql);
    echo "Artículo insertado correctamente";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
