<?php
require_once("classes/class.Controle.php");

if(isset($_GET["token"])){

    $oControle = new Controle(false);

    $oEmpresa = $oControle->getRowAutenticacaoempresa(["md5(concat(cnpj,'-',idAutenticacao)) = '{$_GET["token"]}'"]);

    if($oEmpresa instanceof Autenticacaoempresa && !empty($oEmpresa->senhaProv)){
        if(empty($_SESSION["usuarioAtual"])){
            $_SESSION["usuarioAtual"]["email"] = $oEmpresa->email;

            $_SESSION["usuarioAtual"]["cnpj"]  = $oEmpresa->cnpj;

            $_SESSION["usuarioAtual"]["login"] = $oEmpresa->cnpj;
        }

        $popupSenha = true;

    } else {
        exit("Token expirado!!");
    }
} else {
    $oControle = new Controle();
}

if($_SESSION['usuarioAtual']["tipo_perfil"] == "responsavel"){
    session_destroy();

    header("Location: /");
}


$nome = $_SESSION['usuarioAtual']['nome'];

$cnpj = $_SESSION['usuarioAtual']['cnpj'];


$infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj);

if (!$nome) {
    $nome = $infoEmpresa->razaoSocial;
}

$listaCampanhasAtivas = $oControle->retornaCampanhasAtivas();

if ($listaCampanhasAtivas) $contAtivas = count($listaCampanhasAtivas); else $contAtivas = '0';

$novasRetificacoes = $oControle->retornaRetificacoesByStatus('1');

if ($novasRetificacoes) $contRet = count($novasRetificacoes); else $contRet = '0';

$listaCampanhasExp15dias = $oControle->retornaCampanhasAtivasExp15Dias();

if ($listaCampanhasExp15dias) $cont15Dias = count($listaCampanhasExp15dias); else $cont15Dias = '0';

$listaCampanhasEmpresa = $oControle->retornaCampanhasAtivasEmpresaLogada($cnpj);

$listaCampanhasEmpresaCadastroConcluido = $oControle->retornaCampanhasAtivasEmpresaLogadaConcluido($cnpj);

//Util::trace($listaCampanhasEmpresaCadastroConcluido);
$listaRetificacoes = $oControle->listaRetificacoesAprovadasRetificadas($cnpj);
//Util::trace($listaRetificacoes);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
    <script src="js/dadosEmpresa.js"></script>
    <script>
        $('input[required]').on('invalid', function () {
            this.setCustomValidity($(this).data("required-message"));
        });
        <?php if($popupSenha === true):  ?>
            $(document).ready(function(){
                $("#modal-nova-senha-campanha").modal("show");

                $("#alterar-senha-primeiro-acesso").submit(function(e){
                    e.preventDefault();

                    var $this = $(this);

                    $(".alert", $this).addClass("hidden");

                    if($this[0].reportValidity()){
                        if($("#p-senha").val() == $("#conf-p-senha").val()){
                            $.post("altera-senha-primeiro-acesso", $this.serialize(), function(r){

                                var alertClass = (r.success) ? 'alert-success' : 'alert-danger';

                                $(".container .alert").removeClass('hidden').addClass(alertClass).html(r.msg);

                                $("#modal-nova-senha-campanha").modal("hide");

                            }, "json")
                        } else {
                            $(".alert", $this).removeClass("hidden");
                        }
                    }
                });
            });
        <?php endif; ?>
    </script>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");
