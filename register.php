<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Registro</title>
</head>
<body>
    <!-- Creamos un menu -->
    <div class="icon-bar">
        <a href="login.php"><i class="fa fa-sign-in"></i></a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>Registro de Usuario</h2>
    <hr>
    <!-- Formulario de Registro -->
    <form action="register_user.php" method="POST">
        <div class="container">
            <label for="u_nombre">Nombre:</label>
            <input type="text" id="u_nombre" name="u_nombre" required><br>

            <label for="u_email">Correo Electrónico:</label>
            <input type="email" id="u_email" name="u_email" required><br>

            <label for="u_contrasena">Contraseña:</label>
            <input type="password" id="u_contrasena" name="u_contrasena" required><br>

            <label for="u_rol">Rol:</label>
            <input type="text" id="u_rol" name="u_rol" required><br>

            <div class="clearfix">
                <button type="submit" class="signupbtn">Registrar</button>
            </div>
        </div>
    </form>
</body>
</html>
