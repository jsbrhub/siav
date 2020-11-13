<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$displayTab = "no-display";
$listaAcionistas = $oControle->getAcionistasByEmpresa($idEmpresa); if($listaAcionistas) $displayTab = '';
$retorno = [];
if($_REQUEST['dados'] == 'acionista'){
    $infoAcionista = $oControle->getAcionista($_REQUEST['idAcionista']);
    $retorno['infoAcionista'] = $infoAcionista;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'cadastro'){
    print ($id = $oControle->cadastraAcionista()) ? "" : $oControle->msg;
    $retorno['id'] = $id;
    $retorno['msg'] =  $oControle->msg;
    $infoAcionista = $oControle->getAcionista($id);
    $retorno['infoAcionista'] = $infoAcionista;
    //Util::trace($infoAcionista);
    if($infoAcionista->cpfCnpj != ''){
        $cpf = $infoAcionista->cpfCnpj;
    } else{
        $cpf = 'Estrangeiro';
    }

    if($infoAcionista->tipoPessoa == "2")
        $botaoradio = '<div class="radio radio-primary radio-inline right"><input type="radio" name="cnpj_padrao" value="'.$infoAcionista->idAcionista.'" > <label>CNPJ atual?</label> </div>';
    else
        $botaoradio = '';

    $itemTabela = '<tr id="tr-id'.$infoAcionista->idAcionista.'">
                    <td data-nome>'.$infoAcionista->nome.'</td>
                    <td data-cpfcnpj>'.$cpf.'</td>
                    <td data-email>'.$infoAcionista->email.'</td>
                    <td data-funcao>'.$infoAcionista->funcao.'</td>
                    <td>
                    <button class="btn btn-primary btn-sm" onclick="addAcionista('.$infoAcionista->idAcionista.')" title="Editar"><i class="glyphicon glyphicon-pencil"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary btn-sm" onclick="excluirAcionista('.$infoAcionista->idAcionista.')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></button>
                    &nbsp;&nbsp;&nbsp;
                    '.$botaoradio.'
                    </td>
            </tr>';
    $retorno['itemTabela'] = $itemTabela;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'edicao'){
    $idAcionista = $oControle->alteraAcionista();
    $retorno["id"] = $idAcionista;
    $retorno["msg"] = $oControle->msg;
    $infoAcionista = $oControle->getAcionista($idAcionista);
    $retorno["infoAcionista"] = $infoAcionista;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'alterarCnpj'){

    if(empty($_POST["idCampanha"])){
        echo json_encode(["success" => false, "msg" => "Houve um problema ao tentar realizar operação, tente novamente mais tarde."]); exit;
    }

    $oAcionista = $oControle->getAcionista($_POST["cnpj_padrao"]);

    $cnpj = Util::limpaCPF_CNPJ($oAcionista->cpfCnpj);

    $oEmpresa = $oAcionista->oEmpresa;

    $voAutenticacaoEmpresa = $oControle->getRowAutenticacaoempresa(["cnpj = '{$cnpj}'"]);

    $oAutenticacaoEmpresaAtual = $oControle->getRowAutenticacaoempresa(["cnpj = '{$oEmpresa->cnpj}'"]);

    if($cnpj != $oEmpresa->cnpj){
        $oAcionistaCheck = $oControle->getRowAcionista(["cpfCnpj = '{$oEmpresa->cnpj}' OR cpfCnpj = '".Util::formataCNPJ($oEmpresa->cnpj)."'"]);

        $acionistaBD = new AcionistaBD();

        if(!$oAcionistaCheck instanceof Acionista){

            $oAcionistaCheck = Util::populate(new Acionista(), [
                "oEmpresa" => $oEmpresa,
                "nome" => $oEmpresa->razaoSocial,
                "cpfCnpj" => Util::formataCNPJ($oEmpresa->cnpj),
                "tipoPessoa" => "2",
                "email" => $oAutenticacaoEmpresaAtual->email,
                "funcao" => "CNPJ Empresa anterior/incorporada",
                "dataHoraAlteracao" => date("Y-m-d H:i:s"),
                "usuarioAlteracao" => $cnpj
            ]);

            $acionistaBD->inserir($oAcionistaCheck);
        } else {
            $oAcionistaCheck->funcao = "CNPJ Empresa anterior/incorporada";

            $oAcionistaCheck->nome = $oEmpresa->razaoSocial;

            $oAcionistaCheck->email =  $oAutenticacaoEmpresaAtual->email;

            $acionistaBD->alterar($oAcionistaCheck);

        }
    }

    if($oEmpresa instanceof Empresa){

        $empresaCampanhaBD = new EmpresacampanhaBD();

        $oEmpresaCamp = $oControle->getRowEmpresacampanha(["empresacampanha.cnpj = '{$oEmpresa->cnpj}'", "campanha.idCampanha = {$_POST["idCampanha"]}"]);

        $oEmpresaCamp->cnpj = $cnpj;

        $empresaCampanhaBD->alterar($oEmpresaCamp);

        #####################################
        $empresaControleBD = new EmpresacontroleBD();

        $oEmpresaControle = $oControle->getRowEmpresacontrole(["empresacontrole.idEmpresa = {$oEmpresa->idEmpresa}", "empresacontrole.idCampanha = {$_POST["idCampanha"]}", "empresacontrole.cnpj = '{$oEmpresa->cnpj}'"]);


        $oEmpresaControle->cnpj = $cnpj;

        $empresaControleBD->alterar($oEmpresaControle);
        #####################################

        $termoResponsabilidadeBD = new TermoresponsabilidadeBD();

        $oTermo = $oControle->getRowTermoresponsabilidade(["termoresponsabilidade.idCampanha = '{$_POST["idCampanha"]}'", "termoresponsabilidade.cnpj = '{$oEmpresa->cnpj}'", "termoresponsabilidade.idEmpresa = {$oEmpresa->idEmpresa}"]);

        $oTermo->cnpj = $cnpj;

        $termoResponsabilidadeBD->alterar($oTermo);

        
        //atualiza todos os responsaveis que estavam com o cnpj antigo
        $oControle->atualizaCnpjResponsaveis($oEmpresa->cnpj, $cnpj);

        //atualiza sessao do usuario q estava logado
        $_SESSION['usuarioAtual']['cnpj'] = $cnpj;

        $_SESSION['usuarioAtual']['login'] = $cnpj;

        $acionistaBD = new AcionistaBD();

        $oControle->limpaCnpjPadraoAcionistas($oEmpresa->idEmpresa);

        $oAcionista->cnpj_padrao = "1";

        $acionistaBD->alterar($oAcionista);

        $voEmpresas = $oControle->getAllEmpresa(["empresa.cnpj = '{$oEmpresa->cnpj}'", "empresa.anoBase = '{$oEmpresa->anoBase}'"]);

        if(is_array($voEmpresas)){

            $empresaBD = new EmpresaBD();

            foreach ($voEmpresas as $ooEmpresa){
                $ooEmpresa->cnpj = $cnpj;

                $empresaBD->alterar($ooEmpresa);
            }
        }

        $retorno["success"] = true;

        $retorno["msg"] = "Operação realizada com sucesso!";

        $retorno["data"] = $oAcionista;
    } else {

        $retorno["success"] = false;

        $retorno["msg"] = "Houve um problema ao realizar a operação, campo CNPJ de Empresa não encontrado!";
    }

    if(!$oAutenticacaoEmpresa instanceof Autenticacaoempresa){
        $autenticacaoBD = new AutenticacaoempresaBD();

        $senha = $oAutenticacaoEmpresaAtual instanceof Autenticacaoempresa ? $oAutenticacaoEmpresaAtual->senha : md5('123456');

        $senhaProv = $oAutenticacaoEmpresaAtual instanceof Autenticacaoempresa ? $oAutenticacaoEmpresaAtual->senhaProv : '123456';

        $email = $oAutenticacaoEmpresaAtual instanceof Autenticacaoempresa ? $oAutenticacaoEmpresaAtual->email : $oAcionista->email;

        $oAutenticacao = Util::populate(new Autenticacaoempresa(), ["cnpj" => $cnpj, "email" => $email, "senha" => $senha, "senhaProv" => $senhaProv]);

        $autenticacaoBD->inserir($oAutenticacao);
    }

    echo json_encode($retorno);

    exit;
}

