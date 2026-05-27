<?php 
    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/ImagemItem.php';

    class ImagemItemModel{
        PRIVATE PDO $conn;

        public function __construct()
        {
            $database = new Database();
            $this->conn = $database->conectar();
        }

        public function inserirImagem(ImagemItem $imagem): ?int{
            try{
                $sql = "INSERT INTO imagem_item (id_item, url_imagem) VALUES (?, ?)";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    $imagem->getIdItem(),
                    $imagem->getUrlImagem()
                ]);

                return (int) $this->conn->lastInsertId();
            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
                return null;
            } 
        }

        public function buscarPorItemId(int $itemId): array{
            $sql = "SELECT * FROM imagem_item WHERE id_item = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$itemId]);

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $imagens = [];

            foreach ($dados as $linha){
                $imagens[] = ImagemItem::fromDatabase($linha);
            }

            return $imagens;
        }
    }

?>