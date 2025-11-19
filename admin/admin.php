<?php
    require_once "conexao.php";

    class Administrador {
        private $id;
        private $nome;
        private $email;
        private $con;

        public function __construct() {
            $this->con = new Conexao();
        }

        private function existeEmail($email) {
            $sql = $this->con->conectar()->prepare("SELECT id FROM admin WHERE email =:email");
            $sql->bindParam(":email", $email);
            $sql->execute();

            if($sql->rowCount() > 0) {
                $array = $sql->fetch();
            } else {
                $array = array();
            }
            return $array; 
        }

        public function adicionar($nome, $email, $senha) {
            $emailExistente = $this->existeEmail($email);
            if (count($emailExistente) == 0) {
                try {
                    $sql = $this->con->conectar()->prepare(
                        "INSERT INTO admin (nome,email,senha) VALUES (:nome, :email, :senha)"
                    );
                    $sql->bindValue(":nome", $nome);
                    $sql->bindValue(":email", $email);
                    $sql->bindValue(":senha", $senha);
                    $sql->execute();
                    return TRUE;
                } catch(PDOException $e) {
                    return "Erro: " . $e->getMessage();
                }
            } else {
                return FALSE;
            }
        }


        public function listar() {
            try {
          $sql = $this->con->conectar()->prepare("SELECT * FROM admin");
          $sql->execute();
          return $sql->fetchALL();
        }catch(PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
        }

        public function buscar($id) {
            try {
                $sql= $this->con->conectar()->prepare("SELECT * FROM admin WHERE id = :id");
                $sql->bindValue(":id", $id);
                $sql->execute();
                return $sql->fetch();
            } catch(PDOException $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        public function editar($id, $nome, $email) {
            $emailExistente = $this->existeEmail($email);
            if(count($emailExistente) > 0 && $emailExistente['id'] != $id) {
                return FALSE;
            } else {
                try {
                    $sql = $this->con->conectar()->prepare("UPDATE admin SET nome = :nome, email = :email WHERE id = :id");
                    $sql->bindValue(":nome", $nome);
                    $sql->bindValue(":email", $email);
                    $sql->bindValue(":id", $id);
                    $sql->execute();
                    return TRUE;
                } catch(PDOException $e) {
                    echo "Erro: " . $e->getMessage();
                }
            }
        }

        public function deletar($id) {
            $sql = $this->con->conectar()->prepare("DELETE FROM admin WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
        }

        public function autenticar($email, $senha) {
            try {
                $sql = $this->con->conectar()->prepare("SELECT * FROM admin WHERE email = :email");
                $sql->bindValue(":email", $email);
                $sql->execute();
                $usuario = $sql->fetch(PDO::FETCH_ASSOC);

                if ($usuario && $senha === $usuario['senha']) {
                    return $usuario;
                } else {
                    return false;
                }
            } catch (PDOException $e){
                return "Erro!" . $e->getMessage();
            }
        }
    }
?>