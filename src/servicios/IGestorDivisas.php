<?php

namespace App\servicios;

/**
 * Interface IGestorDivisas
 */
Interface IGestorDivisas {
    public function listaDivisasDisponibles(): ?array;

    public function consultarCambioDivisa($divisaOrigen, $divisaDestino, $fechaInicial, $fecchaFinal = null): ?array;
}
