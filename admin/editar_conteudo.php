<?php
include 'header.php';
require 'verifica_admin.php';
verifica_admin();
require 'conexao.php';

$conexao = new Conexao();
$conn = $conexao->conectar();

$id = $_GET['id'];

// ATUALIZAR
if (isset($_POST['atualizar'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $descricao = $_POST['descricao'];
    
    // Verifica se enviou novo arquivo
    if (!empty($_FILES['arquivo']['name'])) {
        // Busca arquivo antigo para deletar
        $stmt = $conn->prepare("SELECT caminho FROM conteudo WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $antigo = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Deleta arquivo antigo
        if ($antigo && file_exists($antigo['caminho'])) {
            unlink($antigo['caminho']);
        }
        
        // Upload do novo arquivo
        $pasta = "uploads/";
        $nomeArquivo = time() . "_" . $_FILES['arquivo']['name'];
        $caminho = $pasta . $nomeArquivo;
        move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho);
        
        // Atualiza com novo arquivo
        $stmt = $conn->prepare("UPDATE conteudo SET titulo = :titulo, tipo = :tipo, descricao = :descricao, caminho = :caminho WHERE id = :id");
        $stmt->execute([':titulo' => $titulo, ':tipo' => $tipo, ':descricao' => $descricao, ':caminho' => $caminho, ':id' => $id]);
    } else {
        // Atualiza sem mudar o arquivo
        $stmt = $conn->prepare("UPDATE conteudo SET titulo = :titulo, tipo = :tipo, descricao = :descricao WHERE id = :id");
        $stmt->execute([':titulo' => $titulo, ':tipo' => $tipo, ':descricao' => $descricao, ':id' => $id]);
    }
    
    echo "<p>Conteúdo atualizado!</p>";
    echo "<a href='gerenciar_conteudo.php'>Voltar</a>";
    exit;
}

// BUSCAR dados atuais
$stmt = $conn->prepare("SELECT * FROM conteudo WHERE id = :id");
$stmt->execute([':id' => $id]);
$conteudo = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<h3>Editar Conteúdo</h3>

<form method="POST" enctype="multipart/form-data">
    <p>
        <label>Título:</label><br>
        <input type="text" name="titulo" value="<?= $conteudo['titulo'] ?>" required>
    </p>
    
    <p>
        <label>Tipo:</label><br>
        <select name="tipo" required>
            <option value="jogo" <?= $conteudo['tipo'] == 'jogo' ? 'selected' : '' ?>>Jogo</option>
            <option value="video" <?= $conteudo['tipo'] == 'video' ? 'selected' : '' ?>>Vídeo</option>
            <option value="leitura" <?= $conteudo['tipo'] == 'leitura' ? 'selected' : '' ?>>Leitura</option>
        </select>
    </p>
    
    <p>
        <label>Descrição:</label><br>
        <textarea name="descricao" rows="3"><?= $conteudo['descricao'] ?></textarea>
    </p>
    
    <p>
        <label>Arquivo atual:</label><br>
        <strong><?= $conteudo['caminho'] ?></strong>
    </p>
    
    <p>
        <label>Trocar arquivo (deixe vazio para manter o atual):</label><br>
        <input type="file" name="arquivo">
    </p>
    
    <button type="submit" name="atualizar">Atualizar</button>
    <a href="gerenciar_conteudo.php">Cancelar</a>
</form>