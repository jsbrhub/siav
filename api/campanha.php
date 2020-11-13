<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 23/10/2019
 * Time: 15:13
 */

require_once "../classes/class.Controle.php";

$oControle = new Controle();

$resp = [
    "success" => false
];

$type = $_SERVER["REQUEST_METHOD"];


switch ($type){
    case 'GET':


        break;
    case 'GET_EMPRESAS':
        $params = [];

        parse_str(file_get_contents('php://input'), $params);

        if(!empty($params["idCampanha"])){

            $filter = "SELECT cnpj FROM empresacampanha WHERE empresacampanha.idCampanha = {$params["idCampanha"]}";

            if(!empty($params["status"]) && $params["status"] != "todas" ){
                $filter .= " AND empresacampanha.status IN ('{$params["status"]}')";
            }

            $voEmpresas = $oControle->getAllAutenticacaoempresa(["cnpj IN ({$filter})"]);

            foreach ($voEmpresas as $oEmpresa){
                unset($oEmpresa->senha);

                unset($oEmpresa->senhaProv);
            }

            $resp = [
                "success" => true,
                "data" => $voEmpresas
            ];
        } else {
            $resp["success"] = "campanha deve ser informada!";
        }

        break;

}

echo json_encode($resp, JSON_UNESCAPED_UNICODE);