<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Municipio ========================= 
if($_POST){
	print ($oControle->alteraMunicipio()) ? "" : $oControle->msg; exit;
}

$oMunicipio = $oControle->getMunicipio($_REQUEST['idMunicipio']);

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
            <li><a href="admMunicipio.php">Municipio</a></li>
            <li class="active">Editar Municipio</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
    <label for="regiao">Regiao</label>
    <select name="regiao" id="regiao" class="form-control">
        <option value="Norte"<?=($oMunicipio->regiao == "Norte") ? " selected" : ""?>>Norte</option><option value="Nordeste"<?=($oMunicipio->regiao == "Nordeste") ? " selected" : ""?>>Nordeste</option><option value="Centro-Oeste"<?=($oMunicipio->regiao == "Centro-Oeste") ? " selected" : ""?>>Centro-Oeste</option><option value="Sudeste"<?=($oMunicipio->regiao == "Sudeste") ? " selected" : ""?>>Sudeste</option>
    </select>
</div>
<div class="form-group">
	<label for="uf">Uf</label>
	<input type="text" class="form-control" id="uf" name="uf" value="<?=$oMunicipio->uf?>" />
</div>
<div class="form-group">
	<label for="municipio"></label>
	<input type="text" class="form-control" id="municipio" name="municipio" value="<?=$oMunicipio->municipio?>" />
</div>
<div class="form-group">
	<label for="microregiao">Microregiao</label>
	<input type="text" class="form-control" id="microregiao" name="microregiao" value="<?=$oMunicipio->microregiao?>" />
</div>
<div class="form-group">
    <label for="tipologia">Tipologia</label>
    <select name="tipologia" id="tipologia" class="form-control">
        <option value="1"<?=($oMunicipio->tipologia == "1") ? " selected" : ""?>>1</option><option value="2"<?=($oMunicipio->tipologia == "2") ? " selected" : ""?>>2</option><option value="3"<?=($oMunicipio->tipologia == "3") ? " selected" : ""?>>3</option><option value="4"<?=($oMunicipio->tipologia == "4") ? " selected" : ""?>>4</option>
    </select>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="<?=$oMunicipio->status?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admMunicipio.php">Voltar</a>
                        <input name="idMunicipio" type="hidden" id="idMunicipio" value="<?=$_REQUEST['idMunicipio']?>" />
                        <input type="hidden" name="classe" id="classe" value="Municipio" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>