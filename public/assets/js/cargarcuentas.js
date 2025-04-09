document.addEventListener("DOMContentLoaded", function () {
  function cargarCuentas(dni, selectId, errorId) {
    const regexDni = /^[0-9]{8}[A-Za-z]$/;
    const select = document.getElementById(selectId);
    const error = document.getElementById(errorId);

    // Limpiar errores y opciones previas
    error.textContent = "";
    select.innerHTML = '<option value="">Seleccione una cuenta</option>';

    if (!regexDni.test(dni)) {
      return;
    }

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "index.php", true);
    xhr.setRequestHeader("Accept", "application/json");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
      if (xhr.status === 200) {
        try {
          const response = JSON.parse(xhr.responseText);

          if (response.error) {
            error.textContent = response.error;
            return;
          }

          // Asumimos que response es un array de objetos { id: ... }
          response.forEach(cuenta => {
            const option = document.createElement("option");
            option.value = cuenta.id;
            option.textContent = cuenta.id;
            select.appendChild(option);
          });
        } catch (e) {
          console.error("Error procesando JSON:", e);
          error.textContent = "Error inesperado procesando los datos del servidor.";
        }
      } else {
        error.textContent = "Error al contactar con el servidor.";
      }
    };

    xhr.onerror = function () {
      error.textContent = "No se pudo establecer comunicación con el servidor.";
    };

    const params = "accion=cuentasPorDni&dni=" + encodeURIComponent(dni);
    xhr.send(params);
  }

  // Escucha de cambios en los campos DNI
  document.getElementById("dniclienteorigen").addEventListener("change", function () {
    cargarCuentas(this.value, "idcuentaorigen", "dniclienteorigenError");
  });

  document.getElementById("dniclientedestino").addEventListener("change", function () {
    cargarCuentas(this.value, "idcuentadestino", "dniclientedestinoError");
  });
});
