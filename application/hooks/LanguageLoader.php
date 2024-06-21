<?php
    defined('BASEPATH')OR exit('No direct script access allowed');

    class LanguageLoader{

        function initialize(){
            $ci=& get_instance();
            $ci->load->helper('language');
            $ci->load->library('session');

            $array=array(
                'template',
                'dashboard',
                'plans',
                'network',
                'career',
                'bills',
                'report',
                'ticket'
            );

            $site_lang=$ci->session->userdata('site_lang');
            if($site_lang){
                //$ci->lang->load(array('layout','home','usuario'),$site_lang);
                $ci->lang->load($array,$site_lang);
            }
            else{
                //$ci->lang->load(array('layout','home','usuario'),'english');
                $ci->lang->load($array,'english');
            }
        }
    }


?>