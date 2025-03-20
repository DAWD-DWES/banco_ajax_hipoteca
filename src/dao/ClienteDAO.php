<?php

namespace App\dao;

use App\modelo\Cliente;
use App\dao\CuentaDAO;
use \PDO;

/**
 * Clase ClienteDAO
 */
class ClienteDAO {

    /**
     * Conexión a la base de datos
     * @var PDO
     */
    private PDO $bd;

    /**
     * DAO para gestionar cuentas 
     * @var CuentaDAO
     */
    private CuentaDAO $cuentaDAO;

    public function __construct($bd, $cuentaDAO) {
        $this->bd = $bd;
        $this->cuentaDAO = $cuentaDAO;
    }

    /**
     * Crea un registro de una instancia de cliente
     * @param Cliente $cliente Cliente para crear un registro en la BD
     */
    public function crear(Cliente $cliente): bool {
        $sql = "INSERT INTO clientes (dni, nombre, apellido1, apellido2, fecha_nacimiento, telefono) VALUES (:dni, :nombre, :apellido1, :apellido2, :fecha_nacimiento, :telefono);";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute([
            'dni' => $cliente->getDni(),
            'nombre' => $cliente->getNombre(),
            'apellido1' => $cliente->getApellido1(),
            'apellido2' => $cliente->getApellido2(),
            'fecha_nacimiento' => ($cliente->getFechaNacimiento())->format('Y-m-d'),
            'telefono' => $cliente->getTelefono()
        ]);
        return ($result ? $this->bd->lastInsertId() : false);
    }

    /**
     * Modifica un registro de una instancia de clienteç
     * 
     * @param Cliente $cliente Cliente para modificar un registro en el BD
     */
    public function modificar(Cliente $cliente): bool {
        $sql = "UPDATE clientes SET dni = :dni, nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute([
            'id' => $cliente->getId(),
            'dni' => $cliente->getDni(),
            'nombre' => $cliente->getNombre(),
            'apellido1' => $cliente->getApellido1(),
            'apellido2' => $cliente->getApellido2(),
            'fecha_nacimiento' => ($cliente->getFechaNacimiento())->format('Y-m-d'),
            'telefono' => $cliente->getTelefono()
        ]);
        return $result;
    }

    /**
     * Elimina un registro de una instancia de cliente
     * @param int $id Identificador del cliente a eliminar de la BD
     */
    public function eliminar(int $id): bool {
        $sql = "DELETE FROM clientes WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $result = $stmt->execute(['id' => $id]);
        return $result;
    }

    /**
     * Obtener un cliente dado su identificador
     * 
     * @param int $id
     * @return Cliente|null
     */
    public function recuperaPorId(int $id): ?Cliente {
        $sql = "SELECT id, dni, nombre, apellido1, apellido2, fecha_nacimiento as fechaNacimiento, telefono FROM clientes WHERE id = :id;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['id' => $id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cliente::class);
        $cliente = $stmt->fetch();
        if ($cliente) {
            $cliente->setIdCuentas($this->cuentaDAO->recuperaIdCuentasPorClienteId($cliente->getId()));
        }
        return $cliente ?: null;
    }

    /**
     * Obtener un cliente dado su DNI
     * 
     * @param string $dni
     * @return Cliente|null
     */
    public function recuperaPorDNI(string $dni): ?Cliente {
        $sql = "SELECT id, dni, nombre, apellido1, apellido2, fecha_nacimiento as fechaNacimiento, telefono FROM clientes WHERE dni = :dni;";
        $stmt = $this->bd->prepare($sql);
        $stmt->execute(['dni' => $dni]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, Cliente::class);
        $cliente = $stmt->fetch();
        if ($cliente) {
            $cliente->setIdCuentas($this->cuentaDAO->recuperaIdCuentasPorClienteId($cliente->getId()));
        }
        return $cliente ?: null;
    }

    /**
     * Obtiene la lista de todos los clientes
     * @return array
     */
    public function recuperaTodos(): array {
        $sql = "SELECT id, dni, nombre, apellido1, apellido2, fecha_nacimiento as fechaNacimiento, telefono FROM clientes;";
        $stmt = $this->bd->query($sql);
        $clientes = $stmt->fetchAll(PDO::FETCH_CLASS, Cliente::class);
        array_walk($clientes, function ($cliente) {
            $cliente->setIdCuentas($this->cuentaDAO->recuperaIdCuentasPorClienteId($cliente->getId()));
        });
        return $clientes;
    }

    /**
     * Obtiene el número de clientes en la BD
     * @return int Número de clientes
     */
    public function numeroClientes(): int {
        $sql = "SELECT count(*) FROM clientes;";
        $stmt = $this->bd->query($sql);
        $numero = $stmt->fetchColumn();
        return $numero;
    }
}
