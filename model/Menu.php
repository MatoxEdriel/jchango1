<?php
require_once 'model/DTO/MenuDTO.php';

class Menu {
    
    public static function getMenu($rol) {
        $opciones = [];

        if($rol == 'admin') {
            $opciones[] = new MenuDTO('Gestionar Productos', 'index.php?c=Product&a=index', '');
            $opciones[] = new MenuDTO('Ver Ventas', 'index.php?c=Pedido&a=gestion', '');
            $opciones[] = new MenuDTO('Usuarios', 'index.php?c=user&a=index', '');
            $opciones[] = new MenuDTO('Reportes', 'index.php?c=Reporte&a=index', '');
        }
        
        elseif($rol == 'empleado') {
            $opciones[] = new MenuDTO('Gestionar Pedidos', 'index.php?c=Pedido&a=gestion', '');
            $opciones[] = new MenuDTO('Inventario', 'index.php?c=Product&a=gestion', '');
        }
        
        else {
            $opciones[] = new MenuDTO('Mis Compras', 'index.php?c=Pedido&a=mis_pedidos', '');
            $opciones[] = new MenuDTO('Mi Perfil', 'index.php?c=User&a=profile', '');
            $opciones[] = new MenuDTO('Carrito', 'index.php?c=Carrito&a=index', '');
        }

        return $opciones;
    }
}
?>






