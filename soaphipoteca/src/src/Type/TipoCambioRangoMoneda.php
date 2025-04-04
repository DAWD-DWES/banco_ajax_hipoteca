<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\RequestInterface;

class TipoCambioRangoMoneda implements RequestInterface
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
     * @var int
     */
    private int $moneda;

    /**
     * Constructor
     *
     * @param null | string $fechainit
     * @param null | string $fechafin
     * @param int $moneda
     */
    public function __construct(?string $fechainit, ?string $fechafin, int $moneda)
    {
        $this->fechainit = $fechainit;
        $this->fechafin = $fechafin;
        $this->moneda = $moneda;
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
}

