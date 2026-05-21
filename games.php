<?php
    require 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();
    $jogos = $conn->query("SELECT id, titulo, tipo, descricao, imagem  FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<?php if(!$jogos): ?>
    <div class="fundoWid">
        <h3>Jogos</h3>
        <p>Nenhum jogo encontrado!</p>
    </div>
<?php endif;?>

<?php foreach($jogos as $item): ?>
    <div class="fundoWid">
        <h3><?= $item['titulo']?></h3>
        <a class="video-item" onclick="acionarJogo('admin/<?=$item['caminho'] ?>');" >
            <img src="admin/<?= $item['imagem'] ?>" >
        </a>
        <div class="videoLateral">
            <h5><?= $item['titulo'] ?></h5> 
            <p><?= $item['descricao'] ?></p>
        </div>
        
    </div>
<?php endforeach;?>

