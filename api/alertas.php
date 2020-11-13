<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 21/10/2019
 * Time: 15:02
 */

require_once "../classes/class.Controle.php";

set_time_limit(0);

$oControle = new Controle();

$resp = [
    "success" => false
];

$type = $_SERVER["REQUEST_METHOD"];

$alertaBD = new AlertaBD();

$validator = new ValidadorFormulario();

$params = [];

parse_str(file_get_contents('php://input'), $params);

switch ($type){
    case 'GET':

        if(!empty($_GET["idCampanha"])){
            $resp = [
                "success" => true,
                "data" => $oControle->customGetAllAlerta(["campanha.idCampanha = {$_GET["idCampanha"]}"])
            ];
        }

        break;
    case 'GET_EMPRESAS':
        if(!empty($params["idAlerta"])){

            $voEmpresas = $oControle->customGetAllEmpresaalerta(["alerta.idAlerta = {$params["idAlerta"]}"]);

            foreach ($voEmpresas as $k => $oEmp){
                $voEmpresas[$k]->cnpj = Util::formataCNPJ($oEmp->cnpj);
            }

            $resp = [
                "success" => true,
                "data" => $voEmpresas
            ];
        }

        break;
    case 'SEND_ALERT':
        $post = $params;

        if(is_numeric($post["sleep"]) && $post["sleep"] > 0)
            sleep($post["sleep"]);

        if($validator->validaFormularioEnvioAlerta($post)){

            $oAlerta = !empty($post["idAlerta"]) ? $oControle->getAlerta($post["idAlerta"]) : new Alerta();

            $oCampanha = $oControle->getCampanha($post{"idCampanha"});

            if($oAlerta->situacao != "2"){

                $post["oCampanha"] = $oCampanha;

                $post["usuarioAlteracao"] = $_SESSION["usuarioAtual"]["login"];

                $post["dataHoraAlteracao"] = date("Y-m-d H:i:s");

                $post["totalEmpresas"] = "0";

                $post["situacao"] = "2";

                $oAlerta = Util::populate($oAlerta, $post);

                //necessário para q não sejam removidas as tags HTML
                $oAlerta->texto = $post["texto"];

                if(!empty($oAlerta->idAlerta))
                    $alertaBD->alterar($oAlerta);
                else
                    $oAlerta->idAlerta = $alertaBD->inserir($oAlerta);
            }

            if($oCampanha->situacao != "2"){
                $oControle->updateSituacaoCampanha($oCampanha->idCampanha, '2');
            }

            if($oControle->enviaEmailAlerta($oAlerta, $post["cnpj"])){
                $resp = [
                    "success" => true,
                    "msg" => 'Operação realizada com sucesso!',
                    "data" => $oAlerta
                ];
            } else {
                $resp["msg"] = $oControle->msg;

                $resp["data"] = $oAlerta;
            }



        } else {
            $resp["msg"] = $validator->msg;
        }

        break;

}

echo json_encode($resp, JSON_UNESCAPED_UNICODE);