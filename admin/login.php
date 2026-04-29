<?php
require_once "Auth.php";

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $auth = new Auth();

    if($auth->login($email, $senha)) {
        header('Location: gerenciar_conteudo.php');
        exit;
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles.css">
</head>
<body>

<form method="POST">
    <div class="login">
        <h4>Login</h4>
        <?php if(!empty($erro)) : ?>
            <div class="erro">
                    <p><?php echo $erro; ?></p>
            </div>
        <?php endif; ?>    

        <div>
            <label class="label">Email</label>
            <input class="input" type="email" name="email" placeholder="Email" required>
        </div>

        <div>
            <label class="label">Senha</label>
            <input class="input" type="password" name="senha" placeholder="Senha" required>
        </div>

        <div class="botoes">
            <button class="button" type="submit">Entrar</button>
            <button class="button" type="button" onclick="window.location.href='../index.php'">Voltar</button>
        </div>

    </div>
</form>

</body>
</html>