<?php

require_once("classes/class.Controle.php");

$oControle = new Controle();

if (!empty($_POST["idEmpresaCampanhaResponsaveis"])) {

    sleep(1);

    $success = [ "success" => true ];

    $checkAssinatura = $oControle->getRowResponsaveisAssinaturas([
        "responsaveis_assinaturas.idEmpresaCampanhaREsponsaveis = '{$_POST["idEmpresaCampanhaResponsaveis"]}'",
        "responsaveis.idResponsaveis = '{$_SESSION["usuarioAtual"]["idResponsaveis"]}'",
        "responsaveis_assinaturas.situacao = 1"
    ]);

    if ($checkAssinatura instanceof ResponsaveisAssinaturas) {
        $success = [
            "success" => false,
            "msg" => "você já assinou este documento"
        ];
    }

    if ($success["success"]) {

        $oResponsavel = $oControle->getRowResponsaveis([
            "cpf_passaporte = '{$_SESSION["usuarioAtual"]["cpf_passaporte"]}'"
        ]);

        if ($oResponsavel instanceof Responsaveis) {

            $oEmpresaCampanhaResponsaveis = $oControle->getEmpresaCampanhaResponsaveis($_POST["idEmpresaCampanhaResponsaveis"]);

            $BDResponsaveisAssinatureas = new ResponsaveisAssinaturasBD();

            $oResponsaveisAssinatura = Util::populate(new ResponsaveisAssinaturas(), [
                "oResponsaveis" => $oResponsavel,
                "oEmpresaCampanhaResponsaveis" => $oEmpresaCampanhaResponsaveis,
                "data_assinatura" => date('Y-m-d H:i:s'),
                "cnpj" => $oEmpresaCampanhaResponsaveis->oEmpresacampanha->cnpj,
                "situacao" => '1'

            ]);

            $BDResponsaveisAssinatureas->inserir($oResponsaveisAssinatura);

            $success = [
                "success" => true,
                "msg" => "Operação realizada com sucesso"
            ];
        } else {
            $success = [
                "success" => false,
                "msg" => "dados de Autenticação incorretos"
            ];
        }
    }

}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        $('input[required]').on('invalid', function () {

            if ($(this).data("required-message") != "") {
                this.setCustomValidity($(this).data("required-message"));
            }

        });

        $(document).ready(function () {
            $("[data-assinar-documento]").click(function () {

                var idEmpresaCampanhaResponsaveis = $(this).data('assinar-documento');

                $("#idEmpresaCampanhaResponsaveis").val(idEmpresaCampanhaResponsaveis);

                $("#modal-assinar-documento").modal('show');
            })
        });
    </script>
    <style>
        .bs-callout {
            padding: 20px 20px 10px;
        }

        tr.disabled td {
            text-decoration: line-through;
            color: #d2d2d2;
        }
        .box-check{
            padding: 10px;
            font-size: 12px;
            margin-top: 40px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");

?>
<div class="container">

    <?php if(!empty($_SESSION["usuarioLogado"])){ ?>
        <a class="btn btn-primary right" href="empresas-relacionadas"> Voltar para empresas Relacionadas</a>
        <div class="clear"></div>
        <br />
    <? } ?>

    <div class="border-radius bg-grey font-12  p-20 ">
        <?php if (is_array($success)): ?>
            <div class="alert alert-<?= $success["success"] ? "success" : "danger"; ?>">
                <?= $success["msg"]; ?>
            </div>
        <?php endif; ?>
        <?php
        $voEmpresaCampanhaResponsaveis = $oControle->getAllEmpresaCampanhaResponsaveis([
            "empresa_campanha_responsaveis.situacao = 1",
            "campanha.situacao in (2, 4)",
            "responsaveis.idResponsaveis = {$_SESSION["usuarioAtual"]["idResponsaveis"]}"
        ]);

        if (is_array($voEmpresaCampanhaResponsaveis)) {
            //organiza resultado por emrpesa
            foreach ($voEmpresaCampanhaResponsaveis as $oEmpresaCampanhaResponsavel) {
                $empresas[$oEmpresaCampanhaResponsavel->oEmpresacampanha->cnpj][] = $oEmpresaCampanhaResponsavel;
            }


            foreach ($empresas as $k => $oEmpresaCampanhaResponsavel) {
                ?>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title font-12 grey">
                                <a data-toggle="collapse" data-parent="#accordion" href="#listaCadastro<?= $k ?>"
                                   style="text-decoration: none">
                                    <i class="glyphicon glyphicon-asterisk"></i> &nbsp;<?= Util::formataCNPJ($k); ?>
                                </a>
                            </h4>
                        </div>

                        <div id="listaCadastro<?= $k ?>" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul class="list-group">
                                    <?php
                                    foreach ($oEmpresaCampanhaResponsavel as $item) {
                                        $assinatura = $oControle->getRowResponsaveisAssinaturas([
                                            "responsaveis.idResponsaveis = {$_SESSION["usuarioAtual"]["idResponsaveis"]}",
                                            "empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis ={$item->idEmpresaCampanhaResponsaveis}",
                                            "responsaveis_assinaturas.situacao = 1"
                                        ]);

                                        $oEmpresa = $oControle->getRowEmpresa([
                                            "anoBase = '{$item->oCampanha->anoBase}'",
                                            "cnpj = '{$item->oEmpresacampanha->cnpj}'"
                                        ]);

                                        ?>
                                        <li class="list-group-item list-group-item-info">
                                            <span class="glyphicon glyphicon-hand-right"></span>&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a style="text-decoration: none"
                                               class="pointer"><strong><?= $item->oCampanha->campanha; ?></strong> </a>
                                            <div class="right">
                                                <?php if (!($assinatura instanceof ResponsaveisAssinaturas)): ?>
                                                    <a data-assinar-documento="<?= $item->idEmpresaCampanhaResponsaveis ?>"
                                                       class="btn btn-primary btn-sm" title="Assinar"><i
                                                                class="glyphicon glyphicon-edit"></i></a>
                                                <?php endif; ?>
                                                <?php if ($oEmpresa instanceof Empresa): ?>
                                                    <a href="dadosEmpresa.php?actionID=<?= base64_encode($oEmpresa->idEmpresa); ?>"
                                                       target="_blank" class="btn btn-primary btn-sm"
                                                       title="Visualizar"><i class="glyphicon glyphicon-eye-open"></i></a>
                                                <?php endif; ?>
                                            </div>
                                            <div class="clear"></div>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } else { ?>
            <div class="col-md-12 text-center">
                Nenhum documento foi atribuido a você para avaliação e assinatura até o momento!
            </div>
        <?php } ?>
        <div style="clear: both;"></div>
    </div>
</div>


<form id="form-assinar-documento" method="post">
    <div class="modal fade" id="modal-assinar-documento" role="dialog" data-backdrop="static">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Assinar documento</h4>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12">
                        <input type="hidden" name="idEmpresaCampanhaResponsaveis" id="idEmpresaCampanhaResponsaveis"/>
                        <div class="form-group">
                            <span>Usuário</span>
                            <input type="text" class="form-control" disabled
                                   value="<?= $_SESSION["usuarioAtual"]["nome"] ?>"/>
                        </div>
                        <div class="box-check bg-grey">
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" class="styled" id="aceito_assinatura" name="aceito_assinatura" value="1" required />
                                <label for="aceito">Concordo com os dados preenchidos e afirmo que são verdadeiros.</label>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secundary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Assinar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<?php require_once("includes/footer.php") ?>
</body>
</html>