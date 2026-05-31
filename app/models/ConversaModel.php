<?php
    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Conversa.php';

    class ConversaModel {

        private PDO $conn;

        public function __construct(){
            $database = new Database();
            $this->conn = $database->conectar();
        }

        // CRIAR CONVERSA
        public function criarConversa(Conversa $conversa): ?int {
            try {

                $sql = "INSERT INTO conversa (id_usuario_1, id_usuario_2, data_criacao)
                        VALUES (?, ?, NOW())";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([
                    $conversa->getIdUsuario1(),
                    $conversa->getIdUsuario2()
                ]);

                return (int) $this->conn->lastInsertId();

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        // BUSCAR CONVERSA ENTRE DOIS USUÁRIOS
        public function buscarConversa(int $id1, int $id2): ?Conversa {
            try {

                $sql = "SELECT * FROM conversa
                        WHERE (id_usuario_1 = ? AND id_usuario_2 = ?)
                           OR (id_usuario_1 = ? AND id_usuario_2 = ?)";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([$id1, $id2, $id2, $id1]);

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$dados) return null;

                return Conversa::fromDatabase($dados);

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        // LISTAR CONVERSAS DE UM USUÁRIO
        public function listarConversas(int $idUsuario): array {
            try {

                $sql = "SELECT * FROM conversa
                        WHERE id_usuario_1 = ?
                           OR id_usuario_2 = ?
                        ORDER BY data_criacao DESC";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$idUsuario, $idUsuario]);

                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $conversas = [];

                foreach ($dados as $linha) {
                    $conversas[] = Conversa::fromDatabase($linha);
                }

                return $conversas;

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return [];
            }
        }

        public function obterOuCriarConversa(int $id1, int $id2): int {
            try {

                // 1. tenta buscar conversa existente
                $sql = "SELECT id_conversa FROM conversa
                        WHERE (id_usuario_1 = ? AND id_usuario_2 = ?)
                        OR (id_usuario_1 = ? AND id_usuario_2 = ?)";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id1, $id2, $id2, $id1]);

                $conversa = $stmt->fetch(PDO::FETCH_ASSOC);

                // se já existe, retorna
                if ($conversa) {
                    return (int) $conversa['id_conversa'];
                }

                // 2. se não existe, cria nova conversa
                $sql = "INSERT INTO conversa (id_usuario_1, id_usuario_2, data_criacao)
                        VALUES (?, ?, NOW())";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id1, $id2]);

                return (int) $this->conn->lastInsertId();

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return 0;
            }
        }

        public function buscarPorId(int $id): ?Conversa {
            try {

                $sql = "SELECT * FROM conversa WHERE id_conversa = ?";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id]);

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$dados) {
                    return null;
                }

                return Conversa::fromDatabase($dados);

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }
    }
?>