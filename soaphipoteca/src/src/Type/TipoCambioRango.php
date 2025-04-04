<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\RequestInterface;

class TipoCambioRango implements RequestInterface
{
    /**
     * @var null | string
     */
    private ?string $fechainit = null;

    /**
     * @var null | string
     */
    private ?string $fechafin = null;

    /**
     * Constructor
     *
     * @param null | string $fechainit
     * @param null | string $fechafin
     */
    public function __construct(?string $fechainit, ?string $fechafin)
    {
        $this->fechainit = $fechainit;
        $this->fechafin = $fechafin;
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

    /**
     * @return null | string
     */
    public function getFechafin() : ?string
    {
        return $this->fechafin;
    }

    /**
     * @param null | string $fechafin
     * @return static
     */
    public function withFechafin(?string $fechafin) : static
    {
        $new = clone $this;
        $new->fechafin = $fechafin;

        return $new;
    }
}

