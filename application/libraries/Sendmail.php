<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sendmail
 *
 * @author furbox
 */
class Sendmail {

    function EnviarEmail($para, $assunto, $mensagem) {

        $_this = &get_instance();

        if (SMTP_ENABLED == 1) {

            $config['protocol']  = 'smtp';
            $config['smtp_host'] = SMTP_HOST;
            $config['smtp_user'] = SMTP_USER;
            $config['smtp_pass'] = SMTP_PASS;
            $config['smtp_port'] = SMTP_PORT; // Usar 587 para TLS
            $config['smtp_crypto'] = SMTP_ENCRYPT;
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $config['newline'] = "\r\n";

            // if (SMTP_ENCRYPT != '') {
            //     $config['smtp_crypto'] = SMTP_ENCRYPT;
            // } else {
            //     $config['smtp_crypto'] = 'ssl';
            // }

            $_this->email->initialize($config);
        }

        $_this->email->to($para);
        $_this->email->from(EMAIL_REMITENTE, NAME_SITE);
        $_this->email->set_mailtype('html');
        $_this->email->subject($assunto);
        $_this->email->message($mensagem);
        $_this->email->send();
    }

}
