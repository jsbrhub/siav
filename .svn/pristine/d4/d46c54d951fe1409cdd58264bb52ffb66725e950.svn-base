<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Auxiliar ========================= 
if($_POST){
	print ($oControle->alteraAuxiliar()) ? "" : $oControle->msg; exit;
}

$oAuxiliar = $oControle->getAuxiliar($_REQUEST['idAuxiliar']);

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
            <li><a href="admAuxiliar.php">Auxiliar</a></li>
            <li class="active">Editar Auxiliar</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?=$oAuxiliar->cnpj?>" />
</div>
<div class="form-group">
	<label for="empresa">Empresa</label>
	<input type="text" class="form-control" id="empresa" name="empresa" value="<?=$oAuxiliar->empresa?>" />
</div>
<div class="form-group">
    <label for="emailEmpresa">emailEmpresa</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="emailEmpresa" id="emailEmpresa" value="<?=$oAuxiliar->emailEmpresa?>" />
    </div>
</div>
<div class="form-group">
	<label for="municipio">Municipio</label>
	<input type="text" class="form-control" id="municipio" name="municipio" value="<?=$oAuxiliar->municipio?>" />
</div>
<div class="form-group">
	<label for="tipologia">Tipologia</label>
	<input type="text" class="form-control" id="tipologia" name="tipologia" value="<?=$oAuxiliar->tipologia?>" />
</div>
<div class="form-group">
	<label for="uf">Uf</label>
	<input type="text" class="form-control" id="uf" name="uf" value="<?=$oAuxiliar->uf?>" />
</div>
<div class="form-group">
	<label for="setor">Setor</label>
	<input type="text" class="form-control" id="setor" name="setor" value="<?=$oAuxiliar->setor?>" />
</div>
<div class="form-group">
	<label for="tipoIncentivo">TipoIncentivo</label>
	<input type="text" class="form-control" id="tipoIncentivo" name="tipoIncentivo" value="<?=$oAuxiliar->tipoIncentivo?>" />
</div>
<div class="form-group">
	<label for="motivoIncentivo">MotivoIncentivo</label>
	<input type="text" class="form-control" id="motivoIncentivo" name="motivoIncentivo" value="<?=$oAuxiliar->motivoIncentivo?>" />
</div>
<div class="form-group">
    <label for="atividadeIncentivada">AtividadeIncentivada</label>
    <textarea name="atividadeIncentivada" class="form-control" id="atividadeIncentivada" cols="80" rows="10"><?=$oAuxiliar->atividadeIncentivada?></textarea>
</div>
<div class="form-group">
	<label for="anoAprovacao">AnoAprovacao</label>
	<input type="text" class="form-control" id="anoAprovacao" name="anoAprovacao" value="<?=$oAuxiliar->anoAprovacao?>" />
</div>
<div class="form-group">
	<label for="capitalFixo">CapitalFixo</label>
	<input type="text" class="form-control" id="capitalFixo" name="capitalFixo" value="<?=$oAuxiliar->capitalFixo?>" />
</div>
<div class="form-group">
	<label for="capitalGiro">CapitalGiro</label>
	<input type="text" class="form-control" id="capitalGiro" name="capitalGiro" value="<?=$oAuxiliar->capitalGiro?>" />
</div>
<div class="form-group">
	<label for="moDir">MoDir</label>
	<input type="text" class="form-control" id="moDir" name="moDir" value="<?=$oAuxiliar->moDir?>" />
</div>
<div class="form-group">
	<label for="moInd">MoInd</label>
	<input type="text" class="form-control" id="moInd" name="moInd" value="<?=$oAuxiliar->moInd?>" />
</div>
<div class="form-group">
	<label for="moReal">MoReal</label>
	<input type="text" class="form-control" id="moReal" name="moReal" value="<?=$oAuxiliar->moReal?>" />
</div>
<div class="form-group">
	<label for="enq">Enq</label>
	<input type="text" class="form-control" id="enq" name="enq" value="<?=$oAuxiliar->enq?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admAuxiliar.php">Voltar</a>
                        <input name="idAuxiliar" type="hidden" id="idAuxiliar" value="<?=$_REQUEST['idAuxiliar']?>" />
                        <input type="hidden" name="classe" id="classe" value="Auxiliar" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>