<?php
    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/../entities/Mensagem.php';

    class MensagemModel {

        private PDO $conn;

        public function __construct(){
            $database = new Database();
            $this->conn = $database->conectar();
        }

        // INSERIR MENSAGEM
        public function inserirMensagem(Mensagem $mensagem): ?int {
            try {

                $sql = "INSERT INTO mensagem (id_conversa, id_remetente, mensagem, data_envio, lida)
                        VALUES (?, ?, ?, NOW(), ?)";

                $stmt = $this->conn->prepare($sql);

                $stmt->execute([
                    $mensagem->getIdConversa(),
                    $mensagem->getIdRemetente(),
                    $mensagem->getMensagem(),
                    $mensagem->getLida()
                ]);

                return (int) $this->conn->lastInsertId();

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        // LISTAR MENSAGENS POR CONVERSA
        public function listarPorConversa(int $idConversa): array {
            try {

                $sql = "SELECT * FROM mensagem 
                        WHERE id_conversa = ? 
                        ORDER BY data_envio ASC";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$idConversa]);

                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $mensagens = [];

                foreach ($dados as $linha) {
                    $mensagens[] = Mensagem::fromDatabase($linha);
                }

                return $mensagens;

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return [];
            }
        }

        // MARCAR COMO LIDA
        public function marcarComoLida(int $idMensagem): bool {
            try {

                $sql = "UPDATE mensagem SET lida = 1 WHERE id_mensagem = ?";

                $stmt = $this->conn->prepare($sql);

                return $stmt->execute([$idMensagem]);

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        }

        // DELETAR MENSAGEM
        public function excluirMensagem(int $id): bool {
            try {

                $sql = "DELETE FROM mensagem WHERE id_mensagem = ?";

                $stmt = $this->conn->prepare($sql);

                return $stmt->execute([$id]);

            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
                return false;
            }
        }
    }
?>