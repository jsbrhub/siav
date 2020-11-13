<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 22/09/2020
 * Time: 10:38
 */

class LoginUnico {

    private static $host;

    private static $_client_id;

    private static $_secret;

    private static $_redirect_uri;

    private static $_token;

    private static $_instance;

    private static $requestConfig = [];

    private function __construct(){
        $aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);

        $conf = $aConfig["login-unico"];

        self::$_client_id = $conf["client_id"];

        self::$_secret = $conf["secret"];

        self::$_redirect_uri = $conf["redirect_uri"];

        self::$host = $conf["host"];
    }

    public static function getUrlLogout(){
        self::getInstance();

        return "https://sso.".self::$host."/logout?post_logout_redirect_uri=".urlencode(self::$_redirect_uri);
    }

    public static function getToken(){
        return $_SESSION["usuarioLogado"]["access_token"];
    }

    protected  function  request(){
        $url = self::requestConfigGet("url");

        if(empty($url))
            return false;

        $subdomais = self::requestConfigGet("subdomain");

        $server_host = (!empty($subdomais)) ?  "https://{$subdomais}.".self::$host : "https://sso.".self::$host;

        $ch = curl_init($server_host . self::requestConfigGet("url"));

        if(self::requestConfigGet("method") == "POST")
            curl_setopt($ch, CURLOPT_POST, true);

        $params = self::requestConfigGet("params");

        if (!empty($params))
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

        $headers = self::requestConfigGet("headers");

        if(!empty($headers))
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

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

        $self->requestConfigSet("url", "/token")->requestConfigSet("method", "POST");

        $self->requestConfigSet("params", [
            "grant_type"   => "authorization_code",
            "code"         => $code,
            "redirect_uri" => self::$_redirect_uri
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

        $self->requestConfigSet("url", "/jwk");

        return $self->request();
    }

    public static function requestEmpresas($cpf){
        $self = self::getInstance();

        $self->requestConfigSet("subdomain", "api");

        $self->requestConfigSet("url", "/empresas/v2/empresas?filtrar-por-participante={$cpf}");

        $self->requestConfigSet("headers", [
            "Authorization: Bearer ".$self->getToken()
        ]);

        $r = $self->request();

        if(isset($r['errors']) && $r["errors"][0]["status"] == 401){
            unset($_SESSION["usuarioLogado"]);

            unset($_SESSION["usuarioAtual"]);
        }

        return $r;
    }

    public static function requestEmpresaPermissao($cpf, $cnpj){
        $self = self::getInstance();

        $self->requestConfigSet("subdomain", "api");

        $self->requestConfigSet("url", "/empresas/v2/empresas/{$cnpj}/participantes/{$cpf}");

        $self->requestConfigSet("headers", [
            "Authorization: Bearer ".$self->getToken()
        ]);

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