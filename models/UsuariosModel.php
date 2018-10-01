<?php

class UsuariosModel extends BaseModel {
    protected static $table = "tbusuario";
    protected static $primaryKey = "cod_usu";
    protected $fields = array(
        'cod_usu',
        'nome_usu',
        'email_usu',
        'senha_usu',
        'cod_perfil',
        'ultima_atividade_usu',
        'sessao_usu'
    );
}
