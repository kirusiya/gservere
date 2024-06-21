<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CambiarIdioma extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('user_agent');
    }

    function lenguaje($language="")
    {
        $url=base_url();
        if($this->agent->referrer()){
            $url=$this->agent->referrer();
        }

        $language=($language!="")?$language:"english";
        $this->session->set_userdata('site_lang',$language);
        //redirect($url.'dashboard/');
		header('location:'.$url);
		
		

    }
}



?>