<?php
    require_once 'Auth.php';
    require_once 'admin.php';
    include 'header.php';
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

<div class="fundoWid">
    <h3>Adicionar Administrador</h3>
        <form method="post">
            <label class="label">Nome: </label><input style="margin-left: 0.7vw;" type="text" name="nome" required><br>
            <label class="label">Email: </label><input type="email" name="email" required><br>
            <label class="label">Senha: </label><input type="password" name="senha" required><br><br>
            <button class="button-primary" type="submit">Salvar</button>
            <a class="button-secondary" href="crud.php">Voltar</a>
        </form>
        
</div>