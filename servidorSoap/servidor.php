<?php
require './vendor/autoload.php';

$url = "http://localhost/banco_soap_hipoteca/servidorSoap/calculohipoteca.wsdl";

use ServSOAP\CalculoHipoteca;

try {
    $server = new SoapServer($url);
    $server->setClass(CalculoHipoteca::class);
    $server->handle();
} catch (SoapFault $f) {
    die("error en server: " . $f->getMessage());
}
