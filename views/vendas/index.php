<div class="card">
<header class="card-header flex-container align-middles space-between">
    <h1>Vendas</h1>
    <a href="<?=HOME_URI?>/vendas/criar" class="button new small">Novo</a>
</header>
<section class="card-content center-all">
    <?php if($this->model->vendas):?>
    <table class="table">
        <thead>
            <tr>
                <th>N.Venda</th>
                <th>Cliente</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
            <?php foreach ($this->model->vendas as $venda): ?>
            <tr>
                <td><?=$venda['cod_venda']?></td>
                <td><?=$this->retornaCliente($venda['cod_cli'])?></td>
                <td><?=date('d/m/Y H:i:s', strtotime($venda['data_venda']))?></td>
                <td>
                    <a href="<?=$this->model->ver_url . $venda['cod_venda']?>" class="icon-visu">Detalhes</a>   
                </td>
            </tr>
            <?php endforeach; ?>
    </table>
    <?php else:?>
         <h3 align="center" style="margin-top: 10px;">Sem vendas cadastradas!</h3>
    <?php endif;?>
</section>
</div>		