<?php ini_set('memory_limit', '1024M');
require_once("classes/class.Controle.php");
$oControle = new Controle();
$cnpj = $_SESSION['usuarioAtual']['cnpj'];
$idCampanha = $_REQUEST['idCampanha'];
$retorno = [];

if($_REQUEST['idHistRet']){
    $verificaHistorico = $oControle->getHistoricoretificacao($_REQUEST['idHistRet']);
    $idEmpresa = $verificaHistorico->idEmpresaRet;
    $verificaControle = $oControle->getControleByIdEmpresa($idEmpresa);
    $dataHist = new DateTime($verificaHistorico->dataHoraAlteracao);
    $dataExp = Util::SomaDiasUteis($dataHist->format("d/m/Y"),15);
    $titulo = '<strong>Retificação de Dados</strong> - Ano Base:
                    <strong>'.$verificaHistorico->anoBase.'</strong> - Expira em: '.Util::formataDataBancoForm($dataExp);
    $disabled = "";
    $oCampanha = $oControle->getCampanha($verificaControle->oCampanha->idCampanha);

    $idCampanha = $_GET["idCampanha"] = $oCampanha->idCampanha;
}else{
    if($idCampanha != ''){
        $checaCadastroEmpresa = $oControle->verificaEmpresaCampanhaSituacao($idCampanha,$cnpj);
//        Util::trace($checaCadastroEmpresa);
        $oCampanha = $oControle->getCampanha($idCampanha);
        $idEmpresa = $checaCadastroEmpresa->oEmpresa->idEmpresa;
        $titulo = '<strong>'.$oCampanha->campanha.'</strong> - Ano Base:
                    <strong>'.$oCampanha->anoBase.'</strong> - Período: '.Util::formataDataBancoForm
                    ($oCampanha->dataInicio)." até "
                    .Util::formataDataBancoForm($oCampanha->dataFim);
        ($checaCadastroEmpresa != '')? $disabled = "":$disabled = "disabled";

    }
}
//Util::trace($checaCadastroEmpresa);
$display = "no-display";

if($idEmpresa){
    $disabled = "";
    $checaHash = $oControle->retornaHash($idEmpresa);
    $oEmpresa = $oControle->getEmpresa($idEmpresa);
    $razaoSocial = $oEmpresa->razaoSocial;
    $telefone = $oEmpresa->telefone;
    $fax = $oEmpresa->fax;
    $endereco = $oEmpresa->endereco;
    $bairro = $oEmpresa->bairro;
    $idMunicipio = $oEmpresa->oMunicipio->idMunicipio;
    $ufEmpresa = $oEmpresa->oMunicipio->uf;
    $email = $oEmpresa->email;
    $complemento = $oEmpresa->complemento;
    $latitude = $oEmpresa->latitude;
    $longitude = $oEmpresa->longitude;
    $cnpjMatriz = $oEmpresa->cnpjMatriz;
    $cep = $oEmpresa->cep;
    $numero = $oEmpresa->numero;
    $checaControle = $oControle->getControleByIdEmpresa($idEmpresa);
    if($checaControle)$idEmpresaControle = $checaControle->idEmpresaControle;
}
else{
    $oEmpresa = $oControle->getInfoAtualEmpresa($cnpj);
}
$anoBase = $oCampanha->anoBase;
$idIncentivo = $oEmpresa->oIncentivos->idIncentivo;
$idModalidade = $oEmpresa->oModalidade->idModalidade;
$idSituacao = $oEmpresa->oSituacao->idSituacao;
$anoVigencia = $oEmpresa->anoVigencia;
$anoAprovacao = $oEmpresa->anoAprovacao;
$listaUf = $oControle->listaUf();
$listaMunicipio = $oControle->getMunicipioByUf($ufEmpresa);
$listaIncentivos = $oControle->getIncentivosByCnpjVigenciaCadastro($cnpj, 1);
if(!is_array($listaIncentivos)){
    $linhaProducao = 'no-display';
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <script type="text/javascript" src="mapa/jquery32.js"></script>
	<?php require_once("includes/header.php"); ?>
    <script src="js/dadosEmpresa.js"></script>
    <script src="js/linhaProducao.js?nocache"></script>
    <script src="js/documentos.js"></script>
    <script src="js/jquery.uploadifive-v1.0.js"></script>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA7NyC8uz0FFEu0o2Tu5GJZhvK3Pf9C07A"></script>

    <script type="text/javascript" src="mapa/mapa.js"></script>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
    </script>

    <script>
        $(document).ready(function () {
            initialize();
        });


        $(document).ready(function () {
            google.maps.event.addListener(marker, 'drag', function () {
                geocoder.geocode({ 'latLng': marker.getPosition() }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            $('#latitude').val(marker.getPosition().lat());
                            $('#longitude').val(marker.getPosition().lng());
                        }
                    }
                });
            });

            $("#endereco").blur(function() {
                if($(this).val() != "")
                    carregarNoMapa($(this).val());
            })

            var nLatitude = "<?=$latitude?>";
            var nLongitude = "<?=$longitude?>";

            if(nLatitude != "" && nLongitude != ""){
                var locationN = new google.maps.LatLng(nLatitude, nLongitude);
                marker.setPosition(locationN);
                map.setCenter(locationN);
                map.setZoom(16);
            }

            $("[data-enviar-para-responsaveis]").click(function(e){
                e.preventDefault();

                var idCampanha = $(this).data("enviar-para-responsaveis");

                $.post("api/encaminhar-para-responsaveis.php", { idCampanha : idCampanha  }, function(r){
                    if(r.success){
                        $("#resposta-alerta").attr("class", "alert alert-success");
                        $("span", "#resposta-alerta").html(r.msg);
                    } else {
                        $("#resposta-alerta").attr("class", "alert alert-warning");
                        $("span", "#resposta-alerta").html(r.msg);
                    }
                }, "json");

            })

        });
    </script>
