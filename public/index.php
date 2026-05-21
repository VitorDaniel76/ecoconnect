<?php 

    require_once __DIR__ . '/../app/controllers/LoginController.php';

    $route = $_GET['route'] ?? null;

    switch ($route) {

    case 'telaLogin':
        $controller = new LoginController();
        $controller->telaLogin();
        break;

    case 'login':
        $controller = new LoginController();
        $controller->login();
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