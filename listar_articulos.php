<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver los artículos.</p>";
    exit;
}

require 'db.php';

// Orden dinámico
$criterio = $_GET['criterio'] ?? 'fecha';
$direccion = $_GET['direccion'] ?? 'DESC';
if (!in_array($criterio, ['fecha','valoracion'])) $criterio = 'fecha';
if (!in_array($direccion, ['ASC','DESC'])) $direccion = 'DESC';
$order_by = ($criterio == 'fecha') ? 'fecha_publicacion' : 'valoracion';

// Filtros
$buscar = $_GET['buscar'] ?? '';
$tipo = $_GET['tipo'] ?? ''; // 'articulo', 'noticia' o ''
$plataforma = $_GET['plataforma'] ?? '';

// Construcción dinámica de WHERE
$where = [];
$params = [];

if (!empty($buscar)) {
    $where[] = "(titulo LIKE :buscar OR introduccion LIKE :buscar)";
    $params[':buscar'] = "%$buscar%";
}

if (!empty($tipo) && in_array($tipo, ['articulo','noticia'])) {
    $where[] = "tipo = :tipo";
    $params[':tipo'] = $tipo;
}

if (!empty($plataforma)) {
    $where[] = "id IN (
        SELECT id_articulo FROM articulo_subcategoria asub
        JOIN subcategorias s ON asub.id_subcategoria = s.id
        WHERE s.nombre = :plataforma
    )";
    $params[':plataforma'] = $plataforma;
}

$where_sql = '';
if ($where) {
    $where_sql = 'WHERE ' . implode(' AND ', $where);
}

// SQL final
$sql = "SELECT * FROM articulos $where_sql ORDER BY $order_by $direccion";
$stmt = $conexion->prepare($sql);
$stmt->execute($params);
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obtener todas las plataformas para el filtro
$plataformas_stmt = $conexion->query("SELECT nombre FROM subcategorias ORDER BY nombre");
$plataformas_disponibles = $plataformas_stmt->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Artículos</title>
<link rel="stylesheet" href="estilos.css">
<style>
/* Barra de filtros y orden alineada a la izquierda */
.barra-filtros {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    margin-bottom: 20px;
    padding: 10px;
    background-color: #f0f0f0;
    border-radius: 6px;
}

.filtros-izquierda {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
}

.filtros-izquierda form,
.filtros-izquierda input,
.filtros-izquierda select {
    margin: 0;
}

.articulos-principales, .columnas {
    margin-top: 20px;
}

.columnas {
    display: flex;
    gap: 20px;
}

.col-articulos, .col-noticias {
    flex: 1;
}
</style>
</head>
<body>

<header class="cabecera">
    <div class="logo">
        <img src="logo.png" alt="Logo del proyecto">
    </div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<!-- Barra de filtros y orden alineada a la izquierda -->
<div class="barra-filtros">
    <div class="filtros-izquierda">
        <!-- Orden -->
        <form method="get" id="ordenForm" style="display:inline-block;">
            <label>Ordenar por:
                <select name="criterio" onchange="this.form.submit()">
                    <option value="fecha" <?php if($criterio=='fecha') echo 'selected'; ?>>Fecha</option>
                    <option value="valoracion" <?php if($criterio=='valoracion') echo 'selected'; ?>>Valoración</option>
                </select>
            </label>
            <label>Dirección:
                <select name="direccion" onchange="this.form.submit()">
                    <option value="DESC" <?php if($direccion=='DESC') echo 'selected'; ?>>Descendente</option>
                    <option value="ASC" <?php if($direccion=='ASC') echo 'selected'; ?>>Ascendente</option>
                </select>
            </label>
            <input type="hidden" name="buscar" value="<?php echo htmlspecialchars($buscar); ?>">
            <input type="hidden" name="tipo" value="<?php echo htmlspecialchars($tipo); ?>">
            <input type="hidden" name="plataforma" value="<?php echo htmlspecialchars($plataforma); ?>">
        </form>

        <!-- Buscador y selectores -->
        <input type="text" id="buscarInput" placeholder="Buscar..." value="<?php echo htmlspecialchars($buscar); ?>">
        <select id="tipoSelect">
            <option value="">Todos</option>
            <option value="articulo" <?php if($tipo=='articulo') echo 'selected'; ?>>Artículo</option>
            <option value="noticia" <?php if($tipo=='noticia') echo 'selected'; ?>>Noticia</option>
        </select>
        <select id="plataformaSelect">
            <option value="">Todas</option>
            <?php foreach($plataformas_disponibles as $plataforma_item): ?>
                <option value="<?php echo htmlspecialchars($plataforma_item); ?>" <?php if($plataforma==$plataforma_item) echo 'selected'; ?>><?php echo htmlspecialchars($plataforma_item); ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="filtros-derecha">
        <a href="proximos_lanzamientos.php" class="btn-lanzamientos">
            🎮 Próximos lanzamientos
        </a>
    </div>
