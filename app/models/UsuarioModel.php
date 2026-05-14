<?php

use Database;
use Usuario;
    require_once __DIR__ . '/../../config/Database.php';
    require_once __DIR__ . '/Usuario.php';

    class UsuarioModel{

    private PDO $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function inserirUsuario(Usuario $usuario): ?int {
        try{

            $sql = "INSERT INTO usuario (nome, email, senha_hash) VALUES (?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                $usuario->getNome(),
                $usuario->getEmail(),
                $usuario->getSenhaHash()
            ]);

                return (int) $this->conn->lastInsertId();

            }catch(PDOException $e){
               echo "Erro: " . $e->getMessage();
               return null; 
            }
        }

        public function carregarUsuarioId(int $id): ?Usuario {
            try{

                $sql = "SELECT * FROM usuario WHERE id_usuario = ?";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$id]);

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$dados){
                        return null;
                }

                return Usuario::fromDatabase($dados);

            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        public function buscarPorEmail(string $email): ?Usuario{
            try{

                $sql = "SELECT * FROM usuario WHERE email = ?";

                $stmt = $this->conn->prepare($sql);
                $stmt->execute([$email]);

                $dados = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$dados){
                    return null;
                }

                return Usuario::fromDatabase($dados);

            }catch(PDOException $e){
                echo "Erro: " . $e->getMessage();
                return null;
            }
        }

        public function atualizarUsuario(Usuario $usuario): bool{
            try{
                $sql = "UPDATE usuario SET nome = ?, email = ?, telefone = ?, cidade = ?, estado = ?, 
                foto_perfil = ? WHERE id_usuario = ?";

                $stmt = $this->conn->prepare($sql);

                return $stmt->execute([
                    $usuario->getNome(),
                    $usuario->getEmail(),
                    $usuario->getTelefone(),
                    $usuario->getCidade(),
                    $usuario->getEstado(), 
                    $usuario->getFotoPerfil(),
                    $usuario->getId()
                ]);

            }catch(PDOException $e){
                echo "Erro:" . $e->getMessage();
                return false;
            }
        }
        public function excluirUsuario(int $id): bool{
            try{

                $sql = "DELETE FROM usuario WHERE id_usuario = ?";

                $stmt = $this->conn->prepare($sql);

                return $stmt->execute([$id]);

            }catch(PDOException $e){
                echo "ERRO: " . $e->getMessage();
                return false;
            }
        }
    }  
?>