/**
 * Created by raquel.ohashi on 21/08/2017.
 */

$(document).ready(function () {

    $("#dataInicio").on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#dataFim').datepicker('setStartDate', minDate);
    });

    if (window.location.hash.slice(1) == 'ativas') {
        $("input[value='1']").trigger('click')
        $("#pesqSituacao").val('2');
        pesquisaCampanha();
        history.pushState('', document.title, window.location.pathname);

    }
    if (window.location.hash.slice(1) == '15dias') {

        $("input[value='1']").trigger('click')
        $("#pesqSituacao").val('5');
        pesquisaCampanha();
        history.pushState('', document.title, window.location.pathname);

    }

    if (window.location.hash.slice(1) == 'alert1') {
        $("#alertaMsg").show();
        msg = '<strong>Campanha cadastrada com sucesso.</strong>';
        $("#alertaMsg > p").html(msg);
        $('#formBtnIncluirEmpresa').show();
        $('#btnEditarCampanha').show();
        $('#btnSalvarCampanha').hide();
        history.pushState('', document.title, window.location.pathname);
    }
    if (window.location.hash.slice(1) == 'alert2') {
        $("#alertaMsg").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Empresas adicionadas à campanha.</strong>';
        $("#alertaMsg > p").html(msg);
        $("#formBtnEnviarAlerta").show();
        history.pushState('', document.title, window.location.pathname);
    }

    $("#cnpj").keyup(function () {
        if ($("#cnpj").val().length < 3) {
            if ($("#cnpj").val() == '') {
                $("#razaoSocial").attr("readonly", false).val('');
                $("#listaCnpj").hide();
            }

            return;
        }
        $.ajax({
            type: "POST",
            url: "getCnpj.php",
            data: 'cnpj=' + $("#cnpj").val(),
            beforeSend: function () {
            },
            success: function (data) {
                $("#razaoSocial").val('');
                $("#listaCnpj").show();
                $("#listaCnpj").html(data);
                $("#cnpj").css("background", "#FFF");
            }
        });
    });
    $("#razaoSocial").keyup(function () {
        if ($("#razaoSocial").val().length < 3) {
            if ($("#razaoSocial").val() == '') {
                $("#cnpj").attr("readonly", false).val('');
                $("#listaRazao").hide();
            }
            return;
        }
        $.ajax({
            type: "POST",
            url: "getRazaoSocial.php",
            data: 'razaoSocial=' + $("#razaoSocial").val(),
            beforeSend: function () {
            },
            success: function (data) {
                $("#cnpj").val('');
                $("#listaRazao").show();
                $("#listaRazao").html(data);
                $("#razaoSocial").css("background", "#FFF");
            }
        });
    });
});


function selecionaCNPJ(idEmpresa, cnpj, formatCnpj, razaoSocial) {
    $("#idEmpresa").val(idEmpresa);

    if ($("#cnpj").val() == "")
        $("#cnpj").attr("readonly", true);
    $("#cnpj").val(formatCnpj);


    if ($("#razaoSocial").val() == "")
        $("#razaoSocial").attr("readonly", true);
    $("#razaoSocial").val(razaoSocial);


    $("#cnpjEmpresa").val(pad(cnpj, 14));
    $("#listaCnpj").hide();
    $("#listaRazao").hide();
}


function verificaEmpresa() {
    $("#cnpj").attr("readonly", false);
    $("#razaoSocial").attr("readonly", false);

    var razaoSocial = document.getElementById('razaoSocial').value;
    var cnpj = document.getElementById('cnpj').value;
    cnpjNovo = $("#cnpj").val().replace(/[^\d]+/g, '');
    var idEmpresa = $('#idEmpresa').val();

    //console.log(idEmpresa);
    if (idEmpresa != '') {
        if (!document.getElementById('EMP' + cnpjNovo)) {
            consultarEmpresa(idEmpresa);
        } else {
            $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
            erro = '<strong>Empresa já adicionada.</strong>';
            $("#alerta > p").html(erro)
            //alert("Empresa já adicionada!");
        }

    } else {
        if ((!razaoSocial) && (!cnpj)) {
            $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
            erro = '<strong>Digite o CNPJ ou Razão Social.</strong>';
            $("#alerta > p").html(erro);
            //$('#resultado').hide();
            //$('#legenda').hide();

        }
        if ((razaoSocial) && (idEmpresa == '')) {
            $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
            erro = '<strong>Razão Social não cadastrada no sistema.</strong>';
            $("#alerta > p").html(erro);

        }

        if (cnpj) {
            $("#razaoSocial").val('');
            $("#cnpj").val('');
            if (!validarCNPJ(cnpj)) {
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
                erro = '<strong>CNPJ Inválido!</strong>';
                $("#alerta > p").html(erro);
            } else {
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
                erro = '<strong>CNPJ ou Razão Social não cadastrado(a) no sistema!</strong>';
                $("#alerta > p").html(erro);
            }
        }

    }

}

