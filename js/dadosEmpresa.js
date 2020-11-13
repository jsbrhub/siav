$(document).ready(function(){
    preencheAbaDadosEmpresa();

    idEmpresa = $("#idEmpresa").val();

    $(".nav > li").click(function (e) {
        if($(this).hasClass("disabled")){
            e.preventDefault();
            return false;
        }
    });

    if(window.location.hash.slice(1) == 'cadastro'){
        $("#alertaEmpresa").show();
        msg = '<strong>Dados Empresa cadastrados com sucesso.</strong>';
        $("#alertaEmpresa > p").html(msg);
        history.pushState('', document.title, window.location.pathname+window.location.search);
    }
    if(window.location.hash.slice(1) == 'edicao'){
        $("#alertaEmpresa").show();
        msg = '<strong>Dados Empresa alterados com sucesso.</strong>';
        $("#alertaEmpresa > p").html(msg);
        history.pushState('', document.title, window.location.pathname+window.location.search);
    }

});//document ready


function carregarNoMapa(endereco) {
    geocoder.geocode({ 'address': endereco + ', Brasil', 'region': 'BR' }, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0]) {
                var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

                $('#latitude').val(latitude);
                $('#longitude').val(longitude);

                var location = new google.maps.LatLng(latitude, longitude);
                marker.setPosition(location);
                map.setCenter(location);
                map.setZoom(16);
            }
        }
    });
}

//preenche aba de empresa pois agora os dados estão vindo direto do sistema SIN
//nao sendo mais necessário a empresa cadastrar novamente os dados
function preencheAbaDadosEmpresa(){
    $.get("getUsuarioLogado.php", function(empresa){
        if(empresa.razaoSocial != undefined){
            if($("#razaoSocial").val() == ""){
                $("#razaoSocial").val(empresa.razaoSocial);
                $("#email").val(empresa.email);
                $("#telefone").val(empresa.telefone);
                $("#endereco").val(empresa.endereco);
                $("#cep").val(empresa.cep);
                $("#bairro").val(empresa.bairro);
                $("#complemento").val(empresa.complemento);
                $("#longitude").val(empresa.longitude);
                $("#latitude").val(empresa.latitude);

                $("#idEmpresaSin").val(empresa.idEmpresa);

                carregarNoMapa(empresa.endereco);
            }

            if(empresa.oMunicipio.uf != ""){
                //preenche UF
                $("#uf").val(empresa.oMunicipio.uf);
                $("option:not(:selected)", "#uf").remove();

                $("#idMunicipio").data("selected", empresa.oMunicipio.idMunicipio);
            }

            if(empresa.oMunicipio.idMunicipio){
                //preenche Municipio
                carregaMunicipio(empresa.oMunicipio.uf,true);
            }
        }


    },'json');
}

function ajudaFinanceiro(){
    $("#ajudaFinanceiro").modal('show');
}

function ajudaDadosEmpresa() {
    $("#ajudaDadosEmpresa").modal('show');
}

function ajudaAcionista() {
    $("#ajudaAcionista").modal('show');
}

function ajudaContato() {
    $("#ajudaContato").modal('show');
}

function ajudaIncentivo() {
    $("#ajudaIncentivo").modal('show');
}

function ajudaMercado() {
    $("#ajudaMercado").modal('show');
}

function ajudaInsumo() {
    $("#ajudaInsumo").modal('show');
}
function ajudaProjeto() {
    $("#ajudaProjeto").modal('show');
}

function ajudaDestinacao() {
    $("#ajudaDestinacao").modal('show');
}

function ajudaDocumentos() {
    $("#ajudaDocumentos").modal('show');
}

function addProdIncentivado(idIncentivoEmpresa) {
    //console.log(idIncentivoEmpresa);
}

function carregaMunicipio(uf, onlySelected) {
    if(!uf){

    }else{
            $.ajax({
                url: 'cadEmpresa.php',
                type: 'post',
                data: 'uf=' + uf +'&dados=municipio',
                beforeSend: function () {
                },
                timeout: 50000,
                success: function (retorno) {

                    var municipio = $("#idMunicipio");

                    municipio.html(retorno).val("");

                    if(municipio.data("selected") != undefined){
                        municipio.val(municipio.data("selected"));

                        //remove as opcoes que forem diferente ao valor que deve estar pre selecionado, previne
                        if(onlySelected === true)
                            $("option:not(:selected)", municipio).remove();
                    }
                },
                error: function (retorno) {
                }
            });
    }
    
}


