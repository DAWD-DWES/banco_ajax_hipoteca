<?php

namespace App\dao;

use App\modelo\Operacion;
use \PDO;

/**
 * Clase OperacionDAO
 */
class OperacionDAO {

    /**
     * Conexión a la base de datos
     * @var PDO
     */
    private PDO $bd;

    public function __construct($bd) {
        $this->bd = $bd;
    }
    
        /**
     * Crea un registro de una instancia de operación
     * @param Operacion $operacion
     */
    public function crear(Operacion $operacion): bool {
        $sql = "INSERT INTO operaciones (cuenta_id, tipo, cantidad, fecha, descripcion) VALUES (:cuenta_id, :tipo, :cantidad, UNIX_TIMESTAMP(:fecha), :descripcion);";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute([
            'cuenta_id' => $operacion->getIdCuenta(),
            'tipo' => $operacion->getTipo()->value,
            'cantidad' => $operacion->getCantidad(),
            'fecha' => ($operacion->getFecha())->getTimestamp(),
            'descripcion' => $operacion->getDescripcion()
        ]);
        $operacion->setId($this->bd->lastInsertId());
        return $result;
    }

    /**
     * Modifica un registro de una instancia de operación
     * @param Operacion $operacion
     */
    public function modificar(Operacion $operacion): bool {
        $sql = "UPDATE operaciones SET cuenta_id = :cuenta_id, tipo = :tipo, cantidad = :cantidad, fecha = :fecha, descripcion = :descripcion WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute([
            'id' => $operacion->getId(),
            'cuenta_id' => $operacion->getIdCuenta(),
            'tipo' => ($operacion->getTipo())->value,
            'cantidad' => $operacion->getCantidad(),
            'fecha' => $operacion->getFecha()->getTimestamp(),
            'descripcion' => $operacion->getDescripcion()
        ]);
        return $result;
    }

    /**
     * Elimina un registro de una instancia de operación
     * @param type $id
     */
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM operaciones WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }

    /**
     * Obtener operación por identificador
     * @param int $id
     * @return Operacion|null
     */
    public function recuperaPorId(int $id): ?Operacion {
        $sql = "SELECT id as id, cuenta_id as idCuenta, tipo, cantidad, UNIX_TIMESTAMP(fecha) as fecha, descripcion FROM operaciones WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Operacion::class);
        $operacion = $stmt->fetch();
        return $operacion;
    }

    /**
     * Obtener operaciones por identificador de cuenta
     * @param int $idCuenta
     * @return array
     */
    public function recuperaPorIdCuenta(int $idCuenta): array {
        $sql = "SELECT id as id, cuenta_id as idCuenta, tipo, cantidad, UNIX_TIMESTAMP(fecha) as fecha, descripcion FROM operaciones WHERE cuenta_id = :idCuenta;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['idCuenta' => $idCuenta]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Operacion::class);
        $operaciones = $stmt->fetchAll() ?? [];
        return $operaciones;
    }

    /**
     * Obtener todas las operaciones
     * @return array
     */
    public function recuperaTodos(): array {
        $sql = "SELECT id as id, cuenta_id as idCuenta, tipo, cantidad, UNIX_TIMESTAMP(fecha) as fecha, descripcion FROM operaciones;";
        $stmt = $this->bd->query($sql);
        $operaciones = $stmt->fetchAll(PDO::FETCH_CLASS, Operacion::class);
        return $operaciones;
    }
}
