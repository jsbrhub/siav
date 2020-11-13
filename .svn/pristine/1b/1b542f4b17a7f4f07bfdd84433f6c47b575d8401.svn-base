<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Empresacampanha ========================= 
if($_POST){
    print ($oControle->cadastraEmpresacampanha()) ? "" : $oControle->msg; exit;
}
$aCampanha = $oControle->getAllCampanha();
$aEmpresa = $oControle->getAllEmpresa();
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
			<li><a href="admEmpresacampanha.php">Empresacampanha</a></li>
			<li class="active">Cadastrar Empresacampanha</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idCampanha">Campanha</label>
	<select name="idCampanha" id="idCampanha" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aCampanha as $oCampanha){
	?>
		<option value="<?=$oCampanha->idCampanha?>"><?=$oCampanha->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idEmpresa">Empresa</label>
	<select name="idEmpresa" id="idEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aEmpresa as $oEmpresa){
	?>
		<option value="<?=$oEmpresa->idEmpresa?>"><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admEmpresacampanha.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Empresacampanha" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>