<?php
    include_once 'header.php';
    require_once 'Auth.php';
    require_once 'admin.php';
    
    $auth = new Auth();
    $auth->verificar();
    
    $admin = new Administrador();
    
    if (isset($_GET['excluir'])) {
        $id = $_GET['excluir'];
        if ($id) {
            $admin->deletar($id);
            header('Location: crud.php');
            exit;
        }
    }
    
    $listar = $admin->listar();
?>

<h3> Gestão de administradores </h3>
<button><a href="adicionar_admin.php">Adicionar</a></button>

<table border="2" width="100%">

<tr> 
    <th>Id</th>
    <th>Nome</th>
    <th>Email</th>
    <th>Ação</th>
</tr>
<?php foreach($listar as $item): ?>
<tbody>
    <tr>
        <td><?php echo $item['id']; ?></td>
        <td><?php echo $item['nome']; ?></td>
        <td><?php echo $item['email']; ?></td>
        <td>
            <button><a href="editar_admin.php?id=<?php echo $item['id'] ?>">Editar</a></button>
            <button><a href="?excluir=<?php echo $item['id'] ?>" onclick="return confirm('Deseja realmente excluir esse contato?')">Excluir</a></button>
        </td>
    </tr>
</tbody>
<?php endforeach; ?>
</table>
<button><a href="dashboard.php">Voltar</a></button>

