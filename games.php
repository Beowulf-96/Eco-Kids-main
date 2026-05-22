<?php
    require 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();
    $jogos = $conn->query("SELECT id, titulo, tipo, descricao, imagem, caminho FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if(!$jogos): ?>
    <div class="fundoWid">
        <h3>Jogos</h3>
        <p>Nenhum jogo encontrado!</p>
    </div>
<?php else: ?>
    <?php foreach($jogos as $item): ?>
        <div class="fundoWid">
            <h3><?= $item['titulo']?></h3>
                <div class="jogo">
                    <a onclick="acionarJogo('admin/<?= $item['caminho'] ?>')">
                        <img src="admin/<?= $item['imagem'] ?>" >
                    </a>
                        <p class="jogoLateral"><?= $item['descricao'] ?></p>
                </div>
        </div>
    <?php endforeach;?>
<?php endif; ?>

<script>
    function acionarJogo(caminho) {
        window.location.href = caminho;
    }
</script>

<div class="fundoWid">
    <div class="footer"> 
        <?php include 'footer.php'; ?>
    </div>
</div>