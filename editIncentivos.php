<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Incentivos ========================= 
if($_POST){
	print ($oControle->alteraIncentivos()) ? "" : $oControle->msg; exit;
}

$oIncentivos = $oControle->getIncentivos($_REQUEST['idIncentivo']);

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
            <li><a href="admIncentivos.php">Incentivos</a></li>
            <li class="active">Editar Incentivos</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="incentivo">Incentivo</label>
	<input type="text" class="form-control" id="incentivo" name="incentivo" value="<?=$oIncentivos->incentivo?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admIncentivos.php">Voltar</a>
                        <input name="idIncentivo" type="hidden" id="idIncentivo" value="<?=$_REQUEST['idIncentivo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Incentivos" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>