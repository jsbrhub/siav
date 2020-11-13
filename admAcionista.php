<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aAcionista = $oControle->getAllAcionista();
//Util::trace($aAcionista);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiAcionista($_REQUEST['idAcionista'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="AcionistaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Acionista</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aAcionista){
?>	
			<thead>
				<tr>
					<th>IdAcionista</th>
					<th>Empresa</th>
					<th>Nome</th>
					<th>Cpf</th>
					<th>Email</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aAcionista as $oAcionista){
?>
				<tr>
					<td><?=$oAcionista->idAcionista?></td>
					<td><?=$oAcionista->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oAcionista->nome?></td>
					<td><?=$oAcionista->cpf?></td>
					<td><?=$oAcionista->email?></td>
					<td><?=Util::formataDataHoraBancoForm($oAcionista->dataHoraAlteracao)?></td>
					<td><?=$oAcionista->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editAcionista.php?idAcionista=<?=$oAcionista->idAcionista;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idAcionista','<?=$oAcionista->idAcionista;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="9"><a href="cadAcionista.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Acionista" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>