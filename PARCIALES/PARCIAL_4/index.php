<?php
require_once "database.php";

$db = Database::getInstance()->getConnection();

// Obtener todos los productos
$query = $db->query("SELECT * FROM productos ORDER BY id DESC");
$productos = $query->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Productos - TechParts</title>
    <style>
        table {
            width: 70%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #555;
            padding: 8px;
        }
        th {
            background: #ddd;
        }
        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>
<body>

<h2>Listado de Productos</h2>

<a href="registrar.php"> Registrar nuevo producto</a>
<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Fecha Registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($productos) > 0): ?>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><?= htmlspecialchars($p['categoria']) ?></td>
                    <td>$<?= number_format($p['precio'], 2) ?></td>
                    <td><?= $p['cantidad'] ?></td>
                    <td><?= $p['fecha_registro'] ?></td>
                    <td>
                        <a href="editar.php?id=<?= $p['id'] ?>">Editar</a> |
                        <a href="eliminar.php?id=<?= $p['id'] ?>" onclick="return confirm('¿Eliminar producto?')">
                            Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="7">No hay productos registrados.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
