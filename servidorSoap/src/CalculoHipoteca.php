<?php

require 'CalculoCuotaRequest.php';
require 'CalculoCuotaResponse.php';

/**
 * @soap
 */
class CalculoHipoteca {

    /**
     * @soap
     * @param CalculoCuotaRequest $peticion 
     * @return CalculoCuotaResponse
     */
    public function calculoCuota($peticion): CalculoCuotaResponse {
        $cantidad = $peticion->cantidad;
        $anyos = $peticion->anyos;
        $tasaInteresAnual = $peticion->tasaInteresAnual;

        $tasaInteresMensual = $tasaInteresAnual / 12 / 100;
        $totalPagos = $anyos * 12;
        if ($tasaInteresMensual == 0.0) {
            return $cantidad / $totalPagos; // cuota lineal sin interés
        }
        $factor = pow(1 + $tasaInteresMensual, $totalPagos);
        $cuota = $cantidad * ($tasaInteresMensual * $factor) / ($factor - 1);

        $respuesta = new CalculoCuotaResponse();
        $respuesta->return = $cuota;
        return $respuesta;
    }
}
