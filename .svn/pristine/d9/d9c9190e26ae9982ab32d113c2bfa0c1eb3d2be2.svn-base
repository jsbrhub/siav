<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Autenticacaoempresa ========================= 
if($_POST){
    print ($oControle->cadastraAutenticacaoempresa()) ? "" : $oControle->msg; exit;
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
			<li><a href="admAutenticacaoempresa.php">Autenticacaoempresa</a></li>
			<li class="active">Cadastrar Autenticacaoempresa</li>
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
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" value="" />
</div>
<div class="form-group">
    <label for="email">email</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="email" id="email" value="" />
    </div>
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admAutenticacaoempresa.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Autenticacaoempresa" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>