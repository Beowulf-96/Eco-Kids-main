<?php
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