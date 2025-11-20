<?php
<<<<<<< HEAD
include 'header.php';
require __DIR__ . '/admin/conexao.php';

$con = new Conexao();
$conn = $con->conectar();

// busca apenas jogos
$stmt = $conn->query("SELECT id, titulo FROM conteudo WHERE tipo = 'jogo'");
$jogos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h3>Jogos disponíveis</h3>

<ul>
    <?php foreach ($jogos as $j): ?>
        <li>
            <a href="jogo.php?id=<?= $j['id'] ?>">
                <?= $j['titulo'] ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
=======
    include 'header.php';
?>
        <h3>Under construction....</h3>
        <div>
            <iframe>
            </iframe>
        </div>
    </body>
    </html>
>>>>>>> 37c8ea3e6682bf5fb7cbc2f6c840f46807335c83
