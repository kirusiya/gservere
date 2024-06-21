<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Packages extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

    }



   public function index()
    {

 
    
     $this->template->load('cliente/templates/template', 'cliente/packages');
    }
}
