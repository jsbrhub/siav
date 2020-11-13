<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Politicaambiental ========================= 
if($_POST){
	print ($oControle->alteraPoliticaambiental()) ? "" : $oControle->msg; exit;
}

$oPoliticaambiental = $oControle->getPoliticaambiental($_REQUEST['idPolitica']);
$aEmpresa = $oControle->getAllEmpresa();
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
            <li><a href="admPoliticaambiental.php">Politicaambiental</a></li>
            <li class="active">Editar Politicaambiental</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idEmpresa">Empresa</label>
	<select name="idEmpresa" id="idEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aEmpresa as $oEmpresa){
	?>
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oPoliticaambiental->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="residuosGerados">ResiduosGerados</label>
	<input type="text" class="form-control" id="residuosGerados" name="residuosGerados" value="<?=$oPoliticaambiental->residuosGerados?>" />
</div>
<div class="form-group">
	<label for="descricaoTratamento">DescricaoTratamento</label>
	<input type="text" class="form-control" id="descricaoTratamento" name="descricaoTratamento" value="<?=$oPoliticaambiental->descricaoTratamento?>" />
</div>
<div class="form-group">
	<label for="quantGerado">QuantGerado</label>
	<input type="text" class="form-control" id="quantGerado" name="quantGerado" value="<?=$oPoliticaambiental->quantGerado?>" />
</div>
<div class="form-group">
	<label for="unidadeQg">UnidadeQg</label>
	<input type="text" class="form-control" id="unidadeQg" name="unidadeQg" value="<?=$oPoliticaambiental->unidadeQg?>" />
</div>
<div class="form-group">
	<label for="quantTratado">QuantTratado</label>
	<input type="text" class="form-control" id="quantTratado" name="quantTratado" value="<?=$oPoliticaambiental->quantTratado?>" />
</div>
<div class="form-group">
	<label for="unidadeQt">UnidadeQt</label>
	<input type="text" class="form-control" id="unidadeQt" name="unidadeQt" value="<?=$oPoliticaambiental->unidadeQt?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oPoliticaambiental->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oPoliticaambiental->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admPoliticaambiental.php">Voltar</a>
                        <input name="idPolitica" type="hidden" id="idPolitica" value="<?=$_REQUEST['idPolitica']?>" />
                        <input type="hidden" name="classe" id="classe" value="Politicaambiental" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>