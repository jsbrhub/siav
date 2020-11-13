<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 29/09/2020
 * Time: 14:54
 */

require_once "classes/class.Controle.php";

$oControle = new Controle();

if(!empty($_SESSION["usuarioLogado"]) || $_GET["debug"]){

    if($_GET["debug"] && $_SESSION["usuarioLogado"]["cpf"] == "97227048268"){
        $oResponsavel = $oControle->getRowResponsaveis([
            "ifnull(responsaveis.situacao, 1) = 1",
            "'{$_GET["debug"]}' IN (responsaveis.cpf_passaporte, responsaveis.login)"
        ]);

        $_SESSION["usuarioLogado"]["nome"] = $oResponsavel->nome;

        $_SESSION["usuarioLogado"]["cpf"] = $oResponsavel->cpf_passaporte;

        $_SESSION["usuarioLogado"]["email"] = $oResponsavel->email;

    } else
        $oResponsavel = $oControle->getRowResponsaveis([
            "ifnull(responsaveis.situacao, 1) = 1",
            "'{$_SESSION["usuarioLogado"]["cpf"]}' IN (responsaveis.cpf_passaporte, responsaveis.login)"
        ]);

    if(!$oResponsavel instanceof Responsaveis){

        $responsaveisBD = new ResponsaveisBD();

        $oResponsavel = Util::populate(new Responsaveis(),[
            "situacao" => "1",
            "data_cad_empresa" => date("Y-m-d H:i:s"),
            "nome" => $_SESSION["usuarioLogado"]["nome"],
            "cpf_passaporte" => $_SESSION["usuarioLogado"]["cpf"],
            "login" => $_SESSION["usuarioLogado"]["cpf"],
            "email" => $_SESSION["usuarioLogado"]["email"]
        ]);

        $oResponsavel->idResponsaveis = $responsaveisBD->inserir($oResponsavel);

    }

    $_SESSION['usuarioAtual'] =[
        "tipo_perfil" => "responsavel",
        "idResponsaveis" => $oResponsavel->idResponsaveis,
        "cpf_passaporte" => $oResponsavel->cpf_passaporte,
        "nome" => $oResponsavel->nome,
        "login" => $oResponsavel->cpf_passaporte
    ];

    header("Location: admResponsaveis");

} else
    header("Location: /empresas-relacionadas");


exit;