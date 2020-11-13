<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 01/10/2018
 * Time: 15:05
 */

require_once "../classes/class.Controle.php";

$oControle = new Controle();

$resp = [
    "success" => false
];

if(!empty($_GET["idResponsaveis"])){
    $oResponsaveis = $oControle->getRowResponsaveis([
        "idResponsaveis = '{$_GET["idResponsaveis"]}'",
        "situacao <> -1"
    ]);

    if($oResponsaveis instanceof Responsaveis){
        $resp = [
            "success" => true,
            "data" => $oResponsaveis
        ];
    }
}

echo json_encode($resp, JSON_UNESCAPED_UNICODE);