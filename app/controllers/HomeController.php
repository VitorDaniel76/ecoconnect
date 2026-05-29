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

            $busca = trim($_GET['busca'] ?? '');
            $categorias = $categoriaModel->carregarCategorias();
            $idCategoria = isset($_GET['categoria']) ? (int) $_GET['categoria'] : null;

            $pagina = isset($_GET['page']) ? (int) $_GET['page'] : 1;
            $pagina = max(1, $pagina);

            $paginaAtualNumero = $pagina;
            $limite = 10;

            $offset = ($pagina -1) * $limite;

            if (!empty($busca)){
                $itens = $itemModel->buscarItensPorNome(
                    $busca,
                    $limite,
                    $offset
                );
                $totalItens = $itemModel->contarItensPorNome($busca);
            }elseif($idCategoria){
                $itens = $itemModel->carregarItensPorCategoria(
                    $idCategoria,
                    $limite,
                    $offset
                );
                $totalItens = $itemModel->contarItensPorCategoria($idCategoria);
            }else{
                $itens = $itemModel->carregarItens(
                    $limite,
                    $offset
                );
                $totalItens = $itemModel->contarItens();
            }

            $title = 'Home';
            $pageCss = 'home';
            $pageJs = 'home';
            $page = __DIR__ . '/../views/pages/Home.php';

            $paginaAtual = 'home';
            $categoriaAtual = $idCategoria;
            $totalPaginas = ceil($totalItens / $limite);

            require __DIR__ . '/../views/layouts/app-layout.php';
        }
    }
?>