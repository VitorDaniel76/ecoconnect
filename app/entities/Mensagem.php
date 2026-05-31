<?php 

        class Mensagem {

        private ?int $id = null;

        private int $id_conversa;
        private int $id_remetente;

        private string $mensagem;

        private ?string $data_envio = null;

        private int $lida;

        public function __construct(
            int $id_conversa,
            int $id_remetente,
            string $mensagem,
            int $lida = 0
        ){
            $this->id_conversa = $id_conversa;
            $this->id_remetente = $id_remetente;
            $this->mensagem = $mensagem;
            $this->lida = $lida;
        }

        public static function fromDatabase(array $dados): Mensagem {

            $mensagem = new Mensagem(
                $dados['id_conversa'],
                $dados['id_remetente'],
                $dados['mensagem'],
                $dados['lida']
            );

            $mensagem->id = $dados['id_mensagem'];
            $mensagem->data_envio = $dados['data_envio'];

            return $mensagem;
        }

        public function getId(): ?int {
            return $this->id;
        }

        public function getIdConversa(): int {
            return $this->id_conversa;
        }

        public function getIdRemetente(): int {
            return $this->id_remetente;
        }

        public function getMensagem(): string {
            return $this->mensagem;
        }

        public function getDataEnvio(): ?string {
            return $this->data_envio;
        }

        public function getLida(): int {
            return $this->lida;
        }
    }
?>