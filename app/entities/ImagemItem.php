<?php 
    class ImagemItem{
        private ?int $id = null;
        private int $idItem;
        private string $url_imagem;

        public function __construct(
            int $idItem,
            string $url_imagem
        )
        {
            $this->idItem = $idItem;
            $this->url_imagem = $url_imagem;
        }

        public static function fromDatabase(array $dados): ImagemItem{
            $imagem = new ImagemItem(
                $dados['id_item'],
                $dados['url']
            );

            $imagem->id = $dados['id_imagem'];

            return $imagem;
        }

        public function getId(): ?int{
            return $this->id;
        }

        public function getIdItem(): int{
            return $this->idItem;
        }

        public function getUrlImagem(): string{
            return $this->url_imagem;
        }
    }

?>