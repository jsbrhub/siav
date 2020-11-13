$(document).ready(function(){

    $('.bt-popover').popover({
        html: true,
        placement: 'left'
    })

    $( document ).ajaxStart(function() {
        $( ".spin-loader, .spin" ).removeClass("hidden");
    }).ajaxStop(function() {
        $( ".spin-loader, .spin" ).addClass("hidden");
    });

    var classe = $("#classe").val();
    var timeout = 5000;

    $("#radio1").prop("checked",true);
    $("#recSenha").hide();

    /**
     * 
     * Ação Cadastrar
     * 
     * @author luizleao
     */
    $("#btnCadastrar").click(function () {
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'cad'+classe+'.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnCadastrar').button('loading');
            },
            timeout: timeout,
            success: function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Cadastrado com sucesso');
                $('#modalResposta').modal('show');            
            },
            error: function(retorno){
                $('#btnCadastrar').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });

    /**
     * 
     * Ação Editar
     * @author luizleao
     */
    $("#btnEditar").click(function () {
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'edit'+classe+'.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnEditar').button('loading');
            },
            timeout: timeout,
            success: function(retorno){
                $('#btnEditar').button('reset');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Editado com sucesso');
                $('#modalResposta').modal('show');
            },
            error: function(){
                $('#btnEditar').button('reset');
                $('#modalResposta').find('.modal-body').html('Erro!!');
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });
	
    /**
     * 
     * Ação Logar
     * @author luizleao
     */
    $('#btnLogar').click(function(e){
        e.preventDefault();
        var  form = document.getElementById('loginForm');
        $("#cnpj").attr("required",($("input[name='tipoUsuario']:checked").val() != "s"));
        $("#login").attr("required",($("input[name='tipoUsuario']:checked").val() != "e"));

        if(form.reportValidity()) {
            dados = retornaParametros(document.forms[0]);
            $.ajax({
                url: 'resIndex.php',
                type: 'post',
                data: dados,
                dataType: 'html',
                beforeSend: function () {
                    $('#btnLogar').button('loading');
                },
                timeout: timeout,
                success: function (retorno) {
                    $('#btnLogar').button('reset');
                    if (retorno != "0") {
                        switch (retorno){
                            case "1":
                                mensagem = "Login ou Senha Inválido(a)!";
                                break;
                            case "2":
                                mensagem = "Você não tem permissão para acessar esse sistema!";
                                break;
                            default:
                                mensagem= retorno;
                                break;
                        }

                        $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> ' + mensagem);
                        $('#modalResposta').modal('show');
                    } else {
                        window.location = 'principal';
                    }
                },
                error: function (retorno) {
                    $('#btnLogar').button('reset');
                    $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> Erro: ' + retorno);
                    $('#modalResposta').modal('show');
                }
            });
        }
        $('#modalResposta').on('shown.bs.modal', function () {
            $('#modalResposta').find('#btnFechar').focus();

        });
    });
	
    /**
     * 
     * Cadastrar programas ao grupo selecionado
     * @author luizleao
     */
    $('#btnCadastroPrograma').click(function (){
        dados = retornaParametros(document.forms[0]);
        $.ajax({
            url : 'cadGrupoPrograma.php',
            type : 'post',
            data : dados,
            dataType: 'html',
            beforeSend: function(){
                $('#btnCadastroPrograma').button('loading');
            },
            timeout: timeout,
            success: function(retorno){
                $('#btnCadastroPrograma').button('reset');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Cadastrado com sucesso');
                $('#modalResposta').modal('show');
            },
            error: function(retorno){
                $('#btnCadastroPrograma').button('reset');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> '+retorno);
                $('#modalResposta').modal('show');
            }
        });
        $('#modalResposta').on('shown.bs.modal', function (){
            $('#modalResposta').find('#btnFechar').focus();
        });
    });
    
    // Mascaramento de dados
    $('.date').mask('00/00/0000');
    $('.time').mask('00:00:00');
    $('.date_time').mask('00/00/0000 00:00:00');
    $('.cep').mask('00000-000');
    $('.telefone').mask('(00) 0000-0000');
    $('.celular').mask('(00) 00000-0000');
    $('.mixed').mask('AAA 000-S0S');
    $('.cpf').mask('000.000.000-00', {reverse: true});
    $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.money').mask('000.000.000.000.000,00', {reverse: true});
    $('.faturamentoBruto').mask('000.000.000.000.000,00', {reverse: true});
    $('.milhar').mask('000.000.000.000.000.00', {reverse: true});
    $('.mil').mask('000.000.000.000.000', {reverse: true});
    $('.somentenumeros').mask('0#');
    $('.somenteletras').mask('SSSSSSSSSSS');
    if(typeof $(".datepicker").datepicker == "function")
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR',
            orientation: 'left bottom',
            editable: true,
            autoclose: true
        });

    $(".alert > button").click(function(){
        $("#myModalRecuperaSenha").modal("hide");
    });


    /*
    recuperar a senha - tela login
     */
    $('#btnRecuperarSenha').click(function (e){
        e.preventDefault();
        var form = document.getElementById('formRecupera');
        var email = $("#email").val();
        var cnpj = $("#cnpjLogin").val();
        gifLoading = "<img src='img/blocksLoading.gif'/>";
        loagingMsg = 'Enviando...';
        if(($("[name='perfil']:checked").val() == "e" && form.reportValidity()) || ($("[name='perfil']:checked").val() == "r" && email != "" )) {
            $.ajax({
                url: 'emailRecuperaSenha.php',
                type: 'post',
                data: 'perfil='+$("[name='perfil']:checked").val()+'&email=' + email + '&cnpj='+ cnpj,
                dataType: 'html',
                beforeSend: function () {
                    $('#form-email').hide();
                    $('#form-cnpj').hide()
                    $('#form-loading').show();
                },
                complete: function () {
                    $('#form-email').show();
                    $('#form-cnpj').show();
                    $('#form-loading').hide();
                },
                timeout: 15000,
                success: function (retorno) {
                    if (retorno == 0) {
                        $(".alert").addClass("alert-success");
                        $(".alert > h4").html("Sucesso!");
                        mensagem = "Sua nova senha foi enviada para o e-mail cadastrado.";
                    }
                    if(retorno == '1') {
                        $(".alert").addClass("alert-danger");
                        $(".alert > h4").html("Erro!");
                        mensagem = "E-mail ou CNPJ não cadastrado no sistema.";
                    }
                    if(retorno == '2') {
                        $(".alert").addClass("alert-danger");
                        $(".alert > h4").html("Erro!");
                        mensagem = "Digite um CNPJ válido.";
                    }
                    $(".alert").slideDown(200);
                    $("#formRecupera").hide();
                    $(".alert > p").html(mensagem);
                    $("#btnRecuperarSenha").hide();
                    $("#btn-fechar").show();
                },
                error: function (retorno) {
                    $(".alert").addClass("alert-danger").slideDown(200);
                    $("#formRecupera").hide();
                    erro = 'E-mail não cadastrado no sistema.';
                    $(".alert > h4").html("Erro!");
                    $(".alert > p").html(erro);
                    $("#btn-fechar").show();
                }
            });
        }
        $('#myModalRecuperaSenha').on('hidden.bs.modal', function (){
            $("#email").val("");
            $("#cnpjLogin").val("");
            $('#myModalRecuperaSenha').find('#btnFechar').focus();
            $("#formRecupera").show();
            $("#btn-fechar").hide();
            $("#btnRecuperarSenha").show();
            $(".alert").removeClass("alert-danger").removeClass("alert-success").hide();
        });
    });

    /*
     trocar a senha
     */
    $('#btnTrocarSenha').click(function (e){
        console.log("oi");
       // return;
        e.preventDefault();
        var form = document.getElementById('formTrocarSenha');
        var senha = $("#senha").val();
        var novaSenha = $("#password").val();
        var confirmaSenha = $("#confirmPassword").val();
        gifLoading = "<img src='img/blocksLoading.gif'/>";
        loagingMsg = 'Enviando...';
        validacao = 0;

        console.log(senha);
        console.log(novaSenha);
        console.log(confirmaSenha);
        //return;
        if(form.reportValidity()) {
            if(senha == novaSenha || senha == confirmaSenha || senha == novaSenha == confirmaSenha){
                console.log("entrei aqui");
                //return;
                mensagem = "Digite uma senha diferente da atual.";
                $(".alert").slideDown(200);
                $(".alert").addClass("alert-warning");
                $(".alert > h4").html("Atenção!");
                $(".alert > p").html(mensagem);
                $("#btn-fechar").show();
                $("#btnTrocarSenha").show();
                validacao = 1;
            }

            if(novaSenha != confirmaSenha){
                mensagem = "Nova senha e Confirmar Nova Senha não conferem.";
                $(".alert").slideDown(200);
                $(".alert").addClass("alert-warning");
                $(".alert > h4").html("Atenção!");
                $(".alert > p").html(mensagem);
                $("#btn-fechar").show();
                $("#btnTrocarSenha").show();
                validacao = 1;
            }

            if(novaSenha == confirmaSenha){
                if(novaSenha.length < 6){
                    mensagem = "A nova senha dever ter no mínimo 6 caracteres.";
                    $(".alert").slideDown(200);
                    $(".alert").addClass("alert-warning");
                    $(".alert > h4").html("Atenção!");
                    $(".alert > p").html(mensagem);
                    $("#btn-fechar").show();
                    $("#btnTrocarSenha").show();
                    validacao = 1;
                }
            }

            if(validacao == 0) {
                //console.log(form);
                $.ajax({
                    url: 'trocarSenha.php',
                    type: 'post',
                    data: 'senha=' + senha + '&novaSenha=' + novaSenha + '&confirmaSenha=' + confirmaSenha,
                    dataType: 'html',
                    beforeSend: function () {
                        $('#corpoForm').hide();
                        $('#form-carregando').show();
                        // return;
                    },
                    complete: function () {
                        $('#form-carregando').hide();
                    },
                    //timeout: 15000,
                    success: function (retorno) {
                        //console.log(retorno);
                        switch (retorno) {
                            case "0":
                                $(".alert").removeClass("alert-danger").addClass("alert-success");
                                $(".alert > h4").html("Sucesso!");
                                mensagem = "Senha atualizada com sucesso.";
                                $("#btnTrocarSenha").hide();
                                //document.getElementById("formTrocarSenha").reset();
                                $("#corpoForm").hide();
                                break;
                            case "1":
                                $(".alert").removeClass("alert-success").addClass("alert-danger");
                                $(".alert > h4").html("Erro!");
                                $('#corpoForm').show();
                                mensagem = "Senha atual inválida.";
                                $("#btnTrocarSenha").show();
                                break;

                        }
                        $(".alert").slideDown(200);
                        $(".alert > p").html(mensagem);
                        $("#btn-fechar").show();
                    },
                    error: function (retorno) {
                        $(".alert").addClass("alert-danger").slideDown(200);
                        erro = 'Não foi possível atualizar a senha, problemas de conexão.';
                        $(".alert > h4").html("Erro!");
                        $(".alert > p").html(erro);
                        $("#btn-fechar").show();
                        $("#btnTrocarSenha").show();
                    }
                });
            }
        }
        $('#modalTrocarSenha').on('hidden.bs.modal', function (){
            $("#senha").val("");
            $("#password").val("");
            $("#confirmPassword").val("");
            $('#modalTrocarSenha').find('#btnFechar').focus();
            $("#formTrocarSenha").show();
            $("#btn-fechar").show();
            $('#corpoForm').show();
            $("#btnTrocarSenha").show();
            $(".alert").removeClass("alert-danger alert-success").hide();
        });
    });


        switch (window.location.hash.slice(1)){
            case "c1":
                //tipoConsulta(); //coloca função
                break;
            case "c2":
                //tipoConsulta();
                break;
        }



});//document ready

