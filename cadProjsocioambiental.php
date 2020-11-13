<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$listaProjetos = $oControle->getAllProjetosByEmpresa($idEmpresa);
$infoEmpresa = $oControle->getEmpresa($idEmpresa);
$naoPossuiProjeto = $infoEmpresa->projetoSocial;
$retorno = [];
// ================= Cadastrar Projsocioambiental ========================= 
if($_REQUEST['dados'] == 'cadastro'){
    print ($id = $oControle->cadastraProjsocioambiental()) ? "" : $oControle->msg;
    $oControle->updateProjetoEmpresa($_REQUEST['projeto']['idEmpresa'],'0');
    $arqProj = $oControle->retornaArquivoProjetoByEmpresa($_REQUEST['projeto']['idEmpresa']);
    if($arqProj) {
        $ArquivoProjetoBD = new ArquivoprojetoBD();
        $ArquivoProjeto_POST = ['oProjsocioambiental' => new Projsocioambiental($id), 'nomeArquivo' => $arqProj->nomeArquivo, 'novoNome' => $arqProj->novoNome, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
        $oArquivoprojeto = Util::populate(new Arquivoprojeto(), $ArquivoProjeto_POST);
        $idArquivoProj = $ArquivoProjetoBD->inserir($oArquivoprojeto);
        $oControle->excluiArquivoempresa($arqProj->idArquivoEmpresa);
        $retorno['idArquivoProjeto'] = $idArquivoProj;
        $infoArquivo = $oControle->getArquivoprojeto($idArquivoProj);
        $retorno['infoArquivo'] = $infoArquivo;
        $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoProjeto('.$infoArquivo->idArquivoProj.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';

    }
    if(!$linkArquivo){$linkArquivo = '';}
    $infoProjeto = $oControle->getProjsocioambiental($id);
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['itemProjeto'] = '
                            <tr id="tr-id'.$infoProjeto->idProjeto.'">
                    <td data-projeto>'.$infoProjeto->nomeProjeto.'</td>
                    <td data-atividade>'.$infoProjeto->descricaoAtividade.'</td>
                    <td data-total>'.Util::formataMoeda($infoProjeto->totalDespesas).'</td>
                    <td data-quant>'.$infoProjeto->quantidadePessoas.'</td>
                    <td data-obs>'.$infoProjeto->observacoes.'</td>
                    <td data-arq>'.$linkArquivo.'</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addProjeto('.$infoProjeto->idProjeto.')"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirProjeto('.$infoProjeto->idProjeto.')"><i class="glyphicon
                        glyphicon-trash"></i></button>
                    </td>
                </tr>';

    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'edicao'){
    $id = $oControle->alteraProjsocioambiental();
    $infoProjeto = $oControle->getProjsocioambiental($id);
    $infoArquivo = $oControle->getArquivosByProjeto($id);
    if($infoArquivo)
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    if(!$linkArquivo){$linkArquivo = '-';}
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['linkArquivo'] = $linkArquivo;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'projeto'){

    $infoProjeto = $oControle->getProjsocioambiental($_REQUEST['idProjeto']);
    $infoArquivo = $oControle->getArquivosByProjeto($_REQUEST['idProjeto']);
    $retorno['id'] = $infoProjeto->idProjeto;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoProjeto('.$infoArquivo->idArquivoProj.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'empresa'){
    $infoEmpresa = $oControle->getEmpresa($_REQUEST['idEmpresa']);
    $retorno['infoEmpresa'] = $infoEmpresa;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'excluir'){
    $infoArquivo = $oControle->getArquivosByProjeto($_REQUEST['idProjeto']);
    if($infoArquivo)
        $oControle->excluiArquivoprojeto($infoArquivo->idArquivoProj);

    if(!$oControle->excluiProjsocioambiental($_REQUEST['idProjeto'])){
        $retorno['del'] = "2";
    }else{
        $retorno['del'] = "1";
    }
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'naoPossui'){
    $listaProjetos = $oControle->getAllProjetosByEmpresa($_REQUEST['idEmpresa']);
    if(!$listaProjetos) {
        $oControle->updateProjetoEmpresa($_REQUEST['idEmpresa'],'1');
        $retorno['res'] = "0";
    }
    else{
        $retorno['res'] = "1";
    }
    $retorno['msg'] = $oControle->msg;
    echo json_encode($retorno);
    exit;
}

if (!empty($_FILES)) {
    $uploadDir = 'files/';
    $tempFile   = $_FILES['arquivoProjeto']['tmp_name'];
    $tempFileSize   = $_FILES['arquivoProjeto']['size'];
    $maxSize = '31457280';
    $ext = strtolower(substr($_FILES['arquivoProjeto']['name'], -4)); //Pegando extensão do arquivo
    $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
    $targetFile = $uploadDir . $new_name;
    $fileName = $_FILES['arquivoProjeto']['name'];
    $fileTypes = array('pdf','PDF'); // Allowed file extensions
    $fileParts = pathinfo($_FILES['arquivoProjeto']['name']);

    if (in_array($fileParts['extension'], $fileTypes)) {
        if($tempFileSize <= $maxSize) {
            move_uploaded_file($tempFile, $targetFile);
            if(!$_REQUEST['projeto']['idProjeto']){
                $ArquivoempresaBD = new ArquivoempresaBD();
                $Arquivoempresa_POST = ['oEmpresa' => new Empresa($_REQUEST['projeto']['idEmpresa']),'oTipoarquivo' =>new Tipoarquivo('1'), 'nomeArquivo' => $_FILES['arquivoProjeto']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
                $idArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);
                $retorno['idArquivoEmpresa'] = $idArquivoEmpresa;
                $infoArquivo = $oControle->getArquivoempresa($idArquivoEmpresa);
            }else{
                $ArquivoProjetoBD = new ArquivoprojetoBD();
                $ArquivoProjeto_POST = ['oProjsocioambiental' => new Projsocioambiental($_REQUEST['projeto']['idProjeto']), 'nomeArquivo' => $_FILES['arquivoProjeto']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoprojeto = Util::populate(new Arquivoprojeto(), $ArquivoProjeto_POST);
                $idArquivoProj = $ArquivoProjetoBD->inserir($oArquivoprojeto);
                $infoArquivo = $oControle->getArquivoprojeto($idArquivoProj);
            }
            $retorno['infoArquivo'] = $infoArquivo;
            $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoProjeto('.$infoArquivo->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
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
    exit();
}

if($_REQUEST['dados'] == 'excluirArquivo'){
    if(!$oControle->excluiArquivoprojeto($_REQUEST['idArquivoProj'])){ echo "1"; } else {  echo "0"; }
    exit;
}

?>
<div class="bg-grey p-10 mt-10 border-radius">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group font-12 grey">
                <strong>Projetos/Programas Sociais e/ou Ambientais Desenvolvidos para o Benefício da Comunidade</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 ">
            <div class="form-group pull-left">
                <button id="addProjeto" class="btn btn-primary btn-sm" onclick="addProjeto(0)"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaProjeto()"><span
                            class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
            </div>
        </div>
    </div>
    <div class="row <?=($naoPossuiProjeto == '1')?'':'no-display'?>">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info" id="alertaProjetoNaoPossui">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12"><strong>Empresa não possui Projeto/Programa Social ou Ambiental.</strong></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaProjeto">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="projetoMsg"><strong></strong></p>
            </div>
        </div>
    </div>

        <table class="table table-striped font-12 grey <?=($listaProjetos != '')?'':'no-display'?>" id="projetoEmpresa">
            <thead>
            <tr class="bg-grey grey font-13">
                <th>Nome do Projeto</th>
                <th>Descrição da Atividade</th>
                <th>Total de Despesas</th>
                <th>Quantidade de Pessoas</th>
                <th>OBS</th>
                <th>Arquivo</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="body-projeto" class="font-12 grey">
            <?php
            if($listaProjetos) {
                foreach ($listaProjetos as $projeto) {
                $arquivoProj = $oControle->getArquivosByProjeto($projeto->idProjeto);
                ?>
                <tr id="tr-id<?= $projeto->idProjeto ?>">
                    <td data-projeto><?= $projeto->nomeProjeto ?></td>
                    <td data-atividade><?= $projeto->descricaoAtividade ?></td>
                    <td data-total><?= Util::formataMoeda($projeto->totalDespesas) ?></td>
                    <td data-quant><?= $projeto->quantidadePessoas ?></td>
                    <td data-obs><?= $projeto->observacoes ?></td>
                    <td data-arquivo>
                        <?php if ($arquivoProj) {
                            echo '<a href="files/' . $arquivoProj->novoNome . '" target="_blank">' . $arquivoProj->nomeArquivo . '</a>';
                        } else {
                            echo "-";
                        }
                        ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addProjeto(<?= $projeto->idProjeto ?>)"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirProjeto(<?= $projeto->idProjeto ?>)"><i class="glyphicon
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

<div class="modal fade no-display" id="ajudaProjeto" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Projetos/Programas</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaProjeto.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade no-display" id="modalProjeto" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Projetos/Programas Sociais e/ou Ambientais</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaProjetoModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="projetoMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-projeto" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" class="styled" id="naoPossui" name="naoPossui" value="1"
                                           onchange="naoPossuiProjeto();">
                                    <label for="naoPossui" class="font-13"><strong>Não Possui</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nomeProjeto">Nome do Projeto *:</label>
                                <textarea class="form-control input-sm" id="nomeProjeto" name="projeto[nomeProjeto]"
                                          value=""  required oninvalid="setCustomValidity('Digite o Nome do Projeto.')"
                                          oninput="setCustomValidity('')" rows="2"></textarea>
                                <input type="hidden" class="form-control input-sm" id="idProjeto" name="projeto[idProjeto]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="projeto[idEmpresa]" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="projeto[dataHoraAlteracao]"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="projeto[usuarioAlteracao]"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricaoAtividade">Descrição da Atividade *:</label>
                                <textarea class="form-control input-sm" id="descricaoAtividade" name="projeto[descricaoAtividade]"
                                          value=""  required oninvalid="setCustomValidity('Digite a Descrição da Atividade.')"
                                          oninput="setCustomValidity('')" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="totalDespesas">Total de Despesas *:</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon font-12">R$</span>
                                        <input type="text" class="form-control input-sm money" id="totalDespesas"
                                               name="projeto[totalDespesas]" value="" required  oninvalid="setCustomValidity('Digite o Total de Despesas.')"
                                               oninput="setCustomValidity('')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="quantidadePessoas">Quantidade de Pessoas *:</label>
                                        <input type="text" class="form-control input-sm somentenumeros" id="quantidadePessoas"
                                               name="projeto[quantidadePessoas]" value="" required  oninvalid="setCustomValidity('Digite a Quantidade de ' +
                                                'Pessoas.')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoes">Observações:</label>
                                <textarea class="form-control input-sm" id="observacoes" name="projeto[observacoes]"  value=""  rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row " id="anexarProjeto">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivoProjeto" class="font-12 grey">Anexar Projeto/Programa: </label>
                                <input type="file" id="arquivoProjeto" name="arquivoProjeto" class="filestyle font-12" data-icon="false" >
                                <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: PDF</small>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp; </label>
                                <button class="btn btn-primary btn-sm mt-25" id="btnArquivoProj" onclick="carregaArquivoProjeto()">Carregar  &nbsp;&nbsp;&nbsp; <i
                                            class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>

                            </div>
                        </div>
                    </div>
                    <div class="row no-display" id="listaArquivoProjeto">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-12 grey">Lista de Arquivos</label>
                                <div id="arquivoProj"></div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""></label>
                                <button id="btnProjeto"  type="submit" onclick="cadProjeto()"  class="btn btn-primary btn-sm"><span class="glyphicon
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