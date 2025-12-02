<?php
require_once "database.php";

$db = Database::getInstance()->getConnection();

$errores = [];
$nombre = "";
$categoria = "";
$precio = "";
$cantidad = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"] ?? "");
    $categoria = trim($_POST["categoria"] ?? "");
    $precio = $_POST["precio"] ?? "";
    $cantidad = $_POST["cantidad"] ?? "";

    if ($nombre === "") {
        $errores[] = "El nombre es obligatorio.";
    }
    if ($categoria === "") {
        $errores[] = "La categoría es obligatoria.";
    }
    if ($precio === "" || !is_numeric($precio) || $precio < 0) {
        $errores[] = "El precio debe ser un número válido.";
    }
    if ($cantidad === "" || !ctype_digit($cantidad)) {
        $errores[] = "La cantidad debe ser un número entero.";
    }

    if (empty($errores)) {

        $sql = "INSERT INTO productos (nombre, categoria, precio, cantidad)
                VALUES (:nombre, :categoria, :precio, :cantidad)";
        
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':categoria', $categoria);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':cantidad', $cantidad);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $errores[] = "Error al registrar el producto.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Producto</title>
</head>
<body>

<h2>Registrar Producto</h2>

<a href="index.php">⬅ Volver al listado</a>
<br><br>

<?php if (!empty($errores)): ?>
    <ul style="color: red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form action="" method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>"><br><br>

    <label>Categoría:</label><br>
    <input type="text" name="categoria" value="<?= htmlspecialchars($categoria) ?>"><br><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($precio) ?>"><br><br>

    <label>Cantidad:</label><br>
    <input type="number" name="cantidad" value="<?= htmlspecialchars($cantidad) ?>"><br><br>

    <button type="submit">Guardar Producto</button>
</form>

</body>
</html>
