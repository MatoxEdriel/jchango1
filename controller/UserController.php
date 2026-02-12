<?php
require_once 'model/DAO/UserDAO.php';
require_once 'model/DTO/UserDTO.php';

class UserController {

    public function login() {
        require_once 'views/auth/login.php';
    }

    public function register() {
        require_once 'views/auth/user/register.php';
    }

    public function profile() {
        if(!isset($_SESSION['identity'])){
            header("Location: index.php?c=User&a=login");
            exit();
        }

        $usuario = $_SESSION['identity'];
        require_once 'views/profile/profile.php';
    }

    public function authenticate() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            
            $dao = new UserDAO();
            
            $userDto = $dao->findByEmail($_POST['email']);

            if ($userDto && $_POST['password'] == $userDto->password) {
                
                $_SESSION['identity'] = $userDto; 
                header("Location: index.php?c=Home&a=index");
            } else {
                $_SESSION['login_error'] = "Credenciales incorrectas";
                header("Location: index.php?c=User&a=login");
            }
        }
    }

    public function save() {
        if(isset($_POST)){
            $nombre = $_POST['nombre'] ?? false;
            $apellido = $_POST['apellido'] ?? ''; 
            $email = $_POST['email'] ?? false;
            $password = $_POST['password'] ?? false;

            if($nombre && $email && $password){
             
              
                $nuevoUsuario = new UserDTO(null, $nombre, $apellido, $email, $password, null);

                $dao = new UserDAO();
                $save = $dao->save($nuevoUsuario);

                if($save){
                    header("Location: index.php?c=User&a=login");
                } else {
                    $_SESSION['register_error'] = "Error al guardar";
                    header("Location: index.php?c=User&a=register");
                }
            } else {
                $_SESSION['register_error'] = "Faltan datos";
                header("Location: index.php?c=User&a=register");
            }
        }
    }

    public function logout() {
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }
        header("Location: index.php?c=User&a=login");
    }

    public function index() {
        // Solo administradores deberían ver esto
        if(!isset($_SESSION['identity']) || $_SESSION['identity']->rol != 'admin'){
            header("Location: index.php");
            exit();
        }

        $dao = new UserDAO();
        $users = $dao->getAll();
        require_once 'views/user/index.php';
    }

    public function delete() {
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $dao = new UserDAO();
            $delete = $dao->delete($id);
            
            if($delete){
                $_SESSION['user_action'] = "Usuario eliminado correctamente";
            } else {
                $_SESSION['user_error'] = "No se pudo eliminar el usuario";
            }
        }
        header("Location: index.php?c=User&a=index");
    }
}
?>