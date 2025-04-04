<?php
require './vendor/autoload.php';

use ServSOAP\CalculoHipoteca;
use Laminas\Soap\AutoDiscover;

$autodiscover = new AutoDiscover();
$autodiscover->setClass(CalculoHipoteca::class)
             ->setUri('http://localhost/banco_soap_hipoteca/servidorSoap/servidor.php');

// Obtener el XML del WSDL
$wsdlXml = $autodiscover->toXml();

// Guardarlo en un fichero
file_put_contents('calculohipoteca.wsdl', $wsdlXml);