<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioDiaResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\InfoVariable
     */
    private ?\TipoCambio\Type\InfoVariable $TipoCambioDiaResult = null;

    /**
     * @return null | \TipoCambio\Type\InfoVariable
     */
    public function getTipoCambioDiaResult() : ?\TipoCambio\Type\InfoVariable
    {
        return $this->TipoCambioDiaResult;
    }

    /**
     * @param null | \TipoCambio\Type\InfoVariable $TipoCambioDiaResult
     * @return static
     */
    public function withTipoCambioDiaResult(?\TipoCambio\Type\InfoVariable $TipoCambioDiaResult) : static
    {
        $new = clone $this;
        $new->TipoCambioDiaResult = $TipoCambioDiaResult;

        return $new;
    }
}

