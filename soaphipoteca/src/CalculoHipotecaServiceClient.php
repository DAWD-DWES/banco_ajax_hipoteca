<?php

namespace Hipoteca;

use Phpro\SoapClient\Caller\Caller;
use Phpro\SoapClient\Type\ResultInterface;
use Hipoteca\Type;
use Phpro\SoapClient\Exception\SoapException;
use Phpro\SoapClient\Type\RequestInterface;

class CalculoHipotecaServiceClient
{
    /**
     * @var Caller
     */
    private $caller;

    public function __construct(\Phpro\SoapClient\Caller\Caller $caller)
    {
        $this->caller = $caller;
    }

    /**
     * calculoCuota
     *
     * @param RequestInterface & Type\CalculoCuotaRequest $peticion
     * @return ResultInterface & Type\CalculoCuotaResponse
     * @throws SoapException
     */
    public function calculoCuota(\Hipoteca\Type\CalculoCuotaRequest $peticion) : \Hipoteca\Type\CalculoCuotaResponse
    {
        $response = ($this->caller)('calculoCuota', $peticion);

        \Psl\Type\instance_of(\Hipoteca\Type\CalculoCuotaResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }
}

