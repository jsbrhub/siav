<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Contatoempresa ========================= 
if($_POST){
	print ($oControle->alteraContatoempresa()) ? "" : $oControle->msg; exit;
}

$oContatoempresa = $oControle->getContatoempresa($_REQUEST['idContatoEmpresa']);
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
            <li><a href="admContatoempresa.php">Contatoempresa</a></li>
            <li class="active">Editar Contatoempresa</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oContatoempresa->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="contato">Contato</label>
	<input type="text" class="form-control" id="contato" name="contato" value="<?=$oContatoempresa->contato?>" />
</div>
<div class="form-group">
	<label for="funcao">Funcao</label>
	<input type="text" class="form-control" id="funcao" name="funcao" value="<?=$oContatoempresa->funcao?>" />
</div>
<div class="form-group">
    <label for="email">email</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="email" id="email" value="<?=$oContatoempresa->email?>" />
    </div>
</div>
<div class="form-group">
	<label for="telefone">Telefone</label>
	<input type="text" class="form-control telefone" id="telefone" name="telefone" value="<?=$oContatoempresa->telefone?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oContatoempresa->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oContatoempresa->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admContatoempresa.php">Voltar</a>
                        <input name="idContatoEmpresa" type="hidden" id="idContatoEmpresa" value="<?=$_REQUEST['idContatoEmpresa']?>" />
                        <input type="hidden" name="classe" id="classe" value="Contatoempresa" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>