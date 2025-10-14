<?php
session_start();

// Si el carrito no existe o está vacío, redirigir a productos
if (!isset($_SESSION["carrito"]) || empty($_SESSION["carrito"])) {
    header("Location: productos.php");
    exit;
}

// Calcular total
$carrito = $_SESSION["carrito"];
$total = 0;
foreach ($carrito as $item) {
    $total += $item["precio"] * $item["cantidad"];
}

// Si el usuario confirma la compra
if (isset($_POST["confirmar"])) {
    // Guardamos resumen antes de vaciar
    $resumen = $carrito;
    $monto_final = $total;

    // Vaciar el carrito
    unset($_SESSION["carrito"]);

    // Mostrar página de confirmación
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Compra confirmada</title>
        <style>
            body { font-family: Arial, sans-serif; margin: 40px; background-color: #f7f7f7; }
            h1 { color: #2ecc71; }
            table {
                width: 70%;
                border-collapse: collapse;
                background-color: #fff;
                box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            }
            th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
            th { background-color: #4CAF50; color: white; }
            .boton { background-color: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; }
            .boton:hover { background-color: #45a049; }
        </style>
    </head>
    <body>
        <h1>✅ ¡Gracias por tu compra!</h1>
        <p>Tu pedido ha sido procesado correctamente. A continuación el resumen:</p>

        <table>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
            <?php foreach ($resumen as $item): ?>
                <tr>
                    <td><?php echo htmlspecialchars($item["nombre"]); ?></td>
                    <td><?php echo $item["cantidad"]; ?></td>
                    <td>$<?php echo number_format($item["precio"], 2); ?></td>
                    <td>$<?php echo number_format($item["precio"] * $item["cantidad"], 2); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <h2>Total pagado: $<?php echo number_format($monto_final, 2); ?></h2>
        <a class="boton" href="productos.php">Volver a la tienda</a>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #f7f7f7; }
        h1, h2 { color: #333; }
        table {
            width: 70%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        th, td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .boton { background-color: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; }
        .boton:hover { background-color: #45a049; }
        .form-boton { background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        .form-boton:hover { background-color: #45a049; }
    </style>
</head>
<body>

<h1>🧾 Resumen de tu compra</h1>

<table>
    <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Precio Unitario</th>
        <th>Subtotal</th>
    </tr>
    <?php foreach ($carrito as $item): ?>
        <tr>
            <td><?php echo htmlspecialchars($item["nombre"]); ?></td>
            <td><?php echo $item["cantidad"]; ?></td>
            <td>$<?php echo number_format($item["precio"], 2); ?></td>
            <td>$<?php echo number_format($item["precio"] * $item["cantidad"], 2); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Total a pagar: $<?php echo number_format($total, 2); ?></h2>

<form method="POST">
    <button type="submit" name="confirmar" class="form-boton">Confirmar compra</button>
    <a href="ver_carrito.php" class="boton">Volver al carrito</a>
</form>

</body>
</html>
