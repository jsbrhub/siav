<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$idEmpresa = base64_decode($_REQUEST['actionID']);


if ($idEmpresa) {
    $oEmpresa = $oControle->getEmpresa($idEmpresa);

    $oEmpresaCampanha = $oControle->getRowEmpresacampanha([
        "empresacampanha.cnpj = '{$oEmpresa->cnpj}'",
        "campanha.anoBase = '{$oEmpresa->anoBase}'",
    ]);

    $cnpj = $oEmpresa->cnpj;
    $empresaControle = $oControle->getControleByIdEmpresa($idEmpresa);
    /// Util::trace($empresaControle);
    $oFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
    $aAcionista = $oControle->getAcionistasByEmpresa($idEmpresa);
    $aContatoempresa = $oControle->getTodosContatosEmpresa($idEmpresa);
    $aIncentivoempresa = $oControle->listarIncentivosByIdEmpresa($idEmpresa);
    $aProjsocioambiental = $oControle->getAllProjetosByEmpresa($idEmpresa);
    $aPoliticaambiental = $oControle->getAllPoliticaByEmpresa($idEmpresa);
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>
        Dados da empresa
    </title>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet prefetch' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/123941/tablesaw.stackonly.css'>
    <link rel="stylesheet" href="relatorio/css/style.css">
    <style>
        .assinatura_digital {
            background: rgb(241, 241, 241);
            background: linear-gradient(180deg, rgba(241, 241, 241, 1) 0%, rgba(201, 201, 201, 1) 100%);
            padding: 10px 20px;
            font-size: 13px;
            color: #5f5f5f;
            font-style: italic;
            margin: 10px 0;
        }

        .assinatura_digital img {
            margin-right: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="col-xs-12">
        <div class="logo">
            <img src="img/logo_peq.jpg" alt="Logo Sudam">
        </div>
        <div class="table-responsive">
            <table class="table table-bordered font-12">
                <tr>
                    <th><label>DADOS DA EMPRESA - CADASTRO WEB</label></th>
                </tr>
                <tr>
                    <td>Campanha: <strong><?= $empresaControle->oCampanha->campanha; ?> </strong></td>
                </tr>
                <tr>
                    <td>Ano Base: <strong><?= $oEmpresa->anoBase; ?></strong></td>
                </tr>
            </table>


            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Dados básicos da empresa</h5>
                <tr>
                    <td colspan="2">Nome da Empresa: <strong><?= $oEmpresa->razaoSocial; ?> </strong></td>
                </tr>
                <tr>
                    <td class="col-6 col-md-6">CNPJ: <strong>  <?= Util::formataCNPJ($oEmpresa->cnpj); ?></strong></td>
                    <td class="col-md-6">Telefone: <strong><?= $oEmpresa->telefone; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6">CNPJ Matriz:
                        <strong><?= ($oEmpresa->cnpjMatriz != '') ? ($oEmpresa->cnpjMatriz) : '-' ?></strong></td>
                    <td class="col-md-6">Fax: <strong><?= $oEmpresa->fax; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6">Razão Social: <strong><?= $oEmpresa->razaoSocial; ?></strong></td>
                    <td class="col-md-6">E-mail: <strong><?= $oEmpresa->email; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6 ">CEP: <strong><?= $oEmpresa->cep; ?></strong></td>
                    <td class="col-md-6 ">UF: <strong><?= $oEmpresa->oMunicipio->uf; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6 ">Endereço: <strong><?= $oEmpresa->endereco; ?></strong></td>
                    <td class="col-md-6 ">Município: <strong><?= $oEmpresa->oMunicipio->municipio; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6 ">Complemento: <strong><?= $oEmpresa->complemento; ?></strong></td>
                    <td class="col-md-6 ">Longitude: <strong><?= $oEmpresa->longitude; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-6 ">Bairro: <strong><?= $oEmpresa->bairro; ?></strong></td>
                    <td class="col-md-6 ">Latitude: <strong><?= $oEmpresa->latitude; ?></strong></td>
                </tr>
                </tbody>
            </table>
            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Contato da Empresa</h5>
                <tr>
                    <td class="col-md-3">Nome Contato</td>
                    <td class="col-md-3">Funçao</td>
                    <td class="col-md-3">E-mail</td>
                    <td class="col-md-3">Telefone</td>
                </tr>
                <?php
                if ($aContatoempresa) {
                    foreach ($aContatoempresa as $contato) { ?>

                        <tr>
                            <td class="col-md-4"><strong><?= $contato->contato ?></strong></td>
                            <td class="col-md-3"><strong><?= $contato->funcao ?></strong></td>
                            <td class="col-md-3"><strong><?= $contato->email ?></strong></td>
                            <td class="col-md-2"><strong><?= $contato->telefone ?></strong></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Sócio/Acionista Controlador da Empresa</h5>
                <tr>
                    <td class="col-md-3">Nome</td>
                    <td class="col-md-3">Função</td>
                    <td class="col-md-2">CPF/CNPJ</td>
                    <td class="col-md-2">Estrangeiro</td>
                    <td class="col-md-2">E-mail</td>
                </tr>
                <?php
                if ($aAcionista) {
                    foreach ($aAcionista as $acionista) { ?>

                        <tr>
                            <td class="col-md-4"><strong><?= $acionista->nome; ?></strong></td>
                            <td class="col-md-2"><strong><?= $acionista->funcao; ?></strong></td>
                            <td class="col-md-2">
                                <strong><?= ($acionista->cpfCnpj != '') ? $acionista->cpfCnpj : '-' ?></strong></td>
                            <td class="col-md-2">
                                <strong><?= ($acionista->estrangeiro == '1') ? 'Passaporte Nº: ' . $acionista->passaporte : 'Não' ?></strong>
                            </td>
                            <td class="col-md-2"><strong><?= $acionista->email; ?></strong></td>
                        </tr>
                    <?php }
                } ?>
                </tbody>
            </table>
            <?php
            if ($aIncentivoempresa) {

                ?>
                <table class="table table-bordered font-12">
                    <tbody>
                    <h5 class="grey bold">Incentivos Fiscais</h5>
                    <td class="col-md-2">Incentivo/Modalidade</td>
                    <td class="col-md-3">Produto/Serviço</td>
                    <td class="col-md-1"> CRI</td>
                    <td class="col-md-1"> Produção</td>
                    <td class="col-md-1"> Faturamento Bruto</td>
                    <td class="col-md-1"> Empregos Diretos</td>
                    <td class="col-md-1"> CNAE 2.0</td>
                    <td class="col-md-1"> Ato Declaratório</td>
                    <td class="col-md-1"> Mercado Consumidor</td>
                    <?php
                    foreach ($aIncentivoempresa as $incentivo) {
                        //Util::trace($incentivo,false);
                        if ($incentivo->oIncentivos->incentivo == $incentivo->oModalidade->descricao) {
                            $descricao = $incentivo->oIncentivos->incentivo;
                        } else {
                            $descricao = $incentivo->oIncentivos->incentivo . '/' . $incentivo->oModalidade->descricao;
                        }
                        $mercadoConsumidor = $oControle->getListaMercadPorIncentivo($incentivo->idIncentivoEmpresa);
                        $unidadeCRI = $oControle->getUnidademedida($incentivo->idUnidadeCapacidade);
                        $unidadeProd = $oControle->getUnidademedida($incentivo->idUnidadeProducao);
                        $atoDeclaratorio = $oControle->getAtoDecByIdIncentivoEmpresa($incentivo->idIncentivoEmpresa);

                        ?>
                        <tr class="">
                            <td class="col-md-2"><strong><?= $descricao ?></strong></td>
                            <td class="col-md-3"><strong><?= $incentivo->produtoIncentivado ?></strong></td>
                            <td class="col-md-1">
                                <strong><?= $incentivo->capacidadeInstalada ?> <?= $unidadeCRI->nome ?></strong></td>
                            <td class="col-md-1"><strong><?= $incentivo->producao ?> <?= $unidadeProd->nome ?></strong>
                            </td>
                            <td class="col-md-1"><strong>R$ <?= Util::formataMoeda($incentivo->faturamento) ?></strong>
                            </td>
                            <td class="col-md-1"><strong><?= $incentivo->emprego ?></strong></td>
                            <td class="col-md-1"><strong><?= $incentivo->cnae ?></strong></td>
                            <td class="col-md-1"><a href="files/<?= $atoDeclaratorio->novoNome ?>"
                                                    target="_blank"><?= '...' . substr($atoDeclaratorio->nomeArquivo, -8); ?></a>
                            </td>
                            <td class="col-md-1">
                                Regional:<strong><?= ($mercadoConsumidor->quantidadeRegional == '')
                                        ? '0' : $mercadoConsumidor->quantidadeRegional ?>%</strong><br/>
                                Nacional:<strong><?= ($mercadoConsumidor->quantidadeNacional == '')
                                        ? '0' : $mercadoConsumidor->quantidadeNacional ?>%</strong><br/>
                                Exterior:<strong><?= ($mercadoConsumidor->quantidadeExterior == '')
                                        ? '0' : $mercadoConsumidor->quantidadeExterior ?>%</strong>

                            </td>
                        </tr>
                    <?php }
                    ?>
                    </tbody>
                </table>
                <?php
            }
            ?>
            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Origem de Insumos</h5>
                <tr>
                    <?php
                    $listaOrigemInsumo = $oControle->getListaOrigemInsumosPorEmpresa($idEmpresa);
                    if ($listaOrigemInsumo) {
                        foreach ($listaOrigemInsumo as $origemInsumo) {
                            ?>
                            <td class="col-md-2"><?= $origemInsumo->oInsumos->descricao ?></td>
                            <?php
                        }
                    }
                    ?>

                </tr>
                <tr><?php
                    if ($listaOrigemInsumo) {
                        foreach ($listaOrigemInsumo as $origemInsumo) { ?>
                            <td class="col-md-2">

                                Regional:<strong><?= ($origemInsumo->quantidadeRegional == '')
                                        ? '0' : $origemInsumo->quantidadeRegional ?>%</strong><br/>
                                Nacional:<strong><?= ($origemInsumo->quantidadeNacional == '')
                                        ? '0' : $origemInsumo->quantidadeNacional ?>%</strong><br/>
                                Exterior:<strong><?= ($origemInsumo->quantidadeExterior == '')
                                        ? '0' : $origemInsumo->quantidadeExterior ?>%</strong>

                            </td>
                            <?php
                        }
                    }
                    ?>
                </tr>

                </tbody>
            </table>
            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Dados Financeiros</h5>
                <tr>
                    <td class="col-md-4">Faturamento Bruto:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->faturamentoBruto); ?></strong></td>
                    <td class="col-md-4">Faturamento com Produtos Incentivados: <strong>R$ <?= Util::formataMoeda
                            ($oFinanceiro->faturamentoProdIncentivados);
                            ?></strong></td>
                    <td class="col-md-4">Imobilizado Total:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->imobilizadoTotal); ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Investimento em Capital Fixo:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->investimentoCapitalFixo); ?></strong></td>
                    <td class="col-md-4">Remuneração do Capital Próprio:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->remuneracaoCapitalProprio); ?></strong></td>
                    <td class="col-md-4">Remuneração do Capital de Terceiros :
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->remuneracaoCapitalTerceiros); ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Pessoal e Encargos:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->pessoasEncargos); ?></strong></td>
                    <td class="col-md-4">Impostos, Taxas e Contribuições:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->impostosTaxasContribuicoes); ?></strong></td>
                    <td class="col-md-4">Valor Pago de ICMS:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->valorIcms); ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Valor Pago de ISSQN:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->valorIssqn); ?></strong></td>
                    <td class="col-md-4">Valor do IR Total Não Descontado da Redução/Isenção:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->valorIRtotal); ?></strong></td>
                    <td class="col-md-4">Valor do Desconto de IR Referente à Redução/Isenção:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->valorDescontoIR); ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Valor do IR Descontado da Redução/Isenção:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->irDescontada); ?></strong></td>
                    <td class="col-md-4">Reserva de Incentivo Fiscal:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->reservaIncentivo); ?></strong></td>
                    <td class="col-md-4">Reserva Apropriada no Exercício:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->reservaExercicio); ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Reserva de Reinvestimento:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->reservaInvestimento); ?></strong></td>
                    <td class="col-md-4">Empregos Diretos Existentes em 31/12:
                        <strong><?= $oFinanceiro->empregosDiretos; ?></strong></td>
                    <td class="col-md-4">Empregos Indiretos Existentes em 31/12 :
                        <strong><?= $oFinanceiro->maoObraIndiretaFixa; ?></strong></td>
                </tr>
                <tr>
                    <td class="col-md-4">Empregos Terceirizados Existentes em 31/12:
                        <strong><?= ($oFinanceiro->terceirizadosExistentes);
                            ?></strong></td>
                    <td class="col-md-4">Despesa com Empregos Terceirizados:
                        <strong>R$ <?= Util::formataMoeda($oFinanceiro->despesaTerceiro); ?></strong></td>
                    <td class="col-md-4">Empregos Diretos Oriundos do Município em 31/12:
                        <strong><?= $oFinanceiro->maoObraDireta; ?></strong></td>
                </tr>

                </tbody>
            </table>

            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Projetos ou Programas Sociais e/ou Ambientais Desenvolvidos</h5>
                <?php
                if ($aProjsocioambiental) {
                    ?>
                    <td class="col-md-2">Nome do Projeto</td>
                    <td class="col-md-2">Total de Despesas</td>
                    <td class="col-md-2">Quantidade de Pessoas</td>
                    <td class="col-md-2">Descrição da Atividade</td>
                    <td class="col-md-2">Observações</td>
                    <?php

                    foreach ($aProjsocioambiental as $projeto) { ?>
                        <tr>
                            <td class="col-md-2"><strong><?= $projeto->nomeProjeto; ?></strong></td>
                            <td class="col-md-2"><strong>R$ <?= Util::formataMoeda($projeto->totalDespesas); ?></strong>
                            </td>
                            <td class="col-md-2">
                                <strong><?= $projeto->quantidadePessoas; ?></strong></td>
                            <td class="col-md-2">
                                <strong><?= $projeto->descricaoAtividade; ?></strong></td>
                            <td class="col-md-2"><strong><?= $projeto->observacoes; ?> </strong>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="5"><strong>Não possui</strong></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
            <table class="table table-bordered font-12">
                <tbody>
                <h5 class="grey bold">Destinação Sustentável de Resíduos</h5>
                <?php
                if ($aPoliticaambiental) {
                    ?>
                    <td class="col-md-3">Resíduos Gerados</td>
                    <td class="col-md-3">Quantidade Gerada</td>
                    <td class="col-md-3">Descrição do Tratamento</td>
                    <td class="col-md-3">Quantidade Tratada</td>
                    <?php

                    foreach ($aPoliticaambiental as $politica) { ?>
                        <tr>
                            <td class="col-md-2"><strong><?= $politica->residuosGerados; ?></strong>
                            </td>
                            <td class="col-md-2">
                                <strong><?= Util::formataMoeda($politica->quantGerado); ?> <?= $politica->unidadeQg; ?></strong>
                            </td>
                            <td class="col-md-2">
                                <strong><?= $politica->descricaoTratamento; ?></strong></td>
                            <td class="col-md-2">
                                <strong><?= Util::formataMoeda($politica->quantTratado); ?> <?= $politica->unidadeQt; ?></strong>
                            </td>

                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="4"><strong>Não possui</strong></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

        <?php

        $voEmpresaCampanhaResponsaveis = $oControle->getAllEmpresaCampanhaResponsaveis([
            "empresa_campanha_responsaveis.situacao = 1",
            "empresacampanha.cnpj = '{$oEmpresa->cnpj}'",
            "campanha.anoBase = '{$oEmpresa->anoBase}'",
        ]);

        if (is_array($voEmpresaCampanhaResponsaveis)) {

            foreach ($voEmpresaCampanhaResponsaveis as $oEmpresaCampanhaResponsaveis) {
                $ids[] = $oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis;
            }


            $voResponsaveisAssinatura = $oControle->getAllResponsaveisAssinaturas([
                "responsaveis_assinaturas.cnpj = '{$oEmpresa->cnpj}'",
                "responsaveis_assinaturas.idEmpresaCampanhaResponsaveis in (" . join(',', $ids) . ")"
            ]);

            if (is_array($voResponsaveisAssinatura)) {
                foreach ($voResponsaveisAssinatura as $oResponsaveisAssinatura) {

                    $dataAssinatura = DateTime::createFromFormat('Y-m-d H:i:s', $oResponsaveisAssinatura->data_assinatura);
                    ?>
                    <div class="assinatura_digital">
                        <img src="img/cert-3.png" width="20"/>
                        este documento foi assinado digitalmente por
                        <b><?= $oResponsaveisAssinatura->oResponsaveis->nome ?></b> em
                        <b><?= $dataAssinatura->format("d/m/Y") ?></b> as <b><?= $dataAssinatura->format('H:i:s') ?></b>
                        através do Sistema de Avaliação dos Incentivos Fiscais - SIAV
                    </div>

                <?php } ?>
                <div class="font-11" style="margin: 15px 0">A autenticidade deste documento pode ser conferida no endereço
                    <b><a href="http://siav.sudam.gov.br/acesso-externo-validar-documento" target="_blank">http://siav.sudam.gov.br/acesso-externo-validar-documento</a></b> informando o código verificador <b><?= md5($oEmpresa->idEmpresa); ?></b> e o código de segunrança <b><?= md5($oEmpresaCampanha->idEmpresaCampanha) ?></b> nos campos adequados
                </div>
            <?php } ?>

        <?php } ?>

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
<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/tablesaw.stackonly.js'></script>
        <script src="js/index.js"></script>-->
</body>

</html>