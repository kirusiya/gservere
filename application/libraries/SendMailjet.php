<?php

require 'vendor/autoload.php';

use \Mailjet\Resources;

// Use your saved credentials, specify that you are using Send API v3.1

class SendMailJet {

    private $mj;

    public function __construct() {
        $this->mj = new \Mailjet\Client('10c17bf831826b2cb0caa4cd9de77a6a', 'eeb0809eb862d4be6e0bbe3fc5efbd35', true, ['version' => 'v3.1']);
    }

    public function sendMail($html) {


        // Define your request body

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "noreply@smartglobalinvest.net",
                        'Name' => "Global Investiment"
                    ],
                    'To' => [
                        [
                            'Email' => "smartglobalinvestiment@gmail.com",
                        ]
                    ],
                    [
                        [
                            'Email' => "miultimosegundo@gmail.com",
                        ]
                    ],
                    'Subject' => 'Confirmación de Pago',
                    'HTMLPart' => $html
                ]
            ]
        ];

        // All resources are located in the Resources class

        $response = $this->mj->post(Resources::$Email, ['body' => $body]);

        // Read the response

        $response->success() && var_dump($response->getData());
    }

}