function excluir(campo, valor, objetoTitulo){
    var classe = $("#classe").val();
    var timeout = 5000;
    var titulo = (typeof objetoTitulo != "undefined") ? objetoTitulo : classe;
    
    $('#modalExcluir').modal('show');
    $('#modalExcluir').find('.modal-body').html('Deseja excluir '+ titulo +'?');

    $('#btnSim').click(function () {
        $.ajax({
            url        : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
            type       : 'get',
            beforeSend : function(){
                $('#btnCadastrar').button('loading');
            },
            timeout    : timeout,
            success    : function(retorno){
                $('#modalExcluir').modal('hide');
                $('#modalResposta').find('.modal-body').html((retorno !== '') ? '<img src="img/ico_error.png" /> '+retorno : '<img src="img/ico_success.png" /> Excluido com sucesso');
                $('#modalResposta').modal('show');
                $('#modalResposta').on('hide.bs.modal', function () {
                    window.location = 'adm'+classe+'.php';
                });
            },
            error	   : function(retorno){
                $('#modalExcluir').modal('hide');
                $('#modalResposta').find('.modal-body').html('<img src="img/ico_error.png" /> ERRO: '+retorno);
                $('#modalResposta').modal('show');
            }
        });
    });
}

function recuperaSenha() {
    $('#myModalRecuperaSenha').modal('show');

    $("#rd1").prop("checked", true)


    $("#form-cnpj").show();
    $('#myModalRecuperaSenha').on('shown.bs.modal', function () {
        $('#email').val('');
        // $('#tituloModal').text('Recuperar Senha de Acesso');
    });
}

