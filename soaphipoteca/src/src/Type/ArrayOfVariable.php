<?php

namespace TipoCambio\Type;

class ArrayOfVariable
{
    /**
     * @var null | array<int<0,max>, \TipoCambio\Type\Variable>
     */
    private ?array $Variable = null;

    /**
     * @return null | array<int<0,max>, \TipoCambio\Type\Variable>
     */
    public function getVariable() : ?array
    {
        return $this->Variable;
    }

    /**
     * @param null | array<int<0,max>, \TipoCambio\Type\Variable> $Variable
     * @return static
     */
    public function withVariable(?array $Variable) : static
    {
        $new = clone $this;
        $new->Variable = $Variable;

        return $new;
    }
}

