<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();

    $leitura = $conn->query("SELECT id, titulo, texto, imagem FROM conteudo WHERE tipo = 'leitura' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $primeiraLeitura = $leitura[0] ?? null;

    $videos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'video' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $primeiroVideo = $videos[0] ?? null;
?>
<div class="fundoWid">
    <h3>Vídeos</h3>

    <?php if (empty($videos)): ?>
        <p>Nenhum vídeo disponível.</p>
    <?php else: ?>
            <div class="video-principal">
                <h2 id="titulo-principal"><?= $primeiroVideo['titulo'] ?></h2>
                    <video id="video-principal" width="100%" style="max-width: 1000px; aspect-ratio: 16/9; display: block; margin: 0 auto;" controls autoplay>
                        <source src="admin/<?= $primeiroVideo['caminho'] ?>" type="video/mp4">
                    </video>
            </div>
        <a href="videos.php" class="more">Mais Vídeos...</a>
    <?php endif; ?>
</div>

<div class="fundoWid">
    <h3>Leitura</h3>
        <?php if(empty($leitura)): ?>
            <p>Nenhum texto encontrado!</p>
            <?php else: ?>
                <?php foreach($leitura as $item): ?>
                    <div>
                        <h2><?= $item['titulo'] ?></h2>

                        <?php if(!empty($item['imagem'])): ?>
                            <img src="admin/<?= $item['imagem']?>" alt="<?= $item['titulo']?>" class="imagem-leitura">
                        <?php endif; ?>

                        <p><?= nl2br($item['texto'])?></p>
                    </div>
                <?php endforeach; ?>
                <br>
                <br>
            <a href="curiosidades.php" class="more">Mais Leitura...</a>
        <?php endif; ?>
    <?php include 'footer.php'; ?>
</div>



