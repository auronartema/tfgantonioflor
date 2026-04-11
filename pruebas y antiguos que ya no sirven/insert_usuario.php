<?php
require 'db.php';

try {
    $sql = "INSERT INTO usuarios (nombre, email, password) 
            VALUES (:nombre, :email, :password)";
    $stmt = $conexion->prepare($sql);
    $stmt->execute([
        ':nombre' => 'Antonio Flor',
        ':email' => 'auronartema@gmail.com',
        ':password' => password_hash('artemis92', PASSWORD_DEFAULT)
    ]);

    echo "Usuario insertado correctamente";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
