<?php 

    require_once __DIR__ . '../app/controllers/LoginController.php';

    $route = $_GET['route'] ?? null;

    $controller = new LoginController();


    switch ($route) {

    case 'login':
        $controller->login();
        break;

    default:
        echo "Rota não encontrada";
        break;
    }
?>