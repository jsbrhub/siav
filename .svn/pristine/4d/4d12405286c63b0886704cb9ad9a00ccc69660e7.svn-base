<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];

$listaIncentivos = $oControle->listarIncentivosByIdEmpresa($idEmpresa);

$listaUnidade = $oControle->getAllUnidademedida();
if ($_REQUEST['dados'] == 'produto') {
    $infoIncentivo = $oControle->getIncentivoempresa($_REQUEST['idIncentivoEmpresa']);
    $infoIncentivo->capacidadeInstalada = ($infoIncentivo->capacidadeInstalada == '0') ? '' : $infoIncentivo->capacidadeInstalada;
    $infoIncentivo->producao = ($infoIncentivo->producao == '0') ? '' : $infoIncentivo->producao;
    $infoIncentivo->faturamento = ($infoIncentivo->faturamento == '0') ? '' : Util::formataMoeda($infoIncentivo->faturamento);
    $infoIncentivo->emprego = ($infoIncentivo->emprego == '0') ? '' : $infoIncentivo->emprego;
    $infoIncentivo->cnae = ($infoIncentivo->cnae == '0') ? '' : $infoIncentivo->cnae;
    $infoIncentivo->anoInicial = ($infoIncentivo->anoInicial == '0') ? '' : $infoIncentivo->anoInicial;
    $infoIncentivo->anoFinal = ($infoIncentivo->anoFinal == '0') ? '' : $infoIncentivo->anoFinal;

    $atoDec = $oControle->getAtoDecByIdIncentivoEmpresa($_REQUEST['idIncentivoEmpresa']);
    $retorno['infoProduto'] = $infoIncentivo;
    if ($atoDec) {
        $retorno['idAtoDeclaratorio'] = $atoDec->idAtoDeclaratorio;
        $retorno['atoDec'] = '<ul><li><a href="files/' . $atoDec->novoNome . '" target="_blank">' . $atoDec->nomeArquivo . '</a> - [<a class="pointer" title="Remover" onclick="removerAto(' . $atoDec->idAtoDeclaratorio . ')" ><span 
class="glyphicon glyphicon-trash btn-sm"></span></a>]
</li></ul>';
    } else {
        $retorno['atoDec'] = '';
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
    exit;
}
if ($_REQUEST['dados'] == 'edicao') {

    $idIncentivoEmpresa = $oControle->alteraIncentivoempresa();

    if ($atoDec) {
        $retorno['atoDec'] = '<a href="files/' . $atoDec->novoNome . '" target="_blank">' . $atoDec->nomeArquivo . '</a>';
    } else {
        if (($_FILES['atoDeclaratorio']['name'] != '')) {
            $uploadDir = 'files/';
            // ;
            $tempFile = $_FILES['atoDeclaratorio']['tmp_name'];
            $tempFileSize = $_FILES['atoDeclaratorio']['size'];
            $maxSize = '31457280';
            $ext = strtolower(substr($_FILES['atoDeclaratorio']['name'], -4)); //Pegando extensão do arquivo
            $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
            $targetFile = $uploadDir . $new_name;
            $fileName = $_FILES['atoDeclaratorio']['name'];
            // Validate the file type
            $fileTypes = array('pdf', 'PDF'); // Allowed file extensions
            $fileParts = pathinfo($_FILES['atoDeclaratorio']['name']);

            // Validate the filetype
            if (in_array($fileParts['extension'], $fileTypes)) {
                if ($tempFileSize <= $maxSize) {
                    move_uploaded_file($tempFile, $targetFile);
                    $idIncentivoEmpresa = $_REQUEST['produto']['idIncentivoEmpresa'];
                    $AtodeclatarorioBD = new AtodeclaratorioBD();
                    $Atodeclaratorio_POST = ['oIncentivoempresa' => new Incentivoempresa($idIncentivoEmpresa), 'nomeArquivo' => $fileName, 'novoNome' => $new_name, 'dataHoraAlteracao'
                    => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                    $oAtodeclaratorio = Util::populate(new Atodeclaratorio(), $Atodeclaratorio_POST);
                    //Util::trace($Atodeclaratorio_POST);
                    $idAto = $AtodeclatarorioBD->inserir($oAtodeclaratorio);
                    $retorno['idAto'] = $idAto;
                    $infoAto = $oControle->getAtodeclaratorio($idAto);
                    //$retorno['infoAto'] = $infoAto;
                    $retorno['atoDec'] = '<a href="files/' . $infoAto->novoNome . '" target="_blank">' . $infoAto->nomeArquivo . '</a>';

                } else {
                    $retorno['erro'] = '1'; //tamanho máximo excedido
                }
            } else {
                // The file type wasn't allowed
                $retorno['erro'] = '2'; //formato não aceito

            }

        } else {
            $retorno['erro'] = '3';

        }
    }
    $retorno["id"] = $idIncentivoEmpresa;
    $retorno["msg"] = $oControle->msg;
    $infoIncentivo = $oControle->getIncentivoempresa($idIncentivoEmpresa);
    $atoDec = $oControle->getAtoDecByIdIncentivoEmpresa($idIncentivoEmpresa);
    $unidCap = $oControle->getUnidademedida($infoIncentivo->idUnidadeCapacidade);
    $unidProd = $oControle->getUnidademedida($infoIncentivo->idUnidadeProducao);
    $retorno["infoProduto"] = $infoIncentivo;
    $retorno["unidCap"] = $unidCap->nome;
    $retorno["unidProd"] = $unidProd->nome;
    echo json_encode($retorno);
    exit;
}

if ($_REQUEST['dados'] == 'cadastro') {

    $idIncentivoEmpresa = $oControle->cadastraIncentivoempresa();

    if ($atoDec) {
        $retorno['atoDec'] = '<a href="files/' . $atoDec->novoNome . '" target="_blank">' . $atoDec->nomeArquivo . '</a>';
    } else {
        if (($_FILES['atoDeclaratorio']['name'] != '')) {
            $uploadDir = 'files/';
            // ;
            $tempFile = $_FILES['atoDeclaratorio']['tmp_name'];
            $tempFileSize = $_FILES['atoDeclaratorio']['size'];
            $maxSize = '31457280';
            $ext = strtolower(substr($_FILES['atoDeclaratorio']['name'], -4)); //Pegando extensão do arquivo
            $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
            $targetFile = $uploadDir . $new_name;
            $fileName = $_FILES['atoDeclaratorio']['name'];
            // Validate the file type
            $fileTypes = array('pdf', 'PDF'); // Allowed file extensions
            $fileParts = pathinfo($_FILES['atoDeclaratorio']['name']);

            // Validate the filetype
            if (in_array($fileParts['extension'], $fileTypes)) {
                if ($tempFileSize <= $maxSize) {
                    move_uploaded_file($tempFile, $targetFile);
                    $AtodeclatarorioBD = new AtodeclaratorioBD();
                    $Atodeclaratorio_POST = ['oIncentivoempresa' => new Incentivoempresa($idIncentivoEmpresa), 'nomeArquivo' => $fileName, 'novoNome' => $new_name, 'dataHoraAlteracao'
                    => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                    $oAtodeclaratorio = Util::populate(new Atodeclaratorio(), $Atodeclaratorio_POST);
                    //Util::trace($Atodeclaratorio_POST);
                    $idAto = $AtodeclatarorioBD->inserir($oAtodeclaratorio);
                    $retorno['idAto'] = $idAto;
                    $infoAto = $oControle->getAtodeclaratorio($idAto);
                    //$retorno['infoAto'] = $infoAto;
                    $retorno['atoDec'] = '<a href="files/' . $infoAto->novoNome . '" target="_blank">' . $infoAto->nomeArquivo . '</a>';

                } else {
                    $retorno['erro'] = '1'; //tamanho máximo excedido
                }
            } else {
                // The file type wasn't allowed
                $retorno['erro'] = '2'; //formato não aceito

            }

        } else {
            $retorno['erro'] = '3';

        }
    }
    $retorno["id"] = $idIncentivoEmpresa;
    $retorno["msg"] = $oControle->msg;
    $infoIncentivo = $oControle->getIncentivoempresa($idIncentivoEmpresa);
    $atoDec = $oControle->getAtoDecByIdIncentivoEmpresa($idIncentivoEmpresa);
    $unidCap = $oControle->getUnidademedida($infoIncentivo->idUnidadeCapacidade);
    $unidProd = $oControle->getUnidademedida($infoIncentivo->idUnidadeProducao);
    $retorno["infoProduto"] = $infoIncentivo;
    $retorno["unidCap"] = $unidCap->nome;
    $retorno["unidProd"] = $unidProd->nome;
    echo json_encode($retorno);
    exit;
}

if ($_REQUEST['dados'] == 'excluirIncentivo') {
    $oIncentivoEmpresa = $oControle->getIncentivoempresa($_REQUEST['idIncentivoEmpresa']);

    $incentivoEmpresaBD = new IncentivoempresaBD();

    $oIncentivoEmpresa->vigente = "0";

    if ($incentivoEmpresaBD->alterar($oIncentivoEmpresa)) {
        echo "1";
    } else {
        echo "0";
    }
    exit;
}

if ($_REQUEST['dados'] == 'excluir') {
    $idAtoDeclaratorio = $_REQUEST['idAtoDeclaratorio'];
    if (!$oControle->excluiAtodeclaratorio($idAtoDeclaratorio)) {
        echo "1";
    } else {
        echo "0";
    }
    exit;
}
?>
<script>
    $(document).ready(function(){
        $("#cadIncenrivo").click(function(){

            $("#form-produto")[0].reset();

            $("#anexarAto").show();

            $("#listaAto").hide();

            $("#idIncentivoEmpresa").val("");

            $("#modalProdutoIncentivado").modal("show");

        });


        $(document).on("click", "[delete-prod-incentivado]", function(){
            confirmacao($(this).data("id"), "Você deseja realmente excluir este registro?", {
                modal_class: "modal-sm",
                callback_ok: function (id) {
                    $.get("cadIncentivoempresa.php", { dados: "excluirIncentivo",  idIncentivoEmpresa : id }, function(response){
                        if(response == "1"){
                            $("#tr-"+id).remove();
                        }
                    });
                }
            });
        });
    });
</script>
<template id="produto-incenitvado">
    <tr >
        <td data-produto></td>
        <td data-cri></td>
        <td data-unid-cri></td>
        <td data-producao></td>
        <td data-unid-prod></td>
        <td data-faturamento></td>
        <td data-emp-direto></td>
        <td data-cnae></td>
        <td data-ato-dec></td>
        <td nowrap >
            <button edit-prod-incentivado class="btn btn-primary btn-sm" ><i class="glyphicon glyphicon-pencil"></i></button>
            <button delete-prod-incentivado class="btn btn-primary btn-sm" ><i class="glyphicon glyphicon-trash"></i></button>
        </td>
    </tr>
</template>

<div class="row p-10 mt-10">
    <div class="col-md-2">
        <div class="form-group pull-left">
            <button id="cadIncenrivo" class="btn btn-primary btn-sm" ><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
        </div>
    </div>
</div>

<div class="row mt-10 p-10">
    <div class="col-md-11">
        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaProduto">
            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
            <p class="font-12" id="produtoMsg"><strong></strong></p>
        </div>
    </div>
    <div class="col-md-1 mb-button">
        <div class="form-group pull-right">
            <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaIncentivo()"><span
                        class="glyphicon
                glyphicon-info-sign font-22"></span></button>
        </div>
    </div>
</div>
<div class="bg-grey border-radius">

    <table class="table table-striped font-12 grey " id="incentivosEmpresa">
        <thead>
            <tr class="bg-grey grey font-13">
                <th>Produto</th>
                <th>CRI*</th>
                <th>Unidade CRI*</th>
                <th>Produção</th>
                <th>Unidade Produção</th>
                <th>Faturamento Bruto</th>
                <th>Empregos Diretos</th>
                <th>CNAE 2.0</th>
                <th>Ato Declaratório Executivo</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="">


<?php
if ($listaIncentivos) {
    foreach ($listaIncentivos as $incentivo) {
        $idEmpresaProdutoIncentivado = $incentivo->oEmpresa->idEmpresa;
        $infoEmpresa = $oControle->getEmpresa($idEmpresaProdutoIncentivado);
        $unidCap = $oControle->getUnidademedida($incentivo->idUnidadeCapacidade);
        $unidProd = $oControle->getUnidademedida($incentivo->idUnidadeProducao);
        $atoDec = $oControle->getAtoDecByIdIncentivoEmpresa($incentivo->idIncentivoEmpresa);
     ?>
                <tr id="tr-<?= $incentivo->idIncentivoEmpresa ?>">
                    <td data-produto><?= $incentivo->produtoIncentivado ?></td>
                    <td data-cri><?= $incentivo->capacidadeInstalada ?></td>
                    <td data-unid-cri><?= $unidCap->nome ?></td>
                    <td data-producao><?= $incentivo->producao ?></td>
                    <td data-unid-prod><?= $unidProd->nome ?></td>
                    <td data-faturamento>R$ <?= Util::formataMoeda($incentivo->faturamento) ?></td>
                    <td data-emp-direto><?= $incentivo->emprego ?></td>
                    <td data-cnae><?= $incentivo->cnae ?></td>
                    <td data-ato-dec>
                        <?php if ($atoDec) { ?>
                            <a href="files/<?= $atoDec->novoNome ?>" target="_blank"><?= $atoDec->nomeArquivo ?></a> <?php if(!file_exists("files/{$atoDec->novoNome}")){ ?> <i class="p-hover glyphicon glyphicon-remove" style="color: red; cursor: pointer" data-trigger="hover" data-toggle="popover" data-content="Este arquivo não foi carregado corretamente, exclua-o e carregue novamente."></i>  <?php } ?> <?php } else {
                            echo "-";
                        } ?>
                    </td>
                    <td nowrap >
                        <button class="btn btn-primary btn-sm"
                                onclick="addProdIncentivado(<?= $incentivo->idIncentivoEmpresa ?>)"><i class="glyphicon
            glyphicon-pencil"></i>
                        </button>
                        <button delete-prod-incentivado data-id="<?= $incentivo->idIncentivoEmpresa ?>" class="btn btn-primary btn-sm" ><i class="glyphicon glyphicon-trash"></i></button>
                    </td>
                </tr>
             <?php } ?>
        <?php }  ?>
        </tbody>
    </table>
</div>

<div class="modal fade no-display" id="ajudaIncentivo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Incentivo</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaIncentivo.php";
                ?>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalProdutoIncentivado" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Produto/Serviço Incentivado</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaProdModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">
                                ×
                            </button>
                            <p class="font-12" id="produtoMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-produto" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-11">
                            <div class="form-group">
                                <label for="produtoIncent">Produto/Serviço Incentivado*:</label>
                                <input type="text" class="form-control input-sm" id="produtoIncent" name="produto[produtoIncentivado]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idIncentivoEmpresa"
                                       name="produto[idIncentivoEmpresa]" value="">
                                <input type="hidden" class="form-control input-sm" id="idEmpresa"
                                       name="produto[idEmpresa]" value="<?= $idEmpresa ?>">
                                <input type="hidden" class="form-control input-sm" id="idIncentivo"
                                       name="produto[idIncentivo]" value="">
                                <input type="hidden" class="form-control input-sm" id="idModalidade"
                                       name="produto[idModalidade]" value="">
                                <input type="hidden" class="form-control input-sm" id="vigente" name="produto[vigente]"
                                       value="1">
                                <input type="hidden" class="form-control input-sm" id="fonteOrigem"
                                       name="produto[fonteOrigem]" value="WEB">
                                <input type="hidden" class="form-control input-sm" id="cnpj" name="produto[cnpj]"
                                       value="<?= $_SESSION['usuarioAtual']['login'] ?>">
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao"
                                       name="produto[dataHoraAlteracao]" value="<?= date("d/m/Y H:i:s") ?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao"
                                       name="produto[usuarioAlteracao]"
                                       value="<?= $_SESSION['usuarioAtual']['login'] ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="capacidadeInstalada">Capacidade Real Instalada*:</label>
                                <input type="text" class="form-control input-sm mil" id="capacidadeInstalada"
                                       name="produto[capacidadeInstalada]"
                                       value="" required
                                       oninvalid="setCustomValidity('Digite a Capacidade Real Instalada.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idUnidadeCapacidade">Unidade*:</label>
                                <select class="form-control input-sm" id="idUnidadeCapacidade"
                                        name="produto[idUnidadeCapacidade]" required
                                        oninvalid="setCustomValidity('Selecione a unidade.')"
                                        oninput="setCustomValidity('')" onchange="addUnidadeCap(this.value)">
                                    <option value="">Selecione</option>
                                    <?php
                                    if ($listaUnidade) {
                                        foreach ($listaUnidade as $unidadeMedida) { ?>
                                            <option value="<?= $unidadeMedida->idUnidade ?>"><?= $unidadeMedida->nome ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 no-display" id="div-unidadeCap">
                            <div class="form-group">
                                <label for="unidadeCap">Qual?*:</label>
                                <input type="text" class="form-control input-sm" id="unidadeCap"
                                       name="produto[unidadeCap]" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="producao">Produção*:</label>
                                <input type="text" class="form-control input-sm mil" id="producao"
                                       name="produto[producao]" value="" required
                                       oninvalid="setCustomValidity('Digite a Produção.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="idUnidadeProducao">Unidade*:</label>
                                <select class="form-control input-sm" id="idUnidadeProducao"
                                        name="produto[idUnidadeProducao]" required
                                        oninvalid="setCustomValidity('Selecione a unidade.')"
                                        oninput="setCustomValidity('')" onchange="addUnidadeProd(this.value)">
                                    <option value="">Selecione</option>
                                    <?php
                                    if ($listaUnidade) {
                                        foreach ($listaUnidade as $unidadeMedida) { ?>
                                            <option value="<?= $unidadeMedida->idUnidade ?>"><?= $unidadeMedida->nome ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 no-display" id="div-unidadeProd">
                            <div class="form-group">
                                <label for="unidadeProd">Qual?*:</label>
                                <input type="text" class="form-control input-sm" id="unidadeProd"
                                       name="produto[unidadeProd]" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="faturamento">Faturamento Bruto*:</label>
                                <input type="text" class="form-control input-sm money" id="faturamento"
                                       name="produto[faturamento]" value="" required
                                       oninvalid="setCustomValidity('Digite o faturamento.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="emprego">Empregos Diretos*:</label>
                                <input type="text" class="form-control input-sm mil" id="emprego"
                                       name="produto[emprego]" value="" required
                                       oninvalid="setCustomValidity('Digite os Empregos Diretos.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cnae">CNAE 2.0*:</label>
                                <input type="text" class="form-control input-sm" id="cnae" name="produto[cnae]" value=""
                                       required oninvalid="setCustomValidity('Digite o CNAE 2.0.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <label for="anoInicial">Período de Fruição (Conforme disposto no Ato
                                                Declaratório Executivo) *:</label>
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control input-sm col-md-6 somentenumero"
                                                   id="anoInicial" name="produto[anoInicial]" value="" maxlength="4"
                                                   minlength="4" placeholder="Ano Inicial" required
                                                   oninvalid="setCustomValidity('Digite o ano inicial do Período ' + 'de Fruição do Incentivo' + '.')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                        <div class="col-md-1 mt-10"> à</div>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control input-sm col-md-6 somentenumero"
                                                   id="anoFinal" name="produto[anoFinal]" value="" minlength="4"
                                                   maxlength="4" placeholder="Ano Final" required
                                                   oninvalid="setCustomValidity('Digite o ano final do ' + 'Período de Fruição do Incentivo' + '.')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row " id="anexarAto">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="atoDeclaratorio" class="font-12 grey">Ato Declaratório Executivo</label>
                                <input type="file" id="atoDeclaratorio" name="atoDeclaratorio" class="filestyle font-12"
                                       data-icon="false">

                                <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: PDF
                                </small>

                            </div>
                        </div>

                    </div>
                    <div class="row no-display" id="listaAto">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="atoDeclaratorio" class="font-12 grey">Ato Declaratório Executivo</label>
                                <div id="arquivoAto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="atoDeclaratorio" class="font-12 grey">Observação:</label>
                                <textarea rows="5" id="produtoObservacao" class="form-control" name="produto[observacao]"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="hidden" id="idAtoDeclaratorio" name="idAtoDeclaratorio" value="">
                                <button id="btnIncentivo" type="submit"
                                        onclick="carregarAtoDeclaratorio(); return false;"
                                        class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Carregar Arquivo e
                                    Salvar &nbsp;&nbsp;&nbsp;
                                    <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="font-10 pull-right"><strong>* Preenchimento obrigatório.</strong></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
