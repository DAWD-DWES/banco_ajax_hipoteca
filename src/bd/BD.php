<?php
namespace App\BD;

use Dotenv\Dotenv;
use PDO;
use PDOException;
use Exception;

class BD {

    private static ?BD $instance = null; // Singleton de la clase
    private ?PDO $conexion = null; // Conexión PDO

    private function __construct() {
        try {
            // Cargar .env si aún no está cargado
            if (!isset($_ENV['DB_HOST'])) {
                $dotenv = Dotenv::createImmutable(__DIR__ . "/../../");
                $dotenv->safeLoad(); // Usa safeLoad para evitar errores si falta el .env
            }

            $host = $_ENV['DB_HOST'];
            $database = $_ENV['DB_DATABASE'];
            $username = $_ENV['DB_USUARIO'];
            $password = $_ENV['DB_PASSWORD'];

            // Crear la conexión PDO
            $this->conexion = new PDO(
                "mysql:host=$host;dbname=$database;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            throw new Exception("Error de conexión: " . $e->getMessage(), (int)$e->getCode());
        }
    }

    public static function getConexion(): PDO {
        if (self::$instance === null) {
            self::$instance = new BD();
        }
        return self::$instance->conexion;
    }

    // Evitar la clonación del objeto
    public function __clone() {}

    // Evitar la deserialización del objeto
    public function __wakeup() {}
}
