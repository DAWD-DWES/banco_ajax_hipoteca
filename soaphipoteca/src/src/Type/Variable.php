<?php

namespace TipoCambio\Type;

class Variable
{
    /**
     * @var int
     */
    private int $moneda;

    /**
     * @var null | string
     */
    private ?string $descripcion = null;

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
    public function getDescripcion() : ?string
    {
        return $this->descripcion;
    }

    /**
     * @param null | string $descripcion
     * @return static
     */
    public function withDescripcion(?string $descripcion) : static
    {
        $new = clone $this;
        $new->descripcion = $descripcion;

        return $new;
    }
}

