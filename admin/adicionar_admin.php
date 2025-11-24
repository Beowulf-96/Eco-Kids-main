<?php
    require 'verifica_admin.php';
    verifica_admin();
?>

<form method="post" action="adicionar_admin_submit.php">
    <label>Nome: </label><input type="text" name="nome" required><br>
    <label>Email: </label><input type="email" name="email" required><br>
    <label>Senha: </label><input type="password" name="senha" required><br>
    <button type="submit">Salvar</button>
</form>
