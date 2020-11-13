<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aProjsocioambiental = $oControle->getAllProjsocioambiental();
//Util::trace($aProjsocioambiental);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiProjsocioambiental($_REQUEST['idProjeto'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ProjsocioambientalController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Projsocioambiental</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aProjsocioambiental){
?>	
			<thead>
				<tr>
					<th>IdProjeto</th>
					<th>Empresa</th>
					<th>NomeProjeto</th>
					<th>DescricaoAtividade</th>
					<th>TotalDespesas</th>
					<th>QuantidadePessoas</th>
					<th>Observacoes</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aProjsocioambiental as $oProjsocioambiental){
?>
				<tr>
					<td><?=$oProjsocioambiental->idProjeto?></td>
					<td><?=$oProjsocioambiental->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oProjsocioambiental->nomeProjeto?></td>
					<td><?=$oProjsocioambiental->descricaoAtividade?></td>
					<td><?=$oProjsocioambiental->totalDespesas?></td>
					<td><?=$oProjsocioambiental->quantidadePessoas?></td>
					<td><?=$oProjsocioambiental->observacoes?></td>
					<td><?=Util::formataDataHoraBancoForm($oProjsocioambiental->dataHoraAlteracao)?></td>
					<td><?=$oProjsocioambiental->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editProjsocioambiental.php?idProjeto=<?=$oProjsocioambiental->idProjeto;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idProjeto','<?=$oProjsocioambiental->idProjeto;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="11" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="11"><a href="cadProjsocioambiental.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Projsocioambiental" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>