function addEmpresa() {
    $("#alertaEmpresa").hide();
    dadosEmpresa = $("#form-dadosempresa").serialize();

    var form = document.getElementById('form-dadosempresa');
    var idEmpresa = $("#idEmpresa").val();
    var idCampanha = $("#idCampanha").val();
    var cep = $("#cep").val();
    var cnpjMatriz = $("#cnpjMatriz").val();

    if(!idEmpresa){tipoDados = "cadastro";}else{tipoDados="edicao";}
    if(cnpjMatriz != ''){
        if(!is_cnpj(cnpjMatriz)){
            form = '';
            $("#alertaEmpresa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>CNPJ inválido.</strong>';
            $("#alertaEmpresa > p").html(msg);
        }
    }


    if(cep != '') {

        var cep = cep.replace(/\D/g, '');
        if (cep != "") {
            var validacep = /^[0-9]{8}$/;
            if (validacep.test(cep)) {
                //Consulta o webservice viacep.com.br/
                $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

                    if ((dados.erro == true)) {
                        form = '';
                        $("#alertaEmpresa").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>CEP inválido.</strong>';
                        $("#alertaEmpresa > p").html(msg);
                    } else {
                        if (form != '' && form.reportValidity()) {
                            $.ajax({
                                url: 'cadEmpresa.php?dados=' + tipoDados + '&idCampanha=' + idCampanha,
                                type: 'post',
                                data: dadosEmpresa,
                                dataType: 'json',
                                beforeSend: function () {
                                    $("#div-carregando").show();
                                },
                                timeout: 50000,
                                success: function (retorno) {
                                        if (retorno.infoEmpresa != '') {
                                            $("#div-carregando").hide();
                                            window.location = "empresaCad.php?idCampanha=" + idCampanha + '#' + tipoDados;
                                            location.reload();
                                        }
                                },
                                error: function (retorno) {

                                }
                            });

                        }
                    }
                });
            }

        }
    }
}




function addContato(idContatoEmpresa) {
    if(idContatoEmpresa!='0') {
        tipoDados = "contato";
        $.ajax({
            url: 'cadContatoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idContatoEmpresa='+idContatoEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.infoContato != ''){
                    $("#modalCadContato").modal("show");
                    $("#idContatoEmpresa","#form-contato").val(retorno.infoContato.idContatoEmpresa);
                    $("#idEmpresa","#form-contato").val(retorno.infoContato.oEmpresa.idEmpresa);
                    $("#contato","#form-contato").val(retorno.infoContato.contato);
                    $("#funcao","#form-contato").val(retorno.infoContato.funcao);
                    $("#telefone","#form-contato").val(retorno.infoContato.telefone);
                    $("#email","#form-contato").val(retorno.infoContato.email);
                }

            },
            error: function (retorno) {

            }
        });
    }else{
        $("#idContatoEmpresa", "#form-contato").val('');

        idEmpresa = $("#idEmpresa","#form-contato").val();
        tipoDados = "quantidade";
        $.ajax({
            url: 'cadContatoempresa.php?dados='+tipoDados,
            type: 'post',
            data: 'idEmpresa='+idEmpresa,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                $("#modalCadContato").modal("show");
                if(retorno.quantidade >= 5){
                    $("#form-contato").hide();
                    $("#alertaContatoModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>Você deve cadastrar no máximo 5 contatos.</strong>';
                    $("#contatoMsgModal").html(msg)
                }else{
                    $("#alertaContato").hide();
                    $("#alertaContatoModal").hide();
                    $("#form-contato").show();
                    document.getElementById("form-contato").reset();
                }


            },
            error: function (retorno) {

            }
        });



    }
}

function aceitarTermo() {
    $("#btnAceitar").attr("disabled", !$("#aceito").is(":checked"));
}

