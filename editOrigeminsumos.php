<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Origeminsumos ========================= 
if($_POST){
	print ($oControle->alteraOrigeminsumos()) ? "" : $oControle->msg; exit;
}

$oOrigeminsumos = $oControle->getOrigeminsumos($_REQUEST['idOrigemInsumos']);
$aInsumos = $oControle->getAllInsumos();
$aIncentivoempresa = $oControle->getAllIncentivoempresa();
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
            <li><a href="admOrigeminsumos.php">Origeminsumos</a></li>
            <li class="active">Editar Origeminsumos</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idInsumo">Insumos</label>
	<select name="idInsumo" id="idInsumo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aInsumos as $oInsumos){
	?>
		<option value="<?=$oInsumos->idInsumo?>"<?=($oInsumos->idInsumo == $oOrigeminsumos->oInsumos->idInsumo) ? " selected" : ""?>><?=$oInsumos->descricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idIncentivoEmpresa">Incentivoempresa</label>
	<select name="idIncentivoEmpresa" id="idIncentivoEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aIncentivoempresa as $oIncentivoempresa){
	?>
		<option value="<?=$oIncentivoempresa->idIncentivoEmpresa?>"<?=($oIncentivoempresa->idIncentivoEmpresa == $oOrigeminsumos->oIncentivoempresa->idIncentivoEmpresa) ? " selected" : ""?>><?=$oIncentivoempresa->unidadeDescricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="quantidadeRegional">QuantidadeRegional</label>
	<input type="text" class="form-control" id="quantidadeRegional" name="quantidadeRegional" value="<?=$oOrigeminsumos->quantidadeRegional?>" />
</div>
<div class="form-group">
	<label for="quantidadeNacional">QuantidadeNacional</label>
	<input type="text" class="form-control" id="quantidadeNacional" name="quantidadeNacional" value="<?=$oOrigeminsumos->quantidadeNacional?>" />
</div>
<div class="form-group">
	<label for="quantidadeExterior">QuantidadeExterior</label>
	<input type="text" class="form-control" id="quantidadeExterior" name="quantidadeExterior" value="<?=$oOrigeminsumos->quantidadeExterior?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admOrigeminsumos.php">Voltar</a>
                        <input name="idOrigemInsumos" type="hidden" id="idOrigemInsumos" value="<?=$_REQUEST['idOrigemInsumos']?>" />
                        <input type="hidden" name="classe" id="classe" value="Origeminsumos" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>