function consultarEmpresa(idEmpresa) {
    $.ajax({
        type: "POST",
        url: "getEmpresas.php",
        data: 'idEmpresa=' + idEmpresa,
        beforeSend: function () {
        },
        success: function (data) {
            if (data == '1') {
                $(".alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
                erro = '<strong>Não foram encontrados registros para essa consulta.</strong>';
                $(".alert > p").html(erro);
                $("#razaoSocial").val('');
                $("#cnpj").val('');
            }
            else {
                $("#alerta").hide();
                $("#divlistaEmpresas").show();
                $("#listaEmpresas").show();
                $("#listaEmpresas").append(data);
                $("#cnpjEmpresa").val('');
                $("#razaoSocial").val('');
                $("#cnpj").val('');
                $("#idEmpresa").val('');

            }
        },
        error: function (data) {
            $(".alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
            erro = '<strong>Não foram encontrados registros para essa consulta.</strong>';
            $(".alert > p").html(erro);
            $("#razaoSocial").val('');
            $("#cnpj").val('');


        }
    });
}

function adicionaEmpresa(cnpj) {
    $("#alertaMsg").hide();
    $.ajax({
        type: "POST",
        url: "getHistoricoEmpresa.php",
        data: 'cnpj=' + cnpj,
        beforeSend: function () {
        },
        success: function (data) {
            if (data) {
                $("#listaEmpresas").append(data);
                $("#cnpjEmpresa").val('');
                $("#razaoSocial").val('');
                $("#cnpj").val('');
                $("#idEmpresa").val('');
            }
            else {
                $(".alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
                erro = '<strong>Não foram encontrados registros para essa consulta.</strong>';
                $(".alert > p").html(erro);
                $("#razaoSocial").val('');
                $("#cnpj").val('');
            }
        },
        error: function (data) {
            $(".alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
            erro = '<strong>Não foram encontrados registros para essa consulta.</strong>';
            $(".alert > p").html(erro);
            $("#razaoSocial").val('');
            $("#cnpj").val('');
        }
    });

}

function pad(str, length) {
    const resto = length - String(str).length;
    return '0'.repeat(resto > 0 ? resto : '0') + str;
}

function validarCNPJ(cnpj) {
    // console.log(cnpj);
    cnpj = cnpj.replace(/[^\d]+/g, '');

    if (cnpj == '') {
        alert("Digite um CNPJ ou Razão Social para consultar");
    }
    ;


    // Elimina CNPJs invalidos conhecidos
    if (cnpj == "00000000000000" ||
        cnpj == "11111111111111" ||
        cnpj == "22222222222222" ||
        cnpj == "33333333333333" ||
        cnpj == "44444444444444" ||
        cnpj == "55555555555555" ||
        cnpj == "66666666666666" ||
        cnpj == "77777777777777" ||
        cnpj == "88888888888888" ||
        cnpj == "99999999999999")
        return false;

    // Valida DVs
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0, tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0))
        return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1))
        return false;

    return true;
}


