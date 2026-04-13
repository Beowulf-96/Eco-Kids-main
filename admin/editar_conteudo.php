<!-- <?php
include 'header.php';
require_once 'Auth.php';
$auth = new Auth();
$auth->verificar();

require 'Conteudo.php';
$conteudo = new Conteudo();

// Processar ações
if (isset($_POST['adicionar']) || isset($_POST['editar'])) {
    $tipo = $_POST['tipo'];
    $caminho = $tipo != 'leitura' ? $conteudo->uploadArquivo($_FILES['arquivo']) : null;
    $imagem = $tipo != 'video' && !empty($_FILES['imagem']['tmp_name']) ? $conteudo->uploadArquivo($_FILES['imagem']) : null;
    $texto = $tipo == 'leitura' ? $_POST['texto'] : null;
    
    if (isset($_POST['adicionar'])) {
        $conteudo->adicionar($_POST['titulo'], $tipo, $_POST['descricao'], $caminho, $imagem, $texto);
    } else {
        $conteudo->editar($_POST['id'], $_POST['titulo'], $tipo, $_POST['descricao'], $caminho, $imagem, $texto);
    }
    header('Location: editar_conteudo.php');
    exit;
}

if (isset($_GET['excluir'])) {
    $conteudo->excluir($_GET['excluir']);
    header('Location: editar_conteudo.php');
    exit;
}

$editando = isset($_GET['editar']) ? $conteudo->buscar($_GET['editar']) : null;
$conteudos = $conteudo->listar();
?>

<h3>Gerenciar Conteúdos</h3>

<h2><?= $editando ? 'Editar' : 'Adicionar' ?></h2>
<form method="POST" enctype="multipart/form-data">
    <?php if ($editando): ?>
        <input type="hidden" name="id" value="<?= $editando['id'] ?>">
    <?php endif; ?>
    
    <input type="text" name="titulo" value="<?= $editando['titulo'] ?? '' ?>" placeholder="Título" required><br><br>
    
    <select name="tipo" id="tipo" required onchange="toggleCampos()">
        <option value="jogo" <?= ($editando['tipo'] ?? '') == 'jogo' ? 'selected' : '' ?>>Jogo</option>
        <option value="video" <?= ($editando['tipo'] ?? '') == 'video' ? 'selected' : '' ?>>Vídeo</option>
        <option value="leitura" <?= ($editando['tipo'] ?? '') == 'leitura' ? 'selected' : '' ?>>Leitura</option>
    </select><br><br>
    
    <div id="campo-descricao" style="display:none;">
        <label>Texto:</label><br>
        <textarea name="descricao" rows="3" placeholder="Descrição"><?= $editando['descricao'] ?? '' ?></textarea><br><br>
    </div>
    
    <div id="campo-arquivo">
        <label>Arquivo:</label><br>
        <input type="file" name="arquivo"><br><br>
    </div>
    
    <div id="campo-texto" style="display:none;">
        <label>Texto:</label><br>
        <textarea name="texto" rows="10"><?= $editando['texto'] ?? '' ?></textarea><br><br>
    </div>
    
    <div id="campo-imagem">
        <label>Imagem:</label><br>
        <input type="file" name="imagem" accept='image'> <?= $editando['texto'] ?? '' ?> <br><br>
    </div>
    
    <button name="<?= $editando ? 'editar' : 'adicionar' ?>"><?= $editando ? 'Salvar' : 'Adicionar' ?></button>
    <?php if ($editando): ?>
        <a href="editar_conteudo.php"><button type="button">Cancelar</button></a>
    <?php endif; ?>
</form>

<script>
function toggleCampos() {
    const tipo = document.getElementById('tipo').value;
    document.getElementById('campo-arquivo').style.display = tipo === 'leitura' ? 'none' : 'block';
    document.getElementById('campo-descricao').style.display = tipo === 'leitura' ? 'none' : 'block';
    document.getElementById('campo-texto').style.display = tipo === 'leitura' ? 'block' : 'none';
    document.getElementById('campo-imagem').style.display = tipo === 'leitura' ? 'block' : 'none';
    document.getElementById('campo-imagem').style.display = tipo === 'video' ? 'none' : 'block';
}
toggleCampos();
</script>

<hr>

<h3>Lista</h3>
<table border="1">
    <tr><th>Título</th><th>Tipo</th><th>Ações</th></tr>
    <?php foreach ($conteudos as $item): ?>
        <tr>
            <td><?= $item['titulo'] ?></td>
            <td><?= $item['tipo'] ?></td>
            <td>
                <a href="?editar=<?= $item['id'] ?>">Editar</a> |
                <a href="?excluir=<?= $item['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<a href="dashboard.php">Voltar</a> -->