<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <style>
        .font-12 {
            font-size: 12px;
        }

        .box-grey {
            padding: 10px 15px;
            background: #efefef;
        }

        ol {
            padding-left: 20px;
        }

        .ph-30 {
            padding: 30px 15px;
        }

        .mt-20 {
            margin-top: 22px;
        }

        .mt-10 {
            margin-top: 10px;
        }

        #base64_div {
            display: none;
        }
    </style>
    <script>
        $(document).ready(function () {
            $("#code").keyup(function(){

                if($(this).val() != "")
                    $("#acessar-btn").attr("href", "http://siav-homol.sudam.intra/index-lu?code=" + $(this).val());
            });

            $("#acessar-btn").click(function(e){
                if($(this).attr("href") == "#"){
                    alert("campo código não pode ser vazio")

                    e.preventDefault();

                    return false;
                }
            })

            $(".copiar-encode").click(function () {
                $("#base64_result").select();

                setTimeout(function () {
                    if (document.execCommand("copy") === true) {
                        alert("Copiado com sucesso!");
                    }
                }, 500);
            });

            $("#convert_base64").click(function () {
                if ($("#client_id").val() == "" || $("#secret").val() == "") {
                    alert("preencha os campos CLIENT_ID e SECRET");

                    $("#base64_div").hide();

                    return;
                }

                $.post("base64_encode.php", {
                    client_id: $("#client_id").val(),
                    secret: $("#secret").val()
                }, function (r) {
                    $("#base64_result").val(r);

                    $("#base64_div").show();
                })
            });


        })
    </script>
    <style>
        .content {
            padding: 0 15px;
        }
    </style>
</head>
<body>
<div class="box-grey ph-30">
    <h5>Integração - Login Único SIN</h5>
</div>
<br/>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <ol>
                <li>acesse o link:
                    <div class="form-group">
                        <div class="input-group">
                            <a target="_blank"
                               href="https://sso.staging.acesso.gov.br/authorize?response_type=code&client_id=siav.sudam.gov.br&scope=openid+email+phone+profile+govbr_empresa&redirect_uri=http%3A%2F%2Fsiav.sudam.gov.br&nonce=<?= md5(uniqid(time())) ?>&state=<?= time() ?>">
                                acesso SIAV </a>

                        </div>
                    </div>
                </li>
                <li>
                    Na tela de Login do link acima (GOVBR) podem ser utilizadas as credenciais a seguir:
                    <div class="row">
                        <div class="col-md-4 box-grey font-12">
                            (Possui apenas um CNPJ vinculado)
                            <br/>
                            CPF: 682.564.070-42
                            <br/>
                            Senha: #Inmetro902
                        </div>
                        <div class="col-md-4 box-grey font-12">
                            (Possui três CNPJs vinculados)
                            <br/>
                            CPF: 208.219.224-59
                            <br/>
                            Senha: !Q2w3e4r
                        </div>
                        <div class="col-md-4 box-grey font-12">
                            (Possui os selos de confiabilidade)
                            <br/>
                            CPF: 92170340025
                            <br/>
                            Senha: 12345678
                        </div>
                    </div>
                </li>
                <li>
                    A página será redirecionada para a tela inicial do sistema <br/> copie o valor do parametro
                    <i>code</i> existente na url ex: http://sin.sudam.gov.br/?code=<b>ta1dVc</b> e cole no campo abaixo.
                    <div class="row">
                        <div class="col-md-4">
                            <input class="form-control" id="code"/>
                        </div>
                    </div>
                </li>
                <li>
                    clique em acessar
                    <div class="row">
                        <div class="col-md-4">
                            <a id="acessar-btn" target="_blank" href="#" class="btn btn-primary">acessar</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="form-group">
                        <label>Logoff</label><br/>
                        <a target="_blank"
                           href="https://sso.staging.acesso.gov.br/logout?post_logout_redirect_uri=http://siav.sudam.gov.br">logoff
                            SIAV</a>
                    </div>
                </li>
            </ol>
            <br/>
            <br/>
            <br/>
            <div style="text-align: center; width: 100%">
                <div class="box-grey" style="width: 50%; border-radius: 5px; margin-left: calc(50% - 340px)">
                    Insira o <b>client_id</b> e o <b>secret</b> respectivamente em cada campo a abaixo e em seguida
                    clique em converter base64
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>CLIENT_ID</span>
                                <input id="client_id" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <span>SECRET</span>
                                <input id="secret" type="text" class="form-control"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary mt-20" id="convert_base64">converter base64
                            </button>
                        </div>
                    </div>
                    <div class="row" id="base64_div">
                        <div class="col-md-12">
                            <div class="box-grey mt-10">
                                os dados foram convertidos para o padrão base64 no seguinte formato:
                                base64(CLIENT_ID:SECRET) o resultado está abaixo<br/>
                                <div class="input-group">
                                    <input readonly id="base64_result" class="form-control font-12"/>
                                    <button type="button" class="btn btn-default copiar-encode"><i
                                                class="fa fa-copy"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
</html>