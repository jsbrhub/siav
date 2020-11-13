<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Incentivosexcel ========================= 
if($_POST){
    print ($oControle->cadastraIncentivosexcel()) ? "" : $oControle->msg; exit;
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
			<li><a href="admIncentivosexcel.php">Incentivosexcel</a></li>
			<li class="active">Cadastrar Incentivosexcel</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="sudam_numero">Sudam_numero</label>
	<input type="text" class="form-control" id="sudam_numero" name="sudam_numero" value="" />
</div>
<div class="form-group">
	<label for="empresa">Empresa</label>
	<input type="text" class="form-control" id="empresa" name="empresa" value="" />
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="" />
</div>
<div class="form-group">
	<label for="situacao">Situacao</label>
	<input type="text" class="form-control" id="situacao" name="situacao" value="" />
</div>
<div class="form-group">
	<label for="municipio">Municipio</label>
	<input type="text" class="form-control" id="municipio" name="municipio" value="" />
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
	<label for="mob_di">Mob_di</label>
	<input type="text" class="form-control" id="mob_di" name="mob_di" value="" />
</div>
<div class="form-group">
	<label for="mob_in">Mob_in</label>
	<input type="text" class="form-control" id="mob_in" name="mob_in" value="" />
</div>
<div class="form-group">
	<label for="mob_real">Mob_real</label>
	<input type="text" class="form-control" id="mob_real" name="mob_real" value="" />
</div>
<div class="form-group">
    <label for="objetivo">Objetivo</label>
    <textarea name="objetivo" class="form-control" id="objetivo" cols="80" rows="10"></textarea>
</div>
<div class="form-group">
	<label for="cap_instalada">Cap_instalada</label>
	<input type="text" class="form-control" id="cap_instalada" name="cap_instalada" value="" />
</div>
<div class="form-group">
	<label for="unidade">Unidade</label>
	<input type="text" class="form-control" id="unidade" name="unidade" value="" />
</div>
<div class="form-group">
	<label for="incentivo">Incentivo</label>
	<input type="text" class="form-control" id="incentivo" name="incentivo" value="" />
</div>
<div class="form-group">
	<label for="modalidade">Modalidade</label>
	<input type="text" class="form-control" id="modalidade" name="modalidade" value="" />
</div>
<div class="form-group">
	<label for="procurador">Procurador</label>
	<input type="text" class="form-control" id="procurador" name="procurador" value="" />
</div>
<div class="form-group">
	<label for="data_laudo">Data_laudo</label>
	<input type="text" class="form-control" id="data_laudo" name="data_laudo" value="" />
</div>
<div class="form-group">
	<label for="numero_laudo">Numero_laudo</label>
	<input type="text" class="form-control" id="numero_laudo" name="numero_laudo" value="" />
</div>
<div class="form-group">
	<label for="capital_fixo">Capital_fixo</label>
	<input type="text" class="form-control" id="capital_fixo" name="capital_fixo" value="" />
</div>
<div class="form-group">
	<label for="capital_giro">Capital_giro</label>
	<input type="text" class="form-control" id="capital_giro" name="capital_giro" value="" />
</div>
<div class="form-group">
	<label for="enq">Enq</label>
	<input type="text" class="form-control" id="enq" name="enq" value="" />
</div>
<div class="form-group">
	<label for="declaracao_data">Declaracao_data</label>
	<input type="text" class="form-control" id="declaracao_data" name="declaracao_data" value="" />
</div>
<div class="form-group">
	<label for="declaracao_numero">Declaracao_numero</label>
	<input type="text" class="form-control" id="declaracao_numero" name="declaracao_numero" value="" />
</div>
<div class="form-group">
	<label for="resolucao_data">Resolucao_data</label>
	<input type="text" class="form-control" id="resolucao_data" name="resolucao_data" value="" />
</div>
<div class="form-group">
	<label for="resolucao_numero">Resolucao_numero</label>
	<input type="text" class="form-control" id="resolucao_numero" name="resolucao_numero" value="" />
</div>
<div class="form-group">
	<label for="recursos_proprios">Recursos_proprios</label>
	<input type="text" class="form-control" id="recursos_proprios" name="recursos_proprios" value="" />
</div>
<div class="form-group">
	<label for="sudam_irpj">Sudam_irpj</label>
	<input type="text" class="form-control" id="sudam_irpj" name="sudam_irpj" value="" />
</div>
<div class="form-group">
	<label for="acionistas">Acionistas</label>
	<input type="text" class="form-control" id="acionistas" name="acionistas" value="" />
</div>
<div class="form-group">
	<label for="total">Total</label>
	<input type="text" class="form-control" id="total" name="total" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admIncentivosexcel.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Incentivosexcel" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>