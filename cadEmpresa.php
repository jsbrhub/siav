<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$idCampanha = $_REQUEST['idCampanha'];
if($_REQUEST['dados'] == 'municipio'){
    $listaMunicipio = $oControle->getMunicipioByUf($_REQUEST['uf']);
    if($listaMunicipio){
        ($idMunicipio == $municipio->idMunicipio)? $selected ="selected" : $selected = "";
        echo '<option value="">Selecione</option>';
        foreach ($listaMunicipio as $municipio){
            echo '<option value="'.$municipio->idMunicipio.'"'.$selected.'>'.$municipio->municipio.'</option>';
        }
    }
    exit;
}

if($_REQUEST['dados'] == 'cadastro'){

        $verificaCadastro = $oControle->verificaEmpresaCampanhaSituacao($idCampanha, $_SESSION['usuarioAtual']['cnpj']);

        if (!$verificaCadastro) {
            print ($id = $oControle->cadastraEmpresa()) ? "" : $oControle->msg;
            //$retorno["msg"] = $oControle->msg;


            //repassa os dados da empresa recebida do SIN para o cadastro que esta sendo gerado
            if(!empty($_POST["empresa"]["idEmpresaSin"])){

                $idEmpreasSIN = $_POST["empresa"]["idEmpresaSin"];

                $oContatos = $oControle->getAllContatoempresa(["empresa.idEmpresa = {$idEmpreasSIN}"]);

                if(is_array($oContatos)){

                    $contatoBD = new ContatoempresaBD();

                    foreach ($oContatos as $oContato) {
                        $oContato->oEmpresa = new Empresa($id);
                        $contatoBD->alterar($oContato);
                    }
                }

                $voAcionistas = $oControle->getAllAcionista(["empresa.idEmpresa = {$idEmpreasSIN}"]);

                if(is_array($voAcionistas)){

                    $acionistasBD = new AcionistaBD();

                    foreach ($voAcionistas as $oAcionista) {
                        $oAcionista->oEmpresa = new Empresa($id);
                        $acionistasBD->alterar($oAcionista);
                    }
                }

            }

            $retorno["id"] = $id;
            $retorno["idCampanha"] = $idCampanha;
            $infoEmpresa = $oControle->getEmpresa($id);
            //$novoemail = $infoEmpresa->email;
            //$oControle->updateEmail($cnpj,$email);
            $cnpj = $infoEmpresa->cnpj;
            $retorno["infoEmpresa"] = $infoEmpresa;
            $oControle->updateIdEmpresaTermo($idCampanha, $cnpj, $id); //atualiza idEmpresa do Termo
            $oControle->updateStatusEmpresaCampanha($idCampanha, $cnpj, '2'); //atualiza o status do cadastro dessa empresa na tabela empresaCampanha

            $POST_empresaControle = ['oCampanha' => new Campanha($idCampanha), 'oEmpresa' => new Empresa($id), 'cnpj' =>
                $cnpj, 'status' => '1', 'dataInsercao' => date("Y-m-d H:i:s")];
            $oEmpresacontroleBD = new EmpresacontroleBD();
            $oEmpresacontrole = Util::populate(new Empresacontrole(), $POST_empresaControle);
            $oEmpresacontroleBD->inserir($oEmpresacontrole); //insere na tab. controle

            $listaIncentivos = $oControle->getIncentivosByCnpjVigenciaCadastro($cnpj, 1);
            $dataHoraAlteracao = date("Y-m-d h:i:s");
            $usuarioAlteracao = $_SESSION['usuarioAtual']['login'];
            if ($listaIncentivos) {
                foreach ($listaIncentivos as $incentivo) {
                    $oIncentivoEmpresa = ['oEmpresa' =>new Empresa($id),'oIncentivos' => new Incentivos($incentivo->oIncentivos->idIncentivo),'oModalidade' => new Modalidade($incentivo->oModalidade->idModalidade), 'produtoIncentivado' => addslashes($incentivo->produtoIncentivado), 'fonteOrigem' => 'WEB','cnpj' =>  $usuarioAlteracao, 'vigente' => '1', 'dataHoraAlteracao' => $dataHoraAlteracao, 'usuarioAlteracao' =>$usuarioAlteracao];
                    $postIncentivoEmpresa = Util::populate(new Incentivoempresa(),$oIncentivoEmpresa);
                    $IncentivoEmpresaBD = new IncentivoempresaBD();
                    $idIncentivoEmpresa = $IncentivoEmpresaBD->inserir($postIncentivoEmpresa);
                    $MercadoconsumidorBD = new MercadoconsumidorBD();
                    $POST_Mercadoconsumidor = ['oIncentivoempresa' => new Incentivoempresa($idIncentivoEmpresa)];
                    $oMercadoconsumidor = Util::populate(new Mercadoconsumidor(), $POST_Mercadoconsumidor);
                    $MercadoconsumidorBD->inserir($oMercadoconsumidor);
                }
            }
            $listaInsumos = $oControle->getListaBasicaInsumos(); //alterar para listabasica
            if ($listaInsumos)
                foreach ($listaInsumos as $insumo) {
                    $idInsumo = $insumo->idInsumo;
                    $OrigeminsumosBD = new OrigeminsumosBD();
                    $POST_OrigemInsumos = ['oInsumos' => new Insumos($idInsumo), 'oEmpresa' => new Empresa($id)];
                    $oOrigeminsumos = Util::populate(new Origeminsumos(), $POST_OrigemInsumos);
                    $OrigeminsumosBD->inserir($oOrigeminsumos);
                }

            $listaArquivos = $oControle->getListaBasicaTipoArquivoEmpresa(); //alterar para listabasica
            if ($listaArquivos)
                foreach ($listaArquivos as $arquivo) {
                    $idTipoArquivo = $arquivo->idTipoArquivo;
                    $ArquivoempresaBD = new ArquivoempresaBD();
                    $Arquivoempresa_POST = ['oEmpresa' => new Empresa($id), 'oTipoarquivo' => new Tipoarquivo($idTipoArquivo), 'nomeArquivo' =>
                        '', 'novoNome' => '', 'descricao' => $arquivo->formato, 'dataHoraAlteracao' => date("d/m/Y H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                    // Util::trace($Arquivoempresa_POST,false);
                    $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
                    $idArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);
                }


            $infoEmpresa = $oControle->getEmpresa($id);
            $retorno['infoEmpresa'] = $infoEmpresa;
            echo json_encode($retorno);
            exit;
        }
}

if($_REQUEST['dados'] == 'edicao'){

    if(!$idEmpresa = $oControle->alteraEmpresa()){
        $retorno["msg"] = $oControle->msg;
    }
    $retorno ["id"] = $idEmpresa;
    $infoEmpresa = $oControle->getEmpresa($idEmpresa);
    $retorno['infoEmpresa'] = $infoEmpresa;
    $checaControle = $oControle->getControleByIdEmpresa($idEmpresa);
    if($checaControle)$idEmpresaControle = $checaControle->idEmpresaControle;
    $oControle->updateDataAlteracao($idEmpresaControle);
    echo json_encode($retorno,JSON_UNESCAPED_UNICODE);
    exit;

}


?>
<div id="dadosEmpresa" class="mt-10 border-radius bg-grey p-10 grey">
<form role="form" onsubmit="return false;" id="form-dadosempresa" class="">
    <div class="row">
        <div class="col-md-12">
        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaEmpresa">
            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
            <p class="font-12"><strong><?=$msg?></strong></p>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="cnpjEmp">CNPJ*:</label>
                <input type="text" class="form-control input-sm" id="cnpjEmp" name="cnpjEmp"
                       value="<?=Util::formataCNPJ($cnpj)?>" disabled>
                <input type="hidden" class="form-control input-sm" id="cnpj" name="empresa[cnpj]" value="<?=$cnpj?>">
                <input type="hidden" class="form-control input-sm" id="idEmpresaSin" name="empresa[idEmpresaSin]" />
                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="empresa[idEmpresa]" value="<?=$idEmpresa?>">
                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="empresa[idSituacao]"
                       value="<?=$idSituacao?>">
                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="empresa[idIncentivo]"
                       value="<?=$idIncentivo?>">
                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="empresa[idModalidade]"
                       value="<?=$idModalidade?>">
                <input type="hidden" class="form-control input-sm" id="situacaoCadastro" name="empresa[situacaoCadastro]"
                       value="1">
                <input type="hidden" class="form-control input-sm" id="fonteOrigem" name="empresa[fonteOrigem]"
                       value="WEB">
                <input type="hidden" class="form-control input-sm" id="vigente" name="empresa[vigente]"
                       value="1">
                <input type="hidden" class="form-control input-sm" id="anoVigencia" name="empresa[anoVigencia]"
                       value="<?=$anoVigencia?>">
                <input type="hidden" class="form-control input-sm" id="anoAprovacao" name="empresa[anoAprovacao]"
                       value="<?=$anoAprovacao?>">
                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="empresa[dataHoraAlteracao]"
                       value="<?=date("d/m/Y H:i:s")?>">
                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="empresa[usuarioAlteracao]"
                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                <input type="hidden" class="form-control input-sm" id="idCampanha" name="idCampanha"
                       value="<?=$idCampanha?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="anoBaseEmp">Ano Base*:</label>
                <input type="text" class="form-control input-sm" id="anoBaseEmp" name="anoBaseEmp"
                       value="<?=$anoBase?>" disabled>
                <input type="hidden" class="form-control input-sm" id="anoBase" name="empresa[anoBase]"
                       value="<?=$anoBase?>" >
            </div>
        </div>
        <div class="col-md-4">
        </div>
        <div class="col-md-2 ">
            <div class="form-group pull-right">
                <a class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaDadosEmpresa();return
                false;"><span class="glyphicon glyphicon-info-sign font-22"></span></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="razaoSocial">Razão Social*:</label>
                <input type="text" class="form-control input-sm" id="razaoSocial" name="empresa[razaoSocial]"   required oninvalid="setCustomValidity('Digite a Razão Social.')" oninput="setCustomValidity('')" value="<?=$razaoSocial?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="cnpjMatriz">CNPJ Matriz (caso seja filial):</label>
                <input type="text" class="form-control input-sm cnpj" id="cnpjMatriz" name="empresa[cnpjMatriz]"  value="<?=$cnpjMatriz?>" >
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="telefone">Telefone*:</label>
                <input type="text" class="form-control input-sm telefone" id="telefone" name="empresa[telefone]"   required oninvalid="setCustomValidity('Digite o Telefone.')" oninput="setCustomValidity('')" value="<?=$telefone?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="fax">Fax:</label>
                <input type="text" class="form-control input-sm telefone" id="fax" name="empresa[fax]" value="<?=$fax?>">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail da Empresa*:</label>
                <input type="email" class="form-control input-sm" id="email" name="empresa[email]"   required oninvalid="setCustomValidity('Digite o E-mail da Empresa.')" oninput="setCustomValidity('')" value="<?=$email?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="endereco">Endereço* : (Travessa/Rua/Avenida, Nº)</label>
                <input type="text" class="form-control input-sm" id="endereco" name="empresa[endereco]"   required oninvalid="setCustomValidity('Digite o Endereço.')" oninput="setCustomValidity('')" value="<?=$endereco?>">
            </div>
        </div>
<!--        <div class="col-md-2">-->
<!--            <div class="form-group">-->
<!--                <label for="numero">Número*:</label>-->
<!--                <input type="text" class="form-control input-sm" id="numero" name="empresa[numero]" required oninvalid="setCustomValidity('Digite o Número.')" oninput="setCustomValidity('')" value="--><?//=$numero?><!--">-->
<!--            </div>-->
<!--        </div>-->
        <div class="col-md-2">
            <div class="form-group">
                <label for="cep">CEP*:</label>
                <input type="text" class="form-control input-sm cep" id="cep" name="empresa[cep]"   required oninvalid="setCustomValidity('Digite o CEP.')" oninput="setCustomValidity('')" value="<?=$cep?>">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="complemento">Complemento:</label>
                <input type="text" class="form-control input-sm" id="complemento"   name="empresa[complemento]"  value="<?=$complemento?>">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="bairro">Bairro*:</label>
                <input type="text" class="form-control input-sm" id="bairro" name="empresa[bairro]"   required oninvalid="setCustomValidity('Digite o Bairro.')" oninput="setCustomValidity('')" value="<?=$bairro?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="uf">UF*:</label>
                <select class="form-control input-sm" id="uf" name="empresa[uf]"   onchange="carregaMunicipio(this
                .value)" required oninvalid="setCustomValidity('Selecione a UF.')" oninput="setCustomValidity('')">
                    <option value="">Selecione</option>
                    <?php
                    if($listaUf):
                        foreach ($listaUf as $uf): ?>
                            <option value="<?=$uf->uf?>" <?=($ufEmpresa == $uf->uf)?'selected':''?>><?=$uf->uf?></option>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="municipio">Município*:</label>
                <select class="form-control input-sm" id="idMunicipio" name="empresa[idMunicipio]"   required oninvalid="setCustomValidity('Selecione o Município.')" oninput="setCustomValidity('')">
                    <option value="">Selecione</option>
                    <?php
                    if($listaMunicipio){
                        foreach ($listaMunicipio as $municipio){?>
                            <option value="<?=$municipio->idMunicipio?>" <?=($idMunicipio == $municipio->idMunicipio)
                                ?"selected":""?>><?=$municipio->municipio?></option>
                    <?php
                        }
                    }
                    ?>
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="latitude">Latitude*:</label>
                <input type="text" class="form-control input-sm" id="latitude" name="empresa[latitude]"  oninvalid="setCustomValidity('Digite a Latitude.')" oninput="setCustomValidity('')" value="<?=$latitude?>">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="bairro">Longitude*:</label>
                <input type="text" class="form-control input-sm" id="longitude" name="empresa[longitude]"  oninvalid="setCustomValidity('Digite a Longitude.')" oninput="setCustomValidity('')" value="<?=$longitude?>">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="mapa">Mapa: </label>
                <div id="mapa" style="height: 300px; width: 500px">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for=""></label>
                <button id="btnEmpresa"  type="submit" onclick="addEmpresa();return false"  class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-floppy-disk"></span> &nbsp;&nbsp;Salvar</button>
            </div>
        </div>
        <div class="col-md-6">
            <span class="font-10 pull-right"><strong>* Preenchimento obrigatório.</strong></span>
        </div>
    </div>
</form>
</div>
<div class="modal fade no-display" id="ajudaDadosEmpresa" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Dados Cadastrais da Empresa</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaDadosEmpresa.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>