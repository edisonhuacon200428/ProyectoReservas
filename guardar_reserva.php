<?php
include("config.php");

// Obtener datos del formulario
$usuario = $_POST['usuario'];
$escenarioTipo = $_POST['escenario_tipo'];
$escenarioId = $escenarioTipo === 'disponible' ? $_POST['escenario'] : null;
$escenarioTitulo = $_POST['escenario_titulo'] ?? null;
$escenarioDescripcion = $_POST['escenario_descripcion'] ?? null;
$escenarioUbicacion = $_POST['escenario_ubicacion'] ?? null;
$escenarioCategoria = $_POST['escenario_categoria'] ?? null;
$fechaInicio = $_POST['escenario_fecha_inicio'];
$fechaFin = $_POST['escenario_fecha_fin'];
$equipos = $_POST['equipos'] ?? [];
$cantidadEquipos = $_POST['cantidad_equipos'] ?? [];
$contactoNombre = $_POST['contacto_nombre'];
$contactoCorreo = $_POST['contacto_correo'];
$contactoApellidos = $_POST['contacto_apellidos'];

// Consultar precio del escenario seleccionado
$precioEscenario = 0;
if ($escenarioTipo === 'disponible' && $escenarioId) {
    $query = "SELECT e_precio_por_hora FROM tb_escenarios WHERE e_id = $escenarioId";
    $result = mysqli_query($mysqli, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $precioEscenario = $row['e_precio_por_hora'];
    }
}

// Calcular el costo total
$totalCosto = $precioEscenario;
foreach ($equipos as $index => $equipoId) {
    $cantidad = $cantidadEquipos[$index] ?? 1; // Default cantidad a 1
    $query = "SELECT eq_precio_por_hora FROM tb_equipos WHERE eq_id = $equipoId";
    $result = mysqli_query($mysqli, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $totalCosto += $row['eq_precio_por_hora'] * $cantidad;
    }
}

// Insertar la reserva en la base de datos
$query = "INSERT INTO tb_reservas (r_usuario_id, r_escenario_id, r_fecha_inicio, r_fecha_fin, r_costo_total, r_estado) VALUES (?, ?, ?, ?, ?, 'pendiente')";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('iissd', $usuario, $escenarioId, $fechaInicio, $fechaFin, $totalCosto);
$stmt->execute();
$reservaId = $stmt->insert_id;

// Insertar equipos reservados
foreach ($equipos as $index => $equipoId) {
    $cantidad = $cantidadEquipos[$index] ?? 1; // Default cantidad a 1
    $query = "INSERT INTO tb_reservas_equipos (re_reserva_id, re_equipo_id, re_cantidad) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('iii', $reservaId, $equipoId, $cantidad);
    $stmt->execute();
}

// Aquí puedes manejar los datos personalizados del escenario si es necesario

// Mostrar confirmación o redirigir al usuario
echo "Reserva guardada exitosamente.";

?>
