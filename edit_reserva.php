<?php 
include("config.php");

// Obtengo el ID de la reserva a editar
$reserva_id = $_GET['id'];

// Consulto los datos actuales de la reserva
$query = "SELECT * FROM tb_reservas WHERE r_id = '$reserva_id'";
$result = mysqli_query($mysqli, $query);
$row = mysqli_fetch_assoc($result);

// Consulto los escenarios y estados disponibles
$escenarios_query = "SELECT e_id, e_nombre FROM tb_escenarios";
$escenarios_result = mysqli_query($mysqli, $escenarios_query);

$estados_query = "SELECT DISTINCT r_estado FROM tb_reservas";
$estados_result = mysqli_query($mysqli, $estados_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css" />
    <title>Editar Reserva</title>
</head>
<body>
    <!-- Creamos un menu -->
    <div class="icon-bar">
        <a href="inicio.php"><i class="fa fa-home"></i></a>
        <a href="reservas.php"><i class="fa fa-calendar"></i></a>
    </div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <h2>Editar Reserva</h2>
    <hr>
    <!-- Creo un formulario para editar los datos -->
    <form action="update_reserva.php" method="POST">
        <input type="hidden" name="r_id" value="<?php echo $row['r_id']; ?>">

        <label for="r_usuario_id">Usuario ID:</label>
        <input type="text" id="r_usuario_id" name="r_usuario_id" value="<?php echo $row['r_usuario_id']; ?>" required><br>

        <label for="r_escenario_id">Escenario:</label>
        <select id="r_escenario_id" name="r_escenario_id" required>
            <?php while ($escenario = mysqli_fetch_assoc($escenarios_result)): ?>
                <option value="<?php echo $escenario['e_id']; ?>" <?php echo ($row['r_escenario_id'] == $escenario['e_id']) ? 'selected' : ''; ?>>
                    <?php echo $escenario['e_nombre']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="r_fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="r_fecha_inicio" name="r_fecha_inicio" value="<?php echo $row['r_fecha_inicio']; ?>" required><br>

        <label for="r_fecha_fin">Fecha Fin:</label>
        <input type="date" id="r_fecha_fin" name="r_fecha_fin" value="<?php echo $row['r_fecha_fin']; ?>" required><br>

        <label for="r_costo_total">Costo Total:</label>
        <input type="number" step="0.01" id="r_costo_total" name="r_costo_total" value="<?php echo $row['r_costo_total']; ?>" readonly><br>

        <label for="r_estado">Estado:</label>
        <select id="r_estado" name="r_estado" required>
            <?php while ($estado = mysqli_fetch_assoc($estados_result)): ?>
                <option value="<?php echo $estado['r_estado']; ?>" <?php echo ($row['r_estado'] == $estado['r_estado']) ? 'selected' : ''; ?>>
                    <?php echo $estado['r_estado']; ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="r_contacto_nombre">Nombre de Contacto:</label>
        <input type="text" id="r_contacto_nombre" name="r_contacto_nombre" value="<?php echo $row['r_contacto_nombre']; ?>"><br>

        <label for="r_contacto_correo">Correo de Contacto:</label>
        <input type="email" id="r_contacto_correo" name="r_contacto_correo" value="<?php echo $row['r_contacto_correo']; ?>"><br>

        <label for="r_contacto_apellidos">Apellidos de Contacto:</label>
        <input type="text" id="r_contacto_apellidos" name="r_contacto_apellidos" value="<?php echo $row['r_contacto_apellidos']; ?>"><br>

        <div class="clearfix">
            <button type="submit" class="signupbtn">Actualizar</button>
        </div>
    </form>
</body>
</html>
