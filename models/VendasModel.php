<?php

class VendasModel extends BaseModel {
    protected static $table = "tbvenda";
    protected static $primaryKey = "cod_venda";
    protected $fields = array(
    	'cod_venda',
        'data_venda',
        'cod_cli'
    );
}
