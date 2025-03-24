<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\RequestInterface;

class Variables implements RequestInterface
{
    /**
     * @var int
     */
    private int $variable;

    /**
     * Constructor
     *
     * @param int $variable
     */
    public function __construct(int $variable)
    {
        $this->variable = $variable;
    }

    /**
     * @return int
     */
    public function getVariable() : int
    {
        return $this->variable;
    }

    /**
     * @param int $variable
     * @return static
     */
    public function withVariable(int $variable) : static
    {
        $new = clone $this;
        $new->variable = $variable;

        return $new;
    }
}

