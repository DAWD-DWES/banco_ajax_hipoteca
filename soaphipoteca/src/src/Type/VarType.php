<?php

namespace TipoCambio\Type;

class VarType
{
    /**
     * @var int
     */
    private int $moneda;

    /**
     * @var null | string
     */
    private ?string $fecha = null;

    /**
     * @var float
     */
    private float $venta;

    /**
     * @var float
     */
    private float $compra;

    /**
     * @return int
     */
    public function getMoneda() : int
    {
        return $this->moneda;
    }

    /**
     * @param int $moneda
     * @return static
     */
    public function withMoneda(int $moneda) : static
    {
        $new = clone $this;
        $new->moneda = $moneda;

        return $new;
    }

    /**
     * @return null | string
     */
    public function getFecha() : ?string
    {
        return $this->fecha;
    }

    /**
     * @param null | string $fecha
     * @return static
     */
    public function withFecha(?string $fecha) : static
    {
        $new = clone $this;
        $new->fecha = $fecha;

        return $new;
    }

    /**
     * @return float
     */
    public function getVenta() : float
    {
        return $this->venta;
    }

    /**
     * @param float $venta
     * @return static
     */
    public function withVenta(float $venta) : static
    {
        $new = clone $this;
        $new->venta = $venta;

        return $new;
    }

    /**
     * @return float
     */
    public function getCompra() : float
    {
        return $this->compra;
    }

    /**
     * @param float $compra
     * @return static
     */
    public function withCompra(float $compra) : static
    {
        $new = clone $this;
        $new->compra = $compra;

        return $new;
    }
}

