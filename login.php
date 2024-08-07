<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Iniciar Sesión</title>
</head>
<body>
    <!-- Creamos un menu -->
    <div class="icon-bar">
        <a href="register.php"><i class="fa fa-user-plus"></i></a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>Iniciar Sesión</h2>
    <hr>
    <!-- Formulario de Inicio de Sesión -->
    <form action="login_user.php" method="POST">
        <div class="container">
            <label for="u_email">Correo Electrónico:</label>
            <input type="email" id="u_email" name="u_email" required><br>

            <label for="u_contrasena">Contraseña:</label>
            <input type="password" id="u_contrasena" name="u_contrasena" required><br>

            <div class="clearfix">
                <button type="submit" class="signupbtn">Iniciar Sesión</button>
            </div>
        </div>
    </form>
</body>
</html>
