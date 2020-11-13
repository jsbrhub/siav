<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Arquivoretificacao ========================= 
if($_POST){
    print ($oControle->cadastraArquivoretificacao()) ? "" : $oControle->msg; exit;
}
$aRetificacaoempresa = $oControle->getAllRetificacaoempresa();
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
			<li><a href="admArquivoretificacao.php">Arquivoretificacao</a></li>
			<li class="active">Cadastrar Arquivoretificacao</li>
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
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="" />
</div>
<div class="form-group">
	<label for="nomeArquivo">NomeArquivo</label>
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="" />
</div>
<div class="form-group">
    <label for="link">link</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
        <input type="url" class="form-control" name="link" id="link" value="" />
    </div>
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
						<a class="btn btn-default" href="admArquivoretificacao.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Arquivoretificacao" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>