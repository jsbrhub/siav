<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Retificacaosudam ========================= 
if($_POST){
	print ($oControle->alteraRetificacaosudam()) ? "" : $oControle->msg; exit;
}

$oRetificacaosudam = $oControle->getRetificacaosudam($_REQUEST['idRetSudam']);
$aRetificacaoempresa = $oControle->getAllRetificacaoempresa();
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
            <li><a href="admRetificacaosudam.php">Retificacaosudam</a></li>
            <li class="active">Editar Retificacaosudam</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idRetEmpresa">Retificacaoempresa</label>
	<select name="idRetEmpresa" id="idRetEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aRetificacaoempresa as $oRetificacaoempresa){
	?>
		<option value="<?=$oRetificacaoempresa->idRetEmpresa?>"<?=($oRetificacaoempresa->idRetEmpresa == $oRetificacaosudam->oRetificacaoempresa->idRetEmpresa) ? " selected" : ""?>><?=$oRetificacaoempresa->usuarioSolicitacao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
    <label for="justificativa">Justificativa</label>
    <textarea name="justificativa" class="form-control" id="justificativa" cols="80" rows="10"><?=$oRetificacaosudam->justificativa?></textarea>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="<?=$oRetificacaosudam->status?>" />
</div>

                            <label for="dataAlteracao">DataAlteracao</label>
                            <?php $oControle->componenteCalendario('dataAlteracao', Util::formataDataHoraBancoForm($oRetificacaosudam->dataAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oRetificacaosudam->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admRetificacaosudam.php">Voltar</a>
                        <input name="idRetSudam" type="hidden" id="idRetSudam" value="<?=$_REQUEST['idRetSudam']?>" />
                        <input type="hidden" name="classe" id="classe" value="Retificacaosudam" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>