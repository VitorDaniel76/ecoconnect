<?php

require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../entities/TipoMaterial.php';

class TipoMaterialModel
{
    private PDO $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function carregarTodos(): array
    {
        $sql = "SELECT * FROM tipo_material";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $materiais = [];

        foreach ($dados as $linha) {
            $materiais[] = TipoMaterial::fromDatabase($linha);
        }

        return $materiais;
    }

    public function buscarPorId(int $id): ?TipoMaterial
    {
        $sql = "SELECT * FROM tipo_material WHERE id_tipo_material = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$dados) {
            return null;
        }

        return TipoMaterial::fromDatabase($dados);
    }
}

?>