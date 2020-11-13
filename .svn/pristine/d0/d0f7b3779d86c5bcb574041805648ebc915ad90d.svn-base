<?php
require_once("classes/class.Controle.php");

$oControle = new Controle();
//Util::trace($oControle);
$idRetEmpresa = $_REQUEST['idRetEmpresa'];
if($_REQUEST['acao'] == 'dados'){
    $retorno = [];
    $dadosRetificacaoSudam = $oControle->getRetificaoSudamByIdRetEmpresa($idRetEmpresa);
    $arquivos = $oControle->getArquivosRetificacao($idRetEmpresa);
    $dadosRetificacao = $oControle->getRetificacaoempresa($idRetEmpresa);
    $razaoSocial = $dadosRetificacao->oEmpresa->razaoSocial;
    $cnpj = Util::formataCNPJ($dadosRetificacao->oEmpresa->cnpj);
    $retorno["arquivos"] = $arquivos;
    $retorno["sudam"] = $dadosRetificacaoSudam;
    $retorno["razaoSocial"] = $razaoSocial;
    $retorno["cnpj"] = $cnpj;
    echo json_encode($retorno);
    exit();
}

if($_REQUEST['update'] == 1){
    $oControle->updateStatusRet($idRetEmpresa,'2');
    $retorno = [];
    $dadosRetificacao = $oControle->getRetificacaoempresa($idRetEmpresa);
    $dadosRetificacao->oEmpresa->cnpj = Util::formataCNPJ($dadosRetificacao->oEmpresa->cnpj);
    $dadosArquivo = $oControle->getArquivosRetificacao($idRetEmpresa);
    $retorno["retificacao"] = $dadosRetificacao;
    $retorno["arquivos"] = $dadosArquivo;
    echo (json_encode($retorno));
    exit();
}
if($_REQUEST['update'] == '0'){
    $retorno = [];
    $dadosRetificacao = $oControle->getRetificacaoempresa($idRetEmpresa);
    $dadosRetificacao->oEmpresa->cnpj = Util::formataCNPJ($dadosRetificacao->oEmpresa->cnpj);
    $dadosArquivo = $oControle->getArquivosRetificacao($idRetEmpresa);
    $retorno["retificacao"] = $dadosRetificacao;
    $retorno["arquivos"] = $dadosArquivo;
    echo (json_encode($retorno));
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
    <link rel="stylesheet" href="js/datepicker/css/bootstrap-datepicker.css">
    <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="js/retificacao.js"></script>
</head>
<body>
<?php require_once("includes/modals.php"); include ("includes/topo.php");
?>
	<div class="container">
		<?php require_once("includes/menu.php"); ?>
        <form id="form-cons-campanha" onsubmit="return false;">
            <div class="bs-callout bs-callout-primary">
                <h4 style="font-size: 14px"><strong>Consultar Retificações</strong></h4><br />
                <div class="row" id="pesqRet">
                    <div class="col-lg-2">
                        <div class="" >
                            <label class="font-12 grey">Exibir Retificações:</label>
                            <select class="form-control input-sm" id="situacaoCadastro" name="situacaoCadastro" onchange="consultarRetificacoes(this.value)">
                                <option value="0">Selecione</option>
                                <option value="1">Não Visualizadas</option>
                                <option value="2">Em análise</option>
                                <option value="3">Aprovadas</option>
                                <option value="4">Indeferidas</option>
                                <option value="5">Retificadas</option>
                            </select>

                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="alert alert-dismissible fade in alert-danger" id="alerta" style="display: none">
            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
            <p class="font-12"></p>
        </div>
        <div class="bg-grey p-10 font-11" id="legenda" style="display: none">

            <div class="col-lg-2"><img src="img/status_0.png"> - Pendente
            </div>
            <div class="col-lg-2"><img src="img/status_1.png"> - Em Análise
            </div>
            <div class="col-lg-2"><img src="img/status_3.png"> - Aprovada
            </div>
            <div class="col-lg-2"><img src="img/status_4.png"> - Indeferida
            </div>
            <div class="col-lg-2"><img src="img/status_5.png"> - Retificada
            </div>
            <div style="clear: both"></div>
        </div>
        <div id="resultado">
        </div>

        <div class="modal fade no-display" id="retificacaoSudam" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title grey"><strong>Analisar Retificação</strong></h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsg">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12"></p>
                        </div>
                        <div id="carrengandoRetificacao" class="no-display">
                            <img src="img/blocksLoading.gif">
                        </div>
                        <form role="form" onsubmit="return false;" id="formRetificacao">

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="campanha">CNPJ:</label>
                                        <input type="text" class="form-control input-sm" id="cnpj" name="cnpj" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="campanha">Razão Social:</label>
                                        <input type="text" class="form-control input-sm" id="razaoSocial" name="razaoSocial" value="" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="campanha">Motivo:</label>
                                        <input type="text" class="form-control input-sm" id="motivo" name="motivo" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="campanha">Justificativa:</label>
                                        <textarea  class="form-control input-sm" id="just" name="just" rows="6" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="campanha">Arquivos:</label>
                                        <div id="arquivos"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="campanha">Análise:</label>
                                        <textarea  class="form-control input-sm" id="justificativa" name="justificativa" rows="6" ></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="hidden" id="idRetEmpresa" name="idRetEmpresa" value="">
                                    <input type="hidden" id="dataHoraAlteracao" name="dataHoraAlteracao" value="<?=date("Y-m-d H:i:s")?>">
                                    <input type="hidden" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$_SESSION['usuarioAtual']['login']?>">
                                        <button type="button" name="status" class="btn btn-success font-12" value="1" onclick="aprovarRet(this.value)"><span class="glyphicon glyphicon-ok"></span>&nbsp;&nbsp;&nbsp;Aprovar</button>
                                </div>
                                <div class="col-md-2">
                                        <button type="button" name="status" class="btn btn-danger font-12" value="2" onclick="aprovarRet(this.value)"><span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;&nbsp;Indeferir</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade no-display" id="visualizarRetificacao" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title grey"><strong>Visualizar Retificação</strong></h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsgVis">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12"></p>
                        </div>


                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="campanha">CNPJ:</label>
                                        <input type="text" class="form-control input-sm" id="cnpjVis" name="cnpjVis" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="campanha">Razão Social:</label>
                                        <input type="text" class="form-control input-sm" id="razaoSocialVis" name="razaoSocialVis" value="" disabled>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="campanha">Motivo:</label>
                                        <input type="text" class="form-control input-sm" id="motivoVis" name="motivoVis" value="" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="campanha">Justificativa:</label>
                                        <textarea  class="form-control input-sm" id="justificativaVis" name="justificativaVis" rows="6" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="arquivos">Arquivos:</label>
                                        <div id="arquivosVis"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="campanha">Análise:</label>
                                        <textarea  class="form-control input-sm" id="analiseVis" name="analiseVis" rows="6"disabled ></textarea>
                                    </div>
                                </div>

                            </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>









    </div>
	<?php require_once("includes/footer.php")?>
</body>
</html>