<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioRangoMonedaResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\DataVariable
     */
    private ?\TipoCambio\Type\DataVariable $TipoCambioRangoMonedaResult = null;

    /**
     * @return null | \TipoCambio\Type\DataVariable
     */
    public function getTipoCambioRangoMonedaResult() : ?\TipoCambio\Type\DataVariable
    {
        return $this->TipoCambioRangoMonedaResult;
    }

    /**
     * @param null | \TipoCambio\Type\DataVariable $TipoCambioRangoMonedaResult
     * @return static
     */
    public function withTipoCambioRangoMonedaResult(?\TipoCambio\Type\DataVariable $TipoCambioRangoMonedaResult) : static
    {
        $new = clone $this;
        $new->TipoCambioRangoMonedaResult = $TipoCambioRangoMonedaResult;

        return $new;
    }
}

