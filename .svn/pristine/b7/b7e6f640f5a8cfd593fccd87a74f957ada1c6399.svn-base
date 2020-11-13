<?php

//if(!empty($_GET["code"])){
    $host = "https://sso.staging.acesso.gov.br/token";

    $ch = curl_init($host);

    $oAuth = base64_encode("sin.sudam.gov.br:AIJK_5qw2pVVKU0ueGnT60-nmp_Q_1Imqp6_gJ6aV219Pxish02DgupAwIdUufpRj8gOwjQUHiyDmlW3A0JQP5Y");

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/x-www-form-urlencoded",
        "Authorization: Basic {$oAuth}"
    ]);

    $params = ["code" => "o7lGAj", "grant_type" => "authorization_code", "redirect_uri" => "http%3A%2F%2Fsin.sudam.gov.br"];

    curl_setopt($ch, CURLOPT_POST, true);

    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=authorization_code&code=WOPIqk&redirect_uri=http%3A%2F%2Fsin.sudam.gov.br");

//    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    $request = json_decode(curl_exec($ch));

    curl_close($ch);

    echo "<pre>";

    print_r($request);
//}

