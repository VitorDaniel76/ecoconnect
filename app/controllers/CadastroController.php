<?php 
    require_once __DIR__ . '/../models/UsuarioModel.php';
    require_once __DIR__ . '/../entities/Usuario.php';

    class CadastroController{
        
        public function telaCadastro(){
            require __DIR__ . '/../views/pages/Cadastro.php';
        }

        public function cadastrar(){
            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $senha = ($_POST['senha'] ?? '');
            $confirmarSenha = $_POST['confirmar-senha'] ?? '';

            // validações básicas 
            if ($nome === ''){
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return;
            }

            if ($senha === '' || strlen($senha) <6 || strlen($senha) > 255){
                return;
            }

            if ($confirmarSenha === ''){
                return;
            }
            if ($senha !== $confirmarSenha){
                return;
            }

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