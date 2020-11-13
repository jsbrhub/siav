<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Detalhearquivo ========================= 
if($_POST){
    print ($oControle->cadastraDetalhearquivo()) ? "" : $oControle->msg; exit;
}
$aArquivo = $oControle->getAllArquivo();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container">
		<?php 
		require_once("includes/titulo.php"); 
		require_once("includes/menu.php"); 
		?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li><a href="admDetalhearquivo.php">Detalhearquivo</a></li>
			<li class="active">Cadastrar Detalhearquivo</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idArquivo">Arquivo</label>
	<select name="idArquivo" id="idArquivo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aArquivo as $oArquivo){
	?>
		<option value="<?=$oArquivo->idArquivo?>"><?=$oArquivo->nomeArquivo?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="descricao">Descricao</label>
	<input type="text" class="form-control" id="descricao" name="descricao" value="" />
</div>
<div class="form-group">
	<label for="linha">Linha</label>
	<input type="text" class="form-control" id="linha" name="linha" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admDetalhearquivo.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Detalhearquivo" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>