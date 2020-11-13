<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Cadastrofinanceiro ========================= 
if($_POST){
	print ($oControle->alteraCadastrofinanceiro()) ? "" : $oControle->msg; exit;
}

$oCadastrofinanceiro = $oControle->getCadastrofinanceiro($_REQUEST['idCadastroFinanceiro']);
$aEmpresa = $oControle->getAllEmpresa();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/modals.php");?>
    <div class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="principal.php">Home</a></li>
            <li><a href="admCadastrofinanceiro.php">Cadastrofinanceiro</a></li>
            <li class="active">Editar Cadastrofinanceiro</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idEmpresa">Empresa</label>
	<select name="idEmpresa" id="idEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aEmpresa as $oEmpresa){
	?>
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oCadastrofinanceiro->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="ehEstimado">EhEstimado</label>
	<input type="text" class="form-control" id="ehEstimado" name="ehEstimado" value="<?=$oCadastrofinanceiro->ehEstimado?>" />
</div>
<div class="form-group">
	<label for="faturamentoBruto">FaturamentoBruto</label>
	<input type="text" class="form-control" id="faturamentoBruto" name="faturamentoBruto" value="<?=$oCadastrofinanceiro->faturamentoBruto?>" />
</div>
<div class="form-group">
	<label for="imobilizadoTotal">ImobilizadoTotal</label>
	<input type="text" class="form-control" id="imobilizadoTotal" name="imobilizadoTotal" value="<?=$oCadastrofinanceiro->imobilizadoTotal?>" />
</div>
<div class="form-group">
	<label for="reservaExercicio">ReservaExercicio</label>
	<input type="text" class="form-control" id="reservaExercicio" name="reservaExercicio" value="<?=$oCadastrofinanceiro->reservaExercicio?>" />
</div>
<div class="form-group">
	<label for="irDescontada">IrDescontada</label>
	<input type="text" class="form-control" id="irDescontada" name="irDescontada" value="<?=$oCadastrofinanceiro->irDescontada?>" />
</div>
<div class="form-group">
    <label for="valorIcms">valorIcms</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorIcms" id="valorIcms" value="<?=$oCadastrofinanceiro->valorIcms?>" />
    </div>
</div>

<div class="form-group">
    <label for="valorIssqn">valorIssqn</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorIssqn" id="valorIssqn" value="<?=$oCadastrofinanceiro->valorIssqn?>" />
    </div>
</div>

<div class="form-group">
	<label for="empregosDiretos">EmpregosDiretos</label>
	<input type="text" class="form-control" id="empregosDiretos" name="empregosDiretos" value="<?=$oCadastrofinanceiro->empregosDiretos?>" />
</div>
<div class="form-group">
    <label for="despesaTerceiro">despesaTerceiro</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="despesaTerceiro" id="despesaTerceiro" value="<?=$oCadastrofinanceiro->despesaTerceiro?>" />
    </div>
</div>

<div class="form-group">
	<label for="terceirizadosExistentes">TerceirizadosExistentes</label>
	<input type="text" class="form-control" id="terceirizadosExistentes" name="terceirizadosExistentes" value="<?=$oCadastrofinanceiro->terceirizadosExistentes?>" />
</div>
<div class="form-group">
	<label for="pessoasEncargos">PessoasEncargos</label>
	<input type="text" class="form-control" id="pessoasEncargos" name="pessoasEncargos" value="<?=$oCadastrofinanceiro->pessoasEncargos?>" />
</div>
<div class="form-group">
	<label for="impostosTaxasContribuicoes">ImpostosTaxasContribuicoes</label>
	<input type="text" class="form-control" id="impostosTaxasContribuicoes" name="impostosTaxasContribuicoes" value="<?=$oCadastrofinanceiro->impostosTaxasContribuicoes?>" />
</div>
<div class="form-group">
	<label for="remuneracaoCapitalTerceiros">RemuneracaoCapitalTerceiros</label>
	<input type="text" class="form-control" id="remuneracaoCapitalTerceiros" name="remuneracaoCapitalTerceiros" value="<?=$oCadastrofinanceiro->remuneracaoCapitalTerceiros?>" />
