<?php
require_once(dirname(__FILE__) . "/../classes/class.Controle.php");
$oControle = new Controle();
$aEmpresaAlerta = $oControle->verificaEmpresaAlerta($_REQUEST['idAlerta']);
$oAlerta = $oControle->getAlerta($_REQUEST['idAlerta']);

?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>
            Relatório de empresas do Aleta.
        </title>
        <style type="text/css" media="print">
            @page land {size: landscape;}
        </style>
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
                                <th><label>RELATÓRIO DE EMPRESAS DO ALERTA</label></th>
                            </tr>
                            <tr>
                                <td><strong>Nome da Campanha: </strong> <?=$oAlerta->oCampanha->campanha;?></td>
                            </tr>
                            <tr>
                                <td><strong>Quantidade de Empresas:</strong> <?=$oAlerta->totalEmpresas;?></td>
                            </tr>
                        </table>

                        <table class="table table-bordered table-hover">
                            <?php
                            if ($aEmpresaAlerta) {
                                ?>
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

                                <tbody>
                                    <?php
                                    foreach ($aEmpresaAlerta as $oEmpresaAlerta) {
                                        $idEmpresa = $oEmpresaAlerta->oEmpresa->idEmpresa;
                                        $oEmpresa = $oControle->getEmpresa($idEmpresa);
                                        $idMunicipio = $oEmpresa->oMunicipio->idMunicipio;
                                        $oMunicipio = $oControle->getMunicipio($idMunicipio);
                                        $contatoEmpresa = $oControle->getAllContatoEmpresaByIdEmpresa($idEmpresa);
                                        ?>
                                        <tr>
                                            <td><?= Util::formataCNPJ($oEmpresaAlerta->oEmpresa->cnpj) ?></td>
                                            <td><?= $oEmpresaAlerta->oEmpresa->razaoSocial ?></td>
                                            <td><?= $oMunicipio->municipio ?></td>
                                            <td><?= $oEmpresaAlerta->oEmpresa->bairro ?></td>
                                            <td><?= $oMunicipio->uf ?></td>
                                            <td><?= $contatoEmpresa[0]->email ?></td>
                                            <td><?= $contatoEmpresa[0]->telefone ?></td>
                                        </tr>
        <?php
    }
}
?>
                            </tbody>
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

