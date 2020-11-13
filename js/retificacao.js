/**
 * Created by raquel.ohashi on 06/10/2017.
 */

$(document).ready(function(){
    $("#retificacaoSudam").on('hidden.bs.modal',function () {
        $("#formRetificacao").show();
        $("#justificativa").val('');
        $("#alertaMsg").hide();
    })
});
function consultarRetificacoes(status) {
   // console.log(status);
    if(status != '') {
        $.ajax({
            url: 'consultarRetificacoes.php',
            type: 'post',
            data: 'status=' + status,
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {

                //return;
                if (retorno != '1') {
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").hide();
                    $("#legenda").show();
                    $("#resultado").show();
                    $("#resultado").html(retorno);
                } else {
                    $("#legenda").hide();
                    $("#resultado").hide();
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                    msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                    $("#alerta > p").html(msg);
                }

            },
            error: function (retorno) {
                $("#legenda").hide();
                $("#resultado").hide();
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                $("#alerta > p").html(msg);
            }
        });
    }


}

function analisarRet(idRetEmpresa,status) {
    $("#alerta").hide()
    if(status == '1') update = 1; else update=0;
    $.ajax({
        url: 'admRetificacaosudam.php',
        type: 'post',
        data: 'idRetEmpresa=' + idRetEmpresa + '&update='+update,
        dataType: 'json',
        beforeSend: function () {
        },
        timeout: 50000,
        success: function (retorno) {
            if (retorno) {

                $("#retificacaoSudam").modal("show");
                $("#alerta").hide();
                if(update == 1) {
                    $("#alertaMsg").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                    msg = '<strong>A solicitacação está em análise.</strong>';
                    $("#alertaMsg > p").html(msg);
                    $("#tr-id"+idRetEmpresa).remove();
                }
                if (retorno.arquivos != '') {
                    $("#arquivos").show();
                    var arq = new Array();
                    i = 0;
                    retorno.arquivos.forEach(function (t) {
                        arq[i] = ('<li><a href="files/' + t.novoNome + '">' + t.nomeArquivo + '</a></li>');
                        i = i + 1;
                    });

                    $("#arquivos").html(arq);
                } else {
                    $("#arquivos").show();
                    $("#arquivos").html("Não foram anexados arquivos para essa retificação.");

                }
                $("#cnpj").val(retorno.retificacao.oEmpresa.cnpj);
                $("#idRetEmpresa").val(retorno.retificacao.idRetEmpresa);
                $("#razaoSocial").val(retorno.retificacao.oEmpresa.razaoSocial);
                $("#motivo").val(retorno.retificacao.motivo);
                $("#just").val(retorno.retificacao.justificativa);
               // $("#analiseVis").val(retorno.sudam.justificativa);
            }
        },
        error: function (retorno) {
        }
    });
}

function responderRet(idRetEmpresa) {
    $("#alerta").hide()
    $("#retificacaoSudam").modal("show");
}

function visualizarRet(idRetEmpresa) {
    $("#alerta").hide()
    $.ajax({
        url: 'admRetificacaosudam.php',
        type: 'post',
        data: 'idRetEmpresa=' +idRetEmpresa+'&acao=dados',
        dataType: 'json',
        beforeSend: function () {
        },
        timeout: 50000,
        success: function (retorno) {
            if (retorno) {
                $("#visualizarRetificacao").modal("show");
                $("#alerta").hide();
                if(retorno.arquivos !=''){
                    $("#arquivosVis").show();
                    var arq = new Array();
                    i = 0;
                    retorno.arquivos.forEach(function (t) {
                        arq[i] = ('<li><a href="files/'+t.novoNome+'">'+t.nomeArquivo+'</a></li>');
                        i = i+1;
                    });

                   $("#arquivosVis").html(arq);
                }else{
                    $("#arquivosVis").show();
                    $("#arquivosVis").html("Não foram anexados arquivos para essa retificação.");

                }
              $("#cnpjVis").val(retorno.cnpj);
              $("#razaoSocialVis").val(retorno.razaoSocial);
              $("#motivoVis").val(retorno.sudam.oRetificacaoempresa.motivo);
              $("#justificativaVis").val(retorno.sudam.oRetificacaoempresa.justificativa);
              $("#analiseVis").val(retorno.sudam.justificativa);
            }
        },
        error: function (retorno) {

        }
    });

}

