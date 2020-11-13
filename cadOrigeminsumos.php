<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
if($_REQUEST['dados'] == 'origem'){
    $infoOrigem = $oControle->getOrigeminsumos($_REQUEST['idOrigemInsumos']);
    $retorno['infoOrigem'] = $infoOrigem;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'edicao'){
    $idOrigemInsumos = $oControle->alteraOrigeminsumos();
    $infoOrigem = $oControle->getOrigeminsumos($idOrigemInsumos);
    $retorno['id'] = $idOrigemInsumos;
    $retorno['msg'] = $oControle->msg;
    $retorno['infoOrigem'] = $infoOrigem;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'cadastro'){
    $insumo = $_REQUEST['origem']['insumo'];
    $postInsumo = ['idInsumo' => '','descricao' => $insumo];
    //Util::trace($postInsumo);
    $InsumosBD = new InsumosBD();
    $oInsumos = Util::populate(new Insumos(),$postInsumo);
    $idInsumo = $InsumosBD->inserir($oInsumos);
    $_REQUEST['origem']['idInsumo'] = $idInsumo;
    $oOrigemInsumos = $_REQUEST['origem'];
    //Util::trace($oOrigemInsumos);
    if(!$idOrigemInsumos = $oControle->cadastraOrigeminsumos()){
        $retorno['erro'] = '1';
    }else{
        $origemInsumo = $oControle->getOrigeminsumos($idOrigemInsumos);

        $itemTabela = ' <tr id="tr-id'.$origemInsumo->idOrigemInsumos.'">
                    <td data-insumo>'.$origemInsumo->oInsumos->descricao.'</td>
                    <td data-quant-reg>'.((!$origemInsumo->quantidadeRegional)?'0':$origemInsumo->quantidadeRegional).'</td>
                    <td data-quant-nac>'.((!$origemInsumo->quantidadeNacional)?'0':$origemInsumo->quantidadeNacional).'</td>
                    <td data-quant-ext>'.((!$origemInsumo->quantidadeExterior)?'0':$origemInsumo->quantidadeExterior).'</td>
                    <td data-total-origem>100%</td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addOrigem('.$origemInsumo->idOrigemInsumos.')"><i class="glyphicon
                        glyphicon-pencil"></i></button>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm" onclick="excluirOrigem('.$origemInsumo->idOrigemInsumos.')"><i class="glyphicon
                        glyphicon-trash"></i></button>
                    </td>
                </tr>';
        $retorno['infoOrigem'] = $origemInsumo;
        $retorno['itemTabela'] = $itemTabela;

    }
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'excluir'){
    if(!$oControle->excluiOrigeminsumos($_REQUEST['idOrigemInsumos'])){
        $retorno['del'] = '0';
    }else{
        $retorno['del'] = '1';
    }
    echo json_encode($retorno);
    exit;
}


$insumos = $oControle->getListaOrigemInsumosPorEmpresa($idEmpresa);
//Util::trace($insumos,false);

?>
<div class="row p-10 mt-10">
    <div class="col-md-2">
        <div class="form-group pull-left">
            <button id="addProjeto" class="btn btn-primary btn-sm" onclick="addInsumo()"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
        </div>
    </div>
    <div class="col-md-10 mb-button">
        <div class="form-group pull-right">
            <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaInsumo()"><span
                        class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
        </div>
    </div>
