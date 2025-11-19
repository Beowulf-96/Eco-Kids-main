<?php
    require 'verifica_admin.php';
    verifica_admin();
    require 'admin.php';

    $admin = new Administrador();
    $id = $_GET['id'];

    $info = $admin->buscar($id);
?>

<form method="post" action="editar_admin_submit.php">
    <input type="hidden" name="id" value="<?php  echo $info["id"]?>">
    <label>Nome: </label><input type="text" name="nome" value= "<?php echo $info["nome"]?>" required><br>
    <label>Email: </label><input type="email" name="email" value="<?php echo $info["email"]?>"required><br>
    <button type="submit">Editar</button>
</form>