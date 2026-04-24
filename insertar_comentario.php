<?php
session_start();
require 'db.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_articulo = $_POST["id_articulo"];
    $contenido = $_POST["contenido"];

    $id_usuario = $_SESSION['usuario_id'];

    if (!empty($contenido)) {

        $sql = "INSERT INTO comentarios (id_articulo, id_usuario, contenido, fecha)
                VALUES (:id_articulo, :id_usuario, :contenido, NOW())";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([
            ':id_articulo' => $id_articulo,
            ':id_usuario' => $id_usuario,
            ':contenido' => $contenido
        ]);
    }

    header("Location: ver_articulo.php?id=" . $id_articulo);
    exit();
}
?>