<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aArquivoretificacao = $oControle->getAllArquivoretificacao();
//Util::trace($aArquivoretificacao);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiArquivoretificacao($_REQUEST['idArqRet'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ArquivoretificacaoController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Arquivoretificacao</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-striped">
<?php
if($aArquivoretificacao){
?>	
			<thead>
				<tr>
					<th>IdArqRet</th>
					<th>Retificacaoempresa</th>
					<th>Cnpj</th>
					<th>NomeArquivo</th>
					<th>NovoNome</th>
					<th>Link</th>
					<th>DataHoraAlteracao</th>
					<th>UsuarioAlteracao</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aArquivoretificacao as $oArquivoretificacao){
?>
				<tr>
					<td><?=$oArquivoretificacao->idArqRet?></td>
					<td><?=$oArquivoretificacao->oRetificacaoempresa->usuarioSolicitacao?></td>
					<td><?=$oArquivoretificacao->cnpj?></td>
					<td><?=$oArquivoretificacao->nomeArquivo?></td>
					<td><?=$oArquivoretificacao->novoNome?></td>
					<td><?=$oArquivoretificacao->link?></td>
					<td><?=Util::formataDataHoraBancoForm($oArquivoretificacao->dataHoraAlteracao)?></td>
					<td><?=$oArquivoretificacao->usuarioAlteracao?></td>
					<td><a class="btn btn-success btn-sm" href="editArquivoretificacao.php?idArqRet=<?=$oArquivoretificacao->idArqRet;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idArqRet','<?=$oArquivoretificacao->idArqRet;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="10" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>
				<tr>
					<td colspan="10"><a href="cadArquivoretificacao.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Arquivoretificacao" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>