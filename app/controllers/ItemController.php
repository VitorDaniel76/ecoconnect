<?php 

    require_once __DIR__ . '/../models/ItemModel.php';
    require_once __DIR__ . '/../models/CategoriaModel.php';

    class ItemController{
        public function item(){
            session_start();

            if (!isset($_SESSION['id_usuario'])){
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $itemModel = new ItemModel();
            $categoriaModel = new CategoriaModel();
            $usuarioModel = new UsuarioModel();

            $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

            $item = $itemModel->carregarItemID($id);
            $imagens = $item->getImagens();

            if (!$item){
                echo "Item não encontrado";
                return;
            }

            $categorias = $categoriaModel->carregarCategorias();

            $categoriaNome = '';
            foreach($categorias as $categoria){
                if ($categoria->getId() === $item->getIdCategoria()){
                    $categoriaNome = $categoria->getNome();
                    break;
                }
            }
            
            $usuario = $usuarioModel->carregarUsuarioId($item->getIdUsuario());

            $usuarioNome = $usuario ? $usuario->getNome() : 'Desconhecido';
            $usuarioCidade = $usuario ? $usuario->getCidade() : '';
            $usuarioEstado = $usuario ? $usuario->getEstado() : '';
            $usuarioFoto = $usuario ? $usuario->getFotoPerfil() : Null;

            $dataPublicacao = $item->getDataPublicacao() ? date('d/m/Y', strtotime($item->getDataPublicacao())) : 'Sem data';
            $usuarioData = $usuario->getDataCadastro() ? date('d/m/Y', strtotime($usuario->getDataCadastro())) : 'Sem data';

            $title = $item->getTitulo();
            $pageCss = 'item';
            $pageJs = 'item';
            $page = __DIR__ . '/../views/pages/Item.php';

            $paginaAtual = 'item';

            require __DIR__ . '/../views/layouts/app-layout.php';
        }


    }
?>