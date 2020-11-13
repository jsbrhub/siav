<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 02/10/2017
 * Time: 09:25
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();

if(isset($_REQUEST['cnpj'])){
    $empresas = $oControle->getEmpresasVigentesByCnpj($_REQUEST['cnpj']);
    if($empresas) {
        foreach ($empresas as $empresa) {
            $formatCnpj = Util::formataCNPJ($empresa->cnpj);
            $cnpj = $empresa->cnpj;
            $idEmpresa = $empresa->idEmpresa;
            $cnpj = str_pad($empresa->cnpj, 14, "0", STR_PAD_LEFT);
            echo '<li onClick="selecionaCNPJ('.$idEmpresa.',' . $cnpj . ',\'' . $formatCnpj . '\',\'' . $empresa->razaoSocial . '\')">' . Util::formataCNPJ($empresa->cnpj) . ' - ' . ($empresa->razaoSocial) . '</li>';
        }
        exit;
    }
}

