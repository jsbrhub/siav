<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
if($_REQUEST['dados'] == 'mercado'){
   $infoMercado = $oControle->getMercadoconsumidor($_REQUEST['idMercado']);

   if(!$infoMercado instanceof Mercadoconsumidor){
       $infoMercado = new Mercadoconsumidor();

       $infoMercado->oIncentivoempresa = $oControle->getIncentivoempresa($_REQUEST["idIncentivoEmpresa"]);
   }
   $retorno['infoMercado'] = $infoMercado;
   echo json_encode($retorno);
   exit;
}
if($_REQUEST['dados'] == 'cadastro'){

    if($oControle->cadastraMercadoconsumidor())
        $infoMercado = $oControle->getRowMercadoconsumidor(["incentivoempresa.idIncentivoEmpresa = {$_REQUEST["mercado"]["idIncentivoEmpresa"]}"]);

    echo json_encode(["infoMercado" => $infoMercado, "msg" => $oControle->msg]);

    exit;
}

if($_REQUEST['dados'] == 'edicao'){
    $idMercado = $oControle->alteraMercadoconsumidor();
    $infoMercado = $oControle->getMercadoconsumidor($idMercado);
    $retorno['id'] = $idMercado;
    $retorno['infoMercado'] = $infoMercado;
    $retorno["msg"] = $oControle->msg;
    //Util::trace($retorno);
    echo json_encode($retorno);
    exit;
}

$listaIncentivos = $oControle->listarIncentivosByIdEmpresa($idEmpresa);
?>
<div class="row">
    <div class="col-md-12 mb-button">
        <div class="form-group pull-right">
            <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaMercado()"><span
                        class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
        </div>
    </div>
</div>
<div class="bg-grey border-radius">
    <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMercado">
        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
        <p class="font-12" id="mercadoMsg"><strong></strong></p>
    </div>

    <table class="table table-striped font-12 grey " id="mercadoEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Produto/Serviço</th>
            <th>Quantidade Regional</th>
            <th>Quantidade Nacional</th>
            <th>Quantidade Exterior</th>
            <th>Total</th>
            <th></th>
        </tr>
        </thead>

            <tbody id="">
            <?php
            if($listaIncentivos) {
                foreach ($listaIncentivos as $incentivo) {
                    $mercadoConsumidor = $oControle->getListaMercadPorIncentivo($incentivo->idIncentivoEmpresa);

                    $total = $mercadoConsumidor->quantidadeRegional + $mercadoConsumidor->quantidadeNacional + $mercadoConsumidor->quantidadeExterior;
                    (!$total) ? $total = '0%' : $total = '100%';
            ?>
            <tr id="tr-mc<?=$incentivo->idIncentivoEmpresa?>">
                <td data-prod><?=$incentivo->produtoIncentivado?></td>
                <td data-quant-reg><?=($mercadoConsumidor->quantidadeRegional == '')?'0%':$mercadoConsumidor->quantidadeRegional.'%'?></td>
                <td data-quant-nac><?=($mercadoConsumidor->quantidadeNacional == '')?'0%':$mercadoConsumidor->quantidadeNacional.'%'?></td>
                <td data-quant-ext><?=($mercadoConsumidor->quantidadeExterior == '')?'0%':$mercadoConsumidor->quantidadeExterior.'%'?></td>
                <td data-total-mercado><?=$total?></td>
                <td>
                    <button class="btn btn-primary btn-sm" onclick="addMercado(<?=!empty($mercadoConsumidor->idMercado) ? $mercadoConsumidor->idMercado : 0  ?>, <?= !empty($incentivo->idIncentivoEmpresa) ? $incentivo->idIncentivoEmpresa : 0  ?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                </td>
            </tr>
                <?php
                }
            }
            ?>
            </tbody>

    </table>
</div>
<div class="modal fade no-display" id="ajudaMercado" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Mercado Consumidor</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaMercado.php";
                ?>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalMercado" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Mercado Consumidor</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMercadoModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="mercadoMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                    <form role="form" onsubmit="return false;" id="form-mercado" class="" >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label for="produtoIncent">Produto/Serviço Incentivado*:</label>
                                <input type="text" class="form-control input-sm" id="produtoIncentM" name="produtoIncentM"
                                       value="" disabled >
                                <input type="hidden" class="form-control input-sm" id="idMercado" name="mercado[idMercado]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idIncentivoEmpresa" name="mercado[idIncentivoEmpresa]" value="" >
                                    <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="mercado[dataHoraAlteracao]"
                                           value="<?=date("d/m/Y H:i:s")?>">
                                    <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="mercado[usuarioAlteracao]"
                                           value="<?=$_SESSION['usuarioAtual']['login']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="quantidadeRegional">Quant. Regional (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeRegional" name="mercado[quantidadeRegional]"
                                       value=""  >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="quantidadeNacional">Quant. Nacional (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeNacional" name="mercado[quantidadeNacional]"
                                       value=""  >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <label for="quantidadeExterior">Quant. Exterior (%) *:</label>
                                <input type="text" class="form-control input-sm" id="quantidadeExterior" name="mercado[quantidadeExterior]"
                                       value="" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">

                                    <button id="btnMercado"  type="submit" onclick="cadMercado(); return false;"
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