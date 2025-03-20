<?php


namespace App\modelo;

use DateTime;

/**
 * Clase Operacion
 */
class Operacion {
 /**
     * Id de la operacion
     * @var int
     */
    private int $id;
     /**
     * Id de la cuenta
     * @var int
     */
    private int $idCuenta;
     /**
     * Tipo de operación
     * @var string
     */
    private string $tipo;
     /**
     * Cantidad de la operación
     * @var float
     */
    private float $cantidad;
     /**
     * Timestamp de la operación
     * @var int
     */
    private int $fecha;
     /**
     * Descripción de la operación
     * @var string
     */
    private string $descripcion;

    public function __construct($idCuenta = '', $tipo = null, $cantidad = 0, $descripcion = '') {
        if (func_num_args() > 0) {
            $this->setIdCuenta($idCuenta);
            $this->setTipo($tipo);
            $this->setCantidad($cantidad);
            $this->setFecha(new DateTime('now'));
            $this->setDescripcion($descripcion);
        }
    }

    public function getId(): int {
        return $this->id;
    }

    // Cuidado con el tipo

    public function getTipo(): TipoOperacion {
        return TipoOperacion::from($this->tipo);
    }

    public function getCantidad(): float {
        return $this->cantidad;
    }

    public function getFecha(): DateTime {
        $fecha = new DateTime();
        return $fecha->setTimestamp($this->fecha);
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function getIdCuenta(): int {
        return $this->idCuenta;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setTipo(TipoOperacion $tipo): void {
        $this->tipo = $tipo->value;
    }

    public function setCantidad(float $cantidad): void {
        $this->cantidad = $cantidad;
    }

    public function setFecha(DateTime $fecha): void {
        $this->fecha = $fecha->getTimestamp();
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function setIdCuenta(int $idCuenta): void {
        $this->idCuenta = $idCuenta;
    }

    public function __toString(): string {
        return ("{$this->getTipo()->name} Cantidad: {$this->getCantidad()} Descripción: {$this->getDescripcion()}");
    }
}
