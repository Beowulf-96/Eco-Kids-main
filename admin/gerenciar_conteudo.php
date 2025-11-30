<?php
include 'header.php';
require 'verifica_admin.php';
verifica_admin();
require 'conexao.php';

$conexao = new Conexao();
$conn = $conexao->conectar();

// ADICIONAR
if (isset($_POST['adicionar'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    
    // Upload do arquivo
    $pasta = "uploads/";
    $nomeArquivo = time() . "_" . $_FILES['arquivo']['name'];
    $caminho = $pasta . $nomeArquivo;
    
    move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho);
    
    // Salva no banco
    $stmt = $conn->prepare("INSERT INTO conteudo (titulo, tipo, descricao, caminho) VALUES (:titulo, :tipo, :descricao, :caminho)");
    $stmt->execute([':titulo' => $titulo, ':tipo' => $tipo, ':descricao' => $descricao, ':caminho' => $caminho]);
    
    echo "<p>Conteúdo adicionado!</p>";
}

// EXCLUIR
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    
    //Busca o caminho do arquivo
    $stmt = $conn->prepare("SELECT caminho FROM conteudo WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $arquivo = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Deleta o caminho do arquivo
    if ($arquivo && file_exists($arquivo['caminho'])) {
        unlink($arquivo['caminho']);
    }
    // Deleta do banco de dados
    $stmt = $conn->prepare("DELETE FROM conteudo WHERE id = :id");
    $stmt->execute([':id' => $id]);
    
    echo "<p> Conteúdo excluído!</p>";
}

// LISTAR
$stmt = $conn->query("SELECT * FROM conteudo ORDER BY id DESC");
$conteudos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3>Gerenciar Conteúdos</h3>

<h2>Adicionar Novo</h2>
<form method="POST" enctype="multipart/form-data">
    <p>
        <label>Título:</label><br>
        <input type="text" name="titulo" required>
    </p>
    
    <p>
        <label>Tipo:</label><br>
        <select name="tipo" required>
            <option value="jogo">Jogo</option>
            <option value="video">Vídeo</option>
            <option value="leitura">Leitura</option>
        </select>
    </p>
    
    <p>
        <label>Descrição:</label><br>
        <textarea name="descricao" rows="3"></textarea>
    </p>
    
    <p>
        <label>Arquivo:</label><br>
        <input type="file" name="arquivo" required>
    </p>
    
    <button type="submit" name="adicionar">Adicionar</button>
</form>

<hr>

<h3>Lista de Conteúdos</h3>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Tipo</th>
        <th>Arquivo</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($conteudos as $item): ?>
    <tr>
        <td><?= $item['id'] ?></td>
        <td><?= $item['titulo'] ?></td>
        <td><?= $item['tipo'] ?></td>
        <td><?= $item['caminho'] ?></td>
        <td>
            <a href="editar_conteudo.php?id=<?= $item['id'] ?>">Editar</a> | 
            <a href="?excluir=<?= $item['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
        </td>
    </tr>
    <?php endforeach; ?>

    <a href="dashboard.php">Sair</a>
</table>