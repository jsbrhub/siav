<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Atodeclaratorio ========================= 
if($_POST){
	print ($oControle->alteraAtodeclaratorio()) ? "" : $oControle->msg; exit;
}

$oAtodeclaratorio = $oControle->getAtodeclaratorio($_REQUEST['idAtoDeclaratorio']);
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
            <li><a href="admAtodeclaratorio.php">Atodeclaratorio</a></li>
            <li class="active">Editar Atodeclaratorio</li>
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
		<option value="<?=$oIncentivoempresa->idIncentivoEmpresa?>"<?=($oIncentivoempresa->idIncentivoEmpresa == $oAtodeclaratorio->oIncentivoempresa->idIncentivoEmpresa) ? " selected" : ""?>><?=$oIncentivoempresa->unidadeDescricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="nomeArquivo">NomeArquivo</label>
	<input type="text" class="form-control" id="nomeArquivo" name="nomeArquivo" value="<?=$oAtodeclaratorio->nomeArquivo?>" />
</div>
<div class="form-group">
	<label for="novoNome">NovoNome</label>
	<input type="text" class="form-control" id="novoNome" name="novoNome" value="<?=$oAtodeclaratorio->novoNome?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oAtodeclaratorio->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oAtodeclaratorio->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admAtodeclaratorio.php">Voltar</a>
                        <input name="idAtoDeclaratorio" type="hidden" id="idAtoDeclaratorio" value="<?=$_REQUEST['idAtoDeclaratorio']?>" />
                        <input type="hidden" name="classe" id="classe" value="Atodeclaratorio" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>