</head>
<body>
	<?php
    require_once("includes/modals.php");
    include ("includes/topo.php");
	?>

	<div class="container">
		<?php require_once("includes/menu.php"); ?>
        <?php
        if(!$checaHash) {
        ?>

        <div id="resposta-alerta" class="alert hidden" role="alert">
            <span></span>.
        </div>



        <div class="clear"></div>
        <div class="panel panel-primary font-12 mt-10">
            <div class="panel-heading gradient-panel">
                <span class="panel-title font-13"><?=$titulo?></span>
            </div>

                <div class="panel-body font-12">
                    <div class="">
                        <ul class="nav nav-tabs gradient-tab">
                            <li class="active" id="tab-dados-empresa"><a data-toggle="tab" href="#dadosEmpresa">Dados Empresa</a></li>
                            <li class="<?= $disabled ?> <?=$linhaProducao?>" id="tab-linha-producao" ><a data-toggle="tab" href="#linhaProducao">Linha de Produção</a></li>
                            <li class="<?= $disabled ?>" id="tab-financeiro"><a data-toggle="tab" href="#dadosFinanceiros">Dados Financeiros</a></li>
                            <li class="<?= $disabled ?>" id="tab-projeto"><a data-toggle="tab" href="#projetos">Projetos/Programas</a></li>
                            <li class="<?= $disabled ?>" id="tab-pesquisa"><a data-toggle="tab" href="#pesquisas">Pesquisa e Desenvolvimento</a></li>
                            <li class="<?= $disabled ?>" id="tab-politica"><a data-toggle="tab" href="#destSusten">Destinação Sustentável</a></li>
                            <li class="<?= $disabled ?>" id="tab-documentos"><a data-toggle="tab" href="#documentos">Documentos</a></li>
                            <li class="<?= $disabled ?>" id="tab-concluir"><a data-toggle="tab" href="#concluir">Finalizar Atualização</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="dadosEmpresa" class="tab-pane fade in active">
                                <ul class="nav nav-tabs sub-tab">
                                    <li class="active"><a data-toggle="tab" href="#empresa"><span class="glyphicon glyphicon-briefcase"></span>&nbsp;&nbsp; Identificação da Empresa</a></li>
                                    <li class="<?= $disabled ?>"><a data-toggle="tab" href="#contato"><span class="glyphicon glyphicon-earphone"></span>&nbsp;&nbsp; Contato</a></li>
                                    <li class="<?= $disabled ?>"><a data-toggle="tab" href="#acionistas"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp; Sócio/Acionista Controlador</a></li>
                                    <li class="<?= $disabled ?>"><a data-toggle="tab" href="#responsaveis"><span class="glyphicon glyphicon-transfer"></span>&nbsp;&nbsp; Responsáveis Pela Empresa</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="empresa" class="tab-pane fade in active">
                                        <?php include "cadEmpresa.php" ?>
                                    </div>
                                    <div id="contato" class="tab-pane fade">
                                        <?php include "cadContatoEmpresa.php" ?>
                                    </div>
                                    <div id="acionistas" class="tab-pane fade">
                                        <?php include "cadAcionista.php" ?>
                                    </div>
                                    <div id="responsaveis" class="tab-pane fade">
                                        <?php include "cadResponsaveis.php" ?>
                                    </div>
                                </div>
                            </div>
                            <div id="linhaProducao" class="tab-pane fade">
                                <ul class="nav nav-tabs sub-tab">
                                    <li class="active"><a data-toggle="tab" href="#produto"><span class="glyphicon
                            glyphicon-leaf"></span>&nbsp;&nbsp; Produto/Serviço</a></li>
                                    <li><a data-toggle="tab" href="#insumos"><span class="glyphicon
                            glyphicon-tree-deciduous"></span>&nbsp;&nbsp; Origem de Insumos</a></li>
                                    <li><a data-toggle="tab" href="#mercado"><span class="glyphicon
                            glyphicon-stats"></span>&nbsp;&nbsp; Mercado Consumidor</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="produto" class="tab-pane fade in active">
                                        <? Util::trace($idEmpresa, false, true); ?>
                                        <?php include "cadIncentivoempresa.php" ?>
                                    </div>
                                    <div id="insumos" class="tab-pane fade">
                                        <? Util::trace($idEmpresa, false, true); ?>
                                        <?php include "cadOrigeminsumos.php" ?>
                                    </div>
                                    <div id="mercado" class="tab-pane fade">
                                        <? Util::trace($idEmpresa, false, true); ?>
                                        <?php include "cadMercadoconsumidor.php" ?>
                                    </div>
                                </div>

                            </div>
                            <div id="dadosFinanceiros" class="tab-pane fade">
                                <? Util::trace($idEmpresa, false, true); ?>
                                <?php include "cadCadastrofinanceiro.php" ?>
                            </div>
                            <div id="projetos" class="tab-pane fade">
                                <? Util::trace($idEmpresa, false, true); ?>
                                <?php include "cadProjsocioambiental.php" ?>
                            </div>
                            <div id="pesquisas" class="tab-pane fade">
                                <? Util::trace($idEmpresa, false, true); ?>
                                <?php include "cadPesquisaDesenvolvimento.php" ?>
                            </div>
                            <div id="destSusten" class="tab-pane fade">
                                <?php include "cadPoliticaambiental.php" ?>
                            </div>
                            <div id="documentos" class="tab-pane fade">
                                <? Util::trace($idEmpresa, false, true); ?>
                                <?php include "cadArquivoempresa.php" ?>
                            </div>
                            <div id="concluir" class="tab-pane fade">
                                <? Util::trace($idEmpresa, false, true); ?>
                                <?php include "concluirAtualizacao.php" ?>
                            </div>
                        </div>
                    </div>
                    <!--            <div class="panel-footer"></div>-->
                </div>
        </div>
                <?php
            }else{
            if($_REQUEST['idHistRet']){
                $texto = "A retificação de dados referente ao Ano Base ".$oCampanha->anoBase.", foi concluída com sucesso.";
            }else{
                $texto = "O cadastro dos dados referente ao Ano Base ".$oCampanha->anoBase.", foi
                                    concluído com sucesso.";
            }

            ?>
                <div class="panel panel-success" id="impComprovante">
                    <div class="panel-heading">Impressão Comprovante</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 p-20 font-12 grey">
                                <span> <i class="glyphicon glyphicon-hand-right"></i>&nbsp;
                                    <?=$texto?></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <!--button class="btn btn-primary btn-sm mt-25" id="btnDocumento" onclick="gerarComprovantePDF()"> <i
                                    class="glyphicon
                        glyphicon-hand-right"></i>&nbsp;&nbsp;
                                        Imprimir Comprovante &nbsp;&nbsp;
                                        &nbsp; <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i> </button-->

                                    <a href="comprovante/index.php?actionID=<?=base64_encode($idEmpresa)?>&actionCAMP=<?=base64_encode($idCampanha)?>" target="_blank" class="btn btn-primary btn-sm mt-25" id="btnDocumento">
                                        <i class="glyphicon glyphicon-hand-right"></i>&nbsp;&nbsp;
                                        Imprimir Comprovante <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i>
                                    </a>

                                    <a href="dadosEmpresa.php?actionID=<?=base64_encode($idEmpresa)?>" target="_blank" class="btn btn-primary btn-sm mt-25">
                                        <i class="glyphicon glyphicon-eye-open"></i>&nbsp;&nbsp;
                                        Visualizar Dados
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>



	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>