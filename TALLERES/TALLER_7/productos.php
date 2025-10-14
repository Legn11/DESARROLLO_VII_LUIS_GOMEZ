<?php
session_start();

// Lista de productos
$productos = [
    1 => ["nombre" => "Laptop HP Pavilion", "precio" => 850.00],
    2 => ["nombre" => "Mouse inalámbrico Logitech", "precio" => 25.99],
    3 => ["nombre" => "Teclado mecánico Redragon", "precio" => 65.50],
    4 => ["nombre" => "Monitor Samsung 24\"", "precio" => 175.00],
    5 => ["nombre" => "Disco SSD Kingston 480GB", "precio" => 55.00]
];

// Inicializar el carrito si no existe
if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = [];
}

// Si se envía un producto por GET, lo añadimos al carrito
if (isset($_GET["agregar"])) {
    $id = $_GET["agregar"];
    if (isset($productos[$id])) {
        if (isset($_SESSION["carrito"][$id])) {
            $_SESSION["carrito"][$id]["cantidad"]++;
        } else {
            $_SESSION["carrito"][$id] = [
                "nombre" => $productos[$id]["nombre"],
                "precio" => $productos[$id]["precio"],
                "cantidad" => 1
            ];
        }
    }
    header("Location: productos.php"); // Evita reenvíos al refrescar
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f7f7f7;
        }
        h1 {
            color: #333;
        }
        table {
            width: 60%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a.boton {
            background-color: #4CAF50;
            color: white;
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
        a.boton:hover {
            background-color: #45a049;
        }
        .ver-carrito {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>Lista de Productos</h1>

<table>
    <tr>
        <th>Producto</th>
        <th>Precio</th>
        <th>Acción</th>
    </tr>
    <?php foreach ($productos as $id => $producto): ?>
        <tr>
            <td><?php echo htmlspecialchars($producto["nombre"]); ?></td>
            <td>$<?php echo number_format($producto["precio"], 2); ?></td>
            <td><a class="boton" href="productos.php?agregar=<?php echo $id; ?>">Añadir al carrito</a></td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="ver-carrito">
    <a class="boton" href="ver_carrito.php">🛒 Ver carrito</a>
</div>

</body>
</html>
