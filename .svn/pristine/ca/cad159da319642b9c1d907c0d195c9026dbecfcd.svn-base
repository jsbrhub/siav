<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aArquivo = $oControle->getAllArquivo();
//Util::trace($aArquivo);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiArquivo($_REQUEST['idArquivo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ArquivoController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped font-12">
<?php
if($aArquivo){
?>	
			<thead>
				<tr>
					<th>IdArquivo</th>
					<th>NomeArquivo</th>
					<th>NovoNome</th>
					<th>DataImportacao</th>
					<th>Situacao</th>
					<th>Status</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aArquivo as $oArquivo){
?>
				<tr>
					<td><?=$oArquivo->idArquivo?></td>
					<td><?=$oArquivo->nomeArquivo?></td>
					<td><?=$oArquivo->novoNome?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivo->dataImportacao)?></td>
					<td><?=$oArquivo->situacao?></td>
					<td><?=$oArquivo->status?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivo->dataHoraAlteracao)?></td>
					<td><?=$oArquivo->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editArquivo.php?idArquivo=<?=$oArquivo->idArquivo;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idArquivo','<?=$oArquivo->idArquivo;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="10"><a href="cadArquivo.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Arquivo" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>