document.addEventListener("DOMContentLoaded", function () {
    const formTransferencia = document.querySelector('form');

    formTransferencia.addEventListener("submit", (event) => {
        const allValid = formTransferencia.checkValidity();
        const cantidad = document.getElementById("cantidad");
        const cantidadError = document.getElementById("cantidadError");

        let formValido = allValid;

        if (parseFloat(cantidad.value) <= 0) {
            cantidadError.textContent = "La cantidad debe ser mayor que 0.";
            formValido = false;
        }

        if (!formValido) {
            event.preventDefault();
            event.stopImmediatePropagation();
            return;
        }

        // Si todo es válido, enviamos la transferencia por AJAX
        event.preventDefault();

        const formData = new FormData(formTransferencia);
        formData.append("accion", "realizarTransferencia");

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php", true);
        xhr.setRequestHeader("Accept", "application/json"); // Indicamos que esperamos JSON

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                const divResultado = document.getElementById("resultadoTransferencia");

                try {
                    const response = JSON.parse(xhr.responseText);

                    if (xhr.status === 200 && response.status === "ok") {
                        divResultado.textContent = response.mensaje;
                        divResultado.className = "alert alert-success mt-3";
                        // formTransferencia.reset(); // descomenta esto si quieres limpiar el formulario tras éxito
                    } else {
                        divResultado.textContent = response.mensaje || "Error al procesar la transferencia.";
                        divResultado.className = "alert alert-danger mt-3";
                    }
                } catch (error) {
                    divResultado.textContent = "Error inesperado en la respuesta del servidor.";
                    divResultado.className = "alert alert-danger mt-3";
                }
            }
        };

        xhr.send(formData);
    });

    // 🧠 Validación personalizada para cada campo
    const fields = Array.from(formTransferencia.elements);
    fields.forEach((field) => {
        const errorBox = document.getElementById(field.id + "Error");
        if (!errorBox) return;

        field.addEventListener("invalid", () => {
            let message = "";

            if (field.validity.valueMissing) {
                message = "Este campo es obligatorio.";
            } else if (field.id.includes("dni") && field.validity.patternMismatch) {
                message = "El DNI debe tener 8 dígitos seguidos de una letra (ej: 12345678Z).";
            } else if ((field.id === "idcuentaorigen" || field.id === "idcuentadestino") && !field.value) {
                message = "Selecciona una cuenta válida.";
            } else if (field.id === "asunto" && field.validity.patternMismatch) {
                message = "El mensaje solo puede contener letras, números, espacios y signos básicos.";
            }

            errorBox.textContent = message;
        });

        field.addEventListener("input", () => {
            if (errorBox) errorBox.textContent = "";
        });
    });
});
