<?php

namespace Hipoteca\Type;

use Phpro\SoapClient\Type\RequestInterface;

class CalculoCuotaRequest implements RequestInterface
{
    /**
     * @var null | float
     */
    private ?float $cantidad = null;

    /**
     * @var null | int
     */
    private ?int $anyos = null;

    /**
     * @var null | float
     */
    private ?float $tasaInteresAnual = null;

    /**
     * Constructor
     *
     * @param null | float $cantidad
     * @param null | int $anyos
     * @param null | float $tasaInteresAnual
     */
    public function __construct(?float $cantidad, ?int $anyos, ?float $tasaInteresAnual)
    {
        $this->cantidad = $cantidad;
        $this->anyos = $anyos;
        $this->tasaInteresAnual = $tasaInteresAnual;
    }

    /**
     * @return null | float
     */
    public function getCantidad() : ?float
    {
        return $this->cantidad;
    }

    /**
     * @param null | float $cantidad
     * @return static
     */
    public function withCantidad(?float $cantidad) : static
    {
        $new = clone $this;
        $new->cantidad = $cantidad;

        return $new;
    }

    /**
     * @return null | int
     */
    public function getAnyos() : ?int
    {
        return $this->anyos;
    }

    /**
     * @param null | int $anyos
     * @return static
     */
    public function withAnyos(?int $anyos) : static
    {
        $new = clone $this;
        $new->anyos = $anyos;

        return $new;
    }

    /**
     * @return null | float
     */
    public function getTasaInteresAnual() : ?float
    {
        return $this->tasaInteresAnual;
    }

    /**
     * @param null | float $tasaInteresAnual
     * @return static
     */
    public function withTasaInteresAnual(?float $tasaInteresAnual) : static
    {
        $new = clone $this;
        $new->tasaInteresAnual = $tasaInteresAnual;

        return $new;
    }
}

