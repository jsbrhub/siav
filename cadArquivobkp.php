<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$processamento = $_REQUEST['processamento']; //último arquivo carregado
$idArquivo = $_REQUEST['idArquivo'];
if($_REQUEST['acao'] == 'consultarDetalhe') {
    if ($_REQUEST['idArquivo']) {
        $aDetalhearquivo = $oControle->listaDetalhes($_REQUEST['idArquivo']);
        //Util::trace($aDetalhearquivo);
    }
}
switch ($_REQUEST['ms']) {
    case 1:
        $tipo = "erro";
        $mensagem = "Arquivo não foi carregado.";
        break;
    case 2:
        $tipo = "erro";
        $mensagem = "O arquivo importado possui inconsistências, por favor, corrija o arquivo e realize carregamento novamente.";
        break;
    case 3:
        $tipo = "sucesso";
        $mensagem = "O arquivo foi importado com sucesso.";
        break;
} ?>
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
    require_once("includes/menuModEmpresa.php");
    ?>
    <ol class="breadcrumb">
        <li><a href="modEmpresa.php">Home</a></li>
        <li class="active">Cadastrar Arquivo</li>

    </ol>

    <div class="bs-callout bs-callout-default">
        <h4>Lista de Arquivos Processados</h4><br />
        <table class="table table-striped">
            <?php
            if($_REQUEST['ms'])
                print_r($oControle->componenteMsg($mensagem,$tipo));

            $aArquivo = $oControle->getAllArquivo();
            if($aArquivo){
            ?>
            <thead>
            <tr>
                <th>Nome do Arquivo</th>
                <th>Data da Importação</th>
                <th>Situação</th>
                <th>Detalhes do Arquivo</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($aArquivo as $oArquivo){
                ?>
                <tr>
                    <td><?=$oArquivo->nomeArquivo?></td>
                    <td><?=Util::formataDataHoraBancoForm($oArquivo->dataImportacao)?></td>
                    <td><?php
                        if($oArquivo->situacao == '1'){ echo "Processado com restrições.";}
                        if($oArquivo->situacao == '2'){ echo "Processado com sucesso.";}
                        ?></td>
                    <td>
                        <?php if($oArquivo->situacao == '1'){ ?>
                        <a href="admDetalhearquivo.php?idArquivo=<?=$oArquivo->idArquivo?>" >Visualizar</a><?php
                        } else {  echo "-";  }?>
                    </td>
                </tr>
                <?php
            }
            }
            else{
                ?>
                <tr>
                    <td colspan="9" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>

    </div>
    <div class="bs-callout bs-callout-default">
        <h4>Importar Arquivos</h4><br />
        <form  action="excel/Classes/cadExcel.php" enctype="multipart/form-data" method="post" >
            <div class="row">
                <div class="form-group">
                    <div class="col-md-4">
                        <label for="exampleInputFile">Importar Arquivo</label>
                        <input type="file" id="arquivo" name="arquivo" class="filestyle" data-icon="false" >
                        <small id="fileHelp" class="form-text text-muted">Verifique se o arquivo está de acordo com as configurações de importação.</small>

                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <button id="btnImportar" name="btnImportar" data-loading-text="Carregando..." type="submit" class="btn btn-primary" >Importar Arquivo</button>
                        <input type="hidden" name="classe" id="classe" value="Arquivo" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(":file").filestyle({icon: false});
</script>
<?php require_once("includes/footer.php")?>
</body>
</html>