<?php
require_once "admin.php";

class Auth {
    private $admin;

    public function __construct() {
        $this->admin = new Administrador();
    }

    public function verificar() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header('Location: login.php');
            exit;
        }
    }

    public function login($email, $senha) {
        session_start();
        $usuario = $this->admin->autenticar($email, $senha);
        if ($usuario) {
            $_SESSION['admin_id'] = $usuario['id'];
            return true;
        }
        return false;
    }

    public function logout($redirect = 'login.php') {
        session_start();
        session_destroy();
        header('Location: ' . $redirect);
        exit;
    }
}
?>
