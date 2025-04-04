<?php

namespace TipoCambio\Type;

use Phpro\SoapClient\Type\ResultInterface;

class TipoCambioDiaStringResponse implements ResultInterface
{
    /**
     * @var null | string
     */
    private ?string $TipoCambioDiaStringResult = null;

    /**
     * @return null | string
     */
    public function getTipoCambioDiaStringResult() : ?string
    {
        return $this->TipoCambioDiaStringResult;
    }

    /**
     * @param null | string $TipoCambioDiaStringResult
     * @return static
     */
    public function withTipoCambioDiaStringResult(?string $TipoCambioDiaStringResult) : static
    {
        $new = clone $this;
        $new->TipoCambioDiaStringResult = $TipoCambioDiaStringResult;

        return $new;
    }
}

