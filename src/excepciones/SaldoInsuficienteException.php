<?php

namespace App\excepciones;

use \Exception;

class SaldoInsuficienteException extends Exception {

    private int $idCuenta;
    private float $cantidad;

    public function __construct(int $idCuenta, float $cantidad) {
        $this->idCuenta = $idCuenta;

        $message = "No hay suficiente saldo en la cuenta $idCuenta para extraer $cantidad €";
        parent::__construct($message);
    }
    
    public function getIdCuenta(): int {
        return $this->idCuenta;
    }
    public function getCantidad(): float {
        return $this->cantidad;
    }
}
