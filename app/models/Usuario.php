<?php 
     require_once '../config/Database.php';
    Class Usuario{

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

        public function setId(int $id): void{
            $this-> id = $id;
        }

        public function inserirUsuario(): ?int {
            try{
                $database = new Database();
                $conn = $database->conectar();

                $sql = "INSERT INTO usuario (nome, email, senha_hash) VALUES (?, ?, ?)";

                $stmt = $conn->prepare($sql);

                $stmt->execute([
                    $this->nome,
                    $this->email,
                    $this->senha_hash
                ]);

                $this->id = $conn->lastInsertId();

                return (int) $this->id;

            }catch(PDOException $e){
               echo "Erro: " . $e->getMessage();
               return null; 
            }
        }

        public function CarregarUsuario(int $id): ?Usuario {
            try{
                $database = new Database();
                $conn = $database->conectar();

                $sql = "SELECT * FROM usuario WHERE id_usuario = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$id]);

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$dados){
                        return null;
                }

                $usuario = new Usuario(
                    $dados['nome'],
                    $dados['email'],
                    "",
                    $dados['telefone'],
                    $dados['cidade'],
                    $dados['estado'],
                    $dados['foto_perfil']
                );

                $usuario->setId($dados['id_usuario']);
                return $usuario;
            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        public function AtualizarUsuario(): bool{
            try{
                $database = new Database();
                $conn = $database->conectar();

                $sql = "UPDATE usuario SET nome = ?, email = ?, telefone = ?, cidade = ?, estado = ?, 
                foto_perfil = ? WHERE id_usuario = ?";

                $stmt = $conn->prepare($sql);

                return $stmt->execute([
                    $this->nome,
                    $this->email,
                    $this->telefone,
                    $this->cidade,
                    $this->estado, 
                    $this->foto_perfil,
                    $this->id
                ]);

            }catch(PDOException $e){
                echo "Erro:" . $e->getMessage();
                return false;
            }
        }
        public function ExcluirUsuario(int $id): bool{
            try{
                $database = new Database();
                $conn = $database->conectar();

                $sql = "DELETE FROM usuario WHERE id_usuario = ?";

                $stmt = $conn->prepare($sql);

                return $stmt->execute([$id]);

            }catch(PDOException $e){
                echo "ERRO: " . $e->getMessage();
                return false;
            }
        }
    }  
?>