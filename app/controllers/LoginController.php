<?php 

    require_once __DIR__ . '/../models/UsuarioModel.php';

    class LoginController {
        public function telaLogin(){
            session_start();
                if(isset($_SESSION['id_usuario'])){
                    header("Location: " . BASE_URL . "/home");
                    exit;
                }

                $title = 'Login';
                $pageCss = 'login';
                $pageJs = 'login';
                $page = __DIR__ . '/../views/pages/Login.php';

                require __DIR__ . '/../views/layouts/auth-layout.php';
            
        }
        public function login(){
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if (!$email || !$senha){
                echo "Campos obrigatórios";
                return;
            }

            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->buscarPorEmail($email);

            if (!$usuario || !password_verify($senha, $usuario->getSenhaHash())){
                echo "Login inválido";
                return;
            }

            session_start();
            $_SESSION['id_usuario'] = $usuario->getId();

            header("Location: " . BASE_URL . "/home");
            exit;

        }

        public function logout(): void{
            session_start();
            session_destroy();

            header("Location: " . BASE_URL . "/telaLogin");
            exit;
        }
    }
?>