function trocaSenha() {
    $('#modalTrocarSenha').modal('show');
    $('#modalTrocarSenha').on('shown.bs.modal', function () {
        $('#senha').val('');
        $('#password').val('');
        $('#confirmPassword').val('');
        // $('#tituloModal').text('Recuperar Senha de Acesso');
    });
}

function exibeTipo(tipo) {
    if (tipo == '0'){
        $("#consLancamento").hide();
        $("#resultado").hide();
        $("#legenda").hide();
    }else{
        $("#consLancamento").show();
    }
}

function exibeTipoConsulta(tipo) {
    switch (tipo){
        case "0":
            $("#consLancamento").hide();
            $("#incentVig").hide();
            $("#incentEnc").hide();
            $("#resultado").hide();
            break;
        case "1":
            $("#consLancamento").show();
            $("#incentVig").hide();
            $("#incentEnc").hide();
            $("#resultado").hide();
            break;

        case "2":
            $("#incentVig").show();
            $("#consLancamento").hide();
            $("#incentEnc").hide();
            $("#resultado").hide();
            break;

        case "3":
            $("#incentEnc").show();
            $("#incentVig").hide();
            $("#consLancamento").hide();
            $("#resultado").hide();
            break;
    }
    
}

function consultarLancamento() {
    var tipoConsulta = $("#tipoConsulta").val();
    var empresa = $("#empresa").val();
    //console.log("tipo de consulta - " + tipoConsulta);
    //if(tipoConsulta == '1') {
        if (empresa == '') {
            $(".alert").removeClass("alert-danger alert-warning alert-success").addClass("alert-warning").show();
            erro = '<strong>Digite o CNPJ ou Razão Social.</strong>';
            $(".alert > p").html(erro);
            //$(".alert").removeClass("alert-danger").removeClass("alert-success").hide();
        } else {
            $.ajax({
                url: 'consultaEmpresa.php',
                type: 'get',
                data: 'empresa=' + empresa + '&consulta=' + tipoConsulta,
                beforeSend: function () {
                    //$('#btnCadastrar').button('loading');
                },
                timeout: 50000,
                success: function (retorno) {
                    //console.log("retorno = "+retorno);
                    if (retorno == '1') {
                        $(".alert").removeClass("alert-danger alert-warning alert-success").addClass("alert-danger").show();
                        erro = '<strong>CNPJ Inválido.</strong>';
                        $(".alert > p").html(erro);
                        $('#resultado').hide();
                        $('#legenda').hide();
                    }
                    if (retorno == '2') {
                        $(".alert").removeClass("alert-danger alert-warning alert-success").addClass("alert-warning").show();
                        erro = '<strong>Não foram encontrados registros para essa consulta.</strong>';
                        $(".alert > p").html(erro);
                        $('#resultado').hide();
                        $('#legenda').hide();
                    }
                    if (retorno != '1' && retorno != '2') {
                        $(".alert").hide();
                        $('#legenda').show();
                        $('#resultado').show();
                        $('#resultado').html(retorno);
                    }

                    $('.bt-popover').popover({
                        html: true,
                        placement: 'left'
                    })

                },
                error: function (retorno) {
                    $(".alert").removeClass("alert-danger alert-warning alert-success").addClass("alert-danger").show();
                    erro = '<strong>Não foram encontrados registros para sua pesquisa.</strong>';
                    $(".alert > p").html(erro);
                }
            });
        //}
    }

return false;
    
}

