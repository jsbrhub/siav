<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Modalidade ========================= 
if($_POST){
    print ($oControle->cadastraModalidade()) ? "" : $oControle->msg; exit;
}
$aIncentivos = $oControle->getAllIncentivos();
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
			<li><a href="admModalidade.php">Modalidade</a></li>
			<li class="active">Cadastrar Modalidade</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idIncentivo">Incentivos</label>
	<select name="idIncentivo" id="idIncentivo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aIncentivos as $oIncentivos){
	?>
		<option value="<?=$oIncentivos->idIncentivo?>"><?=$oIncentivos->idIncentivo?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="descricao">Descricao</label>
	<input type="text" class="form-control" id="descricao" name="descricao" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admModalidade.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Modalidade" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>