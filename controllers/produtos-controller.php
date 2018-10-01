<?php 

class ProdutosController extends MainController {    
    public function __construct() {
        parent::__construct();
        $this->ensure_is_logged();
        $this->load_model('ProdutoModel');
    }
    public function index() {
        if ($_SESSION['userdata']['cod_perfil'] == 1) {
            $this->title = "Produtos";
            $this->model->produtos = ProdutoModel::all();
            $this->load_page('produtos/index.php');
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
        $produto = ProdutoModel::find($id);
        if (!$produto) {
            $this->throw_404();
        }
        $this->model->produto = $produto;
        $this->load_page('produtos/editar.php');
    }

    public function criar() {
        $this->title = "Novo Produto";
        $this->load_page('produtos/criar.php');
    }

    public function deletar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        if (!$parametros) {
            $this->throw_404();
        }
        $id = $parametros[0];
        ProdutoModel::delete($id);
        $this->set_message('Produtos deletado', 'warning');
        $this->goto_page(HOME_URI . '/produtos/index');
    }

    public function salvar() {
        $parametros = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $data = $_POST;

        $id = $parametros[0];
        if ($id){
            $data['cod_prod'] = $id;
        }   

        if(($_POST['valor_prod'] == null) || ($_POST['desc_prod'] == null)){
            $this->set_message('Preencha todos os campos!', 'warning');
            $this->goto_page(HOME_URI . '/produtos/criar');
            exit();
        }

        $prod = new ProdutoModel($data);
        $results = $prod->save();
        $this->set_message('Salvo com sucesso', 'success');
        $this->goto_page(HOME_URI . '/produtos/index');
    }
}

?>