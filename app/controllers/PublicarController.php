<?php 

    
    require_once __DIR__ . '/../models/ItemModel.php';
    require_once __DIR__ . '/../models/CategoriaModel.php';
    require_once __DIR__ . '/../models/ImagemItemModel.php';

    require_once __DIR__ . '/../entities/Item.php';
    require_once __DIR__ . '/../entities/ImagemItem.php';

    class PublicarController{

    public function publicar(){
        session_start();

        if(!isset($_SESSION['id_usuario'])){
            header("Location: " . BASE_URL . "/telaLogin");
            exit;
        }

        $estados = require __DIR__ . '/../../config/estados.php';

        $itemModel = new ItemModel();
        $categoriaModel= new CategoriaModel;
        $imagemModel = new ImagemItemModel();

        $categorias = $categoriaModel->carregarCategorias();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            // validações básicas
            if(
                empty($_POST['titulo']) ||
                empty($_POST['descricao']) ||
                empty($_POST['categoria']) ||
                empty($_POST['estado_conservacao']) ||
                empty($_POST['estado']) ||
                empty($_POST['cidade']) ||
                empty($_FILES['imagem'])
            ){
                die("Preencha todos os campos obrigatórios");
            }
            //validar categoria
            $categoriaExiste = $categoriaModel->buscarPorId($_POST['categoria']);

            if(!$categoriaExiste){
                die("Categoria inválida");
            }
            //validar estado
            if (!isset($estados[$_POST['estado']])){
                die("Estado inválido.");
            }

            //validar upload

            if($_FILES['imagem']['error'] !== UPLOAD_ERR_OK){
                die("Erro no upload da imagem.");
            }

            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/webp'];

            if (!in_array($_FILES['imagem']['type'], $tiposPermitidos)) {
                die("Formato de imagem inválido.");
            }

            $arquivo = $_FILES['imagem'];

            $nomeArquivo = time() . '_' . $arquivo['name'];

            move_uploaded_file(
                $arquivo['tmp_name'],
                __DIR__ . '/../../public/uploads/' . $nomeArquivo
            );

            $urlImagem = BASE_URL . '/uploads/' . $nomeArquivo;

            $item = new Item(
                $_SESSION['id_usuario'],
                $_POST['categoria'],
                $_POST['titulo'],
                $_POST['descricao'],
                $_POST['estado-conservacao'],
                $_POST['cidade'],
                $_POST['estado'],
                $_POST['endereco'] ?? null
            );

            $idItem = $itemModel->inserirItem($item);

            $imagem = new ImagemItem(
                $idItem,
                $urlImagem
            );

            $imagemModel->inserirImagem($imagem);

            header("Location: " . BASE_URL . "/home");
            exit;
        }

        $pageCss = 'publicar';
        $pageJs = 'publicar';
        $page = __DIR__ . '/../views/pages/Publicar.php';

        $paginaAtual = 'publicar';

        require __DIR__ . '/../views/layouts/app-layout.php';
    }
    }


?>