<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

$idEmpresa = base64_decode($_REQUEST['actionID']);
$oEmpresa = $oControle->getEmpresa($idEmpresa);

//Util::trace($oEmpresa,false);
if(!$oEmpresa){
    exit;
}else{
    $oFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
    $incentivo = $oControle->getIncentivoByIdEmpresa($idEmpresa);
}
//Util::trace($oFinanceiro,false);
//Util::trace($incentivo,false);
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>
            Dados Arquivo 
        </title>
        <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/tablesaw.stackonly.css'>
        <link rel="stylesheet" href="relatorio/css/style.css">
    </head>

    <body>
        <div class="container">
            <div class="col-xs-12">
                <div class="logo">
                    <img src="img/logo_peq.jpg" alt="Logo Sudam">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><label>DADOS DA EMPRESA, <strong>ORIUNDOS DO ARQUIVO EXCEL - CGINF</strong></label></th>
                        </tr>
                        <tr>
                            <td>Nome da Empresa: <strong><?= $oEmpresa->razaoSocial; ?> </strong></td>
                        </tr>

                    </table>


                    <table class="table table-bordered">
                        <tbody>
                        <td class="col-md-4">CNPJ</td>
                        <td class="col-md-4">Razão Social</td>
                        <tr>
                            <td class="col-md-4"><strong><?= Util::formataCNPJ($oEmpresa->cnpj); ?></strong></td>
                            <td class="col-md-4"><strong><?= $oEmpresa->razaoSocial; ?></strong></td>

                        </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered">
                        <tbody>
                        <td class="col-md-6 ">Município</td> 
                        <td class="col-md-6 ">UF</td>
                        <tr>
                            <td class="col-md-6 "><strong><?= $oEmpresa->oMunicipio->municipio; ?></strong></td> 
                            <td class="col-md-6 "><strong><?= $oEmpresa->oMunicipio->uf; ?></strong></td>
                        </tr>

                        </tbody>
                    </table>
                    <?php
                    if($incentivo) {
                        if($incentivo->oIncentivos->incentivo == $incentivo->oModalidade->descricao){
                            $descricao = $incentivo->oIncentivos->incentivo;
                        }else{
                            $descricao = $incentivo->oIncentivos->incentivo.'/'.$incentivo->oModalidade->descricao;
                        }

                        ?>
                    <table class="table table-bordered">
                        <tbody>
                        <td class="col-md-3">Incentivo/Modalidade</td>
                        <td class="col-md-3">Produto/Serviço Incentivado</td>
                        <td class="col-md-3"> Capacidade Instalada</td>
                        <td class="col-md-3"> Unidade </td>
                        <td class="col-md-3"> Ano Aprovação </td>
                        <td class="col-md-3"> Vigência </td>
                                <tr>
                                    <td class="col-md-3"><strong><?=$descricao?></strong></td>
                                    <td class="col-md-3"><strong><?=$incentivo->produtoIncentivado?></strong></td>
                                    <td class="col-md-3"><strong><?=$incentivo->capacidadeInstalada?></strong></td>
                                    <td class="col-md-3"><strong><?=$incentivo->unidadeDescricao?></strong></td>
                                    <td class="col-md-3"><strong><?=$incentivo->ano?></strong></td>
                                    <td class="col-md-3"><strong><?=($incentivo->vigente == '1')?'Sim':'Não'?></strong></td>

                                </tr>
                        </tbody>
                    </table>
                    <?php  } ?>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-left">
                                <span class="caption-helper">
                                    SUDAM - Superintendência do Desenvolvimento da Amazônia
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>