?>
<div class="container">
    <div class="alert hidden"></div>
    <?php require_once("includes/menu.php"); ?>
    <?php if(!empty($_SESSION['usuarioAtual']['nome'])){ ?>
    <div class="border-radius bg-grey font-12  p-20 " id="notificacoes">
        <div class="col-md-6 ">
            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="admCampanha">Você tem <?= $cont15Dias ?> campanha(s) ativa(s) que expira(m) em
                        menos de 15 dias. </a></li>
            </ul>
            <ul class="list-group">
                <li class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="admCampanha">Você tem <?= $contAtivas ?> campanha(s) ativa(s) no momento.
                    </a></li>
            </ul>
            <ul class="list-group mb-0">
                <li class="list-group-item list-group-item-info">
                    <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="admRetificacaosudam">Você tem <?= $contRet ?> nova(s) retificação(ões)
                        solicitada(s)
                        .</a></li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    <?php } ?>
    <div class="panel-group" id="accordion">
        <div class="border-radius bg-grey font-12  p-20 <?= ($cnpj != '') ? '' : 'no-display' ?>" id="notifEmpresa">
            <div class="col-md-12">
                <?php
                if ($listaCampanhasEmpresa) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title font-12 grey">
                                <a data-toggle="collapse" data-parent="#accordion" href="#listaCampanhas"
                                   style="text-decoration: none">
                                    <i class="glyphicon glyphicon-asterisk"></i> &nbsp;&nbsp;Você possui atualizações
                                    cadastrais pendentes. Clique para mais detalhes.</a>
                            </h4>
                        </div>

                        <div id="listaCampanhas" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php

                                foreach ($listaCampanhasEmpresa as $campanha) {
                                    $termoResponsabilidade = $oControle->verificaTermoResponsabilidade($cnpj,
                                        $campanha->oCampanha->idCampanha);
                                    if ($termoResponsabilidade) {
                                        $statusTermo = '1';
                                    } else {
                                        $statusTermo = '0';
                                    }

                                    $status = $campanha->status;
                                    switch ($status) {
                                        case 1:
                                            $descStatus = "Pendente";
                                            $tipoLabel = "warning";
                                            break;
                                        case 2:
                                            $descStatus = "Iniciado";
                                            $tipoLabel = "info";
                                            break;
                                        case 3:
                                            $descStatus = "Concluído";
                                            $tipoLabel = "success";
                                            break;
                                        case 4:
                                            $descStatus = "Expirado";
                                            $tipoLabel = "alert";
                                            break;
                                    }
                                    ?>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-info">
                                            <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style="text-decoration: none" class="pointer"
                                               onclick="termoResponsabilidade(<?= $statusTermo ?>,
                                               <?= $campanha->oCampanha->idCampanha ?>);"><strong>
                                                    <?= $campanha->oCampanha->campanha ?> - Ano
                                                    Base: <?= $campanha->oCampanha->anoBase ?> - Disponível:
                                                    <?= Util::formataDataBancoForm($campanha->oCampanha->dataInicio) ?>
                                                    a <?= Util::formataDataBancoForm
                                                    ($campanha->oCampanha->dataFim) ?>
                                                </strong> </a>
                                            <span class="label label-<?= $tipoLabel ?> pull-right"><?= $descStatus ?></span>
                                        </li>
                                    </ul>
                                <?php }
                                ?>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="clear"></div>
        </div>
        <?php
        if ($listaRetificacoes) {
            ?>
            <div class="border-radius bg-grey font-12  p-20 <?= ($cnpj != '') ? '' : 'no-display' ?>">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title font-12 grey">
                                <a data-toggle="collapse" data-parent="#accordion" href="#retificacoesAprovadas"
                                   style="text-decoration: none">
                                    <i class="glyphicon glyphicon-asterisk"></i> &nbsp;&nbsp;Lista de Retificações</a>
                            </h4>
                        </div>
                        <div id="retificacoesAprovadas" class="panel-collapse collapse">
                            <div class="panel-body">

                                <?php
                                foreach ($listaRetificacoes as $ret) {


                                    $idRetEmpresa = $ret->oRetificacaoempresa->idRetEmpresa;
                                    $verificaHistorico = $oControle->retornaHistoricoRetificacaoByRetEmpresa($idRetEmpresa);

                                    $dataHist = new DateTime($verificaHistorico->dataHoraAlteracao);

                                    $dataExp = Util::somar_dias_uteis($dataHist->format("d/m/Y"), 15);

                                    $statusHist = $verificaHistorico->status;
                                    list($d, $m, $a) = explode("/", $dataExp);
                                    $dataExpT = $a . '-' . $m . '-' . $d;
                                    $dataAtual = date("Y-m-d");

                                    switch ($statusHist) {
                                        case '1':
                                            $descStatusHist = "Pendente";
                                            $tipoLabelHist = "warning";
                                            break;
                                        case '2':
                                            $descStatusHist = "Retificado";
                                            $tipoLabelHist = "success";
                                            break;
                                        case '3':
                                            $descStatusHist = "Expirado";
                                            $tipoLabelHist = "warning";
                                            break;

                                    }
                                    if (strtotime($dataExpT) == strtotime($dataAtual) || strtotime($dataExpT) < strtotime($dataAtual)) {
                                        $link = 'Retificação Dados Aprovada - Ano Base: ' . $listaRetificacoesAprovadas->oRetificacaoempresa->anoBase . ' - Expira em: ' . ($dataExp);
                                        if ($statusHist != '2') {
                                            $descStatusHist = "Expirado";
                                            $tipoLabelHist = "danger";
                                        }
                                    } else {
                                        $link = '<a  class="pointer"  style="text-decoration: none" href="empresaCad.php?idHistRet=' . $verificaHistorico->idHistRet . '">Retificação Dados Aprovada - Ano Base: ' . $listaRetificacoesAprovadas->oRetificacaoempresa->anoBase . ' - Expira em: ' . Util::formataDataBancoForm($dataExp) . ' </a>';
                                    }


                                    ?>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-info">
                                    <span class="glyphicon glyphicon-hand-right">
                                    </span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <strong><?= $link ?></strong>
                                            <span class="label label-<?= $tipoLabelHist ?> pull-right"><?= $descStatusHist ?></span>
                                        </li>
                                    </ul>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <?php
        }
        ?>

        <div class="border-radius bg-grey font-12  p-20 <?= ($cnpj != '') ? '' : 'no-display' ?>">
            <div class="col-md-12">
                <?php
                if ($listaCampanhasEmpresaCadastroConcluido) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title font-12 grey">
                                <a data-toggle="collapse" data-parent="#accordion" href="#listaCadastroConcluido"
                                   style="text-decoration: none">
                                    <i class="glyphicon glyphicon-asterisk"></i> &nbsp;Cadastros Concuídos</a>
                            </h4>
                        </div>

                        <div id="listaCadastroConcluido" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php

                                foreach ($listaCampanhasEmpresaCadastroConcluido as $campanha) {
                                    $termoResponsabilidade = $oControle->verificaTermoResponsabilidade($cnpj,
                                        $campanha->oCampanha->idCampanha);
                                    if ($termoResponsabilidade) {
                                        $statusTermo = '1';
                                    } else {
                                        $statusTermo = '0';
                                    }

                                    $status = $campanha->status;
                                    switch ($status) {
                                        case 1:
                                            $descStatus = "Pendente";
                                            $tipoLabel = "warning";
                                            break;
                                        case 2:
                                            $descStatus = "Iniciado";
                                            $tipoLabel = "info";
                                            break;
                                        case 3:
                                            $descStatus = "Concluído";
                                            $tipoLabel = "success";
                                            break;
                                        case 4:
                                            $descStatus = "Expirado";
                                            $tipoLabel = "alert";
                                            break;
                                    }
                                    ?>
                                    <ul class="list-group">
                                        <li class="list-group-item list-group-item-info">
                                            <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style="text-decoration: none" class="pointer"
                                               onclick="termoResponsabilidade(<?= $statusTermo ?>,
                                               <?= $campanha->oCampanha->idCampanha ?>);"><strong>
                                                    <?= $campanha->oCampanha->campanha ?> - Ano
                                                    Base: <?= $campanha->oCampanha->anoBase ?> - Disponível:
                                                    <?= Util::formataDataBancoForm($campanha->oCampanha->dataInicio) ?>
                                                    a <?= Util::formataDataBancoForm
                                                    ($campanha->oCampanha->dataFim) ?>
                                                </strong> </a>
                                            <span class="label label-<?= $tipoLabel ?> pull-right"><?= $descStatus ?></span>
                                        </li>
                                    </ul>
                                <?php }
                                ?>
                            </div>
                        </div>

                    </div>
                    <?php
                }
                ?>

            </div>
            <div class="clear"></div>
        </div>

    </div>

    <div class="modal fade" id="modalTrocarSenha" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Trocar Senha de Acesso</h4>
                </div>
                <div class="alert" style="display: none;margin-bottom: 0">
                    <h4></h4>
                    <p></p>
                </div>
                <form class="form-horizontal" onsubmit="return false;" id="formTrocarSenha">
                    <div class="modal-body">
                        <div id="form-carregando" style="display: none"><img src="img/blocksLoading.gif">Enviando...
                        </div>
                        <div id="corpoForm">
                            <div class="form-group">
                                <label for="senha" class="col-sm-4 control-label">Senha Atual:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="senha" placeholder="Senha Atual"
                                           required oninvalid="setCustomValidity('Digite a senha atual.')"
                                           oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="password" class="col-sm-4 control-label">Nova Senha:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="password"
                                           placeholder="Mín. 6 caracteres." required
                                           oninvalid="setCustomValidity('Digite a nova senha.')"
                                           oninput="setCustomValidity('')">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="confirmPassword" class="col-sm-4 control-label">Confirme Nova Senha:</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control" id="confirmPassword"
                                           placeholder="Confirme Nova Senha" required
                                           oninvalid="setCustomValidity('Confirme a nova senha.')"
                                           oninput="setCustomValidity('')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Fechar
                        </button>
                        <button type="button" id="btnTrocarSenha" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalTermoResponsabilidade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header modal-header-primary font-12">
                    <h4>Termo de Responsabilidade</h4>
                </div>
                <form class="form-horizontal" onsubmit="return false;" id="termoResponsabilidade">
                    <div class="modal-body">
                        <div id="">
                            <div class="form-group">
                                <div class="col-sm-12 font-12">

                                    <?php include "termoResp.php"; ?>

                                </div>
                            </div>
                            <div class="form-group ">
                                <div class="col-sm-12">
                                    <div class="checkbox checkbox-primary">
                                        <input type="checkbox" class="styled" id="aceito" name="aceito" value="1"
                                               onchange="aceitarTermo();">
                                        <label for="aceito">Li e concordo com o Termo de Responsabilidade.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="idCampanha" name="termoResponsabilidade[idCampanha]" value="">
                        <input type="hidden" id="idEmpresa" name="termoResponsabilidade[idEmpresa]" value="">
                        <input type="hidden" id="cnpj" name="termoResponsabilidade[cnpj]"
                               value="<?= $_SESSION['usuarioAtual']['cnpj'] ?>">
                        <input type="hidden" id="dataHoraAlteracao"
                               name=termoResponsabilidade[dataHoraAlteracao]" value="<?= date("d/m/Y H:i:s") ?>">
                        <input type="hidden" id="usuarioAlteracao" name="termoResponsabilidade[usuarioAlteracao]"
                               value="<?= $_SESSION['usuarioAtual']['cnpj'] ?>">
                        <button type="button" id="btn-fechar-" class="btn btn-secondary" data-dismiss="modal">Fechar
                        </button>
                        <button type="submit" id="btnAceitar" class="btn btn-primary" onclick="confirmaTermo();"
                                disabled>Aceitar
                        </button>
                    </div>
                    <div class="modal-footer">
                        <div class="alert alert-warning">
                            <div class="col-md-10">Caso você não tenha incentivos ou ainda não usufruiu do incentivo concedido, voce pode solicitar a retirada de seu cnpj da campanha atual</div>
                            <div class="col-md-2"><button class="btn btn-primary">Solicitar</button></div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-nova-senha-campanha" tabindex="-1" data-backdrop="static" role="dialog" aria-hidden="true">
        <form id="alterar-senha-primeiro-acesso">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header modal-header-primary font-12">
                        <h4>
                            Cadastrar Senha
                            <i class="glyphicon glyphicon-refresh spin right font-13 hidden"></i>
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger hidden">Os campos <b>Senha</b> e <b>Confirmação de senha</b> não conferem!</div>
                        <p class="box-info bg-yellow">Em seu primeiro acesso é obrigatório realizar o cadastro de sua senha de acesso!</p>
                        <div class="form-group">
                            <span>Senha:</span>
                            <input type="password" id="p-senha" name="senha" required class="form-control">
                        </div>
                        <div class="form-group">
                            <span>Confirmação de senha:</span>
                            <input type="password" id="conf-p-senha" name="conf_senha" required class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="btnAceitar" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require_once("includes/footer.php") ?>
</body>
</html>