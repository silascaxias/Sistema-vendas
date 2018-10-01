<div class="card">
<header class="card-header flex-container align-middles space-between">
    <h1>Usuários</h1>
    <a href="<?=HOME_URI?>/usuarios/criar" class="button new small">Novo</a>
</header>
<section class="card-content center-all">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Função</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($this->model->usuarios as $usu) { ?>
        <tr>
            <td><?=$usu['nome_usu']?></td>
            <td><?=$usu['email_usu']?></td>
            <td><?php if($usu['cod_perfil'] == 1){echo "Administrador";}else{echo "Vendedor";}?></td>
            <td>
                <a href="<?=HOME_URI?>/usuarios/editar/<?=$usu['cod_usu']?>" class="icon-edit"></a>
                <a href="<?=HOME_URI?>/usuarios/deletar/<?=$usu['cod_usu']?>" class="icon-excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')"></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</section>
</div>