<?php
    class Conversa {

        private ?int $id = null;

        private int $id_usuario_1;
        private int $id_usuario_2;

        private ?string $data_criacao = null;

        public function __construct(
            int $id_usuario_1,
            int $id_usuario_2
        ){
            $this->id_usuario_1 = $id_usuario_1;
            $this->id_usuario_2 = $id_usuario_2;
        }

        public static function fromDatabase(array $dados): Conversa {

            $conversa = new Conversa(
                $dados['id_usuario_1'],
                $dados['id_usuario_2']
            );

            $conversa->id = $dados['id_conversa'];
            $conversa->data_criacao = $dados['data_criacao'];

            return $conversa;
        }

        public function getId(): ?int {
            return $this->id;
        }

        public function getIdUsuario1(): int {
            return $this->id_usuario_1;
        }

        public function getIdUsuario2(): int {
            return $this->id_usuario_2;
        }

        public function getDataCriacao(): ?string {
            return $this->data_criacao;
        }
    }
?>