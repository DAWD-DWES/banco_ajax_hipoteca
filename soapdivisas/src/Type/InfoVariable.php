<?php

namespace TipoCambio\Type;

class InfoVariable
{
    /**
     * @var null | \TipoCambio\Type\ArrayOfVariable
     */
    private ?\TipoCambio\Type\ArrayOfVariable $Variables = null;

    /**
     * @var null | \TipoCambio\Type\ArrayOfVar
     */
    private ?\TipoCambio\Type\ArrayOfVar $CambioDia = null;

    /**
     * @var null | \TipoCambio\Type\ArrayOfVarDolar
     */
    private ?\TipoCambio\Type\ArrayOfVarDolar $CambioDolar = null;

    /**
     * @var int
     */
    private int $TotalItems;

    /**
     * @return null | \TipoCambio\Type\ArrayOfVariable
     */
    public function getVariables() : ?\TipoCambio\Type\ArrayOfVariable
    {
        return $this->Variables;
    }

    /**
     * @param null | \TipoCambio\Type\ArrayOfVariable $Variables
     * @return static
     */
    public function withVariables(?\TipoCambio\Type\ArrayOfVariable $Variables) : static
    {
        $new = clone $this;
        $new->Variables = $Variables;

        return $new;
    }

    /**
     * @return null | \TipoCambio\Type\ArrayOfVar
     */
    public function getCambioDia() : ?\TipoCambio\Type\ArrayOfVar
    {
        return $this->CambioDia;
    }

    /**
     * @param null | \TipoCambio\Type\ArrayOfVar $CambioDia
     * @return static
     */
    public function withCambioDia(?\TipoCambio\Type\ArrayOfVar $CambioDia) : static
    {
        $new = clone $this;
        $new->CambioDia = $CambioDia;

        return $new;
    }

    /**
     * @return null | \TipoCambio\Type\ArrayOfVarDolar
     */
    public function getCambioDolar() : ?\TipoCambio\Type\ArrayOfVarDolar
    {
        return $this->CambioDolar;
    }

    /**
     * @param null | \TipoCambio\Type\ArrayOfVarDolar $CambioDolar
     * @return static
     */
    public function withCambioDolar(?\TipoCambio\Type\ArrayOfVarDolar $CambioDolar) : static
    {
        $new = clone $this;
        $new->CambioDolar = $CambioDolar;

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

