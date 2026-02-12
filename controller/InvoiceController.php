<?php
require_once 'model/DAO/InvoiceDAO.php';

class InvoiceController {

public function index() {
        if(!isset($_SESSION['identity']) || $_SESSION['identity']->rol != 'admin'){
            header("Location: index.php");
            exit();
        }

        $invoiceDao = new InvoiceDAO();
        $productDao = new ProductDAO();
        $userDao = new UserDAO();

        $invoices = $invoiceDao->getAll();
        $products = $productDao->getAll(); 
        $users = $userDao->getAll();       

        require_once 'views/invoice/index.php';
    }

    public function create() {
        $productDao = new ProductDAO();
        $userDao = new UserDAO();
        
        $products = $productDao->getAll();
        $users = $userDao->getAll(); 
        
        require_once 'views/invoice/create.php';
    }

    public function delete() {
        if(isset($_GET['id'])){
            $dao = new InvoiceDAO();
            $dao->delete($_GET['id']);
        }
        header("Location: index.php?c=Invoice&a=index");
    }

    public function save() {
        if (isset($_POST) && !empty($_POST['products_selected'])) {
            $userId = $_POST['user_id'];
            $selectedIds = $_POST['products_selected']; // Array de IDs seleccionados
            $quantities = $_POST['qty'];               // Array de cantidades [id => qty]
            $prices = $_POST['prices'];               // Array de precios [id => price]
            
            $itemsToSave = [];
            $totalInvoice = 0;

            foreach ($selectedIds as $id) {
                $qty = $quantities[$id];
                $price = $prices[$id];
                $subtotal = $qty * $price;
                
                $itemsToSave[] = [
                    'id' => $id,
                    'quantity' => $qty,
                    'price' => $price
                ];
                $totalInvoice += $subtotal;
            }

            $dao = new InvoiceDAO();
            $save = $dao->save($userId, $totalInvoice, $itemsToSave);

            if($save) {
                $_SESSION['invoice_action'] = "Factura generada con éxito";
            }
        }
        header("Location: index.php?c=Invoice&a=index");
    }
}
?>