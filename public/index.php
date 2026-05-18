<?php 

    require_once __DIR__ . '/../app/controllers/LoginController.php';

    $route = $_GET['route'] ?? null;

    $controller = new LoginController();


    switch ($route) {

    case 'telaLogin':
        $controller->telaLogin();
        break;

    case 'login':
        $controller->login();
        break;
    
    case 'logout':
        $controller->logout();
        break;

    default:
        echo "Rota não encontrada";
        break;
    }
?>