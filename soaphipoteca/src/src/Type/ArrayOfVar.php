<?php

namespace TipoCambio\Type;

class ArrayOfVar
{
    /**
     * @var null | array<int<0,max>, \TipoCambio\Type\VarType>
     */
    private ?array $Var = null;

    /**
     * @return null | array<int<0,max>, \TipoCambio\Type\VarType>
     */
    public function getVar() : ?array
    {
        return $this->Var;
    }

    /**
     * @param null | array<int<0,max>, \TipoCambio\Type\VarType> $Var
     * @return static
     */
    public function withVar(?array $Var) : static
    {
        $new = clone $this;
        $new->Var = $Var;

        return $new;
    }
}

