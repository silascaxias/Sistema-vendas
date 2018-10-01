<?php

class VwUsuariosPerfil extends BaseModel {
    protected static $table = "vw_usuarios_perfil";
    protected static $primaryKey = null;
    protected $fields = array(
        'nome_usu',
        'email_usu',
        'desc_perfil'
    );
}
?>