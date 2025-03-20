<?php

require_once '../vendor/autoload.php';
include_once '../src/error_handler.php';
require_once '../src/cargadatos.php';

use App\bd\BD;
use App\dao\{
    OperacionDAO,
    CuentaDAO,
    ClienteDAO
};
use App\modelo\Banco;
   
use eftec\bladeone\BladeOne;
use Dotenv\Dotenv;

// Inicializa el acceso a las variables de entorno

$dotenv = Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

$vistas = __DIR__ . '/../vistas';
$cache = __DIR__ . '/../cache';
$blade = new BladeOne($vistas, $cache, BladeOne::MODE_DEBUG);
$blade->setBaseURL("http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}/");

// Establece conexión a la base de datos PDO
try {
    $bd = BD::getConexion();
} catch (Exception $error) {
    echo $blade->run("cnxbderror", compact('error'));
    die;
}

$operacionDAO = new OperacionDAO($bd);
$cuentaDAO = new CuentaDAO($bd, $operacionDAO);
$clienteDAO = new ClienteDAO($bd, $cuentaDAO);


$banco = new Banco($clienteDAO, $cuentaDAO, $operacionDAO, "Midas", [3, 1000], [1.5, 0.5]);

if (filter_has_var(INPUT_POST, 'creardatos')) {
    cargaDatos($banco);
    echo $blade->run('principal');
} else {
    if ($clienteDAO->numeroClientes() == 0) {
        echo $blade->run('carga_datos');
    } elseif (filter_has_var(INPUT_POST, 'infocliente')) {
        $dni = filter_input(INPUT_POST, 'dnicliente');
        try {
            $cliente = $banco->obtenerCliente($dni);
            $cuentas = array_map(fn($idCuenta) => $banco->obtenerCuenta($idCuenta), $cliente->getIdCuentas());
            echo $blade->run('datos_cliente', compact('cliente', 'cuentas'));
        } catch (ClienteNoEncontradoException $ex) {
            echo $blade->run('principal', ['dniCliente' => $dni, 'errorCliente' => true]);
            exit;
        }
    } elseif (filter_has_var(INPUT_POST, 'infocuenta')) {
        $idCuenta = filter_input(INPUT_POST, 'idcuenta');
        try {
            $cuenta = $banco->obtenerCuenta((int) $idCuenta);
            $cliente = $banco->obtenerClientePorId($cuenta->getIdCliente());
            echo $blade->run('datos_cuenta', compact('cuenta', 'cliente'));
        } catch (CuentaNoEncontradaException $ex) {
            echo $blade->run('principal', ['idCuenta' => $idCuenta, 'errorCuenta' => true]);
            exit;
        }
    } elseif (filter_has_var(INPUT_GET, 'pettransferencia')) {
        echo $blade->run('transferencia');
    } elseif (filter_has_var(INPUT_POST, 'transferencia')) {
        try {
            $dniClienteOrigen = filter_input(INPUT_POST, 'dniclienteorigen', FILTER_UNSAFE_RAW);
            $idCuentaOrigen = (int) filter_input(INPUT_POST, 'idcuentaorigen', FILTER_UNSAFE_RAW);
            $dniClienteDestino = filter_input(INPUT_POST, 'dniclientedestino', FILTER_UNSAFE_RAW);
            $idCuentaDestino = (int) filter_input(INPUT_POST, 'idcuentadestino', FILTER_UNSAFE_RAW);
            $cantidad = (float) filter_input(INPUT_POST, 'cantidad', FILTER_UNSAFE_RAW);
            $asunto = filter_input(INPUT_POST, 'asunto', FILTER_UNSAFE_RAW);
            $banco->realizaTransferencia($dniClienteOrigen, $dniClienteDestino, $idCuentaOrigen, $idCuentaDestino, $cantidad, $asunto);
            $message = "Transferencia realizada con éxito";
        } catch (Exception $ex) {
            $message = $ex->getMessage();
        }
        echo $blade->run('transferencia', compact('message', 'dniClienteOrigen', 'idCuentaOrigen',
                        'dniClienteDestino', 'idCuentaDestino', 'cantidad', 'asunto'));
    } elseif (filter_has_var(INPUT_GET, 'movimientos')) {
        $idCuenta = filter_input(INPUT_GET, 'idCuenta');
        $cuenta = $banco->obtenerCuenta($idCuenta);
        $cliente = $banco->obtenerClientePorId($cuenta->getIdCliente());
        echo $blade->run('datos_cuenta', compact('cuenta', 'cliente'));
    } else {
        echo $blade->run('principal');
    }
}