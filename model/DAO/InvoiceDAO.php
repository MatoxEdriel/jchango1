<?php
require_once 'config/db.php';
require_once 'model/DTO/InvoiceDTO.php';

class InvoiceDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAll() {
        $sql = "SELECT i.*, CONCAT(u.nombre, ' ', u.apellido) as user_full_name 
                FROM invoices i 
                INNER JOIN users u ON i.user_id = u.id 
                ORDER BY i.created_at DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $invoices = [];
        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $invoices[] = new InvoiceDTO(
                $row->id,
                $row->user_id,
                $row->user_full_name,
                $row->total_amount,
                $row->status,
                $row->created_at
            );
        }
        return $invoices;
    }

    public function delete($id) {
        $sql = "DELETE FROM invoices WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function save($userId, $total, $items) {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO invoices (user_id, total_amount, status, created_at) 
                    VALUES (:uid, :total, 'completado', NOW())";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':uid' => $userId,
                ':total' => $total
            ]);

            $invoiceId = $this->db->lastInsertId();

            $sqlItem = "INSERT INTO invoice_items (invoice_id, product_id, quantity, unit_price) 
                        VALUES (:iid, :pid, :qty, :price)";
            $stmtItem = $this->db->prepare($sqlItem);

            foreach ($items as $item) {
                $stmtItem->execute([
                    ':iid'   => $invoiceId,
                    ':pid'   => $item['id'],
                    ':qty'   => $item['quantity'],
                    ':price' => $item['price']
                ]);
                
                $this->db->query("UPDATE products SET stock = stock - {$item['quantity']} WHERE id = {$item['id']}");
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?>