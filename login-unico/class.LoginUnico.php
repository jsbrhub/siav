<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 22/09/2020
 * Time: 10:38
 */

class LoginUnico {

    private static $host = "https://sso.staging.acesso.gov.br/";

    private static $_client_id;

    private static $_secret;

    private static $_token;

    private static $_instance;

    private static $requestConfig = [];

    private function __construct(){
        $aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);

        $conf = $aConfig["login-unico"];

        self::$_client_id = $conf["client_id"];

        self::$_secret = $conf["secret"];
    }

    public static function getToken(){
        return self::$_token;
    }

    protected  function  request(){
        if(empty(self::requestConfigGet("url")))
            return false;

        $ch = curl_init(self::$host . self::requestConfigGet("url"));

        if(self::requestConfigGet("method") == "POST")
            curl_setopt($ch, CURLOPT_POST, true);

        if (!empty(self::requestConfigGet("params")))
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(self::requestConfigGet("params")));

        if(!empty(self::requestConfigGet("headers")))
            curl_setopt($ch, CURLOPT_HTTPHEADER, self::requestConfigGet("headers"));

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $request = curl_exec($ch);

        curl_close($ch);

        self::requestConfigClear();

        return json_decode($request, true);
    }

    public static function requestToken($code){
        $self = self::getInstance();

        $self->requestConfigSet("url", "token")->requestConfigSet("method", "POST");

        $self->requestConfigSet("params", [
            "grant_type"   => "authorization_code",
            "code"         => $code,
            "redirect_uri" => "http://sin.sudam.gov.br"
        ]);

        $oAuth = base64_encode(self::$_client_id.":".self::$_secret);

        $self->requestConfigSet("headers", [
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic {$oAuth}"
        ]);

        $response = $self->request();

        if(empty($response["error"]))
            return $response;
        else
            return false;
    }

    public static function requestPublicKey(){
        $self = self::getInstance();

        $self->requestConfigSet("url", "jwk");

        return $self->request();
    }

    protected function requestConfigSet($param, $data){
        self::$requestConfig[$param] = $data;

        return self::$_instance;
    }

    protected function requestConfigGet($param){
        if(!empty(self::$requestConfig[$param]))
            return self::$requestConfig[$param];
        else
            return false;
    }


    protected function requestConfigClear(){
        self::$requestConfig = [];
    }

    public static function getInstance(){
        if (self::$_instance == null)
            self::$_instance = new LoginUnico();

        return self::$_instance;
    }


}