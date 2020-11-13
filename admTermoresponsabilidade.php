<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aTermoresponsabilidade = $oControle->getAllTermoresponsabilidade();
//Util::trace($aTermoresponsabilidade);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiTermoresponsabilidade($_REQUEST['idTermo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="TermoresponsabilidadeController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Termoresponsabilidade</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aTermoresponsabilidade){
?>	
			<thead>
				<tr>
					<th>IdTermo</th>
					<th>Campanha</th>
					<th>Empresa</th>
					<th>Cnpj</th>
					<th>Comprovante</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aTermoresponsabilidade as $oTermoresponsabilidade){
?>
				<tr>
					<td><?=$oTermoresponsabilidade->idTermo?></td>
					<td><?=$oTermoresponsabilidade->oCampanha->usuarioAlteracao?></td>
					<td><?=$oTermoresponsabilidade->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oTermoresponsabilidade->cnpj?></td>
					<td><?=$oTermoresponsabilidade->comprovante?></td>
					<td><?=Util::formataDataBancoForm($oTermoresponsabilidade->dataHoraAlteracao)?></td>
					<td><?=$oTermoresponsabilidade->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editTermoresponsabilidade.php?idTermo=<?=$oTermoresponsabilidade->idTermo;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idTermo','<?=$oTermoresponsabilidade->idTermo;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="9"><a href="cadTermoresponsabilidade.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Termoresponsabilidade" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>