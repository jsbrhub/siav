<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Situacao ========================= 
if($_POST){
	print ($oControle->alteraSituacao()) ? "" : $oControle->msg; exit;
}

$oSituacao = $oControle->getSituacao($_REQUEST['idSituacao']);

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
            <li><a href="admSituacao.php">Situacao</a></li>
            <li class="active">Editar Situacao</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="situacao"></label>
	<input type="text" class="form-control" id="situacao" name="situacao" value="<?=$oSituacao->situacao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admSituacao.php">Voltar</a>
                        <input name="idSituacao" type="hidden" id="idSituacao" value="<?=$_REQUEST['idSituacao']?>" />
                        <input type="hidden" name="classe" id="classe" value="Situacao" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>