function emConstrucao() {
    $(".alert").removeClass("alert-danger").removeClass("alert-warning").removeClass("alert-success").addClass("alert-info").show();
    erro = '<strong>Em construção.</strong>';
    $(".alert > p").html(erro);
    //$('#resultado').hide();
}

/**
 * @author Marcelo Reis
 * @param {Mixed} campo q será passado ao callback após a ação de confirmação ou cancelamento
 * @param {String} msg a mensagem a ser exibida na caixa de confirmação
 * @param {Object} configs um objeto com atributos de configuração do evento, possiveis atributos ( confirmar_txt, confirmar_class, cancelar_class, cancelar_txt, modal_class, callback_ok, callback_cancel, z_index, titulo )
 * @return {void}
 */
function confirmacao(campo, msg, configs) {


    var opcoes = {
        confirmar_class: "btn-danger",
        cancelar_class: "btn-default",
        confirmar_txt: "ok",
        cancelar_txt: "cancelar",
        titulo: "Confirmação",
        z_index: "1054",
        modal_class: ""
    };

    $.extend(opcoes, configs);

    var modal = $(".modal-confirmacao");

    var btnCancelar = $(".cancelar", modal);

    var btnConfirmar = $(".confirmar", modal);


    btnConfirmar.attr("class", "btn " + opcoes.confirmar_class + " confirmar").text(opcoes.confirmar_txt);

    btnCancelar.attr("class", "btn " + opcoes.cancelar_class + " cancelar").text(opcoes.cancelar_txt);

    modal.css("z-index", opcoes.z_index);


    $(".modal-title", modal).text(opcoes.titulo);

    $(".modal-dialog", modal).attr("class", "modal-dialog " + opcoes.modal_class);

    $(".modal-body", modal).html(msg);

    btnConfirmar.unbind("click");

    btnCancelar.unbind("click");

    if (typeof opcoes.callback_ok == "function") {
        btnConfirmar.bind("click", function () {
            modal.modal("hide");

            btnConfirmar.unbind("click");

            btnCancelar.unbind("click");

            opcoes.callback_ok(campo);
        });
    }

    if (typeof opcoes.callback_cancel == "function") {
        btnCancelar.bind("click", function () {
            opcoes.callback_cancel(campo);

            modal.modal("hide");

            btnConfirmar.unbind("click");

            btnCancelar.unbind("click");
        });
    }


    modal.modal("show");

}



function valida_cpf(cpf){
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    cpf = cpf.replace(/[^\d]+/g,'');
    if (cpf.length < 11)
        return false;
    for (i = 0; i < cpf.length - 1; i++)
        if (cpf.charAt(i) != cpf.charAt(i + 1))
        {
            digitos_iguais = 0;
            break;
        }
    if (!digitos_iguais)
    {
        numeros = cpf.substring(0,9);
        digitos = cpf.substring(9);
        soma = 0;
        for (i = 10; i > 1; i--)
            soma += numeros.charAt(10 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0))
            return false;
        numeros = cpf.substring(0,10);
        soma = 0;
        for (i = 11; i > 1; i--)
            soma += numeros.charAt(11 - i) * i;
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(1))
            return false;
        return true;
    }
    else
        return false;
}

function is_cnpj(c) {
    var b = [6,5,4,3,2,9,8,7,6,5,4,3,2];

    if((c = c.replace(/[^\d]/g,"")).length != 14)
        return false;

    if(/0{14}/.test(c))
        return false;

    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]);
    if(c[12] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;

    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]);
    if(c[13] != (((n %= 11) < 2) ? 0 : 11 - n))
        return false;

    return true;
};