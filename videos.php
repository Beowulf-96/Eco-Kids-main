<?php
<<<<<<< HEAD
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
=======
    include 'header.php';
?>
        <h3>Vídeos Tutoriais</h3>
    <div class="video-pr">
        <iframe id="video-player" width="900" height="550" 
            src="vid/eco-video.mp4" 
            title="Vídeo Principal" 
            frameborder="0" 
            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen>
        </iframe>
        <h2>Eco Kids: a importância do meio ambiente!</h2>
    </div>
        <div class="video-2" onclick="trocarVideo('https://www.youtube.com/embed/N0XWA94pHsQ')">
            <img src="img/carrinho.jfif" alt="Miniatura do Vídeo 1">
            <h2>Como fazer um carrinho com caixa de leite:</h2>
            <br>
            <p>Neste vídeo ensinamos a fazer um carrinho com uma caixa da leite evitando desperdício. </p>
        </div>

        <div class="video-2" onclick="trocarVideo('https://www.youtube.com/embed/zsLkvXcb78w')">
            <img src="img/brinks.jpg" alt="Miniatura do Vídeo 2">
            <h2>7 brincadeiras relacionadas ao meio ambiente</h2>
            <br>
            <p>Neste vídeo você vai assistir 7 brincadeiras que são relacionadas ao meio ambiente e que tenha uma forma prática e fácil e divertida para realizar você e sua família.</p>
        </div>
        <div class="video-2" onclick="trocarVideo('https://www.youtube.com/embed/tEhRTlmto94')">
            <img src="img/elly.jpg" alt="Miniatura do Vídeo 3">
            <h2>Vamos plantar árvores com a Elly!</h2>
            <br>
            <p>Essa é a música de plantar árvores e brincar com as frutas aqui nesse canal divertidíssimo de vídeos para crianças de todas as idades! Vamos aprender, brincar e cantar!</p>
        </div>
        <!-- Adicione mais vídeos conforme necessário -->
    </div>

    <script>
        function trocarVideo(novoURL) {
            document.getElementById('video-player').src = novoURL;
        }
    </script>
    <footer>
        <p>© 2024 Eco Kids. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
>>>>>>> 5bdcf527bfa5a0b39f0e2502c3369f05925c07ac
