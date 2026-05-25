<?php 

    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Item.php';
    require_once __DIR__ . '/../entities/Categoria.php';

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
    
    public function carregarItens(int $limit = 10, int $offset = 0): array{

        try{
            $sql = "SELECT * FROM item Order BY id_item DESC LIMIT ? OFFSET ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);
            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $itens = [];

            foreach ($dados as $linha){
                $itens[] = Item::fromDatabase($linha);
            }

            return $itens;

        }catch(PDOException $e){
            echo "Erro" . $e->getMessage();
            return [];
        }

    }

    public function carregarItemID(int $id): ?Item {
        try{
            $sql = "SELECT FROM item WHERE id_item = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([$id]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados){
                return null;
            }

            return Item::fromDatabase($dados);

        }catch(PDOException $e){
            echo "Erro" . $e->getMessage();
            return null;
        }
    }

    public function atualizarItem(Item $item): bool{
        try{

            $sql = "UPDATE item SET id_categoria = ?, titulo = ?, descricao = ?, estado_conservacao = ?, cidade = ?, estado = ?, endereco = ? WHERE id_item =?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $item->getIdCategoria(),
                $item->getTitulo(),
                $item->getDescricao(),
                $item->getEstadoConservacao(),
                $item->getCidade(),
                $item->getEstado(),
                $item->getEndereco(),
                $item->getId()
            ]);

        }catch(PDOException $e){
            echo "Erro" . $e->getMessage();
            return false;
        }
    }

    public function excluirItem(int $id): bool{
        
        try{
            $sql = "DELETE FROM item WHERE id_item = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([$id]);
        }catch(PDOException $e){
            echo 'Erro' . $e->getMessage();
            return false;
        }
    }

    public function carregarItensPorCategoria(int $idCategoria, int $limit = 10, int $offset = 0): array{

        try{

            $sql = "SELECT * FROM item WHERE id_categoria = ? ORDER BY id_item DESC LIMIT ? OFFSET ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $idCategoria, PDO::PARAM_INT);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);

            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $itens = [];

            foreach ($dados as $linha){
                $itens[] = Item::fromDatabase($linha);
            }

            return $itens;

        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
            return [];
        }

    }
}

?>