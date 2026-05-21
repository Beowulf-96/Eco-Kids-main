<?php
include 'header.php';
require_once 'Auth.php';
$auth = new Auth();
$auth->verificar();

require 'Conteudo.php';
$conteudo = new Conteudo();

if (isset($_POST['adicionar']) || isset($_POST['editar'])) {
    $tipo = $_POST['tipo'];
    if ($tipo == 'video') {
        $caminho = $conteudo->uploadArquivo($_FILES['arquivo']);
        $imagem = $conteudo->uploadArquivo($_FILES['imagem']);
    }
    else 
    {
        $caminho = $tipo != 'leitura' ? $conteudo->uploadArquivo($_FILES['arquivo']) : null;
        $imagem = $tipo != 'video' && !empty($_FILES['imagem']['tmp_name']) ? $conteudo->uploadArquivo($_FILES['imagem']) : null;
    }
    
    $texto = $tipo == 'leitura' ? $_POST['texto'] : null;
    
    if (isset($_POST['adicionar'])) {
        $conteudo->adicionar($_POST['titulo'], $tipo, $_POST['descricao'], $caminho, $imagem, $texto);
    } else {
        $conteudo->editar($_POST['id'], $_POST['titulo'], $tipo, $_POST['descricao'], $caminho, $imagem, $texto);
    }
    header('Location: gerenciar_conteudo.php');
    exit;
}

if (isset($_GET['excluir'])) {
    $conteudo->excluir($_GET['excluir']);
    header('Location: gerenciar_conteudo.php');
    exit;
}

$editando = isset($_GET['editar']) ? $conteudo->buscar($_GET['editar']) : null;
$conteudos = $conteudo->listar();
?>

