<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();


if($_REQUEST['acao'] == 'excluir'){
    $campanha = $oControle->getCampanha($_REQUEST['idCampanha']);

    if($campanha->situacao == '1') {
        $alertas = $oControle->getAlertasByCampanha($_REQUEST['idCampanha']);
        if(is_array($alertas)){
            foreach ($alertas as $alerta){
                $oControle->excluiAlerta($alerta->idAlerta);
            }
        }
        $oControle->limparEmpresaCampanha($_REQUEST['idCampanha']);
        print ($oControle->excluiCampanha($_REQUEST['idCampanha'])) ? "0" : $oControle->msg;
        exit;
    }else{
        echo "1";
    }
}
$listaAnoBase = Util::listarAnoBase('2007',date('Y'));
if($_REQUEST['acao'] == 'dados'){
    $retorno = [];
    $dadosCampanha = $oControle->getCampanha($_REQUEST['idCampanha']) ;
    $retorno["dadosCampanha"] = $dadosCampanha;
    $retorno["dadosCampanha"]->dataInicio = Util::formataDataBancoForm($retorno["dadosCampanha"]->dataInicio);
    $retorno["dadosCampanha"]->dataFim = Util::formataDataBancoForm($retorno["dadosCampanha"]->dataFim);
    $retorno["msg"] = $oControle->msg;
    echo json_encode($dadosCampanha);
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt" ng-app="app">
<head>
	<?php require_once("includes/header.php");?>
    <link rel="stylesheet" href="js/datepicker/css/bootstrap-datepicker.css">
    <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script src="js/empresa.js"></script>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
        
        $(document).on("keyup", "#pesquisaEmpresa", function (e) {
            if($(this).val().length >= 3){
                $.each($(".listaEmpresaModal tbody tr").not('tr:icontains("'+$(this).val()+'")'), function(){
                    $(this).addClass("hidden");
                });
            } else {
                $(".listaEmpresaModal tbody tr.hidden").removeClass("hidden");
            }
        })

        $(document).ready(function(){

            var currentListaEnviados = [];

            $(document).on('click', '.img-campanha', function(){
                CKEDITOR.instances["texto"].insertHtml("<img src='"+$(this).attr("src")+"' width='200' />");
            });

            $("#formEnviarAlerta").submit(function(e){

                e.preventDefault();

                $("#btnenviarAlertaForm").attr("disabled", true);

               if($(this)[0].reportValidity()){
                   $.ajax({
                       url: 'api/alertas.php',
                       method: 'SEND_ALERT',
                       data: {
                           idCampanha: $("#idCampanha").val(),
                           assunto: $("#assunto").val(),
                           texto: CKEDITOR.instances["texto"].getData(),
                           cnpj: $("#cnpjEmpresa").val()
                       },
                       dataType: 'json',
                       success: function (r) {
                           if(r.success){
                               $("#visualizaEmpresas .modal-body .alert").addClass("alert-success").removeClass("hidden alert-danger");

                               $("#enviarAlerta").modal("hide");
                           } else {
                               $("#enviarAlerta .modal-body .alert").addClass("alert-danger").removeClass("hidden alert-success");
                           }

                           $("#btnenviarAlertaForm").attr("disabled", false);

                       }
                   });
               }
            });

            $(document).on('click', ".send-unic-alert", function(e){
                e.preventDefault();

                $("#idCampanha").val($(this).data("campanha"));

                $("#cnpjEmpresa").val($(this).data("cnpj"));

                $.post("campanha-imagem-upload.php", { idCampanha: $(this).data("campanha") }, function(data){
                    $("#campanha-images").html("");

                    $.each(data, function (k, v) {
                        $("#campanha-images").append("<img class='img-campanha' src='http://siav.sudam.gov.br/"+v+"' width='50' />");
                    });
                }, "json");

                $("#visualizaEmpresas .modal-body .alert, #enviarAlerta .modal-body .alert").addClass("hidden");

                $("#enviarAlerta").modal("show");
            });

            $(document).on("click", "[exibir-emails-enviados]", function(e){
                e.preventDefault();

                currentListaEnviados = [];

                if($(this).data("id-alerta") != undefined){

                    $("#listaAlertaEmpresas tbody").empty();

                    var idAlerta = $(this).data("id-alerta");

                    $.ajax({
                        url: "api/alertas.php",
                        data: { idAlerta: idAlerta },
                        dataType: "json",
                        method: "GET_EMPRESAS",
                        success: function(e){
                            if(e.success && e.data.length > 0){
                                currentListaEnviados = e.data;

                                $.each(e.data, function(k, v){
                                    var linha = $($("#linha-alerta-empresa").clone().html());

                                    var dtRegistro = new Date(this.dt_registro);

                                    $("td:eq(0)", linha).html(this.cnpj);

                                    $("td:eq(1)", linha).html(this.oAutenticacaoempresa.email);

                                    $("td:eq(2)", linha).html([dtRegistro.getDate(), dtRegistro.getMonth(), dtRegistro.getFullYear()].join("/"));

                                    $("[exibir-email]", linha).data("key", k);

                                    $("#listaAlertaEmpresas tbody").append(linha);
                                });

                                $("#visualizaAlertaEmpresas").modal("show");
                            }
                        }
                    })
                }
            });

            $(document).on("click", "[exibir-email]", function(){
                var objKey = $(this).data("key");

                console.log(currentListaEnviados[objKey]);

                if(objKey != undefined && typeof currentListaEnviados[objKey] != "undefined"){

                    $("#visualizaConteudoEmail .modal-body").html(currentListaEnviados[objKey].corpo);

                    $("#visualizaConteudoEmail").modal('show');
                }
            });

            $(document).on("click", "[data-vizualizar-alertas]", function(){

                var $this = $(this);

                $this.attr("disabled", true);

                $.get("api/alertas.php", { idCampanha: $(this).data("campanha") }, function(r){

                    $("#listaAlerta").empty();

                    if(r.data.length > 0){

                        var oAlertaSituacao = { "1" : "Rascunho", "2" : "Enviado" };

                        var oStatus = { "1" : "Pre-ativa", "2" : "Ativa", "3" : "Inativa", "4" : "Encerrada" };

                        $.each(r.data, function (k,v) {

                            if(k == 0){

                                var dInicio = new Date(this.oCampanha.dataInicio + " 00:00:00");

                                var dFim = new Date(this.oCampanha.dataFim + " 00:00:00");

                                $("[modal-alertas-campanha] b").html(this.oCampanha.campanha);
                                $("[modal-alertas-ano-base] b").html(this.oCampanha.anoBase);
                                $("[modal-alertas-inicio] b").html([dInicio.getDate(), dInicio.getMonth()+1, dInicio.getFullYear()].join("/"));
                                $("[modal-alertas-fim] b").html([dFim.getDate(), dFim.getMonth()+1, dFim.getFullYear()].join("/"));
                                $("[modal-alertas-situacao] b").html(oStatus[this.oCampanha.situacao]);
                                $("[modal-alertas-alertas] b").html(r.data.length);
                            }

                            var row = $($("#linha-alerta").clone().html());

                            var dAlteracao = new Date(this.dataHoraAlteracao);

                            $("td:eq(0)", row).html(k+1);

                            $("td:eq(1)", row).html(this.assunto);

                            $("td:eq(2) span", row).html(this.totalEmpresas);

                            if(this.totalEmpresas > 0)
                                $("td:eq(2) a", row).data("id-alerta", this.idAlerta).removeClass("hidden");

                            $("td:eq(3)", row).html(oAlertaSituacao[this.situacao]);

                            $("td:eq(4)", row).html([dAlteracao.getDate(), dAlteracao.getMonth()+1, dAlteracao.getFullYear()].join("/"));

                            $("#listaAlerta").append(row);
                            
                        });

                        $("#visualizarAlertas").modal('show');
                    }

                    $this.attr("disabled", false);
                }, "json");
            });

            $(document).on('hide.bs.modal', function () {
                $(".alert-float").hide();
            });

            $(document).on("click", ".mail-edit", function () {

                $(this).hide();

                var td = $(this).parent();

                if($(".input-email", td).length == 0){
                    td.append($("#template-editor-email").clone().html());
                }
            });

            $(document).on("click", ".undo-save-mail", function(){
                var td = $(this).closest('td');

                $(".input-email", td).remove();

                $(".mail-edit", td).show();
            });

            $(document).on("click", ".do-save-mail", function(){

                var td = $(this).closest('td');

                if($("input", td).val() == ""){
                    $(".alert-float").addClass("alert-danger").html("Preencha o campo Email.").show();
                    return false;
                }

                $.ajax({
                    url: 'api/empresa.php',
                    method: 'UPDATE_EMAIL',
                    data: { email : $("input", td).val(), cnpj:  td.data("cnpj") },
                    dataType: 'json',
                    success: function(r){
                        if(r.success){
                            $(".alert-float").removeClass("alert-danger").addClass("alert-success").html(r.msg).show();

                            $("span", td).html(r.data.email);

                            $(".input-email", td).remove();

                            $(".mail-edit", td).show();
                        } else {
                            $(".alert-float").removeClass("alert-success").addClass("alert-danger").html(r.msg).show();
                        }
                    }
                });

            });

            CKEDITOR.replace( 'texto', {
                // Define the toolbar: http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_toolbar
                // The full preset from CDN which we used as a base provides more features than we need.
                // Also by default it comes with a 3-line toolbar. Here we put all buttons in a single row.
                toolbar: [
                    { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
                    { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
                    { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline'] },
                    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
                    { name: 'align', items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
                    { name: 'insert', items: [ 'Image','Table' ] },
                ],
                // Enabling extra plugins, available in the full-all preset: http://ckeditor.com/presets-all
                extraPlugins: 'tableresize',
                extraAllowedContent: 'img[width,height,align]',
                /*********************** File management support ***********************/
                // In order to turn on support for file uploads, CKEditor has to be configured to use some server side
                // solution with file upload/management capabilities, like for example CKFinder.
                // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_ckfinder_integration
                // Uncomment and correct these lines after you setup your local CKFinder instance.
                // filebrowserBrowseUrl: 'http://example.com/ckfinder/ckfinder.html',
                // filebrowserUploadUrl: 'http://example.com/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                /*********************** File management support ***********************/
                // Make the editing area bigger than default.
                height: 300,
                // An array of stylesheets to style the WYSIWYG area.
                // Note: it is recommended to keep your own styles in a separate file in order to make future updates painless.
//                contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css', 'css/mystyles.css' ],
                contentsCss: [ 'https://cdn.ckeditor.com/4.8.0/full-all/contents.css'],
                // This is optional, but will let us define multiple different styles for multiple editors using the same CSS file.
                bodyClass: 'document-editor',
                // Reduce the list of block elements listed in the Format dropdown to the most commonly used.
                format_tags: 'p;h1;h2;h3;pre',
                // Simplify the Image and Link dialog windows. The "Advanced" tab is not needed in most cases.
                removeDialogTabs: 'image:advanced;link:advanced',
                // Define the list of styles which should be available in the Styles dropdown list.
                // If the "class" attribute is used to style an element, make sure to define the style for the class in "mystyles.css"
                // (and on your website so that it rendered in the same way).
                // Note: by default CKEditor looks for styles.js file. Defining stylesSet inline (as below) stops CKEditor from loading
                // that file, which means one HTTP request less (and a faster startup).
                // For more information see http://docs.ckeditor.com/ckeditor4/docs/#!/guide/dev_styles
                stylesSet: [
                    /* Inline Styles */
                    { name: 'Marker', element: 'span', attributes: { 'class': 'marker' } },
                    { name: 'Cited Work', element: 'cite' },
                    { name: 'Inline Quotation', element: 'q' },
                    /* Object Styles */
                    {
                        name: 'Special Container',
                        element: 'div',
                        styles: {
                            padding: '5px 10px',
                            background: '#eee',
                            border: '1px solid #ccc'
                        }
                    },
                    {
                        name: 'Compact table',
                        element: 'table',
                        attributes: {
                            cellpadding: '5',
                            cellspacing: '0',
                            border: '1',
                            bordercolor: '#ccc'
                        },
                        styles: {
                            'border-collapse': 'collapse'
                        }
                    },
                    { name: 'Borderless Table', element: 'table', styles: { 'border-style': 'hidden', 'background-color': '#E6E6FA' } },
                    { name: 'Square Bulleted List', element: 'ul', styles: { 'list-style-type': 'square' } }
                ]
            } );

        })

    </script>
    <style>
        #listaRazao{float:left;list-style:none;margin-top:-3px;padding:0;width:390px;position: absolute; z-index: 10;}
        #listaRazao li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
        #listaRazao li:hover{background:#ece3d2;cursor: pointer;}
        #listaCnpj{float:left;list-style:none;margin-top:-3px;padding:0;width:390px;position: absolute;z-index: 10;}
        #listaCnpj li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
        #listaCnpj li:hover{background:#ece3d2;cursor: pointer;}
        .mail-edit, .undo-save-mail, .do-save-mail{ cursor: pointer; }
        .custom-input{ width: 85%; display: inline-block; }
        .input-email > i {
            margin-left: 5px;
        }
        .alert-float{
            position: fixed;
            right: 50px;
            top: 10px;
            z-index: 9999;
        }
    </style>
</head>
<body>
<template id="template-editor-email">
    <div class="input-email">
        <input type="text" class="form-control custom-input" />
        <i class="glyphicon glyphicon-remove red undo-save-mail right mt-10"></i>
        <i class="glyphicon glyphicon-ok do-save-mail right mt-10"></i>
    </div>
</template>
<template id="linha-alerta">
    <tr>
        <td></td>
        <td></td>
        <td>
            <span></span>
            <a exibir-emails-enviados class="glyphicon glyphicon-list-alt hidden"></a>
        </td>
        <td></td>
        <td align="center"></td>
    </tr>
</template>
<template id="linha-alerta-empresa">
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td align="center"><a exibir-email class="glyphicon glyphicon-eye-open"></a></td>
    </tr>
</template>
	<?php require_once("includes/modals.php");
    include ("includes/topo.php");
	?>
	<div class="container" ng-controller="CampanhaController">
        <?php require_once("includes/menu.php");?>
        <form id="form-cons-campanha" onsubmit="return false;">
            <div class="bs-callout bs-callout-primary">
                <h4 style="font-size: 14px"><strong>Pesquisar Campanha</strong></h4><br />

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group font-12 grey">
                            <label class="radio-inline">
                                <input type="radio" id="opcPesquisa" name="opcPesquisa" value="1" onclick="exibirTipoPesquisa(this.value)"
                                       checked><strong>Campanha</strong>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" id="opcPesquisa" name="opcPesquisa" value="2" onclick="exibirTipoPesquisa(this.value)"><strong>CNPJ</strong>
                            </label>
                        </div><!-- /input-group -->
                    </div>

                </div>
                <div class="row" id="pesqCampanha">
                    <div class="col-lg-4">
                        <div class="" >
                            <label class="font-12 grey">Nome da campanha:</label>
                            <input type="text" class="form-control input-sm"  id="nomeCampanha" name="nomeCampanha">
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="" >
                            <label class="font-12 grey">Ano Base:</label>
                            <select class="form-control input-sm" id="pesqAnoBase" name="pesqAnoBase">
                                <option value="">Selecione</option>
                                <?php foreach ($listaAnoBase as $anoBase) { ?>
                                    <option value="<?=$anoBase?>"><?=$anoBase?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="font-12 grey" >
                            <label class="font-12 grey">Situacao:</label>
                            <select class="form-control input-sm" name="pesqSituacao" id="pesqSituacao">
                                <option value="">Selecione</option>
                                <option value="1">Pré-Ativa</option>
                                <option value="2">Ativa</option>
                                <option value="3">Inativa</option>
                                <option value="4">Encerrada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="font-12 grey" >
                            <button class="btn btn-primary btn-sm mt-20" value="" id="btnPesqCamp" name="btnPesqCamp"
                                    onclick="pesquisaCampanha()"><i class="glyphicon
                                 glyphicon-search"></i>&nbsp;&nbsp;Pesquisar &nbsp;&nbsp;&nbsp; <i class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>
                        </div>
                    </div>
                </div>
                <div class="row no-display" id="pesqCnpj">
                    <div class="col-lg-6">
                        <div class="" >
                            <label class="font-12 grey">CNPJ ou Razão Social:</label>
                            <input type="text" class="form-control input-sm" placeholder="" id="empresa">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="" >
                            <label class="font-12 grey">Situação do Cadastro:</label>
                            <select class="form-control input-sm" id="situacaoCadastro" name="situacaoCadastro">
                                <option value="">Selecione</option>
                                <option value="1">Todos</option>
                                <option value="2">Concluídos</option>
                                <option value="3">Não Concluídos</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="font-12 grey" >
                            <button class="btn btn-primary btn-sm mt-20" value="" id="btnPesqCnpj" name="btnPesqCnpj"
                                    onclick="pesquisaCampanhaCnpj()"><i class="glyphicon
                                 glyphicon-search"></i>&nbsp;&nbsp;Pesquisar &nbsp;&nbsp;&nbsp;<i class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i></button>
                        </div>
                    </div>
                </div>


            </div>
        </form>
        <div class="alert alert-dismissible fade in alert-danger no-display" id="alerta">
            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
            <p class="font-12"></p>
        </div>
        <div id="resultado">
        </div>

        <div class="alert alert-float" style="display: none"></div>

        <div class="modal fade no-display" id="editarCampanha" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title"><strong>Editar Campanha</strong></h5>
                    </div>
                    <div class="modal-body bg-grey">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsg">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12"></p>
            </div>
            <form role="form" onsubmit="return false;" id="formCadCampanha">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="campanha">Campanha:</label>
                            <input type="text" class="form-control input-sm" id="campanha" name="campanha" required  oninvalid="setCustomValidity('Informe o nome da campanha.')" oninput="setCustomValidity('')" value="">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="campanha">Ano Base:</label>
                            <select type="text" class="form-control input-sm" id="anoBase" name="anoBase" required  oninvalid="setCustomValidity('Informe o Ano Base.')" oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <?php foreach ($listaAnoBase as $anoBase) { ?>
                                    <option value="<?=$anoBase?>"><?=$anoBase?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dataInicio">Data Inicial:</label>
                                    <input type="text" class="form-control input-sm datepicker date " data-date-start-date="0d" id="dataInicio" name="dataInicio" required oninvalid="setCustomValidity('Informe a data inicial da Campanha.')" oninput="setCustomValidity('')" value="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dataInicio">Data Final:</label>
                                <input type="text" class="form-control input-sm datepicker date" data-date-start-date="0d" id="dataFim" name="dataFim" required  oninvalid="setCustomValidity('Informe a data final da campanha')" oninput="setCustomValidity('')" value="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h6>Total de Empresas incluídas na Campanha: <span id="totalDeEmpresas" class="font-12 grey strong"></span></h6>
                            <input type="hidden" id="totalEmpresas" name="totalEmpresas" value="">
                            <input type="hidden" id="situacao" name="situacao" value="">
                        </div>
                    </div>
                    <div class="col-md-8" id="formBtnIncluirEmpresa">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm" onclick="incluirEmpresa(); return false;"><span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;Incluir Empresa</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                        <label for="situacao">Atual Situação:</label>
                        <select type="text" class="form-control input-sm" id="atualSituacao" disabled>
                            <option value="1">Pré-Ativa</option>
                            <option value="2">Ativa</option>
                            <option value="3">Inativa</option>
                            <option value="3">Encerrada</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-3" id="div-inativar">
                        <div class="form-group">
                            <label for="situacao">Inativar:</label>
                            <select type="text" class="form-control input-sm" id="situacao" required oninvalid="setCustomValidity('Informe a situação da campanha.')" oninput="setCustomValidity('')">
                                <option value="3">Sim</option>
                                <option value="2" selected>Não</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="usuarioAlteracao" name="usuarioAlteracao"
                                           value="<?=$_SESSION['usuarioAtual']['login']?>">
                                    <input type="hidden" id="dataHoraAlteracao" name="dataHoraAlteracao"
                                           value="<?=date("d/m/Y H:i:s")?>">
                                    <input type="hidden" id="idCampanha" name="idCampanha"
                                           value="">
                                    <button id="btnEditarCampanha" type="submit" onclick="editarCampanhaConsulta();return false" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;Alterar</button>
                                </div>
                            </div>
                            <div class="col-md-3" id="formBtnEnviarAlerta">
                                <div class="form-group">
                                    <button id="btnEnviarAlerta"  type="submit" onclick="exibirEnvioAlerta();return false"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-bell"></span> &nbsp;&nbsp;Enviar Alerta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-6">
                            <span class="font-10">* Todos os campos têm preenchimento obrigatório.</span>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-default grey font-12" data-dismiss="modal" onclick="limpaAdicionarEmpresas()">Fechar</button>
                </div>
            </div>
        </div>
    </div>

        <div class="modal fade no-display" id="visualizarCampanha" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title"><strong>Editar Campanha</strong></h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsg">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12"></p>
                        </div>
                        <form role="form" onsubmit="return false;" id="formCadCampanha">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="campanha">Campanha:</label>
                                        <input type="text" class="form-control input-sm" id="campanhaVis" name="campanha" value="" disabled>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="campanha">Ano Base:</label>
                                        <select type="text" class="form-control input-sm" id="anoBaseVis" name="anoBase" disabled >
                                            <option value="">Selecione</option>
                                            <?php foreach ($listaAnoBase as $anoBase) { ?>
                                                <option value="<?=$anoBase?>"><?=$anoBase?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="dataInicio">Data Inicial:</label>
                                                <input type="text" class="form-control input-sm"  id="dataInicioVis" name="dataInicioVis" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="dataInicio">Data Final:</label>
                                            <input type="text" class="form-control input-sm"  id="dataFimVis" name="dataFimVis"  value="" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6>Total de Empresas incluídas na Campanha: <span id="totalDeEmpresasVis" class="font-12 grey strong"></span></h6>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="situacao">Situação:</label>
                                        <select type="text" class="form-control input-sm" id="atualSituacaoVis" disabled>
                                            <option value="1">Pré-Ativa</option>
                                            <option value="2">Ativa</option>
                                            <option value="3">Inativa</option>
                                            <option value="4">Encerrada</option>
                                        </select>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="visualizaEmpresas" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="form-group">
                            <input class="form-control" type="text" name="pesquisar" placeholder="pesquisar" id="pesquisaEmpresa" />
                        </div>

                        <div class="alert hidden"></div>
                        <div id="listaEmpresas" class="mt-10 listaEmpresaModal">

                        </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="visualizarAlertas" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-11 grey">
                    <div class="modal-header">
                        <h5 class="modal-title">Vizualizar Alertas</h5>
                    </div>
                    <div class="modal-body">
                        <div class="bg-grey p-10">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Campanha</td>
                                    <td modal-alertas-campanha class="bg-white" ><b></b></td>
                                    <td>Ano Base</td>
                                    <td modal-alertas-ano-base class="bg-white" ><b></b></td>
                                </tr>
                                <tr>
                                    <td >Início</td>
                                    <td  modal-alertas-inicio class="bg-white"><b></b></td>
                                    <td  >Fim</td>
                                    <td modal-alertas-fim class="bg-white"><b></b></td>
                                </tr>
                                <tr>
                                    <td>Situação</td>
                                    <td modal-alertas-situacao class="bg-white"><b></b></td>
                                    <td>Alertas</td>
                                    <td modal-alertas-alertas class="bg-white"><b></b></td>
                                </tr>
                            </table>
                        </div>


                        <table class="table table-bordered mt-10" >
                            <thead>
                                <th width="10">#</th>
                                <th>Assunto</th>
                                <th>msg enviadas</th>
                                <th>Situação</th>
                                <th></th>
                            </thead>
                            <tbody id="listaAlerta">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="visualizaAlertaEmpresas" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title">Emails enviados</h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <table class="table table-bordered" id="listaAlertaEmpresas">
                            <thead>
                                <th>CNPJ</th>
                                <th>Email</th>
                                <th>Envio</th>
                                <th></th>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer "></div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="visualizaConteudoEmail" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title">Conteudo do email Enviado</h5>
                    </div>
                    <div class="modal-body bg-grey">

                    </div>
                    <div class="modal-footer "></div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="enviarAlerta" data-backdrop="static" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><strong>Enviar Alerta</strong></h5>
                    </div>

                    <div class="modal-body bg-grey">
                        <div class="alert alert-dismissible fade in hidden" id="alertaMsgAlerta" >
                            <p class="font-12"></p>
                        </div>
                        <div>
                            <form role="form" id="formEnviarAlerta">
                                <div class="row grey font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="assunto">Assunto:</label>
                                            <input type="text" class="form-control input-sm" id="assunto" name="assunto" required  oninvalid="setCustomValidity('Informe o assunto.')" oninput="setCustomValidity('')" >
                                            <input type="hidden" id="idCampanha" name="idCampanha" />
                                            <input type="hidden" id="cnpjEmpresa" name="cnpj" />
                                        </div>
                                    </div>
                                    <div id="campanha-images" class="col-md-12"></div>
                                </div>
                                <div class="row grey font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem:</label>
                                            <textarea class="form-control input-sm" id="texto" name="texto" rows="5" required  oninvalid="setCustomValidity('Informe a mensagem.')" oninput="setCustomValidity('')"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row grey font-12">
                                    <div class="col-md-12">
                                        <button id="btnenviarAlertaForm"  type="submit"  class="btn btn-primary btn-sm right">
                                            <span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp;Enviar Alerta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>


    </div>
	<?php require_once("includes/footer.php")?>
</body>
</html>