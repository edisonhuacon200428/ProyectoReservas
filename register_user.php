<?php 
include("config.php");

// Obtengo los datos del formulario
$u_nombre = $_POST['u_nombre'];
$u_email = $_POST['u_email'];
$u_contrasena = password_hash($_POST['u_contrasena'], PASSWORD_BCRYPT); // Hasheo la contraseña
$u_rol = $_POST['u_rol'];

// Preparo la consulta SQL
$sql = "INSERT INTO tb_usuarios (u_nombre, u_email, u_contrasena, u_rol) VALUES ('$u_nombre', '$u_email', '$u_contrasena', '$u_rol')";

if(mysqli_query($mysqli, $sql)){
    echo '<script language="javascript">';
    echo 'alert("Registro exitoso");';
    echo 'window.location="login.php";';
    echo '</script>';  
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}
?>
