<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aInsumos = $oControle->getAllInsumos();
//Util::trace($aInsumos);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiInsumos($_REQUEST['idInsumo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="InsumosController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Insumos</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aInsumos){
?>	
			<thead>
				<tr>
					<th>IdInsumo</th>
					<th>Descricao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aInsumos as $oInsumos){
?>
				<tr>
					<td><?=$oInsumos->idInsumo?></td>
					<td><?=$oInsumos->descricao?></td>
					<td><a class="btn btn-success btn-sm" href="editInsumos.php?idInsumo=<?=$oInsumos->idInsumo;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idInsumo','<?=$oInsumos->idInsumo;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="4" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="4"><a href="cadInsumos.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Insumos" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>