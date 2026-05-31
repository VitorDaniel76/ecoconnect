<?php

require_once __DIR__ . '/../models/ColetaModel.php';
require_once __DIR__ . '/../models/TipoMaterialModel.php';
require_once __DIR__ . '/../models/UsuarioModel.php';

require_once __DIR__ . '/../entities/Coleta.php';

class ColetaController
{
    public function cadastrarColeta()
    {
        session_start();

        if (!isset($_SESSION['id_usuario'])) {
            header("Location: " . BASE_URL . "/telaLogin");
            exit;
        }

        $coletaModel = new ColetaModel();
        $tipoMaterialModel = new TipoMaterialModel();
        $usuarioModel = new UsuarioModel();

        $materiais = $tipoMaterialModel->carregarTodos();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // validações básicas
            if (
                empty($_POST['id_tipo_material']) ||
                empty($_POST['quantidade']) ||
                empty($_POST['data_coleta']) ||
                empty($_POST['periodo']) ||
                empty($_POST['endereco'])
            ) {
                die("Preencha todos os campos obrigatórios");
            }

            // validar tipo de material
            $materialExiste = $tipoMaterialModel->buscarPorId((int) $_POST['id_tipo_material']);
            if (!$materialExiste) {
                die("Tipo de material inválido");
            }

            // validar data
            if (strtotime($_POST['data_coleta']) === false) {
                die("Data inválida");
            }

            $coleta = new Coleta(
                $_SESSION['id_usuario'],
                (int) $_POST['id_tipo_material'],
                $_POST['quantidade'],
                $_POST['data_coleta'],
                $_POST['periodo'],
                $_POST['endereco'],
                $_POST['ponto_referencia'] ?? null,
                $_POST['observacoes'] ?? null,
                'pendente'
            );

            $idColeta = $coletaModel->inserirColeta($coleta);

            if (!$idColeta) {
                die("Erro ao cadastrar coleta");
            }

            header("Location: " . BASE_URL . "/minhasColetas");
            exit;
        }

        $pageCss = 'coleta';
        $pageJs = 'coleta';
        $page = __DIR__ . '/../views/pages/Coleta.php';

        $paginaAtual = 'coleta';

        require __DIR__ . '/../views/layouts/app-layout.php';
    }
}