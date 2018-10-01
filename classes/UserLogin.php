<?php
class UserLogin
{
    public $logged_in;
    public $userdata;
    public $login_error;
    
    public function check_user_login() {

        if (isset($_SESSION['userdata']) && !empty($_SESSION['userdata']) && is_array($_SESSION['userdata']) && !isset($_POST['userdata'])) { 
            $userdata = $_SESSION['userdata'];
            $userdata['post'] = false;
        }

        if (isset($_POST['userdata']) && !empty($_POST['userdata']) && is_array($_POST['userdata'])) {
            $userdata = $_POST['userdata'];
            $userdata['post'] = true;
        }

        if (!isset($userdata) || !is_array($userdata)) {
            $this->logout();
            return;
        }

        $post = $userdata['post'] ? true : false;
        unset($userdata['post']);

        if (empty($userdata)) {
            $this->logged_in = false;
            $this->login_error = null;
            $this->logout();
            return;
        }

        $email_usu = $userdata['email_usu'];
        $senha_usu = $userdata['senha_usu'];


        if (empty($email_usu) || empty($senha_usu)) {
            $this->logged_in = false;
            $this->login_error = null;
            $this->logout();
            return;
        }
        $query = $this->db->query('SELECT * FROM tbusuario WHERE email_usu = ? LIMIT 1', array($email_usu));
        if (!$query) {
            $this->logged_in = false;
            $this->login_error = 'Erro, e-mail não encontrado.';
            $this->logout();
            return;
        }

        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $cod_usu = (int)$fetch['cod_usu'];

        
        if (empty($cod_usu) || $cod_usu == 0){
            $this->logged_in = false;
            $this->login_error = 'Usuário não encontrado';
            $this->logout();
            return;
        }

        if ($this->phpass->CheckPassword($senha_usu, $fetch['senha_usu'])) {


            if (session_id() != $fetch['sessao_usu'] && !$post) { 
                $this->logged_in = false;
                $this->login_error = 'Problema com a sessão do usuário';
                $this->logout();
                return;
            }
            if ($post) {
                session_regenerate_id();
                $sessao_usu = session_id();
                $_SESSION['userdata'] = $fetch;
                $_SESSION['userdata']['senha_usu'] = $senha_usu;
                $_SESSION['userdata']['sessao_usu'] = $sessao_usu;
                $_SESSION['nome_cli'] = null;
                $_SESSION['produtos'] = array();             
                
                date_default_timezone_set('America/Sao_Paulo');
                $date = date('Y-m-d H:i:s');
                $query = $this->db->query('UPDATE tbusuario SET `sessao_usu` = ?, `ultima_atividade_usu` = ? WHERE `cod_usu` = ?;', array($sessao_usu,$date, $cod_usu));
            }
            $this->logged_in = true;
            $this->userdata = $_SESSION['userdata'];
            if (isset($_SESSION['goto_url'])) {
                $goto_url = urldecode($_SESSION['goto_url']);
                unset($_SESSION['goto_url']);
                echo '<meta http-equiv="Refresh" content="0; url=' . $goto_url . '">';
                echo '<script type="text/javascript">window.location.href = "' . $goto_url . '";</script>';
            }
            return;
        } else {
            $this->logged_in = false;
            $this->login_error = 'Senha incorreta.';
            $this->logout();
            return;
        }

    }
    protected function logout($redirect = false) {
        $_SESSION['userdata'] = array();
        unset($_SESSION['userdata']);
        session_regenerate_id();
        if ($redirect === true) {
            $this->goto_login();
        }
    }
    protected function goto_login() {
        if (defined('HOME_URI')) {
            $login_uri  = HOME_URI . '/login';
            $_SESSION['goto_url'] = urlencode($_SERVER['REQUEST_URI']);
            echo '<meta http-equiv="Refresh" content="0; url=' . $login_uri . '">';
            echo '<script type="text/javascript">window.location.href = "' . $login_uri . '";</script>';
        }
        return;
    }
    
    final protected function goto_page($page_uri = null) {
        if (isset($_GET['url']) && ! empty($_GET['url']) && ! $page_uri) {
            $page_uri  = urldecode($_GET['url']);
        } 
        if ($page_uri) { 
            echo '<meta http-equiv="Refresh" content="0; url=' . $page_uri . '">';
            echo '<script type="text/javascript">window.location.href = "' . $page_uri . '";</script>';
            return;
        }
    }
}	