function removeEmpCamp(idEmpCamp) {
    // console.log(idEmpCamp);
    idCampanha = $("#idCampanha").val();
    $.ajax({
        type: "POST",
        dataType: "json",
        url: "getEmpresas.php",
        data: 'idEmpresaCampanha=' + idEmpCamp + '&acao=del&idCampanha=' + idCampanha,
        beforeSend: function () {
        },
        success: function (data) {
            //  console.log(data);
            // return;
            if (data.data == '1') {
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();
                erro = '<strong>Empresa não pode ser removida, pois a campanha está ativa ou encerrada.</strong>';
                $("#alerta > p").html(erro);
                $("#razaoSocial").val('');
                $("#cnpj").val('');

            } else {
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();
                erro = '<strong>Empresa removida.</strong>';
                $("#alerta > p").html(erro);
                $("#razaoSocial").val('');
                $("#cnpj").val('');
                $("#tr-id" + idEmpCamp).remove();
                $("#totalEmpresas").val(data.total);
                $("#totEmpresas").html(data.total);
            }
        }
    });
}

(function ($) {
    remove = function (item) {
        var tr = $(item).closest('tr');
        tr.fadeOut(400, function () {
            tr.remove();
            $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-info").show();
            erro = '<strong>Empresa removida.</strong>';
            $("#alerta > p").html(erro);
        });
        return false;
    }
})(jQuery);

function goBack() {
    window.history.back();
}

