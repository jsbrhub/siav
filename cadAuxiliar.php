<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Auxiliar ========================= 
if($_POST){
    print ($oControle->cadastraAuxiliar()) ? "" : $oControle->msg; exit;
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
			<li><a href="admAuxiliar.php">Auxiliar</a></li>
			<li class="active">Cadastrar Auxiliar</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="" />
</div>
<div class="form-group">
	<label for="empresa">Empresa</label>
	<input type="text" class="form-control" id="empresa" name="empresa" value="" />
</div>
<div class="form-group">
    <label for="emailEmpresa">emailEmpresa</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="emailEmpresa" id="emailEmpresa" value="" />
    </div>
</div>
<div class="form-group">
	<label for="municipio">Municipio</label>
	<input type="text" class="form-control" id="municipio" name="municipio" value="" />
</div>
<div class="form-group">
	<label for="tipologia">Tipologia</label>
	<input type="text" class="form-control" id="tipologia" name="tipologia" value="" />
</div>
<div class="form-group">
	<label for="uf">Uf</label>
	<input type="text" class="form-control" id="uf" name="uf" value="" />
</div>
<div class="form-group">
	<label for="setor">Setor</label>
	<input type="text" class="form-control" id="setor" name="setor" value="" />
</div>
<div class="form-group">
	<label for="tipoIncentivo">TipoIncentivo</label>
	<input type="text" class="form-control" id="tipoIncentivo" name="tipoIncentivo" value="" />
</div>
<div class="form-group">
	<label for="motivoIncentivo">MotivoIncentivo</label>
	<input type="text" class="form-control" id="motivoIncentivo" name="motivoIncentivo" value="" />
</div>
<div class="form-group">
    <label for="atividadeIncentivada">AtividadeIncentivada</label>
    <textarea name="atividadeIncentivada" class="form-control" id="atividadeIncentivada" cols="80" rows="10"></textarea>
</div>
<div class="form-group">
	<label for="anoAprovacao">AnoAprovacao</label>
	<input type="text" class="form-control" id="anoAprovacao" name="anoAprovacao" value="" />
</div>
<div class="form-group">
	<label for="capitalFixo">CapitalFixo</label>
	<input type="text" class="form-control" id="capitalFixo" name="capitalFixo" value="" />
</div>
<div class="form-group">
	<label for="capitalGiro">CapitalGiro</label>
	<input type="text" class="form-control" id="capitalGiro" name="capitalGiro" value="" />
</div>
<div class="form-group">
	<label for="moDir">MoDir</label>
	<input type="text" class="form-control" id="moDir" name="moDir" value="" />
</div>
<div class="form-group">
	<label for="moInd">MoInd</label>
	<input type="text" class="form-control" id="moInd" name="moInd" value="" />
</div>
<div class="form-group">
	<label for="moReal">MoReal</label>
	<input type="text" class="form-control" id="moReal" name="moReal" value="" />
</div>
<div class="form-group">
	<label for="enq">Enq</label>
	<input type="text" class="form-control" id="enq" name="enq" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admAuxiliar.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Auxiliar" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>