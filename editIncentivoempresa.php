<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Incentivoempresa ========================= 
if($_POST){
	print ($oControle->alteraIncentivoempresa()) ? "" : $oControle->msg; exit;
}

$oIncentivoempresa = $oControle->getIncentivoempresa($_REQUEST['idIncentivoEmpresa']);
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
            <li><a href="admIncentivoempresa.php">Incentivoempresa</a></li>
            <li class="active">Editar Incentivoempresa</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oIncentivoempresa->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="produtoIncentivado">ProdutoIncentivado</label>
	<input type="text" class="form-control" id="produtoIncentivado" name="produtoIncentivado" value="<?=$oIncentivoempresa->produtoIncentivado?>" />
</div>
<div class="form-group">
	<label for="fonteOrigem">FonteOrigem</label>
	<input type="text" class="form-control" id="fonteOrigem" name="fonteOrigem" value="<?=$oIncentivoempresa->fonteOrigem?>" />
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?=$oIncentivoempresa->cnpj?>" />
</div>
<div class="form-group">
	<label for="cnae">Cnae</label>
	<input type="text" class="form-control" id="cnae" name="cnae" value="<?=$oIncentivoempresa->cnae?>" />
</div>
<div class="form-group">
	<label for="faturamento">Faturamento</label>
	<input type="text" class="form-control" id="faturamento" name="faturamento" value="<?=$oIncentivoempresa->faturamento?>" />
</div>
<div class="form-group">
	<label for="emprego">Emprego</label>
	<input type="text" class="form-control" id="emprego" name="emprego" value="<?=$oIncentivoempresa->emprego?>" />
</div>
<div class="form-group">
	<label for="producao">Producao</label>
	<input type="text" class="form-control" id="producao" name="producao" value="<?=$oIncentivoempresa->producao?>" />
</div>
<div class="form-group">
	<label for="idUnidadeProducao">IdUnidadeProducao</label>
	<input type="text" class="form-control" id="idUnidadeProducao" name="idUnidadeProducao" value="<?=$oIncentivoempresa->idUnidadeProducao?>" />
</div>
<div class="form-group">
	<label for="capacidadeInstalada">CapacidadeInstalada</label>
	<input type="text" class="form-control" id="capacidadeInstalada" name="capacidadeInstalada" value="<?=$oIncentivoempresa->capacidadeInstalada?>" />
</div>
<div class="form-group">
	<label for="unidadeDescricao">UnidadeDescricao</label>
	<input type="text" class="form-control" id="unidadeDescricao" name="unidadeDescricao" value="<?=$oIncentivoempresa->unidadeDescricao?>" />
</div>
<div class="form-group">
	<label for="idUnidadeCapacidade">IdUnidadeCapacidade</label>
	<input type="text" class="form-control" id="idUnidadeCapacidade" name="idUnidadeCapacidade" value="<?=$oIncentivoempresa->idUnidadeCapacidade?>" />
</div>
<div class="form-group">
	<label for="ano">Ano</label>
	<input type="text" class="form-control" id="ano" name="ano" value="<?=$oIncentivoempresa->ano?>" />
</div>
<div class="form-group">
	<label for="vigente">Vigente</label>
	<input type="text" class="form-control" id="vigente" name="vigente" value="<?=$oIncentivoempresa->vigente?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oIncentivoempresa->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oIncentivoempresa->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admIncentivoempresa.php">Voltar</a>
                        <input name="idIncentivoEmpresa" type="hidden" id="idIncentivoEmpresa" value="<?=$_REQUEST['idIncentivoEmpresa']?>" />
                        <input type="hidden" name="classe" id="classe" value="Incentivoempresa" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>