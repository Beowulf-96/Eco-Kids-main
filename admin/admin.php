<?php
require_once "conexao.php";

if (!class_exists('Administrador')) {
    class Administrador {
    private $conn;

    public function __construct() {
        $this->conn = (new Conexao())->conectar();
    }

    public function adicionar($nome, $email, $senha) {
        $sql = $this->conn->prepare("SELECT id FROM admin WHERE email = :email");
        $sql->execute([':email' => $email]);
        if ($sql->rowCount() > 0) return false;
        
        $sql = $this->conn->prepare("INSERT INTO admin (nome, email, senha) VALUES (:nome, :email, :senha)");
        $sql->execute([':nome' => $nome, ':email' => $email, ':senha' => $senha]);
        return true;
    }

    public function listar() {
        $sql = $this->conn->query("SELECT * FROM admin");
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscar($id) {
        $sql = $this->conn->prepare("SELECT * FROM admin WHERE id = :id");
        $sql->execute([':id' => $id]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function editar($id, $nome, $email) {
        $sql = $this->conn->prepare("SELECT id FROM admin WHERE email = :email");
        $sql->execute([':email' => $email]);
        $existente = $sql->fetch(PDO::FETCH_ASSOC);
        if ($existente && $existente['id'] != $id) return false;
        
        $sql = $this->conn->prepare("UPDATE admin SET nome = :nome, email = :email WHERE id = :id");
        $sql->execute([':nome' => $nome, ':email' => $email, ':id' => $id]);
        return true;
    }

    public function deletar($id) {
        $sql = $this->conn->prepare("DELETE FROM admin WHERE id = :id");
        $sql->execute([':id' => $id]);
    }

    public function autenticar($email, $senha) {
        $sql = $this->conn->prepare("SELECT * FROM admin WHERE email = :email");
        $sql->execute([':email' => $email]);
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        return ($usuario && $senha === $usuario['senha']) ? $usuario : false;
    }
    }
}
?>