function aprovarRet(status) {
    $("#alertaMsg").hide();
    idRetEmpresa = $("#idRetEmpresa").val();
    justificativa = $("#justificativa").val();
    if(status == '2' && justificativa == ''){
        $("#alertaMsg").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();
        msg = '<strong>Informe a Análise.</strong>';
        $("#alertaMsg > p").html(msg);
        //return;
    }else {
        confirmacao(null,"Você tem certeza?",{
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                    $.ajax({
                        url: 'cadRetificacaosudam.php',
                        type: 'post',
                        data: 'just='+justificativa+'&idRetEmpresa='+idRetEmpresa+'&status='+status,
                        dataType: 'json',
                        beforeSend: function () {
                            $("#formRetificacao").hide();
                            $("#carrengandoRetificacao").show();
                        },
                        timeout: 50000,
                        success: function (retorno) {
                           // console.log(retorno);
                            $("#carrengandoRetificacao").hide();
                            if (retorno.msg == '0') {
                                $("#formRetificacao").hide();
                                if(status == '1'){ msg = "Solicitação aprovada com sucesso."; }
                                if(status == '2'){ msg = "Solicitação indeferida com sucesso.";  }
                                $("#alertaMsg").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();
                                mensagem = '<strong>'+msg+'</strong>';
                                $("#alertaMsg > p").html(mensagem);
                                $("#tr-id"+idRetEmpresa).remove();
                            }
                        },
                        error: function (retorno) {
                        }
                    });
                }
        })

        }

}


function addRetificacaoEmpresa(cnpj) {
    if(cnpj){
        $("#arquivoRetEmpresa").filestyle("clear");
        $("#motivo","#form-ret-emp").val("");
        $("#selecioneAnoBase","#form-ret-emp").val("");
        $("#justificativa","#form-ret-emp").val("");
        tipoDados = 'pendencias';
        $("#modalRetificacaoEmpresa").modal("show");
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: '',
            dataType: 'json',
            timeout: 50000,
            beforeSend: function () {
            },
            success: function (retorno) {
               // console.log(retorno);

                switch (retorno.pendencias){
                    case 0:
                        $("#form-ret-emp").show();
                        break;
                    case 1:
                        $("#form-ret-emp").hide();
                        $("#alertaRetEmpresaModal").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();                   mensagem = '<strong>Você possui retificação pendente.</strong>';
                        $("#retEmpresaMsgModal").html(mensagem);
                        break;
                    case 2:
                        $("#form-ret-emp").hide();
                        $("#alertaRetEmpresaModal").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();                   mensagem = '<strong>Você não possui cadastros concluídos para retificar.</strong>';
                        $("#retEmpresaMsgModal").html(mensagem);
                        break;
                    case 3:
                        $("#form-ret-emp").hide();
                        $("#alertaRetEmpresaModal").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();                   mensagem = '<strong>Campanhas que você participou já têm mais de 60 dias finalizadas.</strong>';
                        $("#retEmpresaMsgModal").html(mensagem);
                        break;




                }
               if(retorno.pendencias == '1'){
                   $("#form-ret-emp").hide();
                   $("#alertaRetEmpresaModal").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();                   mensagem = '<strong>Você possui retificação pendente.</strong>';
                   $("#retEmpresaMsgModal").html(mensagem);

               }
                if(retorno.pendencias == '0'){
                    $("#form-ret-emp").show();
                }

            },
            error: function (retorno) {
            }
        });
    }
}

function retornaEmpresa(idEmpresaControle) {
    if(idEmpresaControle){
        tipoDados = 'empresaControle';
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idEmpresaControle='+idEmpresaControle,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                $("#anoBase","#form-ret-emp").val(retorno.anoBase);
                $("#idEmpresa","#form-ret-emp").val(retorno.idEmpresa);
            },
            error: function (retorno) {
            }
        });
    }
}

