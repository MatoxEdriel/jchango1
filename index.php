<?php
require_once 'model/DTO/UserDTO.php';
session_start();
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'controller/UserController.php';
require_once 'controller/HomeController.php';
require_once 'controller/ProductController.php';

if(isset($_GET['c'])){
    $nombre_controlador = ucfirst($_GET['c']).'Controller';
    
    if(file_exists("controller/$nombre_controlador.php")){
        require_once "controller/$nombre_controlador.php";
        $controlador = new $nombre_controlador();
        
        if(isset($_GET['a']) && method_exists($controlador, $_GET['a'])){
            $accion = $_GET['a'];
            $controlador->$accion();
        } else {
            echo "Error: La acción no existe";
        }
    } else {
        echo "Error: El controlador no existe";
    }
} else {
    require_once 'controller/UserController.php';
    $controlador = new UserController();
    $controlador->login();
}
?>