if($_REQUEST['dados'] == 'excluir'){
    if(!$oControle->excluiAcionista($_REQUEST['idAcionista'])){
        $retorno["msg"] = $oControle->msg;
    }else {
        $retorno["msg"] = "1";
    }
    echo json_encode($retorno);
    exit;
}
?>
<script>
    $(document).ready(function(){
        $(document).on('click', '[name="cnpj_padrao"]', function(){
            var $this = $(this);

            confirmacao(
                $this.val(),
                "Realizando esta ação, o campo <b>CNPJ*</b> da aba <b>Identificação da Empresa</b> será atualizado para este CNPJ, isso implicará em: <br /><br /> <ul style='color: red; padding-left: 25px;'><li class='mt-10'> login de acesso com novo CNPJ</li><li class='mt-10'> Responsaveis existentes vinculados ao novo CNPJ</li><li class='mt-10'> Informações ja preenchidas da campanha atua será vinculada ao novo CNPJ</li></ul><br /><br /><br />deseja continuar com esta ação?",
                {
                    modal_class: "modal-sm",
                    callback_cancel: function () {
                        $this.attr("checked", false);
                    },
                    callback_ok: function(id){
                        $.ajax({
                            url: 'cadAcionista.php?dados=alterarCnpj',
                            type: 'post',
                            data: { cnpj_padrao: id , idCampanha: <?php echo $_GET["idCampanha"] ?> },
                            dataType: 'json',
                            timeout: 50000,
                            success: function (retorno) {
                                $this.attr("checked", true);

                                $("#cnpjEmp").val(retorno.data.cpfCnpj);

                                $("#alertaAcionista").removeClass("alert-warning alert-success").addClass("alert-info").show();
                                $("#acionistaMsg").html(retorno.msg);
                            },
                            error: function (retorno) {
                                $("#alertaAcionista").removeClass("alert-info alert-success").addClass("alert-warning").show();
                                $("#acionistaMsg").html("Ocorreu um problema ao realizar a operação, tente novamente mais tarde.");
                            }
                        });
                    }
                }
            )
        });
    });
