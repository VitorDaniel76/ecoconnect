<?php 

    require_once __DIR__ . '/../models/ItemModel.php';
    require_once __DIR__ . '/../models/CategoriaModel.php';

    class HomeController{
        public function home(){
            session_start();

            if(!isset($_SESSION['id_usuario'])){
                header("Location: ". BASE_URL . "/telaLogin");
                exit;
            }

            $itemModel = new ItemModel();
            $categoriaModel = new CategoriaModel();

            $busca = $_GET['busca'] ?? '';
            $idCategoria = $_GET['categoria'] ?? null;
            $categorias = $categoriaModel->carregarCategorias();

            if (!empty($busca)){
                $itens = $itemModel->buscarItensPorNome($busca);
            }elseif($idCategoria){
                $itens = $itemModel->carregarItensPorCategoria($idCategoria);
            }else{
                $itens = $itemModel->carregarItens();
            }

            $title = 'Home';
            $pageCss = 'home';
            $pageJs = 'home';
            $page = __DIR__ . '/../views/pages/Home.php';

            $paginaAtual = 'home';
            $categoriaAtual = $idCategoria;

            require __DIR__ . '/../views/layouts/app-layout.php';
        }
    }
?>