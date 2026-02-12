<?php
require_once 'config/db.php';
require_once 'model/DTO/ProductDTO.php';

class ProductDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $products = []; 
        
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $products[] = new ProductDTO(
                $row->id,
                $row->name,
                $row->description,
                $row->price,
                $row->stock,
                $row->image
            );
        }
        return $products;
    }

    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $row = $stmt->fetch(PDO::FETCH_OBJ);

        if ($row) {
            return new ProductDTO(
                $row->id, 
                $row->name, 
                $row->description, 
                $row->price, 
                $row->stock, 
                $row->image
            );
        }
        return null;
    }

    public function create(ProductDTO $prod) {
        $sql = "INSERT INTO products (name, description, price, stock, image, created_at) 
                VALUES (:name, :desc, :price, :stock, :image, NOW())";
        
        $stmt = $this->db->prepare($sql);
        
     
        return $stmt->execute([
            ':name'  => $prod->name,
            ':desc'  => $prod->description,
            ':price' => $prod->price,
            ':stock' => $prod->stock,
            ':image' => $prod->image
        ]);
    }

    // 4. ACTUALIZAR (UPDATE)
    public function update(ProductDTO $prod) {
        $sql = "UPDATE products SET 
                    name = :name, 
                    description = :desc, 
                    price = :price, 
                    stock = :stock, 
                    image = :image 
                WHERE id = :id";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':name'  => $prod->name,
            ':desc'  => $prod->description,
            ':price' => $prod->price,
            ':stock' => $prod->stock,
            ':image' => $prod->image,
            ':id'    => $prod->id
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([':id' => $id]);
    }
}
?>