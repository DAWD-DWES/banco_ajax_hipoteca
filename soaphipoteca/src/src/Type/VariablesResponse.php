<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class VariablesResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\InfoVariable
     */
    private ?\TipoCambio\Type\InfoVariable $VariablesResult = null;

    /**
     * @return null | \TipoCambio\Type\InfoVariable
     */
    public function getVariablesResult() : ?\TipoCambio\Type\InfoVariable
    {
        return $this->VariablesResult;
    }

    /**
     * @param null | \TipoCambio\Type\InfoVariable $VariablesResult
     * @return static
     */
    public function withVariablesResult(?\TipoCambio\Type\InfoVariable $VariablesResult) : static
    {
        $new = clone $this;
        $new->VariablesResult = $VariablesResult;

        return $new;
    }
}

