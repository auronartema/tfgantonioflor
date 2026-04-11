<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para valorar artículos.</p>";
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_articulo = $_POST['id_articulo'] ?? 0;
    $valoracion = $_POST['valoracion'] ?? null;
    $id_usuario = $_SESSION['usuario_id'];

    if ($id_articulo && $valoracion) {
        try {
            $sql = "INSERT INTO valoraciones (id_articulo, id_usuario, valoracion) 
                    VALUES (:id_articulo, :id_usuario, :valoracion)
                    ON DUPLICATE KEY UPDATE valoracion = :valoracion";
            $stmt = $conexion->prepare($sql);
            $stmt->execute([
                ':id_articulo' => $id_articulo,
                ':id_usuario' => $id_usuario,
                ':valoracion' => $valoracion
            ]);
            echo "<p>Artículo valorado correctamente.</p>";
            echo "<p><a href='listar_articulos.php'>Volver a artículos</a></p>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