</script>
<div class="bg-grey p-10 mt-10 border-radius">
    <div class="row">
        <div class="col-md-10 ">
            <div class="form-group pull-left">
                <button id="addAcionista" class="btn btn-primary btn-sm" onclick="addAcionista(0)"><i class="glyphicon glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
            </div>
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaAcionista()"><span
                            class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaAcionista">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="acionistaMsg"><strong></strong></p>
            </div>
        </div>
    </div>
    <table class="table table-striped font-12 grey <?=$displayTab?>" id="acionistaEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Sócio/Acionista Controlador</th>
            <th>CPF/CNPJ</th>
            <th>E-mail</th>
            <th>Função</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="listaAcionista">
        <?php
        if($listaAcionistas){
            foreach ($listaAcionistas as $acionista){ ?>
                <tr id="tr-id<?=$acionista->idAcionista?>">
                    <td data-nome><?=$acionista->nome?></td>
                    <td data-cpfcnpj><?=($acionista->cpfCnpj == '')? 'Estrangeiro':$acionista->cpfCnpj?></td>
                    <td data-email><?=$acionista->email?></td>
                    <td data-funcao><?=$acionista->funcao?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addAcionista(<?=$acionista->idAcionista?>)" title="Editar"><i class="glyphicon
                    glyphicon-pencil"></i>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary btn-sm" onclick="excluirAcionista(<?=$acionista->idAcionista?>)" title="Excluir"><i class="glyphicon
                        glyphicon-trash"></i>
                        </button>
                        &nbsp;&nbsp;&nbsp;
                        <?php if($acionista->tipoPessoa == "2"){ ?>
                            <div class="radio radio-primary radio-inline right"><input type="radio" <?php if($acionista->cnpj_padrao == "1"){ echo "checked"; } ?> name="cnpj_padrao" value="<?= $acionista->idAcionista; ?>" > <label>tornar CNPJ atual</label> </div>
                        <?php } ?>
                    </td>
                </tr>
            <?php
            }
        }
        ?>

        </tbody>
    </table>
