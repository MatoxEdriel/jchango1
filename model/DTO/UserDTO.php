<?php
class UserDTO {
    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $rol;

    public function __construct($id, $nombre, $apellido, $email, $password, $rol) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->password = $password;
        $this->rol = $rol;
    }
}
?>