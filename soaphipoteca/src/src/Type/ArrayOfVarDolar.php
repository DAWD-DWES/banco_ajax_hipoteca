<?php

namespace TipoCambio\Type;

class ArrayOfVarDolar
{
    /**
     * @var null | array<int<0,max>, \TipoCambio\Type\VarDolar>
     */
    private ?array $VarDolar = null;

    /**
     * @return null | array<int<0,max>, \TipoCambio\Type\VarDolar>
     */
    public function getVarDolar() : ?array
    {
        return $this->VarDolar;
    }

    /**
     * @param null | array<int<0,max>, \TipoCambio\Type\VarDolar> $VarDolar
     * @return static
     */
    public function withVarDolar(?array $VarDolar) : static
    {
        $new = clone $this;
        $new->VarDolar = $VarDolar;

        return $new;
    }
}

