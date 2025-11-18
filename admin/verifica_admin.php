<?php
    session_start();

    function verifica_admin() {
        if(!isset($_SESSION['admin_id'])) {
            header('Location: login.php');
            exit;
        }
    }
?>