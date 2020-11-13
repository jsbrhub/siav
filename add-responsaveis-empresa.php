<?php

    require_once "classes/class.Controle.php";

    require_once "classes/class.LoginUnico.php";

    $oControle = new Controle();

    unset($_SESSION["usuarioAtual"]);

    if(empty($_SESSION["usuarioLogado"]))
        header("Location: logoff");

    if(empty($_GET["cnpj"]))
        header("Location: empresas-relacionadas");


if ($_GET["ac"] == "delete" && !empty($_GET["idResponsaveis"])) {
    $voResponsaveis = $oControle->getAllResponsaveisEmpresa(["cnpj = '{$_GET["cnpj"]}'", "responsaveis.idResponsaveis = '{$_GET["idResponsaveis"]}'"]);

    if (is_array($voResponsaveis)) {
        $responsaveisBD = new ResponsaveisEmpresaBD();

        foreach ($voResponsaveis as $oResponsavel) {
            $oResponsavel->situacao = "-1";

            if($responsaveisBD->alterar($oResponsavel)){
                $voEmpresaCampanhaResponsavel = $oControle->getAllEmpresaCampanhaResponsaveis([
                    "responsaveis.idResponsaveis = {$oResponsavel->oResponsaveis->idResponsaveis}",
                    "empresacampanha.cnpj = '{$_GET["cnpj"]}'",
                    "empresa_campanha_responsaveis.situacao IN (0,1)",
                    "idEmpresaCampanhaResponsaveis NOT IN (SELECT idEmpresaCampanhaResponsaveis FROM responsaveis_assinaturas WHERE cnpj = '{$_GET["cnpj"]}' AND responsaveis.idResponsaveis = {$oResponsavel->oResponsaveis->idResponsaveis})"
                ]);

                if(is_array($voEmpresaCampanhaResponsavel)){

                    $ecrBD = new EmpresaCampanhaResponsaveisBD();

                    foreach ($voEmpresaCampanhaResponsavel as $oECR){
                        $oECR->situacao = "-1";

                        $ecrBD->alterar($oECR);
                    }
                }
            }
        }
    }
}

if (!empty($_POST["nome"])) {

    $oValidator = new ValidadorFormulario();

    if ($oValidator->validaFormularioCadastroResponsaveisEmpresa($_POST)) {

        $oResponsaveis = $oControle->getRowResponsaveis([
            "responsaveis.situacao = 1",
            "(responsaveis.email = '{$_POST["email"]}' OR responsaveis.cpf_passaporte = '{$_POST["cpf_passaporte"]}')"
        ]);

        if ($oResponsaveis === false || !empty($_POST["idResponsaveis"])) {

            if (empty($_POST["idResponsaveis"])) {
                $oResponsaveis = new Responsaveis();

                $oResponsaveis->data_cad_empresa = date("Y-m-d H:i:s");

                $oResponsaveis->situacao = "1";
            } else {
                $oResponsaveis = $oControle->getResponsaveis($_POST["idResponsaveis"]);
            }

            $resposaveisBD = new ResponsaveisBD();

            $oResponsaveis = Util::populate($oResponsaveis, $_POST);

            $oResponsaveis->cpf_passaporte = str_replace([".", "-", "/", " "], "", $oResponsaveis->cpf_passaporte);

            if (empty($_POST["idResponsaveis"])) {

                $oResponsaveis->idResponsaveis = $resposaveisBD->inserir($oResponsaveis);

                $oControle->enviaEmailCadastroResponsavel($oResponsaveis, $_GET["cnpj"]);

//                exit("enviando email para responsavel");
            } else {
                $resposaveisBD->alterar($oResponsaveis);

//                exit("alterando dados de responsavel");
            }

        }


        if (empty($_POST["idResponsaveis"])) {
            $resposaveisEmpresaBD = new ResponsaveisEmpresaBD();

            $oResponsaveisEmpresa = Util::populate(new ResponsaveisEmpresa(), [
                "oResponsaveis" => $oResponsaveis,
                "cnpj" => $_POST["cnpj"],
                "data_vinculo" => date("Y-m-d H:i:s"),
                "situacao" => "1"
            ]);

            $resposaveisEmpresaBD->inserir($oResponsaveisEmpresa);
        }

        $success = [
            "success" => true,
            "msg" => "Operação realizada com sucesso"
        ];

    } else {
        $success = [
            "success" => false,
            "msg" => $oValidator->msg
        ];
    }

}



