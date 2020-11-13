<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Arquivopolitica ========================= 
if($_POST){
	print ($oControle->alteraArquivopolitica()) ? "" : $oControle->msg; exit;
}

$oArquivopolitica = $oControle->getArquivopolitica($_REQUEST['idArquivoPol']);

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
            <li><a href="admArquivopolitica.php">Arquivopolitica</a></li>
            <li class="active">Editar Arquivopolitica</li>
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
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="<?=$oArquivopolitica->nomeArquivo?>" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="<?=$oArquivopolitica->novoNome?>" />
</div>
<div class="form-group">
    <label for="link">link</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></div>
        <input type="url" class="form-control" name="link" id="link" value="<?=$oArquivopolitica->link?>" />
    </div>
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oArquivopolitica->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oArquivopolitica->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admArquivopolitica.php">Voltar</a>
                        <input name="idArquivoPol" type="hidden" id="idArquivoPol" value="<?=$_REQUEST['idArquivoPol']?>" />
                        <input type="hidden" name="classe" id="classe" value="Arquivopolitica" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>