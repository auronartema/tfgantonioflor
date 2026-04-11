<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver los próximos lanzamientos.</p>";
    exit;
}

require 'db.php';

// Comprobamos si es administrador
$esAdmin = isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'administrador';

// Filtros
$buscar = $_GET['buscar'] ?? '';
$plataforma_filtro = $_GET['plataforma'] ?? '';
$genero_filtro = $_GET['genero'] ?? '';
$desarrolladora_filtro = $_GET['desarrolladora'] ?? '';

// Paginación
$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$por_pagina = 10;
$offset = ($pagina - 1) * $por_pagina;

// Construcción dinámica de WHERE
$where = [];
$params = [];

if (!empty($buscar)) {
    $where[] = "titulo LIKE :buscar";
    $params[':buscar'] = "%$buscar%";
}
if (!empty($plataforma_filtro)) {
    $where[] = "FIND_IN_SET(:plataforma, plataforma)";
    $params[':plataforma'] = $plataforma_filtro;
}
if (!empty($genero_filtro)) {
    $where[] = "genero = :genero";
    $params[':genero'] = $genero_filtro;
}
if (!empty($desarrolladora_filtro)) {
    $where[] = "desarrolladora = :desarrolladora";
    $params[':desarrolladora'] = $desarrolladora_filtro;
}

$where_sql = '';
if ($where) $where_sql = 'WHERE ' . implode(' AND ', $where);

// Total registros
$stmtTotal = $conexion->prepare("SELECT COUNT(*) FROM lanzamientos $where_sql");
$stmtTotal->execute($params);
$total_registros = $stmtTotal->fetchColumn();
$total_paginas = ceil($total_registros / $por_pagina);

// Consulta final
$sql = "SELECT * FROM lanzamientos $where_sql ORDER BY fecha_lanzamiento ASC LIMIT :offset, :por_pagina";
$stmt = $conexion->prepare($sql);
foreach ($params as $key => $val) $stmt->bindValue($key, $val);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':por_pagina', $por_pagina, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Opciones de plataforma
$opcionesPlataforma = ['PS4','PS5','Xbox Series','Nintendo Switch','Nintendo Switch 2','PC'];

