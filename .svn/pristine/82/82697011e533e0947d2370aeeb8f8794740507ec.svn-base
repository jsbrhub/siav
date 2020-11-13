<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aEmpresaalerta = $oControle->getAllEmpresaalerta();
//Util::trace($aEmpresaalerta);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiEmpresaalerta($_REQUEST['idEmpresaAlerta'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="EmpresaalertaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Empresaalerta</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aEmpresaalerta){
?>	
			<thead>
				<tr>
					<th>IdEmpresaAlerta</th>
					<th>Alerta</th>
					<th>Empresa</th>
					<th>Campanha</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aEmpresaalerta as $oEmpresaalerta){
?>
				<tr>
					<td><?=$oEmpresaalerta->idEmpresaAlerta?></td>
					<td><?=$oEmpresaalerta->oAlerta->usuarioAlteracao?></td>
					<td><?=$oEmpresaalerta->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oEmpresaalerta->oCampanha->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editEmpresaalerta.php?idEmpresaAlerta=<?=$oEmpresaalerta->idEmpresaAlerta;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idEmpresaAlerta','<?=$oEmpresaalerta->idEmpresaAlerta;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="6" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="6"><a href="cadEmpresaalerta.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Empresaalerta" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>