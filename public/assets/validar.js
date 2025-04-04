document.addEventListener("DOMContentLoaded", function () {
    const formTransferencia = document.querySelector('form');

    formTransferencia.addEventListener("submit", (event) => {
        const allValid = formTransferencia.checkValidity();
        if (!allValid) {
            event.preventDefault();
            event.stopImmediatePropagation();
        }

        const cantidad = document.getElementById("cantidad");
        const cantidadError = document.getElementById("cantidadError");

        if (parseFloat(cantidad.value) <= 0) {
            cantidadError.textContent = "La cantidad debe ser mayor que 0.";
            event.preventDefault();
            event.stopImmediatePropagation();
        }
    });

    const fields = Array.from(formTransferencia.elements);
    fields.forEach((field) => {
        const errorBox = document.getElementById(field.id + "Error");

        if (!errorBox) return;

        field.addEventListener("invalid", (event) => {
            let message = "";
            if (field.validity.valueMissing) {
                message = "Este campo es obligatorio.";
            } else if (field.id.includes("dni") && field.validity.patternMismatch) {
                message = "El DNI debe tener 8 dígitos seguidos de una letra (ej: 12345678Z).";
            } else if (field.id === "idcuentaorigen" || field.id === "idcuentadestino") {
                message = "Introduce un número de cuenta válido.";
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