<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioRangoResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\DataVariable
     */
    private ?\TipoCambio\Type\DataVariable $TipoCambioRangoResult = null;

    /**
     * @return null | \TipoCambio\Type\DataVariable
     */
    public function getTipoCambioRangoResult() : ?\TipoCambio\Type\DataVariable
    {
        return $this->TipoCambioRangoResult;
    }

    /**
     * @param null | \TipoCambio\Type\DataVariable $TipoCambioRangoResult
     * @return static
     */
    public function withTipoCambioRangoResult(?\TipoCambio\Type\DataVariable $TipoCambioRangoResult) : static
    {
        $new = clone $this;
        $new->TipoCambioRangoResult = $TipoCambioRangoResult;

        return $new;
    }
}

