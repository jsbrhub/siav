<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Retificacaoempresa ========================= 
if($_POST){
	print ($oControle->alteraRetificacaoempresa()) ? "" : $oControle->msg; exit;
}

$oRetificacaoempresa = $oControle->getRetificacaoempresa($_REQUEST['idRetEmpresa']);
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
            <li><a href="admRetificacaoempresa.php">Retificacaoempresa</a></li>
            <li class="active">Editar Retificacaoempresa</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oRetificacaoempresa->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?=$oRetificacaoempresa->cnpj?>" />
</div>
<div class="form-group">
	<label for="anoBase">AnoBase</label>
	<input type="text" class="form-control" id="anoBase" name="anoBase" value="<?=$oRetificacaoempresa->anoBase?>" />
</div>
<div class="form-group">
	<label for="motivo">Motivo</label>
	<input type="text" class="form-control" id="motivo" name="motivo" value="<?=$oRetificacaoempresa->motivo?>" />
</div>
<div class="form-group">
    <label for="justificativa">Justificativa</label>
    <textarea name="justificativa" class="form-control" id="justificativa" cols="80" rows="10"><?=$oRetificacaoempresa->justificativa?></textarea>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="<?=$oRetificacaoempresa->status?>" />
</div>

                            <label for="dataSolicitacao">DataSolicitacao</label>
                            <?php $oControle->componenteCalendario('dataSolicitacao', Util::formataDataHoraBancoForm($oRetificacaoempresa->dataSolicitacao), NULL, true)?>
<div class="form-group">
	<label for="usuarioSolicitacao">UsuarioSolicitacao</label>
	<input type="text" class="form-control" id="usuarioSolicitacao" name="usuarioSolicitacao" value="<?=$oRetificacaoempresa->usuarioSolicitacao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admRetificacaoempresa.php">Voltar</a>
                        <input name="idRetEmpresa" type="hidden" id="idRetEmpresa" value="<?=$_REQUEST['idRetEmpresa']?>" />
                        <input type="hidden" name="classe" id="classe" value="Retificacaoempresa" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>