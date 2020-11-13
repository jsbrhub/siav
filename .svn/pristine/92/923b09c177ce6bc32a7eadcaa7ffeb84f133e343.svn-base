$(document).ready(function(){

});//document ready

function addDocumento(idArquivoEmpresa) {
    $("#alertaDocumentoModal").hide();
    $("#alertaDocumento").hide();
    $("#modalDocumentos").modal("show");
    $("#arquivoDocumento").filestyle("clear");
    if(idArquivoEmpresa == '0') {
        $("#tipoArquivo","#form-documento").prop("readonly",false);
        $("#descricao","#form-documento").prop("readonly",false);
        $("#idArquivoEmpresa").val('');
        document.getElementById("form-documento").reset();

        $("#anexarDocumento").show();
        $("#listaArquivoDocumento").hide();

    }else{
        tipoDados = 'documento';
        $.ajax({
            url: 'cadArquivoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idArquivoEmpresa='+idArquivoEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.infoDoc != ''){
                    $("#idArquivoEmpresa","#form-documento").val(retorno.infoDoc.idArquivoEmpresa);
                    $("#idEmpresa","#form-documento").val(retorno.infoDoc.oEmpresa.idEmpresa);
                    $("#tipoArquivo","#form-documento").val(retorno.infoDoc.oTipoarquivo.tipo);
                    $("#idTipoArquivo","#form-documento").val(retorno.infoDoc.oTipoarquivo.idTipoArquivo);
                    $("#descricao","#form-documento").val(retorno.infoDoc.descricao);
                    var tiposArq = ['2','3','4','5','6'];
                    if(tiposArq.indexOf(retorno.infoDoc.oTipoarquivo.idTipoArquivo) !== -1){
                        $("#tipoArquivo","#form-documento").prop("readonly",true);
                        $("#descricao","#form-documento").prop("readonly",true);
                    }else{
                        $("#tipoArquivo","#form-documento").prop("readonly",false);
                        $("#descricao","#form-documento").prop("readonly",false);
                    }

                    if(!retorno.linkArquivo){

                        $("#anexarDocumento").show();
                        $("#listaArquivoDocumento").hide();
                    }else{
                        $("#anexarDocumento").hide();
                        $("#listaArquivoDocumento").show();
                        $("#arquivoDoc").html(retorno.linkArquivo);
                    }



                }
            },
            error: function (retorno) {
            }
        });
    }

}

