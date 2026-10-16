<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Citas Médicas - UNEMI Online</title>

    <!-- Hoja de estilos -->
    <link rel="stylesheet" href="estilos.css">

    <!-- Estilos adicionales para el formulario de consulta -->
    <style>
        .consulta-section {
            margin-top: 30px;
            padding: 25px;
            background: #ffffff;
            border: 1px solid #dce3eb;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .consulta-section h2 {
            color: #174a75;
            margin-bottom: 10px;
        }

        .consulta-section .descripcion {
            color: #555;
            margin-bottom: 20px;
        }

        .consulta-section .form-group {
            margin-bottom: 16px;
        }

        .consulta-section input {
            width: 100%;
            padding: 11px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 15px;
        }

        .consulta-section input:focus {
            outline: 2px solid #93c5fd;
            border-color: #174a75;
        }

        .consulta-section .btn-consultar {
            background-color: #174a75;
            color: white;
        }

        .consulta-section .btn-limpiar {
            background-color: #e5e7eb;
            color: #222;
        }

        .consulta-section button {
            padding: 12px 18px;
            margin: 5px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .consulta-section button:hover {
            opacity: 0.85;
        }

        .nota-consulta {
            margin-top: 12px;
            font-size: 13px;
            color: #666;
        }

        @media (max-width: 600px) {
            .consulta-section {
                padding: 16px;
            }

            .consulta-section button {
                width: 100%;
                margin: 5px 0;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header">
        <h1>SISTEMA DE CITAS MÉDICAS RECEPCION</h1>

        <p>Carrera de Tecnologías de la Información - Modalidad Online</p>

        <p style="font-size: 0.75rem; color: #777; margin-top: 4px;">
            Docente: Ing. Alex Ávila, Mgtr.
        </p>
    </header>


    <!-- ================================================== -->
    <!-- FORMULARIO 1: REGISTRO DE CITAS MÉDICAS             -->
    <!-- ================================================== -->

    <form id="formCita"
          action="guardar_cita.php"
          method="POST"
          novalidate>

        <!-- INFORMACIÓN DE LA CITA -->
        <fieldset>
            <legend>Información de la Cita</legend>

            <div class="form-group">
                <label for="especialidad">Especialidad:</label>

                <select id="especialidad"
                        name="especialidad"
                        required>

                    <option value="">Seleccione una especialidad</option>
                    <option value="Medicina General">Medicina General</option>
                    <option value="Pediatría">Pediatría</option>
                    <option value="Cardiología">Cardiología</option>
                    <option value="Dermatología">Dermatología</option>

                </select>
            </div>


            <div class="form-group">
                <label for="medico">Médico:</label>

                <select id="medico"
                        name="medico"
                        required>

                    <option value="">Seleccione un médico</option>
                    <option value="Dr. Juan Pérez">Dr. Juan Pérez</option>
                    <option value="Dra. María Gómez">Dra. María Gómez</option>
                    <option value="Dr. Carlos Ruiz">Dr. Carlos Ruiz</option>

                </select>
            </div>


            <div class="form-group">
                <label for="fecha">Fecha:</label>

                <input type="date"
                       id="fecha"
                       name="fecha"
                       required>
            </div>


            <div class="form-group">
                <label for="horario">Horario:</label>

                <select id="horario"
                        name="horario"
                        required>

                    <option value="">Seleccione un horario</option>
                    <option value="08:00 - 08:30">08:00 - 08:30</option>
                    <option value="09:00 - 09:30">09:00 - 09:30</option>
                    <option value="10:00 - 10:30">10:00 - 10:30</option>
                    <option value="11:00 - 11:30">11:00 - 11:30</option>

                </select>
            </div>

        </fieldset>


        <!-- DATOS DEL PACIENTE -->
        <fieldset>
            <legend>Datos del Paciente</legend>

            <div class="form-group">
                <label for="nombres">Nombres:</label>

                <input type="text"
                       id="nombres"
                       name="nombres"
                       placeholder="Ingrese sus nombres"
                       maxlength="100"
                       autocomplete="given-name"
                       required>
            </div>


            <div class="form-group">
                <label for="apellidos">Apellidos:</label>

                <input type="text"
                       id="apellidos"
                       name="apellidos"
                       placeholder="Ingrese sus apellidos"
                       maxlength="100"
                       autocomplete="family-name"
                       required>
            </div>


            <div class="form-group">
                <label for="cedula">Cédula:</label>

                <input type="text"
                       id="cedula"
                       name="cedula"
                       placeholder="10 dígitos numéricos"
                       maxlength="10"
                       minlength="10"
                       inputmode="numeric"
                       pattern="[0-9]{10}"
                       autocomplete="off"
                       title="Ingrese una cédula de 10 dígitos"
                       required>
            </div>


            <div class="form-group">
                <label for="telefono">Teléfono:</label>

                <input type="tel"
                       id="telefono"
                       name="telefono"
                       placeholder="Ej. 0991234567"
                       maxlength="10"
                       minlength="10"
                       inputmode="numeric"
                       pattern="[0-9]{10}"
                       autocomplete="tel"
                       title="Ingrese un teléfono de 10 dígitos"
                       required>
            </div>


            <div class="form-group">
                <label for="correo">Correo:</label>

                <input type="email"
                       id="correo"
                       name="correo"
                       placeholder="ejemplo@correo.com"
                       maxlength="150"
                       autocomplete="email"
                       required>
            </div>

        </fieldset>


        <!-- BOTÓN DE REGISTRO -->
        <div class="form-actions">
            <button type="submit" id="btnRegistrar">
                REGISTRAR CITA
            </button>
        </div>

    </form>


    <!-- MENSAJES DEL FORMULARIO DE REGISTRO -->
    <div id="mensajeContainer"
         class="mensaje-container"
         aria-live="polite">
    </div>


    <!-- ================================================== -->
    <!-- FORMULARIO 2: CONSULTA DE PACIENTES REGISTRADOS     -->
    <!-- ================================================== -->

    <section class="consulta-section">

        <h2>CONSULTA DE PACIENTES REGISTRADOS</h2>

        <p class="descripcion">
            Busque las citas médicas registradas utilizando los
            nombres, apellidos o número de cédula del paciente.
        </p>


        <form id="formConsulta"
              action="consultar_citas.php"
              method="GET">

            <!-- BÚSQUEDA POR NOMBRES -->
            <div class="form-group">
                <label for="buscar_nombres">Nombres:</label>

                <input type="text"
                       id="buscar_nombres"
                       name="nombres"
                       placeholder="Ingrese los nombres del paciente"
                       maxlength="100"
                       autocomplete="off">
            </div>


            <!-- BÚSQUEDA POR APELLIDOS -->
            <div class="form-group">
                <label for="buscar_apellidos">Apellidos:</label>

                <input type="text"
                       id="buscar_apellidos"
                       name="apellidos"
                       placeholder="Ingrese los apellidos del paciente"
                       maxlength="100"
                       autocomplete="off">
            </div>


            <!-- BÚSQUEDA POR CÉDULA -->
            <div class="form-group">
                <label for="buscar_cedula">Cédula:</label>

                <input type="text"
                       id="buscar_cedula"
                       name="cedula"
                       placeholder="Ingrese la cédula del paciente"
                       maxlength="10"
                       inputmode="numeric"
                       pattern="[0-9]{10}"
                       title="Si ingresa una cédula, debe contener 10 dígitos">
            </div>


            <!-- BOTONES DE CONSULTA -->
            <div class="form-actions">

                <button type="submit" class="btn-consultar">
                    CONSULTAR PACIENTE
                </button>

                <button type="reset" class="btn-limpiar">
                    LIMPIAR CAMPOS
                </button>

            </div>

            <p class="nota-consulta">
                Puede buscar utilizando un solo campo o combinar
                varios para precisar los resultados.
            </p>

        </form>

    </section>

</div>


<!-- ARCHIVO JAVASCRIPT DEL SISTEMA -->
<script src="script.js"></script>

<!-- Validación adicional de la consulta -->
<script>
    document.getElementById("formConsulta").addEventListener(
        "submit",
        function (event) {

            const nombres = document
                .getElementById("buscar_nombres")
                .value.trim();

            const apellidos = document
                .getElementById("buscar_apellidos")
                .value.trim();

            const cedula = document
                .getElementById("buscar_cedula")
                .value.trim();

            if (nombres === "" && apellidos === "" && cedula === "") {
                event.preventDefault();

                alert(
                    "Ingrese nombres, apellidos o cédula para realizar la consulta."
                );

                return;
            }

            if (cedula !== "" && !/^[0-9]{10}$/.test(cedula)) {
                event.preventDefault();

                alert("La cédula debe contener exactamente 10 dígitos numéricos.");

                document.getElementById("buscar_cedula").focus();
            }
        }
    );
</script>

</body>
</html>