function editarRetEmp(idRetEmpresa) {
    $("#alertaRetEmpresaModal").hide();
    if(idRetEmpresa != '') {
        $("#modalRetificacaoEmpresa").modal("show");
        tipoDados = 'retificacao';
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idRetEmpresa='+idRetEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.infoRet != ''){
                    $("#motivo","#form-ret-emp").val(retorno.infoRet.motivo);
                    $("#anoBase","#form-ret-emp").val(retorno.infoRet.anoBase);
                    $("#idEmpresa","#form-ret-emp").val(retorno.infoRet.oEmpresa.idEmpresa);
                    $("#idRetEmpresa","#form-ret-emp").val(retorno.infoRet.idRetEmpresa);
                    $("#selecioneAnoBase","#form-ret-emp").val(retorno.idEmpresaControle);
                    $("#justificativa","#form-ret-emp").val(retorno.infoRet.justificativa);
                    if(retorno.listaArquivo != ''){
                        $("#listaArquivoRet","#form-ret-emp").show();
                        $("#arquivoRet").html(retorno.listaArquivo);
                    }else{
                        $("#arquivoRet").html("Não foram anexados arquivos para essa solicitação.");

                    }

                }

            },
            error: function (retorno) {
            }
        });
    }



}

function carregaArquivoRet() {
    $("#alertaRetEmpresaModal").hide();
    idEmpresa = $("#idEmpresa","#form-ret-emp").val();
    var file_data = $('#arquivoRetEmpresa').prop('files')[0];
    var form_data = new FormData($("#form-ret-emp")[0]);
    var form = document.getElementById("form-ret-emp");
    form_data.append('arquivoRetEmpresa', file_data);
    if(!file_data){
        $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#retEmpresaMsgModal").html(msg);
    }else {
        if(form.reportValidity()) {
            $.ajax({
                url: 'cadRetificacaoempresa.php?idEmpresa='+idEmpresa,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                beforeSend: function () {

                },
                success: function (retorno) {
                  //  console.log(retorno);

                    if(retorno.erro != ''){
                        switch (retorno.erro) {
                            case '1':
                                $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>”O tamanho máximo do arquivo é de 30MB.</strong>';
                                $("#retEmpresaMsgModal").html(msg);
                                break;
                            case '2':
                                $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>”O tipo do arquivo deve ser Bitmap, JPEG, PNG ou PDF.</strong>';
                                $("#retEmpresaMsgModal").html(msg);
                                break;
                            case '3':
                                $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>Selecione o arquivo.</strong>';
                                $("#retEmpresaMsgModal").html(msg);
                                break;
                        }
                    }

                    if (retorno.listaArquivo != '') {
                        $("#arquivoRetEmpresa").filestyle("clear");
                        $("#listaArquivoRet").show();
                            $("#arquivoRet").html(retorno.listaArquivo);
                    }


                }
            });
        }
    }
    
}

function cadRetEmpresa() {
    dadosRetEmp = $("#form-ret-emp").serialize();
    var form = document.getElementById("form-ret-emp");
    idRetEmpresa = $("#idRetEmpresa").val();
    (!idRetEmpresa) ? tipoDados = 'cadastro' : tipoDados = 'edicao';

    if(form.reportValidity()) {
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: dadosRetEmp,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
               // console.log(retorno);
                $("#modalRetificacaoEmpresa").modal("hide");
                $("#divRetEmpresa").show()  ;
                if(tipoDados == 'cadastro'){
                    msg = '<strong>Solicitação cadastrada com sucesso.</strong>';
                    $("#body-retificacoes").append(retorno.itemLista);
                }
                if(tipoDados == 'edicao'){
                    if(retorno.erro == '1'){
                        msg = '<strong>Solicitação já está em análise.</strong>';
                    }else{
                        msg = '<strong>Solicitação alterada com sucesso.</strong>';
                       ($("[data-motivo]","#tr-id"+retorno.infoRet.idRetEmpresa).html(retorno.infoRet.motivo));
                        $("[data-anoBase]","#tr-id"+retorno.infoRet.idRetEmpresa).html(retorno.infoRet.anoBase);
                        $("[data-hora]","#tr-id"+retorno.infoRet.idRetEmpresa).html(retorno.infoRet.dataSolicitacao);
                    }


                }
                $("#retEmpresaAlerta").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                $("#retEmpresaMsg").html(msg);

            },
            error: function (retorno) {
            }
        });
    }

}

