<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 19/09/2017
 * Time: 13:09
 */
require_once("classes/class.Controle.php");

$_SESSION['recuperarSenha'] = '1';

$oControle = new Controle();

$email = $_REQUEST['email'];

$perfil = $_REQUEST["perfil"];

$cnpj = Util::limpaCPF_CNPJ($_REQUEST['cnpj']);

$validarCNPJ = Util::validaCNPJ($cnpj);


if($perfil == "e"){
    if($email){
        $checaEmail = $oControle->infoAutenticacaoByEmailCnpj($email,$cnpj);
    }

    if($checaEmail) {
        $senha = Util::geraSenha(8, true, true, true);

        if($oControle->enviaEmailRecuperarSenha($cnpj, $senha)){

            $autenticacaoEmpresaBD = new AutenticacaoempresaBD();

            $autenticacaoEmpresaBD->alteraSenhaEmpresa($checaEmail->email, $senha, $checaEmail->cnpj);

            echo "0";
        } else
            echo "1";

    }else{
        if(!$validarCNPJ){
            echo 2;
        }else{
            echo 1;
        }

    }
}

if($perfil == "r"){

    $responsaveisBD = new ResponsaveisBD();

    $checkResponsavel = $oControle->getRowResponsaveis(["email = '{$email}'", "situacao = 1"]);

    if($checkResponsavel instanceof Responsaveis){
        $senha = Util::geraSenha(8, true, true, true);

        if($oControle->enviaEmailRecuperarSenhaResponsavel($checkResponsavel->cpf_passaporte, $senha)){
            $checkResponsavel->senha = md5($senha);

            $responsaveisBD->alterar($checkResponsavel);

            echo "0";
        } else
            echo "1";
    } else {
        echo 1;
    }
}

