<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();


$incentivos = $oControle->getAllIncentivoempresa();

foreach ($incentivos as $incentivo):
    $idIncentivoEmpresa = $incentivo->idIncentivoEmpresa;
    $idEmpresa = $incentivo->oEmpresa->idEmpresa;
    $oEmpresa = $oControle->getEmpresa($idEmpresa);
    $idModalidade = $oEmpresa->oModalidade->idModalidade;
    $idIncentivo = $oEmpresa->oIncentivos->idIncentivo;

    $oControle->updateModalidadeIncentivo($idIncentivoEmpresa,$idModalidade,$idIncentivo);




endforeach;