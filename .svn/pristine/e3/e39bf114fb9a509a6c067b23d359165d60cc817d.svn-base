<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aIncentivoempresa = $oControle->getAllIncentivoempresa();
//Util::trace($aIncentivoempresa);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiIncentivoempresa($_REQUEST['idIncentivoEmpresa'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="IncentivoempresaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Incentivoempresa</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aIncentivoempresa){
?>	
			<thead>
				<tr>
					<th>IdIncentivoEmpresa</th>
					<th>Empresa</th>
					<th>ProdutoIncentivado</th>
					<th>FonteOrigem</th>
					<th>Cnpj</th>
					<th>Cnae</th>
					<th>Faturamento</th>
					<th>Emprego</th>
					<th>Producao</th>
					<th>IdUnidadeProducao</th>
					<th>CapacidadeInstalada</th>
					<th>UnidadeDescricao</th>
					<th>IdUnidadeCapacidade</th>
					<th>Ano</th>
					<th>Vigente</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aIncentivoempresa as $oIncentivoempresa){
?>
				<tr>
					<td><?=$oIncentivoempresa->idIncentivoEmpresa?></td>
					<td><?=$oIncentivoempresa->oEmpresa->usuarioAlteracao?></td>
					<td><?=$oIncentivoempresa->produtoIncentivado?></td>
					<td><?=$oIncentivoempresa->fonteOrigem?></td>
					<td><?=$oIncentivoempresa->cnpj?></td>
					<td><?=$oIncentivoempresa->cnae?></td>
					<td><?=$oIncentivoempresa->faturamento?></td>
					<td><?=$oIncentivoempresa->emprego?></td>
					<td><?=$oIncentivoempresa->producao?></td>
					<td><?=$oIncentivoempresa->idUnidadeProducao?></td>
					<td><?=$oIncentivoempresa->capacidadeInstalada?></td>
					<td><?=$oIncentivoempresa->unidadeDescricao?></td>
					<td><?=$oIncentivoempresa->idUnidadeCapacidade?></td>
					<td><?=$oIncentivoempresa->ano?></td>
					<td><?=$oIncentivoempresa->vigente?></td>
					<td><?=Util::formataDataHoraBancoForm($oIncentivoempresa->dataHoraAlteracao)?></td>
					<td><?=$oIncentivoempresa->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editIncentivoempresa.php?idIncentivoEmpresa=<?=$oIncentivoempresa->idIncentivoEmpresa;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idIncentivoEmpresa','<?=$oIncentivoempresa->idIncentivoEmpresa;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="19" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="19"><a href="cadIncentivoempresa.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Incentivoempresa" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>