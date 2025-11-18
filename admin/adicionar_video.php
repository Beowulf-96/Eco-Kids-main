<?php
require_once 'verifica_admin.php';
verifica_admin();
require 'conexao.php';
include 'header.php';

$conexao = new Conexao();
$conn = $conexao->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = 'video';
    $stmt = $conn->prepare("INSERT INTO conteudo (titulo, tipo, descricao, caminho) VALUES (:titulo, :tipo, :descricao, :caminho)");
    $stmt->bindParam(':titulo', $_POST['titulo']);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descricao', $_POST['descricao']);
    $stmt->bindParam(':caminho', $_POST['caminho']);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<form method="post">
    <label>Título:</label><input type="text" name="titulo" required><br>
    <label>Descrição:</label><textarea name="descricao"></textarea><br>
    <label>Caminho:</label><input type="text" name="caminho" required><br>
    <button type="submit">Salvar vídeo</button>
</form>
