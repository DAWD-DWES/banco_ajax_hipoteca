<?php

namespace TipoCambio;

use Phpro\SoapClient\Caller\Caller;
use TipoCambio\Type;
use Phpro\SoapClient\Type\ResultInterface;
use Phpro\SoapClient\Exception\SoapException;
use Phpro\SoapClient\Type\RequestInterface;

class TipoCambioClient
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
     * Despliega las variables (con relación a la moneda) disponibles para consulta.
     *
     * @param RequestInterface & Type\VariablesDisponibles $parameters
     * @return ResultInterface & Type\VariablesDisponiblesResponse
     * @throws SoapException
     */
    public function variablesDisponibles(\TipoCambio\Type\VariablesDisponibles $parameters) : \TipoCambio\Type\VariablesDisponiblesResponse
    {
        $response = ($this->caller)('VariablesDisponibles', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\VariablesDisponiblesResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Despliega el tipo de cambio correspondiente a una variable (moneda) dada. (Formato: moneda=2) 
     *
     * @param RequestInterface & Type\Variables $parameters
     * @return ResultInterface & Type\VariablesResponse
     * @throws SoapException
     */
    public function variables(\TipoCambio\Type\Variables $parameters) : \TipoCambio\Type\VariablesResponse
    {
        $response = ($this->caller)('Variables', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\VariablesResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Despliega la información del tipo de cambio, en dólares, desde una fecha dada hasta el día corriente. (Formato: fecha_ini=dd/mm/aaaa).
     *
     * @param RequestInterface & Type\TipoCambioFechaInicial $parameters
     * @return ResultInterface & Type\TipoCambioFechaInicialResponse
     * @throws SoapException
     */
    public function tipoCambioFechaInicial(\TipoCambio\Type\TipoCambioFechaInicial $parameters) : \TipoCambio\Type\TipoCambioFechaInicialResponse
    {
        $response = ($this->caller)('TipoCambioFechaInicial', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioFechaInicialResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Despliega la información para dólares en el período de tiempo dado. (Formato: fecha_ini=dd/mm/aaaa fecha_fin=dd/mm/aaaa)
     *
     * @param RequestInterface & Type\TipoCambioRango $parameters
     * @return ResultInterface & Type\TipoCambioRangoResponse
     * @throws SoapException
     */
    public function tipoCambioRango(\TipoCambio\Type\TipoCambioRango $parameters) : \TipoCambio\Type\TipoCambioRangoResponse
    {
        $response = ($this->caller)('TipoCambioRango', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioRangoResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Despliega la información para la variable indicada a partir de una fecha y moneda indicada. (Formato: fecha_ini=dd/mm/aaaa moneda=02).
     *
     * @param RequestInterface & Type\TipoCambioFechaInicialMoneda $parameters
     * @return ResultInterface & Type\TipoCambioFechaInicialMonedaResponse
     * @throws SoapException
     */
    public function tipoCambioFechaInicialMoneda(\TipoCambio\Type\TipoCambioFechaInicialMoneda $parameters) : \TipoCambio\Type\TipoCambioFechaInicialMonedaResponse
    {
        $response = ($this->caller)('TipoCambioFechaInicialMoneda', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioFechaInicialMonedaResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Despliega la información para la variable indicada en el período de tiempo y la moneda dada. (Formato: fecha_ini=dd/mm/aaaa fecha_fin=dd/mm/aaaa moneda=02)
     *
     * @param RequestInterface & Type\TipoCambioRangoMoneda $parameters
     * @return ResultInterface & Type\TipoCambioRangoMonedaResponse
     * @throws SoapException
     */
    public function tipoCambioRangoMoneda(\TipoCambio\Type\TipoCambioRangoMoneda $parameters) : \TipoCambio\Type\TipoCambioRangoMonedaResponse
    {
        $response = ($this->caller)('TipoCambioRangoMoneda', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioRangoMonedaResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Devuelve el cambio del día en dólares
     *
     * @param RequestInterface & Type\TipoCambioDia $parameters
     * @return ResultInterface & Type\TipoCambioDiaResponse
     * @throws SoapException
     */
    public function tipoCambioDia(\TipoCambio\Type\TipoCambioDia $parameters) : \TipoCambio\Type\TipoCambioDiaResponse
    {
        $response = ($this->caller)('TipoCambioDia', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioDiaResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }

    /**
     * Devuelve el cambio del día en dólares
     *
     * @param RequestInterface & Type\TipoCambioDiaString $parameters
     * @return ResultInterface & Type\TipoCambioDiaStringResponse
     * @throws SoapException
     */
    public function tipoCambioDiaString(\TipoCambio\Type\TipoCambioDiaString $parameters) : \TipoCambio\Type\TipoCambioDiaStringResponse
    {
        $response = ($this->caller)('TipoCambioDiaString', $parameters);

        \Psl\Type\instance_of(\TipoCambio\Type\TipoCambioDiaStringResponse::class)->assert($response);
        \Psl\Type\instance_of(\Phpro\SoapClient\Type\ResultInterface::class)->assert($response);

        return $response;
    }
}

