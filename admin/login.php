<?php
    session_start();
    require_once "admin.php";


    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $admin = new Administrador();
        $usuario = $admin->autenticar($email, $senha);

        if($usuario) {
            $_SESSION['admin_id'] = $usuario['id'];
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
