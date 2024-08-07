<?php 
include("config.php");

// Obtengo los datos del formulario
$r_id = $_POST['r_id'];
$r_usuario_id = $_POST['r_usuario_id'];
$r_escenario_id = $_POST['r_escenario_id'];
$r_fecha_inicio = $_POST['r_fecha_inicio'];
$r_fecha_fin = $_POST['r_fecha_fin'];
$r_costo_total = $_POST['r_costo_total'];
$r_estado = $_POST['r_estado'];
$r_contacto_nombre = $_POST['r_contacto_nombre'];
$r_contacto_correo = $_POST['r_contacto_correo'];
$r_contacto_apellidos = $_POST['r_contacto_apellidos'];

// Preparo la consulta SQL
$sql = "UPDATE tb_reservas SET
    r_usuario_id = '$r_usuario_id',
    r_escenario_id = '$r_escenario_id',
    r_fecha_inicio = '$r_fecha_inicio',
    r_fecha_fin = '$r_fecha_fin',
    r_costo_total = '$r_costo_total',
    r_estado = '$r_estado',
    r_contacto_nombre = '$r_contacto_nombre',
    r_contacto_correo = '$r_contacto_correo',
    r_contacto_apellidos = '$r_contacto_apellidos'
WHERE r_id = '$r_id'";

if(mysqli_query($mysqli, $sql)){
    echo '<script language="javascript">';
    echo 'alert("Actualizado");';
    echo 'window.location="reservas.php";';
    echo '</script>';  
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}
?>
