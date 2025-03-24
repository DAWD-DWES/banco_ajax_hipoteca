<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\RequestInterface;

class TipoCambioFechaInicialMoneda implements RequestInterface
{
    /**
     * @var null | string
     */
    private ?string $fechainit = null;

    /**
     * @var int
     */
    private int $moneda;

    /**
     * Constructor
     *
     * @param null | string $fechainit
     * @param int $moneda
     */
    public function __construct(?string $fechainit, int $moneda)
    {
        $this->fechainit = $fechainit;
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

