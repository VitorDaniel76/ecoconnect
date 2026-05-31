<?php

    require_once __DIR__ . '/../models/ConversaModel.php';
    require_once __DIR__ . '/../models/MensagemModel.php';
    require_once __DIR__ . '/../models/UsuarioModel.php';

    class ConversaController {

        public function mensagens() {

            session_start();

            if (!isset($_SESSION['id_usuario'])) {
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $idUsuario = $_SESSION['id_usuario'];

            $conversaModel = new ConversaModel();
            $mensagemModel = new MensagemModel();
            $usuarioModel = new UsuarioModel();

            // conversas do usuário
            $conversas = $conversaModel->listarConversas($idUsuario);

            $chats = [];

            foreach ($conversas as $conversa) {

                $idConversa = $conversa->getId();

                // mensagens da conversa
                $mensagens = $mensagemModel->listarPorConversa($idConversa);

                $ultimaMensagem = null;

                if (!empty($mensagens)) {
                    $ultimaMensagem = end($mensagens);
                }

                // descobrir outro usuário
                $idOutroUsuario =
                    ($conversa->getIdUsuario1() == $idUsuario)
                        ? $conversa->getIdUsuario2()
                        : $conversa->getIdUsuario1();

                // pegar dados do usuário (nome, etc)
                $usuario = $usuarioModel->carregarUsuarioId($idOutroUsuario);

                $chats[] = [
                    'id_conversa' => $idConversa,
                    'usuario' => $usuario,
                    'ultima_mensagem' => $ultimaMensagem ? $ultimaMensagem->getMensagem() : 'Nenhuma mensagem ainda',
                    'data' => $ultimaMensagem ? $ultimaMensagem->getDataEnvio() : $conversa->getDataCriacao()
                ];
            }

            // view
            $title = 'Conversas';
            $pageCss = 'conversas';
            $pageJs = 'conversas';
            $page = __DIR__ . '/../views/pages/Conversas.php';

            require __DIR__ . '/../views/layouts/app-layout.php';
        }

        public function iniciar() {

            session_start();

            if (!isset($_SESSION['id_usuario'])) {
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $idUsuarioLogado = $_SESSION['id_usuario'];
            $idOutroUsuario = (int) $_GET['id'];

            if ($idUsuarioLogado === $idOutroUsuario) {
                header("Location: " . BASE_URL . "/mensagens");
                exit;
            }

            require_once __DIR__ . '/../models/ConversaModel.php';

            $conversaModel = new ConversaModel();

            $idConversa = $conversaModel->obterOuCriarConversa(
                $idUsuarioLogado,
                $idOutroUsuario
            );

            header("Location: " . BASE_URL . "/mensagens/abrir?id=" . $idConversa);
            exit;
        }

        //abrir chat
        public function abrir() {

            session_start();

            if (!isset($_SESSION['id_usuario'])) {
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $idUsuario = $_SESSION['id_usuario'];
            $idConversa = (int) $_GET['id'];

            $conversaModel = new ConversaModel();
            $mensagemModel = new MensagemModel();
            $usuarioModel = new UsuarioModel();

            // mensagens
            $mensagens = $mensagemModel->listarPorConversa($idConversa);

            // dados da conversa (pra descobrir o outro usuário)
            $conversa = $conversaModel->buscarPorId($idConversa);

            $idOutroUsuario =
                ($conversa->getIdUsuario1() == $idUsuario)
                    ? $conversa->getIdUsuario2()
                    : $conversa->getIdUsuario1();

            $usuario = $usuarioModel->carregarUsuarioId($idOutroUsuario);

            // dados pra view
            $usuarioNome = $usuario->getNome();
            $usuarioFoto = $usuario->getFotoPerfil();

            $title = 'Chat';
            $pageCss = 'chat';
            $pageJs = 'chat';
            $page = __DIR__ . '/../views/pages/Chat.php';

            require __DIR__ . '/../views/layouts/app-layout.php';
        }

        // enviar mensagem
        public function enviar() {

            session_start();

            if (!isset($_SESSION['id_usuario'])) {
                header("Location: " . BASE_URL . "/telaLogin");
                exit;
            }

            $idUsuario = $_SESSION['id_usuario'];
            $idConversa = (int) $_POST['id_conversa'];
            $mensagemTexto = trim($_POST['mensagem']);

            if (empty($mensagemTexto)) {
                header("Location: " . BASE_URL . "/mensagens/abrir?id=" . $idConversa);
                exit;
            }

            require_once __DIR__ . '/../models/MensagemModel.php';

            $mensagem = new Mensagem(
                $idConversa,
                $idUsuario,
                $mensagemTexto,
                0
            );

            $mensagemModel = new MensagemModel();
            $mensagemModel->inserirMensagem($mensagem);

            header("Location: " . BASE_URL . "/mensagens/abrir?id=" . $idConversa);
            exit;
        }
    }


?>