<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../entities/Coleta.php';

class ColetaModel
{
    private PDO $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function inserirColeta(Coleta $coleta): ?int
    {
        try {

            $sql = "INSERT INTO coleta 
            (id_usuario, id_tipo_material, quantidade, data_coleta, periodo, endereco, ponto_referencia, observacoes, status_coleta) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                $coleta->getIdUsuario(),
                $coleta->getIdTipoMaterial(),
                $coleta->getQuantidade(),
                $coleta->getDataColeta(),
                $coleta->getPeriodo(),
                $coleta->getEndereco(),
                $coleta->getPontoReferencia(),
                $coleta->getObservacoes(),
                $coleta->getStatusColeta()
            ]);

            return (int) $this->conn->lastInsertId();

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }

    public function carregarColetaId(int $id): ?Coleta
    {
        try {

            $sql = "SELECT * FROM coleta WHERE id_coleta = ?";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id]);

            $dados = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$dados) {
                return null;
            }

            return Coleta::fromDatabase($dados);

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }

    public function listarPorUsuario(int $id_usuario): array
    {
        try {

            $sql = "SELECT * FROM coleta WHERE id_usuario = ? ORDER BY data_coleta DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$id_usuario]);

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $coletas = [];

            foreach ($dados as $dado) {
                $coletas[] = Coleta::fromDatabase($dado);
            }

            return $coletas;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function listarPorStatus(string $status): array
    {
        try {

            $sql = "SELECT * FROM coleta WHERE status_coleta = ? ORDER BY data_coleta DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$status]);

            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $coletas = [];

            foreach ($dados as $dado) {
                $coletas[] = Coleta::fromDatabase($dado);
            }

            return $coletas;

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }

    public function atualizarStatus(int $id_coleta, string $status): bool
    {
        try {

            $sql = "UPDATE coleta SET status_coleta = ? WHERE id_coleta = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                $status,
                $id_coleta
            ]);

        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }

    public function excluirColeta(int $id): bool
    {
        try {

            $sql = "DELETE FROM coleta WHERE id_coleta = ?";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([$id]);

        } catch (PDOException $e) {
            echo "ERRO: " . $e->getMessage();
            return false;
        }
    }
}

?>