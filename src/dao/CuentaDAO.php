<?php

namespace App\dao;

use App\modelo\Cuenta;
use App\modelo\CuentaAhorros;
use App\modelo\CuentaCorriente;
use App\modelo\TipoCuenta;
use App\modelo\Operacion;
use App\dao\OperacionDAO;
use \PDO;

/**
 * Clase CuentaDAO
 */
class CuentaDAO {

    /**
     * Conexión a la base de datos
     * @var PDO
     */
    private PDO $bd;

    /**
     * DAO para gestionar operaciones
     * @var OperacionDAO
     */
    private OperacionDAO $operacionDAO;

    public function __construct(PDO $bd, OperacionDAO $operacionDAO) {
        $this->bd = $bd;
        $this->operacionDAO = $operacionDAO;
    }

    /**
     * Crea un registro de una instancia de cuenta
     * @param Cuenta $cuenta
     */
    public function crear(Cuenta $cuenta): int|bool {
        $sql = "INSERT INTO cuentas (cliente_id, tipo, saldo, fecha_creacion, libreta, bonificacion) VALUES (:cliente_id, :tipo, :saldo, :fechaCreacion, :libreta, :bonificacion);";
        $params = [
            'cliente_id' => $cuenta->getIdCliente(),
            'tipo' => $cuenta->getTipo()->value,
            'saldo' => $cuenta->getSaldo(),
            'fechaCreacion' => ($cuenta->getFechaCreacion())->format('Y-m-d H:i:s'),
            'libreta' => ($cuenta instanceof CuentaAhorros) ? $cuenta->getLibreta() : null,
            'bonificacion' => ($cuenta instanceof CuentaAhorros) ? $cuenta->getBonificacion() : null
        ];
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute($params);
        return ($result ? $this->bd->lastInsertId() : false);
    }

    /**
     * Modifica un registro de una instancia de cuenta
     * @param Cuenta $cuenta
     */
    public function modificar(Cuenta $cuenta): bool {
        $sql = "UPDATE cuentas SET cliente_id = :cliente_id, tipo = :tipo, saldo = :saldo, fecha_creacion = :fecha_creacion, libreta = :libreta, bonificacion = :bonificacion WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute([
            'id' => $cuenta->getId(),
            'cliente_id' => $cuenta->getIdCliente(),
            'tipo' => ($cuenta->getTipo())->value,
            'saldo' => $cuenta->getSaldo(),
            'fecha_creacion' => ($cuenta->getFechaCreacion())->format('Y-m-d H:i:s'),
            'libreta' => ($cuenta instanceof CuentaAhorros) ? $cuenta->getLibreta() : null,
            'bonificacion' => ($cuenta instanceof CuentaAhorros) ? $cuenta->getBonificacion() : null
        ]);
        return $result;
    }

    /**
     * Elimina un registro de una instancia de cuenta
     * @param int $id
     */
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM cuentas WHERE id = :id";
        $operaciones = $this->operacionDAO->recuperaPorIdCuenta($id);
        foreach ($operaciones as $operacion) {
            $this->operacionDAO->eliminar($operacion->getId());
        }
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }

    /**
     * Obtener una cuenta dado su identificador
     * @param int $id
     * @return Cuenta|null
     */
    public function recuperaPorId(int $id): ?Cuenta {
        $sql = "SELECT id, cliente_id as idCliente, tipo, saldo, fecha_creacion as fechaCreacion, libreta, bonificacion FROM cuentas WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $datosCuenta = $stmt->fetch();
        return $datosCuenta ? $this->crearCuenta($datosCuenta) : null;
    }

    /**
     * Obtener los identificadores de las cuentas de un cliente dado su identificador
     * @param int $idCliente
     * @return array
     */
    public function recuperaIdCuentasPorClienteId(int $idCliente): array {
        $sql = "SELECT id FROM cuentas WHERE cliente_id = :idCliente;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['idCliente' => $idCliente]);
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $idCuentas = $stmt->fetchAll() ?? [];
        return array_merge(...$idCuentas);
    }

    /**
     * Obtiene todas las cuentas de la base de datos
     * 
     * @return array
     */
    public function recuperaTodos(): array {
        $sql = "SELECT id, cliente_id as idCliente, tipo, saldo, fecha_creacion as fechaCreacion, libreta, bonificacion FROM cuentas;";
        $stmt = $this->bd->query($sql);
        $cuentasDatos = $stmt->fetchAll(PDO::FETCH_OBJ);
        return array_filter(array_map(fn($datos) => $this->crearCuenta($datos), $cuentasDatos));
    }

    /**
     * Crea una cuenta a partir de los datos obtenidos del registro
     * 
     * @param object $datosCuenta
     * @return Cuenta
     */
    private function crearCuenta(object $datosCuenta): ?Cuenta {
        $cuenta = match ($datosCuenta->tipo) {
            TipoCuenta::AHORROS->value => (new CuentaAhorros($datosCuenta->idCliente, $datosCuenta->libreta, $datosCuenta->bonificacion, (float) $datosCuenta->saldo, $datosCuenta->fechaCreacion)),
            TipoCuenta::CORRIENTE->value => (new CuentaCorriente($datosCuenta->idCliente, (float) $datosCuenta->saldo, $datosCuenta->fechaCreacion)),
            default => null
        };
        if ($cuenta) {
            $cuenta->setId($datosCuenta->id);
            $operaciones = $this->operacionDAO->recuperaPorIdCuenta($datosCuenta->id);
            $cuenta->setOperaciones($operaciones);
        }
        return $cuenta ?? null;
    }
}
