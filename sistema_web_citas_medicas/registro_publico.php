
<?php
// registro_publico.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de citas médicas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f6fa;
            margin: 0;
            padding: 20px;
        }

        .contenedor {
            max-width: 650px;
            margin: 20px auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 12px #00000018;
        }

        h1 {
            text-align: center;
            color: #176b87;
        }

        label {
            display: block;
            margin-top: 14px;
            font-weight: bold;
        }

        input, select, button {
            width: 100%;
            padding: 11px;
            margin-top: 6px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 22px;
            background: #176b87;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #105269;
        }

        .aviso {
            font-size: 13px;
            color: #555;
            line-height: 1.5;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h1>Solicitud de cita médica ON LINE</h1>

    <p>Complete sus datos para solicitar una cita.</p>

    <form action="guardar_registro_publico.php" method="POST">
        <label for="especialidad">Especialidad:</label>
        <select id="especialidad" name="especialidad" required>
            <option value="">Seleccione una especialidad</option>
            <option value="Medicina General">Medicina General</option>
            <option value="Pediatría">Pediatría</option>
            <option value="Cardiología">Cardiología</option>
            <option value="Dermatología">Dermatología</option>
        </select>

        <label for="medico">Médico:</label>
        <select id="medico" name="medico" required>
            <option value="">Seleccione un médico</option>
            <option value="Dr. Juan Pérez">Dr. Juan Pérez</option>
            <option value="Dra. María Gómez">Dra. María Gómez</option>
            <option value="Dr. Carlos Ruiz">Dr. Carlos Ruiz</option>
        </select>

        <label for="fecha">Fecha de la cita:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="horario">Horario:</label>
        <select id="horario" name="horario" required>
            <option value="">Seleccione un horario</option>
            <option value="08:00-08:30">08:00 - 08:30</option>
            <option value="09:00-09:30">09:00 - 09:30</option>
            <option value="10:00-10:30">10:00 - 10:30</option>
            <option value="11:00-11:30">11:00 - 11:30</option>
        </select>

        <label for="nombres">Nombres:</label>
        <input type="text" id="nombres" name="nombres"
               maxlength="100" autocomplete="given-name" required>

        <label for="apellidos">Apellidos:</label>
        <input type="text" id="apellidos" name="apellidos"
               maxlength="100" autocomplete="family-name" required>

        <label for="cedula">Cédula (10 dígitos):</label>
        <input type="text" id="cedula" name="cedula"
               inputmode="numeric" pattern="[0-9]{10}"
               maxlength="10" autocomplete="off" required>

        <label for="telefono">Teléfono:</label>
        <input type="tel" id="telefono" name="telefono"
               maxlength="20" autocomplete="tel" required>

        <label for="correo">Correo electrónico:</label>
        <input type="email" id="correo" name="correo"
               maxlength="150" autocomplete="email" required>

        <p class="aviso">
            Al enviar este formulario, sus datos serán utilizados para
            gestionar su solicitud de cita médica. Consulte el aviso de
            privacidad del establecimiento.
        </p>

        <button type="submit">Enviar solicitud</button>
    </form>
</div>

<script>
    const fecha = document.getElementById("fecha");
    const hoy = new Date();
    const anio = hoy.getFullYear();
    const mes = String(hoy.getMonth() + 1).padStart(2, "0");
    const dia = String(hoy.getDate()).padStart(2, "0");

    fecha.min = `${anio}-${mes}-${dia}`;
</script>
</body>
</html>
