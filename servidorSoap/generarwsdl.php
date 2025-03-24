<?php
require '../vendor/autoload.php';

require './src/CalculoHipoteca.php';
require_once './src/CalculoCuotaRequest.php';

use Laminas\Soap\AutoDiscover;

$autodiscover = new AutoDiscover();
$autodiscover->setClass(CalculoHipoteca::class)
             ->setUri('http://localhost/servidorSoap/servidor.php');

// Obtener el XML del WSDL
$wsdlXml = $autodiscover->toXml();

// Guardarlo en un fichero
file_put_contents('calculohipoteca.wsdl', $wsdlXml);