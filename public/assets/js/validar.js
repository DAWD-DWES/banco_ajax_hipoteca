document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector("form");

  const mensajesError = {
    dniclienteorigen: {
      valueMissing: "El DNI del cliente origen es obligatorio.",
      patternMismatch: "Debe tener 8 números seguidos de una letra (ej: 12345678Z)."
    },
    dniclientedestino: {
      valueMissing: "El DNI del cliente destino es obligatorio.",
      patternMismatch: "Debe tener 8 números seguidos de una letra (ej: 12345678Z)."
    },
    cantidad: {
      valueMissing: "La cantidad es obligatoria.",
      rangeUnderflow: "La cantidad debe ser mayor que 0."
    },
    asunto: {
      valueMissing: "El asunto es obligatorio.",
      patternMismatch: "El mensaje solo puede contener letras, números y signos básicos (máx. 140 caracteres)."
    }
  };

  form.addEventListener("submit", function (event) {
    let valido = form.checkValidity();

    // Limpia mensajes previos
    form.querySelectorAll(".text-danger").forEach(div => div.textContent = "");
    const divResultado = document.getElementById("resultadoTransferencia");
    divResultado.textContent = "";
    divResultado.className = "";

    if (!valido) {
      event.preventDefault();
      event.stopImmediatePropagation();
      return;
    }

    // Enviar por AJAX
    event.preventDefault();

    const formData = new FormData(form);
    formData.append("accion", "realizarTransferencia");

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Accept", "application/json");

    xhr.onload = function () {
      const responseText = xhr.responseText;
      const divResultado = document.getElementById("resultadoTransferencia");

      try {
        const response = JSON.parse(responseText);

        if (xhr.status === 200 && response.status === "ok") {
          divResultado.textContent = response.mensaje;
          divResultado.className = "alert alert-success mt-3";
          // form.reset(); // Descomenta si quieres limpiar el formulario al finalizar
        } else {
          divResultado.textContent = response.mensaje || "Error al procesar la transferencia.";
          divResultado.className = "alert alert-danger mt-3";
        }
      } catch (error) {
        divResultado.textContent = "Respuesta no válida del servidor.";
        divResultado.className = "alert alert-danger mt-3";
      }
    };

    xhr.onerror = function () {
      const divResultado = document.getElementById("resultadoTransferencia");
      divResultado.textContent = "No se pudo comunicar con el servidor. Inténtalo más tarde.";
      divResultado.className = "alert alert-danger mt-3";
    };

    xhr.send(formData);
  });

  // Validación y mensajes personalizados
  form.querySelectorAll("input").forEach((input) => {
    const errorBox = document.getElementById(input.id + "Error");

    const mostrarMensaje = () => {
      const errores = mensajesError[input.name];
      if (!errores) return;

      for (const tipo in input.validity) {
        if (input.validity[tipo] && errores?.[tipo]) {
          errorBox.textContent = errores[tipo];
          break;
        }
      }
    };

    input.addEventListener("invalid", (event) => {
      event.preventDefault();
      mostrarMensaje();
    });

    input.addEventListener("input", () => {
      if (input.checkValidity()) {
        errorBox.textContent = "";
      } else {
        mostrarMensaje();
      }
    });

    input.addEventListener("mouseenter", () => {
      if (!input.checkValidity()) mostrarMensaje();
    });

    input.addEventListener("mouseleave", () => {
      if (input.checkValidity()) errorBox.textContent = "";
    });
  });
});
