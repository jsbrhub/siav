<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Empresa ========================= 
if($_POST){
	print ($oControle->alteraEmpresa()) ? "" : $oControle->msg; exit;
}

$oEmpresa = $oControle->getEmpresa($_REQUEST['idEmpresa']);
$aMunicipio = $oControle->getAllMunicipio();
$aSituacao = $oControle->getAllSituacao();
$aIncentivos = $oControle->getAllIncentivos();
$aModalidade = $oControle->getAllModalidade();

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
            <li><a href="admEmpresa.php">Empresa</a></li>
            <li class="active">Editar Empresa</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="idMunicipio">Municipio</label>
	<select name="idMunicipio" id="idMunicipio" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aMunicipio as $oMunicipio){
	?>
		<option value="<?=$oMunicipio->idMunicipio?>"<?=($oMunicipio->idMunicipio == $oEmpresa->oMunicipio->idMunicipio) ? " selected" : ""?>><?=$oMunicipio->idMunicipio?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idSituacao">Situacao</label>
	<select name="idSituacao" id="idSituacao" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aSituacao as $oSituacao){
	?>
		<option value="<?=$oSituacao->idSituacao?>"<?=($oSituacao->idSituacao == $oEmpresa->oSituacao->idSituacao) ? " selected" : ""?>><?=$oSituacao->idSituacao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idIncentivo">Incentivos</label>
	<select name="idIncentivo" id="idIncentivo" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aIncentivos as $oIncentivos){
	?>
		<option value="<?=$oIncentivos->idIncentivo?>"<?=($oIncentivos->idIncentivo == $oEmpresa->oIncentivos->idIncentivo) ? " selected" : ""?>><?=$oIncentivos->idIncentivo?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="idModalidade">Modalidade</label>
	<select name="idModalidade" id="idModalidade" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aModalidade as $oModalidade){
	?>
		<option value="<?=$oModalidade->idModalidade?>"<?=($oModalidade->idModalidade == $oEmpresa->oModalidade->idModalidade) ? " selected" : ""?>><?=$oModalidade->descricao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="cnpj">Cnpj</label>
	<input type="text" class="form-control cnpj" id="cnpj" name="cnpj" value="<?=$oEmpresa->cnpj?>" />
</div>
<div class="form-group">
	<label for="cnpjMatriz">CnpjMatriz</label>
	<input type="text" class="form-control cnpj" id="cnpjMatriz" name="cnpjMatriz" value="<?=$oEmpresa->cnpjMatriz?>" />
</div>
<div class="form-group">
	<label for="anoBase">AnoBase</label>
	<input type="text" class="form-control" id="anoBase" name="anoBase" value="<?=$oEmpresa->anoBase?>" />
</div>
<div class="form-group">
	<label for="anoAprovacao">AnoAprovacao</label>
	<input type="text" class="form-control" id="anoAprovacao" name="anoAprovacao" value="<?=$oEmpresa->anoAprovacao?>" />
</div>
<div class="form-group">
	<label for="razaoSocial">RazaoSocial</label>
	<input type="text" class="form-control" id="razaoSocial" name="razaoSocial" value="<?=$oEmpresa->razaoSocial?>" />
</div>
<div class="form-group">
	<label for="telefone">Telefone</label>
	<input type="text" class="form-control telefone" id="telefone" name="telefone" value="<?=$oEmpresa->telefone?>" />
</div>
<div class="form-group">
	<label for="fax">Fax</label>
	<input type="text" class="form-control" id="fax" name="fax" value="<?=$oEmpresa->fax?>" />
</div>
<div class="form-group">
    <label for="email">email</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="email" id="email" value="<?=$oEmpresa->email?>" />
    </div>
</div>
<div class="form-group">
	<label for="fonteOrigem">FonteOrigem</label>
	<input type="text" class="form-control" id="fonteOrigem" name="fonteOrigem" value="<?=$oEmpresa->fonteOrigem?>" />
</div>
<div class="form-group">
	<label for="latitude">Latitude</label>
	<input type="text" class="form-control" id="latitude" name="latitude" value="<?=$oEmpresa->latitude?>" />
</div>
<div class="form-group">
	<label for="longitude">Longitude</label>
	<input type="text" class="form-control" id="longitude" name="longitude" value="<?=$oEmpresa->longitude?>" />
</div>
<div class="form-group">
	<label for="endereco">Endereco</label>
	<input type="text" class="form-control" id="endereco" name="endereco" value="<?=$oEmpresa->endereco?>" />
</div>
<div class="form-group">
	<label for="complemento">Complemento</label>
	<input type="text" class="form-control" id="complemento" name="complemento" value="<?=$oEmpresa->complemento?>" />
</div>
<div class="form-group">
	<label for="bairro">Bairro</label>
	<input type="text" class="form-control" id="bairro" name="bairro" value="<?=$oEmpresa->bairro?>" />
</div>
<div class="form-group">
	<label for="cep">Cep</label>
	<input type="text" class="form-control cep" id="cep" name="cep" value="<?=$oEmpresa->cep?>" />
</div>
<div class="form-group">
	<label for="setor">Setor</label>
	<input type="text" class="form-control" id="setor" name="setor" value="<?=$oEmpresa->setor?>" />
</div>
<div class="form-group">
	<label for="enq">Enq</label>
	<input type="text" class="form-control" id="enq" name="enq" value="<?=$oEmpresa->enq?>" />
</div>
<div class="form-group">
	<label for="numSudam">NumSudam</label>
	<input type="text" class="form-control" id="numSudam" name="numSudam" value="<?=$oEmpresa->numSudam?>" />
</div>
<div class="form-group">
	<label for="procurador">Procurador</label>
	<input type="text" class="form-control" id="procurador" name="procurador" value="<?=$oEmpresa->procurador?>" />
</div>

                            <label for="laudoData">LaudoData</label>
                            <?php $oControle->componenteCalendario('laudoData', Util::formataDataBancoForm($oEmpresa->laudoData))?>
<div class="form-group">
	<label for="laudoNumero">LaudoNumero</label>
	<input type="text" class="form-control" id="laudoNumero" name="laudoNumero" value="<?=$oEmpresa->laudoNumero?>" />
</div>
<div class="form-group">
	<label for="anoCalendario">AnoCalendario</label>
	<input type="text" class="form-control" id="anoCalendario" name="anoCalendario" value="<?=$oEmpresa->anoCalendario?>" />
</div>

                            <label for="resolucaoData">ResolucaoData</label>
                            <?php $oControle->componenteCalendario('resolucaoData', Util::formataDataBancoForm($oEmpresa->resolucaoData))?>
<div class="form-group">
	<label for="resolucaoNumero">ResolucaoNumero</label>
	<input type="text" class="form-control" id="resolucaoNumero" name="resolucaoNumero" value="<?=$oEmpresa->resolucaoNumero?>" />
</div>

                            <label for="declaracaoData">DeclaracaoData</label>
                            <?php $oControle->componenteCalendario('declaracaoData', Util::formataDataBancoForm($oEmpresa->declaracaoData))?>
<div class="form-group">
	<label for="declaracaoNumero">DeclaracaoNumero</label>
	<input type="text" class="form-control" id="declaracaoNumero" name="declaracaoNumero" value="<?=$oEmpresa->declaracaoNumero?>" />
</div>
<div class="form-group">
	<label for="situacaoCadastro">SituacaoCadastro</label>
	<input type="text" class="form-control" id="situacaoCadastro" name="situacaoCadastro" value="<?=$oEmpresa->situacaoCadastro?>" />
</div>
<div class="form-group">
	<label for="projetoSocial">ProjetoSocial</label>
	<input type="text" class="form-control" id="projetoSocial" name="projetoSocial" value="<?=$oEmpresa->projetoSocial?>" />
</div>
<div class="form-group">
	<label for="politicaAmbiental">PoliticaAmbiental</label>
	<input type="text" class="form-control" id="politicaAmbiental" name="politicaAmbiental" value="<?=$oEmpresa->politicaAmbiental?>" />
</div>
<div class="form-group">
	<label for="vigente">Vigente</label>
	<input type="text" class="form-control" id="vigente" name="vigente" value="<?=$oEmpresa->vigente?>" />
</div>
<div class="form-group">
	<label for="anoVigencia">AnoVigencia</label>
	<input type="text" class="form-control" id="anoVigencia" name="anoVigencia" value="<?=$oEmpresa->anoVigencia?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oEmpresa->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oEmpresa->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admEmpresa.php">Voltar</a>
                        <input name="idEmpresa" type="hidden" id="idEmpresa" value="<?=$_REQUEST['idEmpresa']?>" />
                        <input type="hidden" name="classe" id="classe" value="Empresa" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>