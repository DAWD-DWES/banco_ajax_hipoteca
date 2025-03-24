<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioFechaInicialResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\DataVariable
     */
    private ?\TipoCambio\Type\DataVariable $TipoCambioFechaInicialResult = null;

    /**
     * @return null | \TipoCambio\Type\DataVariable
     */
    public function getTipoCambioFechaInicialResult() : ?\TipoCambio\Type\DataVariable
    {
        return $this->TipoCambioFechaInicialResult;
    }

    /**
     * @param null | \TipoCambio\Type\DataVariable $TipoCambioFechaInicialResult
     * @return static
     */
    public function withTipoCambioFechaInicialResult(?\TipoCambio\Type\DataVariable $TipoCambioFechaInicialResult) : static
    {
        $new = clone $this;
        $new->TipoCambioFechaInicialResult = $TipoCambioFechaInicialResult;

        return $new;
    }
}