function carregarDocumento() {
    $("#alertaDocumentoModal").hide();
    $("#alertaDocumento").hide();

    var file_data = $('#arquivoDocumento').prop('files')[0];
    var form_data = new FormData($("#form-documento")[0]);
    var form = document.getElementById("form-documento");
    idArquivoEmpresa = $("#idArquivoEmpresa").val();
    !idArquivoEmpresa ? tipoDados = 'cadastro' : tipoDados = 'edicao';
    form_data.append('arquivoDocumento', file_data);
    if(tipoDados != 'edicao' && !file_data){
        $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#documentoMsgModal").html(msg);
    }else {

           if($("#tipoArquivo","#form-documento").val() != '' && $("#descricao","#form-documento").val() != '' && $("#arquivoDoc","#form-documento").html() != ''){

               $.ajax({
                   url: 'cadArquivoempresa.php?dados='+tipoDados,
                   dataType: 'json',
                   cache: false,
                   contentType: false,
                   processData: false,
                   data: form_data,
                   type: 'post',
                   beforeSend: function () {
                   },
                   success: function (retorno) {
                       $("#arquivoDocumento").filestyle("clear");
                       //console.log(retorno);
                       //return;
                       if(retorno.erro){
                           switch (retorno.erro) {
                               case '1':
                                   $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                   msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                                   $("#documentoMsgModal").html(msg);
                                   break;
                               case '2':
                                   $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                   msg = '<strong>O tipo do arquivo deve ser Bitmap, JPEG, PNG ou PDF.</strong>';
                                   $("#documentoMsgModal").html(msg);
                                   break;
                               case '3':
                                   $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                   msg = '<strong>Selecione o arquivo.</strong>';
                                   $("#documentoMsgModal").html(msg);
                                   break;
                           }
                       }else {
                           if(retorno.infoArquivo) {
                               if (tipoDados == 'edicao') {
                                   $("#modalDocumentos").modal("hide");
                                   $("[data-nome]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html(retorno.linkArquivo);
                                   $("[data-tipo]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html('<strong>'+retorno.infoArquivo.oTipoarquivo.tipo+'</strong>');
                                   $("[data-descricao]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html(retorno.infoArquivo.descricao);
                                   $("#alertaDocumento").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                   msg = '<strong>Documento alterado com sucesso.</strong>';
                                   $("#documentoMsg").html(msg);
                               }
                               if (tipoDados == 'cadastro') {
                                   $("#modalDocumentos").modal("hide");
                                   $("#body-documentos").append(retorno.itemTabela);
                                   $("#alertaDocumento").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                   msg = '<strong>Documento cadastrado com sucesso.</strong>';
                                   $("#documentoMsg").html(msg);
                               }
                           }
                       }





                   }
               });
           }else{
               if(form.reportValidity()) {
                   //console.log(tipoDados);
                   $.ajax({
                       url: 'cadArquivoempresa.php?dados='+tipoDados,
                       dataType: 'json',
                       cache: false,
                       contentType: false,
                       processData: false,
                       data: form_data,
                       type: 'post',
                       beforeSend: function () {

                       },
                       success: function (retorno) {
                           $("#arquivoDocumento").filestyle("clear");
                           //console.log(retorno);
                           //return;
                           if(retorno.erro){
                               switch (retorno.erro) {
                                   case '1':
                                       $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                       msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                                       $("#documentoMsgModal").html(msg);
                                       break;
                                   case '2':
                                       $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                       msg = '<strong>O tipo do arquivo deve ser Bitmap, JPEG, PNG ou PDF.</strong>';
                                       $("#documentoMsgModal").html(msg);
                                       break;
                                   case '3':
                                       $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                       msg = '<strong>Selecione o arquivo.</strong>';
                                       $("#documentoMsgModal").html(msg);
                                       break;
                               }
                           }else {
                               if(retorno.infoArquivo) {
                                   if (tipoDados == 'edicao') {
                                       $("#modalDocumentos").modal("hide");
                                       $("[data-nome]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html(retorno.linkArquivo);
                                       $("[data-tipo]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html('<strong>'+retorno.infoArquivo.oTipoarquivo.tipo+'</strong>');
                                       $("[data-descricao]", "#body-documentos #tr-id" + retorno.idArquivoEmpresa).html(retorno.infoArquivo.descricao);
                                       $("#alertaDocumento").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                       msg = '<strong>Documento cadastrado com sucesso.</strong>';
                                       $("#documentoMsg").html(msg);
                                   }
                                   if (tipoDados == 'cadastro') {
                                       $("#modalDocumentos").modal("hide");
                                       $("#body-documentos").append(retorno.itemTabela);
                                       $("#alertaDocumento").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                       msg = '<strong>Documento cadastrado com sucesso.</strong>';
                                       $("#documentoMsg").html(msg);
                                   }
                               }
                           }
                       }
                   });
               }
           }

    }


}

function removerDocumento(idArquivoEmpresa) {
    //console.log(idArquivoEmpresa);
    $("#arquivoDocumento").filestyle("clear");

    if(idArquivoEmpresa != ''){
        tipoDados = 'excluirSomenteArquivo';
        $.ajax({
            url: 'cadArquivoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idArquivoEmpresa='+idArquivoEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                console.log(retorno);
                //return;
                if(retorno.msg == '1'){
                    document.getElementById("form-documento").reset();
                    $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo excluído com sucesso.</strong>';
                    $("#documentoMsgModal").html(msg);

                }
                if(retorno.msg == '2'){
                    $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo excluído com sucesso.</strong>';
                    $("#documentoMsgModal").html(msg);
                    $("#idArquivoEmpresa","#form-documento").val(retorno.infoDoc.idArquivoEmpresa);
                    $("#idEmpresa","#form-documento").val(retorno.infoDoc.oEmpresa.idEmpresa);
                    $("#tipoArquivo","#form-documento").val(retorno.infoDoc.oTipoarquivo.tipo);
                    $("#idTipoArquivo","#form-documento").val(retorno.infoDoc.oTipoarquivo.idTipoArquivo);
                    $("#descricao","#form-documento").val(retorno.infoDoc.descricao);
                    $("[data-nome]", "#body-documentos #tr-id" + retorno.infoDoc.idArquivoEmpresa).html("");
                    switch (retorno.infoDoc.oTipoarquivo.idTipoArquivo){
                        case "2":
                        case "3":
                        case "4":
                        case "5":
                        case "6":
                            $("#tipoArquivo","#form-documento").prop("readonly",true);
                            $("#descricao","#form-documento").prop("readonly",true);
                            break;
                    }
                    if(retorno.msg == '3'){
                        $("#alertaDocumentoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Problemas de conexão.</strong>';
                        $("#documentoMsgModal").html(msg);

                    }
                    $("#anexarDocumento").show();
                    $("#listaArquivoDocumento").hide();
                }
            },
            error: function (retorno) {
            }
        });
    }

}

function excluirArquivoEmpresa(idArquivoEmpresa) {

    if(idArquivoEmpresa != ''){
        tipoDados = 'excluir';
        confirmacao(null,"Confirma exclusão?",{
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                $.ajax({
                    url: 'cadArquivoempresa.php?dados='+tipoDados,
                    type: 'post',
                    data: 'idArquivoEmpresa='+idArquivoEmpresa,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        //console.log(retorno);
                       // return;
                        if(retorno.msg == '0'){
                        $("#tr-id" + idArquivoEmpresa).remove();
                        $("#alertaDocumento").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Documento removido com sucesso.</strong>';
                        $("#documentoMsg").html(msg);
                        }
                    },
                    error: function (retorno) {
                    }
                });

            }
        })


    }

}



function concluirAtualizacao(idEmpresa,idCampanha) {
    //console.log(idEmpresa)
    if(idEmpresa != ''){
        tipoDados = 'concluir';
        $.ajax({
            url: 'concluirAtualizacao.php?dados='+tipoDados+'&idCampanha='+idCampanha,
            type: 'post',
            data: 'idEmpresa='+idEmpresa,
            dataType: 'json',
            beforeSend: function () {

            },
            success: function (retorno) {
               // console.log(retorno);
                if(retorno.erro) {
                    $("#conclusao").show();
                    $("#pendenciasList").show();
                    if(retorno.tipoErro.acionista != ''){
                        $("#acionista_").show();
                        $("#concMsgAcionista").html("Você deve cadastrar Dados Empresa > Sócio / Acionista Controlador.");
                    }else{
                        $("#acionista_").hide();
                        $("#concMsgAcionista").html('');
                    }
                    if(retorno.tipoErro.contato != '') {
                        $("#contato_").show();
                        $("#concMsgContato").html("Você deve cadastrar no mínimo dois Contatos ( Dados Empresa > Contato).");
                    }else{
                        $("#contato_").hide();
                        $("#concMsgContato").html('');
                    }
                    if( retorno.tipoErro.incentivoEmpresa == '1') {
                        $("#incentivo_").show();
                        $("#concMsgIncentivo").html("Você deve cadastrar Linha de Produção > Produto/Serviço Incentivado ( Linha de Produção > Produto/Serviço).");
                    }else{
                        $("#incentivo_").hide();
                        $("#concMsgIncentivo").html('');
                    }
                    if(retorno.tipoErro.atoDeclaratorio == '1') {
                        $("#AtoDec_").show();
                        $("#concMsgAtoDec").html("Você deve cadastrar o Ato Declaratório no Produto/Serviço Incentivado ( Linha de Produção > Produto/Serviço).");
                    }else{
                        $("#AtoDec_").hide();
                        $("#concMsgAtoDec").html('');
                    }
                    if(retorno.tipoErro.documento != '') {
                        $("#documento_").show();
                        $("#concMsgDocumento").html("Você deve cadastrar os Documentos.");
                    }else{
                        $("#documento_").hide();
                        $("#concMsgDocumento").html('');
                    }
                    if(retorno.tipoErro.origemInsumo != '') {
                        $("#origem_").show();
                        $("#concMsgOrigem").html("Você deve cadastrar Linha de Produção > Origem de Insumos.");
                    }else{
                        $("#origem_").hide();
                        $("#concMsgOrigem").html('');
                    }
                    if(retorno.tipoErro.mercadoConsumidor == '1') {
                        $("#mercado_").show();
                        $("#concMsgMercado").html("Você deve cadastrar Linha de Produção > Mercado Consumidor.");
                    }else{
                        $("#mercado_").hide();
                        $("#concMsgMercado").html('');
                    }
                    if(retorno.tipoErro.projeto != '') {
                        $("#projeto_").show();
                        $("#concMsgProjeto").html("Você deve cadastrar Projetos / Programas.");
                    }else{
                        $("#projeto_").hide();
                        $("#concMsgProjeto").html('');
                    }
                    if(retorno.tipoErro.politica != '') {
                        $("#politica_").show();
                        $("#concMsgPolitica").html("Você deve cadastrar Destinação Sustentável.");
                    }else{
                        $("#politica_").hide();
                        $("#concMsgPolitica").html('');
                    }

                    if(retorno.tipoErro.responsaveis != '') {
                        $("#responsaveis_").show();
                        $("#concMsgResponsaveis").html("Você deve cadastrar Pelo menos 1 responsavel (Dados Empresa > Responsáveis pela Empresa.)");
                    }else{
                        $("#responsaveis_").hide();
                        $("#concMsgResponsaveis").html('');
                    }

                    if(retorno.tipoErro.documento_arquivo_existe != '') {
                        $("#documento_arquivo_existe_").show();
                        $("#concMsgDocumentoArquivoExiste").html("Alguns arquivos não foram carregados corretamente, tente envia-los novamente (Documentos)");
                    }else{
                        $("#documento_arquivo_existe_").hide();
                        $("#concMsgDocumentoArquivoExiste").html('');
                    }

                    if(retorno.tipoErro.responsaveis_enviar != '') {
                        $("#responsaveis_enviar_").show();
                        $("#concMsgResponsaveisEnviar").html("Você deve enviar para avaliação dos responsáveis antes de concluir.");
                    }else{
                        $("#responsaveis_").hide();
                        $("#concMsgResponsaveis").html('');
                    }

                    if(retorno.tipoErro.responsaveis_assinatura != '') {
                        $("#responsaveis_assinatura_").show();
                        $("#concMsgResponsaveisAssinatura").html("O documento ainda não foi assinado por todos os responsáveis.");
                    }else{
                        $("#responsaveis_assinatura_").hide();
                        $("#concMsgResponsaveisAssinatura").html('');
                    }

                }else{
                    if(!retorno.idHistRet){
                        window.location.href = 'empresaCad.php?idCampanha='+retorno.idCampanha;
                    }else{
                        window.location.href = 'empresaCad.php?idHistRet='+retorno.idHistRet;
                    }




                }

            }
        });
    }
    
}


/*getBase64 = function(url_Imagem, callBack) {
    request.get(url_Imagem,
        function (error, response, body) {
            if (error) throw error;

            var imgBase64 = "data:" + response.headers["content-type"] + ";base64," + new Buffer(body).toString('base64');
            callBack(imgBase64);
        });
}

var myImg = 'http://domio.com/imagem.png';

getBase64(myImg, function(imgBase64) {

    faca_algo_com_imagem_na_base64(imgBase64);

});*/

function gerarComprovantePDF(idEmpresa,idCampanha) {

    var docDefinition = {
        pageSize: 'A4',

        // by default we use portrait, you can change it to landscape if you wish
        pageOrientation: 'portrait',

        // [left, top, right, bottom] or [horizontal, vertical] or just a number for equal margins
        pageMargins: [ 40, 60, 40, 60 ],

        content: [
            {
                style: 'tableExample',
                table: {
                    widths: [100, '*'],
                    body: [
                        ['logoSudam', {text:'SUDAM - Superintendência do Desenvolvimento da Amazônia', style: 'tableHeader'}],
                        [{text: 'RECIBO DE ENTREGA DE DADOS DA EMPRESA PARA MONITORAMENTO',  color: 'gray', colSpan: 2, alignment: 'center'}],
                    ]
                },
                layout: 'noBorders'

            }

        ]
    };
    pdfMake.createPdf(docDefinition).open();
}