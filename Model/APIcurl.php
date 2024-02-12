<?php 


class APIcurl {


    public function requisicaoCurl(){

        $url = "https://opentdb.com/api.php?amount=1";

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//erro com o SSL
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);

        $decoded = json_decode($response, true);

        curl_close($curl);

        return $decoded;

    }

}