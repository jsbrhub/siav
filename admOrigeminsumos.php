<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aOrigeminsumos = $oControle->getAllOrigeminsumos();
//Util::trace($aOrigeminsumos);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiOrigeminsumos($_REQUEST['idOrigemInsumos'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="OrigeminsumosController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Origeminsumos</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aOrigeminsumos){
?>	
			<thead>
				<tr>
					<th>IdOrigemInsumos</th>
					<th>Insumos</th>
					<th>Incentivoempresa</th>
					<th>QuantidadeRegional</th>
					<th>QuantidadeNacional</th>
					<th>QuantidadeExterior</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aOrigeminsumos as $oOrigeminsumos){
?>
				<tr>
					<td><?=$oOrigeminsumos->idOrigemInsumos?></td>
					<td><?=$oOrigeminsumos->oInsumos->descricao?></td>
					<td><?=$oOrigeminsumos->oIncentivoempresa->unidadeDescricao?></td>
					<td><?=$oOrigeminsumos->quantidadeRegional?></td>
					<td><?=$oOrigeminsumos->quantidadeNacional?></td>
					<td><?=$oOrigeminsumos->quantidadeExterior?></td>
					<td><a class="btn btn-success btn-sm" href="editOrigeminsumos.php?idOrigemInsumos=<?=$oOrigeminsumos->idOrigemInsumos;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idOrigemInsumos','<?=$oOrigeminsumos->idOrigemInsumos;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="8" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="8"><a href="cadOrigeminsumos.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Origeminsumos" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>