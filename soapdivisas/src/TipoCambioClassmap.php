<?php

namespace TipoCambio;

use TipoCambio\Type;
use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMapCollection;
use Soap\ExtSoapEngine\Configuration\ClassMap\ClassMap;

class TipoCambioClassmap
{
    public static function getCollection() : \Soap\ExtSoapEngine\Configuration\ClassMap\ClassMapCollection
    {
        return new ClassMapCollection(
            new ClassMap('InfoVariable', Type\InfoVariable::class),
            new ClassMap('ArrayOfVariable', Type\ArrayOfVariable::class),
            new ClassMap('Variable', Type\Variable::class),
            new ClassMap('ArrayOfVar', Type\ArrayOfVar::class),
            new ClassMap('Var', Type\VarType::class),
            new ClassMap('ArrayOfVarDolar', Type\ArrayOfVarDolar::class),
            new ClassMap('VarDolar', Type\VarDolar::class),
            new ClassMap('DataVariable', Type\DataVariable::class),
            new ClassMap('VariablesDisponibles', Type\VariablesDisponibles::class),
            new ClassMap('VariablesDisponiblesResponse', Type\VariablesDisponiblesResponse::class),
            new ClassMap('Variables', Type\Variables::class),
            new ClassMap('VariablesResponse', Type\VariablesResponse::class),
            new ClassMap('TipoCambioFechaInicial', Type\TipoCambioFechaInicial::class),
            new ClassMap('TipoCambioFechaInicialResponse', Type\TipoCambioFechaInicialResponse::class),
            new ClassMap('TipoCambioRango', Type\TipoCambioRango::class),
            new ClassMap('TipoCambioRangoResponse', Type\TipoCambioRangoResponse::class),
            new ClassMap('TipoCambioFechaInicialMoneda', Type\TipoCambioFechaInicialMoneda::class),
            new ClassMap('TipoCambioFechaInicialMonedaResponse', Type\TipoCambioFechaInicialMonedaResponse::class),
            new ClassMap('TipoCambioRangoMoneda', Type\TipoCambioRangoMoneda::class),
            new ClassMap('TipoCambioRangoMonedaResponse', Type\TipoCambioRangoMonedaResponse::class),
            new ClassMap('TipoCambioDia', Type\TipoCambioDia::class),
            new ClassMap('TipoCambioDiaResponse', Type\TipoCambioDiaResponse::class),
            new ClassMap('TipoCambioDiaString', Type\TipoCambioDiaString::class),
            new ClassMap('TipoCambioDiaStringResponse', Type\TipoCambioDiaStringResponse::class),
        );
    }
}

