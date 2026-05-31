<?php 
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/../app/controllers/LoginController.php';
    require_once __DIR__ . '/../app/controllers/CadastroController.php';
    require_once __DIR__ . '/../app/controllers/HomeController.php';
    require_once __DIR__ . '/../app/controllers/PublicarController.php';
    require_once __DIR__ . '/../app/controllers/ItemController.php';
    require_once __DIR__ . '/../app/controllers/ColetaController.php';
    require_once __DIR__ . '/../app/controllers/ConversaController.php';

    $route = $_GET['route'] ?? 'telaLogin';

    switch ($route) {

        case 'telaLogin':
            $controller = new LoginController();
            $controller->telaLogin();
            break;

        case 'login':
            $controller = new LoginController();
            $controller->login();
            break;
        
        case 'telaCadastro':
            $controller = new CadastroController();
            $controller->telaCadastro();
            break;

        case 'cadastrar':
            $controller = new CadastroController();
            $controller->cadastrar();
            break;

        case 'logout':
            $controller = new LoginController();
            $controller->logout();
            break;

        case 'home':
            $controller = new HomeController();
            $controller->home();
            break;
        
        case 'publicar':
            $controller = new PublicarController();
            $controller->publicar();
            break;

        case 'item':
            $controller = new ItemController();
            $controller->item();
            break;

        case 'coleta':
            $controller = new ColetaController();
            $controller->cadastrarColeta();
            break;
        
        case 'mensagens':
            $controller = new ConversaController();
            $controller->mensagens();
            break;
        
        case 'conversas/iniciar':
        $controller = new ConversaController();
        $controller->iniciar();
        break;

        case 'mensagens/abrir':
        $controller = new ConversaController();
        $controller->abrir();
        break;

        case 'mensagens/enviar':
        $controller = new ConversaController();
        $controller->enviar();
        break;

        default:
            echo "Rota não encontrada";
            break;
    }
?>