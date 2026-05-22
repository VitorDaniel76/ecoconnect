<?php 

    require_once __DIR__ . '/../app/controllers/LoginController.php';
    require_once __DIR__ . '/../app/controllers/CadastroController.php';
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

    default:
        echo "Rota não encontrada";
        break;
    }
?>