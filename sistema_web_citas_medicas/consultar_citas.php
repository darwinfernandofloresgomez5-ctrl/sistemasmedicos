
<?php
// ======================================================
// SISTEMA DE CITAS MÉDICAS - UNEMI ONLINE
// Archivo: consultar_citas.php
// ======================================================

// Incluir la conexión con la base de datos
require_once "conexion.php";

// Comprobar que exista la conexión PDO
if (!isset($pdo) || !($pdo instanceof PDO)) {
    http_response_code(500);
    exit(
        "Error: verifica que conexion.php cree correctamente la variable \$pdo."
    );
}

// Recibir los datos del formulario de consulta
$nombres   = trim($_GET["nombres"] ?? "");
$apellidos = trim($_GET["apellidos"] ?? "");
$cedula    = trim($_GET["cedula"] ?? "");

// Comprobar que se haya ingresado algún criterio de búsqueda
if ($nombres === "" && $apellidos === "" && $cedula === "") {
    exit(
        'Debes ingresar nombres, apellidos o cédula.
         <br><a href="index.php">Volver al sistema</a>'
    );
}

// Validar la cédula si fue ingresada
if ($cedula !== "" && !preg_match('/^[0-9]{10}$/', $cedula)) {
    exit(
        'La cédula debe contener exactamente 10 dígitos.
         <br><a href="index.php">Volver al sistema</a>'
    );
}

// Construir las condiciones de búsqueda
$condiciones = [];
$parametros = [];

if ($nombres !== "") {
    $condiciones[] = "nombres LIKE :nombres";
    $parametros[":nombres"] = "%" . $nombres . "%";
}

if ($apellidos !== "") {
    $condiciones[] = "apellidos LIKE :apellidos";
    $parametros[":apellidos"] = "%" . $apellidos . "%";
}

if ($cedula !== "") {
    $condiciones[] = "cedula = :cedula";
    $parametros[":cedula"] = $cedula;
}

// Consultar la tabla citas
$sql = "SELECT
            id,
            especialidad,
            medico,
            fecha,
            horario,
            nombres,
            apellidos,
            cedula,
            telefono,
            correo
        FROM citas
        WHERE " . implode(" AND ", $condiciones) . "
        ORDER BY fecha DESC, horario ASC";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($parametros);

    $citas = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    exit(
        "Error al consultar las citas. Verifica la conexión y la tabla citas."
    );
}

// Evitar que los datos se interpreten como código HTML
function escapar($valor) {
    return htmlspecialchars(
        (string) $valor,
        ENT_QUOTES,
        "UTF-8"
    );
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Consulta de Citas Médicas - UNEMI Online</title>

    <link rel="stylesheet" href="estilos.css">

    <style>
        .resultados {
            margin-top: 25px;
            padding: 20px;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .tabla-contenedor {
            width: 100%;
            overflow-x: auto;
            margin-top: 20px;
        }

        .tabla-citas {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .tabla-citas th,
        .tabla-citas td {
            border: 1px solid #dce3eb;
            padding: 10px;
            text-align: left;
        }

        .tabla-citas th {
            background-color: #174a75;
            color: white;
        }

        .tabla-citas tbody tr:nth-child(even) {
            background-color: #f1f5f9;
        }

        .sin-resultados {
            padding: 15px;
            background: #fff3cd;
            border-radius: 6px;
            color: #664d03;
        }

        .boton-volver {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 18px;
            background: #174a75;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .boton-volver:hover {
            background: #103653;
        }
    </style>
</head>

<body>

<div class="container">

    <header class="header">
        <h1>CONSULTA DE CITAS MÉDICAS</h1>
        <p>Carrera de Tecnologías de la Información - Modalidad Online</p>
    </header>

    <section class="resultados">

        <h2>Resultados de la búsqueda</h2>

        <?php if (count($citas) > 0): ?>

            <p>
                Se encontraron
                <strong><?= count($citas) ?></strong>
                cita(s) registrada(s).
            </p>

            <div class="tabla-contenedor">

                <table class="tabla-citas">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Especialidad</th>
                            <th>Médico</th>
                            <th>Fecha</th>
                            <th>Horario</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Cédula</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($citas as $cita): ?>
                            <tr>
                                <td><?= escapar($cita["id"]) ?></td>
                                <td><?= escapar($cita["especialidad"]) ?></td>
                                <td><?= escapar($cita["medico"]) ?></td>
                                <td><?= escapar($cita["fecha"]) ?></td>
                                <td><?= escapar($cita["horario"]) ?></td>
                                <td><?= escapar($cita["nombres"]) ?></td>
                                <td><?= escapar($cita["apellidos"]) ?></td>
                                <td><?= escapar($cita["cedula"]) ?></td>
                                <td><?= escapar($cita["telefono"]) ?></td>
                                <td><?= escapar($cita["correo"]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="sin-resultados">
                No se encontraron citas con los datos ingresados.
                Verifica los nombres, apellidos o cédula.
            </div>

        <?php endif; ?>

        <a href="index.php" class="boton-volver">
            Volver al sistema de citas
        </a>

    </section>

</div>

</body>
</html>