function adicionarTodasEmpresas() {
    todas = $("#todas").is(":checked");
    if (todas) {
        $.ajax({
            type: "POST",
            url: "getEmpresas.php",
            data: 'acao=todas',
            beforeSend: function () {
            },
            success: function (data) {
                if (data != '0') {
                    $("#alerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Foram adicionadas todas as empresas (' + data + ') para essa campanha. Clique em no botão "Concluir" para confirmar.</strong>';
                    $("#alerta > p").html(msg);
                    $("#divlistaEmpresas").show();
                    $("#todasEmpresas").val('1');
                    $("#listaEmpresas").hide();
                    $("#div-add-empresa").hide();

                }
                // $("#divlistaEmpresas").show();
                //$("#listaEmpresas").html(data);
            }
        });
    } else {
        $("#alerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Todas as empresas foram removidas. Clique em no botão "Concluir" para confirmar. </strong>';
        $("#alerta > p").html(msg);
        $("#divlistaEmpresas").show();
        $("#listaEmpresas").hide();
        $("#div-add-empresa").show();


    }
}

function limpaAdicionarEmpresas() {
    var idCampanha = $("#idCampanha").val();
    dados = $("#tabelaEmpCampanha").serialize();
    if (dados.length == '') {
        $("#razaoSocial").val('');
        $("#cnpj").val('');
        $("#todas").prop('checked', false);
        $(".alert").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").hide();
        $("#divlistaEmpresas").show();
        $("#listaEmpresas").show();
        window.location = "cadCampanha.php?idCampanha=" + idCampanha;
    }

}


function concluirEmpresa() {
    var todas = $("#todas").is(":checked");
    var idCampanha = $("#idCampanha").val();
    var emp = todas ? "todas" : "selecionadas";
    var todasEmpresas = $("#todasEmpresas").val();
    dados = emp == "selecionadas" ? $("tbody tr:not('.busca') input").serialize() : $("#tabelaEmpCampanha").serialize();
    if (todasEmpresas == '1') {
        dados = '';
    }
    var configAjax = {
        type: "POST",
        url: "getEmpresas.php?acao=concluir&empresa=" + emp + "&idCampanha=" + idCampanha + "&todasEmpresas=" + todasEmpresas,
        dataType: 'json',
        timeout: 50000,
        beforeSend: function () {
        },
        success: function (retorno) {
            //console.log(retorno);
            if (retorno.totalEmpresas != '0') {
                $("#addEmpresa").modal("hide");
                $("#alertaMsg").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>Empresas adicionadas à campanha.</strong>';
                $("#alertaMsg > p").html(msg);
                $("#totalEmpresas").val(retorno.totalEmpresas);
                $("#totEmpresas").html(retorno.totalEmpresas);
                $("#todasEmpresas").val(retorno.todasEmpresas);
                $("#formBtnEnviarAlerta").show();
                //window.location = "cadCampanha.php?123&idCampanha="+idCampanha+"#alert2";
            } else {
                msg = '<strong>Empresas foram removidas da campanha.</strong>';
                $("#addEmpresa").modal("hide");
                $("#totalEmpresas").val(retorno.totalEmpresas);
                $("#totEmpresas").html(retorno.totalEmpresas);
                $("#todasEmpresas").val(retorno.todasEmpresas);
                $("#formBtnEnviarAlerta").hide();
                $("#alertaMsg").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-danger").show();
                $("#alertaMsg > p").html(msg);
            }
        }
    }

    if (todas == false && $("#todasEmpresas").val() != 1 && dados == '') {
        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-danger").show();
        erro = '<strong>Adicione pelo menos uma empresa para concluir.</strong>';
        $("#alerta > p").html(erro);
    } else {

        configAjax.data = dados;
        $.ajax(configAjax);
    }

}

function salvarCampanha() {


    var form = document.getElementById('formCadCampanha');
    if (form.reportValidity()) {
        tipoDados = 'cadastro';
        dados = $("#formCadCampanha").serialize();
        //console.log(dados);
        //return;
        $.ajax({
            url: 'cadCampanha.php?dados=' + tipoDados,
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {
                //$('#btnCadastrar').button('loading');
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                //$('#btnCadastrar').button('reset');
                window.location = "cadCampanha.php?idCampanha=" + retorno.id + "#alert1";

            },
            error: function (retorno) {

            }
        });

    }
}


function editarCampanha() {

    var form = document.getElementById('formCadCampanha');
    if (form.reportValidity()) {
        dados = $("#formCadCampanha").serialize();

        $.ajax({
            url: 'editCampanha.php',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {
                //$('#btnCadastrar').button('loading');
            },
            timeout: 50000,
            success: function (retorno) {


                if (!retorno.msg) {
                    $("#alertaMsg").show();
                    msg = '<strong>Alteração realizada com sucesso.</strong>';
                    $("#alertaMsg > p").html(msg);
                    $('#formBtnIncluirEmpresa').show();
                    $('#btnEditarCampanha').show();
                    $('#btnSalvarCampanha').hide();

                }

            },
            error: function (retorno) {

            }
        });

    }
}


function alterarCampanha() {

    var form = document.getElementById('formCadCampanha');
    if (form.reportValidity()) {
        dados = $("#formEditCampanha").serialize();
        //console.log(dados);
        //return;
        $.ajax({
            url: 'editCampanha.php',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {
                //$('#btnCadastrar').button('loading');
            },
            timeout: 50000,
            success: function (retorno) {
                console.log(retorno);
                if (retorno) {
                    if (retorno.dadosCampanha.situacao == '3' || (retorno.dadosCampanha.situacao == '4')) {
                        $("#div-inativar").hide();
                        $("#alertaMsg").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Campanha inativada com sucesso.</strong>';
                        $("#alertaMsg > p").html(msg);
                        $('#formBtnIncluirEmpresa').hide();
                        $('#btnEditarCampanha').hide();
                        $('#btnSalvarCampanha').hide();
                        $('#btnEnviarAlerta').hide();
                        $('#campanha').val(retorno.dadosCampanha.campanha).attr("disabled", true);
                        $('#anoBase').val(retorno.dadosCampanha.anoBase).attr("disabled", true);
                        $('#dataInicio').val(retorno.dataInicio).attr("disabled", true);
                        $('#dataFim').val(retorno.dataFim).attr("disabled", true);
                        $('#situacaoAtual').val(retorno.dadosCampanha.situacao).attr("disabled", true);
                    } else {
                        $("#alertaMsg").show();
                        msg = '<strong>Alteração realizada com sucesso.</strong>';
                        $("#alertaMsg > p").html(msg);
                        $('#formBtnIncluirEmpresa').show();
                        $('#btnEditarCampanha').show();

                        $('#campanha').val(retorno.dadosCampanha.campanha);
                        $('#anoBase').val(retorno.dadosCampanha.anoBase);
                        $('#dataInicio').val(retorno.dataInicio);
                        $('#dataFim').val(retorno.dataFim);
                        $('#situacaoAtual').val(retorno.dadosCampanha.situacao);
                        if (retorno.dadosCampanha.totalEmpresas) {
                            $("#formBtnEnviarAlerta").show();
                        }
                    }


                }

            },
            error: function (retorno) {

            }
        });

    }
}


function editarCampanhaConsulta() {

    var form = document.getElementById('formCadCampanha');
    if (form.reportValidity()) {
        dados = $("#formCadCampanha").serialize();

        dadosEdicao = {};

        $.map($("#formCadCampanha").serializeArray(), function (ob, v) {
            dadosEdicao[ob.name] = ob.value;
        })

        $.ajax({
            url: 'editCampanha.php',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {
                //$('#btnCadastrar').button('loading');
            },
            timeout: 50000,
            success: function (retorno) {
                if (!retorno.msg) {
                    $("#alertaMsg").show();
                    msg = '<strong>Alteração realizada com sucesso.</strong>';
                    $("#alertaMsg > p").html(msg);
                    $('#formBtnIncluirEmpresa').show();
                    $('#btnEditarCampanha').show();
                    $('#btnSalvarCampanha').hide();

                    sit = dadosEdicao.situacao;
                    switch (sit) {
                        case '1':
                            descSit = 'Pré-Ativa';
                            break;
                        case '2':
                            descSit = 'Ativa';
                            break;
                        case '3':
                            descSit = 'Inativa';
                            break;
                        case '4':
                            descSit = 'Encerrada';
                            break;
                    }
                    $("[data-nome-campanha]", "#tr-id" + dadosEdicao.idCampanha).html(dadosEdicao.campanha);
                    $("[data-inicial]", "#tr-id" + dadosEdicao.idCampanha).html(dadosEdicao.dataInicio);
                    $("[data-final]", "#tr-id" + dadosEdicao.idCampanha).html(dadosEdicao.dataFim);
                    $("[data-ano-base]", "#tr-id" + dadosEdicao.idCampanha).html(dadosEdicao.anoBase);
                    $("[data-link-total] span", "#tr-id" + dadosEdicao.idCampanha).html(dadosEdicao.totalEmpresas == '' ? '0' : dadosEdicao.totalEmpresas);
                    $("[data-situacao]", "#tr-id" + dadosEdicao.idCampanha).html(descSit);

                }

            },
            error: function (retorno) {

            }
        });

    }
}

function cancelaCampanha(e) {
    //e.preventDefault();
    // var form = document.getElementById('formCadCampanha');
    // if(form.reportValidity() == '') {
    $('#modalResposta').find('.modal-body').html('<img src="img/erro.gif" /> Os dados não serão salvos.');
    $('#modalResposta').modal('show');
    $('#modalResposta').on('hide.bs.modal', function () {
        window.location = 'empresa';
    });
    //}
}

function incluirEmpresa(idCampanha) { //abre o modal
    $("#alertaMsg").hide();
    $('#addEmpresa').modal('show');
    $("#cnpj").prop("readonly", false);
    $("#cnpj").val('');
    $("#razaoSocial").val('');
    checaTodasEmpresas = $("#todasEmpresas").val();

    if (idCampanha != '') {
        if (checaTodasEmpresas == '1') {
            $("#todas").prop("checked", true);
            $("#div-add-empresa").hide();
            $("#listaEmpresas").hide();
            $("#alerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>Todas as empresas foram incluídas para essa campanha.</strong>';
            $("#alerta > p").html(msg);
        } else {
            $("#todas").prop("checked", false);
            tipoDados = 'checarEmpresas';
            $.ajax({
                url: 'cadCampanha.php?dados=' + tipoDados,
                type: 'post',
                data: 'idCampanha=' + idCampanha,
                dataType: 'json',
                beforeSend: function () {

                },
                timeout: 50000,
                success: function (retorno) {
                    $("#alerta").hide();
                    if (retorno.itensTabela != '') {
                        $("#div-add-empresa").show();
                        $("#divlistaEmpresas").show();
                        $("#listaEmpresas").show();
                        $("#empresasCampanha").html(retorno.itensTabela);
                    }

                },
                error: function (retorno) {

                }
            });
        }
    }


    //limpaAdicionarEmpresas();
}

function adicionaEmpresa() {
    var idCampanha = $('#idCampanha').val();
    //console.log(idCampanha);
}


function exibirEnvioAlerta() { //abre o modal
    $('#enviarAlerta').modal('show');
}

function salvarAlerta() {

    $("#texto").val(CKEDITOR.instances["texto"].getData());

    var form = document.getElementById('formEnviarAlerta');

    if (form.reportValidity()) {
        dados = $("#formEnviarAlerta").serialize();
        //console.log(dados);
        $.ajax({
            url: 'cadAlerta.php?situacao=1',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {

            },
            timeout: 50000,
            success: function (retorno) {
                if (retorno.id) {
                    $("#alertaMsgAlerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Rascunho salvo com sucesso.</strong>';
                    $("#alertaMsgAlerta > p").html(msg);
                    //window.location = "cadCampanha.php?idCampanha="+retorno.idCampanha;
                }

            },
            error: function (retorno) {

            }
        });
    }
}

function limparAlerta() {
    //$("#enviarAlerta").modal("close");
    $("#assunto").val('');
    $("#texto").val('');
    $("#alertaMsgAlerta").hide();
    window.location.reload();
}

function enviarAlertaCampanha() {
    $("#texto").val(CKEDITOR.instances["texto"].getData());


    $("#alertaMsgAlerta").hide();

    var todas = $("#tipoSelecao").val();

    var form = document.getElementById('formEnviarAlerta');

    if (form.reportValidity()) {

        dados = $("#formEnviarAlerta").serialize();

        $.ajax({
            url: 'enviarAlerta.php?tipoSelecao=' + todas,
            type: 'post',
            data: dados,
            beforeSend: function () {
                $('#divEnviarAlerta').hide();
                $('#carregando').show();
            },
            timeout: 50000,
            success: function (retorno) {
                $('#carregando').hide();
                if (retorno == '0') {
                    $("#alertaMsgAlerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();

                    msg = '<strong>Envio de Alerta realizado com sucesso.</strong>';

                    $("#alertaMsgAlerta > p").html(msg);

                    $('#enviarAlerta').on('hide.bs.modal', function () {
                        window.location = 'cadCampanha';
                    });
                } else {
                    $("#alertaMsgAlerta").removeClass("alert-danger").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-warning").show();
                    msg = '<strong>Não foi possível enviar alertas.</strong>';
                    $("#alertaMsgAlerta > p").html(msg);
                }

            },
            error: function (retorno) {

            }
        });

    }
}

function editarRascunhoAlerta() {

    $("#texto").val(CKEDITOR.instances["texto"].getData());

    var form = document.getElementById('formEnviarAlerta');

    if (form.reportValidity()) {
        dados = $("#formEnviarAlerta").serialize();
        // console.log(dados);
        // return;
        $.ajax({
            url: 'editAlerta.php',
            type: 'post',
            data: dados,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                if (!retorno.msg) {
                    $("#alertaMsgAlerta").show();
                    msg = '<strong>Alteração realizada com sucesso.</strong>';
                    $("#alertaMsgAlerta > p").html(msg);
                }

            },
            error: function (retorno) {

            }
        });
    }
}

function emConstrucaoAlerta() {
    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
    erro = '<strong>Em construção.</strong>';
    $("#alerta > p").html(erro);
    //$('#resultado').hide();
}

function exibirTipoPesquisa(tipo) {
    if (tipo == '1') {
        $("#pesqCnpj").hide();
        $("#pesqCampanha").show();
        $("#empresa").val('');
        $("#situacaoCadastro").val('');
        $("#resultado").hide();
    }
    if (tipo == '2') {
        $("#pesqCampanha").hide();
        $("#pesqCnpj").show();
        $("#nomeCampanha").val('');
        $("#pesqAnoBase").val('');
        $("#pesqSituacao").val('');
        $("#resultado").hide();
    }
}

function pesquisaCampanhaCnpj() {
    // tipoPesquisa = $("#opcPesquisa").val();
    tipoPesquisa = $('input[name=opcPesquisa]:checked', '#form-cons-campanha').val();
    empresa = $('#empresa').val();
    situacaoCadastro = $('#situacaoCadastro').val();

    if (!situacaoCadastro && !empresa) {
        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
        erro = '<strong>Informe pelo menos um campo para realizar a pesquisa.</strong>';
        $("#alerta > p").html(erro);
        //$('#resultado').hide();
    } else {
        $.ajax({
            url: 'pesquisarCampanha.php',
            type: 'post',
            data: 'tipoPesquisa=' + tipoPesquisa + '&empresa=' + empresa + '&status=' + situacaoCadastro,
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                if (retorno == '0') {
                    $("#resultado").hide();
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                    msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                    $("#alerta > p").html(msg);
                } else {
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").hide();
                    $("#resultado").show();
                    $("#resultado").html(retorno);
                }

            },
            error: function (retorno) {

            }
        });
    }

}

function pesquisaCampanha() {
    campanha = $("#nomeCampanha").val();
    anoBase = $("#pesqAnoBase").val();
    situacao = $("#pesqSituacao").val();
    tipoPesquisa = $("#opcPesquisa").val();
    if (!campanha && !anoBase && !situacao) {
        $("#resultado").hide();
        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
        erro = '<strong>Informe pelo menos um campo para realizar a pesquisa.</strong>';
        $("#alerta > p").html(erro);
        //$('#resultado').hide();
    } else {
        $.ajax({
            url: 'pesquisarCampanha.php',
            type: 'post',
            data: 'tipoPesquisa=' + tipoPesquisa + '&campanha=' + campanha + '&situacao=' + situacao + '&anoBase=' + anoBase,
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                if (retorno == '0') {
                    $("#resultado").hide();
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                    msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                    $("#alerta > p").html(msg);
                } else {
                    $("#alerta").hide();
                    $("#resultado").show();
                    $("#resultado").html(retorno);
                }

            },
            error: function (retorno) {
                $("#resultado").hide();
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                $("#alerta > p").html(msg);
            }
        });
    }

}

function editCampanha(idCampanha) {
    if (idCampanha) {
        $("#alertaMsg").hide();
        $.ajax({
            url: 'admCampanha.php',
            type: 'post',
            data: 'idCampanha=' + idCampanha + '&acao=dados',
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //  console.log(retorno);
                //return;
                if (retorno) {
                    $("#editarCampanha").modal('show');
                    $("#campanha").val(retorno.campanha);
                    $("#anoBase").val(retorno.anoBase);
                    $("#dataInicio").val(retorno.dataInicio);
                    $("#dataFim").val(retorno.dataFim);
                    $("#idCampanha").val(retorno.idCampanha);
                    $("#totalEmpresas").val(retorno.totalEmpresas);
                    $("#totalDeEmpresas").html(retorno.totalEmpresas);
                    $("#situacao").val(retorno.situacao);
                    $("#atualSituacao").val(retorno.situacao);
                    if (retorno.situacao == '1') {
                        $("#div-inativar").hide();
                    } else {
                        $("#div-inativar").show();
                    }
                } else {
                }

            },
            error: function (retorno) {
                $("#resultado").hide();
                $("#alertaMsg").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                $("#alertaMsg > p").html(msg);
            }
        });
    }

}

function visualizarCampanha(idCampanha) {
    if (idCampanha) {
        $("#alertaMsg").hide();
        $.ajax({
            url: 'admCampanha.php',
            type: 'post',
            data: 'idCampanha=' + idCampanha + '&acao=dados',
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                //return;
                if (retorno) {
                    $("#visualizarCampanha").modal('show');
                    $("#campanhaVis").val(retorno.campanha);
                    $("#anoBaseVis").val(retorno.anoBase);
                    $("#dataInicioVis").val(retorno.dataInicio);
                    $("#dataFimVis").val(retorno.dataFim);
                    $("#idCampanha").val(retorno.idCampanha);
                    $("#totalDeEmpresasVis").html(retorno.totalEmpresas);
                    $("#atualSituacaoVis").val(retorno.situacao);
                } else {

                    //$("")

                }

            },
            error: function (retorno) {
                $("#resultado").hide();
                $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                $("#alerta > p").html(msg);
            }
        });
    }

}

