<?php
require __DIR__ . '/admin/conexao.php';
include 'header.php';

$con = new Conexao();
$conn = $con->conectar();

$videos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'video' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$videoId = $_GET['v'] ?? ($videos[0]['id'] ?? null);
$videoAtual = array_filter($videos, fn($v) => $v['id'] == $videoId)[0] ?? null;
?>

<?php if (empty($videos)): ?>
    <p>Nenhum vídeo disponível.</p>
<?php else: ?>
    
<div class="video-principal">
    <h2 id="titulo-principal"><?= $videoAtual['titulo'] ?></h2>
    <video id="video-principal" width="100%" style="max-width: 800px; aspect-ratio: 16/9; display: block; margin: 0 auto;" controls autoplay>
        <source src="admin/<?= $videoAtual['caminho'] ?>" type="video/mp4">
    </video>
    <p><?= $videoAtual['descricao'] ?></p>
</div>

<h3>Todos os vídeos:</h3>
<div class="video-galeria">
    <?php foreach ($videos as $video): ?>
        <a href="#" class="video-item" 
           onclick="trocarVideo('admin/<?= $video['caminho'] ?>', '<?= htmlspecialchars($video['titulo']) ?>'); return false;">
           <h4><?= $video['titulo'] ?></h4> 
           <video width="100%" height="120" style="background: #000; border-radius: 5px;">
                <source src="admin/<?= $video['caminho'] ?>" type="video/mp4">
            </video>
        </a>
    <p><?= $video['descricao'] ?></p>    
    <?php endforeach; ?>

</div>

<script>
function trocarVideo(caminho, titulo) {
    const video = document.getElementById('video-principal');
    const tituloEl = document.getElementById('titulo-principal');
    
    tituloEl.textContent = titulo;
    video.src = caminho;
    video.load();
    video.oncanplay = () => video.play();
}
</script>
    
<?php endif; ?>

<?php
    include 'footer.php';
?>