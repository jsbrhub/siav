<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Arquivoempresa ========================= 
if($_POST){
	print ($oControle->alteraArquivoempresa()) ? "" : $oControle->msg; exit;
}

$oArquivoempresa = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
$aEmpresa = $oControle->getAllEmpresa();
$aTipoarquivo = $oControle->getAllTipoarquivo();
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
            <li><a href="admArquivoempresa.php">Arquivoempresa</a></li>
            <li class="active">Editar Arquivoempresa</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oArquivoempresa->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idTipoArquivo">Tipoarquivo</label>
	<select name="idTipoArquivo" id="idTipoArquivo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aTipoarquivo as $oTipoarquivo){
	?>
		<option value="<?=$oTipoarquivo->idTipoArquivo?>"<?=($oTipoarquivo->idTipoArquivo == $oArquivoempresa->oTipoarquivo->idTipoArquivo) ? " selected" : ""?>><?=$oTipoarquivo->idTipoArquivo?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="nomeArquivo">NomeArquivo</label>
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="<?=$oArquivoempresa->nomeArquivo?>" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="<?=$oArquivoempresa->novoNome?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oArquivoempresa->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oArquivoempresa->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admArquivoempresa.php">Voltar</a>
                        <input name="idArquivoEmpresa" type="hidden" id="idArquivoEmpresa" value="<?=$_REQUEST['idArquivoEmpresa']?>" />
                        <input type="hidden" name="classe" id="classe" value="Arquivoempresa" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>