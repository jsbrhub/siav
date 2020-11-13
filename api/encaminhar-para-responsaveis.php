<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 17/10/2018
 * Time: 13:06
 */

require_once "../classes/class.Controle.php";

$oControle = new Controle();

$r = [
    "success" => true,
    "msg" => ""
];

$voEmpresaCampanhaResposnaveis = $oControle->getAllEmpresaCampanhaResponsaveis([
    "empresacampanha.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'",
    "empresa_campanha_responsaveis.situacao in (0,1)",
    "empresa_campanha_responsaveis.idCampanha = '{$_REQUEST["idCampanha"]}'"
]);



if(is_array($voEmpresaCampanhaResposnaveis)){
    foreach ($voEmpresaCampanhaResposnaveis as $oEmpresaCampanhaResposnaveis){
        $responsaveis[$oEmpresaCampanhaResposnaveis->situacao][] = $oEmpresaCampanhaResposnaveis;
    }

    if(is_array($responsaveis[0])){
        $empresaCampanhaResponsaveisBD = new EmpresaCampanhaResponsaveisBD();

        foreach ($responsaveis[0] as $oEmpCampResp){
            //informando que existe um documento atribuído a ele no sistema e que deve ser assinado

            $oEmpCampResp->situacao = "1";

            $empresaCampanhaResponsaveisBD->alterar($oEmpCampResp);

            $oControle->enviaEmailResponsavelAssinatura($oEmpCampResp->oResponsaveis, $oEmpCampResp->oEmpresacampanha->cnpj);

        }

        $r["msg"] = "Documento enviado para responsáveis pelas informações.";


    } else {
        $r = [
            "success" =>  false,
            "msg" => "o documento já foi enviado para avaliação dos responsáveis"
        ];
    }


} else {
    $r = [
        "success" => false,
        "msg" => "Nenhum responsavei foi adicionado a esta campanha"
    ];
}


echo json_encode($r, JSON_UNESCAPED_UNICODE);

