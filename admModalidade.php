<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aModalidade = $oControle->getAllModalidade();
//Util::trace($aModalidade);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiModalidade($_REQUEST['idModalidade'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ModalidadeController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Modalidade</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aModalidade){
?>	
			<thead>
				<tr>
					<th>IdModalidade</th>
					<th>Incentivos</th>
					<th>Descricao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aModalidade as $oModalidade){
?>
				<tr>
					<td><?=$oModalidade->idModalidade?></td>
					<td><?=$oModalidade->oIncentivos->idIncentivo?></td>
					<td><?=$oModalidade->descricao?></td>
					<td><a class="btn btn-success btn-sm" href="editModalidade.php?idModalidade=<?=$oModalidade->idModalidade;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idModalidade','<?=$oModalidade->idModalidade;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="5"><a href="cadModalidade.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Modalidade" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>