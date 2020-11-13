<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aEmpresacontrole = $oControle->getAllEmpresacontrole();
//Util::trace($aEmpresacontrole);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiEmpresacontrole($_REQUEST['idEmpresaControle'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="EmpresacontroleController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Empresacontrole</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aEmpresacontrole){
?>	
			<thead>
				<tr>
					<th>IdEmpresaControle</th>
					<th>Campanha</th>
					<th>Empresa</th>
					<th>Status</th>
					<th>DataInsercao</th>
					<th>DataAlteracao</th>
					<th>DataConclusao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aEmpresacontrole as $oEmpresacontrole){
?>
				<tr>
					<td><?=$oEmpresacontrole->idEmpresaControle?></td>
					<td><?=$oEmpresacontrole->oCampanha->usuarioAlteracao?></td>
					<td><?=$oEmpresacontrole->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oEmpresacontrole->status?></td>
					<td><?=Util::formataDataHoraBancoForm($oEmpresacontrole->dataInsercao)?></td>
					<td><?=Util::formataDataHoraBancoForm($oEmpresacontrole->dataAlteracao)?></td>
					<td><?=Util::formataDataHoraBancoForm($oEmpresacontrole->dataConclusao)?></td>
					<td><a class="btn btn-success btn-sm" href="editEmpresacontrole.php?idEmpresaControle=<?=$oEmpresacontrole->idEmpresaControle;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idEmpresaControle','<?=$oEmpresacontrole->idEmpresaControle;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="9" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="9"><a href="cadEmpresacontrole.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Empresacontrole" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>