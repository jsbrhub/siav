<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Municipio ========================= 
if($_POST){
    print ($oControle->cadastraMunicipio()) ? "" : $oControle->msg; exit;
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
			<li><a href="admMunicipio.php">Municipio</a></li>
			<li class="active">Cadastrar Municipio</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
    <label for="regiao">Regiao</label>
    <select name="regiao" id="regiao" class="form-control">
        <option value="Norte">Norte</option><option value="Nordeste">Nordeste</option><option value="Centro-Oeste">Centro-Oeste</option><option value="Sudeste">Sudeste</option>
    </select>
</div>
<div class="form-group">
	<label for="uf">Uf</label>
	<input type="text" class="form-control" id="uf" name="uf" value="" />
</div>
<div class="form-group">
	<label for="municipio"></label>
	<input type="text" class="form-control" id="municipio" name="municipio" value="" />
</div>
<div class="form-group">
	<label for="microregiao">Microregiao</label>
	<input type="text" class="form-control" id="microregiao" name="microregiao" value="" />
</div>
<div class="form-group">
    <label for="tipologia">Tipologia</label>
    <select name="tipologia" id="tipologia" class="form-control">
        <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
    </select>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admMunicipio.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Municipio" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>