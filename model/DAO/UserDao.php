<?php
require_once 'config/db.php';
require_once 'model/DTO/UserDTO.php';

class UserDAO {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    private function mapToDTO($row) {
        return new UserDTO(
            $row['id'],
            $row['nombre'],
            $row['apellido'],
            $row['email'],
            $row['password'],
            $row['rol']
        );
    }

    public function getAll() {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = $this->mapToDTO($row);
        }
        return $users;
    }

    public function delete($id) {
        $sql_roles = "DELETE FROM user_roles WHERE user_id = :id";
        $stmt_roles = $this->db->prepare($sql_roles);
        $stmt_roles->execute([':id' => $id]);

        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function findByEmail($email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $this->mapToDTO($row);
        }
        return null;
    }

    public function save(UserDTO $user) {
        $rol = 'cliente';
        
        $sql = "INSERT INTO users (nombre, apellido, email, password, rol, created_at) 
                VALUES (:nombre, :apellido, :email, :password, :rol, NOW())";
        
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare($sql);
            $guardado = $stmt->execute([
                ':nombre'   => $user->nombre,
                ':apellido' => $user->apellido,
                ':email'    => $user->email,
                ':password' => $user->password,
                ':rol'      => $rol
            ]);

            if ($guardado) {
                $user_id = $this->db->lastInsertId();
                
                $sql_rol = "INSERT INTO user_roles (user_id, role_id) VALUES (:uid, 3)";
                $stmt_rol = $this->db->prepare($sql_rol);
                $stmt_rol->execute([':uid' => $user_id]);
                
                $this->db->commit();
                return true;
            }
            
            $this->db->rollBack();
            return false;

        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?>