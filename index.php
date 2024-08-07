<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Redirigir a la página de reservas si el usuario está autenticado
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Inicio</title>
</head>
<body>
    <div class="icon-bar">
        <a href="login.php"><i class="fa fa-sign-in"></i></a>
    </div>
    <h2>Bienvenido a la Plataforma</h2>
    <hr>
    <p>Por favor, <a href="login.php">inicia sesión</a> o <a href="register.php">regístrate</a> para acceder a las reservas.</p>
</body>
</html>
