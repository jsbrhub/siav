$(document).ready(function () {

});//document ready

$(function () {
    $('#file_upload').uploadifive({
        'auto': false,
        'buttonText': 'Selecionar',
        'buttonClass': 'btn btn-primary btn-sm',
        //'uploadLimit'  : 1,
        'removeCompleted': true,
        'multi': false,
        'queueID': 'queue',
        'uploadScript': 'cadIncentivoempresa.php',
        'onUploadComplete': function (file, data) {
            // console.log(data);
        }
    });
});

function addProdIncentivado(idIncentivoEmpresa) {
    $("#modalProdutoIncentivado").modal("show");
    $("#atoDeclaratorio").filestyle("clear");
    tipoDados = "produto";
    if (idIncentivoEmpresa != '0') {
        $.ajax({
            url: 'cadIncentivoempresa.php?dados=' + tipoDados,
            type: 'post',
            data: 'idIncentivoEmpresa=' + idIncentivoEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                // console.log(retorno);
                if (retorno.infoProduto != '') {
                    $("#idIncentivoEmpresa", "#form-produto").val(retorno.infoProduto.idIncentivoEmpresa);
                    $("#idEmpresa", "#form-produto").val(retorno.infoProduto.oEmpresa.idEmpresa);
                    $("#idIncentivo", "#form-produto").val(retorno.infoProduto.oIncentivos.idIncentivo);
                    $("#idModalidade", "#form-produto").val(retorno.infoProduto.oModalidade.idModalidade);
                    $("#vigente", "#form-produto").val(retorno.infoProduto.vigente);
                    $("#cnpj", "#form-produto").val(retorno.infoProduto.cnpj);
                    $("#produtoIncent", "#form-produto").val(retorno.infoProduto.produtoIncentivado);
                    $("#produtoIncentivado", "#form-produto").val(retorno.infoProduto.produtoIncentivado);
                    $("#capacidadeInstalada", "#form-produto").val(retorno.infoProduto.capacidadeInstalada);
                    if (retorno.infoProduto.idUnidadeCapacidade == '' || retorno.infoProduto.idUnidadeCapacidade == '0') {
                        $("#idUnidadeCapacidade", "#form-produto").val("");
                    } else {
                        $("#idUnidadeCapacidade", "#form-produto").val(retorno.infoProduto.idUnidadeCapacidade);
                    }

                    $("#producao", "#form-produto").val(retorno.infoProduto.producao);
                    if (retorno.infoProduto.idUnidadeProducao == '' || retorno.infoProduto.idUnidadeProducao == '0') {
                        $("#idUnidadeProducao", "#form-produto").val("");
                    } else {
                        $("#idUnidadeProducao", "#form-produto").val(retorno.infoProduto.idUnidadeProducao);
                    }

                    $("#faturamento", "#form-produto").val(retorno.infoProduto.faturamento);
                    $("#emprego", "#form-produto").val(retorno.infoProduto.emprego);
                    $("#cnae", "#form-produto").val(retorno.infoProduto.cnae);
                    $("#anoInicial", "#form-produto").val(retorno.infoProduto.anoInicial);
                    $("#anoFinal", "#form-produto").val(retorno.infoProduto.anoFinal);
                    $("#produtoObservacao", "#form-produto").val(retorno.infoProduto.observacao);
                    if (!retorno.atoDec) {
                        $("#anexarAto").show();
                        $("#listaAto").hide();
                        //$("#arquivoAto").html(retorno.listaAto);
                    } else {
                        $("#idAtoDeclaratorio").val(retorno.idAtoDeclaratorio);
                        $("#anexarAto").hide();
                        $("#listaAto").show();
                        $("#arquivoAto").html(retorno.atoDec)
                    }


                }
            },
            error: function (retorno) {
            }
        });
    }
}

