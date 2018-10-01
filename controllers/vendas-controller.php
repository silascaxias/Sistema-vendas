<?php 

class VendasController extends MainController {

    public function __construct() {
        parent::__construct();
        $this->load_model('VendasModel');
        $this->load_model('VendaItensModel');
        $this->load_model('ProdutoModel');
        $this->load_model('ClientesModel');
    }


    public function index() {
        if($this->logged_in){
            $this->title = 'Registro de Vendas';
            $this->model->visualize_url = HOME_URI . '/vendas/view/';

            $this->model->vendas = VendasModel::all();

            $this->model->ver_url = HOME_URI . '/vendas/ver/';

            $this->load_page('vendas/index.php');
        }else{
            $this->title = 'Login';
            $parameters = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
            $this->load_page('login/index.php');
        }
    }
    public function ver() {
        $parameters = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $this->model->id = $parameters[0];

        $this->model->total = null;

        $this->model->ver = VendaItensModel::where("cod_venda =".$this->model->id);
        
        $this->title = 'Detalhes da Venda';
        $this->load_page('vendas/ver.php');
    }

    public function criar() {
        $this->title = "Nova Venda";
        $this->model->clientes = ClientesModel::all();
        $this->model->produtos = ProdutoModel::all();
        $this->model->total = null;
        
        if(isset($_POST['removeCli'])){
            $_SESSION['nome_cli'] = NULL;  
        }
        if(isset($_POST['cod_cli'])){            
            $idCli = $_POST['cod_cli'];

            if($idCli == -1){
                $this->set_message('Informe um cliente!', 'error');
                $this->goto_page(HOME_URI . '/vendas/criar');
                exit;
            }
            if($_SESSION['nome_cli'] == null){
                $_SESSION['nome_cli'] = $this->retornaCLiente($idCli);  
            }
        }                

        $this->load_page('vendas/criar.php');
    }

    public function retornaProduto($id){
        $this->model->produtos = ProdutoModel::all();
        foreach ($this->model->produtos as $prod) {
            if($prod['cod_prod'] == $id){
                $produto = ProdutoModel::find($id);
                return $produto;
            }
        }
    }
    public function descProd($id){
        $this->model->produtos = ProdutoModel::all();

        foreach ($this->model->produtos as $prod) {
            if($prod['cod_prod'] == $id){
                return $prod['desc_prod'];
            }
        }
    }
    public function retornaCLiente($id){
        $this->model->clientes = ClientesModel::all();
        foreach ($this->model->clientes as $cliente) {
            if($cliente['cod_cli'] == $id){
                return $cliente['nome_cli'];
            }
        }
    }
    public function addproduto(){
            $idProd = $_POST['cod_prod'];
            if($idProd == -1){
                $this->set_message('Informe um produto!', 'warning');
                $this->goto_page(HOME_URI . '/vendas/criar'); 
                exit();  
            }
            $produtos = $this->retornaProduto($idProd);
            $valor_prod = doubleval($produtos['valor_prod']);

            $qtde = doubleval($_POST['qtde']);  
        
            if($qtde <= 0) {
                $this->set_message('Informe uma quantidade válida!', 'warning');
                $this->goto_page(HOME_URI . '/vendas/criar'); 
                exit();  
            }

            $produtos['qtde'] = $qtde;
            $produtos['valor_total'] = doubleval($qtde * $valor_prod);


            foreach ($_SESSION['produtos'] as $key => $prod) {
        
                if($prod['cod_prod'] == $idProd){
                    $_SESSION['produtos'][$key]['qtde'] += $qtde;
                    $val = doubleval($prod['valor_prod']);
                    $_SESSION['produtos'][$key]['valor_total'] += doubleval($val * $qtde);

                    $this->goto_page(HOME_URI . '/vendas/criar');    
                    exit();              
                }
            }
           
            array_push($_SESSION['produtos'],$produtos);
            $this->goto_page(HOME_URI . '/vendas/criar');  
    }

    public function deletarVenda(){
        $parameters = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $id = $parameters[0];
        
        $results = VendasModel::delete($id);
        $results2 = VendaItensModel::deleteItens('cod_venda',$id);

        if($results && $results2){
            $this->set_message('Erro ao deletar a venda!', 'error');
            $this->goto_page(HOME_URI . '/vendas');
            
        }
        $this->goto_page(HOME_URI . '/vendas');
    }

    public function deletar(){
        $parameters = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $id = $parameters[0];
        foreach ($_SESSION['produtos'] as $key => $prod) {
                    
            if(($prod['cod_prod'] == $id) && ($prod['qtde'] > 1)){
                $_SESSION['produtos'][$key]['qtde'] -= 1;   
                $_SESSION['produtos'][$key]['valor_total'] -= doubleval($_SESSION['produtos'][$key]['valor_prod']);
                $this->goto_page(HOME_URI . '/vendas/criar');      
                return;   
            }else if(($prod['cod_prod'] == $id) && ($prod['qtde'] <= 1 )){
                unset($_SESSION['produtos'][$key]); 
                $this->goto_page(HOME_URI . '/vendas/criar');      
                return; 
            }
        }
    }

    public function limpar(){

        $_SESSION['nome_cli'] = NULL;
        foreach ($_SESSION['produtos'] as $key => $prod) {
            unset($_SESSION['produtos'][$key]);
        }

        $this->set_message('Sucesso ao limpar a venda!', 'success');
        $this->goto_page(HOME_URI . '/vendas/criar'); 
    }


    public function salvar() {

        $parameters = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
        $data = $_POST;
        $id = $parameters[0];
        $_SESSION['nome_cli'] = NULL;

        if($_POST['nome_cli'] == null){
            $this->set_message('Informe um cliente antes de salvar!', 'warning');
            $this->goto_page(HOME_URI . '/vendas/criar'); 
            exit();
        }

        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i');

        $data['data_venda'] = $date;
        $cli = ClientesModel::Where("nome_cli = '".$_POST['nome_cli']."'");
        $data['cod_cli'] = $cli[0]['cod_cli'];

        $venda = new VendasModel($data);
        $results = $venda->save();

        if (!$results->id) {
            $this->set_message('Houve um problema ao salvar a venda!', 'error');
            $this->goto_page(HOME_URI . '/vendas/criar');
            exit;
        }
        
        $idVenda = $results->id;



        foreach ($_SESSION['produtos'] as $key => $prod) {


                $data = array(
                    "cod_venda" => $idVenda,
                    "cod_prod"  => $prod['cod_prod'],
                    "qtde_itens" => intval($prod['qtde']),
                    "total_itens" => doubleval($prod['valor_total'])
                );
                
                $itemVenda = new VendaItensModel($data);
                $results = $itemVenda->save();
                unset($_SESSION['produtos'][$key]);
        }
        $this->set_message('Venda registrada com sucesso', 'success');
        $this->goto_page(HOME_URI . '/vendas');
    }

}


?>