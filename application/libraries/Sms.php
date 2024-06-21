<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sms
 *
 * @author furbox
 */
require 'vendor/autoload.php';

use Twilio\Rest\Client;

class Sms {

    protected $CI;
    // Your Account SID and Auth Token from twilio.com/console
    private $sid;
    private $token;
    private $client;

    public function __construct() {
        // Assign the CodeIgniter super-object
        $this->CI = & get_instance();
        // Your Account SID and Auth Token from twilio.com/console
        $this->sid = 'AC0fd58e7c925515c9a5330742ec607a79';
        $this->token = '1f07a52ad582f8adda3e3e977d63bd1b';
        $this->client = new Client($this->sid, $this->token);
    }

    public function send_message() {
        $data = $this->client->messages->create(
                // the number you'd like to send the message to
                '+59165947604', [
            // A Twilio phone number you purchased at twilio.com/console
            'from' => '+17179155253',
            // the body of the text message you'd like to send
            'body' => 'Envio desde Metabiz'
                ]
        );
        return $data;
    }

}
