<?php 

class UsuariosController extends MainController {
    public function __construct() {
        parent::__construct();
        $this->ensure_is_logged();
        $this->load_model('UsuariosModel');
        $this->load_model('VwUsuariosPerfil');
        $this->load_model('PerfilModel');
    }
    public function index() {        
        if ($_SESSION['userdata']['cod_perfil'] == 1) {
            $this->title = "Usuários";
            $this->model->usuarios = UsuariosModel::orderByAsc('cod_usu');
            $this->load_page('usuarios/index.php');
        }else{
            $this->title = 'Home';
            $this->set_message('Você não tem permissão!', 'warning');
            $this->load_page('home/index.php');
        }
    }

    public function editar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        if (!$parametros) {
            $this->throw_404();
        }
        $id = $parametros[0];
        $usuario = UsuariosModel::find($id);
        if (!$usuario) {
            $this->throw_404();
        }
       
        $this->model->usuario = $usuario;
        $this->model->perfis = PerfilModel::all();
        $this->load_page('usuarios/editar.php');
    }

    public function criar() {
        $this->title = "Novo Usuario";
        $this->model->perfis = PerfilModel::all();
        $this->load_page('usuarios/criar.php');
    }

    public function deletar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        if (!$parametros) {
            $this->throw_404();
        }
        $id = $parametros[0];
        UsuariosModel::delete($id);
        $this->set_message('Usuário deletado', 'warning');
        $this->goto_page(HOME_URI . '/usuarios/index');
    }

    public function salvar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $data = $_POST;

        $id = $parametros[0];
        if ($id){
            $data['cod_usu'] = $id;
        }   

        if(($data['nome_usu'] == null) || ($data['email_usu'] == null) || ($data['cod_perfil'] == -1)){
            $this->set_message('Preencha todos os campos!', 'warning');
            $this->goto_page(HOME_URI . '/usuarios/criar');
            exit();
        }
        if(!$id){
            $data['senha_usu'] = $this->phpass->HashPassword($data['senha_usu']);
        }
        $usu = new UsuariosModel($data);
        $results = $usu->save();
        $this->set_message('Salvo com sucesso', 'success');
        $this->goto_page(HOME_URI . '/usuarios/index');
    }
}

?>