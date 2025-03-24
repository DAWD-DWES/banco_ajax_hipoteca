<?php

namespace App\servicios;

use Hipoteca\CalculoHipotecaServiceClient;
use Hipoteca\CalculoHipotecaServiceClientFactory;
use Hipoteca\Type\CalculoCuotaRequest;
use Hipoteca\Type\CalculoCuotaResponse;

/**
 * Clase GestorDivisasSOAP
 */
class GestorHipotecasSOAP {

    private CalculoHipotecaServiceClient $clienteHipoteca;


    public function __construct() {
        $this->clienteHipoteca = CalculoHipotecaServiceClientFactory::factory($wsdl = 'http://localhost/servidorSoap/calculohipoteca.wsdl');
    }

    public function calculoCuota(float $cantidad, int $anyos, float $tasaInteresAnual): float {
        $peticion = new CalculoCuotaRequest($cantidad, $anyos, $tasaInteresAnual);
        $resultado = $this->clienteHipoteca->calculoCuota($peticion);
        return $resultado->getReturn();
    }
}
