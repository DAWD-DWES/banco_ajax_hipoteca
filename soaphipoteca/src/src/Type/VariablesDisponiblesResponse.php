<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class VariablesDisponiblesResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\InfoVariable
     */
    private ?\TipoCambio\Type\InfoVariable $VariablesDisponiblesResult = null;

    /**
     * @return null | \TipoCambio\Type\InfoVariable
     */
    public function getVariablesDisponiblesResult() : ?\TipoCambio\Type\InfoVariable
    {
        return $this->VariablesDisponiblesResult;
    }

    /**
     * @param null | \TipoCambio\Type\InfoVariable $VariablesDisponiblesResult
     * @return static
     */
    public function withVariablesDisponiblesResult(?\TipoCambio\Type\InfoVariable $VariablesDisponiblesResult) : static
    {
        $new = clone $this;
        $new->VariablesDisponiblesResult = $VariablesDisponiblesResult;

        return $new;
    }
}

