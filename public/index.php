<?php 
    require_once '../config/Database.php';
    $db = new Database();
    $conn = $db->conectar();

    echo "Conectado com sucesso!";
?>