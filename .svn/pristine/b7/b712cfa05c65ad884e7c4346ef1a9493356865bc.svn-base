<?php
$config = parse_ini_file("classes/core/config.ini", true);

session_start();

if(!empty($_REQUEST["code"])){

    require_once "classes/core/class.Util.php";

    require_once "classes/class.LoginUnico.php";

    require_once "classes/class.JwtExtractor.php";

    if(!empty($_SESSION["usuarioLogado"]["id_token"]))
        $tokens = [ "access_token" => $_SESSION["usuarioLogado"]["access_token"], "id_token" => $_SESSION["usuarioLogado"]["id_token"] ];
    else
        $tokens = LoginUnico::requestToken($_REQUEST["code"]);

    if($tokens){

        try{
            $pKeys = LoginUnico::requestPublicKey();

            $userInfo = JwtExtractor::extract($tokens["id_token"], $pKeys);


            $_SESSION["usuarioLogado"] = [
                "nome" => $userInfo["name"],
                "email" => $userInfo["email"],
                "cpf"   => $userInfo["sub"],
                "access_token" => $tokens["access_token"],
                "id_token" => $tokens["id_token"]
            ];

            header("Location: empresas-relacionadas");

        } catch (Exception $e ){
            unset($_SESSION["usuarioLogado"]);
        }
    }
} else {
    session_destroy();

    session_write_close();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once ("includes/headerLogin.php");?>
    <link rel="stylesheet" type="text/css" href="loadback/css/style1.css" />
    <script type="text/javascript" src="loadback/js/modernizr.custom.86080.js"></script>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
        $(document).ready(function () {
            $("#divCNPJ").hide();
            $("#divLoginUnico").hide();
            $("#radio2").click(function () {
                $("#divCNPJ").show();
                $("#divLoginUnico").show();
                $("#recSenha").show();
                $("#divSUDAM").hide();
            });
            $("#radio1").click(function () {
                $("#divCNPJ").hide();
                $("#divLoginUnico").hide();
                $("#divSUDAM").show();
                $("#recSenha").hide();
            });

            $("#rd1").click(function(){
                $("#form-cnpj").show();
            });

            $("#rd2").click(function(){
                $("#form-cnpj").hide();
            });




        });
    </script>
    <style>
        .font-11{
            font-size: 11px;
        }
        .font-12{
            font-size: 12px;
        }
        .panel-default{
            margin-top: 60px;
        }
    </style>
</head>
<body id="page">
<?php require_once("includes/modalResposta.php");?>

<ul class="cb-slideshow" style="list-style-type: none;">
    <li><span>Image 01</span></li>
    <li><span>Image 04</span></li>
</ul>
        <div class="container">
                <div class="login-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <img src="img/logoCORRETA.png" width="68px" height="54px">
                            <span class="font-11"><strong><i>SISTEMA DE AVALIAÇÃO DOS INCENTIVOS FISCAIS DA SUDAM</i></strong></span>
                        </div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" id="loginForm" name="loginForm">
                                <div class="form-group">
                                    <div class="col-sm-3">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="tipoUsuario" id="radio1" value="s"  checked>
                                            <label for="radio1" class="font-12">
                                                SUDAM
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="radio radio-primary">
                                            <input type="radio" name="tipoUsuario" id="radio2" value="e">
                                            <label for="radio2" class="font-12">
                                                EMPRESA</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" id="divSUDAM">
                                    <label for="login" class="col-sm-3 control-label font-12">
                                        Login</label>
                                    <div class="input-group col-sm-8">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control" id="login" name="login" placeholder="Digite o Login"  required oninvalid="setCustomValidity('Digite o Login.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group" id="divCNPJ">
                                    <label for="loginEmpresa" class="col-sm-3 control-label font-12">
                                        CPF/CNPJ: </label>
                                    <div class="input-group col-sm-8">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input type="text" class="form-control " id="cnpj" name="cnpj" placeholder="Digite o CNPJ" required  oninvalid="setCustomValidity('Digite o CPF ou CNPJ.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label font-12"> Senha: </label>
                                    <div class="input-group col-sm-8">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input type="password" class="form-control" id="senha" name="senha" required placeholder="Senha" oninvalid="setCustomValidity('Digite a Senha.')" oninput="setCustomValidity('')">
                                    </div>
                                </div>
                                <div class="form-group last">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button class="btn btn-primary" data-loading-text="Carregando..." name="btnLogar" id="btnLogar" type="submit"><i class="glyphicon glyphicon-log-in"></i>   &nbsp;&nbsp;Entrar</button>
                                        <a onclick="recuperaSenha();" id="recSenha" style="cursor: pointer" ><span style="font-size: 12px">Esqueceu a senha?</span></a>
                                    </div>
                                </div>
                                <div id="divLoginUnico" class="text-center" style="padding: 20px 50px 5px 50px">
                                    <p>outras formas de acesso</p>
                                    <div class="form-group">
                                        <a style="margin-top: 10px; display: inline-block" href="https://sso.<?= $config["login-unico"]["host"]; ?>/authorize?response_type=code&client_id=<?= $config["login-unico"]["client_id"]; ?>&scope=openid+email+phone+profile+govbr_empresa&redirect_uri=<?= urlencode($config["login-unico"]["redirect_uri"]); ?>&nonce=<?= md5(uniqid(time())); ?>"><img style="border-radius: 25px" src="img/gov-br-btn.png"></a>
                                        <p style="font-size: 13px; color: gray; margin-top: 20px">O GovBR é um serviço online de identificação e autenticação digital do cidadão em único meio, para acesso aos diversos serviços públicos digitais.</p>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="panel-footer">
                            <span style="font-size: 10px">© SUDAM - Superintendência do Desenvolvimento da Amazônia</span>
                        </div>
                    </div>
            </div>
        </div>



<div class="modal fade" id="myModalRecuperaSenha" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm font-12 grey" role="document">
        <div class="modal-content">
            <div class="alert" style="display: none;margin-bottom: 0" >
                <button type="button" class="close"  aria-label="Close">×</button>
                <h>Alerta!</h>
                <p>conteudo</p>
            </div>
            <form role="form" onsubmit="return false;" id="formRecupera" name="formRecupera">
                <div class="modal-header">
                    <h5 class="modal-title"> Recuperar Senha de Acesso</h5>
                </div>
                <div class="modal-body">
                    <div id="form-loading" style="display: none"><img src="img/blocksLoading.gif">Enviando...</div>
                    <div class="form-group">
                        <div class="col-md-6">
                            <div class="radio radio-primary" style="padding-left: 10px">
                                <input type="radio" name="perfil" id="rd1"  value="e"  checked>
                                <label for="rd1" class="font-12">Empresa</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="radio radio-primary" style="padding-left: 10px">
                                <input type="radio" name="perfil" id="rd2"  value="r">
                                <label for="rd2" class="font-12">Responsável</label>
                            </div>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div class="form-group" id="form-email">
                        <span class="font-12">Informe o e-mail cadastrado:</span>
                        <input type="email" class="form-control input-sm" id="email" name="email" value="" required oninvalid="setCustomValidity('Digite o e-mail.')" oninput="setCustomValidity('')" />
                    </div>
                    <div class="form-group" id="form-cnpj">
                        <span class="font-12">Informe CNPJ cadastrado:</span>
                        <input type="text" class="form-control input-sm cnpj" id="cnpjLogin" name="cnpjLogin" value=""
                               required oninvalid="setCustomValidity('Digite o CNPJ.')" oninput="setCustomValidity('')" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
                    <button id="btnRecuperarSenha" data-loading-text="Carregando..." type="submit" class="btn btn-primary btn-sm">Enviar</button>
                </div>
            </form>
<!--            <button type="button" id="btn-fechar" class="btn btn-secondary" style="display: none" data-dismiss="modal">Fechar</button>-->
        </div>
    </div>
</div>
    <?php // require_once("includes/footer.php");?>
</body>
</html>