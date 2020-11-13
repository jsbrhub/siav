<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aPoliticaambiental = $oControle->getAllPoliticaambiental();
//Util::trace($aPoliticaambiental);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiPoliticaambiental($_REQUEST['idPolitica'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="PoliticaambientalController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Politicaambiental</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aPoliticaambiental){
?>	
			<thead>
				<tr>
					<th>IdPolitica</th>
					<th>Empresa</th>
					<th>ResiduosGerados</th>
					<th>DescricaoTratamento</th>
					<th>QuantGerado</th>
					<th>UnidadeQg</th>
					<th>QuantTratado</th>
					<th>UnidadeQt</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aPoliticaambiental as $oPoliticaambiental){
?>
				<tr>
					<td><?=$oPoliticaambiental->idPolitica?></td>
					<td><?=$oPoliticaambiental->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oPoliticaambiental->residuosGerados?></td>
					<td><?=$oPoliticaambiental->descricaoTratamento?></td>
					<td><?=$oPoliticaambiental->quantGerado?></td>
					<td><?=$oPoliticaambiental->unidadeQg?></td>
					<td><?=$oPoliticaambiental->quantTratado?></td>
					<td><?=$oPoliticaambiental->unidadeQt?></td>
					<td><?=Util::formataDataHoraBancoForm($oPoliticaambiental->dataHoraAlteracao)?></td>
					<td><?=$oPoliticaambiental->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editPoliticaambiental.php?idPolitica=<?=$oPoliticaambiental->idPolitica;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idPolitica','<?=$oPoliticaambiental->idPolitica;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="12"><a href="cadPoliticaambiental.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Politicaambiental" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>