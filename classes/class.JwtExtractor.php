<?php

require_once "jwt-library/JWT.php";
require_once "jwt-library/JWK.php";
require_once "jwt-library/ExpiredException.php";
require_once "jwt-library/SignatureInvalidException.php";
require_once "jwt-library/BeforeValidException.php";

use Firebase\JWT\JWT;


class JwtExtractor{

    private static $_instance;

    private function __construct(){

    }

    private static function getInstance(){
        if(self::$_instance == null)
            self::$_instance = new JwtExtractor();

        return self::$_instance;
    }

    private function validateData($token, $jwk){
        $modulus = JWT::urlsafeB64Decode($jwk['keys'][0]['n']);
        $publicExponent = JWT::urlsafeB64Decode($jwk['keys'][0]['e']);
        $components = array(
            'modulus' => pack('Ca*a*', 2, $this->encodeLength(strlen($modulus)), $modulus),
            'publicExponent' => pack('Ca*a*', 2, $this->encodeLength(strlen($publicExponent)), $publicExponent)
        );
        $RSAPublicKey = pack(
            'Ca*a*a*',
            48,
            $this->encodeLength(strlen($components['modulus']) + strlen($components['publicExponent'])),
            $components['modulus'],
            $components['publicExponent']
        );
        $rsaOID = pack('H*', '300d06092a864886f70d0101010500');
        $RSAPublicKey = chr(0) . $RSAPublicKey;
        $RSAPublicKey = chr(3) . $this->encodeLength(strlen($RSAPublicKey)) . $RSAPublicKey;
        $RSAPublicKey = pack(
            'Ca*a*',
            48,
            $this->encodeLength(strlen($rsaOID . $RSAPublicKey)),
            $rsaOID . $RSAPublicKey
        );
        $RSAPublicKey = "-----BEGIN PUBLIC KEY-----\r\n" . chunk_split(base64_encode($RSAPublicKey), 64) . '-----END PUBLIC KEY-----';

        JWT::$leeway = 3 * 60; //em segundos

        $decoded = JWT::decode($token, $RSAPublicKey, array('RS256'));

        return (array) $decoded;
    }

    private function encodeLength($length)
    {
        if ($length <= 0x7F) {
            return chr($length);
        }
        $temp = ltrim(pack('N', $length), chr(0));
        return pack('Ca*', 0x80 | strlen($temp), $temp);
    }

    public static function extract($token, $jwk){

        self::getInstance();

        return self::$_instance->validateData($token, $jwk);
    }
}

