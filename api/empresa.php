<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 17/10/2019
 * Time: 10:11
 */

require_once "../classes/class.Controle.php";

$oControle = new Controle();

$resp = [
    "success" => false
];

$type = $_SERVER["REQUEST_METHOD"];


switch ($type){
    case 'UPDATE_EMAIL':

        $params = [];

        parse_str(file_get_contents('php://input'), $params);

        $oValidator = new ValidadorFormulario();

        if($oValidator->validaFormularioCadastroUpdateEmail($params)){
            $autenticaoEmpresaBD = new AutenticacaoempresaBD();

            $oEmpresa = $oControle->getRowAutenticacaoempresa(["cnpj = '{$params["cnpj"]}'"]);

            $email_antigo = $oEmpresa->email;

            if($oEmpresa instanceof Autenticacaoempresa){

                $oEmpresa->email = $params["email"];

                if($autenticaoEmpresaBD->alterar($oEmpresa)){
                    //cadastrar o historico de alteracao
                    $oControle->cadastraHistoricoEdicaoEmail([ "email_antigo" => $email_antigo, "email_novo" => $params["email"], "cnpj" => $params["cnpj"] ]);

                    $resp = [
                        "success" => true,
                        "data" => $oEmpresa,
                        "msg" => "Email Alterado com sucesso!"
                    ];
                } else {
                    $resp["msg"] = $autenticaoEmpresaBD->msg;
                }

            } else {
                $resp["msg"] = "Nenhuma informação encontrada do CNPJ informado!";
            }

        } else {
            $resp["msg"] = $oValidator->msg;
        }
    break;
}

echo json_encode($resp, JSON_UNESCAPED_UNICODE);