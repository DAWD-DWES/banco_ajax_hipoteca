<?php

namespace App\modelo;

use App\bd\BD;
use App\dao\ClienteDAO;
use App\dao\CuentaDAO;
use App\dao\OperacionDAO;
use App\modelo\Cliente;
use App\modelo\Cuenta;
use App\excepciones\ClienteNoEncontradoException;
use App\excepciones\CuentaNoEncontradaException;
use \DateTime;

/**
 * Clase Banco
 */
class Banco {

    /**
     * Comisión de mantenimiento de la cuenta corriente en euros
     * @var float
     */
    private float $comisionCC = 0;

    /**
     * Mínimo saldo para no pagar comisión
     * @var float
     */
    private float $minSaldoComisionCC = 0;

    /**
     * Interés de la cuenta de ahorros en porcentaje
     * @var float
     */
    private float $interesCA = 0;

    /**
     * Interés de la cuenta de ahorros en porcentaje
     * @var float
     */
    private float $bonificacionCA = 0;

    /**
     * Nombre del banco
     * @var string
     */
    private string $nombre;

    /**
     * DAO para persistir clientes
     * @var ClienteDAO
     */
    private ClienteDAO $clienteDAO;

    /**
     * DAO para persistir cuentas
     * @var CuentaDAO
     */
    private CuentaDAO $cuentaDAO;

    /**
     * DAO para persistir operaciones
     * @var OperacionDAO
     */
    private OperacionDAO $operacionDAO;

    /**
     * Constructor de la clase Banco
     * 
     * @param string $nombre Nombre del banco
     */
    public function __construct(ClienteDAO $clienteDAO, CuentaDAO $cuentaDAO, OperacionDAO $operacionDAO, ...$args) {
        $this->clienteDAO = $clienteDAO;
        $this->cuentaDAO = $cuentaDAO;
        $this->operacionDAO = $operacionDAO;
        $this->setNombre($args[0] ?? "Desconocido");
        $this->setComisionCC($args[1][0] ?? 0);
        $this->setMinSaldoComisionCC($args[1][1] ?? 0);
        $this->setInteresCA($args[2][0] ?? 0);
        $this->setBonificacionCA($args[2][1] ?? 0);
    }

    /**
     * Obtiene el nombre del banco
     * 
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * Obtiene los clientes del banco
     * 
     * @return array
     */
    public function obtenerClientes(): array {
        return $this->clienteDAO->recuperaTodos();
    }

    /**
     * Obtiene las cuentas del banco
     * 
     * @return array
     */
    public function obtenerCuentas(): array {
        return $this->cuentaDAO->recuperaTodos();
    }

    /**
     * Obtiene la comisión del banco
     * 
     * @return string
     */
    public function getComisionCC(): float {
        return $this->comisionCC;
    }

    /**
     * Obtiene el mínimo saldo sin comisión
     * 
     * @return string
     */
    public function getMinSaldoComisionCC(): float {
        return $this->minSaldoComisionCC;
    }

    /**
     * Obtiene el interés del banco
     * 
     * @return string
     */
    public function getInteresCA(): float {
        return $this->interesCA;
    }

    /**
     * Obtiene la bonificacion de cuenta de ahorroa
     * 
     * @return float
     */
    public function getBonificacionCA(): float {
        return $this->bonificacionCA;
    }

    /**
     * Establece el nombre del banco
     * 
     * @param string $nombre Nombre del banco
     * @return $this
     */
    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    /**
     * Establece la comision de cuenta corriente del banco
     * 
     * @param float $comisionCC Comisión del banco
     * @return $this
     */
    public function setComisionCC(float $comisionCC): void {
        $this->comisionCC = $comisionCC;
    }

    /**
     * Establece el mínimo saldo para no pagar comisión
     * 
     * @param float $minSaldoComisionCC mínimo saldo sin comisión
     * @return $this
     */
    public function setMinSaldoComisionCC(float $minSaldoComisionCC): void {
        $this->minSaldoComisionCC = $minSaldoComisionCC;
    }

    /**
     * Establece el interés de la cuenta de ahorros del banco
     * 
     * @param float $interesCA Interés del banco
     * @return $this
     */
    public function setInteresCA(float $interesCA): void {
        $this->interesCA = $interesCA;
    }

