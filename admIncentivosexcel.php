<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aIncentivosexcel = $oControle->getAllIncentivosexcel();
//Util::trace($aIncentivosexcel);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiIncentivosexcel($_REQUEST['idincentivo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="IncentivosexcelController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Incentivosexcel</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aIncentivosexcel){
?>	
			<thead>
				<tr>
					<th>Idincentivo</th>
					<th>Sudam_numero</th>
					<th>Empresa</th>
					<th>Cnpj</th>
					<th>Situacao</th>
					<th>Municipio</th>
					<th>Uf</th>
					<th>Setor</th>
					<th>Mob_di</th>
					<th>Mob_in</th>
					<th>Mob_real</th>
					<th>Objetivo</th>
					<th>Cap_instalada</th>
					<th>Unidade</th>
					<th>Incentivo</th>
					<th>Modalidade</th>
					<th>Procurador</th>
					<th>Data_laudo</th>
					<th>Numero_laudo</th>
					<th>Capital_fixo</th>
					<th>Capital_giro</th>
					<th>Enq</th>
					<th>Declaracao_data</th>
					<th>Declaracao_numero</th>
					<th>Resolucao_data</th>
					<th>Resolucao_numero</th>
					<th>Recursos_proprios</th>
					<th>Sudam_irpj</th>
					<th>Acionistas</th>
					<th>Total</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aIncentivosexcel as $oIncentivosexcel){
?>
				<tr>
					<td><?=$oIncentivosexcel->idincentivo?></td>
					<td><?=$oIncentivosexcel->sudam_numero?></td>
					<td><?=$oIncentivosexcel->empresa?></td>
					<td><?=$oIncentivosexcel->cnpj?></td>
					<td><?=$oIncentivosexcel->situacao?></td>
					<td><?=$oIncentivosexcel->municipio?></td>
					<td><?=$oIncentivosexcel->uf?></td>
					<td><?=$oIncentivosexcel->setor?></td>
					<td><?=$oIncentivosexcel->mob_di?></td>
					<td><?=$oIncentivosexcel->mob_in?></td>
					<td><?=$oIncentivosexcel->mob_real?></td>
					<td><?=$oIncentivosexcel->objetivo?></td>
					<td><?=$oIncentivosexcel->cap_instalada?></td>
					<td><?=$oIncentivosexcel->unidade?></td>
					<td><?=$oIncentivosexcel->incentivo?></td>
					<td><?=$oIncentivosexcel->modalidade?></td>
					<td><?=$oIncentivosexcel->procurador?></td>
					<td><?=$oIncentivosexcel->data_laudo?></td>
					<td><?=$oIncentivosexcel->numero_laudo?></td>
					<td><?=$oIncentivosexcel->capital_fixo?></td>
					<td><?=$oIncentivosexcel->capital_giro?></td>
					<td><?=$oIncentivosexcel->enq?></td>
					<td><?=$oIncentivosexcel->declaracao_data?></td>
					<td><?=$oIncentivosexcel->declaracao_numero?></td>
					<td><?=$oIncentivosexcel->resolucao_data?></td>
					<td><?=$oIncentivosexcel->resolucao_numero?></td>
					<td><?=$oIncentivosexcel->recursos_proprios?></td>
					<td><?=$oIncentivosexcel->sudam_irpj?></td>
					<td><?=$oIncentivosexcel->acionistas?></td>
					<td><?=$oIncentivosexcel->total?></td>
					<td><a class="btn btn-success btn-sm" href="editIncentivosexcel.php?idincentivo=<?=$oIncentivosexcel->idincentivo;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idincentivo','<?=$oIncentivosexcel->idincentivo;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="32" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="32"><a href="cadIncentivosexcel.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Incentivosexcel" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>