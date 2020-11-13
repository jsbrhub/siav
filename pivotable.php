<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 09/12/2019
 * Time: 15:43
 */

require_once("classes/class.Controle.php");
$oControle = new Controle();

$nome = $_SESSION['usuarioAtual']['nome'];

$cnpj = $_SESSION['usuarioAtual']['cnpj'];

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/4.1.2/papaparse.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>


    <link rel="stylesheet" charset="utf-8" type="text/css" href="js/pivotable/assets/pivot.css">
    <script type="text/javascript" charset="utf-8" src="js/pivotable/assets/pivot.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/pivotable/assets/d3_renderers.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/pivotable/assets/c3_renderers.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/pivotable/assets/export_renderers.js"></script>
    <script type="text/javascript" charset="utf-8" charset=UTF-8 src="js/pivotable/assets/pivot.pt.js"></script>

    <script type="text/javascript">
        $(function () {
            var renderers = $.extend($.pivotUtilities.locales.pt.renderers,
                $.pivotUtilities.export_renderers);

            Papa.parse("exportSiavData.php", {
//            Papa.parse("siav-relatorio.csv", {
                download: true,
                skipEmptyLines: true,
                complete: function (parsed) {
                    $("#output").pivotUI(parsed.data, {
                        renderers: renderers,
                        rows: ["UF","Município","CNPJ","Razão Social",'Situação'],
                        cols: [],
                        rendererName: "Tabela"
                    }, false, "pt");
                }
            });

        });
    </script>
    <style>
        .whiteborder {
            border-color: white;
        }

        .greyborder {
            border-color: lightgrey;
        }

        #filechooser {
            color: #555;
            text-decoration: underline;
        ;
            cursor: pointer;
            /* "hand" cursor */
        }

        .node {
            border: solid 1px white;
            font: 10px sans-serif;
            line-height: 12px;
            overflow: hidden;
            position: absolute;
            text-indent: 2px;
        }

        .c3-line,
        .c3-focused {
            stroke-width: 3px !important;
        }

        .c3-bar {
            stroke: white !important;
            stroke-width: 1;
        }

        .c3 text {
            font-size: 12px;
            color: grey;
        }

        .tick line {
            stroke: white;
        }

        .c3-axis path {
            stroke: grey;
        }

        .c3-circle {
            opacity: 1 !important;
        }

        .c3-xgrid-focus {
            visibility: hidden !important;
        }
    </style>
</head>
<body>
<?php require_once("includes/modals.php");?>
<div class="nav-top">
    <div class="top-content">
        <div  >
            <img src="img/SUDAMd.png" height="40">
        </div>
        <div class="hidden-xs nav-top-logo">
            <strong><i>SIAV - Sistema de Avaliação</i></strong><br><i><span class="text-muted" style="font-size: 12px">Incentivos Fiscais</span> </i>

        </div>
        <div >
            <ul class="nav navbar-nav navbar-right nav-bt-user">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle btn-user" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> <?=$nome?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <!--                            <li><a href="principal.php"><i class="glyphicon glyphicon-th-large"></i>  Módulos</a></li>-->
                        <!--                            <li class="divider"></li>-->
                        <li><a href="logoff"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <a href="principal.php" class=" btn btn-primary"> <i class="glyphicon glyphicon-chevron-left"></i> Voltar</a>
    <div class="mt-10">
        <iframe width="100%" height="900" src="https://datastudio.google.com/embed/reporting/5af13a6c-6c42-493f-a696-b1e1bbad1843/page/uEaiB" frameborder="0" style="border:0" allowfullscreen></iframe>
       <!--  <div id="output" style="margin: 10px;"></div> -->
    </div>
</div>
<?php require_once("includes/footer.php")?>
</body>
</html>
