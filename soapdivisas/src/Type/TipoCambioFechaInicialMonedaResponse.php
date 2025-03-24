<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioFechaInicialMonedaResponse implements ResultInterface
{
    /**
     * @var null | \TipoCambio\Type\DataVariable
     */
    private ?\TipoCambio\Type\DataVariable $TipoCambioFechaInicialMonedaResult = null;

    /**
     * @return null | \TipoCambio\Type\DataVariable
     */
    public function getTipoCambioFechaInicialMonedaResult() : ?\TipoCambio\Type\DataVariable
    {
        return $this->TipoCambioFechaInicialMonedaResult;
    }

    /**
     * @param null | \TipoCambio\Type\DataVariable $TipoCambioFechaInicialMonedaResult
     * @return static
     */
    public function withTipoCambioFechaInicialMonedaResult(?\TipoCambio\Type\DataVariable $TipoCambioFechaInicialMonedaResult) : static
    {
        $new = clone $this;
        $new->TipoCambioFechaInicialMonedaResult = $TipoCambioFechaInicialMonedaResult;

        return $new;
    }
}

