<?php
require __DIR__ . '/admin/conexao.php';
include 'header.php';

$con = new Conexao();
$conn = $con->conectar();

$videos = $conn->query("SELECT * FROM conteudo WHERE tipo = 'video' ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

$videoId = $_GET['v'] ?? ($videos[0]['id'] ?? null);
$videoAtual = array_filter($videos, fn($v) => $v['id'] == $videoId)[0] ?? null;
?>

<div class="fundoWid">
    <h3>Vídeos</h3>
        <?php if (empty($videos)): ?>
            <p>Nenhum vídeo disponível.</p>
        <?php else: ?>
            
            <div class="video-principal">
                <h2 id="titulo-principal"><?= $videoAtual['titulo'] ?></h2>
                    <video id="video-principal" controls autoplay>
                        <source src="admin/<?= $videoAtual['caminho'] ?>" type="video/mp4">
                    </video>
            </div>
                <h4>Descrição:</h4>
                <p id="descricao-principal"><?= $videoAtual['descricao'] ?></p>
        </div>

<div class="fundoWid">
    <h3>Todos os vídeos:</h3>
            <?php foreach ($videos as $video): ?>
                <div class="video-galeria">
                    <?php if (empty($video['imagem'])):?>
                        <a href="#" class="video-item" onclick="trocarVideo('admin/<?= $video['caminho'] ?>', '<?= htmlspecialchars($video['titulo']) ?>', '<?= htmlspecialchars($video['descricao']) ?>'); return false;">
                            <image src="admin/uploads/default.png" >
                        </a>
                    <?php else: ?>
                        <a href="#"  class="video-item" onclick="trocarVideo('admin/<?= $video['caminho'] ?>', '<?= htmlspecialchars($video['titulo']) ?>', '<?= htmlspecialchars($video['descricao']) ?>'); return false;">
                            <image  src="admin/<?= $video['imagem'] ?>" >
                        </a>
                    <?php endif;?>
                    <div class="videoLateral">
                        <h4><?= $video['titulo'] ?></h4> 
                        <p><?= $video['descricao'] ?></p>
                    </div>
                </div>    
            <?php endforeach; ?>
</div>

<script>
function trocarVideo(caminho, titulo, descricao) {
    const video = document.getElementById('video-principal');
    const tituloEl = document.getElementById('titulo-principal');
    const descricaoEl = document.getElementById('descricao-principal');
    
    tituloEl.textContent = titulo;
    descricaoEl.textContent = descricao;
    video.src = caminho;
    video.load();
    video.oncanplay = () => video.play();
}
</script>
    
<?php endif; ?>

<?php
    include 'footer.php';
?>