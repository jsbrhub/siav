<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Unidademedida ========================= 
if($_POST){
	print ($oControle->alteraUnidademedida()) ? "" : $oControle->msg; exit;
}

$oUnidademedida = $oControle->getUnidademedida($_REQUEST['idUnidade']);

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
            <li><a href="admUnidademedida.php">Unidademedida</a></li>
            <li class="active">Editar Unidademedida</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="nome">Nome</label>
	<input type="text" class="form-control" id="nome" name="nome" value="<?=$oUnidademedida->nome?>" />
</div>
<div class="form-group">
	<label for="sigla">Sigla</label>
	<input type="text" class="form-control" id="sigla" name="sigla" value="<?=$oUnidademedida->sigla?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admUnidademedida.php">Voltar</a>
                        <input name="idUnidade" type="hidden" id="idUnidade" value="<?=$_REQUEST['idUnidade']?>" />
                        <input type="hidden" name="classe" id="classe" value="Unidademedida" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>