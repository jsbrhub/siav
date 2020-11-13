<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 21/09/2017
 * Time: 13:45
 */

require_once("classes/class.Controle.php");

if(!($oControle instanceof Controle))
    $oControle = new Controle();

$nome = $_SESSION['usuarioAtual']['nome'];

if(!$nome){
    $cnpj = $_SESSION['usuarioAtual']['login'];
    $infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj) ;
    $nome = $infoEmpresa->razaoSocial;
}


if(!$nome)
    $nome = $_SESSION["usuarioLogado"]["nome"];
?>
<div class="nav-top">
    <div class="top-content">
        <div>
            <img src="img/SUDAMd.png" height="40">
        </div>
        <div class="hidden-xs nav-top-logo">
            <strong><i>SIAV - Sistema de Avaliação</i></strong><br><i><span class="text-muted" style="font-size: 12px">Incentivos Fiscais</span>
            </i>
        </div>
        <div>
            <ul class="nav navbar-nav navbar-right nav-bt-user">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn-user" data-toggle="dropdown" role="button"><i
                                class="glyphicon glyphicon-user"></i> <?= $nome ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <?php if ($_SESSION['usuarioAtual']['nome']) { ?>
                            <li><a href="principal"><i class="glyphicon glyphicon-th-large"></i> Alterar Módulo</a></li>
                        <?php } ?>
                        <?php if(!empty($_SESSION['usuarioAtual']['cnpj'])) { ?>
                            <li><a onclick="trocaSenha();" style="cursor: pointer"><i class="glyphicon glyphicon-lock"></i> Trocar Senha </a></li>
                        <?php } ?>
                        <?php if(!empty($_SESSION["usuarioLogado"])): ?>
                            <li><a href="loga-responsavel"><i class="glyphicon glyphicon-star-empty"></i> Suas Assinaturas e Documentos</a></li>
                            <li><a href="empresas-relacionadas"><i class="glyphicon glyphicon-briefcase"></i> Empresas Relacionadas</a></li>
                        <?php endif; ?>
                        <li class="divider"></li>
                        <li><a href="logoff"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>