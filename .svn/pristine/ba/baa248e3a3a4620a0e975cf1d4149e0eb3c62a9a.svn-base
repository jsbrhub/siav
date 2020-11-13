<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Campanha =========================
$retorno = [];
if($_REQUEST['dados'] == 'cadastro'){
    print ($id = $oControle->cadastraCampanha()) ? "" : $oControle->msg;
    $retorno["msg"] = $oControle->msg;
    $retorno["id"] = $id;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['idCampanha']){
    $idCampanha = $_REQUEST['idCampanha'];
    $infoCampanha = $oControle->getCampanha($_REQUEST['idCampanha']);
    $dataInicio = Util::formataDataBancoForm($infoCampanha->dataInicio);
    $dataFim = Util::formataDataBancoForm($infoCampanha->dataFim);
    $listaEmpresaCampanha = $oControle->getTodasEmpresasCampanha($idCampanha);
   // Util::trace($listaEmpresaCampanha,false);
    if($listaEmpresaCampanha){
        $totalEmpresas = count($listaEmpresaCampanha);
        $totEmpresas = count($listaEmpresaCampanha);
    }else{
        $totalEmpresas = $infoCampanha->totalEmpresas;

    }
if($totEmpresas == $infoCampanha){
    $listaEmpresaCampanha = '';
}

    $situacao = $infoCampanha->situacao;


    $rascunho = $oControle->getRascunhoRecente($idCampanha);
    //Util::trace($rascunho,false);
    if($rascunho){
        $idAlerta = $rascunho->idAlerta;
        $assunto = $rascunho->assunto;
        $texto = $rascunho->texto;
        $situacaoAlerta = $rascunho->situacao;
        $tipoSelecao = $rascunho->tipoSelecao;
    }

}
$todasEmpresas = $oControle->retornaEmpresasVigentesGroupByCnpj();
$todasEmpresasTot = count($todasEmpresas);
if($todasEmpresasTot == $totalEmpresas){
    $marcarTodas = 'checked';
    $checaTodasEmpresas = '1';
}else{
    $marcarTodas = '';
    $checaTodasEmpresas = '';
}

if($_REQUEST['dados'] == 'checarEmpresas'){
    $totalEmpresasBD = $oControle->retornaEmpresasVigentesGroupByCnpj();
    $oCampanha = $oControle->getCampanha($_REQUEST['idCampanha']);
    $totEmpCamp = $oCampanha->totalEmpresas;
    if($totalEmpresasBD){
        $totEmpBD = count($totalEmpresasBD);
//        $totEmpBD = is_array($totalEmpresasBD) ?  count($totalEmpresasBD);
    }

    if($totEmpBD == $totEmpCamp){
        $totEmp = "todas";
    }else{
        $totEmp = "";
    }
    $retorno['totEmp'] = $totEmp;

    $listaEmpresaCampanha = $oControle->getTodasEmpresasCampanha($_REQUEST['idCampanha']);

    if($listaEmpresaCampanha){
        $item = '';
        foreach ($listaEmpresaCampanha as $empCamp){
            $empresa = $oControle->getInfoAtualEmpresa($empCamp->cnpj);
            $cidade = $empresa->oMunicipio->municipio.' / '.$empresa->oMunicipio->uf; if(!$cidade)$cidade = '-';
            $formataCnpj = Util::formataCNPJ($empresa->cnpj);
            $item .= '<tr class="font-12 busca" id="tr-id'.$empCamp->idEmpresaCampanha.'" >
                                                        <td nowrap="yes">'.$formataCnpj.'</td>
                                                        <td>'.$empresa->razaoSocial.'</td>
                                                        <td>'.$cidade.'</td>
                                                        <td>
                                                            <input type="hidden" id="idCampanha" name="idCampanha" value="'.$empCamp->oCampanha->idCampanha.'" />
                                                            <input type="hidden" id="idEmp[]" name="idEmp[]"
                                                                   value="'.$empresa->idEmpresa.'" />
                                                            <span id="EMP'.$empresa->cnpj.'" name="EMP'.$empresa->cnpj.'" ></span>
                                                            <button type="button"  onclick="removeEmpCamp('.$empCamp->idEmpresaCampanha.')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                                        </td>
                                                    </tr>';
        }
    }

    $retorno['itensTabela'] = $item;

    echo json_encode($retorno);
    exit;


}
$listaAnoBase = Util::listarAnoBase('2007',date('Y'));

