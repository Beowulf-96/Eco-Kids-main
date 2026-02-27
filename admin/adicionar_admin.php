<?php
    require_once 'Auth.php';
    require_once 'admin.php';
    
    $auth = new Auth();
    $auth->verificar();
    
    $admin = new Administrador();
    $msg = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        if($nome && $email && $senha) {
            if($admin->adicionar($nome, $email, $senha)) {
                header('Location: crud.php');
                exit;
            } else {
                $msg = "Email já cadastrado!";
            }
        }
    }
?>

<?php if ($msg) echo "<p>$msg</p>"; ?>

<form method="post">
    <label>Nome: </label><input type="text" name="nome" required><br>
    <label>Email: </label><input type="email" name="email" required><br>
    <label>Senha: </label><input type="password" name="senha" required><br>
    <button type="submit">Salvar</button>
</form>
<a href="crud.php">Voltar</a>