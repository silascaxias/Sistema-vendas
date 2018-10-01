  <div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Detalhes da venda</h1>
    <a href="<?=HOME_URI?>/vendas" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>cod_prod</th>
            <th>qtde_itens  </th>
            <th>total_itens</th>
          </tr>
        </thead>
        <tbody>
        <?php foreach ($this->model->ver as $venda):?>
            <tr>
              <td><?=$this->descProd($venda['cod_prod'])?></td>
              <td><?=$venda['qtde_itens']?></td>
              <td>R$ <?=$venda['total_itens']?></td>
            </tr>
            <?php  $this->model->total += $venda['total_itens']?> 
        <?php endforeach; ?>
        <tr>
            <td colspan="3">Total: R$ <?=$this->model->total?>
        </tr>
        </tbody>
  </table>
    <a href="<?=HOME_URI?>/vendas/deletarVenda/<?=$this->model->id?>" style="margin-top: 10px;" class="button back small" onclick="return confirm('Tem certeza que deseja deletar a venda?')">Deletar</a>
</section>
</div>
