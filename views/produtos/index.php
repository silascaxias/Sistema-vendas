<div class="card">
<header class="card-header flex-container align-middles space-between">
    <h1>Produtos</h1>
    <a href="<?=HOME_URI?>/produtos/criar" class="button new small">Novo</a>
</header>
<section class="card-content center-all">
    <table class="table">
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <?php foreach ($this->model->produtos as $prod) { ?>
        <tr>
            <td><?=$prod['cod_prod']?></td>
            <td><?=$prod['desc_prod']?></td>
            <td>R$ <?=$prod['valor_prod']?></td>
            <td>
                <a href="<?=HOME_URI?>/produtos/editar/<?=$prod['cod_prod']?>" class="icon-edit"></a>
                <a href="<?=HOME_URI?>/produtos/deletar/<?=$prod['cod_prod']?>" class="icon-excluir" onclick="return confirm('Tem certeza que deseja deletar este registro?')"></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</section>
</div>