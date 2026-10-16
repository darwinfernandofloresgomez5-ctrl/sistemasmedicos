<?php
// Requerir el archivo de conexión con la base de datos
require_once 'conexion.php';

$mensaje = "";
$tipoMensaje = "";

// Verifica si los datos fueron enviados mediante el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitización básica de los datos recibidos del formulario
    $especialidad = trim($_POST['especialidad']);
    $medico = trim($_POST['medico']);
    $fecha = trim($_POST['fecha']);
    $horario = trim($_POST['horario']);
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $cedula = trim($_POST['cedula']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);

    // Validación en el servidor para evitar campos vacíos
    if (empty($especialidad) || empty($medico) || empty($fecha) || empty($horario) || 
        empty($nombres) || empty($apellidos) || empty($cedula) || empty($telefono) || empty($correo)) {
        $mensaje = "Error: Todos los campos son obligatorios.";
        $tipoMensaje = "error";
    } elseif (!preg_match('/^\d{10}$/', $cedula)) {
        // Validación en servidor de la estructura de la cédula
        $mensaje = "Error: La cédula ingresada debe tener 10 dígitos.";
        $tipoMensaje = "error";
    } else {
        try {
            // Sentencia SQL utilizando parámetros seguros (:etiqueta) para prevenir inyección SQL
            $sql = "INSERT INTO citas (especialidad, medico, fecha, horario, nombres, apellidos, cedula, telefono, correo) 
                    VALUES (:especialidad, :medico, :fecha, :horario, :nombres, :apellidos, :cedula, :telefono, :correo)";
            
            // Preparación y ejecución de la consulta PDO
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':especialidad' => $especialidad,
                ':medico' => $medico,
                ':fecha' => $fecha,
                ':horario' => $horario,
                ':nombres' => $nombres,
                ':apellidos' => $apellidos,
                ':cedula' => $cedula,
                ':telefono' => $telefono,
                ':correo' => $correo
            ]);

            $mensaje = "✓ Cita registrada y almacenada exitosamente.";
            $tipoMensaje = "success";
        } catch (PDOException $e) {
            // Manejo de errores en caso de fallos de inserción en la base de datos
            $mensaje = "Error al guardar en la base de datos: " . $e->getMessage();
            $tipoMensaje = "error";
        }
    }
} else {
    // Redirección si se intenta acceder directamente al archivo sin enviar el formulario
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado - Cita Médica</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container" style="text-align: center;">
        <div class="header">
            <h1>SISTEMA DE CITAS MÉDICAS</h1>
            <p>Resultado de Transacción</p>
        </div>
        
        <!-- Muestra el mensaje de éxito o error devuelto por el servidor -->
        <div class="mensaje-container">
            <div class="<?php echo ($tipoMensaje == 'success') ? 'success-msg' : 'error-msg'; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        </div>

        <br>
        <a href="index.php" style="display: inline-block; margin-top: 15px; text-decoration: none; background: #003366; color: white; padding: 10px 20px; border-radius: 5px; font-size: 0.9rem;">Volver al Registro</a>
    </div>
</body>
</html>
