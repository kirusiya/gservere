<?php

require 'vendor/autoload.php';

function auth()
{
    $_this = &get_instance();
    ##### Sincronizacion ##### JVM #####        
    $google2fa = new \PragmaRX\Google2FAQRCode\Google2FA();
    $secret = $google2fa->generateSecretKey(32);
    $inlineUrl = $google2fa->getQRCodeInline(
        'SGI APP',
        'sales@smartglobalinvest.net',
        $secret
    );
    $_this->db->select('user_secret');
    $_this->db->from('usuarios');
    $_this->db->where('id', $_this->session->userdata('uid'));
    $_this->db->where('user_secret', '');
    $get_usersecret = $_this->db->get();
    if ($get_usersecret->num_rows() > 0) {
        $_this->db->where('id', $_this->session->userdata('uid'));
        $_this->db->update('usuarios', array('user_secret' => $secret));
    }
    return $inlineUrl;
    ##### Sincronizacion ##### JVM #####
}

function validartor($code)
{
    ##### Validación ##### JVM #####
    $_this = &get_instance();
    $windows = 8;
    $g = new \PragmaRX\Google2FAQRCode\Google2FA();
    $_this->db->select('id, user_secret');
    $_this->db->from('usuarios');
    $_this->db->where('id', $_this->session->userdata('uid'));
    $get_usersecret = $_this->db->get();
    if ($get_usersecret->num_rows() > 0) {
        foreach ($get_usersecret->result() as $us) {
            $user_secret = $us->user_secret;
            echo $us->user_secret . "<br><br>";
        }
    } else {
        $user_secret = '';
    }

    if ($g->verifyKey($user_secret, $code)) {
        return true;
    } else {
        return false;
    }
    ##### Validación ##### JVM #####
}