<div class="fundoWid">
    <h3><?= $editando ? 'Editar' : 'Adicionar' ?> Conteúdos</h3>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editando): ?>
                <input type="hidden" name="id" value="<?= $editando['id'] ?>">
            <?php endif; ?>
            
            <label class="label">Título:</label><br>
            <input class="input" type="text" name="titulo" value="<?= $editando['titulo'] ?? '' ?>" placeholder="Título" required><br><br>
            
            <?php $tipo = $editando['tipo'] ?? ''; ?>
            <label class="label">Tipo:</label><br>
            <?php if ($editando): ?>
                <select disabled title="O tipo não pode ser editado!" class="select" name="tipo" id="tipo" required onchange="toggleCampos()">
                    <option value="jogo"    <?= $tipo == 'jogo'    ? 'selected' : '' ?>>Jogo</option>
                    <option value="video"   <?= $tipo == 'video'   ? 'selected' : '' ?>>Vídeo</option>
                    <option value="leitura" <?= $tipo == 'leitura' ? 'selected' : '' ?>>Leitura</option>
                </select>
                <input type="hidden" name="tipo" value="<?= $tipo ?>">
            <?php else: ?>
                <select class="select" name="tipo" id="tipo" required onchange="toggleCampos()">
                    <option value="jogo">Jogo</option>
                    <option value="video">Vídeo</option>
                    <option value="leitura">Leitura</option>
                </select>
            <?php endif; ?>
            <br><br>
            
            <?php if($editando): ?> 
            <div id="campo-descricao">
                <label class="label">Descrição:</label><br>
                <textarea class="texto" name="descricao" rows="3"><?= $editando['descricao'] ?></textarea><br><br>
            </div>
            <?php else: ?>
            <div id="campo-descricao">
                <label class="label">Descrição:</label><br>
                <textarea class="texto" name="descricao" rows="3" placeholder="Escreva aqui a descrição..."></textarea><br><br>
            </div>
            <?php endif; ?>
            
            <?php if($editando): ?>
            <div id="campo-arquivo">
                <label class="label">Arquivo:</label>
                <span class="span" id="nome-arquivo"><?= $editando['titulo']?></span>
                <label class="button-secondary" for="arquivo">Escolher arquivo</label>
                <input type="file" name="arquivo" id="arquivo" style="display:none;"><br><br>
            </div>
            <?php else: ?>
            <div id="campo-arquivo">
                <label class="label">Arquivo:</label>
                <span class="span" id="nome-arquivo">Nenhum arquivo escolhido</span>
                <label class="button-secondary" for="arquivo">Escolher arquivo</label>
                <input type="file" name="arquivo" id="arquivo" style="display:none;"><br><br>
            </div>
            <?php endif; ?>
            
            <div id="campo-texto" style="display:none;">
                <label class="label">Texto:</label><br>
                <textarea class="texto" name="texto" rows="10"><?= $editando['texto'] ?? '' ?></textarea><br><br>
            </div>
            
            <div id="campo-imagem">
                <label class="label">Imagem:</label>
                <?php if($editando): ?>
                    <img id="preview-imagem" src="<?php echo $editando['imagem']; ?>">
                    <?php if(!$editando['imagem']): ?>
                        <span class="span">Nenhuma imagem selecionada.</span>
                    <?php endif;?>
                    <label class="button-secondary" for="arquivo-imagem">Escolher Arquivo</label>
                    <input type="file" name="imagem" id="arquivo-imagem" accept="image/*" style="display:none"
                        onchange="document.getElementById('preview-imagem').src = window.URL.createObjectURL(this.files[0])"><br><br>
                <?php else: ?>
                    <span class="span" id="nome-arquivo-imagem">Nenhum arquivo escolhido</span>
                    <label class="button-secondary" for="arquivo-imagem">Escolher Arquivo</label>
                    <input type="file" name="imagem" id="arquivo-imagem" accept="image/*" style="display:none"><br><br>
                <?php endif; ?>
            </div>
            
            <button class="button-primary" name="<?= $editando ? 'editar' : 'adicionar' ?>"><?= $editando ? 'Salvar' : 'Adicionar' ?></button>
            <a class="button-secondary" href="logout.php" >Logout</a>
            <?php if ($editando): ?>
                <a href="gerenciar_conteudo.php"><button class="button-secondary" type="button">Cancelar</button></a>
            <?php endif; ?>
        </form>
</div>

<div class="fundoWid">
    <h3>Lista</h3>
        <table border="1" class="table">
            <tr><th class=tituloTabela>Título</th><th class=tituloTabela>Tipo</th><th class=tituloTabela>Ações</th></tr>
            <?php foreach ($conteudos as $item): ?>
                <tr>
                    <td><?= $item['titulo'] ?></td>
                    <td><?= $item['tipo'] ?></td>
                    <td>
                        <a style="margin-left: 25%;" class="button-primary" href="?editar=<?= $item['id'] ?>">Editar</a>
                        <a class="button-secondary" href="?excluir=<?= $item['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
</div>

<script>
function toggleCampos() {
    const tipo = document.getElementById('tipo').value;
    document.getElementById('campo-arquivo').style.display = tipo === 'leitura' ? 'none' : 'block';
    document.getElementById('campo-descricao').style.display = tipo === 'leitura' ? 'none' : 'block';
    document.getElementById('campo-texto').style.display = tipo === 'leitura' ? 'block' : 'none';
    // document.getElementById('campo-imagem').style.display = tipo === 'jogo' ? 'none' : 'block';
}
toggleCampos();

    document.getElementById('arquivo').addEventListener('change', function() {
            const nome = this.files[0] ? this.files[0].name : 'Nenhum arquivo escolhido';
            document.getElementById('nome-arquivo').textContent = nome;
        });

toggleCampos();

    document.getElementById('arquivo-imagem').addEventListener('change', function() {
            const nome = this.files[0] ? this.files[0].name : 'Nenhum arquivo escolhido';
            document.getElementById('nome-arquivo-imagem').textContent = nome;
        });

</script>