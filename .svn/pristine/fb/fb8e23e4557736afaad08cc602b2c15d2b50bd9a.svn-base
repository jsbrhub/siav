<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 26/09/2017
 * Time: 10:14
 */

require_once("classes/class.Controle.php");
$oControle = new Controle();

$listaCnpj = $oControle->retornaEmpresasGroupByCnpj();

Util::trace(count($listaCnpj),false);

if($listaCnpj){
    foreach ($listaCnpj as $empresa){
        Util::trace($empresa->cnpj,false);
        $oControle->insereUsuarioEmpresa($empresa->cnpj,"email@email.com");

    }
}