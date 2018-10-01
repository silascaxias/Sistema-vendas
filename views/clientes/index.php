<div class="card">
<header class="card-header flex-container align-middles space-between">
    <h1>Clientes</h1>
    <a href="<?=HOME_URI?>/clientes/criar" class="button new small">Novo</a>
</header>
<section class="card-content center-all">
    <table class="table">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Cidade</th>
                <th>UF</th>
                <th>Data Cad.</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($this->model->clientes as $cli) { ?>
        <tr>
            <td><?=$cli['nome_cli']?></td>
            <td><?=$cli['cidade_cli']?></td>
            <td><?=$cli['uf_cli']?></td>
            <td><?=$cli['data_cad_cli']?></td>
            <td>
                <a href="<?=HOME_URI?>/clientes/editar/<?=$cli['cod_cli']?>" class="icon-edit"></a>
                <a href="<?=HOME_URI?>/clientes/deletar/<?=$cli['cod_cli']?>" class="icon-excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')"></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</section>
</div>