<?php

require_once "jwt-library/JWT.php";

use Firebase\JWT\JWT;

$jsonKeys = json_decode('{"keys":[{"kty":"RSA","e":"AQAB","kid":"rsa1","alg":"RS256","n":"yKqGRQyJtqxRm_Mo2YTCCAkPSDb7uNgC7tXjgVzNv2_XB8r4vMibBpZFPbwyVUk0wGhPk8qLjrIj_K8IMu_IYtkq87pc1_1FAOub7e3xUrMx66GCq8QG94xROSfDWuMy7twILwjbkzNEU6bNibM0IQbCvdybFPhq4YHvlwOjfuMl2mNUma8wT1_l2MZenV1dmeLTg_kYGe9PGmn9JiY4t01Nj1FJQj9rH863KAa3LadQ4l8aBOpaIZwjANo3GCJJd4uSB67G-p0wuuDDYbiUGtN55degXjDKrv3v5bLgpPMX6ynvt2bi0olb_QZfovTnUaLfsZpCXTk_CvUXr2Q2Kw"}]}', true);

$tk_id = 'eyJraWQiOiJyc2ExIiwiYWxnIjoiUlMyNTYifQ.eyJzdWIiOiI2ODI1NjQwNzA0MiIsImVtYWlsX3ZlcmlmaWVkIjoidHJ1ZSIsImFtciI6WyJwYXNzd2QiXSwicHJvZmlsZSI6Imh0dHBzOlwvXC9zdGFnaW5nLmFjZXNzby5nb3YuYnIiLCJraWQiOiJyc2ExIiwiaXNzIjoiaHR0cHM6XC9cL3Nzby5zdGFnaW5nLmFjZXNzby5nb3YuYnJcLyIsInBob25lX251bWJlcl92ZXJpZmllZCI6InRydWUiLCJub25jZSI6IjdjZjYyYTNlNmJlNzVjMzgyMjM3M2Q4MTk5MzBiNjVjIiwicGljdHVyZSI6Imh0dHBzOlwvXC9zc28uc3RhZ2luZy5hY2Vzc28uZ292LmJyXC91c2VyaW5mb1wvcGljdHVyZSIsImF1ZCI6InNpbi5zdWRhbS5nb3YuYnIiLCJhdXRoX3RpbWUiOjE2MDA3OTc0NzAsInNjb3BlIjpbImVtYWlsIiwib3BlbmlkIiwicGhvbmUiLCJwcm9maWxlIl0sIm5hbWUiOiJKb8OjbyBUb23DqSBQaW50byBkZSBTb3V6YSBQYWxoYXJlcyIsInBob25lX251bWJlciI6IjMxOTk2NDU1OTcxIiwiZXhwIjoxNjAwODAwMDg2LCJpYXQiOjE2MDA3OTk0ODYsImp0aSI6ImYzNWVjZjU5LTUxZDUtNDEwNi1iYmUyLTUwOGU1NzQzNmExOSIsImVtYWlsIjoibGF2b2lzaWVyLnZpZWlyYUBzZXJwcm8uZ292LmJyIn0.sGebuO5_YkRGWy1GOM8gDfRpVWIn7eJh5SNN7KZH2N5rbPgpPnw5fGc2V3L-Ty3dyUN_9RgEJ3AJU0r9EAgRqOv7iEJrOc2fPqn2Eu5zyDKumBZ7tBGJRAmfzaYgo5ppMfTKoV1v9y8_Fl53oGspPT8WR2qUjVdZDR6c0--w4oQo4mTGpUAdeRzdwtitpbFAGNmEHfFZmZBhbwrh523uyCvtziuok5Lk4HAcVp-Wgcj9v-GoO7ChaUUX8EAycaEiMYMNyaiE27ZTJtWdKnk1-3mYORV16Y5MC2ObQbyYzfH5XDHuIQ6Iq6TagZxsTITI8JasEDhRlp_0ado_ntNDcQ';
//echo "<pre>"; print_r($jsonKeys);exit;
$dados = processToClaims($tk_id, $jsonKeys);

var_dump($dados);


function processToClaims($access_token, $jwk)
{
    $modulus = JWT::urlsafeB64Decode($jwk['keys'][0]['n']);
    $publicExponent = JWT::urlsafeB64Decode($jwk['keys'][0]['e']);
    $components = array(
        'modulus' => pack('Ca*a*', 2, encodeLength(strlen($modulus)), $modulus),
        'publicExponent' => pack('Ca*a*', 2, encodeLength(strlen($publicExponent)), $publicExponent)
    );
    $RSAPublicKey = pack(
        'Ca*a*a*',
        48,
        encodeLength(strlen($components['modulus']) + strlen($components['publicExponent'])),
        $components['modulus'],
        $components['publicExponent']
    );
    $rsaOID = pack('H*', '300d06092a864886f70d0101010500'); // hex version of MA0GCSqGSIb3DQEBAQUA
    $RSAPublicKey = chr(0) . $RSAPublicKey;
    $RSAPublicKey = chr(3) . encodeLength(strlen($RSAPublicKey)) . $RSAPublicKey;
    $RSAPublicKey = pack(
        'Ca*a*',
        48,
        encodeLength(strlen($rsaOID . $RSAPublicKey)),
        $rsaOID . $RSAPublicKey
    );
    $RSAPublicKey = "-----BEGIN PUBLIC KEY-----\r\n" . chunk_split(base64_encode($RSAPublicKey), 64) . '-----END PUBLIC KEY-----';

    JWT::$leeway = 3 * 60; //em segundos

    $decoded = JWT::decode($access_token, $RSAPublicKey, array('RS256'));

    return (array) $decoded;
}

function encodeLength($length)
{
    if ($length <= 0x7F) {
        return chr($length);
    }
    $temp = ltrim(pack('N', $length), chr(0));
    return pack('Ca*', 0x80 | strlen($temp), $temp);
}
