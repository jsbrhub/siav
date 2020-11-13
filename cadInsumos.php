<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Insumos ========================= 
if($_POST){
    print ($oControle->cadastraInsumos()) ? "" : $oControle->msg; exit;
}
$insumos = $oControle->getAllInsumos();
?>
<div class="row">
    <div class="col-md-12 mb-button">
        <div class="form-group pull-right">
            <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaInsumo()"><span
                        class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
        </div>
    </div>
</div>
<div class="bg-grey border-radius">
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
        <tbody id="">
        <?php if($insumos) {
                foreach ($insumos as $insumo) { ?>
                <tr>
                    <td><?=$insumo->descricao?></td>
                    <td>asdas</td>
                    <td>sdas</td>
                    <td>asdasd</td>
                    <td>asdasd</td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></button>
                    </td>
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