function confirmaTermo() {
    aceito = $("#aceito").is(":checked");
    idCampanha = $("#idCampanha").val();
    tipoDados = "cadastro";
    dadosTermo = $("#termoResponsabilidade").serialize();
   // console.log(dadosTermo);
    if(aceito){

        $("#btnAceitar").attr("disabled", true);

        $.ajax({
            url: 'cadTermoresponsabilidade.php?dados='+tipoDados,
            type: 'post',
            data: dadosTermo,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
                if(retorno.id != ''){
                    window.location = "empresaCad.php?idCampanha="+idCampanha;
                }

                $("#btnAceitar").attr("disabled", false);
            },
            error: function (retorno) {

            }
        });
    }
}

function termoResponsabilidade(status,idCampanha) {
    if(status == '0'){ //vai ter que aceitar o termo
        $("#aceito").attr("checked",false);
        $("#btnAceitar").attr("disabled");
        $("#idCampanha","#termoResponsabilidade").val(idCampanha);
        $("#modalTermoResponsabilidade").modal('show');
    }
    if(status == '1'){ //direciona pra tela de cadastro (iniciado)
        window.location = "empresaCad.php?idCampanha="+idCampanha;
    }
}

function cadContato() {
    idContatoEmpresa = $("#idContatoEmpresa").val();
    $("#alertaContato").hide();
    dadosContato = $("#form-contato").serialize();
    var form = document.getElementById('form-contato');
    if(idContatoEmpresa == ''){tipoDados = "cadastro";} else{tipoDados = "edicao";}
    //console.log(idContatoEmpresa);
    if(form.reportValidity()) {
        $.ajax({
            url: 'cadContatoEmpresa.php?dados='+tipoDados,
            type: 'post',
            data: dadosContato,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {

                if(retorno != ''){
                    if(tipoDados == 'cadastro') {
                        $("#modalCadContato").modal("hide");
                        $("#contatosEmpresa").show();
                        $("#listaContato").append(retorno.itemTabela);
                        $("#alertaContato").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Contato cadastrado com sucesso.</strong>';
                        $("#contatoMsg").html(msg);
                    }
                    if(tipoDados == 'edicao'){
                        //console.log(retorno);
                        $("#modalCadContato").modal("hide");
                         $("[data-contato]", "#tr-id"+retorno.id).html(retorno.infoContato.contato);
                         $("[data-funcao]", "#tr-id"+retorno.id).html(retorno.infoContato.funcao);
                         $("[data-email]", "#tr-id"+retorno.id).html(retorno.infoContato.email);
                         $("[data-telefone]", "#tr-id"+retorno.id).html(retorno.infoContato.telefone);
                        $("#alertaContato").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Contato alterado com sucesso.</strong>';
                        $("#contatoMsg").html(msg);


                    }
                }

            },
            error: function (retorno) {

            }
        });

    }

}

