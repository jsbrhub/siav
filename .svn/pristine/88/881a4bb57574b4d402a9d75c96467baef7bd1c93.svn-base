<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Atodeclaratorio ========================= 
if($_POST){
    print ($oControle->cadastraAtodeclaratorio()) ? "" : $oControle->msg; exit;
}
$aIncentivoempresa = $oControle->getAllIncentivoempresa();
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
			<li><a href="admAtodeclaratorio.php">Atodeclaratorio</a></li>
			<li class="active">Cadastrar Atodeclaratorio</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idIncentivoEmpresa">Incentivoempresa</label>
	<select name="idIncentivoEmpresa" id="idIncentivoEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aIncentivoempresa as $oIncentivoempresa){
	?>
		<option value="<?=$oIncentivoempresa->idIncentivoEmpresa?>"><?=$oIncentivoempresa->unidadeDescricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="nomeArquivo">NomeArquivo</label>
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', NULL, NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admAtodeclaratorio.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Atodeclaratorio" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>