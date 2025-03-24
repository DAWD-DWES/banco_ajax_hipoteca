<?php

namespace TipoCambio\Type;

class DataVariable
{
    /**
     * @var null | \TipoCambio\Type\ArrayOfVar
     */
    private ?\TipoCambio\Type\ArrayOfVar $Vars = null;

    /**
     * @var int
     */
    private int $TotalItems;

    /**
     * @return null | \TipoCambio\Type\ArrayOfVar
     */
    public function getVars() : ?\TipoCambio\Type\ArrayOfVar
    {
        return $this->Vars;
    }

    /**
     * @param null | \TipoCambio\Type\ArrayOfVar $Vars
     * @return static
     */
    public function withVars(?\TipoCambio\Type\ArrayOfVar $Vars) : static
    {
        $new = clone $this;
        $new->Vars = $Vars;

        return $new;
    }

    /**
     * @return int
     */
    public function getTotalItems() : int
    {
        return $this->TotalItems;
    }

    /**
     * @param int $TotalItems
     * @return static
     */
    public function withTotalItems(int $TotalItems) : static
    {
        $new = clone $this;
        $new->TotalItems = $TotalItems;

        return $new;
    }
}

