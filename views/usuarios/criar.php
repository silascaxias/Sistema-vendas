<div class="card card-center">
<header class="card-header flex-container align-middles space-between">
    <h1>Adicionar novo usuario</h1>
    <a href="<?=HOME_URI?>/usuarios" class="button back small">Voltar</a>
</header>

<section class="card-content">
    <form action="<?=HOME_URI?>/usuarios/salvar" method="post">
        <div class="form-group">
            <input type="text" name="nome_usu" class="form-control large" placeholder="Nome">
        </div>
        <div class="form-group">
            <input type="email" name="email_usu" class="form-control large" placeholder="E-mail">
        </div>
        <div class="form-group">
            <input type="password" name="senha_usu" class="form-control large" placeholder="Senha">
        </div>
        <div class="form-group">
            <select class="form-control" name="cod_perfil">
                    <option value="-1">Selecione um perfil</option>
                <?php foreach($this->model->perfis as $perfil) { ?>
                    <option value="<?=$perfil['cod_perfil']?>">
                        <?=$perfil['desc_perfil']?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Salvar" class="button success ripple"/>
        </div>
    </form>
</section>
</div>