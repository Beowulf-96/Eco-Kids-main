<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();

    $leitura = $conn->query("SELECT id, titulo, texto, imagem FROM conteudo WHERE tipo = 'leitura' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Leitura</h1>
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
            <hr>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php
    include 'footer.php';
?>