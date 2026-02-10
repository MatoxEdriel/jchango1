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

    public function findByEmail($email) {
        $email = $this->db->real_escape_string($email);
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $this->db->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $this->mapToDTO($row);
        }
        return null;
    }

    public function save(UserDTO $user) {
        $nombre = $this->db->real_escape_string($user->nombre);
        $apellido = $this->db->real_escape_string($user->apellido);
        $email = $this->db->real_escape_string($user->email);
        $password = $this->db->real_escape_string($user->password);
        
        $rol = 'cliente';

        $sql = "INSERT INTO users (nombre, apellido, email, password, rol, created_at) 
                VALUES ('$nombre', '$apellido', '$email', '$password', '$rol', NOW())";
        
        $guardado = $this->db->query($sql);

        if ($guardado) {
            $user_id = $this->db->insert_id;
            $sql_rol = "INSERT INTO user_roles (user_id, role_id) VALUES ($user_id, 3)";
            $this->db->query($sql_rol);
            return true;
        }

        return false;
    }
}
?>