<?php 
    require_once __DIR__ . '/../models/Usuario.php';

    class LoginController {

        public function login(){
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;

            if (!$email || !$senha){
                echo "Campos obrigatórios";
                return;
            }

            $usuarioModel = new Usuario("", "", "");
            $usuario = $usuarioModel->buscarPorEmail($email);

            if (!$usuario || !password_verify($senha, $usuario->getSenhaHash())){
                echo "Login inválido";
                return;
            }

            session_start();
            $_SESSION['id_usuario'] = $usuario->getId();

            header("Location: ../views/home.php");

        }
    }
?>