<?php
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'estudiante') {
    header('Location: login.php');
    exit();
}

include 'calificaciones.php';

$usuarioActual = $_SESSION['user']['username'];
$notasEstudiante = $calificaciones[$usuarioActual] ?? [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard del Estudiante</title>
</head>
<body>
    <h2>Bienvenido, <?php echo ucfirst($usuarioActual); ?></h2>
    <h3>Mis Calificaciones</h3>

    <?php if (empty($notasEstudiante)) : ?>
        <p>No hay calificaciones registradas.</p>
    <?php else : ?>
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Materia</th>
                <th>Calificación</th>
            </tr>

            <?php foreach ($notasEstudiante as $nota) : ?>
                <tr>
                    <td><?php echo $nota['materia']; ?></td>
                    <td><?php echo $nota['nota']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
