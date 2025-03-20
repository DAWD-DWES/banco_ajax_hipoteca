<?php

namespace App\modelo;

use DateTime;

/**
 * Clase Cliente 
 */
class Cliente {

    /**
     * ID del cliente
     * @var int
     */
    private int $id;

    /**
     * DNI del cliente
     * @var string
     */
    private string $dni;

    /**
     * Nombre del cliente
     * @var string
     */
    private string $nombre;

    /**
     * Apellido1 del cliente
     * @var string
     */
    private string $apellido1;

    /**
     * Apellido2 del cliente
     * @var string
     */
    private string $apellido2;

    /**
     * Fecha de nacimiento del cliente
     * @var string
     */
    private string $fechaNacimiento;

    /**
     * Teléfono del cliente
     * @var string
     */
    private string $telefono;

    /**
     * Colección de identificadores de las cuentas del cliente
     * @var array
     */
    private array $idCuentas;

    public function __construct(string $dni = null, string $nombre = null, string $apellido1 = null, string $apellido2 = null, string $telefono = null, Datetime $fechaNacimiento = null) {
        if (func_num_args() > 0) {
            $this->setDni($dni);
            $this->setNombre($nombre);
            $this->setApellido1($apellido1);
            $this->setApellido2($apellido2);
            $this->setTelefono($telefono);
            $this->setFechaNacimiento($fechaNacimiento);
        }
        $this->setIdCuentas([]);
    }

    public function getId(): int {
        return $this->id;
    }

    public function getDni(): string {
        return $this->dni;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getApellido1(): string {
        return $this->apellido1;
    }

    public function getApellido2(): string {
        return $this->apellido2;
    }

    public function getTelefono(): string {
        return $this->telefono;
    }

    //Cuidado con el tipo
    public function getFechaNacimiento(): DateTime {
        return new DateTime($this->fechaNacimiento);
    }

    public function getIdCuentas(): array {
        return $this->idCuentas;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setDni(string $dni): void {
        $this->dni = $dni;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setApellido1(string $apellido1): void {
        $this->apellido1 = $apellido1;
    }

    public function setApellido2(string $apellido2): void {
        $this->apellido2 = $apellido2;
    }

    public function setTelefono(string $telefono): void {
        $this->telefono = $telefono;
    }

    public function setFechaNacimiento(DateTime $fechaNacimiento): void {
        $this->fechaNacimiento = $fechaNacimiento->format('Y-m-d');
    }

    public function setIdCuentas(array $idCuentas): void {
        $this->idCuentas = $idCuentas;
    }

    public function altaCuenta(string $idCuenta): void {
        $this->idCuentas[] = $idCuenta;
    }

    public function existeIdCuenta(string $idCuenta): bool {
        $clave = array_search($idCuenta, $this->getIdCuentas());
        // Si la clave existe en el array, elimina el elemento
        return ($clave !== false);
    }

    public function bajaCuenta(string $idCuenta): void {
        $clave = array_search($idCuenta, $this->getIdCuentas());
// Si la clave existe en el array, elimina el elemento
        if ($clave !== false) {
            unset($this->getIdCuentas[$clave]);
        }
        $this->setIdCuentas(array_values($this->getIdCuentas()));
    }
}
