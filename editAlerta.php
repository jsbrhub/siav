<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Alerta ========================= 
$retorno = [];

if($_REQUEST['alerta']['idAlerta']){
	print ($oControle->alteraAlerta()) ? "" : $oControle->msg;
    $retorno["msg"] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}



$oAlerta = $oControle->getAlerta($_REQUEST['idAlerta']);
$aCampanha = $oControle->getAllCampanha();
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
            <li><a href="admAlerta.php">Alerta</a></li>
            <li class="active">Editar Alerta</li>
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
		<option value="<?=$oCampanha->idCampanha?>"<?=($oCampanha->idCampanha == $oAlerta->oCampanha->idCampanha) ? " selected" : ""?>><?=$oCampanha->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="assunto">Assunto</label>
	<input type="text" class="form-control" id="assunto" name="assunto" value="<?=$oAlerta->assunto?>" />
</div>
<div class="form-group">
    <label for="texto">Texto</label>
    <textarea name="texto" class="form-control" id="texto" cols="80" rows="10"><?=$oAlerta->texto?></textarea>
</div>
<div class="form-group">
	<label for="tipoSelecao">TipoSelecao</label>
	<input type="text" class="form-control" id="tipoSelecao" name="tipoSelecao" value="<?=$oAlerta->tipoSelecao?>" />
</div>
<div class="form-group">
	<label for="totalEmpresas">TotalEmpresas</label>
	<input type="text" class="form-control" id="totalEmpresas" name="totalEmpresas" value="<?=$oAlerta->totalEmpresas?>" />
</div>
<div class="form-group">
	<label for="situacao">Situacao</label>
	<input type="text" class="form-control" id="situacao" name="situacao" value="<?=$oAlerta->situacao?>" />
</div>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oAlerta->usuarioAlteracao?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oAlerta->dataHoraAlteracao), NULL, true)?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admAlerta.php">Voltar</a>
                        <input name="idAlerta" type="hidden" id="idAlerta" value="<?=$_REQUEST['idAlerta']?>" />
                        <input type="hidden" name="classe" id="classe" value="Alerta" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>