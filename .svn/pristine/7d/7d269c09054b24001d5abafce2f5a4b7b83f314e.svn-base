<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do Campanha =========================
$retorno = [];
if(count($_POST)){
    //Util::trace($_REQUEST);
	print ($id = $oControle->alteraCampanha()) ? "" : $oControle->msg;
	$dadosCampanha = $oControle->getCampanha($id);
	$retorno["dadosCampanha"] = $dadosCampanha;
	$retorno["dataInicio"] = Util::formataDataBancoForm($dadosCampanha->dataInicio);
	$retorno["dataFim"] = Util::formataDataBancoForm($dadosCampanha->dataFim);
	$retorno["msg"] = $oControle->msg;
	echo json_encode($retorno);
    exit;
}


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
            <li><a href="admCampanha.php">Campanha</a></li>
            <li class="active">Editar Campanha</li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col-md-4">
                    
<div class="form-group">
	<label for="campanha"></label>
	<input type="text" class="form-control" id="campanha" name="campanha" value="<?=$oCampanha->campanha?>" />
</div>
<div class="form-group">
	<label for="anoBase">AnoBase</label>
	<input type="text" class="form-control" id="anoBase" name="anoBase" value="<?=$oCampanha->anoBase?>" />
</div>

                            <label for="dataInicio">DataInicio</label>
                            <?php $oControle->componenteCalendario('dataInicio', Util::formataDataBancoForm($oCampanha->dataInicio))?>

                            <label for="dataFim">DataFim</label>
                            <?php $oControle->componenteCalendario('dataFim', Util::formataDataBancoForm($oCampanha->dataFim))?>
<div class="form-group">
	<label for="totalEmpresas">TotalEmpresas</label>
	<input type="text" class="form-control" id="totalEmpresas" name="totalEmpresas" value="<?=$oCampanha->totalEmpresas?>" />
</div>
<div class="form-group">
	<label for="situacao">Situacao</label>
	<input type="text" class="form-control" id="situacao" name="situacao" value="<?=$oCampanha->situacao?>" />
</div>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="<?=$oCampanha->usuarioAlteracao?>" />
</div>

                            <label for="dataHoraAlteracao">DataHoraAlteracao</label>
                            <?php $oControle->componenteCalendario('dataHoraAlteracao', Util::formataDataHoraBancoForm($oCampanha->dataHoraAlteracao), NULL, true)?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="admCampanha.php">Voltar</a>
                        <input name="idCampanha" type="hidden" id="idCampanha" value="<?=$_REQUEST['idCampanha']?>" />
                        <input type="hidden" name="classe" id="classe" value="Campanha" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>