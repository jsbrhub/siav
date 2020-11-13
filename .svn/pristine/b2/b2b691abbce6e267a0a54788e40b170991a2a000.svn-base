<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aArquivopolitica = $oControle->getAllArquivopolitica();
//Util::trace($aArquivopolitica);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiArquivopolitica($_REQUEST['idArquivoPol'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ArquivopoliticaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Arquivopolitica</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aArquivopolitica){
?>	
			<thead>
				<tr>
					<th>IdArquivoPol</th>
					<th>NomeArquivo</th>
					<th>NovoNome</th>
					<th>Link</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aArquivopolitica as $oArquivopolitica){
?>
				<tr>
					<td><?=$oArquivopolitica->idArquivoPol?></td>
					<td><?=$oArquivopolitica->nomeArquivo?></td>
					<td><?=$oArquivopolitica->novoNome?></td>
					<td><?=$oArquivopolitica->link?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivopolitica->dataHoraAlteracao)?></td>
					<td><?=$oArquivopolitica->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editArquivopolitica.php?idArquivoPol=<?=$oArquivopolitica->idArquivoPol;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idArquivoPol','<?=$oArquivopolitica->idArquivoPol;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="8"><a href="cadArquivopolitica.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Arquivopolitica" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>