<?php
require_once "database.php";

$db = Database::getInstance()->getConnection();

if (!isset($_GET["id"]) || !ctype_digit($_GET["id"])) {
    die("ID inválido.");
}

$id = (int)$_GET["id"];

$stmt = $db->prepare("DELETE FROM productos WHERE id = :id");
$stmt->bindParam(":id", $id);

$stmt->execute();

header("Location: index.php");
exit;