function visualizarEmpresas(idCampanha, tipo) {

    $("#visualizaEmpresas .alert").hide();

    if (idCampanha != '') {
        $.ajax({
            url: 'pesquisarCampanha.php',
            type: 'post',
            data: 'idCampanha=' + idCampanha + '&tipo=' + tipo,
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {

                //return;
                if (retorno != '0') {

                    $("#pesquisaEmpresa").val("");

                    $("#visualizaEmpresas").modal('show');


                    switch (tipo){
                        case 1: var title = "Empresas na campanha"; break;
                        case 2: var title = "Empresas para cujas mensagens foram enviadas e concluiram a atualização"; break;
                        case 3: var title = "Empresas para cujas mensagens foram enviadas e não concluiram a atualização"; break;
                        case 4: var title = "Empresas para cujas mensagens foram enviadas e iniciaram atualização"; break;
                        case 5: var title = "Empresas para cujas mensagens foram enviadas mas não iniciaram atualização"; break;
                        case 6: var title = "Empresas para cujas mensagens foram enviadas"; break;
                    }

                    $("#visualizaEmpresas .modal-title").html(title);
                    $("#listaEmpresas").html(retorno);
                } else {
                    $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-info").addClass("alert-warning").show();
                    msg = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                    $("#alerta > p").html(msg);
                }

            },
            error: function (retorno) {

            }
        });
    }


}


