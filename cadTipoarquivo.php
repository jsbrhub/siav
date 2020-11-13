<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Tipoarquivo ========================= 
if($_POST){
    print ($oControle->cadastraTipoarquivo()) ? "" : $oControle->msg; exit;
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
			<li><a href="admTipoarquivo.php">Tipoarquivo</a></li>
			<li class="active">Cadastrar Tipoarquivo</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="tipo">Tipo</label>
	<input type="text" class="form-control" id="tipo" name="tipo" value="" />
</div>
<div class="form-group">
	<label for="formato">Formato</label>
	<input type="text" class="form-control" id="formato" name="formato" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admTipoarquivo.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Tipoarquivo" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>