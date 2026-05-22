<?php 
    require_once __DIR__ . '/../models/UsuarioModel.php';
    require_once __DIR__ . '/../entities/Usuario.php';

    class CadastroController{
        
        public function telaCadastro(){
            require __DIR__ . '/../views/pages/Cadastro.php';
        }

        public function cadastrar(){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $senha = $_POST['password'];

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $usuario = new Usuario(
                $nome,
                $email,
                $senhaHash
            );

            $model = new UsuarioModel();
            $id = $model->inserirUsuario($usuario);

            if($id){
                header("Location: index.php?route=telaLogin");
                exit;
            }
        }
    }
?>