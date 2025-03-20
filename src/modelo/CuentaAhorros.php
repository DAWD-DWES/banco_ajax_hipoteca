<?php

namespace App\modelo;

use App\modelo\Cuenta;
use App\modelo\Operacion;
use App\excepciones\SaldoInsuficienteException;

/**
 * Clase CuentaAhorros 
 */
class CuentaAhorros extends Cuenta {

    private float $bonificacion;
    private bool $libreta;

    public function __construct(string $idCliente, bool $libreta = false, float $bonificacion = 0, float $saldo = 0, string $fechaCreacion = "now") {
        $this->libreta = $libreta;
        $this->bonificacion = $bonificacion;
        parent::__construct($idCliente, TipoCuenta::AHORROS, $saldo, $fechaCreacion);
    }

    public function getLibreta(): bool {
        return $this->libreta;
    }

    public function setLibreta(bool $libreta): void {
        $this->libreta = $libreta;
    }

    function getBonificacion(): float {
        return $this->bonificacion;
    }

    function setBonificacion(float $bonificacion): void {
        $this->bonificacion = $bonificacion;
    }

    public function ingreso(float $cantidad, string $descripcion): Operacion {
        $cantidadBonificada = $cantidad * (1 + ($this->getBonificacion() / 100));
        return (parent::ingreso($cantidadBonificada, $descripcion));
    }

    /**
     * 
     * @param type $cantidad Cantidad de dinero a retirar
     * @param type $descripcion Descripcion del debito
     * @throws SaldoInsuficienteException
     */
    public function debito(float $cantidad, string $descripcion): Operacion {
        if ($cantidad <= $this->getSaldo()) {
            $operacion = new Operacion($this->getId(), TipoOperacion::DEBITO, $cantidad, $descripcion);
            $this->agregaOperacion($operacion);
            $this->setSaldo($this->getSaldo() - $cantidad);
            return $operacion;
        } else {
            throw new SaldoInsuficienteException($this->getId(), $cantidad);
        }
    }

    public function aplicaInteres(float $interes): Operacion {
        $intereses = $this->getSaldo() * $interes / 100;
        $operacion = $this->ingreso($intereses, "Intereses a tu favor.");
        return $operacion;
    }

    public function __toString(): string {
        return (parent::__toString() . "<br> Libreta: " . ($this->getLibreta() ? "Si" : "No") . "</br>");
    }
}
