<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aEmpresacampanha = $oControle->getAllEmpresacampanha();
//Util::trace($aEmpresacampanha);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiEmpresacampanha($_REQUEST['idEmpresaCampanha'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="EmpresacampanhaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Empresacampanha</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aEmpresacampanha){
?>	
			<thead>
				<tr>
					<th>IdEmpresaCampanha</th>
					<th>Campanha</th>
					<th>Empresa</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aEmpresacampanha as $oEmpresacampanha){
?>
				<tr>
					<td><?=$oEmpresacampanha->idEmpresaCampanha?></td>
					<td><?=$oEmpresacampanha->oCampanha->usuarioAlteracao?></td>
					<td><?=$oEmpresacampanha->oEmpresa->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editEmpresacampanha.php?idEmpresaCampanha=<?=$oEmpresacampanha->idEmpresaCampanha;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idEmpresaCampanha','<?=$oEmpresacampanha->idEmpresaCampanha;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="5" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="5"><a href="cadEmpresacampanha.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Empresacampanha" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>