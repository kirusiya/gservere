<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: furbox
 * Date: 15/02/16
 * Time: 12:50 AM
 */
require_once('vendor/autoload.php');

use CoinbaseCommerce\Webhook;

class Coinbase {

    protected $CI;
    private $ApiKey;
    private $WebHookKey;
    private $HeaderName;

    public function __construct() {
        // Assign the CodeIgniter super-object
        $this->CI = & get_instance();
        $this->ApiKey = 'd1f9abd6-2e22-4146-9eef-1388def40b55';
        $this->WebHookKey = '6c1b9243-7ec2-48e0-9164-acdf5cffa649';
        $this->HeaderName = 'X-Cc-Webhook-Signature';
    }

    public function createCharge($amount, $code, $name, $idfact) {
        
        $body = [
            'local_price' => [
                'amount' => $amount,
                'currency' => 'USD',
            ],
            'metadata' => [
                'customer_id' => $_SESSION['user_id'],
                'customer_name' => $_SESSION['user_name'],
                'customer_factId' => $idfact
            ],
            'name' => $name,
            'description' => $name,
            'pricing_type' => 'fixed_price',
            'redirect_url' => base_url('plans/?active=success'),
            'cancel_url' => base_url('plans/?active=cancel')
        ];

        $bodyToJson = json_encode($body);
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.commerce.coinbase.com/charges',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $bodyToJson,
            CURLOPT_HTTPHEADER => array(
                'X-CC-Api-Key: '.$this->ApiKey,
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);
        return json_decode($response);
    }

    public function webHook($payload, $signraturHeader) {
        try {
            $event = Webhook::buildEvent($payload, $signraturHeader, $this->WebHookKey);
            if ($event->type === 'charge:confirmed') {
                return $event;
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            return false;
        }
    }

}
