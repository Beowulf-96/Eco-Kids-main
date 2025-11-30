<?php
require __DIR__ . '/admin/conexao.php';
include 'header.php';

$con = new Conexao();
$conn = $con->conectar();

$stmt = $conn->query("SELECT * FROM conteudo WHERE tipo = 'video' ORDER BY id DESC");
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Pega o vídeo selecionado (ou o primeiro)
$videoId = isset($_GET['v']) ? $_GET['v'] : ($videos[0]['id'] ?? null);

$videoAtual = null;
foreach ($videos as $v) {
    if ($v['id'] == $videoId) {
        $videoAtual = $v;
        break;
    }
}
?>

<h1>Vídeos</h1>

<?php if (empty($videos)): ?>
    <p>Nenhum vídeo disponível.</p>
<?php else: ?>
    
    <?php if ($videoAtual): ?>
    <div style="margin-bottom: 40px; padding: 20px; border: 2px solid #007bff; background: #f0f8ff;">
        <h2><?= $videoAtual['titulo'] ?></h2>
        
        <?php if ($videoAtual['descricao']): ?>
            <p><?= $videoAtual['descricao'] ?></p>
        <?php endif; ?>
        
        <video width="100%" style="max-width: 800px;" controls autoplay>
            <source src="admin/<?= $videoAtual['caminho'] ?>" type="video/mp4">
            Seu navegador não suporta vídeos.
        </video>
    </div>
    <?php endif; ?>
    
    
    <h3>Todos os vídeos:</h3>
    <div>
        <?php foreach ($videos as $video): ?>
            <div style="margin-bottom: 15px; padding: 15px; border: 1px solid #ccc; <?= $video['id'] == $videoId ? 'background: #e7f3ff;' : '' ?>">
                <a href="?v=<?= $video['id'] ?>" style="text-decoration: none; color: #333;">
                    <strong><?= $video['titulo'] ?></strong>
                    <?php if ($video['descricao']): ?>
                        <br><small><?= $video['descricao'] ?></small>
                    <?php endif; ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    
<?php endif; ?>