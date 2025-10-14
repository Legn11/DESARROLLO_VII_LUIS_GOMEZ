<?php
session_start();

// Si se solicita eliminar un producto
if (isset($_GET["eliminar"])) {
    $id = $_GET["eliminar"];
    if (isset($_SESSION["carrito"][$id])) {
        unset($_SESSION["carrito"][$id]);
    }
    header("Location: ver_carrito.php"); // evita reenvío al actualizar
    exit;
}

// Verificamos si el carrito existe
$carrito = isset($_SESSION["carrito"]) ? $_SESSION["carrito"] : [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito de Compras</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background-color: #f7f7f7;
        }
        h1, h2 {
            color: #333;
        }
        table {
            width: 70%;
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
            margin-right: 10px;
        }
        a.boton:hover {
            background-color: #45a049;
        }
        a.eliminar {
            background-color: #e74c3c;
            color: white;
            padding: 5px 8px;
            border-radius: 4px;
            text-decoration: none;
        }
        a.eliminar:hover {
            background-color: #c0392b;
        }
        .acciones {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h1>🛒 Carrito de Compras</h1>

<?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío.</p>
    <a class="boton" href="productos.php">Volver a productos</a>
<?php else: ?>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
            <th>Subtotal</th>
            <th>Acción</th>
        </tr>

        <?php 
        $total = 0;
        foreach ($carrito as $id => $item):
            $subtotal = $item["precio"] * $item["cantidad"];
            $total += $subtotal;
        ?>
        <tr>
            <td><?php echo htmlspecialchars($item["nombre"]); ?></td>
            <td><?php echo $item["cantidad"]; ?></td>
            <td>$<?php echo number_format($item["precio"], 2); ?></td>
            <td>$<?php echo number_format($subtotal, 2); ?></td>
            <td><a class="eliminar" href="ver_carrito.php?eliminar=<?php echo $id; ?>">🗑 Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <h2>Total a pagar: $<?php echo number_format($total, 2); ?></h2>

    <div class="acciones">
        <a class="boton" href="productos.php">Seguir comprando</a>
        <a class="boton" href="#">Vaciar carrito</a>
        <a class="boton" href="checkout.php">Finalizar compra</a>
    </div>
<?php endif; ?>

</body>
</html>