</div>


<!-- Artículos destacados -->
<h2 class="titulo-seccion">Novedades</h2>
<?php
$contador = 0;
$restantes = [];
echo "<div class='articulos-principales'>";
foreach ($resultado as $articulo) {
    if ($contador < 3) {
        echo "<div class='articulo articulo-principal'>";
        if (!empty($articulo['imagen'])) echo "<img src='" . htmlspecialchars($articulo['imagen']) . "' class='imagen-listado'>";
        echo ($articulo['tipo'] === 'articulo') ? "<span class='etiqueta etiqueta-articulo'>Artículo</span> " : "<span class='etiqueta etiqueta-noticia'>Noticia</span> ";
        $stmtSub = $conexion->prepare("SELECT s.nombre FROM subcategorias s JOIN articulo_subcategoria asub ON s.id = asub.id_subcategoria WHERE asub.id_articulo=:id");
        $stmtSub->execute([':id'=>$articulo['id']]);
        $subcats = $stmtSub->fetchAll(PDO::FETCH_COLUMN);
        if($subcats){
            echo "<p class='subcategorias'>";
            foreach($subcats as $subcat){
                $claseSegura = str_replace(' ','-',$subcat);
                echo "<span class='sub-".htmlspecialchars($claseSegura)."'>".htmlspecialchars($subcat)."</span> ";
            }
            echo "</p>";
        }
        echo "<h2>" . htmlspecialchars($articulo['titulo']) . "</h2>";
        echo "<p class='autor_fecha'><em>Autor: <a href='articulos_por_autor.php?autor=" . urlencode($articulo['autor']) . "'>" . htmlspecialchars($articulo['autor']) . "</a> | Fecha: " . $articulo['fecha_publicacion'] . "</em></p>";
        $intro = $articulo['introduccion'];
        if (strlen($intro) > 150) { $pos = strpos($intro, ' ', 150); $intro = ($pos!==false) ? substr($intro,0,$pos)."..." : substr($intro,0,150)."..."; }
        echo "<p class='mini_intro'>" . nl2br(htmlspecialchars($intro)) . " <a class='leer_mas' href='ver_articulo.php?id=" . $articulo['id'] . "'>Leer más</a></p>";
        if ($articulo['tipo']==='articulo' && !empty($articulo['valoracion'])) {
            echo "<p class='stars'>";
            for ($i=1;$i<=10;$i++) echo ($i<=$articulo['valoracion'])?"★":"☆";
            echo "</p>";
        }
        echo "</div>";
    } else {
        $restantes[] = $articulo;
    }
    $contador++;
}
echo "</div>";

