<?php
    require 'verifica_admin.php';
    verifica_admin();
    require 'admin.php';
    
    $admin = new Administrador();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $id = $_POST['id'];

        if($nome && $email && $id) {
            $admin->editar($id, $nome, $email);
            header('Location: dashboard.php');
            exit;
        }
    }
?>