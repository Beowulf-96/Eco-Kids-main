<?php
    include 'header.php';
    require_once __DIR__ . '/admin/conexao.php';

    $con = new Conexao();
    $conn = $con->conectar();
    $leitura = $conn->query("SELECT id, titulo, texto, imagem FROM conteudo WHERE tipo = 'leitura' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
  
        <?php if(empty($leitura)): ?>
            <div class="fundoWid">
                <p>Nenhum texto encontrado!</p>
            </div>

        <?php else: ?>
            <?php foreach($leitura as $item): ?>
                <div class="fundoWid">
                    <h3><?= $item['titulo'] ?></h3>
                        <?php if(!empty($item['imagem'])): ?>
                            <img src="admin/<?= $item['imagem']?>" alt="<?= $item['titulo']?>" class="imagem-leitura">
                        <?php endif; ?>
                            <p><?= nl2br($item['texto'])?></p></br>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

                <div class="fundoWid">
                    <div class="footer"> 
                        <?php include 'footer.php'; ?>
                    </div>
                </div>