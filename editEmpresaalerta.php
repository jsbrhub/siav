<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Empresaalerta ========================= 
if($_POST){
	print ($oControle->alteraEmpresaalerta()) ? "" : $oControle->msg; exit;
}

$oEmpresaalerta = $oControle->getEmpresaalerta($_REQUEST['idEmpresaAlerta']);
$aAlerta = $oControle->getAllAlerta();
$aEmpresa = $oControle->getAllEmpresa();
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
            <li><a href="admEmpresaalerta.php">Empresaalerta</a></li>
            <li class="active">Editar Empresaalerta</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idAlerta">Alerta</label>
	<select name="idAlerta" id="idAlerta" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aAlerta as $oAlerta){
	?>
		<option value="<?=$oAlerta->idAlerta?>"<?=($oAlerta->idAlerta == $oEmpresaalerta->oAlerta->idAlerta) ? " selected" : ""?>><?=$oAlerta->usuarioAlteracao?></option>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oEmpresaalerta->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idCampanha">Campanha</label>
	<select name="idCampanha" id="idCampanha" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aCampanha as $oCampanha){
	?>
		<option value="<?=$oCampanha->idCampanha?>"<?=($oCampanha->idCampanha == $oEmpresaalerta->oCampanha->idCampanha) ? " selected" : ""?>><?=$oCampanha->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admEmpresaalerta.php">Voltar</a>
                        <input name="idEmpresaAlerta" type="hidden" id="idEmpresaAlerta" value="<?=$_REQUEST['idEmpresaAlerta']?>" />
                        <input type="hidden" name="classe" id="classe" value="Empresaalerta" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>