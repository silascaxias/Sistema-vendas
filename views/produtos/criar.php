<div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Adicionar novo Produto</h1>
    <a href="<?=HOME_URI?>/produtos" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <form action="<?=HOME_URI?>/produtos/salvar" method="post">
        <div class="form-group">
            <input type="text" name="desc_prod" class="form-control large" placeholder="Descrição">
        </div>
        <div class="form-group">
            R$ <input type="text" name="valor_prod" onKeyPress="return(moeda(this,'.',',',event))" class="form-control large" placeholder="Valor">
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar" class="button success ripple"/>
        </div>
    </form>
</section>
</div>