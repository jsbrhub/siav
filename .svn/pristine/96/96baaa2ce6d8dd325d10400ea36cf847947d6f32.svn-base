<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aTipoarquivo = $oControle->getAllTipoarquivo();
//Util::trace($aTipoarquivo);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiTipoarquivo($_REQUEST['idTipoArquivo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="TipoarquivoController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Tipoarquivo</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aTipoarquivo){
?>	
			<thead>
				<tr>
					<th>IdTipoArquivo</th>
					<th>Tipo</th>
					<th>Formato</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aTipoarquivo as $oTipoarquivo){
?>
				<tr>
					<td><?=$oTipoarquivo->idTipoArquivo?></td>
					<td><?=$oTipoarquivo->tipo?></td>
					<td><?=$oTipoarquivo->formato?></td>
					<td><a class="btn btn-success btn-sm" href="editTipoarquivo.php?idTipoArquivo=<?=$oTipoarquivo->idTipoArquivo;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idTipoArquivo','<?=$oTipoarquivo->idTipoArquivo;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="5"><a href="cadTipoarquivo.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Tipoarquivo" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>