<?php
    require 'verifica_admin.php';
    verifica_admin();
    require 'admin.php';
    
    $admin = new Administrador();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if($nome && $email && $senha) {
            $admin->adicionar($nome, $email, $senha);
            header('Location: dashboard.php');
            exit;
        }
    }
?>