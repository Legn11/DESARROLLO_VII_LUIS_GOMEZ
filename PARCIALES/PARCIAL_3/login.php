<?php
session_start();

$users = [
    'profesor' => ['password' => '12345', 'role' => 'profesor'],
    'estudiante' => ['password' => 'abcd', 'role' => 'estudiante']
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $error = '';

    if (!preg_match('/^[A-Za-z0-9]{3,}$/', $username)) {
        $error = "El nombre de usuario debe tener al menos 3 caracteres y solo contener letras y números.";
    }

    if (strlen($password) < 5) {
        $error = $error ? $error . "
La contraseña debe tener al menos 5 caracteres." : "La contraseña debe tener al menos 5 caracteres.";
    }

    if (empty($error)) {
        if (isset($users[$username]) && $users[$username]['password'] === $password) {
            $_SESSION['user'] = [
                'username' => $username,
                'role' => $users[$username]['role']
            ];
            if ($users[$username]['role'] === 'profesor') {
                header('Location: profesor.php');
            } else {
                header('Location: dashboard_estudiante.php');
            }
            exit();
        } else {
            $error = "Usuario o contraseña incorrectos";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <label>Usuario:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Contraseña:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Ingresar</button>
    </form>
</body>
</html>
