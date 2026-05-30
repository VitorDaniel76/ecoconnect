<?php 

    require_once __DIR__ . '/../models/ItemModel.php';
    require_once __DIR__ . '/../models/CategoriaModel.php';

    class ItemController{
        public function detalhe(){
            session_start();

            if (!isset($_SESSION['id_usuario'])){
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $itemModel = new ItemModel();
            $categoriaModel = new CategoriaModel();

            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

            $item = $itemModel->carregarItemID($id);

            if (!$item){
                echo "Item não encontrado";
                return;
            }

            $categorias = $categoriaModel->carregarCategorias();

            $title = $item->getTitulo();
            $pageCss = 'item';
            $pageJs = 'item';
            $page = __DIR__ . '/../views/pages/Item.php';

            $paginaAtual = 'item';

            require __DIR__ . '/../views/layouts/app-layout.php';
        }


    }
?>