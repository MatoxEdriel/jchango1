<?php
require_once __DIR__ . '/parameters.php';

class Database {
    public static function connect() {
        $conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
        
        if($conexion->connect_error){
            die("Error de conexión: " . $conexion->connect_error);
        }
        
 
        
        $conexion->set_charset(DB_CHARSET);
        
        return $conexion;
    }
}
?>