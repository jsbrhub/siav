<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aAuxiliar = $oControle->getAllAuxiliar();
//Util::trace($aAuxiliar);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiAuxiliar($_REQUEST['idAuxiliar'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="AuxiliarController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Auxiliar</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aAuxiliar){
?>	
			<thead>
				<tr>
					<th>IdAuxiliar</th>
					<th>Cnpj</th>
					<th>Empresa</th>
					<th>EmailEmpresa</th>
					<th>Municipio</th>
					<th>Tipologia</th>
					<th>Uf</th>
					<th>Setor</th>
					<th>TipoIncentivo</th>
					<th>MotivoIncentivo</th>
					<th>AtividadeIncentivada</th>
					<th>AnoAprovacao</th>
					<th>CapitalFixo</th>
					<th>CapitalGiro</th>
					<th>MoDir</th>
					<th>MoInd</th>
					<th>MoReal</th>
					<th>Enq</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aAuxiliar as $oAuxiliar){
?>
				<tr>
					<td><?=$oAuxiliar->idAuxiliar?></td>
					<td><?=$oAuxiliar->cnpj?></td>
					<td><?=$oAuxiliar->empresa?></td>
					<td><?=$oAuxiliar->emailEmpresa?></td>
					<td><?=$oAuxiliar->municipio?></td>
					<td><?=$oAuxiliar->tipologia?></td>
					<td><?=$oAuxiliar->uf?></td>
					<td><?=$oAuxiliar->setor?></td>
					<td><?=$oAuxiliar->tipoIncentivo?></td>
					<td><?=$oAuxiliar->motivoIncentivo?></td>
					<td><?=$oAuxiliar->atividadeIncentivada?></td>
					<td><?=$oAuxiliar->anoAprovacao?></td>
					<td><?=$oAuxiliar->capitalFixo?></td>
					<td><?=$oAuxiliar->capitalGiro?></td>
					<td><?=$oAuxiliar->moDir?></td>
					<td><?=$oAuxiliar->moInd?></td>
					<td><?=$oAuxiliar->moReal?></td>
					<td><?=$oAuxiliar->enq?></td>
					<td><a class="btn btn-success btn-sm" href="editAuxiliar.php?idAuxiliar=<?=$oAuxiliar->idAuxiliar;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idAuxiliar','<?=$oAuxiliar->idAuxiliar;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="20" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="20"><a href="cadAuxiliar.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Auxiliar" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>