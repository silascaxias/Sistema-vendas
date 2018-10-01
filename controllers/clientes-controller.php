<?php 

class ClientesController extends MainController {
    public function __construct() {
        parent::__construct();
        $this->ensure_is_logged();
        $this->load_model('ClientesModel');
    }
    public function index() {
        if ($_SESSION['userdata']['cod_perfil'] == 1) {
            $this->title = "Clientes";
            $this->model->clientes = ClientesModel::all();
            $this->load_page('clientes/index.php');
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
        $cliente = ClientesModel::find($id);
        if (!$cliente) {
            $this->throw_404();
        }
        $this->model->clientes = $cliente;
        $this->load_page('clientes/editar.php');
    }

    public function criar() {
        $this->title = "Novo Cliente";
        $this->load_page('clientes/criar.php');
    }

    public function deletar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        if (!$parametros) {
            $this->throw_404();
        }
        $id = $parametros[0];
        ClientesModel::delete($id);
        $this->set_message('Cliente deletado', 'warning');
        $this->goto_page(HOME_URI . '/clientes/index');
    }

    public function salvar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $data = $_POST;

        $id = $parametros[0];
        if ($id){
            $data['cod_cli'] = $id;
        }
        if($data['nome_cli'] == null){
            $this->set_message('Informe um nome!', 'warning');
            $this->goto_page(HOME_URI . '/clientes/criar');
            exit();
        }
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');
        $data['data_cad_cli'] = $date;   
        $cli = new ClientesModel($data);
        $results = $cli->save();
        $this->set_message('Salvo com sucesso', 'success');
        $this->goto_page(HOME_URI . '/clientes/index');
    }
}

?>