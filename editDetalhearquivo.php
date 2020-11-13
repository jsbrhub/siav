<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Detalhearquivo ========================= 
if($_POST){
	print ($oControle->alteraDetalhearquivo()) ? "" : $oControle->msg; exit;
}

$oDetalhearquivo = $oControle->getDetalhearquivo($_REQUEST['idDetalheArquivo']);
$aArquivo = $oControle->getAllArquivo();
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
            <li><a href="admDetalhearquivo.php">Detalhearquivo</a></li>
            <li class="active">Editar Detalhearquivo</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idArquivo">Arquivo</label>
	<select name="idArquivo" id="idArquivo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aArquivo as $oArquivo){
	?>
		<option value="<?=$oArquivo->idArquivo?>"<?=($oArquivo->idArquivo == $oDetalhearquivo->oArquivo->idArquivo) ? " selected" : ""?>><?=$oArquivo->nomeArquivo?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="descricao">Descricao</label>
	<input type="text" class="form-control" id="descricao" name="descricao" value="<?=$oDetalhearquivo->descricao?>" />
</div>
<div class="form-group">
	<label for="linha">Linha</label>
	<input type="text" class="form-control" id="linha" name="linha" value="<?=$oDetalhearquivo->linha?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admDetalhearquivo.php">Voltar</a>
                        <input name="idDetalheArquivo" type="hidden" id="idDetalheArquivo" value="<?=$_REQUEST['idDetalheArquivo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Detalhearquivo" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>