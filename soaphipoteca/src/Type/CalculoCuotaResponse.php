<?php

namespace Hipoteca\Type;

use Phpro\SoapClient\Type\ResultInterface;

class CalculoCuotaResponse implements ResultInterface
{
    /**
     * @var null | float
     */
    private ?float $return = null;

    /**
     * @return null | float
     */
    public function getReturn() : ?float
    {
        return $this->return;
    }

    /**
     * @param null | float $return
     * @return static
     */
    public function withReturn(?float $return) : static
    {
        $new = clone $this;
        $new->return = $return;

        return $new;
    }
}

