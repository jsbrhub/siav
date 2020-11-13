<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Acionista ========================= 
if($_POST){
	print ($oControle->alteraAcionista()) ? "" : $oControle->msg; exit;
}

$oAcionista = $oControle->getAcionista($_REQUEST['idAcionista']);
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
            <li><a href="admAcionista.php">Acionista</a></li>
            <li class="active">Editar Acionista</li>
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
		<option value="<?=$oEmpresa->idEmpresa?>"<?=($oEmpresa->idEmpresa == $oAcionista->oEmpresa->idEmpresa) ? " selected" : ""?>><?=$oEmpresa->usuarioAlteracao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="nome">Nome</label>
	<input type="text" class="form-control" id="nome" name="nome" value="<?=$oAcionista->nome?>" />
</div>
<div class="form-group">
	<label for="cpf">Cpf</label>
	<input type="text" class="form-control cpf" id="cpf" name="cpf" value="<?=$oAcionista->cpf?>" />
</div>
<div class="form-group">
    <label for="email">email</label>
    <div class="input-group">
        <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
        <input type="text" class="form-control" name="email" id="email" value="<?=$oAcionista->email?>" />
    </div>
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oAcionista->dataHoraAlteracao), NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oAcionista->usuarioAlteracao?>" />
</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admAcionista.php">Voltar</a>
                        <input name="idAcionista" type="hidden" id="idAcionista" value="<?=$_REQUEST['idAcionista']?>" />
                        <input type="hidden" name="classe" id="classe" value="Acionista" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>