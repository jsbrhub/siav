<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aRetificacaoempresa = $oControle->getAllRetificacaoempresa();
//Util::trace($aRetificacaoempresa);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiRetificacaoempresa($_REQUEST['idRetEmpresa'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="RetificacaoempresaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Retificacaoempresa</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aRetificacaoempresa){
?>	
			<thead>
				<tr>
					<th>IdRetEmpresa</th>
					<th>Empresa</th>
					<th>Cnpj</th>
					<th>AnoBase</th>
					<th>Motivo</th>
					<th>Justificativa</th>
					<th>Status</th>
					<th>DataSolicitacao</th>
					<th>UsuarioSolicitacao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aRetificacaoempresa as $oRetificacaoempresa){
?>
				<tr>
					<td><?=$oRetificacaoempresa->idRetEmpresa?></td>
					<td><?=$oRetificacaoempresa->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oRetificacaoempresa->cnpj?></td>
					<td><?=$oRetificacaoempresa->anoBase?></td>
					<td><?=$oRetificacaoempresa->motivo?></td>
					<td><?=$oRetificacaoempresa->justificativa?></td>
					<td><?=$oRetificacaoempresa->status?></td>
					<td><?=Util::formataDataHoraBancoForm($oRetificacaoempresa->dataSolicitacao)?></td>
					<td><?=$oRetificacaoempresa->usuarioSolicitacao?></td>
					<td><a class="btn btn-success btn-sm" href="editRetificacaoempresa.php?idRetEmpresa=<?=$oRetificacaoempresa->idRetEmpresa;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idRetEmpresa','<?=$oRetificacaoempresa->idRetEmpresa;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="11" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="11"><a href="cadRetificacaoempresa.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Retificacaoempresa" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>