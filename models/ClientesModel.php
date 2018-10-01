<?php

class ClientesModel extends BaseModel {
    protected static $table = 'tbcliente';
    protected static $primaryKey = 'cod_cli';
    protected $fields = array(
    	'cod_cli',
        'cidade_cli',
        'data_cad_cli',
        'endereco_cli',
        'nome_cli',
        'uf_cli'
    );
}

