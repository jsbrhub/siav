<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 10/03/2020
 * Time: 10:43
 */

require_once "classes/class.Controle.php";

$oControle = new Controle(false);

$voEmpresas = $oControle->getEmpresasCSV();

$csvFile = [[
    "NR",
    "Razão Social",
    "CNPJ",
    "Fone",
    "Fax",
    "FonteOrigem",
    "Municipio",
    "UF",
    "Email"
]];

foreach ($voEmpresas as $k => $oEmpresa){

    //dados empresa
    $row = [
        $k+1,
        $oEmpresa->razaoSocial,
        "'".$oEmpresa->cnpj,
        $oEmpresa->telefone,
        $oEmpresa->fax,
        $oEmpresa->fonteOrigem,
        $oEmpresa->oMunicipio->municipio,
        $oEmpresa->oMunicipio->uf,
        $oEmpresa->email
    ];

    $csvFile[] = $row;
}

$filename = 'relatorio-siav-'.date("d-m-Y");

$filepath =  $filename.'.csv';

$fp = fopen($filepath, 'w+');

foreach ($csvFile as $linha) {
    foreach ($linha as $k => $coluna){
        $linha[$k] = utf8_decode($coluna);
    }

    fputcsv($fp,$linha,";");
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
header('Content-Length: ' . filesize($filepath));

echo readfile($filepath);

fclose($fp);
