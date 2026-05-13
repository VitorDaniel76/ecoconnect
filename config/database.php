<?php 
    class Database  {
        private string $serverName = "localhost";
        private string $userName = "root";
        private string $password = "";
        private string $dbName = "projeto_final";

        public function conectar(): PDO{

            try{
                $conn = new PDO("mysql:host={$this->serverName};dbname={$this->dbName};charset=utf8",
                $this->userName, $this->password);
                $conn->setAttribute(
                    PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION
                );

                return $conn;
            }catch(PDOException $e){
                die("Erro na conexão: " . $e->getMessage());
            }
        }
    }
?>