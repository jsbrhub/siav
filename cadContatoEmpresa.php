<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$displayTab = "no-display";
$listaContato = $oControle->getTodosContatosEmpresa($idEmpresa); if($listaContato) $displayTab = '';

$retorno = [];
if($_REQUEST['dados'] == 'contato'){
    $infoContato = $oControle->getContatoempresa($_REQUEST['idContatoEmpresa']);
    $retorno['infoContato'] = $infoContato;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'cadastro'){
    print ($id = $oControle->cadastraContatoempresa()) ? "" : $oControle->msg;
    $retorno['id'] = $id;
    $retorno['msg'] =  $oControle->msg;
    $infoContato = $oControle->getContatoempresa($id);
    $retorno['infoContato'] = $infoContato;
    $itemTabela = '<tr id="tr-id'.$infoContato->idContatoEmpresa.'">
                    <td data-contato>'.$infoContato->contato.'</td>
                    <td data-funcao>'.$infoContato->funcao.'</td>
                    <td data-email>'.$infoContato->email.'</td>
                    <td data-telefone>'.$infoContato->telefone.'</td>
                    <td><button class="btn btn-primary btn-sm" onclick="addContato('.$infoContato->idContatoEmpresa.')" title="Editar"><i class="glyphicon glyphicon-pencil"></i> 
                    </button></td>
                    <td><button class="btn btn-primary btn-sm" onclick="excluirContato('.$infoContato->idContatoEmpresa.')" title="Excluir"><i class="glyphicon glyphicon-trash"></i> 
                    </button></td>
            </tr>';
    $retorno['itemTabela'] = $itemTabela;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'edicao'){
    $idContatoEmpresa = $oControle->alteraContatoempresa();
    $retorno["id"] = $idContatoEmpresa;
    $retorno["msg"] = $oControle->msg;
    $infoContato = $oControle->getContatoempresa($idContatoEmpresa);
    $retorno["infoContato"] = $infoContato;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'excluir'){
    if(!$oControle->excluiContatoempresa($_REQUEST['idContatoEmpresa'])){
        $retorno["msg"] = $oControle->msg;
    }else {
        $retorno["msg"] = "1";
    }
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'quantidade'){
    $contatosEmpresa = $oControle->getTodosContatosEmpresa($_REQUEST['idEmpresa']);
    if(is_array($contatosEmpresa)){
        $quantidade = count($contatosEmpresa);
    }else{
        $quantidade = 0;
    }

    $retorno['quantidade'] = $quantidade;
    echo json_encode($retorno);
    exit;
}


?>

    <div class="bg-grey p-10 mt-10">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group pull-left">
                    <button id="addContato" class="btn btn-primary btn-sm" onclick="addContato(0)"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-group pull-right">
                    <small class="grey"><strong>*Cadastrar pelo menos dois contatos da empresa.</strong></small>
                </div>
            </div>
            <div class="col-md-1 ">
                <div class="form-group pull-right">
                    <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaContato()"><span
                                class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-dismissible fade in alert-info no-display" id="alertaContato">
                    <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                    <p class="font-12" id="contatoMsg"><strong></strong></p>
                </div>
            </div>
        </div>
        <table class="table table-striped font-12 grey <?=$displayTab?>" id="contatosEmpresa">
            <thead>
            <tr class="bg-grey grey font-13">
                <th>Nome do Contato</th>
                <th>Função</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody id="listaContato">
            <?php
            if($listaContato){

                foreach ($listaContato as $contato){?>
                    <tr id="tr-id<?=$contato->idContatoEmpresa?>">
                        <td data-contato><?=$contato->contato?></td>
                        <td data-funcao><?=$contato->funcao?></td>
                        <td data-email><?=$contato->email?></td>
                        <td data-telefone><?=$contato->telefone?></td>
                        <td><button class="btn btn-primary btn-sm" onclick="addContato(<?=$contato->idContatoEmpresa?>)" title="Editar"><i class="glyphicon
                        glyphicon-pencil"></i>
                            </button></td>
                        <td><button class="btn btn-primary btn-sm" onclick="excluirContato(<?=$contato->idContatoEmpresa?>)" title="Excluir"><i class="glyphicon
                        glyphicon-trash"></i>
                            </button></td>
                    </tr>
                <?php    }

             }
            ?>

            </tbody>
        </table>
    </div>

<div class="modal fade no-display" id="ajudaContato" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Acionistas</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaContato.php";
                ?>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalCadContato" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar Contato</h4>
            </div>
            <div class="modal-body bg-grey">

                    <div class="alert alert-dismissible fade in alert-info no-display" id="alertaContatoModal">
                        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                        <p class="font-12" id="contatoMsgModal"><strong></strong></p>
                    </div>

                <form role="form" onsubmit="return false;" id="form-contato" class="">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="contato">Nome do Contato*:</label>
                                <input type="text" class="form-control input-sm" id="contato" name="contato[contato]"
                                       value=""  required oninvalid="setCustomValidity('Digite o Nome do Contato.')"
                                       oninput="setCustomValidity('')">
                                <input type="hidden" class="form-control input-sm" id="idContatoEmpresa"
                                       name="contato[idContatoEmpresa]"
                                       value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa"
                                       name="contato[idEmpresa]"
                                       value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="contato[dataHoraAlteracao]"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="contato[usuarioAlteracao]"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="funcao">Função na Empresa*:</label>
                                <input type="text" class="form-control input-sm" id="funcao" name="contato[funcao]"
                                       value=""  required oninvalid="setCustomValidity('Digite a Função na Empresa.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="email">E-mail*:</label>
                                <input type="email" class="form-control input-sm" id="email" name="contato[email]"
                                       value=""  required oninvalid="setCustomValidity('Digite o E-mail.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefone">Telefone*:</label>
                                <input type="text" class="form-control input-sm telefone" id="telefone"
                                       name="contato[telefone]"
                                       value=""  required oninvalid="setCustomValidity('Digite o Telefone.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <button id="btnContato"  type="submit" onclick="cadContato(); return false;"
                                        class="btn
                                btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Salvar</button>
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
					
