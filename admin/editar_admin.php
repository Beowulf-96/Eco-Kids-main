<?php
    require_once 'Auth.php';
    require_once 'admin.php';
    
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

<form method="post">
    <input type="hidden" name="id" value="<?php echo $info["id"]?>">
    <label>Nome: </label><input type="text" name="nome" value="<?php echo $info["nome"]?>" required><br>
    <label>Email: </label><input type="email" name="email" value="<?php echo $info["email"]?>" required><br>
    <button type="submit">Editar</button>
</form>
<a href="crud.php">Voltar</a>