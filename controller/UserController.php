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
                    header("Location: index.php?c=User&a=register");
                }
            } else {
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
}
?>