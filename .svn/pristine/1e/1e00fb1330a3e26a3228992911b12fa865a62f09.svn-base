<?php
require_once("classes/class.Controle.php");

$oControle = new Controle();

$oCampanha = $oControle->getCampanha($_GET["idCampanha"]);

$oEmpresa = $oControle->getRowEmpresa([
    "anoBase = '{$oCampanha->anoBase}'",
    "cnpj = {$_SESSION["usuarioAtual"]["cnpj"]}"
]);

?>
<style>
    #modalResposta {
        z-index: 99999;
    }
</style>
<script>
    $(document).ready(function () {
        $("#form-cadastro-responsavel").submit(function(e){
            e.preventDefault();

            $.post("empresa-responsaveis.php?rtype=json",  $(this).serialize(), function(r){
                console.log(r);

                if(r.data && r.data !== ""){
                    $.post("api/campanha-responsavel.php", { idCampanha: new URLSearchParams(window.location.search).get("idCampanha"), idResponsaveis: r.data.idResponsaveis }, function (rs) {
                        if (rs.success) {
                            $(".modal-body", "#modalResposta").html('<img src="img/ico_success.png" />' + rs.msg)

                            $(".modal").modal('hide');

                            $("#listaResponsaveis").templates("#tpl-linha-responsavel", rs.data);

                        } else {
                            $(".modal-body", "#modalResposta").html('<img src="img/ico_error.png" />' + rs.msg)

                            $('#modalResposta').modal('show');
                        }
                    }, "json");
                }

            }, "json");
        });

        $(document).on('click', "[data-visualizar-responsavel]", function(e){
            e.preventDefault();

            $.get("api/responsaveis.php", { idResponsaveis : $(this).data('visualizar-responsavel') }, function(r){
                if(r.success){

                    if(r.data.rg == "")
                        $("#alerta-responsavel-dados").show();
                    else
                        $("#alerta-responsavel-dados").hide();

                    $("[data-nome]").html(r.data.nome);

                    $("[data-cpfpassaporte]").html(r.data.cpf_passaporte);

                    $("[data-rg]").html(r.data.rg);

                    $("[data-orgaoexpedidor]").html(r.data.orgao_expedidor);

                    $("[data-cidade]").html(r.data.cidade);

                    $("[data-estado]").html(r.data.estado);

                    $("[data-cep]").html(r.data.cep);

                    $("[data-endereco]").html(r.data.endereco);

                    $("[data-email]").html(r.data.email);

                    $("[data-cargo]").html(r.data.cargo);

                    $("[data-conselhoregional]").html(r.data.conselho_regional);

                    $("[data-arquivo]").attr("href", "img/responsaveis/"+r.data.arquivo);

                    $("#modal-visualizar-responsaveis").modal('show');
                }
            }, "json");
        });

        $(document).on("click", "[data-excluir-responsaveis]", function (e) {
            e.preventDefault();

            var id = $(this).data('excluir-responsaveis');

            confirmacao(id, "Deseja continuar com a exclusão este registro?", {
                modal_class: "modal-sm",
                callback_ok: function (idExclusao) {
                    $.get("api/campanha-responsavel.php", {
                        "acao": "excluir",
                        "idEmpresaCampanhaResponsaveis": idExclusao
                    }, function (r) {
                        if (r.success) {
                            $("#r" + idExclusao).remove();

                            $("option:first-child", "#idResponsaveis").html("selecione");

                            $("#idResponsaveis").attr("disabled", false).append("<option value='" + r.data.oResponsaveis.idResponsaveis + "'>" + r.data.oResponsaveis.nome + "</option>")
                        }
                    }, "json");
                }
            });
        });
    });
</script>
<template id="tpl-linha-responsavel">
    <tr data-attr-id="(r)idEmpresaCampanhaResponsaveis">
        <td data-content="nome"></td>
        <td data-content="cpf_passaporte"></td>
        <td data-content="email"></td>
        <td class="text-right">
            <a href="#" data-data-visualizar-responsavel="idResponsaveis" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
            <a data-data-excluir-responsaveis="idEmpresaCampanhaResponsaveis" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
        </td>
    </tr>