function visualizarEmpresasEdit(idCampanha, tipo) {
    //console.log(idCampanha);
    //console.log(tipo);

    if (idCampanha != '') {
        $.ajax({
            url: 'pesquisarCampanha.php',
            type: 'post',
            data: 'idCampanha=' + idCampanha + '&tipo=' + tipo,
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);

                //return;
                if (retorno != '0') {
                    $("#visualizaEmpresasEdit").modal('show');
                    $("#visualizaEmpresasEdit .modal-title").html('Lista de Empresas');
                    $("#listaEmpresasEdit").html(retorno);
                } else {

                }

            },
            error: function (retorno) {

            }
        });
    }


}


function excluirCampanha(idCampanha) {

    if (idCampanha != '') {

        confirmacao(null, "Confirma a exclusão?", {
            confirmar_txt: "Ok",
            cancelar_txt: "Cancelar",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                $.ajax({
                    url: 'admCampanha.php',
                    type: 'post',
                    data: 'idCampanha=' + idCampanha + '&acao=excluir',
                    beforeSend: function () {
                    },
                    timeout: 50000,
                    success: function (retorno) {
                        //return;
                        if (retorno == '0') {
                            $("#tr-id" + idCampanha).remove();
                            $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-success").addClass("alert-warning").show();
                            msg = '<strong>Campanha removida com sucesso.</strong>';
                            $("#alerta > p").html(msg);
                        } else {

                        }

                    },
                    error: function (retorno) {

                    }
                });
            }

        })
    }
}

