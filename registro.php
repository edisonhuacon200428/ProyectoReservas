<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva</title>
    <link rel="stylesheet" type="text/css" href="css/mystyle1.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="email"], select, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
        }
        .submit-btn:hover {
            background-color: #45a049;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Formulario de Reserva</h1>
        <form action="guardar_reserva.php" method="post">
            <!-- Información del Usuario -->
            <label for="usuario">ID de Usuario:</label>
            <input type="number" id="usuario" name="usuario" required>

            <!-- Tipo de Escenario -->
            <label for="escenario_tipo">Tipo de Escenario:</label>
            <select id="escenario_tipo" name="escenario_tipo" onchange="mostrarCampos(this.value)" required>
                <option value="disponible">Disponible</option>
                <option value="personalizado">Personalizado</option>
            </select>

            <!-- Escenario Disponible -->
            <div id="escenario_disponible" class="hidden">
                <label for="escenario">Selecciona Escenario:</label>
                <select id="escenario" name="escenario">
                    <?php
                    include("config.php");
                    $query = "SELECT e_id, e_nombre FROM tb_escenarios";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['e_id']}'>{$row['e_nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Escenario Personalizado -->
            <div id="escenario_personalizado" class="hidden">
                <label for="escenario_titulo">Título:</label>
                <input type="text" id="escenario_titulo" name="escenario_titulo">
                <label for="escenario_descripcion">Descripción:</label>
                <textarea id="escenario_descripcion" name="escenario_descripcion"></textarea>
                <label for="escenario_ubicacion">Ubicación:</label>
                <input type="text" id="escenario_ubicacion" name="escenario_ubicacion">
                <label for="escenario_categoria">Categoría:</label>
                <select id="escenario_categoria" name="escenario_categoria">
                    <?php
                    $query = "SELECT c_id, c_nombre FROM tb_categorias";
                    $result = $mysqli->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['c_id']}'>{$row['c_nombre']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Fechas -->
            <label for="escenario_fecha_inicio">Fecha de Inicio:</label>
            <input type="date" id="escenario_fecha_inicio" name="escenario_fecha_inicio" required>
            <label for="escenario_fecha_fin">Fecha de Fin:</label>
            <input type="date" id="escenario_fecha_fin" name="escenario_fecha_fin" required>

            <!-- Equipos -->
            <label for="equipos">Selecciona Equipos:</label>
            <select id="equipos" name="equipos[]" multiple>
                <?php
                $query = "SELECT eq_id, eq_nombre FROM tb_equipos";
                $result = $mysqli->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['eq_id']}'>{$row['eq_nombre']}</option>";
                }
                ?>
            </select>
            <label for="cantidad_equipos">Cantidad de Equipos (separados por comas):</label>
            <input type="text" id="cantidad_equipos" name="cantidad_equipos">

            <!-- Datos de Contacto -->
            <label for="contacto_nombre">Nombre de Contacto:</label>
            <input type="text" id="contacto_nombre" name="contacto_nombre" required>
            <label for="contacto_correo">Correo de Contacto:</label>
            <input type="email" id="contacto_correo" name="contacto_correo" required>
            <label for="contacto_apellidos">Apellidos de Contacto:</label>
            <input type="text" id="contacto_apellidos" name="contacto_apellidos" required>

            <input type="submit" value="Guardar Reserva" class="submit-btn">
        </form>
    </div>

    <script>
        function mostrarCampos(tipo) {
            if (tipo === 'disponible') {
                document.getElementById('escenario_disponible').style.display = 'block';
                document.getElementById('escenario_personalizado').style.display = 'none';
            } else {
                document.getElementById('escenario_disponible').style.display = 'none';
                document.getElementById('escenario_personalizado').style.display = 'block';
            }
        }
    </script>
</body>
</html>
