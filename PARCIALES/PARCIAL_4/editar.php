<?php
require_once "database.php";

$db = Database::getInstance()->getConnection();

$errores = [];

if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
    die("ID inválido.");
}

$id = (int)$_GET["id"];

$stmt = $db->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->bindParam(":id", $id);
$stmt->execute();
$producto = $stmt->fetch();

if (!$producto) {
    die("Producto no encontrado.");
}

$nombre = $producto["nombre"];
$categoria = $producto["categoria"];
$precio = $producto["precio"];
$cantidad = $producto["cantidad"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $categoria = trim($_POST["categoria"]);
    $precio = $_POST["precio"];
    $cantidad = $_POST["cantidad"];

    if ($nombre === "") $errores[] = "El nombre es obligatorio.";
    if ($categoria === "") $errores[] = "La categoría es obligatoria.";
    if ($precio === "" || !is_numeric($precio)) $errores[] = "Precio inválido.";
    if ($cantidad === "" || !ctype_digit($cantidad)) $errores[] = "Cantidad inválida.";

    if (empty($errores)) {
        $sql = "UPDATE productos
                SET nombre = :nombre, categoria = :categoria, precio = :precio, cantidad = :cantidad
                WHERE id = :id";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":categoria", $categoria);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":cantidad", $cantidad);
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            $errores[] = "Error al actualizar el producto.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
</head>
<body>

<h2>Editar Producto</h2>
<a href="index.php">⬅ Volver</a><br><br>

<?php if (!empty($errores)): ?>
    <ul style="color: red;">
        <?php foreach ($errores as $e): ?>
            <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($nombre) ?>"><br><br>

    <label>Categoría:</label><br>
    <input type="text" name="categoria" value="<?= htmlspecialchars($categoria) ?>"><br><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($precio) ?>"><br><br>

    <label>Cantidad:</label><br>
    <input type="number" name="cantidad" value="<?= htmlspecialchars($cantidad) ?>"><br><br>

    <button type="submit">Guardar Cambios</button>
</form>

</body>
</html>
