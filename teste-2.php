<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 09/10/2019
 * Time: 17:11
 */
require_once "classes/class.Controle.php";


$oControle = new Controle();

$oEmpresas = $oControle->getAllEmpresacontrole(["campanha.idCampanha = 14", "empresacontrole.status = 2"], ["dataConclusao asc"]);

foreach ($oEmpresas as $k => $empresa){
    $documentos = $oControle->getAllArquivoempresa(["empresa.idEmpresa = {$empresa->oEmpresa->idEmpresa}"]);

    $vazio = 0;

    foreach ($documentos as $doc){
        if(!file_exists("files/{$doc->novoNome}"))
            $vazio = 1;
    }


    if($vazio == 1)
        echo ($k+1)." - {$empresa->cnpj} -  ".Util::formataCNPJ($empresa->cnpj)." <br />";
}

