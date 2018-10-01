<div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Editar Clientes</h1>
    <a href="<?=HOME_URI?>/clientes" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <form action="<?=HOME_URI?>/clientes/salvar/<?=$this->model->clientes['cod_cli']?>" method="post">
        <div class="form-group">
            <input type="text" name="nome_cli" class="form-control large" placeholder="Nome" value="<?=$this->model->clientes['nome_cli']?>">
        </div>
        <div class="form-group">
            <input type="text" name="cidade_cli" class="form-control large" placeholder="Cidade" value="<?=$this->model->clientes['cidade_cli']?>">
        </div>
        <div class="form-group">
            <input type="text" name="uf_cli" class="form-control large" placeholder="UF" value="<?=$this->model->clientes['uf_cli']?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar" class="button success ripple"/>
        </div>
    </form>
</section>
</div>