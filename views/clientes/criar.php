<div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Adicionar novo cliente</h1>
    <a href="<?=HOME_URI?>/clientes" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <form action="<?=HOME_URI?>/clientes/salvar" method="post">
        <div class="form-group">
            <input type="text" name="nome_cli" class="form-control large" placeholder="Nome">
        </div>
         <div class="form-group">
            <input type="text" name="endereco_cli" class="form-control large" placeholder="Endereço">
        </div>
        <div class="form-group">
            <input type="text" name="cidade_cli" class="form-control large" placeholder="Cidade">
        </div>
        <div class="form-group">
            <input type="text" maxlength="2" name="uf_cli" class="form-control large" placeholder="UF">
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar" class="button success ripple"/>
        </div>
    </form>
</section>
</div>