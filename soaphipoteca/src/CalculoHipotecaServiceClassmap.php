<?php

namespace Hipoteca;

use Hipoteca\Type;
use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMapCollection;
use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMap;

class CalculoHipotecaServiceClassmap
{
    public static function getCollection() : \Soap\ExtSoapEngine\Configuration\ClassMap\ClassMapCollection
    {
        return new ClassMapCollection(
            new ClassMap('CalculoCuotaRequest', Type\CalculoCuotaRequest::class),
            new ClassMap('CalculoCuotaResponse', Type\CalculoCuotaResponse::class),
        );
    }
}