//$jsonKeys = json_decode('{"keys":[{"kty":"RSA","e":"AQAB","kid":"rsa1","alg":"RS256","n":"yKqGRQyJtqxRm_Mo2YTCCAkPSDb7uNgC7tXjgVzNv2_XB8r4vMibBpZFPbwyVUk0wGhPk8qLjrIj_K8IMu_IYtkq87pc1_1FAOub7e3xUrMx66GCq8QG94xROSfDWuMy7twILwjbkzNEU6bNibM0IQbCvdybFPhq4YHvlwOjfuMl2mNUma8wT1_l2MZenV1dmeLTg_kYGe9PGmn9JiY4t01Nj1FJQj9rH863KAa3LadQ4l8aBOpaIZwjANo3GCJJd4uSB67G-p0wuuDDYbiUGtN55degXjDKrv3v5bLgpPMX6ynvt2bi0olb_QZfovTnUaLfsZpCXTk_CvUXr2Q2Kw"}]}', true);
//
//$tk_id = 'eyJraWQiOiJyc2ExIiwiYWxnIjoiUlMyNTYifQ.eyJzdWIiOiI2ODI1NjQwNzA0MiIsImVtYWlsX3ZlcmlmaWVkIjoidHJ1ZSIsImFtciI6WyJwYXNzd2QiXSwicHJvZmlsZSI6Imh0dHBzOlwvXC9zdGFnaW5nLmFjZXNzby5nb3YuYnIiLCJraWQiOiJyc2ExIiwiaXNzIjoiaHR0cHM6XC9cL3Nzby5zdGFnaW5nLmFjZXNzby5nb3YuYnJcLyIsInBob25lX251bWJlcl92ZXJpZmllZCI6InRydWUiLCJub25jZSI6IjY4M2QxOTJmZGE4NGUxNTZjNzkzN2QxMGE0MDUzM2Y2IiwicGljdHVyZSI6Imh0dHBzOlwvXC9zc28uc3RhZ2luZy5hY2Vzc28uZ292LmJyXC91c2VyaW5mb1wvcGljdHVyZSIsImF1ZCI6InNpbi5zdWRhbS5nb3YuYnIiLCJhdXRoX3RpbWUiOjE2MDA4OTIwNzEsInNjb3BlIjpbImVtYWlsIiwib3BlbmlkIiwicGhvbmUiLCJwcm9maWxlIl0sIm5hbWUiOiJKb8OjbyBUb23DqSBQaW50byBkZSBTb3V6YSBQYWxoYXJlcyIsInBob25lX251bWJlciI6IjMxOTk2NDU1OTcxIiwiZXhwIjoxNjAwODkyNjg2LCJpYXQiOjE2MDA4OTIwODYsImp0aSI6IjZjNTJkMjk3LWMxYTgtNDk0ZC05MzRjLWI4MDY3NGM3ZWM0MSIsImVtYWlsIjoibGF2b2lzaWVyLnZpZWlyYUBzZXJwcm8uZ292LmJyIn0.ZPLsYDHpBR_7X0TTceW31L6aryKpYZLj3RzTvJ3Zdj7GBV5VNrxIpSM9QhOqxYumMUC2M59Pz-SydKrEzqFjnDNV2FsxgsTtpz6FmVOZZwTZhwHfVjg6gwiMteljj67DKqmcCMatsl4Kd_95bvYmYKgBIhqwa5K5B0e4b5wOiKYx87MQfq5Xs1ubGN70z3j9NV7JpwwM94thxGQJcXWj0e6_UpOfyat_KwFHcjcOE062WxdTzvudsx-uZ1bwQcTny2kxeM6Xx8z2FVjxzjs9xvliWc9UDHJ0CyO6CxcqvBUf__emN8JBOyfA5BzD1osFY6NihMWexZZ4nSvnx6BPrA';
////echo "<pre>"; print_r($jsonKeys);exit;
//$dados = processToClaims($tk_id, $jsonKeys);
//echo "<pre>";
//
//print_r($dados);

//
//function processToClaims($access_token, $jwk)
//{
//    $modulus = JWT::urlsafeB64Decode($jwk['keys'][0]['n']);
//    $publicExponent = JWT::urlsafeB64Decode($jwk['keys'][0]['e']);
//    $components = array(
//        'modulus' => pack('Ca*a*', 2, encodeLength(strlen($modulus)), $modulus),
//        'publicExponent' => pack('Ca*a*', 2, encodeLength(strlen($publicExponent)), $publicExponent)
//    );
//    $RSAPublicKey = pack(
//        'Ca*a*a*',
//        48,
//        encodeLength(strlen($components['modulus']) + strlen($components['publicExponent'])),
//        $components['modulus'],
//        $components['publicExponent']
//    );
//    $rsaOID = pack('H*', '300d06092a864886f70d0101010500'); // hex version of MA0GCSqGSIb3DQEBAQUA
//    $RSAPublicKey = chr(0) . $RSAPublicKey;
//    $RSAPublicKey = chr(3) . encodeLength(strlen($RSAPublicKey)) . $RSAPublicKey;
//    $RSAPublicKey = pack(
//        'Ca*a*',
//        48,
//        encodeLength(strlen($rsaOID . $RSAPublicKey)),
//        $rsaOID . $RSAPublicKey
//    );
//    $RSAPublicKey = "-----BEGIN PUBLIC KEY-----\r\n" . chunk_split(base64_encode($RSAPublicKey), 64) . '-----END PUBLIC KEY-----';
//
//    JWT::$leeway = 3 * 60; //em segundos
//
//    $decoded = JWT::decode($access_token, $RSAPublicKey, array('RS256'));
//
//    return (array) $decoded;
//}
//
//function encodeLength($length)
//{
//    if ($length <= 0x7F) {
//        return chr($length);
//    }
//    $temp = ltrim(pack('N', $length), chr(0));
//    return pack('Ca*', 0x80 | strlen($temp), $temp);
//}
