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
        $mensagem = "Arquivo selecionado não tem formato .xls.";
        break;
    case 2:
        $tipo = "erro";
        $mensagem = "O arquivo importado possui inconsistências, por favor, corrija o arquivo e realize carregamento novamente.";
        break;
    case 3:
        $tipo = "sucesso";
        $mensagem = "O arquivo foi importado com sucesso.";
        break;
    case 4:
        $tipo = "atencao";
        $mensagem = "O número de colunas do arquivo é menor do que o número de colunas do modelo exigido para a importação, o arquivo não será processado.";
        break;
    case 5:
        $tipo = "atencao";
        $mensagem = "O número de colunas do arquivo é maior do que o número de colunas do modelo exigido para a importação, o arquivo não será processado.";
        break;
}



?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");
    include ("includes/topo.php");?>
	<div class="container">
		<?php 
		require_once("includes/menu.php");
        if($_REQUEST['ms'])
            print_r($oControle->componenteMsg($mensagem,$tipo));
		?>
        <div class="bs-callout bs-callout-primary">
            <h4 class="font-14">Importar Arquivos</h4><br />
            <form  action="excel/Classes/cadExcel.php" enctype="multipart/form-data" method="post" onsubmit="$('.spin-loader').removeClass('hidden');" >
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-4">
                            <label for="arquivo" class="font-12 grey">Importar Arquivo</label>
                            <input type="file" id="arquivo" name="arquivo" class="filestyle input-sm" data-icon="false" >
                            <small id="fileHelp" class="form-text text-muted">Verifique se o arquivo está de acordo com as configurações de importação.</small>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button id="btnImportar" name="btnImportar"
                                    type="submit" class="btn btn-primary btn-sm" ><span class="glyphicon glyphicon-cloud-upload"></span>&nbsp;&nbsp;&nbsp;Carregar &nbsp;&nbsp;&nbsp;
                                <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i></button>
                            <input type="hidden" name="classe" id="classe" value="Arquivo" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="bs-callout bs-callout-primary">
            <h4 class="font-14">Lista de Arquivos Importados</h4><br />

            <table class="table table-striped font-12 grey">
                <?php
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
                            <a data-toggle="modal" data-target="#modalVisualizarDetalheArquivo"
                               onclick="$('#iframe-det-arq').attr('src','admDetalhearquivo' +
                                    '.php?idArquivo=<?=$oArquivo->idArquivo?>')
                                ">Visualizar</a><?php
                            } else {  echo "-";  }?>
                        </td>
                    </tr>
                    <?php
                }
                }
                else{
                    ?>

    </div>
                    <tr>
                        <td colspan="9" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>

        </div>
    <script>
        $(":file").filestyle({icon: false});
    </script>
    <div class="modal fade" id="modalVisualizarDetalheArquivo" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content font-12 grey">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                    <h5 class="modal-title"></h5>
                </div>
                <div class="modal-body bg-grey">
                   <iframe src="admDetalhearquivo.php" id="iframe-det-arq" width="100%" height="400px" frameborder="no">

                   </iframe>

                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>