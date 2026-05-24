<?php 
    class HomeController{
        public function home(){
            session_start();

            if(!isset($_SESSION['id_usuario'])){
                header("Location: ". BASE_URL . "/telaLogin");
                exit;
            }

            $page = __DIR__ . '/../views/pages/Home.php';

            $paginaAtual = 'home';

            require __DIR__ . '/../views/layouts/app-layout.php';
        }
    }
?>