</div>
<div class="modal fade no-display" id="ajudaAcionista" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Acionistas</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaAcionista.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalCadAcionista" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Cadastrar Sócio / Acionista Controlador</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaAcionistaModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="acionistaMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>
                <form role="form" onsubmit="return false;" id="form-acionista" class="">

                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <label for="">Selecione o Tipo de Pessoa *:</label>
                            <div class="form-group">
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="tipoPessoa" data-tipopessoa-1 name="acionista[tipoPessoa]" value="1" onchange="showCpfCnpj(this
                                    .value)" >
                                    <label for="tipoPessoa">Física</label>
                                </div>
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="tipoPessoa" data-tipopessoa-2 name="acionista[tipoPessoa]" value="2" onchange="showCpfCnpj(this
                                    .value)">
                                    <label for="tipoPessoa">Jurídica</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 no-display" id="div-cpjcnpj">
                            <div class="form-group">
                                <label for="cpfCnpj">CPF ou CNPJ *:</label>
                                <input type="text" class="form-control input-sm" id="cpfCnpj" name="acionista[cpfCnpj]"
                                       value="" >
                            </div>

                        </div>
                    </div>
                    <div class="row no-display" id="div-estrangeiro">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <label for="">Estrangeiro *:</label>
                            <div class="form-group">
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="estrangeiro" data-estrangeiro-0 name="acionista[estrangeiro]" value="0" onclick="showPassaporte(this
                                    .value);">
                                    <label for="estrangeiro">Não</label>
                                </div>
                                <div class="radio radio-primary radio-inline">
                                    <input type="radio" id="estrangeiro" data-estrangeiro-1 name="acionista[estrangeiro]" value="1" onclick="showPassaporte
                                    (this.value);">
                                    <label for="estrangeiro">Sim</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 no-display" id="div-passaporte">
                            <div class="form-group">
                                <label for="passaporte">Passaporte *:</label>
                                <input type="text" class="form-control input-sm" id="passaporte" name="acionista[passaporte]"
                                       value="" >
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="contato">Nome do Sócio/Acionista Controlador *:</label>
                                <input type="text" class="form-control input-sm" id="nome" name="acionista[nome]"
                                       value=""  required oninvalid="setCustomValidity('Digite o Nome do Contato.')"
                                       oninput="setCustomValidity('')">
                                <input type="hidden" class="form-control input-sm" id="idAcionista" name="acionista[idAcionista]" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="acionista[idEmpresa]" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="acionista[dataHoraAlteracao]"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="acionista[usuarioAlteracao]"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="email">E-mail *:</label>
                                <input type="email" class="form-control input-sm" id="email" name="acionista[email]"
                                       value=""  required oninvalid="setCustomValidity('Digite o E-mail.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="funcao">Cargo/Função *:</label>
                                <input type="text" class="form-control input-sm" id="funcao" name="acionista[funcao]"
                                       value=""  required oninvalid="setCustomValidity('Digite a Função.')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <button id="btnContato"  type="submit" onclick="cadAcionista(); return false;"
                                        class="btn
                                btn-primary btn-sm">
                                    <span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Salvar</button>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <span class="font-10 pull-right"><strong>* Preenchimento obrigatório.</strong></span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>