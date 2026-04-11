<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    echo "<p>Debes iniciar sesión para ver esta sección.</p>";
    exit;
}

require 'db.php';

// Orden dinámico
$criterio = $_GET['criterio'] ?? 'fecha_lanzamiento';
$direccion = $_GET['direccion'] ?? 'ASC';
if (!in_array($criterio, ['fecha_lanzamiento','titulo'])) $criterio = 'fecha_lanzamiento';
if (!in_array($direccion, ['ASC','DESC'])) $direccion = 'ASC';

// Búsqueda
$buscar = $_GET['buscar'] ?? '';

// Paginación
$pagina = max(1, (int)($_GET['pagina'] ?? 1));
$por_pagina = 10;
$offset = ($pagina - 1) * $por_pagina;

// Conteo total
$total_stmt = $conexion->prepare("SELECT COUNT(*) FROM lanzamientos WHERE titulo LIKE :buscar");
$total_stmt->execute([':buscar' => "%$buscar%"]);
$total = $total_stmt->fetchColumn();
$total_paginas = ceil($total / $por_pagina);

// Consulta principal
$sql = "SELECT * FROM lanzamientos WHERE titulo LIKE :buscar ORDER BY $criterio $direccion LIMIT :offset, :por_pagina";
$stmt = $conexion->prepare($sql);
$stmt->bindValue(':buscar', "%$buscar%", PDO::PARAM_STR);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':por_pagina', $por_pagina, PDO::PARAM_INT);
$stmt->execute();
$resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Lanzamientos</title>
<link rel="stylesheet" href="estilos.css">
<style>
/* Tabla y botones coherentes */
.tabla-lanzamientos {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.tabla-lanzamientos th, .tabla-lanzamientos td {
    border: 1px solid #ccc;
    padding: 8px;
    text-align: left;
}

.tabla-lanzamientos th {
    background-color: #f0f0f0;
}

.btn-compra, .btn-editar, .btn-eliminar {
    display: inline-block;
    padding: 4px 8px;
    margin: 2px;
    border-radius: 4px;
    text-decoration: none;
    font-size: 0.9em;
}

.btn-compra { background-color: #28a745; color: #fff; }
.btn-editar { background-color: #ffc107; color: #000; }
.btn-eliminar { background-color: #dc3545; color: #fff; }

/* Paginación */
.paginacion {
    margin-top: 15px;
}

.paginacion a {
    margin: 0 3px;
    text-decoration: none;
    padding: 4px 8px;
    background-color: #eee;
    border-radius: 4px;
    color: #000;
}

.paginacion a.active {
    background-color: #007bff;
    color: #fff;
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

<div class="barra-filtros">
    <input type="text" id="buscarInput" placeholder="Buscar por título..." value="<?php echo htmlspecialchars($buscar); ?>">
</div>

<table class="tabla-lanzamientos">
    <thead>
        <tr>
            <th><a href="?criterio=titulo&direccion=<?php echo $criterio=='titulo' && $direccion=='ASC'?'DESC':'ASC'; ?>">Título</a></th>
            <th>Plataforma</th>
            <th>Género</th>
            <th>Desarrolladora</th>
            <th><a href="?criterio=fecha_lanzamiento&direccion=<?php echo $criterio=='fecha_lanzamiento' && $direccion=='ASC'?'DESC':'ASC'; ?>">Fecha lanzamiento</a></th>
            <th>Comprar</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($resultado as $lanzamiento): ?>
        <tr>
            <td><?php echo htmlspecialchars($lanzamiento['titulo']); ?></td>
            <td><?php echo htmlspecialchars($lanzamiento['plataforma']); ?></td>
            <td><?php echo htmlspecialchars($lanzamiento['genero']); ?></td>
            <td><?php echo htmlspecialchars($lanzamiento['desarrolladora']); ?></td>
            <td><?php echo htmlspecialchars($lanzamiento['fecha_lanzamiento']); ?></td>
            <td>
                <?php if(!empty($lanzamiento['comprar'])): ?>
                    <a href="<?php echo htmlspecialchars($lanzamiento['comprar']); ?>" target="_blank" class="btn-compra">Comprar</a>
                <?php endif; ?>
            </td>
            <td>
                <a href="editar_lanzamiento.php?id=<?php echo $lanzamiento['id']; ?>" class="btn-editar">Editar</a>
                <a href="eliminar_lanzamiento.php?id=<?php echo $lanzamiento['id']; ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este lanzamiento?')">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div class="paginacion">
    <?php for($i=1;$i<=$total_paginas;$i++): ?>
        <a href="?pagina=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>" class="<?php echo $i==$pagina?'active':''; ?>"><?php echo $i; ?></a>
    <?php endfor; ?>
</div>

<script>
const buscarInput = document.getElementById('buscarInput');
buscarInput.addEventListener('keyup', () => {
    setTimeout(() => {
        const params = new URLSearchParams();
        params.set('buscar', buscarInput.value.trim());
        window.location.href = "listar_lanzamientos.php?" + params.toString();
    }, 300);
});
</script>

</body>
</html>
