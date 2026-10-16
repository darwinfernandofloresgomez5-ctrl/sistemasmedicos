
<?php
// guardar_registro_publico.php

require_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: registro_publico.php");
    exit;
}

$especialidad = trim($_POST["especialidad"] ?? "");
$medico       = trim($_POST["medico"] ?? "");
$fecha        = trim($_POST["fecha"] ?? "");
$horario      = trim($_POST["horario"] ?? "");
$nombres      = trim($_POST["nombres"] ?? "");
$apellidos    = trim($_POST["apellidos"] ?? "");
$cedula       = trim($_POST["cedula"] ?? "");
$telefono     = trim($_POST["telefono"] ?? "");
$correo       = trim($_POST["correo"] ?? "");

$especialidades = [
    "Medicina General",
    "Pediatría",
    "Cardiología",
    "Dermatología"
];

$medicos = [
    "Dr. Juan Pérez",
    "Dra. María Gómez",
    "Dr. Carlos Ruiz"
];

$horarios = [
    "08:00-08:30",
    "09:00-09:30",
    "10:00-10:30",
    "11:00-11:30"
];

function mostrarMensaje($mensaje) {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Resultado del registro</title>
    </head>
    <body style="font-family:Arial;max-width:650px;margin:40px auto;padding:20px">
        <h2>' . htmlspecialchars($mensaje, ENT_QUOTES, "UTF-8") . '</h2>
        <p><a href="registro_publico.php">Volver al formulario</a></p>
    </body>
    </html>';
    exit;
}

// Validar campos obligatorios.
foreach ([
    $especialidad, $medico, $fecha, $horario,
    $nombres, $apellidos, $cedula, $telefono, $correo
] as $valor) {
    if ($valor === "") {
        mostrarMensaje("Error: complete todos los campos.");
    }
}

// Validar especialidad, médico y horario.
if (!in_array($especialidad, $especialidades, true)) {
    mostrarMensaje("Error: especialidad no válida.");
}

if (!in_array($medico, $medicos, true)) {
    mostrarMensaje("Error: médico no válido.");
}

if (!in_array($horario, $horarios, true)) {
    mostrarMensaje("Error: horario no válido.");
}

// Validar cédula, correo y fecha.
if (!preg_match('/^[0-9]{10}$/', $cedula)) {
    mostrarMensaje("Error: la cédula debe contener 10 dígitos.");
}

if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    mostrarMensaje("Error: el correo electrónico no es válido.");
}

$fechaObjeto = DateTime::createFromFormat("!Y-m-d", $fecha);
$erroresFecha = DateTime::getLastErrors();

if (
    !$fechaObjeto ||
    ($erroresFecha !== false &&
     ($erroresFecha["warning_count"] > 0 ||
      $erroresFecha["error_count"] > 0)) ||
    $fechaObjeto->format("Y-m-d") !== $fecha
) {
    mostrarMensaje("Error: la fecha no es válida.");
}

if ($fecha < date("Y-m-d")) {
    mostrarMensaje("Error: seleccione una fecha actual o futura.");
}

try {
    // Evitar que el mismo médico tenga dos citas en la misma fecha y horario.
    $consulta = $pdo->prepare(
        "SELECT COUNT(*) FROM citas
         WHERE medico = :medico
           AND fecha = :fecha
           AND horario = :horario"
    );

    $consulta->execute([
        ":medico" => $medico,
        ":fecha" => $fecha,
        ":horario" => $horario
    ]);

    if ($consulta->fetchColumn() > 0) {
        mostrarMensaje(
            "Ese médico ya tiene una cita registrada en ese horario. Seleccione otro."
        );
    }

    // Guardar en la misma tabla que utiliza el filtro de búsqueda.
    $sql = "INSERT INTO citas
        (especialidad, medico, fecha, horario,
         nombres, apellidos, cedula, telefono, correo)
        VALUES
        (:especialidad, :medico, :fecha, :horario,
         :nombres, :apellidos, :cedula, :telefono, :correo)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ":especialidad" => $especialidad,
        ":medico" => $medico,
        ":fecha" => $fecha,
        ":horario" => $horario,
        ":nombres" => $nombres,
        ":apellidos" => $apellidos,
        ":cedula" => $cedula,
        ":telefono" => $telefono,
        ":correo" => $correo
    ]);

    mostrarMensaje(
        "¡Solicitud registrada correctamente! Su número de registro es: "
        . $pdo->lastInsertId()
    );

} catch (PDOException $e) {
    error_log($e->getMessage());
    mostrarMensaje(
        "No se pudo guardar la solicitud. Intente nuevamente o comuníquese con el establecimiento."
    );
}
?>