// Obtener géneros y desarrolladoras para filtros
$generos_disponibles = $conexion->query("SELECT DISTINCT genero FROM lanzamientos ORDER BY genero")->fetchAll(PDO::FETCH_COLUMN);
$desarrolladoras_disponibles = $conexion->query("SELECT DISTINCT desarrolladora FROM lanzamientos ORDER BY desarrolladora")->fetchAll(PDO::FETCH_COLUMN);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Próximos Lanzamientos</title>
<link rel="stylesheet" href="estilos.css">
<style>
/* Barra de filtros */
.barra-filtros {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 20px;
    background-color: #f0f0f0;
    padding: 10px;
    border-radius: 6px;
}
.barra-filtros input, .barra-filtros select {
    padding: 5px;
}
.plataforma-boton {
    display: inline-block;
    margin: 2px;
    padding: 4px 8px;
    border-radius: 5px;
    color: white;
    font-size: 0.9em;
    text-decoration: none;
    cursor: pointer;
}
.PS4 { background-color: #003791; }
.PS5 { background-color: #00A2E8; }
.Xbox-Series { background-color: #107C10; }
.Nintendo-Switch { background-color: #E60012; }
.Nintendo-Switch-2 { background-color: #FF3B30; }
.PC { background-color: #6c757d; }

.boton-comprar {
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
}
.boton-comprar:hover { background-color: #0056b3; }

.admin-boton { margin-bottom: 15px; }

.tabla-lanzamientos {
    width: 100%;
    border-collapse: collapse;
}
.tabla-lanzamientos th, .tabla-lanzamientos td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}
.tabla-lanzamientos th { background-color: #eee; }

.paginacion { margin-top: 15px; text-align: center; }
.paginacion a {
    margin: 0 5px;
    padding: 5px 10px;
    background-color: #f0f0f0;
    color: #333;
    text-decoration: none;
    border-radius: 4px;
}
.paginacion a:hover { background-color: #ccc; }
.paginacion .actual { font-weight: bold; text-decoration: underline; }
</style>
</head>
<body>

<header class="cabecera">
    <div class="logo"><img src="logo.png" alt="Logo"></div>
    <nav class="menu">
        <a href="listar_articulos.php">Inicio</a>
        <a href="perfil.php">Mi Perfil</a>
        <a href="logout.php">Cerrar sesión</a>
    </nav>
</header>

<!-- Botón de administrador -->
<?php if($esAdmin): ?>
<div class="admin-boton">
    <a href="nuevo_lanzamiento.php" class="btn">➕ Añadir lanzamiento</a>
</div>
<?php endif; ?>

<!-- Barra de filtros -->
<div class="barra-filtros">
    <input type="text" id="buscarInput" placeholder="Buscar..." value="<?php echo htmlspecialchars($buscar); ?>">

    <select id="generoSelect">
        <option value="">Todos géneros</option>
        <?php foreach($generos_disponibles as $g): ?>
            <option value="<?php echo htmlspecialchars($g); ?>" <?php if($genero_filtro==$g) echo 'selected'; ?>><?php echo htmlspecialchars($g); ?></option>
        <?php endforeach; ?>
    </select>

    <select id="desarrolladoraSelect">
        <option value="">Todas compañías</option>
        <?php foreach($desarrolladoras_disponibles as $d): ?>
            <option value="<?php echo htmlspecialchars($d); ?>" <?php if($desarrolladora_filtro==$d) echo 'selected'; ?>><?php echo htmlspecialchars($d); ?></option>
        <?php endforeach; ?>
    </select>

    <div id="plataformasFiltro">
        <?php foreach($opcionesPlataforma as $p): 
            $clase = str_replace(' ','-',$p);
            $activo = ($plataforma_filtro==$p)?'opacity:1':'opacity:0.6';
        ?>
        <span class="plataforma-boton <?php echo $clase; ?>" style="<?php echo $activo; ?>" onclick="filtrarPlataforma('<?php echo $p; ?>')"><?php echo $p; ?></span>
        <?php endforeach; ?>
    </div>
</div>

<!-- Tabla de resultados -->
<table class="tabla-lanzamientos">
    <thead>
        <tr>
            <th>Título</th>
            <th>Plataforma</th>
            <th>Género</th>
            <th>Desarrolladora</th>
            <th>Fecha de lanzamiento</th>
            <th>Comprar</th>
        </tr>
    </thead>
    <tbody>
        <?php if($resultado): ?>
            <?php foreach($resultado as $juego): ?>
                <tr>
                    <!-- Título clicable que filtra por el nombre del juego -->
                    <td>
                        <a href="listar_articulos.php?buscar=<?php echo urlencode($juego['titulo']); ?>">
                            <?php echo htmlspecialchars($juego['titulo']); ?>
                        </a>
                    </td>
                    <td>
                        <?php
                        $plat = explode(',', $juego['plataforma']);
                        foreach($plat as $p){
                            $clase = str_replace(' ','-',$p);
                            echo "<a href='listar_articulos.php?plataforma=".urlencode($p)."' class='plataforma-boton $clase'>" . htmlspecialchars($p) . "</a> ";
                        }
                        ?>
                    </td>
                    <td><?php echo htmlspecialchars($juego['genero']); ?></td>
                    <td><?php echo htmlspecialchars($juego['desarrolladora']); ?></td>
                    <td><?php echo $juego['fecha_lanzamiento']; ?></td>
                    <td>
                        <?php if(!empty($juego['comprar'])): ?>
                            <a href="<?php echo htmlspecialchars($juego['comprar']); ?>" target="_blank" class="boton-comprar">Comprar</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">No se encontraron lanzamientos.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<div class="paginacion">
    <?php for($i=1;$i<=$total_paginas;$i++): ?>
        <?php if($i==$pagina): ?>
            <span class="actual"><?php echo $i; ?></span>
        <?php else: ?>
            <a href="?pagina=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>&plataforma=<?php echo urlencode($plataforma_filtro); ?>&genero=<?php echo urlencode($genero_filtro); ?>&desarrolladora=<?php echo urlencode($desarrolladora_filtro); ?>"><?php echo $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>
</div>

<script>
const buscarInput = document.getElementById('buscarInput');
const generoSelect = document.getElementById('generoSelect');
const desarrolladoraSelect = document.getElementById('desarrolladoraSelect');

function filtrarPlataforma(plataforma) {
    const url = new URL(window.location.href);
    if(url.searchParams.get('plataforma') === plataforma) {
        url.searchParams.delete('plataforma');
    } else {
        url.searchParams.set('plataforma', plataforma);
    }
    window.location.href = url.toString();
}

function aplicarFiltros() {
    const url = new URL(window.location.href);
    url.searchParams.set('buscar', buscarInput.value.trim());
    url.searchParams.set('genero', generoSelect.value);
    url.searchParams.set('desarrolladora', desarrolladoraSelect.value);
    window.location.href = url.toString();
}

buscarInput.addEventListener('keyup', ()=> setTimeout(aplicarFiltros,300));
generoSelect.addEventListener('change', aplicarFiltros);
desarrolladoraSelect.addEventListener('change', aplicarFiltros);
</script>

</body>
</html>
