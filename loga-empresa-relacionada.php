<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 29/09/2020
 * Time: 14:54
 */

require_once "classes/class.Controle.php";

$oControle = new Controle();

if(!empty($_REQUEST["cnpj"])){
    $oEmpresa = $oControle->getRowAutenticacaoempresa(["cnpj = '{$_REQUEST['cnpj']}'"]);

    if($oEmpresa instanceof Autenticacaoempresa){
        $_SESSION['usuarioAtual']['login'] = $oEmpresa->cnpj;
        $_SESSION['usuarioAtual']['cnpj'] = $oEmpresa->cnpj;
        $_SESSION['usuarioAtual']['email'] = $oEmpresa->email;

        header("Location: /principal");
    } else {
        header("Location: /empresas-relacionadas");
    }
} else
    header("Location: /empresas-relacionadas");


exit;