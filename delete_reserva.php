<?php 
include("config.php");

// Obtengo el ID de la reserva a eliminar
$reserva_id = $_GET['id'];

// Preparo la consulta SQL para eliminar la reserva
$sql = "DELETE FROM tb_reservas WHERE r_id = '$reserva_id'";

if(mysqli_query($mysqli, $sql)){
    echo '<script language="javascript">';
    echo 'alert("Eliminado");';
    echo 'window.location="reservas.php";';
    echo '</script>';  
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($mysqli);
}
?>
