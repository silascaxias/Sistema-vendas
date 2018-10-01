<?php

class HomeController extends MainController
{
    public function index() {   

     	if ($this->logged_in) {
            $this->title = 'Home';
        	$parameters = (func_num_args() >= 1 ) ? func_get_arg(0) : array();
       		$this->load_page('home/index.php');
        }else{
            $this->title = 'Login';
            $parameters = ( func_num_args() >= 1 ) ? func_get_arg(0) : array();
            $this->load_page('login/index.php');
        }
       

    }
}