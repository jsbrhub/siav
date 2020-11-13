<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
// ================= Cadastrar Cadastrofinanceiro ========================= 
if($_REQUEST['dados'] == 'cadastro'){
    print ($idCadastroFinanceiro = $oControle->cadastraCadastrofinanceiro()) ? "" : $oControle->msg;
    $retorno['id'] = $idCadastroFinanceiro;
    $retorno['infoFinanceiro'] = $oControle->getCadastrofinanceiro($idCadastroFinanceiro);
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'edicao'){
    $idCadastroFinanceiro = $oControle->alteraCadastrofinanceiro();
    $infoFinanceiro = $oControle->getCadastrofinanceiro($idCadastroFinanceiro);
    $infoFinanceiro->faturamentoBruto = Util::formataMoeda($infoFinanceiro->faturamentoBruto);
    $infoFinanceiro->imobilizadoTotal = Util::formataMoeda($infoFinanceiro->imobilizadoTotal);
    $infoFinanceiro->reservaExercicio = Util::formataMoeda($infoFinanceiro->reservaExercicio);
    $infoFinanceiro->irDescontada = Util::formataMoeda($infoFinanceiro->irDescontada);
    $infoFinanceiro->valorIcms = Util::formataMoeda($infoFinanceiro->valorIcms);
    $infoFinanceiro->valorIssqn = Util::formataMoeda($infoFinanceiro->valorIssqn);
    $infoFinanceiro->despesaTerceiro = Util::formataMoeda($infoFinanceiro->despesaTerceiro);
    $infoFinanceiro->pessoasEncargos = Util::formataMoeda($infoFinanceiro->pessoasEncargos);
    $infoFinanceiro->impostosTaxasContribuicoes = Util::formataMoeda($infoFinanceiro->impostosTaxasContribuicoes);
    $infoFinanceiro->remuneracaoCapitalTerceiros = Util::formataMoeda($infoFinanceiro->remuneracaoCapitalTerceiros);
    $infoFinanceiro->remuneracaoCapitalProprio = Util::formataMoeda($infoFinanceiro->remuneracaoCapitalProprio);
    $infoFinanceiro->investimentoCapitalFixo = Util::formataMoeda($infoFinanceiro->investimentoCapitalFixo);
    $infoFinanceiro->faturamentoProdIncentivados = Util::formataMoeda($infoFinanceiro->faturamentoProdIncentivados);
    $infoFinanceiro->reservaInvestimento = Util::formataMoeda($infoFinanceiro->reservaInvestimento);
    $infoFinanceiro->valorIRtotal = Util::formataMoeda($infoFinanceiro->valorIRtotal);
    $infoFinanceiro->capitalGiro = Util::formataMoeda($infoFinanceiro->capitalGiro);
    $infoFinanceiro->capitalFixo = Util::formataMoeda($infoFinanceiro->capitalFixo);
    $infoFinanceiro->valorDescontoIR = Util::formataMoeda($infoFinanceiro->valorDescontoIR);
    $infoFinanceiro->reservaIncentivo = Util::formataMoeda($infoFinanceiro->reservaIncentivo);
    $retorno['id'] = $idCadastroFinanceiro;
    $retorno['infoFinanceiro'] = $infoFinanceiro;
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}

$infoFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
?>
<div id="dadosEmpresa" class="mt-10 border-radius bg-grey p-10 grey">
    <div class="alert alert-dismissible fade in alert-info no-display" id="alertaFinanceiro">
        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
        <p class="font-12" id="financeiroMsg"><strong></strong></p>
    </div>
    <form role="form" onsubmit="return false;" id="form-financeiro" class="">
        <div class="row">
            <div class="col-md-10 ">
                <div class="form-group font-13"><br>
                    <strong>Preencha os dados financeiros da sua empresa:</strong>
                </div>
            </div>
            <div class="col-md-2 ">
                <div class="form-group pull-right">
                    <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaFinanceiro()"><span class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="faturamentoBruto">Faturamento Bruto *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="faturamentoBruto" name="financeiro[faturamentoBruto]" value="<?=($infoFinanceiro->faturamentoBruto == '')?'':Util::formataMoeda($infoFinanceiro->faturamentoBruto)?>" required  oninvalid="setCustomValidity('Digite o ' +
                             'Faturamento Bruto.')"
                                   oninput="setCustomValidity('')">

                        </div>
                    </div>
                    <input type="hidden" class="form-control input-sm" id="idEmpresa" name="financeiro[idEmpresa]" value="<?=$idEmpresa?>">
                    <input type="hidden" class="form-control input-sm" id="idCadastroFinanceiro" name="financeiro[idCadastroFinanceiro]" value="<?=$infoFinanceiro->idCadastroFinanceiro?>" >
                    <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="financeiro[dataHoraAlteracao]" value="<?=date("d/m/Y H:i:s")?>">
                    <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="financeiro[usuarioAlteracao]" value="<?=$_SESSION['usuarioAtual']['cnpj']?>">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="faturamentoProdIncentivados">Faturamento com Produtos Incentivados *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="faturamentoProdIncentivados"
                                   name="financeiro[faturamentoProdIncentivados]" value="<?=($infoFinanceiro->faturamentoProdIncentivados == '')?'':Util::formataMoeda($infoFinanceiro->faturamentoProdIncentivados)?>" required  oninvalid="setCustomValidity('Digite o Faturamento com Produtos Incentivados.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="imobilizadoTotal">Imobilizado Total *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="imobilizadoTotal"
                                   name="financeiro[imobilizadoTotal]" value="<?=($infoFinanceiro->imobilizadoTotal == '')?'':Util::formataMoeda($infoFinanceiro->imobilizadoTotal)?>" required  oninvalid="setCustomValidity('Digite o Imobilizado Total.')"
                                   oninput="setCustomValidity('')">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="investimentoCapitalFixo">Investimento em Capital Fixo *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="investimentoCapitalFixo"
                                   name="financeiro[investimentoCapitalFixo]" value="<?=($infoFinanceiro->investimentoCapitalFixo == '')?'':Util::formataMoeda($infoFinanceiro->investimentoCapitalFixo)?>" required  oninvalid="setCustomValidity('Digite o Investimento em Capital Fixo.')"
                                   oninput="setCustomValidity('')">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="remuneracaoCapitalProprio">Remuneração do Capital Próprio *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="remuneracaoCapitalProprio" name="financeiro[remuneracaoCapitalProprio]" value="<?=($infoFinanceiro->remuneracaoCapitalProprio == '')?'':Util::formataMoeda($infoFinanceiro->remuneracaoCapitalProprio)?>" required  oninvalid="setCustomValidity('Digite a Remuneração do Capital Próprio.')" oninput="setCustomValidity('')">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="remuneracaoCapitalTerceiros">Remuneração do Capital de Terceiros *:</label>
                    <div class="input-group">
                        <span class="input-group-addon font-12">R$</span>
                        <input type="text" class="form-control input-sm money" id="remuneracaoCapitalTerceiros"
                               name="financeiro[remuneracaoCapitalTerceiros]" value="<?=($infoFinanceiro->remuneracaoCapitalTerceiros == '')?'':Util::formataMoeda($infoFinanceiro->remuneracaoCapitalTerceiros)?>" required  oninvalid="setCustomValidity('Digite a Remuneração do Capital de Terceiros.')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pessoasEncargos">Pessoal e Encargos *:</label>
                    <div class="input-group">
                        <span class="input-group-addon font-12">R$</span>
                        <input type="text" class="form-control input-sm money" id="pessoasEncargos"
                               name="financeiro[pessoasEncargos]" value="<?=($infoFinanceiro->pessoasEncargos == '')?'':Util::formataMoeda($infoFinanceiro->pessoasEncargos)?>" required  oninvalid="setCustomValidity('Digite o Pessoal e Encargos.')" oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="impostosTaxasContribuicoes">Impostos, Taxas e Contribuições *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="impostosTaxasContribuicoes"
                                   name="financeiro[impostosTaxasContribuicoes]" value="<?=($infoFinanceiro->impostosTaxasContribuicoes == '')?'':Util::formataMoeda($infoFinanceiro->impostosTaxasContribuicoes)?>" required  oninvalid="setCustomValidity('Digite os Impostos, Taxas e Contribuições.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="valorIcms" class="mt-17">Valor Pago de ICMS *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="valorIcms" name="financeiro[valorIcms]" value="<?=($infoFinanceiro->valorIcms == '')?'':Util::formataMoeda($infoFinanceiro->valorIcms)?>" required  oninvalid="setCustomValidity('Digite o Valor Pago de ICMS.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valorIssqn"  class="mt-17">Valor Pago de ISSQN *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="valorIssqn"
                                   name="financeiro[valorIssqn]" value="<?=($infoFinanceiro->valorIssqn == '')?'':Util::formataMoeda
                            ($infoFinanceiro->valorIssqn)?>" required  oninvalid="setCustomValidity('Digite o Valor Pago de ISSQN.')"
                                   oninput="setCustomValidity('')">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valorIRtotal">Valor do IR Total Não Descontado da Redução/Isenção *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="valorIRtotal"
                                   name="financeiro[valorIRtotal]" value="<?=($infoFinanceiro->valorIRtotal == '')?'':Util::formataMoeda
                            ($infoFinanceiro->valorIRtotal)?>" required  oninvalid="setCustomValidity('Digite o Valor do IR Total Não Descontado da ' +
                             'Redução/Isenção.')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="valorDescontoIR">Valor do Desconto de IR Referente à Redução/Isenção *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="valorDescontoIR"
                                   name="financeiro[valorDescontoIR]" value="<?=($infoFinanceiro->valorDescontoIR == '')?'':Util::formataMoeda($infoFinanceiro->valorDescontoIR)?>" required  oninvalid="setCustomValidity('Digite o Valor do Desconte de IR Referente à Redução/Isenção.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="irDescontada">Valor do IR Descontado da Redução/Isenção *:</label>
                    <div class="input-group">
                        <span class="input-group-addon font-12">R$</span>
                        <input type="text" class="form-control input-sm money" id="irDescontada"
                               name="financeiro[irDescontada]" value="<?=($infoFinanceiro->irDescontada == '')?'':Util::formataMoeda
                        ($infoFinanceiro->irDescontada)?>" required  oninvalid="setCustomValidity('Digite o Valor do IR Descontado da Redução/Isenção.')"
                               oninput="setCustomValidity('')">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="reservaIncentivo" class="mt-17">Reserva de Incentivo Fiscal *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="reservaIncentivo"
                                   name="financeiro[reservaIncentivo]" value="<?=($infoFinanceiro->reservaIncentivo == '')?'':Util::formataMoeda($infoFinanceiro->reservaIncentivo)?>" required  oninvalid="setCustomValidity('Digite a Reserva de Incentivo Fiscal.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="reservaExercicio" class="mt-17">Reserva Apropriada no Exercício *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="reservaExercicio"
                                   name="financeiro[reservaExercicio]" value="<?=($infoFinanceiro->reservaExercicio == '')?'':Util::formataMoeda($infoFinanceiro->reservaExercicio)?>" required  oninvalid="setCustomValidity('Digite a Reserva Apropriada no Exercício.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="reservaInvestimento" class="mt-17">Reserva de Reinvestimento:</label>
                    <div class="input-group">
                        <span class="input-group-addon font-12">R$</span>
                        <input type="text" class="form-control input-sm money" id="reservaInvestimento"
                               name="financeiro[reservaInvestimento]" value="<?=($infoFinanceiro->reservaInvestimento == '')?'':Util::formataMoeda($infoFinanceiro->reservaInvestimento)?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="empregosDiretos"  class="mt-17">Empregos Diretos Existentes em 31/12 *:</label>
                    <input type="text" class="form-control input-sm somentenumeros" id="empregosDiretos"
                           name="financeiro[empregosDiretos]" value="<?=($infoFinanceiro->empregosDiretos == '')?'':$infoFinanceiro->empregosDiretos?>" required  oninvalid="setCustomValidity('Digite os Empregos Diretos Existentes em 31/12.')"
                           oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="maoObraIndiretaFixa"  class="mt-17">Empregos Indiretos Existentes em 31/12 *:</label>
                    <input type="text" class="form-control input-sm somentenumeros"
                           id="maoObraIndiretaFixa"
                           name="financeiro[maoObraIndiretaFixa]" value="<?=($infoFinanceiro->maoObraIndiretaFixa == '')
                        ?'':$infoFinanceiro->maoObraIndiretaFixa?>" required  oninvalid="setCustomValidity('Digite os Empregos Indiretos Existentes em 31/12.')"
                           oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="terceirizadosExistentes">Empregos Terceirizados Existentes em 31/12 *:</label>
                    <input type="text" class="form-control input-sm somentenumeros" id="terceirizadosExistentes"
                           name="financeiro[terceirizadosExistentes]" value="<?=($infoFinanceiro->terceirizadosExistentes == '')
                        ?'':$infoFinanceiro->terceirizadosExistentes?>" required  oninvalid="setCustomValidity('Digite os Empregos Terceirizados Existentes ' +
                         'em 31/12.')" oninput="setCustomValidity('')">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="despesaTerceiro"  class="mt-17">Despesa com Empregos Terceirizados *:</label>
                    <div class="controls">
                        <div class="input-group">
                            <span class="input-group-addon font-12">R$</span>
                            <input type="text" class="form-control input-sm money" id="despesaTerceiro"
                                   name="financeiro[despesaTerceiro]" value="<?=($infoFinanceiro->despesaTerceiro == '')?'':Util::formataMoeda($infoFinanceiro->despesaTerceiro)?>" required  oninvalid="setCustomValidity('Digite a Despesa com Empregos Terceirizados.')"
                                   oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="maoObraDireta">Empregos Diretos Oriundos do Município em 31/12 *:</label>
                    <input type="text" class="form-control input-sm somentenumeros" id="maoObraDireta"
                           name="financeiro[maoObraDireta]" value="<?=($infoFinanceiro->maoObraDireta == '')?'':$infoFinanceiro->maoObraDireta?>" required  oninvalid="setCustomValidity('Digite os Empregos Diretos Oriundos do Município em 31/12.')"
                           oninput="setCustomValidity('')">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for=""></label>
                    <button id="btnFinanceiro"  type="submit" onclick="cadFinanceiro()"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;Salvar</button>
                </div>
            </div>
            <div class="col-md-6">
                <span class="font-10">* Preenchimento obrigatório.</span>
            </div>
        </div>
    </form>
</div>
<div class="modal fade no-display" id="ajudaFinanceiro" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Dados Financeiros</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaFinanceiro.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>