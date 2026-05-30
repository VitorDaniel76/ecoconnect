<?php 

    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Item.php';
    require_once __DIR__ . '/../entities/Categoria.php';
    require_once __DIR__ .  '/../models/ImagemItemModel.php';

    class ItemModel{

    private PDO $conn;
    private ImagemItemModel $imagemModel;

    public function __construct()
    {
        $database = new Database();

        $this->conn = $database->conectar();

        $this->imagemModel = new ImagemItemModel();
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
    
    public function carregarItens(int $limit = 8, int $offset = 0): array{

        try{
            $sql = "SELECT * FROM item Order BY id_item DESC LIMIT ? OFFSET ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, $limit, PDO::PARAM_INT);
            $stmt->bindValue(2, $offset, PDO::PARAM_INT);
            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $itens = [];

            foreach ($dados as $linha){
                $item = Item::fromDatabase($linha);

                $item->setImagens(
                    $this->imagemModel->buscarPorItemId($item->getId())
                );

                $itens[] = $item;
            }

            return $itens;

        }catch(PDOException $e){
            echo "Erro" . $e->getMessage();
            return [];
        }

    }

    public function carregarItemID(int $id): ?Item {
        try{
            $sql = "SELECT * FROM item WHERE id_item = ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([$id]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados){
                return null;
            }

            $item = Item::fromDatabase($dados);

            $item->setImagens(
                $this->imagemModel->buscarPorItemId($item->getId())
            );

            return $item;

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

    public function carregarItensPorCategoria(int $idCategoria, int $limit = 8, int $offset = 0): array{

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
                $item = Item::fromDatabase($linha);

                $item->setImagens(
                    $this->imagemModel->buscarPorItemId($item->getId())
                );

                $itens [] = $item;
            }

            return $itens;

        }catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function buscarItensPorNome(string $nome, int $limit = 8, int $offset = 0): array{
        try{

            $sql = "SELECT * FROM item WHERE titulo LIKE ? ORDER BY id_item DESC LIMIT ? OFFSET ?";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindValue(1, "%$nome%", PDO::PARAM_STR);
            $stmt->bindValue(2, $limit, PDO::PARAM_INT);
            $stmt->bindValue(3, $offset, PDO::PARAM_INT);

            $stmt->execute();

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $itens = [];

            foreach ($dados as $linha){
                $item = Item::fromDatabase($linha);

                $item->setImagens(
                    $this->imagemModel->buscarPorItemId($item->getId())
                    );

                    $itens[] = $item;
            }

            return $itens;

        }catch(PDOException $e){
            echo "Erro" . $e->getMessage();
            return [];
        }
    }

    public function contarItens(): int {
        try {
            $sql = "SELECT COUNT(*) as total FROM item";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return 0;
        }
    }

    public function contarItensPorCategoria(int $idCategoria): int {
        try {
            $sql = "SELECT COUNT(*) as total FROM item WHERE id_categoria = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idCategoria]);

            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return 0;
        }
    }

    public function contarItensPorNome(string $nome): int {
        try {
            $sql = "SELECT COUNT(*) as total FROM item WHERE titulo LIKE ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["%$nome%"]);

            return (int) $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return 0;
        }
    }
}

?>