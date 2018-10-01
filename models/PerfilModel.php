<?php

class PerfilModel extends BaseModel {
    protected static $table = "tbperfil";
    protected static $primaryKey = "cod_perfil";
    protected $fields = array(
    	'cod_perfil',
        'desc_perfil',
        'FullAcess'
    );
}
