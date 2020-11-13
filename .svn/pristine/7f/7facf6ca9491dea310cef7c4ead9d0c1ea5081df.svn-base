<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Empresacontrole ========================= 
if($_POST){
	print ($oControle->alteraEmpresacontrole()) ? "" : $oControle->msg; exit;
}

$oEmpresacontrole = $oControle->getEmpresacontrole($_REQUEST['idEmpresaControle']);
$aCampanha = $oControle->getAllCampanha();
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
            <li><a href="admEmpresacontrole.php">Empresacontrole</a></li>
            <li class="active">Editar Empresacontrole</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idCampanha">Campanha</label>
	<select name="idCampanha" id="idCampanha" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aCampanha as $oCampanha){
	?>
		<option value="<?=$oCampanha->idCampanha?>"<?=($oCampanha->idCampanha == $oEmpresacontrole->oCampanha->idCampanha) ? " selected" : ""?>><?=$oCampanha->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idEmpresa">Empresa</label>
	<select name="idEmpresa" id="idEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aEmpresa as $oEmpresa){
	?>
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oEmpresacontrole->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="<?=$oEmpresacontrole->status?>" />
</div>

                            <label for="dataInsercao">DataInsercao</label>
                            <?php $oControle->componenteCalendario('dataInsercao', Util::formataDataHoraBancoForm($oEmpresacontrole->dataInsercao), NULL, true)?>

                            <label for="dataAlteracao">DataAlteracao</label>
                            <?php $oControle->componenteCalendario('dataAlteracao', Util::formataDataHoraBancoForm($oEmpresacontrole->dataAlteracao), NULL, true)?>

                            <label for="dataConclusao">DataConclusao</label>
                            <?php $oControle->componenteCalendario('dataConclusao', Util::formataDataHoraBancoForm($oEmpresacontrole->dataConclusao), NULL, true)?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admEmpresacontrole.php">Voltar</a>
                        <input name="idEmpresaControle" type="hidden" id="idEmpresaControle" value="<?=$_REQUEST['idEmpresaControle']?>" />
                        <input type="hidden" name="classe" id="classe" value="Empresacontrole" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>