function excluirContato(idContatoEmpresa) {
    if(idContatoEmpresa != ''){
        confirmacao(null,"Confirma exclusão?",{
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = "excluir";
                $.ajax({
                    url: 'cadContatoempresa.php?dados='+tipoDados,
                    type: 'post',
                    data: 'idContatoEmpresa='+idContatoEmpresa,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    timeout: 50000,
                    success: function (retorno) {
                        //console.log(retorno);
                        if(retorno != ''){
                            $("#tr-id"+idContatoEmpresa).remove();
                            $("#alertaContato").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Contato excluído com sucesso.</strong>';
                            $("#contatoMsg").html(msg);

                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })

    }
}

function showPassaporte(val) {
    if(val == '0'){
        $("#div-passaporte").hide();
    }
    if(val == '1'){
        $("#div-passaporte").show();
    }
}

function showCpfCnpj(val) {
    cpfCnpj = $("#cpfCnpj").val();

    if(val == '1'){

        $("#div-cpjcnpj").show();
        $("#div-estrangeiro").show();
        $("#cpfCnpj").val($("#cpfCnpj").data("cpf")==undefined ? "" : $("#cpfCnpj").data("cpf"));
        $('#cpfCnpj').mask('000.000.000-00', {reverse: true});
    }

    if(val == '2'){
        $("#div-cpjcnpj").show();
        $("#div-estrangeiro").hide();
        $("#cpfCnpj").val($("#cpfCnpj").data("cnpj")==undefined ? "" : $("#cpfCnpj").data("cnpj"));
        $('#cpfCnpj').mask('00.000.000/0000-00', {reverse: true});
    }
}

function addAcionista(idAcionista) {
    $("#alertaAcionista").hide();
    $("#alertaAcionistaModal").hide();
    $("#div-cpjcnpj").hide();
    $("#div-estrangeiro").hide();

    if(idAcionista !='0') {
        tipoDados = "acionista";
        $.ajax({
            url: 'cadAcionista.php?dados='+tipoDados,
            type: 'post',
            data: 'idAcionista='+idAcionista,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                $("#cpfCnpj").data("cpf",'');
                $("#cpfCnpj").data("cnpj",'');
            //salva no campo cfpCnpj o valor do usuario selecionado
            $("#cpfCnpj").data(retorno.infoAcionista.tipoPessoa == 1 ? "cpf" : "cnpj", retorno.infoAcionista.cpfCnpj);

            //console.log(retorno);
                if(retorno.infoAcionista != ''){

                    $("#idAcionista","#form-acionista").val(retorno.infoAcionista.idAcionista);
                    $("#idEmpresa","#form-acionista").val(retorno.infoAcionista.oEmpresa.idEmpresa);
                    $("#nome","#form-acionista").val(retorno.infoAcionista.nome);
                    $("#email","#form-acionista").val(retorno.infoAcionista.email);
                    $("#funcao","#form-acionista").val(retorno.infoAcionista.funcao);
                    if(retorno.infoAcionista.estrangeiro == '1'){
                        $("#div-estrangeiro").show();
                        $("#estrangeiro:checked").val();
                        $("#div-passaporte").show();
                        $("#passaporte","#form-acionista").val(retorno.infoAcionista.passaporte);

                    }else{
                        $("#div-passaporte").hide();
                    }

                    if(retorno.infoAcionista.tipoPessoa == '2'){
                        $("#div-estrangeiro").hide();
                        $("#div-passaporte").hide();
                    }
                    if(!retorno.infoAcionista.cpfCnpj){
                        $("#div-cpjcnpj").hide();
                    }else{
                        $("#div-cpjcnpj").show();
                    }

                    $("#cpfCnpj","#form-acionista").val(retorno.infoAcionista.cpfCnpj);
                    $("[data-tipopessoa-"+retorno.infoAcionista.tipoPessoa+"]","#form-acionista").prop("checked",true);
                    $("[data-estrangeiro-"+retorno.infoAcionista.estrangeiro+"]","#form-acionista").prop("checked",true);
                    $("#email","#form-acionista").val(retorno.infoAcionista.email);
                    $("#modalCadAcionista").modal("show");
                }

            },
            error: function (retorno) {

            }
        });
    }else{
        $("#nome","#form-acionista").val('');
        $("#email","#form-acionista").val('');
        $("#cpfCnpj","#form-acionista").val('');
        $("#funcao","#form-acionista").val('');
        $("#passaporte","#form-acionista").val('');
        $("input[type='radio']","#form-acionista").prop("checked",false);
        $("#modalCadAcionista").modal("show");
    }
}

function cadAcionista() {
    var form = document.getElementById('form-acionista');
    idAcionista = $("#idAcionista").val();
    $("#alertaAcionista").hide();
    dadosAcionista = $("#form-acionista").serialize();
    estrangeiro = $("#estrangeiro:checked").val();
    passaporte = $("#passaporte").val();
    cpfCnpj = $("#cpfCnpj").val();
    tipoPessoa = $("#tipoPessoa:checked").val();
    //console.log(passaporte);
   // console.log(estrangeiro);
    if(idAcionista == ''){tipoDados = "cadastro";} else{tipoDados = "edicao";}
    if(estrangeiro == '1' && passaporte == ''){
        form = '';
        $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Digite o Passaporte.</strong>';
        $("#acionistaMsgModal").html(msg);
    }
    if(!tipoPessoa){
        form = '';
        $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
        msg = '<strong>Selecione o Tipo Pessoa.</strong>';
        $("#acionistaMsgModal").html(msg);
    }

    if(tipoPessoa == '1'){
        if(estrangeiro == '1') {
            if(cpfCnpj != '') {
                if (!valida_cpf(cpfCnpj)) {
                    form = '';
                    $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>CPF inválido.</strong>';
                    $("#acionistaMsgModal").html(msg);
                }
            }
        }else{
            if(cpfCnpj == '') {
                form = '';
                $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>Digite o CPF.</strong>';
                $("#acionistaMsgModal").html(msg);
            }else{
                if (!valida_cpf(cpfCnpj)) {
                    form = '';
                    $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                    msg = '<strong>CPF inválido.</strong>';
                    $("#acionistaMsgModal").html(msg);
                }
            }

        }
    }
    if(tipoPessoa == '2'){
        if(cpfCnpj == ''){
            form = '';
            $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
            msg = '<strong>Digite o CNPJ.</strong>';
            $("#acionistaMsgModal").html(msg);
        }else{
            if(!is_cnpj(cpfCnpj)){
                form = '';
                $("#alertaAcionistaModal").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                msg = '<strong>CNPJ inválido.</strong>';
                $("#acionistaMsgModal").html(msg);
            }
        }

    }

    if(form != '' && form.reportValidity()) {
        $.ajax({
            url: 'cadAcionista.php?dados='+tipoDados,
            type: 'post',
            data: dadosAcionista,
            dataType: 'json',
            beforeSend: function () {
            },
            timeout: 50000,
            success: function (retorno) {
                //console.log(retorno);
               //return;
                if(retorno != ''){
                    if(tipoDados == 'cadastro') {
                        $("#modalCadAcionista").modal("hide");
                        $("#acionistaEmpresa").show();
                        $("#listaAcionista").append(retorno.itemTabela);
                        $("#alertaAcionista").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Sócio/Acionista Controlador cadastrado com sucesso.</strong>';
                        $("#acionistaMsg").html(msg);
                    }
                    if(tipoDados == 'edicao'){
                        $("#modalCadAcionista").modal("hide");
                        $("[data-nome]", "#acionistaEmpresa #tr-id"+retorno.id).html(retorno.infoAcionista.nome);
                        $("[data-cpfcnpj]", "#acionistaEmpresa #tr-id"+retorno.id).html(retorno.infoAcionista.cpjCnpj);
                        $("[data-email]", "#acionistaEmpresa #tr-id"+retorno.id).html(retorno.infoAcionista.email);
                        $("[data-funcao]", "#acionistaEmpresa #tr-id"+retorno.id).html(retorno.infoAcionista.funcao);

                        if(retorno.infoAcionista.tipoPessoa == "2"){
                            $("td:last-child", "#acionistaEmpresa #tr-id"+retorno.id).append('<div class="radio radio-primary radio-inline right"><input type="radio" name="cnpj_padrao" value="'+retorno.infoAcionista.idAcionista+'" > <label>tornar CNPJ atual</label> </div>');
                        } else {
                            $("td:last-child div.radio", "#acionistaEmpresa #tr-id"+retorno.id).remove();
                        }



                        $("#alertaAcionista").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                        msg = '<strong>Sócio/Acionista Controlador alterado com sucesso.</strong>';
                        $("#acionistaMsg").html(msg);
                    }
                }

            },
            error: function (retorno) {

            }
        });

    }
}

function excluirAcionista(idAcionista) {
    if(idAcionista != ''){

        confirmacao(null,"Confirma exclusão?",{
            confirmar_txt: "Sim",
            cancelar_txt: "Não",
            modal_class: "modal-sm",
            confirmar_class: 'btn-sm btn-success',
            cancelar_class: 'btn-sm btn-danger',
            callback_ok: function () {
                tipoDados = "excluir";
                $.ajax({
                    url: 'cadAcionista.php?dados='+tipoDados,
                    type: 'post',
                    data: 'idAcionista='+idAcionista,
                    dataType: 'json',
                    beforeSend: function () {
                    },
                    timeout: 50000,
                    success: function (retorno) {
                        //console.log(retorno);
                        if(retorno != ''){
                            $("#acionistaEmpresa #tr-id"+idAcionista).remove();
                            $("#alertaAcionista").removeClass("alert-info").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
                            msg = '<strong>Sócio/Acionista Controlador excluído com sucesso.</strong>';
                            $("#acionistaMsg").html(msg);

                        }

                    },
                    error: function (retorno) {

                    }
                });
            }
        })


    }
}
