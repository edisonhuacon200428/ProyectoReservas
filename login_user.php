<?php 
include("config.php");

// Obtengo los datos del formulario
$u_email = $_POST['u_email'];
$u_contrasena = $_POST['u_contrasena'];

// Consulto los datos del usuario
$query = "SELECT * FROM tb_usuarios WHERE u_email = '$u_email'";
$result = mysqli_query($mysqli, $query);
$user = mysqli_fetch_assoc($result);

if ($user && password_verify($u_contrasena, $user['u_contrasena'])) {
    // Inicio sesión del usuario
    session_start();
    $_SESSION['user_id'] = $user['u_id'];
    $_SESSION['user_name'] = $user['u_nombre'];
    $_SESSION['user_role'] = $user['u_rol'];
    
    echo '<script language="javascript">';
    echo 'alert("Inicio de sesión exitoso");';
    echo 'window.location="reservas.php";';
    echo '</script>';  
} else {
    echo '<script language="javascript">';
    echo 'alert("Correo electrónico o contraseña incorrectos");';
    echo 'window.location="login.php";';
    echo '</script>';
}
?>
