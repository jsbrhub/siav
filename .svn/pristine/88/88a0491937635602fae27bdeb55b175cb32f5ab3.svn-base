<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aAutenticacaoempresa = $oControle->getAllAutenticacaoempresa();
//Util::trace($aAutenticacaoempresa);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiAutenticacaoempresa($_REQUEST['idAutenticacao'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="AutenticacaoempresaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Autenticacaoempresa</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aAutenticacaoempresa){
?>	
			<thead>
				<tr>
					<th>IdAutenticacao</th>
					<th>Cnpj</th>
					<th>Senha</th>
					<th>Email</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aAutenticacaoempresa as $oAutenticacaoempresa){
?>
				<tr>
					<td><?=$oAutenticacaoempresa->idAutenticacao?></td>
					<td><?=$oAutenticacaoempresa->cnpj?></td>
					<td><?=$oAutenticacaoempresa->senha?></td>
					<td><?=$oAutenticacaoempresa->email?></td>
					<td><a class="btn btn-success btn-sm" href="editAutenticacaoempresa.php?idAutenticacao=<?=$oAutenticacaoempresa->idAutenticacao;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idAutenticacao','<?=$oAutenticacaoempresa->idAutenticacao;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="6"><a href="cadAutenticacaoempresa.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Autenticacaoempresa" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>