<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Historicoretificacao ========================= 
if($_POST){
    print ($oControle->cadastraHistoricoretificacao()) ? "" : $oControle->msg; exit;
}
$aRetificacaoempresa = $oControle->getAllRetificacaoempresa();
$aRetificacaosudam = $oControle->getAllRetificacaosudam();
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
			<li><a href="admHistoricoretificacao.php">Historicoretificacao</a></li>
			<li class="active">Cadastrar Historicoretificacao</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idRetEmpresa">Retificacaoempresa</label>
	<select name="idRetEmpresa" id="idRetEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aRetificacaoempresa as $oRetificacaoempresa){
	?>
		<option value="<?=$oRetificacaoempresa->idRetEmpresa?>"><?=$oRetificacaoempresa->usuarioSolicitacao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idRetSudam">Retificacaosudam</label>
	<select name="idRetSudam" id="idRetSudam" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aRetificacaosudam as $oRetificacaosudam){
	?>
		<option value="<?=$oRetificacaosudam->idRetSudam?>"><?=$oRetificacaosudam->usuarioAlteracao?></option>
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
<div class="form-group">
	<label for="idEmpresaRet">IdEmpresaRet</label>
	<input type="text" class="form-control" id="idEmpresaRet" name="idEmpresaRet" value="" />
</div>
<div class="form-group">
	<label for="anoBase">AnoBase</label>
	<input type="text" class="form-control" id="anoBase" name="anoBase" value="" />
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="" />
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="" />
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
						<a class="btn btn-default" href="admHistoricoretificacao.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Historicoretificacao" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>