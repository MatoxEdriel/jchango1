<?php
require_once __DIR__ . '/parameters.php';

class Database {
    public static function connect() {
        
        $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET . ";port=" . DB_PORT;

        $options = [
            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION,
         
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $conexion = new PDO($dsn, DB_USER, DB_PASS, $options);
            return $conexion;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>