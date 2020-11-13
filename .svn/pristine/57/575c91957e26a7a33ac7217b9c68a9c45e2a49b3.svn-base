<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

if ($_GET["token"]) {
    $oResponsaveis = $oControle->getRowResponsaveis([
        "md5(responsaveis.idResponsaveis) = '{$_GET["token"]}'"
    ]);

    if (!$oResponsaveis instanceof Responsaveis) {
        $success = [
            "success" => false,
            "msg" => "Token expirou, ou usuário não existe!"
        ];
    } else {
        if(!empty($oResponsaveis->data_cad_externo)){
            $success = [
                "success" => false,
                "msg" => "Token expirou, ou já foi utilizado!"
            ];
        }
    }

} else {
    $success = [
        "success" => false,
        "msg" => "Token expirou, ou usuário não existe!"
    ];
}


// ================= Edicao do Responsaveis =========================
if ($_POST) {

    $checkCad = $oControle->getRowResponsaveis(["responsavenis.login = '{$_REQUEST["login"]}'"]);

    if($checkCad instanceof Responsaveis){
        $success = [
            "success" => false,
            "msg" => "O Login utilizado já existe na base de dados!"
        ];
    }

    if(strlen($_REQUEST["senha"]) < 6 ){
        $success = [
            "success" => false,
            "msg" => "A Senha deve conter no mínimo 6 caracteres!"
        ];
    }

    if(isset($_FILES["documento"]) && !empty($_FILES["documento"]["name"])){
        $ext = @strtolower(end(explode(".", $_FILES["documento"]["name"])));

        if(!in_array($ext, ["jpg", "jpeg", "pdf", "png"])){
            $success = [
                "success" => false,
                "msg" => "O formato de arquivo enviado não é suportado!"
            ];
        } else {
            $file_name = md5(uniqid(time())).".{$ext}";

            copy($_FILES["documento"]["tmp_name"], "img/responsaveis/".$file_name);

            $_REQUEST["arquivo"] = $file_name;
        }
    } else {
        $success = [
            "success" => false,
            "msg" => "É obrigatório o envio de um documento com foto!"
        ];
    }

    if(!isset($success) ||  $success["success"] != false){

        if(empty($oResponsaveis->data_cad_externo)){
            $_REQUEST["data_cad_externo"] = date("Y-m-d H:i:s");
        }

        if(!empty($_REQUEST["senha"]))
            $_REQUEST["senha"] = md5($_REQUEST["senha"]);
        elseif(!empty($oResponsaveis->senha))
            $_REQUEST["senha"] = $oResponsaveis->senha;

        $_REQUEST["idResponsaveis"] = $oResponsaveis->idResponsaveis;

        $_REQUEST["data_cad_empresa"] = $oResponsaveis->data_cad_empresa;

        $_REQUEST["situacao"] = $oResponsaveis->situacao;

        $_REQUEST["cpf_passaporte"] = str_replace([".", "-", "/"], "", $_REQUEST["cpf_passaporte"]);

        if($oControle->alteraResponsaveis()){
            $success = [
                "success" => true,
                "msg" => "Cadastro concluído com sucesso, você já está apto a acessar o painel administrativo."
            ];


            $oResponsaveis = Util::populate($oResponsaveis, $_REQUEST);

        } else {
            $success = [
                "success" => false,
                "msg" => $oControle->msg
            ];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php"); ?>
    <script>
        $('input[required]').on('invalid', function () {

            if ($(this).data("required-message") != "") {
                this.setCustomValidity($(this).data("required-message"));
            }

        });

        $(document).ready(function () {


        });
    </script>
    <style>
        .bs-callout {
            padding: 20px 20px 10px;
        }

        tr.disabled td {
            text-decoration: line-through;
            color: #d2d2d2;
        }
        .navbar-nav{
            display: none;
        }
    </style>
</head>
<body>
<?php
require_once("includes/modals.php");
include("includes/topo.php");
?>
<div class="container">
    <?php if (is_array($success)): ?>
        <div class="alert alert-<?= $success["success"] ? "success" : "danger"; ?>">
            <?= $success["msg"]; ?>
        </div>
    <?php endif; ?>
    <?php if (($oResponsaveis instanceof Responsaveis) && empty($oResponsaveis->data_cad_externo) ): ?>

        <form role="form" action="" enctype="multipart/form-data" method="post" >
            <div class="mt-10">
                <div class="bs-callout bs-callout-primary bg-grey">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $oResponsaveis->nome; ?>"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cpf_passaporte">CPF:</label>
                                <input type="text" class="form-control cpf" id="cpf_passaporte" name="cpf_passaporte" value="<?php echo Util::formataCPF($oResponsaveis->cpf_passaporte); ?>"/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="rg">RG</label>
                                <input type="text" class="form-control" id="rg" name="rg" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="orgao_expedidor">Orgão Expedidor</label>
                                <input type="text" class="form-control" id="orgao_expedidor" name="orgao_expedidor"
                                       value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cidade">Cidade:</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="estado">Estado:</label>
                                <input type="text" class="form-control" id="estado" name="estado" value=""/>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cep">CEP:</label>
                                <input type="text" class="form-control cep" id="cep" name="cep" value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="endereco">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">email</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></div>
                                    <input type="text" class="form-control" name="email" id="email" value="<?php echo $oResponsaveis->email; ?>"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <input type="text" class="form-control" id="cargo" name="cargo" value=""/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conselho_regional">Conselho Regional</label>
                                <input type="text" class="form-control" id="conselho_regional" name="conselho_regional"
                                       value=""/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="login">Docucmento com foto:</label>
                                <input type="file" class="form-control" id="login" name="documento" />
                                <label><i style="font-size: 11px; color: grey">Formatos permitidos: Bitmap, JPG, JPEG, PNG, PDF</i></label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" value=""/>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input name="idResponsaveis" type="hidden" id="idResponsaveis" value="<?= $oResponsaveis->idResponsaveis; ?>"/>
                        <button data-loading-text="Carregando..." type="submit"  class="btn btn-primary right"> Salvar </button>
                    </div>
                </div>
            </div>
        </form>
        <input type="hidden" value="astro-externo-responsavel" id="classe" />
    <?php else :  ?>
        <div class="text-center">
            <a href="/" class="btn btn-primary">Login</a>
        </div>
    <?php endif;  ?>
</div>
<?php require_once("includes/footer.php") ?>
</body>
</html>