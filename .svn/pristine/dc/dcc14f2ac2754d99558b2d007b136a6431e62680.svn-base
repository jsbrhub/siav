<?php
require_once("classes/class.Controle.php");

$oControle = new Controle();
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
    </script>
</head>
<body>
	<?php
    require_once("includes/modals.php");
    include ("includes/topo.php");
	?>
	<div class="container" ng-controller="EmpresaController">
		<?php require_once("includes/menu.php");?>

<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>

        <form id="form-cons-empresa" onsubmit="consultarLancamento(); return false;">
        <div class="bs-callout bs-callout-primary">
            <h4 style="font-size: 14px"><strong>Consultar Empresa</strong></h4><br />
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control input-sm" name="consulta" id="tipoConsulta" onchange="exibeTipo(this.value);">
                                <option value="0">Selecione</option>
                                <option value="1" selected>Consultar Lançamentos</option>
                                <option value="2">Incentivos Vigentes</option>
                                <option value="3">Incentivos Encerrados</option>
                            </select>
                        </div><!-- /input-group -->
                    </div>

                </div>
                <div class="row" id="consLancamento">
                    <div class="col-lg-6">
                    <div class="input-group" >
                        <input type="text" class="form-control input-sm" name="empresa" placeholder="Digite o CNPJ ou Razão Social" id="empresa">
                        <span class="input-group-btn">
                            <button class="btn btn-primary btn-sm" type="submit" ><i class="glyphicon glyphicon-search"></i>&nbsp;&nbsp;Pesquisar <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i></button>
                        </span>
                    </div>
                    </div>
                </div>


        </div>
    </form>
        <div class="alert alert-dismissible fade in alert-danger" id="alerta" style="display: none">
            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
            <p class="font-12"></p>
        </div>
        <div class="bg-grey p-10 font-11" id="legenda" style="display: block">

            <div class="col-lg-2"><img src="img/status_0.png"> - Não Solicitada
            </div>
            <div class="col-lg-2"><img src="img/status_1.png"> - Recebida
            </div>
            <div class="col-lg-2"><img src="img/status_2.png"> - Em Análise
            </div>
            <div class="col-lg-2"><img src="img/status_3.png"> - Aprovado
            </div>
            <div class="col-lg-2"><img src="img/status_4.png"> - Indeferida
            </div>
            <div class="col-lg-2"><img src="img/status_5.png"> - Retificada
            </div>
            <div style="clear: both"></div>
        </div>
        <div id="resultado">
            <?php
            $listaInicial = $oControle->retornaRegistrosWeb();
            if($listaInicial){
                ?>
            <div class="bg-grey p-10 content-table">
                <table class="table table-striped  font-12 grey" id="tabelaEmpresas">
                    <thead>
                    <tr class="bg-grey grey font-13">
                        <th>CNPJ</th>
                        <th>Razão Social</th>
                        <th>Ano Aprovação</th>
                        <th>Ano Base</th>
                        <th>Incentivo Vigente</th>
                        <th>Fonte Origem</th>
                        <th>Retificação</th>
                        <th colspan="2">Visualizar</th>

                    </tr>
                    </thead>
                    <tbody id="listaConsultaEmpresa">
                    <?php
                    foreach ($listaInicial as $itemLista) {
                        $formataCnpj = Util::formataCNPJ($itemLista->cnpj);
                        $fonteOrigem = $itemLista->fonteOrigem;
                        $anoAprovacao = $itemLista->anoAprovacao;
                        if (!$anoAprovacao) {
                            $anoAprovacao = "-";
                        }
                        $anoBase = $itemLista->anoBase;
                        if (!$anoBase) {
                            $anoBase = "-";
                        }
                        if ($fonteOrigem == 'WEB') {
                            $listaDocs = $oControle->listaDocumentosEmpresa($itemLista->idEmpresa);
                            if ($listaDocs) {
                                $documentos = "";
                                foreach ($listaDocs as $doc) {
                                   if(!empty($doc->novoNome)) {
                                       $documentos .= "<li class='font-11 grey'><a href='files/" . $doc->novoNome . "' target='_blank''>" .
                                           $doc->nomeArquivo . "</a> </li>";
                                   }
                                }
                                if ($documentos != ''){
                                    $docs = '<a class="btn btn-primary btn-sm bt-popover popover-autosize" target="_blank" data-content="' . $documentos . '" style="cursor:pointer" title="Documentos" id="docsConsulta"><i class="glyphicon glyphicon-book"></i></a>';
                                }else{
                                    $docs = '';
                                }

                            } else {
                                $docs = '';
                            }
                        }else {
                            $docs = '';
                        }

                        $retificacao = $oControle->getRefiticacaoByIdEmpresa($itemLista->idEmpresa);
                        if ($itemLista->vigente == '0') {
                            $vigente = "Não";
                        } else {
                            $vigente = "Sim";
                        }

                        if ($retificacao != '') {
                            switch ($retificacao->status) {
                                case '':
                                    $img = "<img src='img/status_0.png' title='Não Solicitada'>";
                                    break;
                                case '1': //enviado
                                    $img = "<img src='img/status_1.png' title='Recebida'>";
                                    break;
                                case '2': //em análise
                                    $img = "<img src='img/status_2.png' title='Em Análise'>";
                                    break;
                                case '3': //aprovado pela sudam
                                    $img = "<img src='img/status_3.png' title='Aprovada'>";
                                    break;
                                case '4': //Negado pela sudam
                                    $img = "<img src='img/status_4.png' title='Indeferida'>";
                                    break;
                                case '5': //retificado
                                    $img = "<img src='img/status_5.png' title='Retificada'>";
                                    break;
                            }
                        } else {
                            $img = "<img src='img/status_0.png' title='Não Solicitada'>";
                        }
                        switch ($fonteOrigem) {
                            case "Arquivo Excel":
                                $link = "dadosArquivo.php?actionID=" . base64_encode($itemLista->idEmpresa);
                                break;
                            case "Arquivo Excel Questionario":
                                $link = "dadosArquivoQuest.php?actionID=" . base64_encode($itemLista->idEmpresa);
                                break;
                            case "WEB":
                                $link = "dadosEmpresa.php?actionID=" . base64_encode($itemLista->idEmpresa);
                                break;
                        }
                        echo '<tr class="font-12 grey">' .
                            '<td nowrap="yes">' . $formataCnpj . '</td>' .
                            '<td>' . ($itemLista->razaoSocial) . '</td>' .
                            '<td>' . $anoAprovacao . '</td>' .
                            '<td>
' . $anoBase . '</td>' .
                            '<td>
' . $vigente . '</td>' .
                            '<td>' . $fonteOrigem . '</td>' .
                            '<td class="text-center">' . $img . '</td>' .
                            '<td>
                    <a class="btn btn-primary btn-sm" target="_blank" href="'.$link.'" style="cursor:pointer" 
                    title="Visualizar Dados"><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    </td>
                    <td>'.$docs.'</td>
                    </tr>';
                    }
                    ?>
                    </tbody>
                </table>
            </div>
            <?php
            }
            ?>
        </div>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>