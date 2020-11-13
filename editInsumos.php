<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Insumos ========================= 
if($_POST){
	print ($oControle->alteraInsumos()) ? "" : $oControle->msg; exit;
}

$oInsumos = $oControle->getInsumos($_REQUEST['idInsumo']);

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
            <li><a href="admInsumos.php">Insumos</a></li>
            <li class="active">Editar Insumos</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="descricao">Descricao</label>
	<input type="text" class="form-control" id="descricao" name="descricao" value="<?=$oInsumos->descricao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admInsumos.php">Voltar</a>
                        <input name="idInsumo" type="hidden" id="idInsumo" value="<?=$_REQUEST['idInsumo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Insumos" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>