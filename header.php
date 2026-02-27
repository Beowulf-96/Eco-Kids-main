<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>EcoKids</title>
        <link rel="icon" href="img/logo3.png" type="image/x-icon">
    </head>
    <body>
    <header>
        <h1><div class="logo3"><img src="img/logo3.png" alt="Logomarca"></div>EcoKids</h1>
    </header>
        <ul>
            <li><a href="index.php" onclick="TrocarCor(this)">Home</a></li>
            <li><a href="videos.php" onclick="TrocarCor(this)">Vídeos</a></li>
            <li><a href="games.php" onclick="TrocarCor(this)">Games</a> </li>
            <li><a href="curiosidades.php" onclick="TrocarCor(this)">Leitura</a></li>
            <li><a href="sobre.php" onclick="TrocarCor(this)">Sobre</a></li>
        </ul>

        <script>
            function TrocarCor(elemento) {
                const itens = document.querySelectorAll('ul li a');
                itens.forEach(item => {
                    item.classList.remove('menu-ativo');
                });

                elemento.classList.add('menu-ativo');

            }

            window.onload = function() {
                const urlAtual = window.location.pathname;
                const links = document.querySelectorAll('ul li a');
                
                links.forEach(link=> {
                    if (link.getAttribute('href') === urlAtual.split('/').pop()) {
                    link.classList.add('menu-ativo');
                }
                });
            }
        </script>