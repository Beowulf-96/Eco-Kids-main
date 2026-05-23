<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();

    $leitura = $conn->query("SELECT id, titulo, texto, imagem FROM conteudo WHERE tipo = 'leitura' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $primeiraLeitura = $leitura[0] ?? null;

    $videos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'video' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $primeiroVideo = $videos[0] ?? null;

    $jogo = $conn->query("SELECT * FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    $primeiroJogo = $jogo[0] ?? null;
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


    <?php if(empty($leitura)): ?>
        <div class="fundoWid">
            <h3>Leitura</h3>
                <p>Nenhum texto encontrado!</p>
        </div>
    <?php else: ?>
        <div class="fundoWid">
            <h3>Leitura</h3>
        <div>
            <h2><?= $primeiraLeitura['titulo'] ?></h2>
    <?php if(!empty($primeiraLeitura['imagem'])): ?>
        <img src="admin/<?= $primeiraLeitura['imagem']?>" alt="<?= $primeiraLeitura['titulo']?>" class="imagem-leitura">
    <?php endif; ?>
            <p><?= nl2br($primeiraLeitura['texto'])?></p>
        </div>
            <br>
            <br>
        <a href="curiosidades.php" class="more">Mais Leitura...</a>
    <?php endif; ?>
        </div>

    <?php if(empty($jogo)): ?>
        <div class="fundoWid">
            <h3>Jogos</h3>
            <p>Nenhum jogo encontrado!</p>
        </div>
    <?php else: ?>
        <div class="fundoWid">
            <h3>Jogos</h3>
                <h2><?= $primeiroJogo['titulo']?></h2>
                    <a onclick="acionarJogo('admin/<?= $primeiroJogo['caminho']?>')">
                        <img src="admin/<?= $primeiroJogo['imagem']?>" alt="<?= $primeiroJogo['titulo']?>" class="imagem-leitura">
                    </a>
                        <p><?= $primeiroJogo['descricao']?></p>
                        <br>
                        <br>
                        <a href="games.php" class="more">Mais Jogos...</a>
        </div>
    <?php endif;?>

<div class="fundoWid">
    <div class="footer"> 
        <?php include 'footer.php'; ?>
    </div>
</div>

<script>
    function acionarJogo(caminho) {
        window.location.href = caminho;
    }
</script>


