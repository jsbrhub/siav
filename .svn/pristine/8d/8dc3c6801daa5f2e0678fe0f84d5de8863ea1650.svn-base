<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aDetalhearquivo = $oControle->listaDetalhesByArquivo($_REQUEST['idArquivo']);
//Util::trace($aDetalhearquivo,false);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiDetalhearquivo($_REQUEST['idDetalheArquivo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body style="margin: 0 !important; padding: 0;" class="bg-grey">
	<?php // require_once("includes/modals.php");?>
	<div class="container" ng-controller="DetalhearquivoController">


		<table class="table table-striped font-12 grey">
<?php
if($aDetalhearquivo){
?>	
			<thead>
				<tr>
                    <th>Linha</th>
					<th>Arquivo</th>
					<th>Descricao</th>


				</tr>
			</thead>
			<tbody>
<?php
	foreach($aDetalhearquivo as $oDetalhearquivo){
?>
				<tr>
                    <td><?=$oDetalhearquivo->linha?></td>
					<td><?=$oDetalhearquivo->oArquivo->nomeArquivo?></td>
					<td><?=$oDetalhearquivo->descricao?></td>

				</tr>
<?php
	}
}
else{
?>
				<tr>
					<td colspan="6" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
				</tr>
<?php
}
?>

			</tbody>
		</table>

	</div>

</body>
</html>