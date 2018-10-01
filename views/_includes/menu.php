<?php if (!defined('ABSPATH')) exit; ?>

<?php if ($this->logged_in): ?>
<aside class="sidebar">
    <ul>
        <li>
            <a href="<?=HOME_URI?>/home">Home</a>
        </li>
        <li>
            <a href="<?=HOME_URI?>/vendas">Vendas</a>
        </li>
        <li>
            <a href="<?=HOME_URI?>/produtos">Produtos</a>
        </li>
        <li>
            <a href="<?=HOME_URI?>/clientes">Clientes</a>
        </li>
        <li>
            <a href="<?=HOME_URI?>/usuarios">Usuarios</a>
        </li>
    </ul>
    <footer class="footer">
        <p>Sistema Vendas</p>
    </footer> 
</aside>
<section class="main-content">
    <?php if ($this->message): ?>
        <div class="alert <?=$this->message->Type?>">
            <span><?=$this->message->Text?></span>
        </div>
    <?php endif ?>
<?php endif ?>