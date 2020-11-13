<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aArquivoempresa = $oControle->getAllArquivoempresa();
//Util::trace($aArquivoempresa);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiArquivoempresa($_REQUEST['idArquivoEmpresa'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ArquivoempresaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Arquivoempresa</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aArquivoempresa){
?>	
			<thead>
				<tr>
					<th>IdArquivoEmpresa</th>
					<th>Empresa</th>
					<th>Tipoarquivo</th>
					<th>NomeArquivo</th>
					<th>NovoNome</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aArquivoempresa as $oArquivoempresa){
?>
				<tr>
					<td><?=$oArquivoempresa->idArquivoEmpresa?></td>
					<td><?=$oArquivoempresa->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oArquivoempresa->oTipoarquivo->idTipoArquivo?></td>
					<td><?=$oArquivoempresa->nomeArquivo?></td>
					<td><?=$oArquivoempresa->novoNome?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivoempresa->dataHoraAlteracao)?></td>
					<td><?=$oArquivoempresa->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editArquivoempresa.php?idArquivoEmpresa=<?=$oArquivoempresa->idArquivoEmpresa;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idArquivoEmpresa','<?=$oArquivoempresa->idArquivoEmpresa;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="9"><a href="cadArquivoempresa.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Arquivoempresa" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>