</template>
<div class="bg-grey p-10 mt-10 border-radius">
    <div class="row">
        <div class="col-md-10 ">
            <label class="right">Dificuldades para cadastrar responsáveis?  <a data-toggle="modal" data-target="#video-responsaveis" >Clique Aqui</a> e veja o vídeo explicativo.</label>
            <div class="form-group pull-left">

                <a class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-cadastro-responsavel"><i
                            class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</a>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <a class="btn btn-link btn-warning" title="Ajuda?" data-toggle="modal"
                   data-target="ajudaResponsaveis"><span class="glyphicon glyphicon-info-sign font-22"></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaAcionista">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="acionistaMsg"><strong></strong></p>
            </div>
        </div>
    </div>
    <table class="table table-striped font-12 grey" id="acionistaEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Nome</th>
            <th>CPF/Passaporte</th>
            <th>E-mail</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="listaResponsaveis">
        <?php
        $voResponsaveis = $oControle->getAllEmpresaCampanhaResponsaveis([
            "campanha.idCampanha = {$_GET["idCampanha"]}",
            "empresacampanha.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'",
            "empresa_campanha_responsaveis.situacao in (0,1)"
        ]);

        $me = [];

        if (is_array($voResponsaveis)) {
            foreach ($voResponsaveis as $oResponsavel) {
                $me[] = $oResponsavel->oResponsaveis->idResponsaveis;
                ?>
                <tr id="r<?= $oResponsavel->idEmpresaCampanhaResponsaveis ?>">
                    <td><?= $oResponsavel->oResponsaveis->nome ?></td>
                    <td><?= $oResponsavel->oResponsaveis->cpf_passaporte ?></td>
                    <td><?= $oResponsavel->oResponsaveis->email ?></td>
                    <td class="text-right">&nbsp;&nbsp;
                        <a href="#" data-visualizar-responsavel="<?= $oResponsavel->oResponsaveis->idResponsaveis; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a class="btn btn-primary btn-sm" data-excluir-responsaveis="<?= $oResponsavel->idEmpresaCampanhaResponsaveis ?>" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
</div>
<?php if ($oEmpresa instanceof Empresa) : ?>
    <div class="mt-10 text-center">
        <a href="dadosEmpresa.php?actionID=<?= base64_encode($oEmpresa->idEmpresa); ?>" target="_blank" class="btn btn-primary ">Visualizar documento</a>
    </div>
<?php endif; ?>
<div class="modal fade no-display" id="video-responsaveis" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Vídeo de ajuda - Cadastrar Responsáveis Pela Empresa</h4>
            </div>
            <div class="modal-body bg-grey">
                <video src="cadastro-responsaveis.mp4" controls="controls" width="100%" autoplay="false" />
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade no-display" id="ajudaRsponsaveis" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Acionistas</h4>
            </div>
            <div class="modal-body bg-grey">

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-cadastro-responsavel" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Cadastro de Responsável</h4>
            </div>
            <form method="post" action="" class="form-horizontal" id="form-cadastro-responsavel">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Estrangeiro</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="radio">
                                <input type="radio" name="estrangeiro" value="0" checked/>
                                <label>Não</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="radio">
                                <input type="radio" name="estrangeiro" value="1"/>
                                <label>Sim</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-10">
                            <label id="label_cpf_passaporte">CPF:</label>
                            <input type="text" required class="form-control" id="cpf_passaporte"
                                   name="cpf_passaporte"/>
                            <input type="hidden" id="idResponsaveis" name="idResponsaveis" value=""/>
                            <input type="hidden" name="cnpj" value="<?= $_SESSION["usuarioAtual"]["cnpj"]; ?>"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-10">
                            <label>Nome:</label>
                            <input type="text" required class="form-control" id="nome" name="nome"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-10">
                            <label>E-mail:</label>
                            <input type="text" required class="form-control" id="email" name="email"/>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-visualizar-responsaveis" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Dodos de cadastro do Responsável </h4>
            </div>
            <div class="modal-body">
                <div id="alerta-responsavel-dados" class="alert alert-warning">Este usuário ainda não completou o preenchimento das informações pessoais </div>
                <div class="col-xs-12">
                    <table class="table table-bordered font-12 dados-responsavel">
                        <tbody>
                        <tr>
                            <td colspan="3" class="col-12 col-md-12">
                                <span>Nome:</span>
                                <strong data-nome> </strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4 col-md-4">
                                <span>CPF/Passaporte:</span>
                                <strong data-cpfpassaporte> </strong>
                            </td>
                            <td class="col-4 col-md-4">
                                <span>RG:</span>
                                <strong data-rg></strong>
                            </td>
                            <td class="col-4 col-md-4">
                                <span>Orgão Expedidor:</span>
                                <strong data-orgaoexpedidor></strong>
                            </td>
                        </tr>
                        <tr>
                            <td class="col-4 col-md-4">
                                <span>Cidade:</span>
                                <strong data-cidade> </strong>
                            </td>
                            <td class="col-4 col-md-4">
                                <span>Estado:</span>
                                <strong data-estado> </strong>
                            </td>
                            <td class="col-4 col-md-4">
                                <span>CEP:</span>
                                <strong data-cep> </strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="col-6 col-md-6">
                                <span>Endereço:</span>
                                <strong data-endereco> </strong>
                            </td>
                            <td class="col-6 col-md-6">
                                <span>Email:</span>
                                <strong data-email></strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="col-6 col-md-6">
                                <span>Cargo:</span>
                                <strong data-cargo> </strong>
                            </td>
                            <td class="col-6 col-md-6">
                                <span>Conselho Regional:</span>
                                <strong data-conselhoregional> </strong>
                            </td>
                        <tr>
                        <tr>
                            <td colspan="3" class="col-6 col-md-6">
                                <span>Documento com foto:</span>
                                <a data-arquivo target="_blank" href="">Visualizar documento</a>
                            </td>
                        <tr>
                        </tbody>
                    </table>
                </div>

                <div class="clear"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modal-add-responsavel" role="dialog">
    <form id="form-add-responsavel">
        <input type="hidden" value="<?= $_GET["idCampanha"]; ?>" name="idCampanha"/>
        <div class="modal-dialog">
            <div class="modal-content font-12 grey">
                <div class="modal-header">
                    <h4 class="modal-title">Adicionar responsáveis</h4>
                </div>
                <div class="modal-body bg-grey">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <?php


                            $filtroResponsaveis = [
                                "responsaveis.situacao = 1",
                                "responsaveis_empresa.situacao = 1",
                                "responsaveis_empresa.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'"
                            ];

                            if(count($me) > 0){
                                $filtroResponsaveis[] = "responsaveis.idResponsaveis not in (" . join(",", $me) . ")";
                            }


                            $voResponsaveis = $oControle->getAllResponsaveisEmpresa($filtroResponsaveis, ["responsaveis.nome asc"]);

                            ?>

                            <select <?= is_array($voResponsaveis) ? '' : 'disabled'; ?> required class="form-control"
                                                                                        id="idResponsaveis"
                                                                                        name="idResponsaveis">
                                <?php if (is_array($voResponsaveis)) :
                                    foreach ($voResponsaveis as $k => $voResponsavel) : ?>
                                        <?php if ($k == 0) : ?>
                                            <option value="">Selecione</option>
                                        <?php endif; ?>

                                        <option value="<?= $voResponsavel->oResponsaveis->idResponsaveis ?>"><?= $voResponsavel->oResponsaveis->nome; ?></option>
                                    <?php endforeach;
                                else : ?>
                                    <option value="">Sem Responsáveis a adicionar</option>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-primary font-12">Salvar</button>
                </div>
            </div>
        </div>
    </form>
</div>

