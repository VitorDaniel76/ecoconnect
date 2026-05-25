<?php 
    class Categoria{
        private ?int $id = null;
        private string $nome;

        public function __construct(string $nome)
        {
            $this->nome = $nome;
        }

        public static function fromDatabase(array $dados): Categoria{
            $cat = new Categoria($dados['nome']);

            $cat->id = $dados['id_categoria'];

            return $cat;
        }
    }


?>