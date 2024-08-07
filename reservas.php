<?php
include("config.php");

// Hago el query con el SELECT
$query = "
    SELECT 
        r.r_id, 
        u.u_nombre AS usuario, 
        e.e_nombre AS escenario, 
        r.r_fecha_inicio, 
        r.r_fecha_fin, 
        r.r_costo_total, 
        r.r_estado 
    FROM tb_reservas r
    JOIN tb_usuarios u ON r.r_usuario_id = u.u_id
    JOIN tb_escenarios e ON r.r_escenario_id = e.e_id
";
$result = mysqli_query($mysqli, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Reservas</title>
</head>

<body>
    <!-- Creamos un menu -->
    <div class="icon-bar">
        <a href="registro.php"><i class="fa fa-registered"></i></a>
        <a href="logout.php"><i class="fa fa-sign-out"></i></a>

    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <h2>Reservas</h2>
    <hr>
    <div class="container">
        <!-- Creo la tabla para presentar las reservas de la base de datos -->
        <?php
        echo "<table border='1'>
        <tr>
            <th>ID Reserva</th>
            <th>Usuario</th>
            <th>Escenario</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Costo Total</th>
            <th>Estado</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>";
        while ($row = mysqli_fetch_array($result)) {
            // Recorro cada uno del array y lo voy presentando
            echo "<tr>";
            echo "<td>" . $row['r_id'] . "</td>";
            echo "<td>" . $row['usuario'] . "</td>";
            echo "<td>" . $row['escenario'] . "</td>";
            echo "<td>" . $row['r_fecha_inicio'] . "</td>";
            echo "<td>" . $row['r_fecha_fin'] . "</td>";
            echo "<td>" . $row['r_costo_total'] . "</td>";
            echo "<td>" . $row['r_estado'] . "</td>";
            echo "<td><a href='edit_reserva.php?id=" . $row['r_id'] . "'><img src='./images/icons8-Edit-32.png' alt='Edit'></a></td>";
            echo "<td><a href='delete_reserva.php?id=" . $row['r_id'] . "'><img src='./images/icons8-Trash-32.png' alt='Delete'></a></td>";
            echo "</tr>";
        }
        echo "</table>";
        // Fin de la tabla
        ?>
    </div>
</body>

</html>
