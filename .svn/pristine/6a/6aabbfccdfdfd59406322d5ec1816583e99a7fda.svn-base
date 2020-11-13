<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Projsocioambiental ========================= 
if($_POST){
	print ($oControle->alteraProjsocioambiental()) ? "" : $oControle->msg; exit;
}

$oProjsocioambiental = $oControle->getProjsocioambiental($_REQUEST['idProjeto']);
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
            <li><a href="admProjsocioambiental.php">Projsocioambiental</a></li>
            <li class="active">Editar Projsocioambiental</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oProjsocioambiental->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="nomeProjeto">NomeProjeto</label>
	<input type="text" class="form-control" id="nomeProjeto" name="nomeProjeto" value="<?=$oProjsocioambiental->nomeProjeto?>" />
</div>
<div class="form-group">
	<label for="descricaoAtividade">DescricaoAtividade</label>
	<input type="text" class="form-control" id="descricaoAtividade" name="descricaoAtividade" value="<?=$oProjsocioambiental->descricaoAtividade?>" />
</div>
<div class="form-group">
    <label for="totalDespesas">totalDespesas</label>
    <div class="input-group">
        <span class="input-group-addon">R$</span>
        <input type="text" class="form-control money" name="totalDespesas" id="totalDespesas" value="<?=$oProjsocioambiental->totalDespesas?>" />
    </div>
</div>

<div class="form-group">
	<label for="quantidadePessoas">QuantidadePessoas</label>
	<input type="text" class="form-control" id="quantidadePessoas" name="quantidadePessoas" value="<?=$oProjsocioambiental->quantidadePessoas?>" />
</div>
<div class="form-group">
    <label for="observacoes">Observacoes</label>
    <textarea name="observacoes" class="form-control" id="observacoes" cols="80" rows="10"><?=$oProjsocioambiental->observacoes?></textarea>
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oProjsocioambiental->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oProjsocioambiental->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admProjsocioambiental.php">Voltar</a>
                        <input name="idProjeto" type="hidden" id="idProjeto" value="<?=$_REQUEST['idProjeto']?>" />
                        <input type="hidden" name="classe" id="classe" value="Projsocioambiental" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>