?>
<!DOCTYPE html>
<html lang="pt">
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

        $(document).ready(function(){

            $("button#enviarAlerta").click(function(e){
                e.preventDefault();

                if($("#assunto").val() == "" || CKEDITOR.instances["texto"].getData() == ""){
                    $("#alertaMsgAlerta").addClass("alert-danger").removeClass("no-display alert-info").find("p").html("Preencha todos os campos");

                    return false;
                }

                var $this = $(this);

                $this.attr('disabled', false);

                var empresas = [];

                var params = { idCampanha: $("#idCampanha").val() };

                params["status"] = $("#tipoSelecao").val();

                if(empresas.length == 0){
                    $.ajax({
                        url: 'api/campanha.php',
                        method: 'GET_EMPRESAS',
                        data: params,
                        dataType: 'json',
                        success: function (server) {
                            empresas = server.data;

                            if(empresas.length > 0){
                                $(".modal").modal("hide");

                                $("#modalRelatorioEnvio").modal("show");

                                $("#modalRelatorioEnvio .modal-footer button").addClass("hidden");

                                $("#modalRelatorioEnvio .spin").removeClass("hidden");

                                $("[data-rel-total]").text(empresas.length);

                                $("[data-rel-enviados], [data-rel-nao-enviados], [data-rel-progresso]").text(0);

                                $("#modalRelatorioEnvioNaoEnviados .modal-body").empty();

                                processaEnvioEmpresas(empresas);

                            }
                        }
                    });
                }
            });

            function processaEnvioEmpresas(empresas){

                if(empresas.length > 0){

                    var empresa = empresas.splice(0,1)[0];

                    if(empresa.cnpj != undefined){
                        $.ajax({
                            url: 'api/alertas.php',
                            method: 'SEND_ALERT',
                            data: {
                                sleep: empresas.length%5 == 0 ? 3 : false,
                                idCampanha: $("#idCampanha").val(),
                                idAlerta: $("#idAlerta").val(),
                                assunto: $("#assunto").val(),
                                texto: CKEDITOR.instances["texto"].getData(),
                                cnpj: empresa.cnpj
                            },
                            dataType: 'json',
                            success: function (r) {
                                if(r.success){
                                    $("[data-rel-enviados]").text(parseInt($("[data-rel-enviados]").text())+1);

                                } else {
                                    $("#modalRelatorioEnvioNaoEnviados .modal-body").append("<p>"+r.msg+"</p>");

                                    $("[data-rel-nao-enviados]").text(parseInt($("[data-rel-nao-enviados]").text())+1);
                                }

                                if($("#idAlerta").val() == "" && r.data.idAlerta != undefined)
                                    $("#idAlerta").val(r.data.idAlerta);


                                $("[data-rel-progresso]").text(parseInt($("[data-rel-progresso]").text())+1);

                                processaEnvioEmpresas(empresas);
                            }
                        });
                    }
                } else{
                    $("#modalRelatorioEnvio .modal-footer button").removeClass("hidden");

                    $("#modalRelatorioEnvio .spin").addClass("hidden");

                    $("#formEnviarAlerta")[0].reset();

                    CKEDITOR.instances["texto"].setData("");
                }
            }


            $("#btnEnviarAlerta").click(function(){

                $("#alertaMsgAlerta").addClass("no-display");

                $.post("campanha-imagem-upload.php", { idCampanha: $("#idCampanha").val() }, function(data){
                    $("#campanha-images").html("");

                    $.each(data, function (k, v) {
                        $("#campanha-images").append("<img class='img-campanha' src='http://siav.sudam.gov.br/"+v+"' width='50' />");
                    });
                }, "json");
            });

            $(document).on('click', '.img-campanha', function(){
                CKEDITOR.instances["texto"].insertHtml("<img src='"+$(this).attr("src")+"' width='200' />");
            });

            $("#enviar-img").click(function(e){
                e.preventDefault();

                var btn = $(this);

                btn.attr("disbeld", true);

                var formData = new FormData();

                formData.append('idCampanha', $("#idCampanha").val());

                formData.append('imagem', $('#img_file')[0].files[0]);

                $.ajax({
                    url: "campanha-imagem-upload.php",
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function(data) {

                        $("#campanha-images").html("");

                        $.each(data, function (k, v) {
                            $("#campanha-images").append("<img class='img-campanha' src='http://siav.sudam.gov.br/"+v+"' width='50' />");
                        });

                        btn.attr("disbeld", false);
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
    </style>
</head>
<body>
	<?php
    require_once("includes/modals.php");
    include ("includes/topo.php");
	?>
	<div class="container">
		<?php require_once("includes/menu.php"); ?>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
        <div class="bs-callout bs-callout-primary bg-grey font-12 grey">
            <h4 style="font-size: 14px"><strong>Cadastrar Campanha</strong></h4><br />
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsg">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12"></p>
            </div>
            <form role="form" onsubmit="return false;" id="formCadCampanha">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="campanha">Campanha:</label>
                            <input type="text" class="form-control input-sm" id="campanha" name="campanha[campanha]" required  oninvalid="setCustomValidity('Informe o nome da campanha.')" oninput="setCustomValidity('')" value="<?=($infoCampanha->campanha != '')
                            ?$infoCampanha->campanha:'';?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="campanha">Ano Base:</label>
                            <select type="text" class="form-control input-sm" id="anoBase" name="campanha[anoBase]" required  oninvalid="setCustomValidity('Informe o Ano Base.')" oninput="setCustomValidity('')">
                                <option value="">Selecione</option>
                                <?php foreach ($listaAnoBase as $anoBase) { ?>
                                    <option value="<?=$anoBase?>" <?=($infoCampanha->anoBase == $anoBase)?'selected':'';
                                    ?>><?=$anoBase?></option>
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
                                    <input type="text" class="form-control input-sm datepicker date " data-date-start-date="0d" id="dataInicio" name="campanha[dataInicio]" required oninvalid="setCustomValidity('Informe a data inicial da Campanha.')" oninput="setCustomValidity('')" value="<?=
                                    ($dataInicio != '')? $dataInicio :''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dataInicio">Data Final:</label>
                                <input type="text" class="form-control input-sm datepicker date" data-date-start-date="0d" id="dataFim" name="campanha[dataFim]" required  oninvalid="setCustomValidity('Informe a data final da campanha')" oninput="setCustomValidity('')" value="<?=
                                ($infoCampanha->dataFim != '')? Util::formataDataBancoForm
                                ($infoCampanha->dataFim):''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h6>Total de Empresas incluídas na Campanha: <a onclick="visualizarEmpresasEdit
                                        (<?=$idCampanha?>,1);" ><span id="totEmpresas" class="label label-primary font-13" style="cursor: pointer"><?=($totalEmpresas != '')?$totalEmpresas:'0'?></span></a></h6>
                            <input type="hidden" id="totalEmpresas" name="campanha[totalEmpresas]" value="<?=$totalEmpresas?>">
                            <input type="hidden" id="situacao" name="campanha[situacao]" value="<?=($situacao!='')?$situacao:'1'?>">
                        </div>
                    </div>
                    <div class="col-md-8 <?=(empty($idCampanha))?'no-display':''?>" id="formBtnIncluirEmpresa">
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="incluirEmpresa(<?=$idCampanha?>); return false;"><span class="glyphicon glyphicon-plus"></span> &nbsp;&nbsp;Incluir Empresa</button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="hidden" id="usuarioAlteracao" name="campanha[usuarioAlteracao]"
                                           value="<?=$_SESSION['usuarioAtual']['login']?>">
                                    <input type="hidden" id="dataHoraAlteracao" name="campanha[dataHoraAlteracao]"
                                           value="<?=date("d/m/Y H:i:s")?>">
                                    <input type="hidden" id="idCampanha" name="campanha[idCampanha]"
                                           value="<?=$idCampanha?>">
                                    <input type="hidden" id="todasEmpresas" name="todasEmpresas"
                                           value="<?=$checaTodasEmpresas?>">
                                    <button id="btnSalvarCampanha" type="submit" onclick="salvarCampanha();return false" class="btn btn-primary btn-sm <?=($idCampanha != '')?'no-display':''?>"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;Salvar</button>
                                    <button id="btnEditarCampanha" type="submit" onclick="editarCampanha();return false" class="btn btn-primary btn-sm <?=($idCampanha)?'':'no-display'?>"><span class="glyphicon glyphicon-ok"></span> &nbsp;&nbsp;Salvar</button>
                                </div>
                            </div>
                            <div class="col-md-3 <?=(!$totalEmpresas)?'no-display':''?>" id="formBtnEnviarAlerta">
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

            <!-- Modal - Incluir Empresas -->
            <div class="modal fade no-display" id="addEmpresa" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" onclick="limpaAdicionarEmpresas()">&times;</button>
                            <h5 class="modal-title"><strong>Adicionar Empresa</strong></h5>
                        </div>
                        <div class="modal-body bg-grey">
                                <div id="selecionaEmpresa">

                                    <form role="form" onsubmit="return false;" id="formCadCampanha">
                                        <div id="div-add-empresa">
                                        <div class="row  grey font-12">
                                                <div class="col-md-6">
                                                        <div class="form-group ">
                                                            <label for="empresa">CNPJ:</label>
                                                            <input type="text" class="form-control input-sm somentenumeros" id="cnpj" name="cnpj">
                                                            <input type="hidden" class="form-control" id="cnpjEmpresa" name="cnpjEmpresa" value="" />
                                                            <input type="hidden" class="form-control" id="idEmpresa" name="idEmpresa" value="" />
                                                            <input type="hidden" class="form-control" id="idCampanha" name="idCampanha" value="<?=$idCampanha?>" />
                                                            <div id="listaCnpj"></div>

                                                        </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="campanha">Razão Social:</label>
                                                        <input type="text" class="form-control input-sm" id="razaoSocial" name="razaoSocial">
                                                        <input type="hidden" class="form-control" id="cnpjRazao" name="cnpjRazao" value="" />
                                                        <div id="listaRazao"></div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button type="button" class="btn btn-primary font-12" onclick="verificaEmpresa()">
                                                        <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Adicionar</button>
                                                </div>
                                            </div>
                                        </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="checkbox checkbox-primary">
                                                         <input type="checkbox" class="styled"  id="todas" name="todas" value="1" onclick="adicionarTodasEmpresas()" <?=$marcarTodas?>> <label class="font-12 grey">Incluir Todas</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <div class="alert alert-dismissible fade in alert-danger" id="alerta" style="display: none">
                                        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                                        <p class="font-12"></p>
                                    </div>
                                </div>

                                <div id="divlistaEmpresas" class="bg-grey p-10 border-radius content-table <?=
                                (!$listaEmpresaCampanha)?'no-display':''?>">
                                    <form method="post" id="tabelaEmpCampanha" onsubmit="return false;">
                                    <?php   ?>
                                        <table class="table table-striped border-radius" id="listaEmpresas">
                                            <thead>
                                            <tr class="bg-grey grey font-13">
                                                <th>CNPJ</th>
                                                <th>Razão Social</th>
                                                <th>Cidade / UF</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody id="empresasCampanha">
                                            <?php
                                            if($listaEmpresaCampanha){
                                                //Util::trace($listaEmpresaCampanha,false);
                                                foreach ($listaEmpresaCampanha as $emp){
                                                    $empresa = $oControle->getInfoAtualEmpresa($emp->cnpj);
                                                    $formataCnpj = Util::formataCNPJ($empresa->cnpj);
                                                    $endereco = $empresa->endereco; if(!$endereco)$endereco = '-';
                                                    $bairro = $empresa->bairro; if(!$bairro)$bairro = '-';
                                                    $cep = $empresa->cep; if(!$cep)$cep = '-';
                                                    $cidade = $empresa->oMunicipio->municipio.' / '.$empresa->oMunicipio->uf; if(!$cidade)$cidade = '-';
                                                    $tel = $empresa->telefone; if(!$tel)$tel = '-';
                                                    $email = $empresa->email; if(!$email)$email = '-';
                                                    $contato =  $oControle->getContatoempresa($empresa->idEmpresa);
                                                    $contato = $contato->contato; if(!$contato)$contato = '-';

                                                    ?>
                                                    <tr class="font-12 busca" id="tr-id<?php echo
                                                    $emp->idEmpresaCampanha;?>" >
                                                        <td nowrap="yes"><?=$formataCnpj?></td>
                                                        <td><?=$empresa->razaoSocial?></td>
                                                        <td><?=$cidade?></td>
                                                        <td>
                                                            <input type="hidden" id="idCampanha" name="idCampanha" value="<?=$emp->oCampanha->idCampanha?>" />
                                                            <input type="hidden" id="idEmp[]" name="idEmp[]"
                                                                   value="<?=$empresa->idEmpresa?>" />
                                                            <span id="EMP<?=$empresa->cnpj?>" name="EMP<?=$empresa->cnpj?>" ></span>
                                                            <button type="button"  onclick="removeEmpCamp('<?=$emp->idEmpresaCampanha?>')" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                        <?php  ?>
<!--                                        <input type="hidden" id="idCampanha" name="idCampanha" value="--><?//=$_REQUEST['idCampanha']?><!--" />-->
                                        <button id="concluir" name="concluir" class="btn btn-primary font-12" onclick="concluirEmpresa()" >Concluir  <i class="glyphicon
                                 glyphicon-refresh  spin hidden spin-loader"></i></button>

                                    </form>

                                </div>
                            </div>

                        <div class="modal-footer ">
                            <button type="button" class="btn btn-default grey font-12" data-dismiss="modal" onclick="limpaAdicionarEmpresas()">Fechar</button>
                        </div>
                    </div>
                    </div>
                </div>

        <div class="modal fade no-display" id="modalRelatorioEnvio" role="dialog" data-backdrop="static">
            <div class="modal-dialog modal-sm">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <i class="glyphicon glyphicon-refresh right spin"></i>
                        <h5 class="modal-title">Relatório de envio</h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="alert alert-warning">
                            não feche esta aba até que todo o processo de envio seja concluido, isso pode levar varios minutos.
                        </div>

                        <div class="list-group mt-10">
                            <li href="#" class="list-group-item active">
                                Total de empresas na campanha
                                <span class="right label label-default" data-rel-total >12</span>
                            </li>
                            <li href="#" class="list-group-item ">
                                Alertas enviados
                                <span class="right label label-success" data-rel-enviados >12</span>
                            </li>
                            <li href="#" class="list-group-item">
                                Alertas não enviados
                                <span class="right label label-danger" data-role="modal" data-target="#modalRelatorioEnvioNaoEnviados" data-rel-nao-enviados >12</span>
                            </li>
                        </div>
                        <div class="progresso mt-10">
                            <i>processando <label class="right" ><span data-rel-progresso>12</span>/<span data-rel-total></span></label></i>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12 hidden" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade no-display" id="modalRelatorioEnvioNaoEnviados" role="dialog" >
            <div class="modal-dialog modal-sm">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <i class="glyphicon glyphicon-refresh right spin"></i>
                        <h5 class="modal-title">Relatório de não enviados</h5>
                    </div>
                    <div class="modal-body bg-grey">

                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Enviar Alerta -->
        <div class="modal fade no-display" id="enviarAlerta" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="limparAlerta()">&times;</button>
                        <h5 class="modal-title"><strong>Enviar Alerta</strong></h5>
                    </div>

                    <div class="modal-body bg-grey">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaMsgAlerta" >
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12"></p>
                        </div>
                        <div id="carregando" class="no-display">
                            <img src="img/blocksLoading.gif"> <span class="font-12">Enviando...</span>
                        </div>
                        <div id="divEnviarAlerta">

                            <form role="form" onsubmit="return false;" id="formEnviarAlerta">
                                <div class="row  grey font-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nome Campanha:</label>
                                            <?=$infoCampanha->campanha?>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <label>Ano Base:</label>
                                            <?=$infoCampanha->anoBase?>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Quantidade de Empresas:</label>
                                            <?=$totalEmpresas?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row grey font-12">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="assunto">Assunto:</label>
                                            <input type="text" class="form-control input-sm" id="assunto" name="alerta[assunto]" required  oninvalid="setCustomValidity('Informe o assunto.')" oninput="setCustomValidity('')" value="<?=($assunto != '')?$assunto:''?>">
                                            <input type="hidden" id="idCampanha" name="alerta[idCampanha]"
                                                   value="<?=$idCampanha?>" >
                                            <input type="hidden" id="totalEmpresas" name="alerta[totalEmpresas]"
                                                   value="<?=$totalEmpresas?>" >
                                            <input type="hidden" id="situacao" name="alerta[situacao]"
                                                   value="<?=$situacaoAlerta?>" >
                                            <input type="hidden" class="form-control" id="idAlerta" name="alerta[idAlerta]" value="<?=($idAlerta != '')
                                                ?$idAlerta:''?>" />
                                            <input type="hidden" id="usuarioAlteracao" name="alerta[usuarioAlteracao]"
                                                   value="<?=$_SESSION['usuarioAtual']['login']?>">
                                            <input type="hidden" id="dataHoraAlteracao" name="alerta[dataHoraAlteracao]"
                                                   value="<?=date("d/m/Y H:i:s")?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="destino">&nbsp;</label>
                                            <select class="form-control input-sm" id="tipoSelecao" name="alerta[tipoSelecao]">
                                                <option value="1" <?=($tipoSelecao == '1')?'selected':''?>>Todas</option>
                                                <option value="2" <?=($tipoSelecao == '2')?'selected':''?>>Empresas - Cadastros Não Iniciados</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Imagem:</label>
                                        <input type="file" accept="image/*" name="image_file" id="img_file" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" style="margin-top: 20px" class="btn btn-primary btn-sm" id="enviar-img">enviar imagem</button>
                                </div>
                                <div id="campanha-images" class="col-md-12"></div>
                                <div class="row grey font-12">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mensagem">Mensagem:</label>
                                            <textarea class="form-control input-sm" id="texto" name="alerta[texto]" rows="5" required  oninvalid="setCustomValidity('Informe a mensagem.')" oninput="setCustomValidity('')"><?=($texto != '')?$texto:''?></textarea>

                                        </div>
                                    </div>
                                </div>
                                <div class="row grey font-12">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <?php if($rascunho){ ?>
                                            <button id="salvarRascunho"  type="submit" onclick="editarRascunhoAlerta();"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> &nbsp;&nbsp;Salvar Rascunho </button>
                                            <?php } else{ ?>
                                                <button id="salvarRascunho"  type="submit" onclick="salvarAlerta();"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-pencil"></span> &nbsp;&nbsp;Salvar Rascunho </button>
                                            <?php }  ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <button id="enviarAlerta"  type="submit"  class="btn btn-primary btn-sm">
                                                <span class="glyphicon glyphicon-envelope"></span> &nbsp;&nbsp;Enviar Alerta</button>
                                        </div>
                                    </div>


                        </div>

                                </div>

                            </form>
                        </div>


                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal" onclick="limparAlerta()">Fechar</button>
                    </div>
                </div>
            </div>

    </div>
        <div class="modal fade no-display" id="visualizaEmpresasEdit" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" onclick="">&times;</button>
                        <h5 class="modal-title"></h5>
                    </div>
                    <div class="modal-body bg-grey">
                        <div id="listaEmpresasEdit">

                        </div>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>


	</div><!--           container -->
	<?php require_once("includes/footer.php")?>
</body>
</html>