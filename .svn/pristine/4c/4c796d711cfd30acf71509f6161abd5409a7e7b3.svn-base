<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Arquivo ========================= 
if($_POST){
	print ($oControle->alteraArquivo()) ? "" : $oControle->msg; exit;
}

$oArquivo = $oControle->getArquivo($_REQUEST['idArquivo']);

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
            <li><a href="admArquivo.php">Arquivo</a></li>
            <li class="active">Editar Arquivo</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="nomeArquivo">NomeArquivo</label>
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="<?=$oArquivo->nomeArquivo?>" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="<?=$oArquivo->novoNome?>" />
</div>

                            <label for="dataImportacao">DataImportacao</label>
                            <?php $oControle->componenteCalendario('dataImportacao', Util::formataDataHoraBancoForm($oArquivo->dataImportacao), NULL, true)?>
<div class="form-group">
	<label for="situacao">Situacao</label>
	<input type="text" class="form-control" id="situacao" name="situacao" value="<?=$oArquivo->situacao?>" />
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="<?=$oArquivo->status?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oArquivo->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oArquivo->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admArquivo.php">Voltar</a>
                        <input name="idArquivo" type="hidden" id="idArquivo" value="<?=$_REQUEST['idArquivo']?>" />
                        <input type="hidden" name="classe" id="classe" value="Arquivo" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>