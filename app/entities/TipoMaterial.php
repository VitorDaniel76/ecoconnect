<?php 

    class TipoMaterial
    {
        private ?int $id = null;
        private string $nome;

        public function __construct(string $nome)
        {
            $this->nome = $nome;
        }

        public static function fromDatabase(array $dados): TipoMaterial
        {
            $material = new TipoMaterial(
                $dados['nome']
            );

            $material->id = $dados['id_tipo_material'];

            return $material;
        }

        public function getId(): ?int
        {
            return $this->id;
        }

        public function getNome(): string
        {
            return $this->nome;
        }
    }
?>