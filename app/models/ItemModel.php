<?php 

    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Item.php';

    class ItemModel{

    private PDO $conn;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->conectar();
    }

    public function inserirItem(Item $item): ?int{
        try{
            
            $sql = "INSERT INTO item (id_usuario, id_categoria, titulo, descricao, estado_conservacao, cidade, estado, endereco)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                $item->getIdUsuario(),
                $item->getIdCategoria(),
                $item->getTitulo(),
                $item->getDescricao(),
                $item->getEstadoConservacao(),
                $item->getCidade(),
                $item->getEstado(),
                $item->getEndereco()
            ]);

            return (int) $this->conn->lastInsertId();

        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }

}

?>