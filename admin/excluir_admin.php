<?php
    require 'verifica_admin.php';
    verifica_admin();
    require 'admin.php';
    
    $admin = new Administrador();

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        $id = $_GET['id'];

        if($id) {
            $admin->deletar($id);
            header('Location: dashboard.php');
            exit;
        }
    }
?>