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
            string $senha,
            ?string $telefone = null,
            ?string $cidade = null,
            ?string $estado = null,
            ?string $foto_perfil = null
        ){
            $this->nome = $nome;
            $this->email = $email;

            $this->senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            
            $this->telefone = $telefone;
            $this->foto_perfil =$foto_perfil;
            $this->cidade = $cidade;
            $this->estado = $estado;

            $this->data_cadastro = date('Y-m-d H:i:s');
        }

        public static function fromDatabase(array $dados): Usuario {

        $usuario = new Usuario(
            $dados['nome'],
            $dados['email'],
            "temp" //
        );

        $usuario->senha_hash = $dados['senha_hash'];

        $usuario->telefone = $dados['telefone'];
        $usuario->cidade = $dados['cidade'];
        $usuario->estado = $dados['estado'];
        $usuario->foto_perfil = $dados['foto_perfil'];

        $usuario->id = $dados['id_usuario'];
        $usuario->data_cadastro = $dados['data_cadastro'];

        return $usuario;
    }

        public function setId(int $id): void {
            $this->id = $id;
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