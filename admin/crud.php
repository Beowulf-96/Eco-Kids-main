<?php
    include_once 'header.php';
    require 'conexao.php';
    require_once 'verifica_admin.php';
    verifica_admin();
    require 'admin.php';
    $admin = new Administrador();
?>

<h1> Gestão de administradores </h1>
<button><a href="adicionar_admin.php">Adicionar</a></button>

<table border="2" width="100%">

<tr> 
    <th>Id</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ação</th>
</tr>
<?php $listar = $admin->listar();
    foreach($listar as $item):
?>
<tbody>
    <tr>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['nome']; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td>
            <button><a href="editar_admin.php">Editar</a></button>
            <button><a href="excluir_admin.php?id=<?php echo $item['id'] ?>" onclick="return confirm('Deseja realmente excluir esse contato?')">Excluir</a></button>
        </td>
    </tr>
</tbody>
<?php endforeach;?>
</table>
<button><a href="dashboard.php">Sair</a></button>

