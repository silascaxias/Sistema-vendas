<?php

class ProdutoModel extends BaseModel {
    protected static $table = "tbproduto";
    protected static $primaryKey = "cod_prod";
    protected $fields = array(
    	'cod_prod',
        'desc_prod',
        'valor_prod'
    );
}
