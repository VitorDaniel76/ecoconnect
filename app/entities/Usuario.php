<?php
    class Usuario{

        private ?int $id = null;

        private string $nome;
        private string $email;
        private string $senha_hash;

        private ?string $telefone;
        private ?string $foto_perfil;
        private ?string $cidade;
        private ?string $estado;

        private string $data_cadastro;

        public function __construct(
            string $nome,
            string $email,
            string $senha_hash,
            ?string $telefone = null,
            ?string $cidade = null,
            ?string $estado = null,
            ?string $foto_perfil = null
        ){
            $this->nome = $nome;
            $this->email = $email;

            $this->senha_hash = $senha_hash;
            
            $this->telefone = $telefone;
            $this->cidade = $cidade;
            $this->estado = $estado;
            $this->foto_perfil = $foto_perfil;

        }

        public static function fromDatabase(array $dados): Usuario {

        $usuario = new Usuario(
            $dados['nome'],
            $dados['email'],
            $dados['senha_hash'],
            $dados['telefone'] ?? null,
            $dados['cidade'] ?? null,
            $dados['estado'] ?? null,
            $dados['foto_perfil'] ?? null
        );

        $usuario->id = $dados['id_usuario'];
        $usuario->data_cadastro = $dados['data_cadastro'];

        return $usuario;
    }

        public function getId(): ?int {
            return $this->id;
        }

        public function getNome(): string {
            return $this->nome;
        }

        public function getEmail(): string {
            return $this->email;
        }

        public function getSenhaHash(): string {
            return $this->senha_hash;
        }

        public function getTelefone(): ?string {
            return $this->telefone;
        }

        public function getCidade(): ?string {
            return $this->cidade;
        }

        public function getEstado(): ?string {
            return $this->estado;
        }

        public function getFotoPerfil(): ?string {
            return $this->foto_perfil;
        }
    }
?>