<?php 
    class HomeController{
        public function home(){
            session_start();

            if(!isset($_SESSION['id_usuario'])){
                header("Location: ". BASE_URL . "/telaLogin");
                exit;
            }

            require __DIR__ . '/../views/pages/Home.php';
        }
    }
?>