<?php
require_once 'model/DTO/UserDTO.php';
require_once 'model/Menu.php';
class HomeController {
    
    public function index() {
   
        if(!isset($_SESSION['identity'])) {
            header("Location: index.php?c=User&a=login");
            exit();
        }

         $usuario = $_SESSION['identity'];
        $rol = $usuario->rol;

        
        $menu_opciones = Menu::getMenu($rol);

        require_once 'views/home/index.php';
    }
}
?>