<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Termoresponsabilidade ========================= 
if($_POST){
	print ($oControle->alteraTermoresponsabilidade()) ? "" : $oControle->msg; exit;
}

$oTermoresponsabilidade = $oControle->getTermoresponsabilidade($_REQUEST['idTermo']);
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
            <li><a href="admTermoresponsabilidade.php">Termoresponsabilidade</a></li>
            <li class="active">Editar Termoresponsabilidade</li>
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
		<option value="<?=$oCampanha->idCampanha?>"<?=($oCampanha->idCampanha == $oTermoresponsabilidade->oCampanha->idCampanha) ? " selected" : ""?>><?=$oCampanha->usuarioAlteracao?></option>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oTermoresponsabilidade->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?=$oTermoresponsabilidade->cnpj?>" />
</div>
<div class="form-group">
	<label for="comprovante">Comprovante</label>
	<input type="text" class="form-control" id="comprovante" name="comprovante" value="<?=$oTermoresponsabilidade->comprovante?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataBancoForm($oTermoresponsabilidade->dataHoraAlteracao))?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oTermoresponsabilidade->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admTermoresponsabilidade.php">Voltar</a>
                        <input name="idTermo" type="hidden" id="idTermo" value="<?=$_REQUEST['idTermo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Termoresponsabilidade" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>