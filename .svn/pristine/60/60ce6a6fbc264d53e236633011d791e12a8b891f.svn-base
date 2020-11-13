<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 22/09/2020
 * Time: 14:55
 */

require_once "class.LoginUnico.php";
require_once "class.JwtExtractor.php";


if(!empty($_REQUEST["code"])){
    $tokens = LoginUnico::requestToken($_REQUEST["code"]);

    if($tokens){
        $pKeys = LoginUnico::requestPublicKey();

        $userInfo = JwtExtractor::extract($tokens["id_token"], $pKeys);

        echo "<pre>";

        print_r($userInfo);

        exit;
    }
}


//print_r(LoginUnico::getTokenInfo());

//var_dump(LoginUnico::requestToken("yywTpN"));