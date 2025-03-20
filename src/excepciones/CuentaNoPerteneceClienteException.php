<?php

namespace App\excepciones;

use \Exception;


class CuentaNoPerteneceClienteException extends Exception {

    private string $dni;
    private int $idCuenta;

    public function __construct(string $dni, int $idCuenta) {
        $this->dni = $dni;
        $this->idCuenta = $idCuenta;

        $message = "La cuenta $idCuenta no pertenece al cliente con dni $dni";
        parent::__construct($message);
    }

    public function getIdCuenta(): int {
        return $this->idCuenta;
    }
    public function getdni(): string {
        return $this->dni;
    }
}
