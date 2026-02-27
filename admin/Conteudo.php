<?php
require_once "conexao.php";

class Conteudo {
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Conexao())->conectar();
    }

    public function adicionar($titulo, $tipo, $descricao, $caminho, $imagem = null, $texto = null) {
        $sql = "INSERT INTO conteudo (titulo, tipo, descricao, caminho, imagem, texto)
                VALUES (:titulo, :tipo, :descricao, :caminho, :imagem, :texto)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':titulo'    => $titulo,
            ':tipo'      => $tipo,
            ':descricao' => $descricao,
            ':caminho'   => $caminho,
            ':imagem'    => $imagem,
            ':texto'     => $texto
        ]);
    }

    public function editar($id, $titulo, $tipo, $descricao, $caminho = null, $imagem = null, $texto = null) {
        $sql = "UPDATE conteudo SET titulo = :titulo, tipo = :tipo, descricao = :descricao";
        $params = [':id' => $id, ':titulo' => $titulo, ':tipo' => $tipo, ':descricao' => $descricao];
        
        if ($caminho) {
            $sql .= ", caminho = :caminho";
            $params[':caminho'] = $caminho;
        }
        if ($imagem) {
            $sql .= ", imagem = :imagem";
            $params[':imagem'] = $imagem;
        }
        if ($texto !== null) {
            $sql .= ", texto = :texto";
            $params[':texto'] = $texto;
        }
        
        $sql .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($params);
    }

    public function excluir($id) {
        $conteudo = $this->buscar($id);

        if ($conteudo && !empty($conteudo['caminho']) && file_exists($conteudo['caminho'])) {
            unlink($conteudo['caminho']);
        }

        $stmt = $this->conn->prepare("DELETE FROM conteudo WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function listar($tipo = null) {
        if ($tipo) {
            $stmt = $this->conn->prepare("SELECT * FROM conteudo WHERE tipo = :tipo ORDER BY id DESC");
            $stmt->execute([':tipo' => $tipo]);
        } else {
            $stmt = $this->conn->query("SELECT * FROM conteudo ORDER BY id DESC");
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $stmt = $this->conn->prepare("SELECT * FROM conteudo WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function uploadArquivo($arquivo, $pasta = "uploads/") {
        if (empty($arquivo['tmp_name'])) {
            return null;
        }

        if (!is_dir($pasta)) {
            mkdir($pasta, 0777, true);
        }

        $nome = time() . "_" . basename($arquivo['name']);
        $caminho = $pasta . $nome;

        return move_uploaded_file($arquivo['tmp_name'], $caminho)
            ? $caminho
            : null;
    }
}