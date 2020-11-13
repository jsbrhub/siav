<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aCadastrofinanceiro = $oControle->getAllCadastrofinanceiro();
//Util::trace($aCadastrofinanceiro);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiCadastrofinanceiro($_REQUEST['idCadastroFinanceiro'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="CadastrofinanceiroController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Cadastrofinanceiro</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aCadastrofinanceiro){
?>	
			<thead>
				<tr>
					<th>IdCadastroFinanceiro</th>
					<th>Empresa</th>
					<th>EhEstimado</th>
					<th>FaturamentoBruto</th>
					<th>ImobilizadoTotal</th>
					<th>ReservaExercicio</th>
					<th>IrDescontada</th>
					<th>ValorIcms</th>
					<th>ValorIssqn</th>
					<th>EmpregosDiretos</th>
					<th>DespesaTerceiro</th>
					<th>TerceirizadosExistentes</th>
					<th>PessoasEncargos</th>
					<th>ImpostosTaxasContribuicoes</th>
					<th>RemuneracaoCapitalTerceiros</th>
					<th>RemuneracaoCapitalProprio</th>
					<th>InvestimentoCapitalFixo</th>
					<th>FaturamentoProdIncentivados</th>
					<th>ReservaInvestimento</th>
					<th>ValorIRtotal</th>
					<th>CapitalGiro</th>
					<th>MaoObraDireta</th>
					<th>MaoObraIndiretaFixa</th>
					<th>MaoObraReal</th>
					<th>RecursosProprios</th>
					<th>PrevisaoIsencao</th>
					<th>Acionistas</th>
					<th>TotalReinvestimento</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aCadastrofinanceiro as $oCadastrofinanceiro){
?>
				<tr>
					<td><?=$oCadastrofinanceiro->idCadastroFinanceiro?></td>
					<td><?=$oCadastrofinanceiro->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oCadastrofinanceiro->ehEstimado?></td>
					<td><?=$oCadastrofinanceiro->faturamentoBruto?></td>
					<td><?=$oCadastrofinanceiro->imobilizadoTotal?></td>
					<td><?=$oCadastrofinanceiro->reservaExercicio?></td>
					<td><?=$oCadastrofinanceiro->irDescontada?></td>
					<td><?=$oCadastrofinanceiro->valorIcms?></td>
					<td><?=$oCadastrofinanceiro->valorIssqn?></td>
					<td><?=$oCadastrofinanceiro->empregosDiretos?></td>
					<td><?=$oCadastrofinanceiro->despesaTerceiro?></td>
					<td><?=$oCadastrofinanceiro->terceirizadosExistentes?></td>
					<td><?=$oCadastrofinanceiro->pessoasEncargos?></td>
					<td><?=$oCadastrofinanceiro->impostosTaxasContribuicoes?></td>
					<td><?=$oCadastrofinanceiro->remuneracaoCapitalTerceiros?></td>
					<td><?=$oCadastrofinanceiro->remuneracaoCapitalProprio?></td>
					<td><?=$oCadastrofinanceiro->investimentoCapitalFixo?></td>
					<td><?=$oCadastrofinanceiro->faturamentoProdIncentivados?></td>
					<td><?=$oCadastrofinanceiro->reservaInvestimento?></td>
					<td><?=$oCadastrofinanceiro->valorIRtotal?></td>
					<td><?=$oCadastrofinanceiro->capitalGiro?></td>
					<td><?=$oCadastrofinanceiro->maoObraDireta?></td>
					<td><?=$oCadastrofinanceiro->maoObraIndiretaFixa?></td>
					<td><?=$oCadastrofinanceiro->maoObraReal?></td>
					<td><?=$oCadastrofinanceiro->recursosProprios?></td>
					<td><?=$oCadastrofinanceiro->previsaoIsencao?></td>
					<td><?=$oCadastrofinanceiro->acionistas?></td>
					<td><?=$oCadastrofinanceiro->totalReinvestimento?></td>
					<td><?=Util::formataDataHoraBancoForm($oCadastrofinanceiro->dataHoraAlteracao)?></td>
					<td><?=$oCadastrofinanceiro->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editCadastrofinanceiro.php?idCadastroFinanceiro=<?=$oCadastrofinanceiro->idCadastroFinanceiro;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idCadastroFinanceiro','<?=$oCadastrofinanceiro->idCadastroFinanceiro;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="32" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="32"><a href="cadCadastrofinanceiro.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Cadastrofinanceiro" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>