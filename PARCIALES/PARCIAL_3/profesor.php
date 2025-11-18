<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'profesor') {
    header('Location: login.php');
    exit();
}

include 'calificaciones.php';
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
            <th>Estudiante</th>
            <th>Materia</th>
            <th>Calificación</th>
        </tr>

        <?php foreach ($calificaciones as $nombreEstudiante => $materias) : ?>
            <?php foreach ($materias as $materiaInfo) : ?>
                <tr>
                    <td><?php echo ucfirst($nombreEstudiante); ?></td>
                    <td><?php echo $materiaInfo['materia']; ?></td>
                    <td><?php echo $materiaInfo['nota']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