</div>
<div class="bg-grey border-radius">
    <div class="alert alert-dismissible fade in alert-info no-display" id="alertaOrigem">
        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
        <p class="font-12" id="origemMsg"><strong></strong></p>
    </div>
    <table class="table table-striped font-12 grey " id="insumosEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Insumos</th>
            <th>Regional</th>
            <th>Nacional</th>
            <th>Exterior</th>
            <th>Total</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body-insumos">
        <?php if($insumos) {
            foreach ($insumos as $insumo) {

                $editar = '<button class="btn btn-primary btn-sm" onclick="addOrigem('.$insumo->idOrigemInsumos.')"><i class="glyphicon
                        glyphicon-pencil"></i></button>';
                $excluir = '<button class="btn btn-primary btn-sm" onclick="excluirOrigem('.$insumo->idOrigemInsumos.')"><i class="glyphicon
                        glyphicon-trash"></i></button>';

                switch ($insumo->oInsumos->idInsumo){
                    case '1':
                        $excluir = '';
                        break;
                    case '2':
                        $excluir = '';
                        break;
                    case '3':
                        $excluir = '';
                        break;
                    case '6':
                        $excluir = '';
                        break;
                }

                $total = $insumo->quantidadeRegional + $insumo->quantidadeNacional + $insumo->quantidadeExterior;
                (!$total) ? $total = '0' : $total;
                ?>
                <tr id="tr-id<?=$insumo->idOrigemInsumos?>">
                    <td data-insumo><?=$insumo->oInsumos->descricao?></td>
                    <td data-quant-reg><?=($insumo->quantidadeRegional == '')?'0%':$insumo->quantidadeRegional.'%'?></td>
                    <td data-quant-nac><?=($insumo->quantidadeNacional == '')?'0%':$insumo->quantidadeNacional.'%'?></td>
                    <td data-quant-ext><?=($insumo->quantidadeExterior == '')?'0%':$insumo->quantidadeExterior.'%'?></td>
                    <td data-total-origem><?=$total."%"?></td>
                    <td><?=$editar?>&nbsp;&nbsp;<?=$excluir?></td>
                </tr>
                <?php
            }
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal fade no-display" id="ajudaInsumo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Origem de Insumos</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaInsumos.php";
                ?>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalInsumo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Origem de Insumos</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaOrigemModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="origemMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-origem" class="" >
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="insumo">Insumo *:</label>
                                <input type="text" class="form-control input-sm" id="insumo" name="origem[insumo]"
                                       value="" disabled >
                                <input type="hidden" class="form-control input-sm" id="idOrigemInsumos" name="origem[idOrigemInsumos]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="origem[idEmpresa]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idInsumo" name="origem[idInsumo]" value="" >
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeRegional">Quant. Regional (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeRegional" name="origem[quantidadeRegional]"
                                       value=""  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeNacional">Quant. Nacional (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeNacional" name="origem[quantidadeNacional]"
                                       value=""  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeExterior">Quant. Exterior (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeExterior" name="origem[quantidadeExterior]"
                                       value="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">

                                <button id="btnOrigem"  type="submit" onclick="cadOrigem(); return false;"
                                        class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Salvar</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="font-10 pull-right"><strong>* A somatória das quantidades deve ser 100%.</strong></span>
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

<div class="modal fade no-display" id="modalCadInsumo" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Origem de Insumos</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaInsumoModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="insumoMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-insumo" class="" >
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="insumo">Insumo *:</label>
                                <input type="text" class="form-control input-sm" id="insumo" name="origem[insumo]"
                                       value="" >
                                <input type="hidden" class="form-control input-sm" id="idOrigemInsumos" name="origem[idOrigemInsumos]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="origem[idEmpresa]" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="idInsumo" name="origem[idInsumo]" value="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeRegional">Quant. Regional (%) *:</label>
                                <input type="text" class="form-control input-sm somentenumeros" id="quantidadeRegional" name="origem[quantidadeRegional]"
                                       value=""  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeNacional">Quant. Nacional (%) *:</label>
                                <input type="text" class="form-control input-sm somentenumeros" id="quantidadeNacional" name="origem[quantidadeNacional]"
                                       value=""  >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidadeExterior">Quant. Exterior (%) *:</label>
                                <input type="text" class="form-control input-sm somentenumeros" id="quantidadeExterior" name="origem[quantidadeExterior]"
                                       value="" >
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">

                                <button id="btnOrigem"  type="submit" onclick="cadInsumo(); return false;"
                                        class="btn btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Salvar</button>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <span class="font-10 pull-right"><strong>* A somatória das quantidades deve ser 100%.</strong></span>
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