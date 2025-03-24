<?php

namespace TipoCambio\Type;

class VarDolar
{
    /**
     * @var null | string
     */
    private ?string $fecha = null;

    /**
     * @var float
     */
    private float $referencia;

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
    public function getReferencia() : float
    {
        return $this->referencia;
    }

    /**
     * @param float $referencia
     * @return static
     */
    public function withReferencia(float $referencia) : static
    {
        $new = clone $this;
        $new->referencia = $referencia;

        return $new;
    }
}