function cadProdIncentivado() {
    idIncentivoEmpresa = $("#idIncentivoEmpresa").val();
    dadosIncentivo = $("#form-produto").serialize();
    //console.log(dadosIncentivo);
    var form = document.getElementById('form-produto');
    if (idIncentivoEmpresa == '') {
        tipoDados = "cadastro";
    } else {
        tipoDados = "edicao";
    }
    if (form.reportValidity()) {
        idUnidadeCap = $("#idUnidadeCapacidade").val();
        idUnidadeProd = $("#idUnidadeProducao").val();
        if (idUnidadeCap == '1') {
            unidadeCap = $("#unidadeCap").val();
            if (!unidadeCap) {
                alert("cadastro");
            }
        }
        if (idUnidadeProd == '1') {
            unidadeProd = $("#unidadeProd").val();
            if (!unidadeProd) {
                alert("cadastro2");
            }
        }

        $.ajax({
            url: 'cadIncentivoempresa.php?dados=' + tipoDados,
            type: 'post',
            data: dadosIncentivo,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                if (retorno.infoProduto != '') {
                    if (tipoDados == 'edicao') {

                        $("[data-cri]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.infoProduto.capacidadeInstalada);
                        $("[data-unid-cri]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.unidCap);
                        $("[data-producao]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.infoProduto.producao);
                        $("[data-unid-prod]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.unidProd);
                        $("[data-faturamento]", "#incentivosEmpresa #tr-" + retorno.id).html("R$ " + retorno.infoProduto.faturamento);
                        $("[data-emp-direto]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.infoProduto.emprego);
                        $("[data-cnae]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.infoProduto.cnae);
                        $("[data-ato-dec]", "#incentivosEmpresa #tr-" + retorno.id).html(retorno.atoDec);
                        if (!retorno.atoDec) {
                            $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Favor, anexar o Ato Declaratório.</strong>';
                            $("#produtoMsgModal").html(msg);
                        } else {
                            $("#modalProdutoIncentivado").modal("hide");
                            $("#alertaContato").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Produto/Serviço alterado com sucesso.</strong>';
                            $("#contatoMsg").html(msg);
                        }


                    }
                }

            },
            error: function (retorno) {

            }
        });
    }

}

function addUnidadeCap(val) {
    if (val == '1') { //seleciona opção "outras"
        $("#div-unidadeCap").show();
    } else {
        $("#div-unidadeCap").hide();
    }

}

function addUnidadeProd(val) {
    if (val == '1') {
        $("#div-unidadeProd").show();
    } else {
        $("#div-unidadeProd").hide();
    }

}

function addUnidadeQt(val) {
    if (val == 'outras') { //seleciona opção "outras"
        $("#div-unidade-qt").show();
    } else {
        $("#div-unidade-qt").hide();
    }

}

function addUnidadeQg(val) {
    if (val == 'outras') {
        $("#div-unidade-qg").show();
    } else {
        $("#div-unidade-qg").hide();
    }

}


function carregarAtoDeclaratorio() {

    $("#alertaProdModal").hide();
    $("#alertaProduto").hide();
    idIncentivoEmpresa = $("#idIncentivoEmpresa").val();
    idAto = $("#idAtoDeclaratorio").val();
    // console.log(idAto);
    dadosIncentivo = $("#form-produto").serialize();
    var form = document.getElementById('form-produto');
    var file_data = $('#atoDeclaratorio').prop('files')[0];
    var form_data = new FormData($("#form-produto")[0]);
    form_data.append('atoDeclaratorio', file_data);
    if (idIncentivoEmpresa == '') {
        tipoDados = "cadastro";
    } else {
        tipoDados = "edicao";
    }
    if (!file_data && idAto == '') {
        $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#produtoMsgModal").html(msg);
    } else {
        var anoInicial = $("#anoInicial").val();
        var anoFinal = $("#anoFinal").val();
        var producao = parseInt($("#producao").val().replace(/\./g, ''));
        var cri = parseInt($("#capacidadeInstalada").val().replace(/\./g, ''));
        idUnidadeCap = $("#idUnidadeCapacidade").val();
        idUnidadeProd = $("#idUnidadeProducao").val();
        if (idUnidadeCap == '1') {
            unidadeCap = $("#unidadeCap").val();
        }
        if (idUnidadeProd == '1') {
            unidadeProd = $("#unidadeProd").val();
        }

        // if (producao > cri) {
        //     form = '';
        //     $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        //     msg = '<strong>A Produção não deve ser maior que a Capacidade Real Instalada.</strong>';
        //     $("#produtoMsgModal").html(msg);
        // }

        if (anoFinal.length < 4 || anoInicial.length < 4) {
            form = '';
            $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>Digite o período de fruição.</strong>';
            $("#produtoMsgModal").html(msg);
        } else {
            if (anoInicial > anoFinal || anoInicial == anoFinal) {
                form = '';
                $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>O período de fruição inicial deve ser menor que o período de fruição final.</strong>';
                $("#produtoMsgModal").html(msg);
            }
        }
        //console.log(form_data);
        if (form != '' && form.reportValidity()) {

            $.ajax({
                url: 'cadIncentivoempresa.php?dados=' + tipoDados, // point to server-side PHP script
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                beforeSend: function () {

                },
                success: function (retorno) {
                    //console.log(retorno);

                    if (retorno.infoProduto != '') {

                        if (tipoDados == 'edicao') {
                            var tr = $("#incentivosEmpresa #tr-" + retorno.id);
                        } else {
                            var tr = $($("#produto-incenitvado").clone().html()).attr("id", "tr-" + retorno.id);
                        }

                        $("[data-produto]", tr).html(retorno.infoProduto.produtoIncentivado);
                        $("[data-cri]", tr).html(retorno.infoProduto.capacidadeInstalada);
                        $("[data-unid-cri]", tr).html(retorno.unidCap);
                        $("[data-producao]", tr).html(retorno.infoProduto.producao);
                        $("[data-unid-prod]", tr).html(retorno.unidProd);
                        $("[data-faturamento]", tr).html("R$ " + retorno.infoProduto.faturamento);
                        $("[data-emp-direto]", tr).html(retorno.infoProduto.emprego);
                        $("[data-cnae]", tr).html(retorno.infoProduto.cnae);
                        $("[data-ato-dec]", tr).html(retorno.atoDec);

                        if (tipoDados == "cadastro"){
                            $("[edit-prod-incentivado]", tr).click(function(){ addProdIncentivado(retorno.id) });

                            $("[delete-prod-incentivado]", tr).data("id", retorno.id);

                            $("#incentivosEmpresa tbody").append(tr);
                        }

                        $("#modalProdutoIncentivado").modal("hide");
                        $("#alertaProduto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Produto/Serviço alterado com sucesso.</strong>';
                        $("#produtoMsg").html(msg);
                    }

                    if (retorno.erro != '') {
                        switch (retorno.erro) {
                            case '1':
                                $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                                $("#produtoMsgModal").html(msg);
                                break;
                            case '2':
                                $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>O tipo do arquivo deve ser .pdf.</strong>';
                                $("#produtoMsgModal").html(msg);
                                break;
                            case '3':
                                $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>Selecione o arquivo.</strong>';
                                $("#produtoMsgModal").html(msg);
                                break;
                        }
                    }

                }


            });
        }
    }
}

function removerAto(idAtoDeclaratorio) {
    //console.log(idAtoDeclaratorio);
    if (idAtoDeclaratorio != '') {
        tipoDados = "excluir";
        $.ajax({
            url: 'cadIncentivoempresa.php?dados=' + tipoDados,
            type: 'post',
            data: 'idAtoDeclaratorio=' + idAtoDeclaratorio,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                if (retorno != '1') {
                    $("#alertaProdModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Ato Declaratório removido com sucesso.</strong>';
                    $("#produtoMsgModal").html(msg);
                    $("#anexarAto").show();
                    $("#listaAto").hide();
                }

            },
            error: function (retorno) {

            }
        });
    }
}

function addMercado(idMercado, idIncentivoEmpresa) {
    $("#modalMercado").modal("show");
    $("#alertaMercado").hide();
    $("#alertaMercadoModal").hide();
    tipoDados = "mercado";
    $.ajax({
        url: 'cadMercadoconsumidor.php?dados=' + tipoDados,
        type: 'post',
        data: 'idMercado=' + idMercado + '&idIncentivoEmpresa=' + idIncentivoEmpresa,
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (retorno) {
            //console.log(retorno);
            if (retorno.infoMercado != '') {
                $("#produtoIncentM", "#form-mercado").val(retorno.infoMercado.oIncentivoempresa.produtoIncentivado);
                $("#idMercado", "#form-mercado").val(retorno.infoMercado.idMercado);
                $("#idIncentivoEmpresa", "#form-mercado").val(retorno.infoMercado.oIncentivoempresa.idIncentivoEmpresa);
                $("#quantidadeRegional", "#form-mercado").val(retorno.infoMercado.quantidadeRegional);
                $("#quantidadeNacional", "#form-mercado").val(retorno.infoMercado.quantidadeNacional);
                $("#quantidadeExterior", "#form-mercado").val(retorno.infoMercado.quantidadeExterior);

            }
        },
        error: function (retorno) {
        }
    });

    $("#idIncentivoEmpresa", "#form-mercado").val(idIncentivoEmpresa);

}

function cadMercado() {
    idMercado = $("#idMercado").val();
    dadosMercado = $("#form-mercado").serialize();
    if (idMercado == '') {
        tipoDados = "cadastro";
    } else {
        tipoDados = "edicao";
    }
    quantReg = $("#quantidadeRegional", "#form-mercado").val() == "" ? '0' : $("#quantidadeRegional", "#form-mercado").val().replace(",", ".");

    quantNac = $("#quantidadeNacional", "#form-mercado").val() == "" ? '0' : $("#quantidadeNacional", "#form-mercado").val().replace(",", ".");

    quantExt = $("#quantidadeExterior", "#form-mercado").val() == "" ? '0' : $("#quantidadeExterior", "#form-mercado").val().replace(",", ".");

    if (quantReg == '0' && quantNac == '0' && quantExt == '0') {
        $("#alertaMercadoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Digite a quantidade (Regional ou Nacional ou Exterior).</strong>';
        $("#mercadoMsgModal").html(msg);
    } else {
        total = parseFloat(quantReg) + parseFloat(quantNac) + parseFloat(quantExt);
        if (total != 100) {
            $("#alertaMercadoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>A somatória das quantidades deve ser 100%.</strong>';
            $("#mercadoMsgModal").html(msg);
        } else {
            $("#alertaMercadoModal").hide();
            $.ajax({
                url: 'cadMercadoconsumidor.php?dados=' + tipoDados,
                type: 'post',
                data: dadosMercado,
                beforeSend: function () {
                },
                success: function (retorno) {
                    if (retorno != "")
                        retorno = JSON.parse(retorno);

                    //console.log(retorno);
                    if (retorno != '') {
                        quantReg = !retorno.infoMercado.quantidadeRegional ? '0%' : retorno.infoMercado.quantidadeRegional + '%';
                        quantNac = !retorno.infoMercado.quantidadeNacional ? '0%' : retorno.infoMercado.quantidadeNacional + '%';
                        quantExt = !retorno.infoMercado.quantidadeExterior ? '0%' : retorno.infoMercado.quantidadeExterior + '%';
                        $("[data-quant-reg]", "#mercadoEmpresa #tr-mc" + retorno.infoMercado.oIncentivoempresa.idIncentivoEmpresa).html(quantReg);
                        $("[data-quant-nac]", "#mercadoEmpresa #tr-mc" + retorno.infoMercado.oIncentivoempresa.idIncentivoEmpresa).html(quantNac);
                        $("[data-quant-ext]", "#mercadoEmpresa #tr-mc" + retorno.infoMercado.oIncentivoempresa.idIncentivoEmpresa).html(quantExt);
                        $("[data-total-mercado]", "#mercadoEmpresa #tr-mc" + retorno.infoMercado.oIncentivoempresa.idIncentivoEmpresa).html('100%');
                        $("#modalMercado").modal("hide");
                        $("#alertaMercado").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();

                        if (tipoDados == "cadastro")
                            msg = '<strong>Mercado Consumidor cadastrado com sucesso.</strong>';
                        else
                            msg = '<strong>Mercado Consumidor atualizado com sucesso.</strong>';

                        $("#mercadoMsg").html(msg);
                    }

                },
                error: function (retorno) {

                }
            });
        }
    }

}

function addInsumo() {
    $("#modalCadInsumo").modal("show");
    quantReg = $("#quantidadeRegional", "#form-insumo").val('');
    quantNac = $("#quantidadeNacional", "#form-insumo").val('');
    quantExt = $("#quantidadeExterior", "#form-insumo").val('');
    nomeInsumo = $("#insumo", "#form-insumo").val('');
    $("#alertaInsumoModal").hide();
    $("#alertaOrigem").hide();
}

function cadInsumo() {
    dadosInsumo = $("#form-insumo").serialize();

    if (idOrigemInsumos == '') {
        tipoDados = "cadastro";
    } else {
        tipoDados = "edicao";
    }
    quantReg = $("#quantidadeRegional", "#form-insumo").replace(",", ".");
    quantNac = $("#quantidadeNacional", "#form-insumo").replace(",", ".");
    quantExt = $("#quantidadeExterior", "#form-insumo").replace(",", ".");
    nomeInsumo = $("#insumo", "#form-insumo").val();
    if (!nomeInsumo) {
        $("#alertaInsumoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Digite o Insumo.</strong>';
        $("#insumoMsgModal").html(msg);
    } else {


        if (!quantReg && !quantNac && !quantExt) {
            $("#alertaInsumoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>Digite a quantidade (Regional ou Nacional ou Exterior).</strong>';
            $("#insumoMsgModal").html(msg);
        } else {
            quantReg = $("#quantidadeRegional", "#form-insumo").val() == "" ? '0' : $("#quantidadeRegional", "#form-insumo").val().replace(",", ".");
            quantNac = $("#quantidadeNacional", "#form-insumo").val() == "" ? '0' : $("#quantidadeNacional", "#form-insumo").val().replace(",", ".");
            quantExt = $("#quantidadeExterior", "#form-insumo").val() == "" ? '0' : $("#quantidadeExterior", "#form-insumo").val().replace(",", ".");
            total = parseFloat(quantReg) + parseFloat(quantNac) + parseFloat(quantExt);
            if (total != 100) {
                // console.log(total);
                $("#alertaInsumoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>A somatória das quantidades deve ser 100%.</strong>';
                $("#insumoMsgModal").html(msg);
            } else {

                tipoDados = "cadastro";
                $.ajax({
                    url: 'cadOrigeminsumos.php?dados=' + tipoDados,
                    type: 'post',
                    data: dadosInsumo,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        //console.log(retorno);
                        if (retorno.erro) {

                        } else {
                            if (retorno.infoOrigem) {
                                $("#modalCadInsumo").modal("hide");
                                $("#body-insumos").append(retorno.itemTabela);
                                $("#alertaOrigem").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                                msg = '<strong>Origem de Insumos cadastrado com sucesso.</strong>';
                                $("#origemMsg").html(msg);
                            }
                        }
                        //console.log(retorno);
                        //return;

                    },
                    error: function (retorno) {
                    }
                });
            }
        }
    }
}

function addOrigem(idOrigemInsumos) {
    // console.log(idOrigemInsumos);
    $("#modalInsumo").modal("show");
    $("#alertaOrigem").hide();
    $("#alertaOrigemModal").hide();
    tipoDados = "origem";
    if (idOrigemInsumos != '0') {
        $.ajax({
            url: 'cadOrigeminsumos.php?dados=' + tipoDados,
            type: 'post',
            data: 'idOrigemInsumos=' + idOrigemInsumos,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                //return;
                if (retorno.infoOrigem != '') {
                    $("#insumo", "#form-origem").val(retorno.infoOrigem.oInsumos.descricao);
                    $("#idOrigemInsumos", "#form-origem").val(retorno.infoOrigem.idOrigemInsumos);
                    $("#idEmpresa", "#form-origem").val(retorno.infoOrigem.oEmpresa.idEmpresa);
                    $("#idInsumo", "#form-origem").val(retorno.infoOrigem.oInsumos.idInsumo);
                    $("#quantidadeRegional", "#form-origem").val(retorno.infoOrigem.quantidadeRegional);
                    $("#quantidadeNacional", "#form-origem").val(retorno.infoOrigem.quantidadeNacional);
                    $("#quantidadeExterior", "#form-origem").val(retorno.infoOrigem.quantidadeExterior);

                }
            },
            error: function (retorno) {
            }
        });
    }


}

function cadOrigem() {
    idOrigemInsumos = $("#idOrigemInsumos").val();
    dadosOrigem = $("#form-origem").serialize();

    if (idOrigemInsumos == '') {
        tipoDados = "cadastro";
    } else {
        tipoDados = "edicao";
    }
    quantReg = $("#quantidadeRegional", "#form-origem").val();
    quantNac = $("#quantidadeNacional", "#form-origem").val();
    quantExt = $("#quantidadeExterior", "#form-origem").val();

    if (!quantReg && !quantNac && !quantExt) {
        $("#alertaOrigemModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Digite a quantidade (Regional ou Nacional ou Exterior).</strong>';
        $("#origemMsgModal").html(msg);
    } else {
        quantReg = $("#quantidadeRegional", "#form-origem").val() == "" ? '0' : $("#quantidadeRegional", "#form-origem").val().replace(",", ".");

        quantNac = $("#quantidadeNacional", "#form-origem").val() == "" ? '0' : $("#quantidadeNacional", "#form-origem").val().replace(",", ".");

        quantExt = $("#quantidadeExterior", "#form-origem").val() == "" ? '0' : $("#quantidadeExterior", "#form-origem").val().replace(",", ".");

        total = parseFloat(quantReg) + parseFloat(quantNac) + parseFloat(quantExt);

        if (total != 100) {
            // console.log(total);
            $("#alertaOrigemModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>A somatória das quantidades deve ser 100%.</strong>';
            $("#origemMsgModal").html(msg);
        } else {
            $("#alertaOrigemModal").hide();
            //console.log(JSON.stringify(dadosOrigem));
            $.ajax({
                url: 'cadOrigeminsumos.php?dados=' + tipoDados,
                type: 'post',
                data: dadosOrigem,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (retorno) {
                    //console.log(retorno);
                    if (retorno.infoOrigem != '') {
                        if (tipoDados == 'edicao') {
                            quantReg = !retorno.infoOrigem.quantidadeRegional ? '0%' : retorno.infoOrigem.quantidadeRegional + '%';
                            quantNac = !retorno.infoOrigem.quantidadeNacional ? '0%' : retorno.infoOrigem.quantidadeNacional + '%';
                            quantExt = !retorno.infoOrigem.quantidadeExterior ? '0%' : retorno.infoOrigem.quantidadeExterior + '%';
                            $("[data-quant-reg]", "#insumosEmpresa #tr-id" + retorno.id).html(quantReg);
                            $("[data-quant-nac]", "#insumosEmpresa #tr-id" + retorno.id).html(quantNac);
                            $("[data-quant-ext]", "#insumosEmpresa #tr-id" + retorno.id).html(quantExt);
                            $("[data-total-origem]", "#insumosEmpresa #tr-id" + retorno.id).html('100%');
                            $("#modalInsumo").modal("hide");
                            $("#alertaOrigem").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Origem de Insumos atualizado com sucesso.</strong>';
                            $("#origemMsg").html(msg);

                        }
                    }

                },
                error: function (retorno) {

                }
            });
        }
    }

}

function excluirOrigem(idOrigemInsumos) {
    if (idOrigemInsumos != '') {
        confirmacao(null, "Confirma exclusão?", {
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = "excluir";
                $.ajax({
                    url: 'cadOrigeminsumos.php?dados=' + tipoDados,
                    type: 'post',
                    data: 'idOrigemInsumos=' + idOrigemInsumos,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        if (retorno.del == '1') {
                            $("#alertaOrigem").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Origem de Insumos removido com sucesso.</strong>';
                            $("#origemMsg").html(msg);
                            $("#tr-id" + idOrigemInsumos, "#body-insumos").remove();
                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })

    }
}

function cadFinanceiro() {
    $("#alertaFinanceiro").hide();
    idCadastroFinanceiro = $("#idCadastroFinanceiro").val();
    if (!idCadastroFinanceiro) {
        tipoDados = 'cadastro';
    } else {
        tipoDados = 'edicao';
    }
    dadosFinanceiro = $("#form-financeiro").serialize();
    var form = document.getElementById("form-financeiro");
    if (form.reportValidity()) {
        $.ajax({
            url: 'cadCadastrofinanceiro.php?dados=' + tipoDados,
            type: 'post',
            data: dadosFinanceiro,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                if (retorno.infoFinanceiro != '') {
                    $("#idEmpresa", "#form-financeiro").val(retorno.infoFinanceiro.oEmpresa.idEmpresa);
                    $("#idCadastroFinanceiro", "#form-financeiro").val(retorno.infoFinanceiro.idCadastroFinanceiro);
                    $("#faturamentoBruto", "#form-financeiro").val(retorno.infoFinanceiro.faturamentoBruto);
                    $("#faturamentoProdIncentivados", "#form-financeiro").val(retorno.infoFinanceiro.faturamentoProdIncentivados);
                    $("#imobilizadoTotal", "#form-financeiro").val(retorno.infoFinanceiro.imobilizadoTotal);
                    $("#investimentoCapitalFixo", "#form-financeiro").val(retorno.infoFinanceiro.investimentoCapitalFixo);
                    $("#remuneracaoCapitalProprio", "#form-financeiro").val(retorno.infoFinanceiro.remuneracaoCapitalProprio);
                    $("#pessoasEncargos", "#form-financeiro").val(retorno.infoFinanceiro.pessoasEncargos);
                    $("#impostosTaxasContribuicoes", "#form-financeiro").val(retorno.infoFinanceiro.impostosTaxasContribuicoes);
                    $("#valorIcms", "#form-financeiro").val(retorno.infoFinanceiro.valorIcms);
                    $("#valorIssqn", "#form-financeiro").val(retorno.infoFinanceiro.valorIssqn);
                    $("#valorIRtotal", "#form-financeiro").val(retorno.infoFinanceiro.valorIRtotal);
                    $("#valorDescontoIR", "#form-financeiro").val(retorno.infoFinanceiro.valorDescontoIR);
                    $("#irDescontada", "#form-financeiro").val(retorno.infoFinanceiro.irDescontada);
                    $("#reservaIncentivo", "#form-financeiro").val(retorno.infoFinanceiro.reservaIncentivo);
                    $("#reservaExercicio", "#form-financeiro").val(retorno.infoFinanceiro.reservaExercicio);
                    $("#reservaInvestimento", "#form-financeiro").val(retorno.infoFinanceiro.reservaInvestimento);
                    $("#empregosDiretos", "#form-financeiro").val(retorno.infoFinanceiro.empregosDiretos);
                    $("#maoObraIndiretaFixa", "#form-financeiro").val(retorno.infoFinanceiro.maoObraIndiretaFixa);
                    $("#terceirizadosExistentes", "#form-financeiro").val(retorno.infoFinanceiro.terceirizadosExistentes);
                    $("#despesaTerceiro", "#form-financeiro").val(retorno.infoFinanceiro.despesaTerceiro);
                    $("#maoObraDireta", "#form-financeiro").val(retorno.infoFinanceiro.maoObraDireta);
                    if (tipoDados == 'cadastro') {
                        $("#alertaFinanceiro").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Dados Financeiros cadastrados com sucesso.</strong>';
                        $("#financeiroMsg").html(msg);
                    }
                    if (tipoDados == 'edicao') {
                        $("#alertaFinanceiro").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Dados Financeiros alterados com sucesso.</strong>';
                        $("#financeiroMsg").html(msg);
                    }
                }

            },
            error: function (retorno) {

            }
        });
    }

}


function addPesquisa(idProjeto) {
    $("#modalPesquisa").modal("show");
    $("#alertaPesquisaNaoPossui").hide();
    $("#alertaPesquisa").hide();
    tipoDados = 'pesquisa';

    if (idProjeto != '') {
        $.ajax({
            url: 'cadPesquisaDesenvolvimento.php?dados=' + tipoDados,
            type: 'post',
            data: 'idPesquisa=' + idProjeto,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                $("#idPesquisa", "#form-pesquisa").val(retorno.infoPesquisa.idPesquisa);
                $("#idEmpresaPesquisa", "#form-pesquisa").val(retorno.infoPesquisa.oEmpresa.idEmpresa);
                $("#nomeProjetoEmpresa", "#form-pesquisa").val(retorno.infoPesquisa.nomeProjeto);
                $("#descricaoAtividadeEmpresa", "#form-pesquisa").val(retorno.infoPesquisa.descricaoAtividade);
                $("#totalDespesasEmpresa", "#form-pesquisa").val(retorno.infoPesquisa.totalDespesas);
                $("#quantidadePessoasEmpresa", "#form-pesquisa").val(retorno.infoPesquisa.quantidadePessoas);
                $("#observacoesEmpresa", "#form-pesquisa").val(retorno.infoPesquisa.observacoes);
                if (!retorno.infoArquivo) {
                    $("#anexarProjetoEmpresa").show();
                    $("#arquivoProjetoEmpresa").val(null);
                    $("#listaArquivoEmpresa").hide();
                } else {
                    $("#anexarProjetoEmpresa").hide();
                    $("#listaArquivoEmpresa").show();
                    $("#arquivoPesq").html(retorno.listaArquivo);
                }


            },
            error: function (retorno) {
            }
        });
    } else {

        $("#idPesquisa").val("");

        idEmpresa = $("#idEmpresaPesquisa").val();
        $.ajax({
            url: 'cadPesquisaDesenvolvimento.php?dados=empresa',
            type: 'post',
            data: 'idEmpresa=' + idEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);

                if (retorno.infoEmpresa.pesquisaDesenvolvimento == '1') {
                    $("#naoPossui", "#form-pesquisa").prop("checked", true);
                    $("#nomeProjetoEmpresa").prop("disabled", true);
                    $("#descricaoAtividadeEmpresa").prop("disabled", true);
                    $("#totalDespesasEmpresa").prop("disabled", true);
                    $("#quantidadePessoasEmpresa").prop("disabled", true);
                    $("#observacoesEmpresa").prop("disabled", true);
                    $("#arquivoProjetoEmpresa").prop("disabled", true);
                    $("#btnArquivoPesq").prop("disabled", true);
                } else {
                    $("#naoPossui", "#form-pesquisa").prop("checked", false);
                    $("#nomeProjetoEmpresa").val('');
                    $("#descricaoAtividadeEmpresa").val('');
                    $("#totalDespesasEmpresa").val('');
                    $("#quantidadePessoasEmpresa").val('');
                    $("#observacoesEmpresa").val('');
                    $("#anexarProjetoEmpresa").show();
                    $("#arquivoProjetoEmpresa").filestyle("clear");
                    $("#listaArquivoEmpresa").hide();
                }


            },
            error: function (retorno) {
            }
        });
    }
}


function addProjeto(idProjeto) {
    $("#modalProjeto").modal("show");
    $("#alertaProjetoNaoPossui").hide();
    $("#alertaProjeto").hide();
    tipoDados = 'projeto';

    if (idProjeto != '') {
        $.ajax({
            url: 'cadProjsocioambiental.php?dados=' + tipoDados,
            type: 'post',
            data: 'idProjeto=' + idProjeto,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                $("#idProjeto", "#form-projeto").val(retorno.infoProjeto.idProjeto);
                $("#idEmpresa", "#form-projeto").val(retorno.infoProjeto.oEmpresa.idEmpresa);
                $("#nomeProjeto", "#form-projeto").val(retorno.infoProjeto.nomeProjeto);
                $("#descricaoAtividade", "#form-projeto").val(retorno.infoProjeto.descricaoAtividade);
                $("#totalDespesas", "#form-projeto").val(retorno.infoProjeto.totalDespesas);
                $("#quantidadePessoas", "#form-projeto").val(retorno.infoProjeto.quantidadePessoas);
                $("#observacoes", "#form-projeto").val(retorno.infoProjeto.observacoes);
                if (!retorno.infoArquivo) {
                    $("#anexarProjeto").show();
                    $("#arquivoProjeto").val(null);
                    $("#listaArquivoProjeto").hide();
                } else {
                    $("#anexarProjeto").hide();
                    $("#listaArquivoProjeto").show();
                    $("#arquivoProj").html(retorno.listaArquivo);
                }


            },
            error: function (retorno) {
            }
        });
    } else {

        $("#idProjeto").val("");

        idEmpresa = $("#idEmpresa").val();
        $.ajax({
            url: 'cadProjsocioambiental.php?dados=empresa',
            type: 'post',
            data: 'idEmpresa=' + idEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);

                if (retorno.infoEmpresa.projetoSocial == '1') {
                    $("#naoPossui", "#form-projeto").prop("checked", true);
                    $("#nomeProjeto").prop("disabled", true);
                    $("#descricaoAtividade").prop("disabled", true);
                    $("#totalDespesas").prop("disabled", true);
                    $("#quantidadePessoas").prop("disabled", true);
                    $("#observacoes").prop("disabled", true);
                    $("#arquivoProjeto").prop("disabled", true);
                    $("#btnArquivoProj").prop("disabled", true);
                } else {
                    $("#naoPossui", "#form-projeto").prop("checked", false);
                    $("#nomeProjeto").val('');
                    $("#descricaoAtividade").val('');
                    $("#totalDespesas").val('');
                    $("#quantidadePessoas").val('');
                    $("#observacoes").val('');
                    $("#anexarProjeto").show();
                    $("#arquivoProjeto").filestyle("clear");
                    $("#listaArquivoProjeto").hide();
                }


            },
            error: function (retorno) {
            }
        });
    }
}

function naoPossuiProjeto() {
    naoPossui = $("#naoPossui").is(":checked");

    if (naoPossui) {
        $("#nomeProjeto", "#form-projeto").prop("disabled", true);
        $("#descricaoAtividade", "#form-projeto").prop("disabled", true);
        $("#totalDespesas", "#form-projeto").prop("disabled", true);
        $("#quantidadePessoas", "#form-projeto").prop("disabled", true);
        $("#observacoes", "#form-projeto").prop("disabled", true);
        $("#arquivoProjeto", "#form-projeto").prop("disabled", true);
        $("#btnArquivoProj", "#form-projeto").prop("disabled", true);
    } else {
        $("#nomeProjeto", "#form-projeto").prop("disabled", false);
        $("#descricaoAtividade", "#form-projeto").prop("disabled", false);
        $("#totalDespesas", "#form-projeto").prop("disabled", false);
        $("#quantidadePessoas", "#form-projeto").prop("disabled", false);
        $("#observacoes", "#form-projeto").prop("disabled", false);
        $("#arquivoProjeto", "#form-projeto").prop("disabled", false);
        $("#btnArquivoProj", "#form-projeto").prop("disabled", false)
    }
}

function cadProjeto() {
    naoPossui = $("#naoPossui").is(":checked");
    idEmpresa = $("#idEmpresa").val();
    if (!naoPossui) {
        idProjeto = $("#idProjeto").val();
        if (!idProjeto) {
            tipoDados = 'cadastro';
        } else {
            tipoDados = 'edicao';
        }
        dadosProjeto = $("#form-projeto").serialize();
        var form = document.getElementById("form-projeto");
        if (form.reportValidity()) {
            $.ajax({
                url: 'cadProjsocioambiental.php?dados=' + tipoDados,
                type: 'post',
                data: dadosProjeto,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (retorno) {
                    idProjeto = retorno.id;
                    idArquivoProjeto = retorno.idArquivoProjeto;
                    if (retorno.infoProjeto != '') {
                        $("#projetoEmpresa").show();
                        if (tipoDados == 'cadastro') {
                            $("#modalProjeto").modal("hide");
                            $("#body-projeto").append(retorno.itemProjeto);
                            $("#alertaProjeto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Projeto cadastrado com sucesso.</strong>';
                            $("#projetoMsg").html(msg);
                        }
                        if (tipoDados == 'edicao') {
                            $("#modalProjeto").modal("hide");
                            $("[data-projeto]", "#body-projeto #tr-id" + retorno.id).html(retorno.infoProjeto.nomeProjeto);
                            $("[data-atividade]", "#body-projeto #tr-id" + retorno.id).html(retorno.infoProjeto.descricaoAtividade);
                            $("[data-total]", "#body-projeto #tr-id" + retorno.id).html(retorno.infoProjeto.totalDespesas);
                            $("[data-quant]", "#body-projeto #tr-id" + retorno.id).html(retorno.infoProjeto.quantidadePessoas);
                            $("[data-obs]", "#body-projeto #tr-id" + retorno.id).html(retorno.infoProjeto.observacoes);
                            $("[data-arquivo]", "#body-projeto #tr-id" + retorno.id).html(retorno.linkArquivo);
                            $("#alertaProjeto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Projeto alterado com sucesso.</strong>';
                            $("#projetoMsg").html(msg);
                        }
                    }

                },
                error: function (retorno) {

                }
            });
        }

    } else {
        tipoDados = 'naoPossui';
        $.ajax({
            url: 'cadProjsocioambiental.php?dados=' + tipoDados + '&idEmpresa=' + idEmpresa,
            type: 'post',
            data: '',
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                // console.log(retorno);
                if (tipoDados == 'naoPossui') {
                    if (retorno.res == '0') {
                        $("#modalProjeto").modal("hide");
                        $("#alertaProjeto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa não possui projeto/programa social.</strong>';
                        $("#projetoMsg").html(msg);
                    }
                    else {
                        $("#modalProjeto").modal("hide");
                        $("#alertaProjeto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa já possui projeto/programa social cadastrado no sistema.</strong>';
                        $("#projetoMsg").html(msg);
                    }
                }


            },
            error: function (retorno) {

            }
        });
    }
}

function cadPesquisa() {
    naoPossui = $("#naoPossuiPesquisa").is(":checked");
    idEmpresa = $("#idEmpresaPesquisa").val();
    if (!naoPossui) {
        idProjeto = $("#idPesquisa").val();
        if (!idProjeto) {
            tipoDados = 'cadastro';
        } else {
            tipoDados = 'edicao';
        }
        dadosProjeto = $("#form-pesquisa").serialize();
        var form = document.getElementById("form-pesquisa");
        if (form.reportValidity()) {
            $.ajax({
                url: 'cadPesquisaDesenvolvimento.php?dados=' + tipoDados,
                type: 'post',
                data: dadosProjeto,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (retorno) {
                    idProjeto = retorno.id;
                    idArquivoProjeto = retorno.idArquivoProjeto;
                    if (retorno.infoProjeto != '') {
                        $("#projetoEmpresaPesquisa").show();
                        if (tipoDados == 'cadastro') {
                            $("#modalPesquisa").modal("hide");
                            $("#body-pesquisa").append(retorno.itemProjeto);
                            $("#alertaPesquisa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Projeto cadastrado com sucesso.</strong>';
                            $("#pesquisaMsg").html(msg);
                        }
                        if (tipoDados == 'edicao') {
                            $("#modalPesquisa").modal("hide");
                            $("[data-projeto]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.infoProjeto.nomeProjeto);
                            $("[data-atividade]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.infoProjeto.descricaoAtividade);
                            $("[data-total]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.infoProjeto.totalDespesas);
                            $("[data-quant]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.infoProjeto.quantidadePessoas);
                            $("[data-obs]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.infoProjeto.observacoes);
                            $("[data-arquivo]", "#body-pesquisa #tr-id" + retorno.id).html(retorno.linkArquivo);
                            $("#alertaPesquisa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Projeto alterado com sucesso.</strong>';
                            $("#pesquisaMsg").html(msg);
                        }
                    }

                },
                error: function (retorno) {

                }
            });
        }

    } else {
        tipoDados = 'naoPossui';
        $.ajax({
            url: 'cadPesquisaDesenvolvimento.php?dados=' + tipoDados + '&idEmpresa=' + idEmpresa,
            type: 'post',
            data: '',
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                // console.log(retorno);
                if (tipoDados == 'naoPossui') {
                    if (retorno.res == '0') {
                        $("#modalPesquisa").modal("hide");
                        $("#alertaPesquisa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa não possui projeto/programa social.</strong>';
                        $("#pesquisaMsg").html(msg);
                    }
                    else {
                        $("#modalPesquisa").modal("hide");
                        $("#alertaPesquisa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa já possui projeto/programa social cadastrado no sistema.</strong>';
                        $("#pesquisaMsg").html(msg);
                    }
                }


            },
            error: function (retorno) {

            }
        });
    }
}

function carregaArquivoProjeto() {
    $("#alertaProjetoModal").hide();
    var file_data = $('#arquivoProjeto').prop('files')[0];
    var form_data = new FormData($("#form-projeto")[0]);
    form_data.append('arquivoProjeto', file_data);
    if (!file_data) {
        $("#alertaProjetoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#projetoMsgModal").html(msg);
    } else {
        $.ajax({
            url: 'cadProjsocioambiental.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function () {

            },
            success: function (retorno) {
                if (!retorno.erro) {
                    $("#anexarProjeto").hide();
                    $("#listaArquivoProjeto").show();
                    $("#arquivoProj").html(retorno.listaArquivo);

                } else {
                    switch (retorno.erro) {
                        case '1':
                            $("#alertaProjetoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                            $("#projetoMsgModal").html(msg);
                            break;
                        case '2':
                            $("#alertaProjetoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>O formato do arquivo deve ser PDF.</strong>';
                            $("#projetoMsgModal").html(msg);
                            break;
                        case '3':
                            $("#alertaProjetoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Selecione o arquivo.</strong>';
                            $("#projetoMsgModal").html(msg);
                            break;
                    }

                }
            }
        });
    }
}


function carregaArquivoPesquisa() {
    $("#alertaProjetoModal").hide();
    var file_data = $('#arquivoProjetoEmpresa').prop('files')[0];
    var form_data = new FormData($("#form-pesquisa")[0]);
    if (!file_data) {
        $("#alertaPesquisaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#pesquisaMsgModal").html(msg);
    } else {
        $.ajax({
            url: 'cadPesquisadesenvolvimento.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function () {

            },
            success: function (retorno) {
                if (!retorno.erro) {
                    $("#anexarProjetoEmpresa").hide();
                    $("#listaArquivoEmpresa").show();
                    $("#arquivoPesq").html(retorno.listaArquivo);

                } else {
                    switch (retorno.erro) {
                        case '1':
                            $("#alertaPesquisaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                            $("#pesquisaMsgModal").html(msg);
                            break;
                        case '2':
                            $("#alertaPesquisaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>O formato do arquivo deve ser PDF.</strong>';
                            $("#pesquisaMsgModal").html(msg);
                            break;
                        case '3':
                            $("#alertaPesquisaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Selecione o arquivo.</strong>';
                            $("#pesquisaMsgModal").html(msg);
                            break;
                    }

                }
            }
        });
    }
}

function excluirProjeto(idProjeto) {
    if (idProjeto != '') {
        confirmacao(null, "Confirma exclusão?", {
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = "excluir";
                $.ajax({
                    url: 'cadProjsocioambiental.php?dados=' + tipoDados,
                    type: 'post',
                    data: 'idProjeto=' + idProjeto,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        if (retorno.del == '1') {
                            $("#alertaProjeto").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Projeto removido com sucesso.</strong>';
                            $("#projetoMsg").html(msg);
                            $("#tr-id" + idProjeto, "#body-projeto").remove();
                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })

    }

}

function excluirPesquisa(idProjeto) {
    if (idProjeto != '') {
        confirmacao(null, "Confirma exclusão?", {
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                $.ajax({
                    url: 'cadPesquisadesenvolvimento.php?dados=excluir',
                    type: 'post',
                    data: 'idPesquisa=' + idProjeto,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        if (retorno.del == '1') {
                            $("#alertaPesquisa").removeClass("alert-warning alert-success alert-info").addClass("alert-info").show();
                            msg = '<strong>Registro removido com sucesso.</strong>';
                            $("#pesquisaMsg").html(msg);
                            $("#tr-id" + idProjeto, "#body-pesquisa").remove();
                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })

    }

}


function removerArquivoPesquisa(idArquivoProj) {
    //console.log(idAtoDeclaratorio);
    if (idArquivoProj != '') {
        tipoDados = "excluirArquivo";
        $.ajax({
            url: 'cadPesquisadesenvolvimento.php?dados=' + tipoDados,
            type: 'post',
            data: 'idArquivoPesq=' + idArquivoProj,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                if (retorno != '1') {
                    $("#alertaProjetoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo removido com sucesso.</strong>';
                    $("#pesquisaMsgModal").html(msg);
                    $("#anexarProjetoEmpresa").show();
                    $("#arquivoProjetoEmpresa").val(null);
                    $("#listaArquivoEmpresa").hide();
                }

            },
            error: function (retorno) {

            }
        });
    }
}


function addPolitica(idPolitica) {
    $("#modalPolitica").modal("show");
    $("#alertaPolitica").hide();
    $("#alertaPoliticaModal").hide();
    $("#alertaPoliticaNaoPossui").hide();
    tipoDados = 'politica';
    if (idPolitica != '0') {
        $.ajax({
            url: 'cadPoliticaambiental.php?dados=' + tipoDados,
            type: 'post',
            data: 'idPolitica=' + idPolitica,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                $("#idPolitica", "#form-politica").val(retorno.infoPolitica.idPolitica);
                $("#idEmpresa", "#form-politica").val(retorno.infoPolitica.oEmpresa.idEmpresa);
                $("#residuosGerados", "#form-politica").val(retorno.infoPolitica.residuosGerados);
                $("#descricaoTratamento", "#form-politica").val(retorno.infoPolitica.descricaoTratamento);
                $("#quantGerado", "#form-politica").val(retorno.infoPolitica.quantGerado);
                $("#unidadeQg", "#form-politica").val(retorno.infoPolitica.unidadeQg);
                $("#descricaoQg", "#form-politica").val(retorno.infoPolitica.descricaoQg);
                $("#quantTratado", "#form-politica").val(retorno.infoPolitica.quantTratado);
                $("#unidadeQt", "#form-politica").val(retorno.infoPolitica.unidadeQt);
                $("#descricaoQt", "#form-politica").val(retorno.infoPolitica.descricaoQt);

                if (!retorno.infoArquivo) {
                    $("#anexarPolitica").show();
                    $("#arquivoPolitica").val(null);
                    $("#listaArquivoPolitica").hide();
                } else {
                    $("#anexarPolitica").hide();
                    $("#listaArquivoPolitica").show();
                    $("#arquivoPol").html(retorno.listaArquivo);
                }


            },
            error: function (retorno) {
            }
        });
    } else {
        //document.getElementById("form-politica").reset();

        $("#idPolitica", "#form-politica").val("");

        idEmpresa = $("#idEmpresa", "#form-politica").val();
        $("#anexarPolitica").show();
        $("#arquivoPolitica").filestyle("clear");
        $("#listaArquivoPolitica").hide();
        tipoDados = 'empresa';
        $.ajax({
            url: 'cadPoliticaambiental.php?dados=' + tipoDados,
            type: 'post',
            data: 'idEmpresa=' + idEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                console.log(retorno);
                if (retorno.infoEmpresa.politicaAmbiental == '1') {
                    $("#naoPossuiPol", "#form-politica").prop("checked", true);
                    $("#residuosGerados", "#form-politica").prop("disabled", true);
                    $("#descricaoTratamento", "#form-politica").prop("disabled", true);
                    $("#quantGerado", "#form-politica").prop("disabled", true);
                    $("#unidadeQg", "#form-politica").prop("disabled", true);
                    $("#quantTratado", "#form-politica").prop("disabled", true);
                    $("#unidadeQt", "#form-politica").prop("disabled", true);
                    $("#arquivoPolitica", "#form-politica").prop("disabled", true);
                    $("#btnArquivoPol", "#form-politica").prop("disabled", true);
                    $("#btnPolitica", "#form-politica").prop("disabled", false);
                } else {
                    $("#naoPossuiPol", "#form-politica").prop("checked", false);
                    $("#residuosGerados", "#form-politica").val("");
                    $("#descricaoTratamento", "#form-politica").val("");
                    $("#quantGerado", "#form-politica").val("");
                    $("#unidadeQg", "#form-politica").val("");
                    $("#unidadeDescQg", "#form-politica").val("");
                    $("#quantTratado", "#form-politica").val("");
                    $("#unidadeQt", "#form-politica").val("");
                    $("#unidadeDescQt", "#form-politica").val("");
                    $("#unidadeQt", "#form-politica").val("");
                }


            },
            error: function (retorno) {
            }
        });
    }
}

function naoPossuiPolitica() {
    naoPossui = $("#naoPossuiPol").is(":checked");

    if (naoPossui) {
        $("#residuosGerados", "#form-politica").prop("disabled", true);
        $("#descricaoTratamento", "#form-politica").prop("disabled", true);
        $("#quantGerado", "#form-politica").prop("disabled", true);
        $("#unidadeQg", "#form-politica").prop("disabled", true);
        $("#quantTratado", "#form-politica").prop("disabled", true);
        $("#unidadeQt", "#form-politica").prop("disabled", true);
        $("#arquivoPolitica", "#form-politica").prop("disabled", true);
        $("#btnArquivoPol", "#form-politica").prop("disabled", true);
        $("#btnPolitica", "#form-politica").prop("disabled", false);

    } else {
        $("#residuosGerados", "#form-politica").prop("disabled", false);
        $("#descricaoTratamento", "#form-politica").prop("disabled", false);
        $("#quantGerado", "#form-politica").prop("disabled", false);
        $("#unidadeQg", "#form-politica").prop("disabled", false);
        $("#quantTratado", "#form-politica").prop("disabled", false);
        $("#unidadeQt", "#form-politica").prop("disabled", false);
        $("#arquivoPolitica", "#form-politica").prop("disabled", false);
        $("#btnArquivoPol", "#form-politica").prop("disabled", false);
        $("#btnPolitica", "#form-politica").prop("disabled", false);
    }
}

function cadPolitica() {
    naoPossui = $("#naoPossuiPol").is(":checked");
    idEmpresa = $("#idEmpresa").val();
    if (!naoPossui) {
        idPolitica = $("#idPolitica").val();
        if (!idPolitica) {
            tipoDados = 'cadastro';
        } else {
            tipoDados = 'edicao';
        }
        var form = document.getElementById("form-politica");
        dadosPolitica = $("#form-politica").serialize();
        if ($("#unidadeQg").val() == 'outras') {
            if (!$("#unidadeDescQg").val()) {
                form = '';
                $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>Digite a Unidade.</strong>';
                $("#politicaMsgModal").html(msg);
            }
        }
        if ($("#unidadeQt").val() == 'outras') {
            if (!$("#unidadeDescQt").val()) {
                form = '';
                $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>Digite a Unidade.</strong>';
                $("#politicaMsgModal").html(msg);
            }
        }

        //console.log(tipoDados);
        //return;
        // console.log(tipoDados);

        if (form != '' && form.reportValidity()) {
            $.ajax({
                url: 'cadPoliticaambiental.php?dados=' + tipoDados,
                type: 'post',
                data: dadosPolitica,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (retorno) {
                    idPolitica = retorno.id;
                    idArquivoPol = retorno.idArquivoPol;
                    //console.log(retorno);
                    if (retorno.infoPolitica != '') {
                        if (tipoDados == 'cadastro') {
                            $("#modalPolitica").modal("hide");
                            $("#alertaPoliticaNaoPossui").hide();
                            $("#politicaEmpresa").show();
                            $("#body-politica").append(retorno.itemPolitica);
                            if (retorno.itemQt) {
                                $("#unidadeQt").append(retorno.itemQt);
                                $("#div-unidade-qt").hide();
                                $("#unidadeDescQt").val('');
                            }
                            if (retorno.itemQg) {
                                $("#unidadeQg").append(retorno.itemQg);
                                $("#div-unidade-qg").hide();
                                $("#unidadeDescQg").val('');
                            }
                            $("#alertaPolitica").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Destinação Sustentável cadastrada com sucesso.</strong>';
                            $("#politicaMsg").html(msg);
                        }
                        if (tipoDados == 'edicao') {
                            $("#modalPolitica").modal("hide");
                            $("[data-resid]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.residuosGerados);
                            $("[data-desc-trat]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.descricaoTratamento);
                            $("[data-q-gerado]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.quantGerado);
                            $("[data-uni-qg]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.unidadeQg);
                            $("[data-q-tratado]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.quantTratado);
                            $("[data-uni-qt]", "#body-politica #tr-id" + retorno.id).html(retorno.infoPolitica.unidadeQt);
                            $("[data-arquivo]", "#body-politica #tr-id" + retorno.id).html(retorno.linkArquivo);

                            $("#alertaPolitica").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Destinação Sustentável alterada com sucesso.</strong>';
                            $("#politicaMsg").html(msg);
                        }
                    }

                },
                error: function (retorno) {

                }
            });
        }

    } else {
        tipoDados = 'naoPossui';
        $.ajax({
            url: 'cadPoliticaambiental.php?dados=' + tipoDados + '&idEmpresa=' + idEmpresa,
            type: 'post',
            data: '',
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                //console.log(retorno);
                if (tipoDados == 'naoPossui') {
                    if (retorno.res == '0') {
                        $("#modalPolitica").modal("hide");
                        $("#alertaPolitica").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa não possui Destinação Sustentável de Resíduos.</strong>';
                        $("#politicaMsg").html(msg);
                    }
                    else {
                        $("#modalPolitica").modal("hide");
                        $("#alertaPolitica").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Empresa já possui Destinação Sustentável de Resíduos cadastrada no sistema.</strong>';
                        $("#politicaMsg").html(msg);
                    }
                }


            },
            error: function (retorno) {

            }
        });
    }
}

function carregaArquivoPolitica() {
    $("#alertaPoliticaModal").hide();
    var file_data = $('#arquivoPolitica').prop('files')[0];
    var form_data = new FormData($("#form-politica")[0]);
    form_data.append('arquivoPolitica', file_data);
    if (!file_data) {
        $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o arquivo.</strong>';
        $("#politicaMsgModal").html(msg);
    } else {
        $.ajax({
            url: 'cadPoliticaambiental.php',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            beforeSend: function () {

            },
            success: function (retorno) {
                if (retorno.erro) {
                    switch (retorno.erro) {
                        case '1':
                            $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Tamanho do arquivo não pode exceder 30MB.</strong>';
                            $("#politicaMsgModal").html(msg);
                            break;
                        case '2':
                            $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>O formato do arquivo deve ser PDF.</strong>';
                            $("#politicaMsgModal").html(msg);
                            break;
                        case '3':
                            $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Selecione o arquivo.</strong>';
                            $("#politicaMsgModal").html(msg);
                            break;
                    }

                } else {
                    $("#anexarPolitica").hide();
                    $("#listaArquivoPolitica").show();
                    $("#arquivoPol").html(retorno.listaArquivo);


                }
            }
        });
    }
}


function excluirPolitica(idPolitica) {
    if (idPolitica != '') {
        confirmacao(null, "Confirma exclusão?", {
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = "excluir";
                $.ajax({
                    url: 'cadPoliticaambiental.php?dados=' + tipoDados,
                    type: 'post',
                    data: 'idPolitica=' + idPolitica,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    success: function (retorno) {
                        if (retorno.del == '1') {
                            $("#alertaPolitica").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Destinação Sustentável removida com sucesso.</strong>';
                            $("#politicaMsg").html(msg);
                            $("#tr-id" + idPolitica, "#body-politica").remove();
                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })

    }

}

function removerArquivoPolitica(idArquivoPol) {
    if (idArquivoPol != '') {
        tipoDados = "excluirArquivo";
        $.ajax({
            url: 'cadPoliticaambiental.php?dados=' + tipoDados,
            type: 'post',
            data: 'idArquivoPol=' + idArquivoPol,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (retorno) {
                if (retorno != '1') {
                    $("#alertaPoliticaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Arquivo removido com sucesso.</strong>';
                    $("#politicaMsgModal").html(msg);
                    $("#anexarPolitica").show();
                    $("#arquivoPolitica").val(null);
                    $("#listaArquivoPolitica").hide();
                }

            },
            error: function (retorno) {

            }
        });
    }
}

