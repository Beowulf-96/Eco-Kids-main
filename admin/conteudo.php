<?php
require 'verifica_admin.php';
verifica_admin();
require 'conexao.php';
include 'header.php';

$conexao = new Conexao();
$conn = $conexao->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo = $_POST['tipo']; // jogo, video ou leitura

    // pasta onde os arquivos serão salvos
    $pasta = "uploads/";

    // gera nome automático
    $nomeArquivo = time() . "_" . $_FILES['arquivo']['name'];

    // caminho gravado no banco
    $caminho = $pasta . $nomeArquivo;

    // move o arquivo enviado
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho);

    // grava no banco
    $stmt = $conn->prepare("
        INSERT INTO conteudo (titulo, tipo, descricao, caminho)
        VALUES (:titulo, :tipo, :descricao, :caminho)
    ");
    $stmt->bindParam(':titulo', $_POST['titulo']);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':descricao', $_POST['descricao']);
    $stmt->bindParam(':caminho', $caminho);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>



<form method="post" enctype="multipart/form-data">
    <label>Título:</label>
    <input type="text" name="titulo" required><br>

    <label>Descrição:</label>
    <textarea name="descricao"></textarea><br>

    <label>Tipo:</label>
    <select name="tipo" required>
        <option value="jogo">Jogo</option>
        <option value="video">Vídeo</option>
        <option value="leitura">Leitura</option>
    </select><br>

    <label>Arquivo:</label>
    <input type="file" name="arquivo" required><br>

    <button type="submit">Salvar</button>
</form>

