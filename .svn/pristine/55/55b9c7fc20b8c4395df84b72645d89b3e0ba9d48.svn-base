<?php
require_once(dirname(__FILE__)."/../classes/class.Controle.php");
$oControle = new Controle();

$oCampanha = $oControle->getCampanha($_REQUEST['idCampanha']);
$tipo =  $_REQUEST['tipo'];
$idCampanha = $_REQUEST['idCampanha'];
switch ($tipo){
    case "1":
        $aEmpresacampanha = $oControle->getTodasEmpresasCampanha($idCampanha);
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas na campanha";
        break;
    case "2":
        $aEmpresacampanha = $oControle->getEmpresasCampanhaByStatus($idCampanha,'3');
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas para cujas mensagens foram enviadas e concluiram a atualização";
        break;
    case "3":
        $aEmpresacampanha = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status in (1,2))"]);
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas para cujas mensagens foram enviadas e não concluiram a atualização";
        break;
    case "4":
        $aEmpresacampanha = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status = 2)"]);
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas para cujas mensagens foram enviadas e iniciaram atualização";
        break;
    case "5":
        $aEmpresacampanha = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status = 1)"]);
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas para cujas mensagens foram enviadas mas não iniciaram atualização";
        break;
    case "6":
        $aEmpresacampanha = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha})"]);
        $totalEmpresas = count($aEmpresacampanha);
        $label = " - Empresas para cujas mensagens foram enviadas";
        break;
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        Relatório de Empresas da Campanha
    </title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/tablesaw.stackonly.css'>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="logo">
                <img src="img/logo.png" alt="">
            </div>


            <div class="table-responsive">
                <table class="table table-bordered tabletop">
                    <tr>
                            <th><label>RELATÓRIO DE EMPRESAS <?=$label?> </label></th>
                    </tr>
                    <tr>
                        <td><strong>Nome da Campanha: </strong><?=$oCampanha->campanha?></td>
                    </tr>
                    <tr>
                        <td><strong>Quantidade de Empresas: </strong><?=$totalEmpresas?></td>
                    </tr>
                </table>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>CNPJ</th>
                        <th>Razão Social</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Email da Empresa</th>
                        <th>Telefone</th>
                    </tr>
                    </thead>
                    <?php
                    if($aEmpresacampanha) {
                        ?>
                        <tbody>
                        <?php
                        foreach($aEmpresacampanha as $k => $oEmpresacampanha) {
                           $cnpj = $oEmpresacampanha->cnpj;
                           $oEmpresa = $oControle->getInfoAtualEmpresa($cnpj);
                           $email = $oControle->infoAutenticacao($cnpj);
                           $email = $email->email;
                                ?>
                                <tr>
                                    <td><?=($k+1)?></td>
                                    <td><?=($oEmpresa->cnpj != '') ? Util::formataCNPJ($oEmpresa->cnpj) : '-'?></td>
                                    <td><?=($oEmpresa->razaoSocial != '') ? $oEmpresa->razaoSocial : '-'?></td>
                                    <td><?=($oEmpresa->bairro != '') ? $oEmpresa->bairro : '-'?></td>
                                    <td><?=($oEmpresa->oMunicipio->municipio != '') ? $oEmpresa->oMunicipio->municipio : '-'?></td>
                                    <td><?=($oEmpresa->oMunicipio->uf != '') ? $oEmpresa->oMunicipio->uf : '-'?></td>
                                    <td><?=($email != '') ? $email : '-'?></td>
                                    <td><?=($oEmpresa->telefone != '') ? $oEmpresa->telefone : '-'?></td>
                                </tr>

                     <?php   } //foreach

                    }
                        ?>
                        </tbody>
                        <?php

                    ?>
                </table>
            </div>

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
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/tablesaw.stackonly.js'></script>
    <script src="js/index.js"></script>-->
</body>

</html>