<?php

namespace App\modelo;

use App\modelo\Operacion;
use App\modelo\Cuenta;

/**
 * Clase CuentaCorriente 
 */
class CuentaCorriente extends Cuenta {

    public function __construct(int $idCliente, float $saldo = 0, string $fechaCreacion = "now") {
        parent::__construct($idCliente, TipoCuenta::CORRIENTE, $saldo, $fechaCreacion);
    }

    /**
     * 
     * @param type $cantidad Cantidad de dinero a retirar
     * @param type $descripcion Descripcion del debito
     */
    public function debito(float $cantidad, string $descripcion): Operacion {
        $operacion = new Operacion($this->getId(), TipoOperacion::DEBITO, $cantidad, $descripcion);
        $this->agregaOperacion($operacion);
        $this->setSaldo($this->getSaldo() - $cantidad);
        return $operacion;
    }

    public function aplicaComision($comision, $minSaldo): ?Operacion {
        if ($this->getSaldo() < $minSaldo) {
            $operacion = $this->debito($comision, "Cargo de comisión de mantenimiento");
        }
        return $operacion ?? null;
    }
}
