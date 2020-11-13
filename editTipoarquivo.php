<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Tipoarquivo ========================= 
if($_POST){
	print ($oControle->alteraTipoarquivo()) ? "" : $oControle->msg; exit;
}

$oTipoarquivo = $oControle->getTipoarquivo($_REQUEST['idTipoArquivo']);

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
            <li><a href="admTipoarquivo.php">Tipoarquivo</a></li>
            <li class="active">Editar Tipoarquivo</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="tipo">Tipo</label>
	<input type="text" class="form-control" id="tipo" name="tipo" value="<?=$oTipoarquivo->tipo?>" />
</div>
<div class="form-group">
	<label for="formato">Formato</label>
	<input type="text" class="form-control" id="formato" name="formato" value="<?=$oTipoarquivo->formato?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admTipoarquivo.php">Voltar</a>
                        <input name="idTipoArquivo" type="hidden" id="idTipoArquivo" value="<?=$_REQUEST['idTipoArquivo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Tipoarquivo" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>