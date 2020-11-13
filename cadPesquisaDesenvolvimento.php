<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$listaProjetos = $oControle->getAllPesquisasByEmpresa($idEmpresa);
$infoEmpresa = $oControle->getEmpresa($idEmpresa);
$naoPossuiProjeto = $infoEmpresa->projetoSocial;
$retorno = [];
// ================= Cadastrar Projsocioambiental ========================= 
if($_REQUEST['dados'] == 'cadastro'){
    print ($id = $oControle->cadastraPesquisadesenvolvimento()) ? "" : $oControle->msg;
    $oControle->updatePesquisaEmpresa($_REQUEST['projeto']['idEmpresa'],'0');
    $arqProj = $oControle->retornaArquivoPesquisaByEmpresa($_REQUEST['projeto']['idEmpresa']);
    if($arqProj) {
        $ArquivoProjetoBD = new ArquivopesquisaBD();
        $ArquivoProjeto_POST = ['oPesquisadesenvolvimento' => new Pesquisadesenvolvimento($id), 'nomeArquivo' => $arqProj->nomeArquivo, 'novoNome' => $arqProj->novoNome, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
        $oArquivoprojeto = Util::populate(new Arquivopesquisa(), $ArquivoProjeto_POST);
        $idArquivoProj = $ArquivoProjetoBD->inserir($oArquivoprojeto);
        $oControle->excluiArquivoempresa($arqProj->idArquivoEmpresa);
        $retorno['idArquivoProjeto'] = $idArquivoProj;
        $infoArquivo = $oControle->getArquivopesquisa($idArquivoProj);
        $retorno['infoArquivo'] = $infoArquivo;
        $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPesquisa('.$infoArquivo->idArquivoPesq.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';

    }
    if(!$linkArquivo){$linkArquivo = '';}
    $infoProjeto = $oControle->getPesquisadesenvolvimento($id);
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['itemProjeto'] = '
                            <tr id="tr-id'.$infoProjeto->idPesquisa.'">
                    <td data-projeto>'.$infoProjeto->nomeProjeto.'</td>
                    <td data-atividade>'.$infoProjeto->descricaoAtividade.'</td>
                    <td data-total>'.Util::formataMoeda($infoProjeto->totalDespesas).'</td>
                    <td data-quant>'.$infoProjeto->quantidadePessoas.'</td>
                    <td data-obs>'.$infoProjeto->observacoes.'</td>
                    <td data-arq>'.$linkArquivo.'</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addPesquisa('.$infoProjeto->idPesquisa.')"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirPesquisa('.$infoProjeto->idPesquisa.')"><i class="glyphicon
                        glyphicon-trash"></i></button>
                    </td>
                </tr>';

    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'edicao'){
    $id = $oControle->alteraPesquisadesenvolvimento();
    $infoProjeto = $oControle->getPesquisadesenvolvimento($id);
    $infoArquivo = $oControle->getArquivosByPesquisa($id);
    if($infoArquivo)
        $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    if(!$linkArquivo){$linkArquivo = '-';}
    $retorno['id'] = $id;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['linkArquivo'] = $linkArquivo;

    $retorno["infoProjeto"]->totalDespesas = Util::formataMoeda($retorno["infoProjeto"]->totalDespesas);
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'projeto'){

    $infoProjeto = $oControle->getPesquisadesenvolvimento($_REQUEST['idPesquisa']);
    $infoArquivo = $oControle->getArquivosByPesquisa($_REQUEST['idPesquisa']);
    $retorno['id'] = $infoProjeto->idPesquisa;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoProjeto'] = $infoProjeto;
    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPesquisa('.$infoArquivo->idArquivoPesq.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'pesquisa'){
    $infoEmpresa = $oControle->getPesquisadesenvolvimento($_REQUEST['idPesquisa']);

    $oAp = $oControle->getRowArquivopesquisa(["arquivopesquisa.idPesquisa = {$infoEmpresa->idPesquisa}"]);

    if($oAp instanceof Arquivopesquisa){
        $retorno['infoArquivo'] = $oAp;
        $retorno['listaArquivo'] = '<ul><li><a href="files/'.$oAp->novoNome.'" target="_blank">'.$oAp->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPesquisa('.$oAp->idArquivoPesq.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    }

    $infoEmpresa->totalDespesas = Util::formataMoeda($infoEmpresa->totalDespesas);

    $retorno['infoPesquisa'] = $infoEmpresa;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'excluir'){
    $infoArquivo = $oControle->getArquivosByPesquisa($_REQUEST['idPesquisa']);

    if($infoArquivo){
        unlink("files/".$infoArquivo->novoNome);

        $oControle->excluiArquivopesquisa($infoArquivo->idArquivoPesq);
    }

    if(!$oControle->excluiPesquisadesenvolvimento($_REQUEST['idPesquisa'])){
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
            if(!$_REQUEST['projeto']['idPesquisa']){
                $ArquivoempresaBD = new ArquivoempresaBD();
                $Arquivoempresa_POST = ['oEmpresa' => new Empresa($_REQUEST['projeto']['idEmpresa']),'oTipoarquivo' =>new Tipoarquivo('11'), 'nomeArquivo' => $_FILES['arquivoProjeto']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
                $idArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);
                $retorno['idArquivoEmpresa'] = $idArquivoEmpresa;
                $infoArquivo = $oControle->getArquivoempresa($idArquivoEmpresa);
            }else{
                $ArquivoProjetoBD = new ArquivopesquisaBD();
                $ArquivoProjeto_POST = ['oPesquisadesenvolvimento' => new Pesquisadesenvolvimento($_REQUEST['projeto']['idPesquisa']), 'nomeArquivo' => $_FILES['arquivoProjeto']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoprojeto = Util::populate(new Arquivopesquisa(), $ArquivoProjeto_POST);
                $idArquivoProj = $ArquivoProjetoBD->inserir($oArquivoprojeto);
                $infoArquivo = $oControle->getArquivopesquisa($idArquivoProj);
            }
            $retorno['infoArquivo'] = $infoArquivo;
            $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoPesquisa('.$infoArquivo->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
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
    $oAe = $oControle->getArquivoempresa($_REQUEST['idArquivoPesq']);

    $oAp = $oControle->getArquivopesquisa($_REQUEST['idArquivoPesq']);

    if($oAe instanceof Arquivoempresa)
        unlink("files/".$oAe->novoNome);

    if($oAe instanceof Arquivopesquisa){
        unlink("files/".$oAe->novoNome);

        $oControle->excluiArquivopesquisa($_REQUEST['idArquivoPesq']);

        if(!$oControle->excluiArquivopesquisa($_REQUEST['idArquivoPesq'])){ echo "1"; } else {  echo "0"; }
        exit;
    }

    if(!$oControle->excluiArquivoempresa($_REQUEST['idArquivoPesq'])){ echo "1"; } else {  echo "0"; }
    exit;
}

?>
<div class="bg-grey p-10 mt-10 border-radius">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group font-12 grey">
                <strong>Pesquisa e Desenvolvimento</strong>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 ">
            <div class="form-group pull-left">
                <button id="addProjeto" class="btn btn-primary btn-sm" onclick="addPesquisa(0)"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaPesquisa()"><span
                            class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
            </div>
        </div>
    </div>
    <div class="row <?=($naoPossuiProjeto == '1')?'':'no-display'?>">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info" id="alertaPesquisaNaoPossui">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12"><strong>Empresa não possui Pesquisa e Desenvolvimento.</strong></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaPesquisa">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="pesquisaMsg"><strong></strong></p>
            </div>
        </div>
    </div>

        <table class="table table-striped font-12 grey <?=($listaProjetos != '')?'':'no-display'?>" id="projetoEmpresaPesquisa">
            <thead>
            <tr class="bg-grey grey font-13">
                <th>Nome do Projeto</th>
                <th>Descrição da Atividade</th>
                <th>Total Investido</th>
                <th>Quantidade de Pessoas</th>
                <th>OBS</th>
                <th>Arquivo</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="body-pesquisa" class="font-12 grey">
            <?php
            if($listaProjetos) {
                foreach ($listaProjetos as $projeto) {
                $arquivoProj = $oControle->getArquivosByPesquisa($projeto->idPesquisa);
                ?>
                <tr id="tr-id<?= $projeto->idPesquisa ?>">
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
                        <button class="btn btn-primary btn-sm" onclick="addPesquisa(<?= $projeto->idPesquisa ?>)"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="excluirPesquisa(<?= $projeto->idPesquisa ?>)"><i class="glyphicon
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

<div class="modal fade no-display" id="ajudaPesquisa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Pesquisa e Desenvolvimento</h4>
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


<div class="modal fade no-display" id="modalPesquisa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Pesquisa e Desenvolvimento</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaPesquisaModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="pesquisaMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-pesquisa" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group ">
                            <div class="col-sm-12">
                                <div class="checkbox checkbox-primary">
                                    <input type="checkbox" class="styled" id="naoPossuiPesquisa" name="naoPossui" value="1"
                                           onchange="naoPossuiProjeto();">
                                    <label for="naoPossui" class="font-13"><strong>Não Possui</strong></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nomeProjetoEmpresa">Nome do Projeto *:</label>
                                <textarea class="form-control input-sm" id="nomeProjetoEmpresa" name="projeto[nomeProjeto]"
                                          value=""  required oninvalid="setCustomValidity('Digite o Nome do Projeto.')"
                                          oninput="setCustomValidity('')" rows="2"></textarea>
                                <input type="hidden" class="form-control input-sm" id="idPesquisa" name="projeto[idPesquisa]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresaPesquisa" name="projeto[idEmpresa]" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracaoPesquisa" name="projeto[dataHoraAlteracao]"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="projeto[usuarioAlteracao]"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricaoAtividadeEmpresa">Descrição da Atividade *:</label>
                                <textarea class="form-control input-sm" id="descricaoAtividadeEmpresa" name="projeto[descricaoAtividade]"
                                          value=""  required oninvalid="setCustomValidity('Digite a Descrição da Atividade.')"
                                          oninput="setCustomValidity('')" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="totalDespesasEmpresa">Total investido *:</label>
                                <div class="controls">
                                    <div class="input-group">
                                        <span class="input-group-addon font-12">R$</span>
                                        <input type="text" class="form-control input-sm money" id="totalDespesasEmpresa"
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
                                <label for="quantidadePessoasEmpresa">Quantidade de Pessoas *:</label>
                                        <input type="text" class="form-control input-sm somentenumeros" id="quantidadePessoasEmpresa"
                                               name="projeto[quantidadePessoas]" value="" required  oninvalid="setCustomValidity('Digite a Quantidade de ' +
                                                'Pessoas.')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="observacoesEmpresa">Observações:</label>
                                <textarea class="form-control input-sm" id="observacoesEmpresa" name="projeto[observacoes]"  value=""  rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row " id="anexarProjetoEmpresa">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivoProjetoEmpresa" class="font-12 grey">Anexar Projeto/Programa: </label>
                                <input type="file" id="arquivoProjetoEmpresa" name="arquivoProjeto" class="filestyle font-12" data-icon="false" >
                                <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: PDF</small>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp; </label>
                                <button class="btn btn-primary btn-sm mt-25" id="btnArquivoPesq" onclick="carregaArquivoPesquisa()">Carregar  &nbsp;&nbsp;&nbsp; <i
                                            class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>

                            </div>
                        </div>
                    </div>
                    <div class="row no-display" id="listaArquivoEmpresa">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-12 grey">Lista de Arquivos</label>
                                <div id="arquivoPesq"></div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""></label>
                                <button id="btnPesquisa"  type="submit" onclick="cadPesquisa()"  class="btn btn-primary btn-sm"><span class="glyphicon
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