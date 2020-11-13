<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aUnidademedida = $oControle->getAllUnidademedida();
//Util::trace($aUnidademedida);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiUnidademedida($_REQUEST['idUnidade'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="UnidademedidaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Unidademedida</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aUnidademedida){
?>	
			<thead>
				<tr>
					<th>IdUnidade</th>
					<th>Nome</th>
					<th>Sigla</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aUnidademedida as $oUnidademedida){
?>
				<tr>
					<td><?=$oUnidademedida->idUnidade?></td>
					<td><?=$oUnidademedida->nome?></td>
					<td><?=$oUnidademedida->sigla?></td>
					<td><a class="btn btn-success btn-sm" href="editUnidademedida.php?idUnidade=<?=$oUnidademedida->idUnidade;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idUnidade','<?=$oUnidademedida->idUnidade;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="5"><a href="cadUnidademedida.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Unidademedida" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>