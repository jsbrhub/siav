<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$infoEmpresa = $oControle->getEmpresa($idEmpresa);
$listaPolitica = $oControle->getAllPoliticaByEmpresa($idEmpresa);
$listaUnidades = $oControle->getAllUnidademedida();
$naoPossuiPolitica = $infoEmpresa->politicaAmbiental;
$retorno = [];

if($_REQUEST['dados'] == 'cadastro'){

    if($_REQUEST['politica']['unidadeQg'] == 'outras'){
        $_REQUEST['politica']['unidadeQg'] = $_REQUEST['politica']['unidadeDescQg'];
        $novaUnidade = $_REQUEST['politica']['unidadeDescQg'];
        $oUnidadeMedida = ['idUnidade' =>'','nome'=>$novaUnidade,'sigla'=>$novaUnidade];
        $postUnidadeMedida = Util::populate(new Unidademedida(),$oUnidadeMedida);
        $UnidademedidaBD = new UnidademedidaBD();
        $UnidademedidaBD->inserir($postUnidadeMedida);
        $itemUnidadeQg = '<option value="'.$novaUnidade.'">'.$novaUnidade.'</option>';
        $retorno['itemQg'] = $itemUnidadeQg;
    }
    if($_REQUEST['politica']['unidadeQt'] == 'outras'){
        $_REQUEST['politica']['unidadeQt'] = $_REQUEST['politica']['unidadeDescQt'];
        $novaUnidadeQt = $_REQUEST['politica']['unidadeDescQt'];
        $oUnidadeMedidaQt = ['idUnidade' =>'','nome'=>$novaUnidadeQt,'sigla'=>$novaUnidadeQt];
        $postUnidadeMedidaQt = Util::populate(new Unidademedida(),$oUnidadeMedidaQt);
        $UnidademedidaBD = new UnidademedidaBD();
        $UnidademedidaBD->inserir($postUnidadeMedidaQt);
        $itemUnidadeQt = '<option value="'.$novaUnidadeQt.'">'.$novaUnidadeQt.'</option>';
        $retorno['itemQt'] = $itemUnidadeQt;
    }


    print ($id = $oControle->cadastraPoliticaambiental()) ? "" : $oControle->msg;
    $oControle->updatePoliticaEmpresa($_REQUEST['politica']['idEmpresa'],'0');
    $arqPol = $oControle->retornaArquivoPoliticaByEmpresa($_REQUEST['politica']['idEmpresa']);
    if($arqPol){
        $ArquivoPoliticaBD = new ArquivopoliticaBD();
        $ArquivoPolitica_POST = ['oPoliticaambiental' => new Politicaambiental($id), 'nomeArquivo' => $arqPol->nomeArquivo, 'novoNome' => $arqPol->novoNome, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
        $oArquivoPolitica = Util::populate(new Arquivopolitica(),$ArquivoPolitica_POST);
        $idArquivoPol = $ArquivoPoliticaBD->inserir($oArquivoPolitica);
        $oControle->excluiArquivoempresa($arqPol->idArquivoEmpresa);
        $retorno['idArquivoPol'] = $idArquivoPol;
        $infoArquivo = $oControle->getArquivopolitica($idArquivoPol);
        $retorno['infoArquivo'] = $infoArquivo;
        $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPolitica('.$infoArquivo->idArquivoPol.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    }
    if(!$linkArquivo){$linkArquivo = '-';}
    $infoPolitica = $oControle->getPoliticaambiental($id);
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoPolitica'] = $infoPolitica;
    $retorno['itemPolitica'] = '
                            <tr id="tr-id'.$infoPolitica->idPolitica.'">
                   <td data-resid>'.$infoPolitica->residuosGerados.'</td>
                    <td data-desc-trat>'.$infoPolitica->descricaoTratamento.'</td>
                    <td data-q-gerado>'.$infoPolitica->quantGerado.'</td>
                    <td data-uni-qg>'.$infoPolitica->unidadeQg.'</td>
                    <td data-q-tratado>'.$infoPolitica->quantTratado.'</td>
                    <td data-uni-qt>'.$infoPolitica->unidadeQt.'</td>
                    <td data-arquivo>'.$linkArquivo.'</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addPolitica('.$infoPolitica->idPolitica.')"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirPolitica('.$infoPolitica->idPolitica.')"><i class="glyphicon
                        glyphicon-trash"></i></button>
                    </td>
                </tr>';
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'edicao'){
    $id = $oControle->alteraPoliticaambiental();
    $infoPolitica = $oControle->getPoliticaambiental($id);
    $infoArquivo = $oControle->getArquivosByPolitica($id);
    if($infoArquivo)
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    if(!$linkArquivo){$linkArquivo = '-';}
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoPolitica'] = $infoPolitica;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['linkArquivo'] = $linkArquivo;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'politica'){
    $infoPolitica = $oControle->getPoliticaambiental($_REQUEST['idPolitica']);
    $infoArquivo = $oControle->getArquivosByPolitica($_REQUEST['idPolitica']);

    $retorno['id'] = $infoPolitica->idPolitica;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoPolitica'] = $infoPolitica;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPolitica('.$infoArquivo->idArquivoPol.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'empresa'){
    $infoEmpresa = $oControle->getEmpresa($_REQUEST['idEmpresa']);
    if($infoEmpresa){
        $retorno['infoEmpresa'] = $infoEmpresa;
    }
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'excluir'){
    $infoArquivo = $oControle->getArquivosByPolitica($_REQUEST['idPolitica']);
    if($infoArquivo)
        $oControle->excluiArquivopolitica($infoArquivo->idArquivoPol);

    if(!$oControle->excluiPoliticaambiental($_REQUEST['idPolitica'])){
        $retorno['del'] = "2";
    }else{
        $retorno['del'] = "1";
    }
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'naoPossui'){
    $listaPolitica = $oControle->getAllPoliticaambiental($_REQUEST['idEmpresa']);
    if(!$listaPolitica){
        $oControle->updatePoliticaEmpresa($_REQUEST['idEmpresa'],'1');
        $retorno['res'] = "0";
    }
    else{
        $retorno['res'] = "1";
    }
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}

if (!empty($_FILES['arquivoPolitica'])) {
    $uploadDir = 'files/';
    $tempFile   = $_FILES['arquivoPolitica']['tmp_name'];
    $tempFileSize   = $_FILES['arquivoPolitica']['size'];
    $maxSize = '31457280';
    $ext = strtolower(substr($_FILES['arquivoPolitica']['name'], -4)); //Pegando extensão do arquivo
    $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
    $targetFile = $uploadDir . $new_name;
    $fileName = $_FILES['arquivoPolitica']['name'];
    $fileTypes = array('pdf','PDF'); // Allowed file extensions
    $fileParts = pathinfo($_FILES['arquivoPolitica']['name']);
    if (in_array($fileParts['extension'], $fileTypes)) {
        if($tempFileSize <= $maxSize) {
            move_uploaded_file($tempFile, $targetFile);
            if(!$_REQUEST['politica']['idPolitica']){
                $ArquivoempresaBD = new ArquivoempresaBD();
                $Arquivoempresa_POST = ['oEmpresa' => new Empresa($_REQUEST['politica']['idEmpresa']),'oTipoarquivo' =>new Tipoarquivo('8'), 'nomeArquivo' => $_FILES['arquivoPolitica']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
                $idArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);
                $retorno['idArquivoEmpresa'] = $idArquivoEmpresa;
                $infoArquivo = $oControle->getArquivoempresa($idArquivoEmpresa);
            }else{
                $ArquivoPoliticaBD = new ArquivopoliticaBD();
                $ArquivoPolitica_POST = ['oPoliticaambiental' => new Politicaambiental($_REQUEST['politica']['idPolitica']), 'nomeArquivo' => $_FILES['arquivoPolitica']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoPolitica = Util::populate(new Arquivopolitica(),$ArquivoPolitica_POST);
                $idArquivoPol = $ArquivoPoliticaBD->inserir($oArquivoPolitica);
                $infoArquivo = $oControle->getArquivopolitica($idArquivoPol);
            }
            $retorno['infoArquivo'] = $infoArquivo;
            $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPolitica('.$infoArquivo->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
            echo json_encode($retorno);
            exit;
        }else{
            $retorno['erro'] = '1'; //tamanho máximo excedido
            echo json_encode($retorno);
            exit;
        }
    } else {
        $retorno['erro'] = '2'; //formato não aceito
        echo json_encode($retorno);
        exit;

    }
    exit;
}

if($_REQUEST['dados'] == 'excluirArquivo'){
    if(!$oControle->excluiArquivopolitica($_REQUEST['idArquivoPol'])){ echo "1"; } else {  echo "0"; }
    exit;
}



?>
<div class="bg-grey p-10 mt-10 border-radius">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group font-12 grey">
                <strong>Destinação Sustentável de Resíduos</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 ">
            <div class="form-group pull-left">
                <button id="addPolitica" class="btn btn-primary btn-sm" onclick="addPolitica(0)"><i class="glyphicon
        glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaDestinacao()"><span
                            class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaPolitica">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="politicaMsg"><strong></strong></p>
            </div>
        </div>
    </div>
    <div class="row <?=($naoPossuiPolitica == '1')?'':'no-display'?>">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info" id="alertaPoliticaNaoPossui">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12"><strong>Empresa não possui Destinação Sustentável.</strong></p>
            </div>
        </div>
    </div>
    <table class="table table-striped font-12 grey <?=($listaPolitica != '')?'':'no-display'?>" id="politicaEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Resíduos Gerados</th>
            <th>Descrição do Tratamento</th>
            <th>Quant. de Resíduos Gerados ou Descartados</th>
            <th>Unidade de Medida (Res. Gerados)</th>
            <th>Quantidade de Resíduos Tratados</th>
            <th>Unidade de Medida (Res. Tratados)</th>
            <th>Arquivo</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body-politica">
        <?php
        if($listaPolitica) {
            foreach ($listaPolitica as $politica) {
                $arquivoPol = $oControle->getArquivosByPolitica($politica->idPolitica);
                if($arquivoPol){
                    $linkArquivo = '<a href="files/'.$arquivoPol->novoNome.'" target = "_blank">'.$arquivoPol->nomeArquivo.'</a>';
                }else{
                    $linkArquivo = '-';
                }
                ?>
                <tr id="tr-id<?= $politica->idPolitica ?>">
                    <td data-resid><?= $politica->residuosGerados ?></td>
                    <td data-desc-trat><?= $politica->descricaoTratamento ?></td>
                    <td data-q-gerado><?= $politica->quantGerado ?></td>
                    <td data-uni-qg><?= $politica->unidadeQg ?></td>
                    <td data-q-tratado><?= $politica->quantTratado ?></td>
                    <td data-uni-qt><?= $politica->unidadeQt ?></td>
                    <td data-arquivo><?=$linkArquivo?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addPolitica(<?=$politica->idPolitica?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirPolitica(<?=$politica->idPolitica?>)"><i class="glyphicon
                        glyphicon-trash"></i></button>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal fade no-display" id="ajudaDestinacao" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Destinação Sustentável</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaDestinacao.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalPolitica" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Destinação Sustentável de Resíduos</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaPoliticaModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="politicaMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-politica" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" class="styled" id="naoPossuiPol" name="naoPossuiPol" value="1"
                                           onchange="naoPossuiPolitica();">
                                    <label for="naoPossui" class="font-13"><strong>Não Possui</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="residuosGerados">Resíduos Gerados *:</label>
                                <textarea class="form-control input-sm" id="residuosGerados" name="politica[residuosGerados]"
                                          value=""  required oninvalid="setCustomValidity('Digite os Resíduos Gerados.')"
                                          oninput="setCustomValidity('')" rows="2"></textarea>
                                <input type="hidden" class="form-control input-sm" id="idPolitica" name="politica[idPolitica]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="politica[idEmpresa]" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="politica[dataHoraAlteracao]"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="politica[usuarioAlteracao]"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricaoTratamento">Descrição do Tratamento *:</label>
                                <textarea class="form-control input-sm" id="descricaoTratamento" name="politica[descricaoTratamento]"
                                          value=""  required oninvalid="setCustomValidity('Digite a Descrição do Tratamento.')"
                                          oninput="setCustomValidity('')" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantGerado">Quantidade de Resíduos Gerados ou Descartados*:</label>
                                <input type="text" class="form-control input-sm somentenumeros" id="quantGerado"  name="politica[quantGerado]" value="" required  oninvalid="setCustomValidity('Digite a Quantidade de Resíduos Gerados.')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-17">
                                <label for="unidadeQg">Unidade de Medida *:</label>
                                <select class="form-control input-sm" id="unidadeQg" name="politica[unidadeQg]" onchange="addUnidadeQg(this.value)"
                                        required  oninvalid="setCustomValidity('Selecione a unidade.')" oninput="setCustomValidity('')">
                                    <option value="">Selecione</option>
                                    <?php
                                    if($listaUnidades){
                                        foreach ($listaUnidades as $unidade){ ?>
                                            <option value="<?=$unidade->nome?>"><?=$unidade->nome?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 no-display" id="div-unidade-qg">
                            <div class="form-group mt-17">
                                <label for="unidadeDescQg">Qual *:</label>
                                <input type="text" class="form-control input-sm" id="unidadeDescQg"  name="politica[unidadeDescQg]" >
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantTratado">Quantidade de Resíduos Tratados *:</label>
                                <input type="text" class="form-control input-sm somentenumeros" id="quantTratado"  name="politica[quantTratado]" value="" required  oninvalid="setCustomValidity('Digite a Quantidade de Resíduos Tratados.')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-17">
                                <label for="unidadeQt">Unidade de Medida *:</label>
                                <select class="form-control input-sm" id="unidadeQt" name="politica[unidadeQt]" onchange="addUnidadeQt(this.value)" required  oninvalid="setCustomValidity('Selecione a unidade.')" oninput="setCustomValidity('')" >
                                    <option value="">Selecione</option>
                                    <?php
                                    if($listaUnidades){
                                        foreach ($listaUnidades as $unidade){ ?>
                                            <option value="<?=$unidade->nome?>"><?=$unidade->nome?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 no-display" id="div-unidade-qt">
                            <div class="form-group mt-17">
                                <label for="unidadeDescQt">Qual *:</label>
                                <input type="text" class="form-control input-sm" id="unidadeDescQt"  name="politica[unidadeDescQt]" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row " id="anexarPolitica">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivoPolitica" class="font-12 grey">Anexar Arquivo Destinação Sustentável: </label>
                                <input type="file" id="arquivoPolitica" name="arquivoPolitica" class="filestyle font-12" data-icon="false" >
                                <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: PDF</small>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp; </label>
                                <button class="btn btn-primary btn-sm mt-25" id="btnArquivoPol" onclick="carregaArquivoPolitica()">Carregar  &nbsp;&nbsp;&nbsp; <i
                                            class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>

                            </div>
                        </div>
                    </div>
                    <div class="row no-display" id="listaArquivoPolitica">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-12 grey">Lista de Arquivos</label>
                                <div id="arquivoPol"></div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""></label>
                                <button id="btnPolitica"  type="submit" onclick="cadPolitica()"  class="btn btn-primary btn-sm"><span class="glyphicon
                                glyphicon-ok"></span> &nbsp;&nbsp;Salvar</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <span class="font-10">* Preenchimento obrigatório.</span>
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