function visualizarRetEmp(idRetEmpresa) {
    if(idRetEmpresa != '') {
        $("#modalVisualizarRetEmpresa").modal("show");
        tipoDados = 'visualizar';
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idRetEmpresa='+idRetEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.infoRet != ''){
                    $("#motivoVis","#form-ret-emp-vis").val(retorno.infoRet.motivo);
                    $("#anoBaseVis","#form-ret-emp-vis").val(retorno.infoRet.anoBase);
                    $("#justificativaVis","#form-ret-emp-vis").val(retorno.infoRet.justificativa);
                    $("#dataSolicitacaoVis","#form-ret-emp-vis").val(retorno.infoRet.dataSolicitacao);
                    $("#listaArquivoRetVis","#form-ret-emp-vis").show();
                    if(retorno.listaArquivo != ''){
                        $("#arquivoRetVis").html(retorno.listaArquivo);
                    }else{
                        $("#arquivoRetVis").html("Não foram anexados arquivos para essa solicitação.");

                    }
                    if(retorno.infoRetSudam != ''){
                        $("#analiseSudam").show();
                        $("#analiseVis").val(retorno.infoRetSudam.justificativa);
                    }

                }

            },
            error: function (retorno) {
            }
        });
    }

}

function removerRetEmp(idRetEmpresa) {
    //console.log(idRetEmpresa);
    //return;
    $("#retEmpresaAlerta").hide();
    if(idRetEmpresa != ''){
        confirmacao(null,"Confirma exclusão?",{
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = 'excluir';
                $.ajax({
                    url: 'cadRetificacaoempresa.php?dados='+tipoDados,
                    type: 'post',
                    data: 'idRetEmpresa='+idRetEmpresa,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                       // console.log(retorno);
                        if(retorno.msg == '0') {
                            $("#retEmpresaAlerta").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Solicitação excluída com sucesso.</strong>';
                            $("#retEmpresaMsg").html(msg);
                            $("#tr-id"+idRetEmpresa,"#body-retificacoes").remove();
                            $("#arquivoRet").html("");
                            $("#listaArquivoRet").hide();
                        }
                        if(retorno.msg == '1'){
                            $("#retEmpresaAlerta").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>A solicitação já está em análise e não poderá ser excluída.</strong>';
                            $("#retEmpresaMsg").html(msg);
                        }
                    },
                    error: function (retorno) {
                    }
                });
            }
        })

    }

}

function removerArquivoRet(idArquivoEmpresa) {
    if(idArquivoEmpresa!=''){
        tipoDados = 'excluirArquivo';
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idArquivoEmpresa='+idArquivoEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.msg == '0') {
                    $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo excluído com sucesso.</strong>';
                    $("#retEmpresaMsgModal").html(msg);
                    if(!retorno.listaArquivo){
                        $("#listaArquivoRet").hide();
                    }else{
                        $("#listaArquivoRet").show();
                        $("#arquivoRet").html(retorno.listaArquivo);
                    }


                }
            },
            error: function (retorno) {
            }
        });
    }
}


function removerArquivoRetEd(idArqRet) {
    idRetEmpresa = $("#idRetEmpresa").val();
    if(idArqRet!=''){
        tipoDados = 'excluirArquivoRet';
        $.ajax({
            url: 'cadRetificacaoempresa.php?dados='+tipoDados+'&idRetEmpresa='+idRetEmpresa,
            type: 'post',
            data: 'idArqRet='+idArqRet,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
               // console.log(retorno);
                if(retorno.msg == '0') {
                    $("#alertaRetEmpresaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo excluído com sucesso.</strong>';
                    $("#retEmpresaMsgModal").html(msg);
                    if(retorno.listaArquivo == null){
                        $("#listaArquivoRet").hide();
                    }else{
                        $("#listaArquivoRet").show();
                        $("#arquivoRet").html(retorno.listaArquivo);
                    }


                }
            },
            error: function (retorno) {
            }
        });
    }
}

function ajudaRetificacao() {
    $("#ajudaRetificacao").modal("show");
}

