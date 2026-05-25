<?php 
    class Item{
        private ?int $id = null;

        private int $id_usuario;
        private int $id_categoria;

        private string $titulo;

        private string $descricao;
        private string $estado_conservacao;

        private ?string $endereco;
        private string $cidade;
        private string $estado;

        private ?string $status_item = null;
        private ?string $data_publicacao =null;

        public function __construct(
            int $id_usuario,
            int $id_categoria,
            string $titulo,
            string $descricao,
            string $estado_conservacao,
            string $cidade,
            string $estado,
            ?string $endereco = null

        ){
            $this->id_usuario = $id_usuario;
            $this->id_categoria = $id_categoria;

            $this->titulo = $titulo;

            $this->descricao = $descricao;
            $this->estado_conservacao = $estado_conservacao;
            $this->cidade = $cidade;
            $this->estado = $estado;
            $this->endereco = $endereco;
        }

        public static function fromDatabase(array $dados): Item{

            $item = new Item(
                $dados['id_usuario'],
                $dados['id_categoria'],
                $dados['titulo'],
                $dados['descricao'],
                $dados['estado_conservacao'],
                $dados['cidade'],
                $dados['estado'],
                $dados['endereco'] ?? null
            );

            $item->id = $dados['id_item'];
            $item->status_item = $dados['status_item'];
            $item->data_publicacao = $dados['data_publicacao'];

            return $item;
        }

        public function getId(): ?int {
            return $this->id;
        }
        public function getIdUsuario(): int{
            return $this->id_usuario;
        }
        public function getIdCategoria(): int {
            return $this->id_categoria;
        }

        public function getTitulo(): string {
            return $this->titulo;
        }

        public function getDescricao(): string {
            return $this->descricao;
        }

        public function getEstadoConservacao(): string {
            return $this->estado_conservacao;
        }

        public function getCidade(): string {
            return $this->cidade;
        }

        public function getEstado(): string {
            return $this->estado;
        }

        public function getStatusItem(): ?string {
            return $this->status_item;
        }
        
        public function getEndereco(): ?string{
            return $this->endereco;
        }

        public function getDataPublicacao(): ?string{
            return $this->data_publicacao;
        }
    }
?>