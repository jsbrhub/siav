<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 30/10/2017
 * Time: 16:45
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();
$listaCampanhas = $oControle->listaCampanhasAtivas();
$listaRetificacoes = $oControle->listaRetificacoesAprovadaComMais15Dias();
if($listaCampanhas){
    foreach ($listaCampanhas as $campanha){
        $dataFim = $campanha->dataFim;
        $dataInicio = $campanha->dataInicio;
        $dataAtual = date("Y-m-d");
        if(strtotime($dataFim) < strtotime($dataAtual)){ //verifica se existem campanhas que já expiraram, se tiver... atualiza o status da campanha
            $oControle->updateSituacaoCampanha($campanha->idCampanha,4);
            $listaEmpresaCampanha = $oControle->getTodasEmpresasCampanha($campanha->idCampanha);
            if($listaEmpresaCampanha){
                foreach ($listaEmpresaCampanha as $empCamp){
                    if($empCamp->status == '1' || $empCamp->status == '2'){
                        $oControle->updateStatusEmpresaCampanha($campanha->idCampanha,$empCamp->cnpj,'4'); //atualiza o status das empresas que não
                        // concluiram o cadastro para "expirado"
                    }
                }
            }
        }

    }
}
if($listaRetificacoes){
    foreach ($listaEmpresaCampanha as $retificacao){
        $oControle->updateStatusRet($retificacao->idRetEmpresa,'0'); //expirado
        $oControle->updateStatusHistoricoByRetEmpresa($retificacao->idRetEmpresa,'3'); //expirado
    }
}
