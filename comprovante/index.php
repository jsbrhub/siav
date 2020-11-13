<?php
require_once("../classes/class.Controle.php");
$oControle = new Controle();
$idEmpresa= base64_decode($_REQUEST['actionID']);
$verificaHistRetificacao = $oControle->verificaIdEmpresaRet($idEmpresa);
if(!$verificaHistRetificacao){
    $recibo = 'RECIBO DE ENTREGA DE DADOS DA EMPRESA PARA MONITORAMENTO';
    $idCampanha = base64_decode($_REQUEST['actionCAMP']);
}else{
    $recibo = 'RECIBO DE RETIFICAÇÃO DE DADOS DA EMPRESA PARA MONITORAMENTO';
    $idEmpresaAntigo = $verificaHistRetificacao->oEmpresa->idEmpresa;
    $verificaControle = $oControle->getControleByIdEmpresa($idEmpresaAntigo);
    $idCampanha = $verificaControle->oCampanha->idCampanha;
}

$infoCampanha = $oControle->getCampanha($idCampanha);
$info_empresa = $oControle->getEmpresa($idEmpresa);
$checaHash = $oControle->retornaHash($idEmpresa);

?>

<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <title>
            Comprovante de Entrega de Dados
        </title>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/tablesaw.stackonly.css'>
        <link rel="stylesheet" href="css/style.css">
    </head>
    
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="portlet light bordered">
<!--                        <div><span><h5>--><?//=$codHash?><!--</h5></span></div>-->
                        <div class="logo">
                            <img src="img/logo.png" alt="">
                        </div>
                        <h2>
                            SUDAM - Superintendência do Desenvolvimento da Amazônia
                        </h2>
                        <h3>
                            <?=$recibo?>
                        </h3>
                        <table class="table table-bordered table-hover tablesaw tablesaw-stack" data-tablesaw-mode="stack">
                            <p class="titulo">
                                <strong>
                                    Identificação de Declarante:
                                </strong>
                            </p>
                            <tbody>
                                <tr>
                                    <td>
                                        <label>
                                            CNPJ da Empresa
                                        </label>
                                        <label>
                                            <?=Util::formataCNPJ($info_empresa->cnpj)?>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            Razão Social
                                        </label>
                                        <label>
                                            <?=(($info_empresa->razaoSocial))?>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            Telefone
                                        </label>
                                        <label>
                                            <?=$info_empresa->telefone?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            CEP
                                        </label>
                                        <label>
                                            <?=$info_empresa->cep?>
                                        </label>
                                    </td>
                                    <td colspan="2">
                                        <label>
                                            Endereço
                                        </label>
                                        <label>
                                            <?=($info_empresa->endereco)?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            Bairro
                                        </label>
                                        <label>
                                            <?=($info_empresa->bairro)?>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            Municipio
                                        </label>
                                        <label>
                                            <?=(($info_empresa->oMunicipio->municipio))?>
                                        </label>
                                    </td>
                                    <td>
                                        <label>
                                            UF
                                        </label>
                                        <label>
                                            <?=($info_empresa->oMunicipio->uf)?>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td >
                                        <label>
                                            Ano Base
                                        </label>
                                        <label>
                                            <?=$infoCampanha->anoBase?>
                                        </label>
                                    </td>

                                    <td colspan="2">
                                        <label>
                                            Campanha
                                        </label>
                                        <label>
                                            <?=$infoCampanha->campanha?>
                                        </label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="obs">
                            <p class="titulo">
                                <strong>
                                    Observação:
                                </strong>
                            </p>
                            <p>
                                Empresa realizou a atualização dos dados da empresa referente ao ano base
                                <?=$info_empresa->anoBase?>, recebida via internet pelo sistema de Incentivos Fiscais.

                            </p>

                            <p>
                               Código de Verificação: <strong><?=$checaHash->comprovante?></strong>

                            </p>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-left">
                                    <span class="caption-helper">
                                        SUDAM - Superintendência do Desenvolvimento da Amazônia
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-right">
                                    <span class="caption-helper">
                                        Data: <?=Util::formataDataHoraBancoForm($checaHash->dataHoraAlteracao)?>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
            <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/tablesaw.stackonly.js'></script>
            <script src="js/index.js"></script>-->
    </body>

</html>