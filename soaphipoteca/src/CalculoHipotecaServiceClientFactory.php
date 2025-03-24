<?php

namespace Hipoteca;

use Hipoteca\CalculoHipotecaServiceClient;
use Hipoteca\CalculoHipotecaServiceClassmap;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Phpro\SoapClient\Soap\DefaultEngineFactory;
use Soap\ExtSoapEngine\ExtSoapOptions;
use Phpro\SoapClient\Caller\EventDispatchingCaller;
use Phpro\SoapClient\Caller\EngineCaller;

class CalculoHipotecaServiceClientFactory
{
    public static function factory(string $wsdl) : \Hipoteca\CalculoHipotecaServiceClient
    {
        $engine = DefaultEngineFactory::create(
            ExtSoapOptions::defaults($wsdl, [])
                ->withClassMap(CalculoHipotecaServiceClassmap::getCollection())
        );

        $eventDispatcher = new EventDispatcher();
        $caller = new EventDispatchingCaller(new EngineCaller($engine), $eventDispatcher);

        return new CalculoHipotecaServiceClient($caller);
    }
}

