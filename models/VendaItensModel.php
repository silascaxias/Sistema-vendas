<?php

class VendaItensModel extends BaseModel {
    protected static $table = "tbvendaitens";
    protected static $primaryKey = null;
    protected $fields = array(
        'cod_prod',
        'cod_venda',
        'total_itens',
        'qtde_itens'
    );
}
