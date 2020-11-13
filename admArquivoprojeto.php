<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aArquivoprojeto = $oControle->getAllArquivoprojeto();
//Util::trace($aArquivoprojeto);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiArquivoprojeto($_REQUEST['idArquivoProj'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ArquivoprojetoController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Arquivoprojeto</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aArquivoprojeto){
?>	
			<thead>
				<tr>
					<th>IdArquivoProj</th>
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
	foreach($aArquivoprojeto as $oArquivoprojeto){
?>
				<tr>
					<td><?=$oArquivoprojeto->idArquivoProj?></td>
					<td><?=$oArquivoprojeto->nomeArquivo?></td>
					<td><?=$oArquivoprojeto->novoNome?></td>
					<td><?=$oArquivoprojeto->link?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivoprojeto->dataHoraAlteracao)?></td>
					<td><?=$oArquivoprojeto->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editArquivoprojeto.php?idArquivoProj=<?=$oArquivoprojeto->idArquivoProj;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idArquivoProj','<?=$oArquivoprojeto->idArquivoProj;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="8"><a href="cadArquivoprojeto.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Arquivoprojeto" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>