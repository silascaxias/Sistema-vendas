<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$this->title?> - Sistema Vendas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" media="screen" href="<?=HOME_URI?>/views/css/framework.css?v=<?=uniqid()?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?=HOME_URI?>/views/css/main.css?v=<?=uniqid()?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?=HOME_URI?>/views/css/fontawesome/fontawesome-all.min.css?v=<?=uniqid()?><"/>    
    <script src="<?=HOME_URI?>/views/js/functions.js?"></script>
    <script src="<?=HOME_URI?>/views/js/jquery-3.3.1.min.js?"></script>

</head>
<body>

<header class="header">
    <?php if($this->logged_in):?>
    <a href="<?=HOME_URI?>/home">
         Bem vindo - <?=$_SESSION['userdata']['nome_usu']?>
    </a>
    <div>
        <h4>
            <a href="<?=HOME_URI?>/login/sair">Sair</a>
        </h4>
        <?php else:?>
            <a href="<?=HOME_URI?>/home">
                </strong>Bem vindo</strong>  
            </a>
        <?php endif;?>
    </div>
</header>
