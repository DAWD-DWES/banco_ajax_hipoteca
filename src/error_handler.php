<?php

function myExceptionHandler(Throwable $e) {
    if (ob_get_contents()) {
        ob_clean(); // Limpia el búfer de salida sin deshabilitar el búfer
    }
    error_log("{$e->getMessage()} in {$e->getFile()} on line {$e->getLine()}");
    http_response_code(500);
    if (filter_var(ini_get('display_errors'), FILTER_VALIDATE_BOOLEAN)) {
        echo $e;
    } else {
        echo "<h1>500 Error Interno del Servidor</h1>
Ha ocurrido un error interno del servidor.<br>
Por favor, inténtelo más tarde.";
    }
    exit;
}

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        if (ob_get_contents()) {
            ob_clean(); // Limpia el búfer de salida sin deshabilitar el búfer
        }

        error_log("Error fatal: {$error['message']} en {$error['file']} en línea {$error['line']}");
        http_response_code(500);
        if (filter_var(ini_get('display_errors'), FILTER_VALIDATE_BOOLEAN)) {
            echo (($error['message'] ?? '') . ", " . ($error['file'] ?? '') . ", " . ($error['line'] ?? ''));
        } else {
            echo "<h1>500 Error Interno del Servidor</h1>
Ha ocurrido un error interno del servidor.<br>
Por favor, inténtelo más tarde.";
        }
    }
});

set_exception_handler('myExceptionHandler');

set_error_handler(function ($level, $message, $file = '', $line = 0) {
    if (!(error_reporting() & $level)) {
// Si el nivel del error no está incluido en error_reporting() no lo trates
        return;
    }
    if ($level & (E_USER_NOTICE | E_WARNING | E_STRICT | E_DEPRECATED)) {
// Maneja los errores no fatales. Registra el error
        error_log("Error no fatal: [$level] $message en $file en línea $line\n");
        return false; // Devuelve false para continuar con la ejecución del script
    } else {
// Convierte el resto de errores a ErrorException y lanza la excepción
        throw new ErrorException($message, 0, $level, $file, $line);
    }
}, E_ALL);
