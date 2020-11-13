<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aHistoricoretificacao = $oControle->getAllHistoricoretificacao();
//Util::trace($aHistoricoretificacao);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiHistoricoretificacao($_REQUEST['idHistRet'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="HistoricoretificacaoController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Historicoretificacao</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aHistoricoretificacao){
?>	
			<thead>
				<tr>
					<th>IdHistRet</th>
					<th>Retificacaoempresa</th>
					<th>Retificacaosudam</th>
					<th>Empresa</th>
					<th>IdEmpresaRet</th>
					<th>AnoBase</th>
					<th>Cnpj</th>
					<th>Status</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aHistoricoretificacao as $oHistoricoretificacao){
?>
				<tr>
					<td><?=$oHistoricoretificacao->idHistRet?></td>
					<td><?=$oHistoricoretificacao->oRetificacaoempresa->usuarioSolicitacao?></td>
					<td><?=$oHistoricoretificacao->oRetificacaosudam->usuarioAlteracao?></td>
					<td><?=$oHistoricoretificacao->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oHistoricoretificacao->idEmpresaRet?></td>
					<td><?=$oHistoricoretificacao->anoBase?></td>
					<td><?=$oHistoricoretificacao->cnpj?></td>
					<td><?=$oHistoricoretificacao->status?></td>
					<td><?=Util::formataDataHoraBancoForm($oHistoricoretificacao->dataHoraAlteracao)?></td>
					<td><?=$oHistoricoretificacao->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editHistoricoretificacao.php?idHistRet=<?=$oHistoricoretificacao->idHistRet;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idHistRet','<?=$oHistoricoretificacao->idHistRet;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="12" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="12"><a href="cadHistoricoretificacao.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Historicoretificacao" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>