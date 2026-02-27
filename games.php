<?php
include 'header.php';
require __DIR__ . '/admin/conexao.php';

$con = new Conexao();
$conn = $con->conectar();

// busca apenas jogos
$jogos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'jogo' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$jogoId = $_GET['id'] ?? ($jogos[0]['id'] ?? null);
$jogoAtual = array_filter($jogos, fn($j) => $j['id'] == $jogoId)[0] ?? null;
?>

<h1>Jogos</h1>

<?php if (empty($jogos)): ?>
    <p>Nenhum jogo disponível.</p>
<?php else: ?>
    
    <!-- Jogo em destaque -->
    <?php if ($jogoAtual): ?>
        <div style="margin-bottom: 40px;">
            <h2><?= htmlspecialchars($jogoAtual['titulo']) ?></h2>
            <?php if (!empty($jogoAtual['descricao'])): ?>
                <p><?= nl2br(htmlspecialchars($jogoAtual['descricao'])) ?></p>
            <?php endif; ?>
            
            <?php if (!empty($jogoAtual['caminho'])): ?>
                <?php
                $extensao = strtolower(pathinfo($jogoAtual['caminho'], PATHINFO_EXTENSION));
                if ($extensao == 'html' || $extensao == 'htm'): ?>
                    <iframe src="admin/<?= $jogoAtual['caminho'] ?>" 
                            width="100%" 
                            height="600" 
                            style="border: 2px solid #ccc; border-radius: 5px; max-width: 1000px; display: block; margin: 0 auto;"
                            frameborder="0">
                    </iframe>
                <?php else: ?>
                    <div style="text-align: center; padding: 20px; background: #f0f0f0; border-radius: 5px;">
                        <a href="admin/<?= $jogoAtual['caminho'] ?>" target="_blank" 
                           style="display: inline-block; padding: 10px 20px; background: #1bb316; color: white; text-decoration: none; border-radius: 5px;">
                            Abrir Jogo
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <!-- Lista de jogos -->
    <h3>Todos os jogos:</h3>
    <div style="display: flex; gap: 15px; flex-wrap: wrap;">
        <?php foreach ($jogos as $jogo): ?>
            <a href="?id=<?= $jogo['id'] ?>" style="width: 200px; text-decoration: none; color: #333;">
                <?php if (!empty($jogo['imagem'])): ?>
                    <img src="admin/<?= $jogo['imagem'] ?>" width="200" height="120" style="display: block; object-fit: cover; background: #ddd; border-radius: 5px;">
                <?php else: ?>
                    <div style="width: 200px; height: 120px; background: #ddd; display: flex; align-items: center; justify-content: center; border-radius: 5px;">
                        <span style="color: #999;">Sem imagem</span>
                    </div>
                <?php endif; ?>
                <strong><?= htmlspecialchars($jogo['titulo']) ?></strong>
            </a>
        <?php endforeach; ?>
    </div>
    
<?php endif; ?>

<?php
    include 'footer.php';
?>