?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
    <script src="js/dadosEmpresa.js"></script>
    <script>
        $('input[required]').on('invalid', function () {

            if ($(this).data("required-message") != "") {
                this.setCustomValidity($(this).data("required-message"));
            }

        });

        $(document).ready(function () {

            $("#cpf_passaporte").mask("999.999.999-99");

            $("input[name='estrangeiro']").change(function () {


                switch ($("input[name='estrangeiro']:checked").val()) {
                    case "1":
                        $("#label_cpf_passaporte").html("Passaporte:");
                        $("#cpf_passaporte").unmask()
                        break;
                    case "0":
                        $("#label_cpf_passaporte").html("CPF:");
                        $("#cpf_passaporte").mask("999.999.999-99");
                        break;
                }
            });

            $("[data-editar-responsavel]").click(function () {
                $.get("api/responsaveis.php", {idResponsaveis: $(this).data("id")}, function (r) {
                    if (r.success) {

                        $("[name='estrangeiro'][value='" + r.data.estrangeiro + "']").prop('checked', true);

                        $("#label_cpf_passaporte").html(r.data.estrangeiro == 1 ? "Passaporte:" : "CPF:");

                        $("#nome").val(r.data.nome);

                        $("#email").val(r.data.email);

                        $("#cpf_passaporte").val(r.data.cpf_passaporte);

                        $("#idResponsaveis").val(r.data.idResponsaveis);

                        $("#modal-cadastro-responsavel").modal("show");
                    }
                }, "json");
            });

            $("[data-visualizar-responsavel]").click(function(e){
                e.preventDefault();

                $.get("api/responsaveis.php", { idResponsaveis : $(this).data('id') }, function(r){
                    if(r.success){

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

            $("[data-excluir-responsavel]").click(function (e) {
                e.preventDefault();

                var id = $(this).data("id");

                confirmacao(id, "Deseja realmente excluir?", {
                    modal_class: "modal-sm",
                    callback_ok: function (idDados) {

                        params = new URLSearchParams(location.search);

                        window.location.href = "?cnpj="+params.get('cnpj')+"&ac=delete&idResponsaveis=" + idDados;
                    }
                });
            });

            $("#modal-cadastro-responsavel").on("hidden.bs.modal", function () {
                $("#form-cadastro-responsavel")[0].reset();

                $("#idResponsaveis").val("");

                $("#label_cpf_passaporte").html("CPF:");

                $("[name='estrangeiro'][value='0']").prop('checked', true);
            })


        });
    </script>
<style>
    .cnpj-e{
        box-shadow: 1px 1px 1px 2px;
        cursor: pointer;
    }
</style>
</head>
<body>
<?php
require_once("includes/modals.php");

include("includes/topo.php");

$voResponsveisEmpresa = $oControle->getAllResponsaveisEmpresa(["responsaveis_empresa.cnpj = '{$_GET['cnpj']}'", "responsaveis_empresa.situacao = 1", "responsaveis.situacao <> -1"]);

$vEmpresaPermissao = LoginUnico::requestEmpresaPermissao($_SESSION["usuarioLogado"]["cpf"], $_GET["cnpj"]);

?>
<div class="container">
    <? if(in_array($vEmpresaPermissao["cadastrador"], [true, 1])): ?>
    <div class="mt-10">
        <div class="bs-callout bs-callout-primary">
            <h4 class="left" style="font-size: 14px">Responsáveis pelas informações da empresa</h4>
            <a style="margin-top: -10px" class="btn btn-primary right" data-toggle="modal"
               data-target="#modal-cadastro-responsavel">Cadastrar</a>

            <div class="clear"></div>
        </div>
    </div>
            <? if(is_array($voResponsveisEmpresa)): ?>
                <div class="panel panel-default">
                    <div class="panel-heading">Usuários com acesso permitido para este CNPJ</div>
                    <div class="panel-body">
                        <table class="table-bordered table-responsive ">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Cpf</th>
                                    <th width="110"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($voResponsveisEmpresa as $oEmpResp): ?>
                                <? $oResponsavel = $oEmpResp->oResponsaveis; ?>
                                    <tr>
                                        <td><?= $oResponsavel->nome; ?></td>
                                        <td><?= $oResponsavel->email; ?></td>
                                        <td><?= Util::formataCPF($oResponsavel->cpf_passaporte) ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($oResponsavel->data_cad_externo)): ?>
                                                <a href="#" data-visualizar-responsavel  data-id="<?php echo $oResponsavel->idResponsaveis; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                                            <?php endif; ?>
                                            <?php if (empty($oResponsavel->data_cad_externo)): ?>
                                                <a href="#" data-editar-responsavel data-id="<?php echo $oResponsavel->idResponsaveis; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <?php endif; ?>
                                            <a data-id="<?php echo $oResponsavel->idResponsaveis; ?>" data-excluir-responsavel class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-trash"></i></a>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <? endif; ?>
        </div>

        <div class="modal fade" id="modal-cadastro-responsavel" tabindex="-1" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Pré-Cadastro de Responsável</h4>
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
                                    <input type="hidden" name="cnpj" value="<?= $_GET["cnpj"]; ?>"/>
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
                        <h4>Informações</h4>
                    </div>
                    <div class="modal-body">
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
    <? else : ?>
        <div class="alert alert-warning">Seu perfil de usuário não tem permissão para genrenciar o acesso da empresa selecionada!</div>
    <? endif; ?>
</div>
<?php require_once("includes/footer.php"); ?>
</body>
</html>