</div>
<div class="form-group">
	<label for="remuneracaoCapitalProprio">RemuneracaoCapitalProprio</label>
	<input type="text" class="form-control" id="remuneracaoCapitalProprio" name="remuneracaoCapitalProprio" value="<?=$oCadastrofinanceiro->remuneracaoCapitalProprio?>" />
</div>
<div class="form-group">
	<label for="investimentoCapitalFixo">InvestimentoCapitalFixo</label>
	<input type="text" class="form-control" id="investimentoCapitalFixo" name="investimentoCapitalFixo" value="<?=$oCadastrofinanceiro->investimentoCapitalFixo?>" />
</div>
<div class="form-group">
	<label for="faturamentoProdIncentivados">FaturamentoProdIncentivados</label>
	<input type="text" class="form-control" id="faturamentoProdIncentivados" name="faturamentoProdIncentivados" value="<?=$oCadastrofinanceiro->faturamentoProdIncentivados?>" />
</div>
<div class="form-group">
	<label for="reservaInvestimento">ReservaInvestimento</label>
	<input type="text" class="form-control" id="reservaInvestimento" name="reservaInvestimento" value="<?=$oCadastrofinanceiro->reservaInvestimento?>" />
</div>
<div class="form-group">
    <label for="valorIRtotal">valorIRtotal</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorIRtotal" id="valorIRtotal" value="<?=$oCadastrofinanceiro->valorIRtotal?>" />
    </div>
</div>

<div class="form-group">
	<label for="capitalGiro">CapitalGiro</label>
	<input type="text" class="form-control" id="capitalGiro" name="capitalGiro" value="<?=$oCadastrofinanceiro->capitalGiro?>" />
</div>
<div class="form-group">
	<label for="maoObraDireta">MaoObraDireta</label>
	<input type="text" class="form-control" id="maoObraDireta" name="maoObraDireta" value="<?=$oCadastrofinanceiro->maoObraDireta?>" />
</div>
<div class="form-group">
	<label for="maoObraIndiretaFixa">MaoObraIndiretaFixa</label>
	<input type="text" class="form-control" id="maoObraIndiretaFixa" name="maoObraIndiretaFixa" value="<?=$oCadastrofinanceiro->maoObraIndiretaFixa?>" />
</div>
<div class="form-group">
	<label for="maoObraReal">MaoObraReal</label>
	<input type="text" class="form-control" id="maoObraReal" name="maoObraReal" value="<?=$oCadastrofinanceiro->maoObraReal?>" />
</div>
<div class="form-group">
	<label for="recursosProprios">RecursosProprios</label>
	<input type="text" class="form-control" id="recursosProprios" name="recursosProprios" value="<?=$oCadastrofinanceiro->recursosProprios?>" />
</div>
<div class="form-group">
	<label for="previsaoIsencao">PrevisaoIsencao</label>
	<input type="text" class="form-control" id="previsaoIsencao" name="previsaoIsencao" value="<?=$oCadastrofinanceiro->previsaoIsencao?>" />
</div>
<div class="form-group">
	<label for="acionistas">Acionistas</label>
	<input type="text" class="form-control" id="acionistas" name="acionistas" value="<?=$oCadastrofinanceiro->acionistas?>" />
</div>
<div class="form-group">
	<label for="totalReinvestimento">TotalReinvestimento</label>
	<input type="text" class="form-control" id="totalReinvestimento" name="totalReinvestimento" value="<?=$oCadastrofinanceiro->totalReinvestimento?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oCadastrofinanceiro->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oCadastrofinanceiro->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admCadastrofinanceiro.php">Voltar</a>
                        <input name="idCadastroFinanceiro" type="hidden" id="idCadastroFinanceiro" value="<?=$_REQUEST['idCadastroFinanceiro']?>" />
                        <input type="hidden" name="classe" id="classe" value="Cadastrofinanceiro" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>