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

<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
