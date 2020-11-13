<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 20/09/2017
 * Time: 15:30
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();

$cnpj = $_SESSION['usuarioAtual']['cnpj'];
$senhaAtual = $_REQUEST['senha'];
$novaSenha = $_REQUEST['novaSenha'];
$confirmaSenha = $_REQUEST['confirmaSenha'];
$infoempresa = $oControle->infoAutenticacao($cnpj);
if(md5($senhaAtual) == $infoempresa->senha){
    $oControle->trocaSenhaEmpresa($cnpj,$senhaAtual,$novaSenha);
    echo 0;
}else{
    echo 1;
}



