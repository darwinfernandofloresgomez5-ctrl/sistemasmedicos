// Escucha el evento de envío del formulario para validar los datos en el cliente
document.getElementById('formCita').addEventListener('submit', function(event) {
    // Captura de valores de los campos del formulario
    const especialidad = document.getElementById('especialidad').value;
    const medico = document.getElementById('medico').value;
    const fecha = document.getElementById('fecha').value;
    const horario = document.getElementById('horario').value;
    const nombres = document.getElementById('nombres').value.trim();
    const apellidos = document.getElementById('apellidos').value.trim();
    const cedula = document.getElementById('cedula').value.trim();
    const telefono = document.getElementById('telefono').value.trim();
    const correo = document.getElementById('correo').value.trim();
    
    const mensajeContainer = document.getElementById('mensajeContainer');
    mensajeContainer.innerHTML = '';

    // Validación de campos vacíos obligatorios
    if (!especialidad || !medico || !fecha || !horario || !nombres || !apellidos || !cedula || !telefono || !correo) {
        event.preventDefault(); // Detiene el envío del formulario
        mostrarError("Por favor, complete todos los campos obligatorios.");
        return;
    }

    // Validación del formato de la cédula (exactamente 10 dígitos numéricos)
    if (!/^\d{10}$/.test(cedula)) {
        event.preventDefault();
        mostrarError("La cédula debe contener exactamente 10 dígitos numéricos.");
        return;
    }

    // Validación del formato del teléfono (exactamente 10 dígitos numéricos)
    if (!/^\d{10}$/.test(telefono)) {
        event.preventDefault();
        mostrarError("El teléfono debe contener exactamente 10 dígitos numéricos.");
        return;
    }

    // Validación básica del formato de correo electrónico
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
        event.preventDefault();
        mostrarError("Por favor, ingrese un correo electrónico válido.");
        return;
    }
});

// Función auxiliar para renderizar mensajes de error en pantalla
function mostrarError(mensaje) {
    document.getElementById('mensajeContainer').innerHTML = `<div class="error-msg">⚠️ ${mensaje}</div>`;
}
