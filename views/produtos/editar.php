<div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Editar Produtos</h1>
    <a href="<?=HOME_URI?>/produtos" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <form action="<?=HOME_URI?>/produtos/salvar/<?=$this->model->produto['cod_prod']?>" method="post">
        <div class="form-group">
            <input type="text" name="desc_prod" class="form-control large" placeholder="Descrição" value="<?=$this->model->produto['desc_prod']?>">
        </div>
        <div class="form-group">
            R$ <input type="text" name="valor_prod" class="form-control large" placeholder="Valor" value="<?=$this->model->produto['valor_prod']?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar" class="button success ripple"/>
        </div>
    </form>
</section>
</div>