<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aMunicipio = $oControle->getAllMunicipio();
//Util::trace($aMunicipio);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiMunicipio($_REQUEST['idMunicipio'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="MunicipioController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Municipio</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aMunicipio){
?>	
			<thead>
				<tr>
					<th>IdMunicipio</th>
					<th>Regiao</th>
					<th>Uf</th>
					<th></th>
					<th>Microregiao</th>
					<th>Tipologia</th>
					<th>Status</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aMunicipio as $oMunicipio){
?>
				<tr>
					<td><?=$oMunicipio->idMunicipio?></td>
					<td><?=$oMunicipio->regiao?></td>
					<td><?=$oMunicipio->uf?></td>
					<td><?=$oMunicipio->municipio?></td>
					<td><?=$oMunicipio->microregiao?></td>
					<td><?=$oMunicipio->tipologia?></td>
					<td><?=$oMunicipio->status?></td>
					<td><a class="btn btn-success btn-sm" href="editMunicipio.php?idMunicipio=<?=$oMunicipio->idMunicipio;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idMunicipio','<?=$oMunicipio->idMunicipio;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="9"><a href="cadMunicipio.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Municipio" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>