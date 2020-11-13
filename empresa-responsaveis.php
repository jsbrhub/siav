<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 27/09/2018
 * Time: 14:29
 */

require_once "classes/class.Controle.php";

$oControle = new Controle();


if ($_GET["ac"] == "delete" && !empty($_GET["idResponsaveis"])) {
    $voResponsaveis = $oControle->getAllResponsaveisEmpresa(["cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'", "responsaveis.idResponsaveis = '{$_GET["idResponsaveis"]}'"]);

    if (is_array($voResponsaveis)) {
        $responsaveisBD = new ResponsaveisEmpresaBD();

        foreach ($voResponsaveis as $oResponsavel) {
            $oResponsavel->situacao = "-1";

            if($responsaveisBD->alterar($oResponsavel)){
                $voEmpresaCampanhaResponsavel = $oControle->getAllEmpresaCampanhaResponsaveis([
                    "responsaveis.idResponsaveis = {$oResponsavel->oResponsaveis->idResponsaveis}",
                    "empresacampanha.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'",
                    "empresa_campanha_responsaveis.situacao IN (0,1)",
                    "idEmpresaCampanhaResponsaveis NOT IN (SELECT idEmpresaCampanhaResponsaveis FROM responsaveis_assinaturas WHERE cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}' AND responsaveis.idResponsaveis = {$oResponsavel->oResponsaveis->idResponsaveis})"
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

if ($_GET["ac"] == "toggle_status" && !empty($_GET["idResponsaveis"])) {
    $oResponsaveis = $oControle->getResponsaveis($_GET["idResponsaveis"]);

    if ($oResponsaveis instanceof Responsaveis) {
        $responsaveisBD = new ResponsaveisBD();

        $oResponsaveis->situacao = $oResponsaveis->situacao == "0" ? "1" : "0";

        $responsaveisBD->alterar($oResponsaveis);
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

                $oControle->enviaEmailCadastroResponsavel($oResponsaveis, $_SESSION["usuarioAtual"]["cnpj"]);

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
            "data" => $oResponsaveis,
            "msg" => "Operação realizada com sucesso"
        ];

    } else {
        if($oValidator->oResponsaveis instanceof Responsaveis)
            $oResponsaveis = $oValidator->oResponsaveis;

        $success = [
            "success" => false,
            "data" => $oResponsaveis,
            "msg" => $oValidator->msg
        ];
    }

    if($_REQUEST["rtype"] == "json")
        exit(json_encode($success));

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


            $("[data-desativar-responsavel]").click(function (e) {
                e.preventDefault();

                var id = $(this).data("id");

                var status = $(this).data("situacao") == "1" ? "Desativar" : "Ativar";

                confirmacao(id, status + " este registro?", {
                    modal_class: "modal-sm",
                    callback_ok: function (idDados) {
                        window.location.href = "?ac=toggle_status&idResponsaveis=" + idDados;
                    }
                });
            });

            $("[data-excluir-responsavel]").click(function (e) {
                e.preventDefault();

                var id = $(this).data("id");

                confirmacao(id, "Deseja realmente excluir?", {
                    modal_class: "modal-sm",
                    callback_ok: function (idDados) {
                        window.location.href = "?ac=delete&idResponsaveis=" + idDados;
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
        .bs-callout {
            padding: 20px 20px 10px;
        }

        tr.disabled td {
            text-decoration: line-through;
            color: #d2d2d2;
        }

        .dados-responsavel td span {
            display: block;
            color: grey;
            font-size: 10px;
        }
    </style>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");
?>
<div class="container">
    <?php require_once("includes/menu.php"); ?>

    <div class="mt-10">
        <div class="bs-callout bs-callout-primary">
            <h4 class="left" style="font-size: 14px">Responsáveis pelas informações da empresa</h4>
            <a style="margin-top: -10px" class="btn btn-primary right" data-toggle="modal"
               data-target="#modal-cadastro-responsavel">Cadastrar</a>

            <div class="clear"></div>
        </div>
    </div>
    <?php if (is_array($success)): ?>
        <div class="alert alert-<?= $success["success"] ? "success" : "danger"; ?>">
            <?= $success["msg"]; ?>
        </div>
    <?php endif; ?>
    <div class="bg-grey p-10 content-table">
        <?php
        $oResponsaveis = $oControle->getAllResponsaveisEmpresa(["responsaveis_empresa.situacao = 1", "responsaveis.situacao <> -1", "cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'"]);

        if (!is_array($oResponsaveis)) :
            ?>
            <div class="bg-grey text-center">Não há responsáveis cadastrados</div>
        <?php else : ?>
            <table class="table table-striped  font-12 grey" id="tabelaEmpresas">
                <thead>
                <tr class="bg-grey grey font-13">
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>E-mail</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($oResponsaveis as $oResponsavel) : ?>
                    <tr class="<?php echo $oResponsavel->oResponsaveis->situacao == 0 ? "disabled" : ""; ?>">
                        <td><?= $oResponsavel->oResponsaveis->nome ?></td>
                        <td><?= $oResponsavel->oResponsaveis->cpf_passaporte ?></td>
                        <td><?= $oResponsavel->oResponsaveis->email ?></td>
                        <td class="text-right">
                            <?php if (!empty($oResponsavel->oResponsaveis->data_cad_externo)): ?>
                                <a href="#" data-visualizar-responsavel  data-id="<?php echo $oResponsavel->oResponsaveis->idResponsaveis; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                            <?php endif; ?>
                            <?php if (empty($oResponsavel->oResponsaveis->data_cad_externo)): ?>
                                <a href="#" data-editar-responsavel data-id="<?php echo $oResponsavel->oResponsaveis->idResponsaveis; ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i></a>
                            <?php endif; ?>
                            <a data-id="<?php echo $oResponsavel->oResponsaveis->idResponsaveis; ?>"
                               data-situacao="<?php echo $oResponsavel->oResponsaveis->situacao; ?>"
                               data-desativar-responsavel class="btn btn-primary btn-sm"><i
                                        class="glyphicon glyphicon-<?php echo $oResponsavel->oResponsaveis->situacao == 1 ? "ban-circle" : "ok"; ?>"></i></a>
                            <a data-id="<?php echo $oResponsavel->oResponsaveis->idResponsaveis; ?>"
                               data-excluir-responsavel class="btn btn-primary btn-sm"><i
                                        class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
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
    </div>


</div>
<?php require_once("includes/footer.php") ?>
</body>
</html>