function visualizarAlerta(idCampanha) {
    if (idCampanha) {

        $.ajax({
            url: 'pesquisarCampanha.php',
            type: 'post',
            data: 'idCampanha=' + idCampanha + '&dados=alerta',
            // dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                $("#visualizarAlertas").modal('show');
                $("#listaAlerta").html(retorno);
                //return;


            },
            error: function (retorno) {

            }
        });
    }

}

function dadosEmpresa(cnpj, idCampanha, status) {
    if (status != 3) {
        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-success").addClass("alert-warning").show();
        msg = '<strong>Empresa com cadastro pendente ou iniciado.</strong>';
        $("#alerta > p").html(msg);
    } else {
        if (cnpj && idCampanha) {

            $.ajax({
                url: 'pesquisarCampanha.php',
                type: 'post',
                data: 'idCampanha=' + idCampanha + '&dados=empresa&cnpj=' + cnpj,
                // dataType: 'json',
                beforeSend: function () {
                },
                timeout: 50000,
                success: function (retorno) {
                    //console.log(retorno);
                    if (!retorno) {
                        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Em construção.</strong>';
                        $("#alerta > p").html(msg);
                    } else {
                        $("#alerta").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Em construção.</strong>';
                        $("#alerta > p").html(msg);
                    }


                    //return;


                },
                error: function (retorno) {

                }
            });
        }
    }
}