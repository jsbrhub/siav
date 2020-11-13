<?php
require_once("classes/class.Controle.php");

$oControle = new Controle();

$nome = $_SESSION['usuarioAtual']['nome'];
$cnpj = $_SESSION['usuarioAtual']['cnpj'];

$listaAnoBase = Util::listarAnoBase('2007',date('Y'));

//Util::trace($listaRetificacoes);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <link href="css/shieldui-treeview.min.css" rel="stylesheet" />
    <style>
        .icon-folder{
            background: url("img/folder.png");
        }
    </style>
    <?php require_once("includes/header.php"); ?>
    <script src="js/dadosEmpresa.js"></script>
    <script src="js/shieldui-treeview-all.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#anoBase").change(function(){
                if($(this).val() !== ""){
                    $("#campanhas").val("");

                    $("#campanhas option[data-ab]").hide();

                    $("#campanhas option[data-ab='"+$(this).val()+"']").show();
                }
            });


            $("#gerar").click(function (e) {
                e.preventDefault();

                if($("#campanhas").val() == ""){
                    alert("Você deve selecionar a campanha desejada");

                    return;
                }

                window.location.href = $(this).attr("href")+"?idCampanha="+$("#campanhas").val();

            })
        })
    </script>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");
?>
<div class="container">
    <div class="alert hidden"></div>
    <?php require_once("includes/menu.php"); ?>
    <div class="bs-callout bs-callout-primary">
        <h4><strong>Gerador de relatórios por campanha</strong></h4>
    </div>
    <div class="row">
        <form>
            <div class="col-md-5">
                <div class="rel-filtros">
                    <div class="form-group">
                        <label>Ano Base</label>
                        <select id="anoBase" class="form-control" name="filtro[idCampanha]" >
                            <option value="">Selecione</option>
                            <option value="2016">2016</option>
                            <option value="2018">2018</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Campanha</label>
                        <select id="campanhas" class="form-control" name="filtro[idCampanha]" >
                            <option value="">Selecione</option>
                            <option value="todas">Todas as empresas</option>
                            <option data-ab="2016" value="2">1ª etapa de implementação do SIAV Incentivos</option>
                            <option data-ab="2016" value="5">1ª etapa de implementação do SIAV Incentivos</option>
                            <option data-ab="2018" value="14">SUDAM - Solicitação de Informações referentes ao exercício de 2018</option>
                        </select>
                    </div>
                    <!-- <div class="row">
                        <div class="form-group col-md-6">
                            <label>Incentivo</label>
                            <select class="form-control" name="filtro[idCampanha]" >
                                <option value="">Selecione</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Modalidade</label>
                            <select class="form-control" name="filtro[idCampanha]" >
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="col-md-5">
                <?php require_once("includes/arvore-relatorio.php"); ?>
            </div>
            <div class="col-md-2">
                <a href="rel-empresas-campanha" id="gerar" class="btn btn-primary">Gerar Relatório</a>
            </div>
        </form>
    </div>
</div>
<?php require_once("includes/footer.php") ?>
</body>
</html>