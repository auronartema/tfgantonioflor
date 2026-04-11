<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver los artículos.</p>";
    exit;
}

require 'db.php';

if (!isset($_GET['autor'])) {
    echo "<p>No se especificó ningún autor.</p>";
    exit;
}

$autor = $_GET['autor'];

$stmt = $conexion->prepare("SELECT * FROM articulos WHERE autor=:autor ORDER BY fecha_publicacion DESC");
$stmt->execute([':autor'=>$autor]);
$articulos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Artículos de <?php echo htmlspecialchars($autor); ?></title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>

<header class="cabecera">
    <div class="logo">
        <a href="listar_articulos.php">
            <img src="logo.png" alt="Logo del proyecto" />
        </a>
    </div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<main style="max-width:900px;margin:30px auto;">
<h1>Artículos de <?php echo htmlspecialchars($autor); ?></h1>

<?php
$contador = 0;
if (!$articulos) {
    echo "<p>Este autor aún no ha publicado artículos.</p>";
} else {
    foreach ($articulos as $articulo) {
        $contador++;
        $clase = ($contador <= 3) ? 'articulo-principal' : 'articulo-secundario';
        echo "<div class='articulo $clase'>";

        if (!empty($articulo['imagen'])) {
            echo "<img src='" . htmlspecialchars($articulo['imagen']) . "' class='imagen-listado' alt='Imagen del artículo'>";
        }

        echo "<h2>" . htmlspecialchars($articulo['titulo']) . "</h2>";
        echo "<p class='autor_fecha'><em>Autor: <a href='articulos_por_autor.php?autor=" . urlencode($articulo['autor']) . "'>" . htmlspecialchars($articulo['autor']) . "</a> | Fecha: " . $articulo['fecha_publicacion'] . "</em></p>";

        $max_chars = 150;
        $introduccion = $articulo['introduccion'];
        if (strlen($introduccion) > $max_chars) {
            $pos = strpos($introduccion, ' ', $max_chars);
            $introduccion = ($pos !== false) ? substr($introduccion, 0, $pos) . "..." : substr($introduccion, 0, $max_chars) . "...";
        }
        echo "<p class='mini_intro'>" . nl2br(htmlspecialchars($introduccion)) . " <a class='leer_mas' href='ver_articulo.php?id=" . $articulo['id'] . "'>Leer más</a></p>";

        // Valoraciones
        $stmtProm = $conexion->prepare("SELECT AVG(valoracion) as promedio, COUNT(*) as total_votos FROM valoraciones WHERE id_articulo=:id_articulo");
        $stmtProm->execute([':id_articulo'=>$articulo['id']]);
        $datos = $stmtProm->fetch(PDO::FETCH_ASSOC);
        $promedio = $datos['promedio'];
        $total_votos = $datos['total_votos'];

        if($articulo['valoracion']!==null){
            $redactorStars = round($articulo['valoracion']);
            echo "<p class='valoracion_redactor'><strong>Valoración del redactor:</strong> " . $articulo['valoracion'] . "/10</p>";
            echo "<p class='stars'>";
            for($i=1; $i<=10; $i++) echo ($i <= $redactorStars) ? "★" : "☆";
            echo "</p>";
        }

        if($promedio!==null){
            $comunidadStars = round($promedio);
            echo "<p class='valoracion_comunidad'><strong>Valoración de la comunidad:</strong> " . number_format($promedio,1) . "/10 ($total_votos votos)</p>";
            echo "<p class='stars'>";
            for($i=1;$i<=10;$i++) echo ($i<=$comunidadStars)?"★":"☆";
            echo "</p>";
        } else {
            echo "<p class='valoracion_comunidad'><strong>Valoración de la comunidad:</strong> Sin votos aún</p>";
        }

        $stmtCheck = $conexion->prepare("SELECT * FROM valoraciones WHERE id_articulo=:id_articulo AND id_usuario=:id_usuario");
        $stmtCheck->execute([':id_articulo'=>$articulo['id'], ':id_usuario'=>$_SESSION['usuario_id']]);
        $yaVoto = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if (!$yaVoto) {
            echo "<form method='post' action='valorar.php' class='form_valoracion'>";
            echo "<input type='hidden' name='id_articulo' value='" . $articulo['id'] . "'>";
            echo "<label>Valora este artículo (1-10): <input type='number' name='valoracion' min='1' max='10' required></label>";
            echo "<input type='submit' value='Valorar'>";
            echo "</form>";
        } else {
            echo "<p>Ya has valorado este artículo.</p>";
        }

        echo "</div>";
    }
}
?>
</main>
</body>
</html>
