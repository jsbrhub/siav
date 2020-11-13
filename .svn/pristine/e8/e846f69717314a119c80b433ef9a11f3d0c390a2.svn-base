<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aAtodeclaratorio = $oControle->getAllAtodeclaratorio();
//Util::trace($aAtodeclaratorio);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiAtodeclaratorio($_REQUEST['idAtoDeclaratorio'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="AtodeclaratorioController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Atodeclaratorio</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aAtodeclaratorio){
?>	
			<thead>
				<tr>
					<th>IdAtoDeclaratorio</th>
					<th>Incentivoempresa</th>
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
	foreach($aAtodeclaratorio as $oAtodeclaratorio){
?>
				<tr>
					<td><?=$oAtodeclaratorio->idAtoDeclaratorio?></td>
					<td><?=$oAtodeclaratorio->oIncentivoempresa->unidadeDescricao?></td>
					<td><?=$oAtodeclaratorio->nomeArquivo?></td>
					<td><?=$oAtodeclaratorio->novoNome?></td>
					<td><?=Util::formataDataHoraBancoForm($oAtodeclaratorio->dataHoraAlteracao)?></td>
					<td><?=$oAtodeclaratorio->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editAtodeclaratorio.php?idAtoDeclaratorio=<?=$oAtodeclaratorio->idAtoDeclaratorio;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idAtoDeclaratorio','<?=$oAtodeclaratorio->idAtoDeclaratorio;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="8"><a href="cadAtodeclaratorio.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Atodeclaratorio" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>