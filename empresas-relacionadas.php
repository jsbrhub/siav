<?php

    require_once "classes/class.Controle.php";

    require_once "classes/class.LoginUnico.php";

    $oControle = new Controle();

    if(empty($_SESSION["usuarioLogado"]))
        header("Location: logoff");

    unset($_SESSION["usuarioAtual"]);

?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
</head>
<style>
    .cnpj-e{
        box-shadow: 1px 1px 1px 2px;
        cursor: pointer;
    }
</style>
<body>
<?php
require_once("includes/modals.php");

include("includes/topo.php");

$voResponsveisEmpresa = $oControle->getAllResponsaveisEmpresa(["REPLACE(REPLACE(responsaveis.cpf_passaporte, '-', ''), '.', '') = '{$_SESSION['usuarioLogado']['cpf']}'"]);

$voEmpresasGerenciamento = LoginUnico::requestEmpresas($_SESSION["usuarioLogado"]["cpf"]);

?>
<div class="container">

    <div class="alert alert-success">
        com dificuldade para assinar documentos, baixe o manual <b><a href="docs/Login Único Assinatura SIAV.pdf" target="_blank" download >clicando aqui</a></b> e veja como proceder
        <a style="margin-top: -5px;" href="loga-responsavel" class="right btn btn-primary btn-sm">Suas assinaturas de Documentos</a>
    </div>

    <? if(is_array($voEmpresasGerenciamento) && !isset($voEmpresasGerenciamento["errors"]) && count($voEmpresasGerenciamento)): ?>
        <div class="panel panel-default">
            <div class="panel-heading">Gestão de acesso de usuários</div>
            <div class="panel-body">
                <ul class="list-group">
                    <? foreach ($voEmpresasGerenciamento as $emp): ?>

                        <li class="list-group-item">
                            <h4 class="list-group-item-heading font-13"><?= Util::formataCNPJ($emp["cnpj"]); ?></h4>
                            <p class="list-group-item-text">
                                <i><?= $emp["razaoSocial"]; ?></i>
                                <button style="margin-top: -15px;" class="btn btn-small right">
                                    <a  href="add-responsaveis-empresa?cnpj=<?= $emp["cnpj"]; ?>" class="glyphicon glyphicon-cog "></a>
                                </button>
                            </p>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
        </div>
    <? endif; ?>

    <div class="panel panel-default">
        <div class="panel-heading">Empresas vinculadas a você</div>
        <div class="panel-body">
            <div class="list-group">
                <?php if(!is_array($voResponsveisEmpresa)) : ?>
                    <div class="alert alert-warning"><strong>Aviso!</strong> Nenhuma empresa vinculada ao seu usuário</div>
                <?php else: ?>
                    <div class="alert alert-warning"><strong>Atenção!</strong> Selecione uma das empresas a seguir para acessar o painel de empresa</div>
                    <?php foreach ($voResponsveisEmpresa as $oE) : ?>
                        <?php $oEmpresa = $oControle->getRowEmpresa(["empresa.cnpj = '{$oE->cnpj}'"]); ?>
                        <a href="loga-empresa-relacionada?cnpj=<?= $oE->cnpj; ?>">
                            <div class="alert alert-info mt-10 cnpj-e">
                                <?= $oEmpresa->razaoSocial; ?>
                                <br />
                                <?= Util::formataCNPJ($oE->cnpj); ?>
                            </div>
                        </a>
                    <? endforeach; ?>
                <? endif; ?>
            </div>
        </div>
    </div>
</div>
<?php require_once("includes/footer.php"); ?>
</body>
</html>