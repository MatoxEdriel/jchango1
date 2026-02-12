<?php
require_once 'model/DAO/UserDAO.php'; 
require_once 'model/DAO/ProductDAO.php';
require_once 'model/DAO/InvoiceDAO.php';

class ReporteController {

    public function index() {
        if(!isset($_SESSION['identity']) || $_SESSION['identity']->rol != 'admin'){
            header("Location: index.php");
            exit();
        }

        $userDao = new UserDAO();
        $productDao = new ProductDAO();
        $invoiceDao = new InvoiceDAO();

        $users = $userDao->getAll();
        $products = $productDao->getAll();
        $invoices = $invoiceDao->getAll();

        $totalVentas = 0;
        if(!empty($invoices)){
            foreach($invoices as $inv) { 
                $totalVentas += $inv->total_amount; 
            }
        }

        require_once 'views/reporte/index.php';
    }
}