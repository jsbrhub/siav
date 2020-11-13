<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aMercadoconsumidor = $oControle->getAllMercadoconsumidor();
//Util::trace($aMercadoconsumidor);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiMercadoconsumidor($_REQUEST['idMercado'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="MercadoconsumidorController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Mercadoconsumidor</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aMercadoconsumidor){
?>	
			<thead>
				<tr>
					<th>IdMercado</th>
					<th>Incentivoempresa</th>
					<th>QuantidadeRegional</th>
					<th>ValorRegional</th>
					<th>QuantidadeNacional</th>
					<th>ValorNacional</th>
					<th>QuantidadeExterior</th>
					<th>ValorExterior</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aMercadoconsumidor as $oMercadoconsumidor){
?>
				<tr>
					<td><?=$oMercadoconsumidor->idMercado?></td>
					<td><?=$oMercadoconsumidor->oIncentivoempresa->unidadeDescricao?></td>
					<td><?=$oMercadoconsumidor->quantidadeRegional?></td>
					<td><?=$oMercadoconsumidor->valorRegional?></td>
					<td><?=$oMercadoconsumidor->quantidadeNacional?></td>
					<td><?=$oMercadoconsumidor->valorNacional?></td>
					<td><?=$oMercadoconsumidor->quantidadeExterior?></td>
					<td><?=$oMercadoconsumidor->valorExterior?></td>
					<td><?=Util::formataDataHoraBancoForm($oMercadoconsumidor->dataHoraAlteracao)?></td>
					<td><?=$oMercadoconsumidor->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editMercadoconsumidor.php?idMercado=<?=$oMercadoconsumidor->idMercado;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idMercado','<?=$oMercadoconsumidor->idMercado;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="12" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="12"><a href="cadMercadoconsumidor.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Mercadoconsumidor" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>