    /**
     * Establece la bonificacion de la cuenta de ahorros del banco
     * 
     * @param float $bonificacionCA Interés del banco
     */
    public function setBonificacionCA(float $bonificacionCA): void {
        $this->bonificacionCA = $bonificacionCA;
    }

    /**
     * Realiza un alta de cliente del banco
     * 
     * @param string $dni
     * @param string $nombre
     * @param string $apellido1
     * @param string $apellido2
     * @param string telefono
     * @param DateTime $fechaNacimiento
     * @return bool
     */
    public function altaCliente(string $dni, string $nombre, string $apellido1, string $apellido2, string $telefono, string $fechaNacimiento): void {
        $cliente = new Cliente($dni, $nombre, $apellido1, $apellido2, $telefono, new DateTime($fechaNacimiento));
        $idCliente = $this->clienteDAO->crear($cliente);
        $cliente->setId($idCliente);
    }

    /**
     * Realiza una baja de cliente del banco
     * 
     * @param string $dni
     */
    public function bajaCliente(string $dni) {
        $cliente = $this->obtenerCliente($dni);
        $cuentas = $cliente->getIdCuentas();
        foreach ($cuentas as $idCuenta) {
            $this->cuentaDAO->eliminar($idCuenta);
        }
        $this->clienteDAO->eliminar($cliente->getId());
    }

    /**
     * Obtiene el objeto cliente del banco
     * 
     * @param string $dni
     * @return Cliente
     * @throws ClienteNoEncontradoException
     */
    public function obtenerCliente(string $dni): ?Cliente {
        $cliente = $this->clienteDAO->recuperaPorDNI($dni);
        if ($cliente) {
            return $cliente;
        } else {
            throw new ClienteNoEncontradoException($dni);
        }
    }
    
     /**
     * Obtiene el objeto cliente del banco
     * 
     * @param int $idCliente
     * @return Cliente
     * @throws ClienteNoEncontradoException
     */
    public function obtenerClientePorId(int $idCliente): ?Cliente {
        $cliente = $this->clienteDAO->recuperaPorId($idCliente);
        if ($cliente) {
            return $cliente;
        } else {
            throw new ClienteNoEncontradoException($dni);
        }
    }

    /**
     * Crea una cuenta corriente de un cliente del banco
     * 
     * @param string $dni
     */
    public function altaCuentaCorrienteCliente(string $dni): int {
        $cliente = $this->obtenerCliente($dni);
        $cuenta = new CuentaCorriente($cliente->getId());
        $idCuenta = $this->cuentaDAO->crear($cuenta);
        $cuenta->setId($idCuenta);
        return $cuenta->getId();
    }

    /**
     * Crea una cuenta de ahorros de un cliente del banco
     * 
     * @param string $dni
     * @param bool libreta
     */
    public function altaCuentaAhorrosCliente(string $dni, bool $libreta = false): int {
        $cliente = $this->obtenerCliente($dni);
        $cuenta = new CuentaAhorros($cliente->getId(), $libreta, $this->getBonificacionCA());
        $idCuenta = $this->cuentaDAO->crear($cuenta);
        $cuenta->setId($idCuenta);
        return $cuenta->getId();
    }

    /**
     * Elimina una cuenta de un cliente del banco
     * 
     * @param string $dni
     * @param string $idCuenta
     */
    public function bajaCuentaCliente(string $dni, int $idCuenta) {
        $cliente = $this->obtenerCliente($dni);
        $cuenta = $this->obtenerCuenta($idCuenta);
        if ($cliente->getId() === $cuenta->getIdCliente()) {
            $this->cuentaDAO->eliminar($cuenta->getId());
        } else {
            throw new CuentaNoPerteneceClienteException($dni, $idCuenta);
        }
    }

    /**
     * Crea una tarjeta de un cliente del banco
     * 
     * @param string $dni
     */
    public function altaTarjetaCreditoCliente(string $dni): TarjetaCredito {
        $cliente = $this->obtenerCliente($dni);
        $tarjeta = new TarjetaCredito(10000);
        return $tarjeta;
    }

    /**
     * Obtener cuenta bancaria
     * 
     * @param string $idCuenta
     * @return type
     */
    public function obtenerCuenta(int $idCuenta): ?Cuenta {
        $cuenta = $this->cuentaDAO->recuperaPorId($idCuenta);
        if ($cuenta) {
            return $cuenta;
        } else {
            throw new CuentaNoEncontradaException($idCuenta);
        }
    }

