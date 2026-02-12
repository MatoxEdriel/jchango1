<?php
// Estandarizamos a mayúsculas: DAO y DTO
require_once 'model/DAO/ProductDAO.php';
require_once 'model/DTO/ProductDTO.php';

class ProductController {

    public function index() {
        $dao = new ProductDAO();
        $products = $dao->getAll();
        
        // CORRECCIÓN: La vista se llama 'index.php', no 'product.php'
        require_once 'views/product/index.php';
    }

    public function create() {
        require_once 'views/product/create.php';
    }

    public function save() {
        if (isset($_POST)) {
            $nombre = $_POST['name'] ?? false;
            $descripcion = $_POST['description'] ?? '';
            $precio = $_POST['price'] ?? 0;
            $stock = $_POST['stock'] ?? 0;
            
            $imagen = null;

            if (isset($_FILES['image'])) {
                $file = $_FILES['image'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                    
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }

                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    $imagen = $filename;
                }
            }

            if ($nombre && $precio) {
                $producto = new ProductDTO(null, $nombre, $descripcion, $precio, $stock, $imagen);
                
                $dao = new ProductDAO();
                $save = $dao->create($producto);

                if ($save) {
                    $_SESSION['product_action'] = "Producto creado correctamente";
                } else {
                    $_SESSION['product_error'] = "Error al guardar en base de datos";
                }
            } else {
                $_SESSION['product_error'] = "Faltan campos obligatorios";
            }
        }
        header("Location: index.php?c=Product&a=index");
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dao = new ProductDAO();
            $prod = $dao->getById($id);
            require_once 'views/product/edit.php';
        } else {
            header("Location: index.php?c=Product&a=index");
        }
    }

    public function update() {
        if (isset($_POST) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $nombre = $_POST['name'];
            $descripcion = $_POST['description'];
            $precio = $_POST['price'];
            $stock = $_POST['stock'];
            
            $imagen = $_POST['current_image'] ?? null;

            if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
                $file = $_FILES['image'];
                $filename = $file['name'];
                $mimetype = $file['type'];

                if ($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png') {
                    if (!is_dir('uploads/images')) {
                        mkdir('uploads/images', 0777, true);
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    $imagen = $filename;
                }
            }

            $producto = new ProductDTO($id, $nombre, $descripcion, $precio, $stock, $imagen);
            
            $dao = new ProductDAO();
            $update = $dao->update($producto);

            if ($update) {
                $_SESSION['product_action'] = "Producto actualizado exitosamente";
            } else {
                $_SESSION['product_error'] = "Error al actualizar";
            }
        }
        header("Location: index.php?c=Product&a=index");
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $dao = new ProductDAO();
            $delete = $dao->delete($id);
            
            if ($delete) {
                $_SESSION['product_action'] = "Producto eliminado";
            }
        }
        header("Location: index.php?c=Product&a=index");
    }
}
?>