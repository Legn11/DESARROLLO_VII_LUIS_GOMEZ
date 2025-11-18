<?php
session_start();

// Validar que el usuario esté autenticado y sea profesor
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'profesor') {
    header('Location: index.php');
    exit();
}

// Lista de estudiantes
$estudiantes = [
    ["nombre" => "Juan Pérez", "calificacion" => 88],
    ["nombre" => "María Gómez", "calificacion" => 92],
    ["nombre" => "Carlos Díaz", "calificacion" => 75],
    ["nombre" => "Ana Torres", "calificacion" => 85]
];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard del Profesor</title>
</head>
<body>
    <h2>Bienvenido, Profesor <?php echo ucfirst($_SESSION['user']['username']); ?></h2>
    <h3>Listado de Estudiantes y Calificaciones</h3>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Nombre del Estudiante</th>
            <th>Calificación</th>
        </tr>

        <?php foreach ($estudiantes as $est) : ?>
            <tr>
                <td><?php echo $est['nombre']; ?></td>
                <td><?php echo $est['calificacion']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>