<?php
    require_once "conexao.php";

    class Funcoes {
        private $var;
        private $conn;

        public function __construct($var) {
            $this->var = $var;
            $conexao = new Conexao();
            $this->conn = $conexao->conectar();
        }

        public function adicionar_conteudo($var) {
        if ($var == "j") {
            $tipo = 'jogo';
            $redirect = 'adicionar_jogo.php';
        } elseif ($var == "v") {
            $tipo = 'video';
            $redirect = 'adicionar_video.php';
        } elseif ($var == "l") {
            $tipo = 'leitura';
            $redirect = 'adicionar_leitura.php';
        } else {
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $stmt = $this->conn->prepare(
                'INSERT INTO conteudo (titulo, tipo, descricao, caminho) 
                 VALUES (:titulo, :tipo, :descricao, :caminho)'
            );
            $stmt->bindParam(':titulo', $_POST['titulo']);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':descricao', $_POST['descricao']);
            $stmt->bindParam(':caminho', $_POST['caminho']);
            $stmt->execute();

            header("Location: $redirect");
            exit;
        }
    }

        public function editar_conteudo($var) {
            
            if ($var == "j") {
                $tipo = 'jogo';
            } elseif ($var == "v") {
                $tipo = 'video';
            } elseif ($var == "l") {
                $tipo = 'leitura';
            } else {
                return;
            }

            if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['editar'])) {

                $stmt = $this->conn->prepare('UPDATE conteudo 
                     SET titulo = :titulo, descricao = :descricao, caminho = :caminho 
                     WHERE id = :id AND tipo = :tipo');
                $stmt->bindParam(':titulo', $_POST['titulo']);
                $stmt->bindParam(':tipo', $tipo);
                $stmt->bindParam(':descricao', $_POST['descricao']);
                $stmt->bindParam(':caminho', $_POST['caminho']);
                $stmt->execute();

                $_SESSION['mensagem'] = 'Editado com sucesso!';
            }
        }

        public function excluir_conteudo($var) {
            if ($var == "j") {
                $tipo = 'jogo';
            } elseif ($var == "v") {
                $tipo = 'video';
            } elseif ($var == "l") {
                $tipo = 'leitura';
            } else {
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['excluir'])) {
                $stmt = $this->conn->prepare(
                    'DELETE FROM conteudo WHERE id = :id AND tipo = :tipo'
                );
                
                $stmt->bindParam(':id', $_POST['id']);
                $stmt->bindParam(':tipo', $tipo);
                $stmt->execute();
                
                $_SESSION['mensagem'] = 'Excluído com sucesso!';
            }
        }

        public function listar_conteudo($var) {
            if ($var == "j") {
                $tipo = 'jogo';
            } elseif ($var == "v") {
                $tipo = 'video';
            } elseif ($var == "l") {
                $tipo = 'leitura';
            } else {
                return;
            }

            $stmt = $this->conn->prepare('SELECT * FROM conteudo WHERE tipo = :tipo');
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>