// Columnas: izquierda artículos, derecha noticias
if ($restantes) {
    echo "<div class='columnas'>";
    echo "<div class='col-articulos'><h2 class='titulo-seccion'>Artículos</h2>";
    foreach ($restantes as $articulo) {
        if ($articulo['tipo'] !== 'articulo') continue;
        echo "<div class='articulo'>";
        if (!empty($articulo['imagen'])) echo "<img src='" . htmlspecialchars($articulo['imagen']) . "' class='imagen-listado'>";
        echo "<span class='etiqueta etiqueta-articulo'>Artículo</span> ";
        $stmtSub = $conexion->prepare("SELECT s.nombre FROM subcategorias s JOIN articulo_subcategoria asub ON s.id = asub.id_subcategoria WHERE asub.id_articulo=:id");
        $stmtSub->execute([':id'=>$articulo['id']]);
        $subcats = $stmtSub->fetchAll(PDO::FETCH_COLUMN);
        if($subcats){
            echo "<p class='subcategorias'>";
            foreach($subcats as $subcat){
                $claseSegura = str_replace(' ','-',$subcat);
                echo "<span class='sub-".htmlspecialchars($claseSegura)."'>".htmlspecialchars($subcat)."</span> ";
            }
            echo "</p>";
        }
        echo "<h2>" . htmlspecialchars($articulo['titulo']) . "</h2>";
        $intro = $articulo['introduccion'];
        if (strlen($intro) > 150) { $pos = strpos($intro, ' ', 150); $intro = ($pos!==false) ? substr($intro,0,$pos)."..." : substr($intro,0,150)."..."; }
        echo "<p class='mini_intro'>" . nl2br(htmlspecialchars($intro)) . " <a class='leer_mas' href='ver_articulo.php?id=" . $articulo['id'] . "'>Leer más</a></p>";
        if (!empty($articulo['valoracion'])) {
            echo "<p class='stars'>";
            for ($i=1;$i<=10;$i++) echo ($i<=$articulo['valoracion'])?"★":"☆";
            echo "</p>";
        }
        echo "</div>";
    }
    echo "</div>";

    echo "<div class='col-noticias'><h2 class='titulo-seccion'>Noticias</h2>";
    foreach ($restantes as $articulo) {
        if ($articulo['tipo'] !== 'noticia') continue;
        echo "<div class='articulo articulo-noticia'>";
        if (!empty($articulo['imagen'])) echo "<img src='" . htmlspecialchars($articulo['imagen']) . "' class='imagen-listado'>";
        echo "<span class='etiqueta etiqueta-noticia'>Noticia</span> ";
        $stmtSub = $conexion->prepare("SELECT s.nombre FROM subcategorias s JOIN articulo_subcategoria asub ON s.id = asub.id_subcategoria WHERE asub.id_articulo=:id");
        $stmtSub->execute([':id'=>$articulo['id']]);
        $subcats = $stmtSub->fetchAll(PDO::FETCH_COLUMN);
        if($subcats){
            echo "<p class='subcategorias'>";
            foreach($subcats as $subcat){
                $claseSegura = str_replace(' ','-',$subcat);
                echo "<span class='sub-".htmlspecialchars($claseSegura)."'>".htmlspecialchars($subcat)."</span> ";
            }
            echo "</p>";
        }
        echo "<h3>" . htmlspecialchars($articulo['titulo']) . "</h3>";
        $intro = $articulo['introduccion'];
        if (strlen($intro) > 100) { $pos = strpos($intro, ' ', 100); $intro = ($pos!==false) ? substr($intro,0,$pos)."..." : substr($intro,0,100)."..."; }
        echo "<p class='mini_intro'>" . nl2br(htmlspecialchars($intro)) . "</p>";
        echo "</div>";
    }
    echo "</div>";
    echo "</div>"; // cierre columnas
}
?>

<script>
// Filtros en vivo usando los select
const buscarInput = document.getElementById('buscarInput');
const tipoSelect = document.getElementById('tipoSelect');
const plataformaSelect = document.getElementById('plataformaSelect');

function aplicarFiltros() {
    const params = new URLSearchParams();
    params.set('buscar', buscarInput.value.trim());
    params.set('tipo', tipoSelect.value);
    params.set('plataforma', plataformaSelect.value);
    params.set('criterio', "<?php echo $criterio; ?>");
    params.set('direccion', "<?php echo $direccion; ?>");
    window.location.href = "listar_articulos.php?" + params.toString();
}

buscarInput.addEventListener('keyup', () => setTimeout(aplicarFiltros, 300));
tipoSelect.addEventListener('change', aplicarFiltros);
plataformaSelect.addEventListener('change', aplicarFiltros);
</script>

</body>
</html>
