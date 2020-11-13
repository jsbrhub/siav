<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Mercadoconsumidor ========================= 
if($_POST){
	print ($oControle->alteraMercadoconsumidor()) ? "" : $oControle->msg; exit;
}

$oMercadoconsumidor = $oControle->getMercadoconsumidor($_REQUEST['idMercado']);
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
            <li><a href="admMercadoconsumidor.php">Mercadoconsumidor</a></li>
            <li class="active">Editar Mercadoconsumidor</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idIncentivoEmpresa">Incentivoempresa</label>
	<select name="idIncentivoEmpresa" id="idIncentivoEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aIncentivoempresa as $oIncentivoempresa){
	?>
		<option value="<?=$oIncentivoempresa->idIncentivoEmpresa?>"<?=($oIncentivoempresa->idIncentivoEmpresa == $oMercadoconsumidor->oIncentivoempresa->idIncentivoEmpresa) ? " selected" : ""?>><?=$oIncentivoempresa->unidadeDescricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="quantidadeRegional">QuantidadeRegional</label>
	<input type="text" class="form-control" id="quantidadeRegional" name="quantidadeRegional" value="<?=$oMercadoconsumidor->quantidadeRegional?>" />
</div>
<div class="form-group">
    <label for="valorRegional">valorRegional</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorRegional" id="valorRegional" value="<?=$oMercadoconsumidor->valorRegional?>" />
    </div>
</div>

<div class="form-group">
	<label for="quantidadeNacional">QuantidadeNacional</label>
	<input type="text" class="form-control" id="quantidadeNacional" name="quantidadeNacional" value="<?=$oMercadoconsumidor->quantidadeNacional?>" />
</div>
<div class="form-group">
    <label for="valorNacional">valorNacional</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorNacional" id="valorNacional" value="<?=$oMercadoconsumidor->valorNacional?>" />
    </div>
</div>

<div class="form-group">
	<label for="quantidadeExterior">QuantidadeExterior</label>
	<input type="text" class="form-control" id="quantidadeExterior" name="quantidadeExterior" value="<?=$oMercadoconsumidor->quantidadeExterior?>" />
</div>
<div class="form-group">
    <label for="valorExterior">valorExterior</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="valorExterior" id="valorExterior" value="<?=$oMercadoconsumidor->valorExterior?>" />
    </div>
</div>


                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oMercadoconsumidor->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oMercadoconsumidor->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admMercadoconsumidor.php">Voltar</a>
                        <input name="idMercado" type="hidden" id="idMercado" value="<?=$_REQUEST['idMercado']?>" />
                        <input type="hidden" name="classe" id="classe" value="Mercadoconsumidor" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>