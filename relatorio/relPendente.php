<?php
require_once(dirname(__FILE__)."/../classes/class.Controle.php");
$oControle = new Controle();
$situacao = $_REQUEST['situacao'];
$oCampanha = $oControle->getCampanha($_REQUEST['idCampanha']);
$aEmpresacampanha = $oControle->verificaEmpresaCampanha($_REQUEST['idCampanha']);
$cont = $_REQUEST['cont'];
if($_REQUEST['situacao'] == '1'){
    $label = " - CADASTRO INICIADO";
}
if($_REQUEST['situacao'] == '2'){
    $label = " - CADASTRO CONCLUÍDO";
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
                        <th><label>RELATÓRIO DE EMPRESAS <?=$label?></label></th>
                    </tr>
                    <tr>
                        <td><strong>Nome da Campanha: </strong><?=$oCampanha->campanha?></td>
                    </tr>
                    <tr>
                        <td><strong>Quantidade de Empresas: </strong><?=$cont?></td>
                    </tr>
                </table>

                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
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
                    foreach($aEmpresacampanha as $oEmpresacampanha) {
                        $idEmpresa = $oEmpresacampanha->oEmpresa->idEmpresa;
                        $oEmpresa = $oControle->getEmpresa($idEmpresa);
                        $checarEmpresa = $oControle->getEmpresaPorAnoBase($oEmpresa->cnpj, $oCampanha->anoBase);
                        if($checarEmpresa) {
                            if ($checarEmpresa->situacao == $situacao) {
                                $contatoEmpresa = $oControle->getAllContatoEmpresaByIdEmpresa($checarEmpresa->idEmpresa);
                                ?>
                                <tr>
                                    <td><?=($checarEmpresa->cnpj != '') ? Util::formataCNPJ($checarEmpresa->cnpj) : '-'?></td>
                                    <td><?=($checarEmpresa->razaoSocial != '') ? $checarEmpresa->razaoSocial : '-'?></td>
                                    <td><?=($checarEmpresa->bairro != '') ? $checarEmpresa->bairro : '-'?></td>
                                    <td><?=($checarEmpresa->oMunicipio->municipio != '') ? $checarEmpresa->oMunicipio->municipio : '-'?></td>
                                    <td><?=($checarEmpresa->oMunicipio->uf != '') ? $checarEmpresa->oMunicipio->uf : '-'?></td>
                                    <td><?=($checarEmpresa->email != '') ? $checarEmpresa->email : '-'?></td>
                                    <td><?=($checarEmpresa->telefone != '') ? $checarEmpresa->telefone : '-'?></td>
                                </tr>
                                <?php
                            } //if
                        }
                    } //foreach

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