    /**
     * Operación de ingreso en una cuenta de un cliente
     * 
     * @param string $dni
     * @param string $idCuenta
     * @param float $cantidad
     * @param string $descripcion
     */
    public function ingresoCuentaCliente(string $dni, string $idCuenta, float $cantidad, string $descripcion) {
        $cliente = $this->obtenerCliente($dni);
        $cuenta = $this->obtenerCuenta($idCuenta);
        if ($cliente->getId() === $cuenta->getIdCliente()) {
            $operacion = $cuenta->ingreso($cantidad, $descripcion);
            $idOperacion = $this->operacionDAO->crear($operacion);
            $operacion->setId($idOperacion);
            $this->cuentaDAO->modificar($cuenta);
        } else {
            throw new CuentaNoPerteneceClienteException($dni, $idCuenta);
        }
    }

    /**
     * Realiza un debito a una cuenta del banco
     * 
     * @param string $dni
     * @param string $idCuenta
     * @param float $saldo
     */
    public function debitoCuentaCliente(string $dni, int $idCuenta, float $cantidad, string $descripcion) {
        $cliente = $this->obtenerCliente($dni);
        $cuenta = $this->obtenerCuenta($idCuenta);
        if ($cliente->getId() === $cuenta->getIdCliente()) {
            $operacion = $cuenta->debito($cantidad, $descripcion);
            $idOperacion = $this->operacionDAO->crear($operacion);
            $operacion->setId($idOperacion);
            $this->cuentaDAO->modificar($cuenta);
        } else {
            throw new CuentaNoPerteneceClienteException($dni, $idCuenta);
        }
    }

    /**
     * Operación para realizar una transferencia de una cuenta de un cliente a otra
     * 
     * @param string $dniClienteOrigen
     * @param string $dniClienteDestino
     * @param string $idCuentaOrigen
     * @param string $idCuentaDestino
     * @param float $cantidad
     * @return bool
     */
    public function realizaTransferencia(string $dniClienteOrigen, string $dniClienteDestino, int $idCuentaOrigen, int $idCuentaDestino, float $cantidad): void {
        $bd = BD::getConexion();
        try {
            $bd->beginTransaction();
            $this->debitoCuentaCliente($dniClienteOrigen, $idCuentaOrigen, $cantidad, "Transferencia de $cantidad € desde su cuenta $idCuentaOrigen a la cuenta $idCuentaDestino");
            $this->ingresoCuentaCliente($dniClienteDestino, $idCuentaDestino, $cantidad, "Transferencia de $cantidad € desde la cuenta $idCuentaOrigen a su cuenta $idCuentaDestino");
            $bd->commit();
        } catch (Exception $ex) {
            $bd->rollback();
            throw $ex;
        }
    }

    /**
     * Aplica cargos de comisión a la cuenta corriente
     */
    public function aplicaComisionCC(): void {
        $cuentasCorrientes = array_filter($this->obtenerCuentas(), fn($cuenta) => $cuenta instanceof CuentaCorriente);
        $comisionCC = $this->getComisionCC();
        $minSaldoComisionCC = $this->getMinSaldoComisionCC();
        array_walk($cuentasCorrientes, function ($cuentaCC) use ($comisionCC, $minSaldoComisionCC) {
            $operacion = $cuentaCC->aplicaComision($comisionCC, $minSaldoComisionCC);
            if ($operacion) {
                $idOperacion = $this->operacionDAO->crear($operacion);
                $operacion->setId($idOperacion);
                $this->cuentaDAO->modificar($cuentaCC);
            }
        });
    }

    public function aplicaInteresCA(): void {
        $cuentasAhorros = array_filter($this->obtenerCuentas(), fn($cuenta) => $cuenta instanceof CuentaAhorros);
        $interesCA = $this->getInteresCA();
        array_walk($cuentasAhorros, function ($cuentaCA) use ($interesCA) {
            $operacion = $cuentaCA->aplicaInteres($interesCA);
            $idOperacion = $this->operacionDAO->crear($operacion);
            $operacion->setId($idOperacion);
            $this->cuentaDAO->modificar($cuentaCA);
        });
    }
}
