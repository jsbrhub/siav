<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aAlerta = $oControle->getAllAlerta();
//Util::trace($aAlerta);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiAlerta($_REQUEST['idAlerta'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="AlertaController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Alerta</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aAlerta){
?>	
			<thead>
				<tr>
					<th>IdAlerta</th>
					<th>Campanha</th>
					<th>Assunto</th>
					<th>Texto</th>
					<th>TipoSelecao</th>
					<th>TotalEmpresas</th>
					<th>Situacao</th>
					<th>UsuarioAlteracao</th>
					<th>DataHoraAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aAlerta as $oAlerta){
?>
				<tr>
					<td><?=$oAlerta->idAlerta?></td>
					<td><?=$oAlerta->oCampanha->usuarioAlteracao?></td>
					<td><?=$oAlerta->assunto?></td>
					<td><?=$oAlerta->texto?></td>
					<td><?=$oAlerta->tipoSelecao?></td>
					<td><?=$oAlerta->totalEmpresas?></td>
					<td><?=$oAlerta->situacao?></td>
					<td><?=$oAlerta->usuarioAlteracao?></td>
					<td><?=Util::formataDataHoraBancoForm($oAlerta->dataHoraAlteracao)?></td>
					<td><a class="btn btn-success btn-sm" href="editAlerta.php?idAlerta=<?=$oAlerta->idAlerta;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idAlerta','<?=$oAlerta->idAlerta;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
					<td colspan="11"><a href="cadAlerta.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Alerta" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>