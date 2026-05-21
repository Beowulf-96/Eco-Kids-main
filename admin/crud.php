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

<div class="fundoWid">
    <h3> Gestão de administradores </h3>
            <table border="2" width="100%">
                        <tr> 
                            <th class=tituloTabela>Id</th>
                            <th class=tituloTabela>Nome</th>
                            <th class=tituloTabela>Email</th>
                            <th class=tituloTabela>Ação</th>
                        </tr>
                        <?php foreach($listar as $item): ?>
                        <tbody>
                            <tr>
                                <td><?php echo $item['id']; ?></td>
                                <td><?php echo $item['nome']; ?></td>
                                <td><?php echo $item['email']; ?></td>
                                <td>
                                    <a style="margin-left: 25%;" class="button-primary" href="editar_admin.php?id=<?php echo $item['id'] ?>">Editar</a>
                                    <a class="button-secondary" href="?excluir=<?php echo $item['id'] ?>" onclick="return confirm('Deseja realmente excluir esse contato?')">Excluir</a>
                                </td>
                            </tr>
                    </tbody>
                <?php endforeach; ?>
            </table>
    <a style="margin-top: 1%; margin-left: 1%;" class="button-3" href="adicionar_admin.php">Adicionar</a>
    <a class="button-4" href="logout.php">Logout</a>
</div>

