<?php
require_once("classes/class.Controle.php");

$oControle = new Controle(false);

$displayTab = 'hidden';

// ================= Edicao do Responsaveis =========================
if (!empty($_POST["cod_verificador"]) && !empty($_POST["cod_seguranca"]) && !empty($_POST["captcha"])) {
    if($_SESSION["captcha"] == $_POST["captcha"]){


        $oEmpresa = $oControle->getRowEmpresa([
            "md5(empresa.idEmpresa) = '{$_POST["cod_verificador"]}'"
        ]);

        if($oEmpresa instanceof Empresa){
            $oEmpresaCampanhaResponsaveis = $oControle->getRowEmpresaCampanhaResponsaveis([
                "empresa_campanha_responsaveis.situacao = 1",
                "empresacampanha.cnpj = '{$oEmpresa->cnpj}'",
                "campanha.anoBase = '{$oEmpresa->anoBase}'",
            ]);

            $voResponsaveisAssinaturas = $oControle->getAllResponsaveisAssinaturas([
                "responsaveis_assinaturas.cnpj = '{$oEmpresa->cnpj}'",
                "empresa_campanha_responsaveis.idEmpresaCampanha = '{$oEmpresaCampanhaResponsaveis->oEmpresacampanha->idEmpresaCampanha}'",
                "responsaveis_assinaturas.situacao = 1"
            ]);

            if(!is_array($voResponsaveisAssinaturas)){
                $success = [
                    "success" => false,
                    "msg" => "O documento informado não tem assinaturas"
                ];
            } else {
                $displayTab = '';
            }



        } else {
            $success = [
                "success" => false,
                "msg" => "Nenhuma Documento encontrada."
            ];
        }


    } else {
        $success = [
            "success" => false,
            "msg"     => "validação está incorreta"
        ];
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        $(document).ready(function () {


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

        .navbar-nav {
            display: none;
        }
    </style>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");
?>
<div class="container">
    <?php if (is_array($success)): ?>
        <div class="alert alert-<?= $success["success"] ? "success" : "danger"; ?>">
            <?= $success["msg"]; ?>
        </div>
    <?php endif; ?>

    <h3>Conferir Autenticidade de Documento</h3>
    <form role="form" action="" method="post">
        <div class="mt-10">
            <div class="bs-callout bs-callout-primary bg-grey">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="login">Código Verificador:</label>
                            <input type="text" class="form-control" name="cod_verificador" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="senha">Código de Segurança</label>
                            <input type="text" class="form-control" required name="cod_seguranca"/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="senha">Validação</label>
                            <img src="captcha.php" style="margin: 10px 0 10px 30px; width: 190px;" />
                            <input type="text" class="form-control" required name="captcha" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <button data-loading-text="Carregando..." type="submit" class="btn btn-primary right">
                        Pesquisar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <table class="table table-striped font-12 grey mt-10 <?= $displayTab ?>" id="acionistaEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Nome</th>
            <th>Data da assinatura</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="listaResponsaveis">
        <?php

        if (is_array($voResponsaveisAssinaturas)) {
            foreach ($voResponsaveisAssinaturas as $oResponsavel) {
                $data = DateTime::createFromFormat('Y-m-d H:i:s', $oResponsavel->data_assinatura);

                ?>
                <tr id="r<?= $oResponsavel->idEmpresaCampanhaResponsaveis ?>">
                    <td><?= $oResponsavel->oResponsaveis->nome ?></td>
                    <td><?= $data->format('d/m/Y H:i:s') ?></td>
                    <td class="text-right">&nbsp;&nbsp;
                        <a class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </td>
                </tr>
                <?php
            }
        }
        ?>

        </tbody>
    </table>
</div>
<?php require_once("includes/footer.php") ?>
</body>
</html>