<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();
    $jogos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<div>
    <h3>jogos</h3>
    <div>
        <img src="admin/<?= $jogos['imagem']?>" class="imagem-jogo">
    </div>
</div>