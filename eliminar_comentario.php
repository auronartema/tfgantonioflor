<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_comentario = $_POST['id_comentario'];
    $id_articulo = $_POST['id_articulo'];

    // 🔒 solo elimina si es el autor
    $stmt = $conexion->prepare("
        DELETE FROM comentarios 
        WHERE id = :id 
        AND id_usuario = :id_usuario
    ");

    $stmt->execute([
        ':id' => $id_comentario,
        ':id_usuario' => $_SESSION['usuario_id']
    ]);
}

header("Location: ver_articulo.php?id=" . $id_articulo);
exit;
?>