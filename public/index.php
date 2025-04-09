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
use App\excepciones\ClienteNoEncontradoException;
use App\excepciones\CuentaNoEncontradaException;
use App\excepciones\SaldoInsuficienteException;
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
        // Petición AJAX para obtener cuentas por DNI
    } elseif (filter_has_var(INPUT_POST, 'accion') && filter_input(INPUT_POST, 'accion') === 'cuentasPorDni') {
        header('Content-Type: application/json; charset=utf-8');

        $dni = filter_input(INPUT_POST, 'dni', FILTER_UNSAFE_RAW);

        try {
            $cliente = $banco->obtenerCliente($dni);
            $cuentas = array_map((fn($idCuenta) =>
                    ['id' => $idCuenta]), $cliente->getIdCuentas());
            echo json_encode($cuentas);
            exit;
        } catch (ClienteNoEncontradoException $ex) {
            echo json_encode(['error' => 'El cliente no existe en la base de datos']);
            exit;
        } catch (Exception $e) {
            echo json_encode(['error' => 'Error inesperado en el servidor']);
            exit;
        }
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
    } elseif (filter_has_var(INPUT_POST, 'accion') && filter_input(INPUT_POST, 'accion') === 'realizarTransferencia') {
        header('Content-Type: application/json; charset=utf-8');
        try {
            $dniClienteOrigen = filter_input(INPUT_POST, 'dniclienteorigen');
            $idCuentaOrigen = (int) filter_input(INPUT_POST, 'idcuentaorigen');
            $dniClienteDestino = filter_input(INPUT_POST, 'dniclientedestino');
            $idCuentaDestino = (int) filter_input(INPUT_POST, 'idcuentadestino');
            $cantidad = (float) filter_input(INPUT_POST, 'cantidad');
            $asunto = filter_input(INPUT_POST, 'asunto');

            $banco->realizaTransferencia($dniClienteOrigen, $dniClienteDestino, $idCuentaOrigen, $idCuentaDestino, $cantidad, $asunto);

            echo json_encode([
                "status" => "ok",
                "mensaje" => "Transferencia realizada con éxito."
            ]);
            exit;
        } catch (SaldoInsuficienteException $ex) {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error: Saldo insuficiente en la cuenta de origen"
            ]);
            exit;
        } catch (Exception $ex) {
            echo json_encode([
                "status" => "error",
                "mensaje" => "Error: " . $ex->getMessage()
            ]);
            exit;
        }
    } elseif (filter_has_var(INPUT_GET, 'movimientos')) {
        $idCuenta = filter_input(INPUT_GET, 'idCuenta');
        $cuenta = $banco->obtenerCuenta($idCuenta);
        $cliente = $banco->obtenerClientePorId($cuenta->getIdCliente());
        echo $blade->run('datos_cuenta', compact('cuenta', 'cliente'));
    } else {
        echo $blade->run('principal');
    }
}