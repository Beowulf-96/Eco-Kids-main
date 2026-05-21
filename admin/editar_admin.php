<?php
    require_once 'Auth.php';
    require_once 'admin.php';
    include 'header.php';
    require_once 'Auth.php';
    $auth = new Auth();
    $auth->verificar();
    
    $admin = new Administrador();
    $id = $_GET['id'] ?? null;
    $msg = '';

    if (!$id) {
        header('Location: crud.php');
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $id_post = $_POST['id'];

        if($nome && $email && $id_post) {
            if($admin->editar($id_post, $nome, $email)) {
                header('Location: crud.php');
                exit;
            } else {
                $msg = "Email já cadastrado!";
            }
        }
    }

    $info = $admin->buscar($id);
    
    if (!$info) {
        header('Location: crud.php');
        exit;
    }
?>

<?php if ($msg) echo "<p>$msg</p>"; ?>

<div class="fundoWid">
    <h3>Editar Administrador</h3>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $info["id"]?>">
            <label class="label">Nome: </label><input style="margin-left: 0.7vw;" type="text" name="nome" value="<?php echo $info["nome"]?>" required><br>
            <label class="label">Email: </label><input type="email" name="email" value="<?php echo $info["email"]?>" required><br>
            <label class="label">Senha: </label><input type="password" name="senha" value="<?php echo $info["senha"]?>" required><br><br>
            <button class="button-primary" type="submit">Salvar</button>
            <a class="button-secondary" href="crud.php">Voltar</a>
        </form>
        
</div>