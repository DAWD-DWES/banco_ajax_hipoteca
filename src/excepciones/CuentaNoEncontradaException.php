<?php


namespace App\excepciones;

use \Exception;

class CuentaNoEncontradaException extends Exception {
    private int $idCuenta;
    
    public function __construct(int $idCuenta) {
        $this->idCuenta = $idCuenta;

        $message = "La cuenta $idCuenta no existe.";
        parent::__construct($message);
    }

    public function getIdCuenta(): int {
        return $this->idCuenta;
    }
}

