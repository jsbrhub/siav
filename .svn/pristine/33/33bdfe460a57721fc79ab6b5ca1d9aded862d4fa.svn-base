<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aContatoempresa = $oControle->getAllContatoempresa();
//Util::trace($aContatoempresa);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiContatoempresa($_REQUEST['idContatoEmpresa'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ContatoempresaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Contatoempresa</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aContatoempresa){
?>	
			<thead>
				<tr>
					<th>IdContatoEmpresa</th>
					<th>Empresa</th>
					<th>Contato</th>
					<th>Funcao</th>
					<th>Email</th>
					<th>Telefone</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aContatoempresa as $oContatoempresa){
?>
				<tr>
					<td><?=$oContatoempresa->idContatoEmpresa?></td>
					<td><?=$oContatoempresa->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oContatoempresa->contato?></td>
					<td><?=$oContatoempresa->funcao?></td>
					<td><?=$oContatoempresa->email?></td>
					<td><?=$oContatoempresa->telefone?></td>
					<td><?=Util::formataDataHoraBancoForm($oContatoempresa->dataHoraAlteracao)?></td>
					<td><?=$oContatoempresa->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editContatoempresa.php?idContatoEmpresa=<?=$oContatoempresa->idContatoEmpresa;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idContatoEmpresa','<?=$oContatoempresa->idContatoEmpresa;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="10" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="10"><a href="cadContatoempresa.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Contatoempresa" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>