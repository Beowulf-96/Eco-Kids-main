<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();
    $jogos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="fundoWid"> 
    <h3>Jogos</h3>
        <div class="jogo-principal">
            <?php if(empty($jogos)): ?>
                <p>Nenhum jogo encontrado!</p>
            <?php else: ?>
                <?php foreach($jogos as $item): ?>
                    <div class="jogo-item">
                        <h2><?= htmlspecialchars($item['titulo'])?></h2>
                        <img src="admin/<?= htmlspecialchars($item['imagem'] ?? '') ?>"
                            class="imagem-jogo"
                            onclick="rodarJogo('admin/<?= htmlspecialchars($item['caminho'] ?? '') ?>')"
                            alt="<?= htmlspecialchars($item['titulo'] ?? '') ?>">
                        <p><?= htmlspecialchars($item['descricao'] ?? '') ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif;?>
        </div>
</div>

<script>
function rodarJogo(arquivoJogo) {
    if (!arquivoJogo || arquivoJogo === 'admin/') {
        alert('Arquivo do jogo não encontrado!');
        return;
    }
    window.location.href = arquivoJogo;
}
</script>

<?php include 'footer.php'; ?>