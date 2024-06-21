<?php
class Bitcoin{

    public function Price(){

        $request = SendRequest('https://www.mercadobitcoin.net/api/BTC/ticker/');
        $response = json_decode($request);

        return number_format($response->ticker->sell, 2, ",", ".");
    }
}
?>