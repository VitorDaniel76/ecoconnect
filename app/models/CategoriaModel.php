<?php 

    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Item.php';

    class CategoriaModel{

        private PDO $conn;

        public function __construct()
        {
            $database = new Database();

            $this->conn = $database->conectar();
        }

        public function carregarCategorias(): array{

            try{
                $sql = "SELECT * FROM categoria ORDER BY nome ASC";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $categorias = [];

                foreach ($dados as $linha){
                    $categorias[] = Categoria::fromDatabase($linha);
                }

                return $categorias;

            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
                return [];
            }
        }

    }

?>