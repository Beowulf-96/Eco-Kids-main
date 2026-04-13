<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../styles.css">

<form method="POST">
    <div class="login">
        <h4>Login</h4>
            <div>
                <label>Email</label>
                    <input type="email" name="email" placeholder="Email" required>
            </div>
            <div>
                <label>Senha</label>
                    <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit">Entrar</button>
    </div>
</form>

<?php
require_once "Auth.php";

$erro = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $auth = new Auth();
    
    if($auth->login($email, $senha)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $erro = "Email ou senha incorretos.";
    }
}
?>



