<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\RequestInterface;

class TipoCambioFechaInicial implements RequestInterface
{
    /**
     * @var null | string
     */
    private ?string $fechainit = null;

    /**
     * Constructor
     *
     * @param null | string $fechainit
     */
    public function __construct(?string $fechainit)
    {
        $this->fechainit = $fechainit;
    }

    /**
     * @return null | string
     */
    public function getFechainit() : ?string
    {
        return $this->fechainit;
    }

    /**
     * @param null | string $fechainit
     * @return static
     */
    public function withFechainit(?string $fechainit) : static
    {
        $new = clone $this;
        $new->fechainit = $fechainit;

        return $new;
    }
}

