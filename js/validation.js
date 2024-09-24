
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("miFormulario"); // Asegúrate de tener un id en el formulario
        form.addEventListener("submit", function(event) {
            let valid = true;
            let mensajes = [];

            const nombre = document.getElementById("nombre").value.trim();
            const apellido = document.getElementById("apellido").value.trim();
            const fechaNacimiento = document.getElementById("fecha_nacimiento").value;
            const dni = document.getElementById("dni").value.trim();
            const nacionalidad = document.getElementById("nacionalidades").value;

            // Validación del nombre
            if (nombre === "") {
                valid = false;
                mensajes.push("El nombre es obligatorio.");
            }

            // Validación del apellido
            if (apellido === "") {
                valid = false;
                mensajes.push("El apellido es obligatorio.");
            }

            // Validación de la fecha de nacimiento
            if (fechaNacimiento === "") {
                valid = false;
                mensajes.push("La fecha de nacimiento es obligatoria.");
            }

            // Validación del DNI
            if (dni === "" || isNaN(dni) || dni.length < 7) {
                valid = false;
                mensajes.push("El DNI es obligatorio y debe ser un número válido con al menos 7 dígitos.");
            }

            // Validación de la nacionalidad
            if (nacionalidad === "") {
                valid = false;
                mensajes.push("La nacionalidad es obligatoria.");
            }

            // Si hay errores, prevenimos el envío del formulario
            if (!valid) {
                event.preventDefault(); // Prevenir el envío del formulario
                alert(mensajes.join("\n")); // Mostrar los mensajes de error
            }
        });
    });
