<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Unidademedida ========================= 
if($_POST){
    print ($oControle->cadastraUnidademedida()) ? "" : $oControle->msg; exit;
}

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
			<li><a href="admUnidademedida.php">Unidademedida</a></li>
			<li class="active">Cadastrar Unidademedida</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="nome">Nome</label>
	<input type="text" class="form-control" id="nome" name="nome" value="" />
</div>
<div class="form-group">
	<label for="sigla">Sigla</label>
	<input type="text" class="form-control" id="sigla" name="sigla" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admUnidademedida.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Unidademedida" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>