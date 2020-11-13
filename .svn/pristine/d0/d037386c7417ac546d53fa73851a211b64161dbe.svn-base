<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 10/03/2020
 * Time: 10:43
 */

require_once "classes/class.Controle.php";

$oControle = new Controle(false);

if(empty($_GET["idCampanha"]))
    exit();

$idCampanha = $_GET["idCampanha"];

$voEmpresas = $oControle->getEmpresasCampanhaCSV($idCampanha);

$csvFile = [[
    "Razão Social",
    "CNPJ",
    "Fone",
    "CNPJ Matriz",
    "Fax",
    "Email",
    "CEP",
    "Endereco",
    "Municipio",
    "Bairro",
    "UF",
    "complemento",
    "Contato",
    "Funcao",
    "Email",
    "Fone",
    "Sócio/Acionista",
    "Funcao",
    "Documento",
    "Estrangeiro",
    "Email",
    "Responsavel/Procurado",
    "Documento",
    "Email",
    "Produto Incentivado",
    "CRI",
    "Produção",
    "Faturamento Bruto",
    "Empregos Diretos",
    "CNAE",
    "Reg. | Nac. | Ext. ", //mercado consumidor
    "Origem de Insumos",
    "Reg. | Nac. | Ext. ",
    "Faturamento Bruto",
    "Faturamento com Produtos Incentivados",
    "Imobilizado Total",
    "Investimento em Capital Fixo",
    "Remuneração do Capital Próprio",
    "Remuneração do Capital de Terceiros",
    "Pessoal e Encargos",
    "Impostos, Taxas e Contribuições",
    "Valor Pago de ICMS",
    "Valor Pago de ISSQN",
    "Valor do IR Total Não Descontado da Redução/Isenção",
    "Valor do Desconto de IR Referente à Redução/Isenção",
    "Valor do IR Descontado da Redução/Isenção",
    "Reserva de Incentivo Fiscal",
    "Reserva Apropriada no Exercício",
    "Reserva de Reinvestimento",
    "Empregos Diretos Existentes em 31/12",
    "Empregos Indiretos Existentes em 31/12",
    "Empregos Terceirizados Existentes em 31/12",
    "Despesa com Empregos Terceirizados",
    "Empregos Diretos Oriundos do Município em 31/12",
    "Projeto Social",
    "Total De despesas",
    "Quantidade de pessoas",
    "Destinação Sustentável",
    "Resíduos Gerados",
    "Resíduos Tratados"
]];

foreach ($voEmpresas as $oEmpresa){

    //dados empresa
    $row = [
        $oEmpresa->razaoSocial,
        "'".$oEmpresa->cnpj,
        $oEmpresa->telefone,
        $oEmpresa->cnpjMatriz,
        $oEmpresa->fax,
        $oEmpresa->email,
        $oEmpresa->cep,
        $oEmpresa->endereco,
        $oEmpresa->oMunicipio->municipio,
        $oEmpresa->bairro,
        $oEmpresa->oMunicipio->uf,
        $oEmpresa->complemento
    ];

    //dados de contato
    $voContatos = $oControle->getAllContatoempresa(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($voContatos)){
        $row[] = join("\n", array_map(function($i){ return $i->contato;  }, $voContatos));

        $row[] = join("\n", array_map(function($i){ return $i->funcao;  }, $voContatos));

        $row[] = join("\n", array_map(function($i){ return $i->email;  }, $voContatos));

        $row[] = join("\n", array_map(function($i){ return $i->telefone;  }, $voContatos));
    } else{
        $row = array_merge($row, ["", "", "", ""]);
    }

    //dados de socio acionista
    $voAcionistas = $oControle->getAllAcionista(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($voAcionistas)){
        $row[] = join("\n", array_map(function($i){ return $i->nome;  }, $voAcionistas));

        $row[] = join("\n", array_map(function($i){ return $i->funcao;  }, $voAcionistas));

        $row[] = join("\n", array_map(function($i){ return "'".$i->cpfCnpj;  }, $voAcionistas));

        $row[] = join("\n", array_map(function($i){ return $i->estrangeiro == "0" ? "NÃO" : "SIM";  }, $voAcionistas));

        $row[] = join("\n", array_map(function($i){ return $i->email;  }, $voAcionistas));
    } else{
        $row = array_merge($row, ["", "", "", "", ""]);
    }

    //dados de responsaveis
    $voResponsaveis = $oControle->getAllEmpresaCampanhaResponsaveis(["empresacampanha.idCampanha = {$idCampanha}", "empresacampanha.cnpj = '{$oEmpresa->cnpj}'", "empresa_campanha_responsaveis.situacao = 1"]);

    if(is_array($voResponsaveis)){
        $row[] = join("\n", array_map(function($i){ return $i->oResponsaveis->nome;  }, $voResponsaveis));

        $row[] = join("\n", array_map(function($i){ return $i->oResponsaveis->cpf_passaporte;  }, $voResponsaveis));

        $row[] = join("\n", array_map(function($i){ return $i->oResponsaveis->email;  }, $voResponsaveis));
    } else{
        $row = array_merge($row, ["", "", ""]);
    }

    //dados de incentivos / Mercado
    $voMercado = $oControle->getAllMercadoconsumidor(["incentivoempresa.idEmpresa = {$oEmpresa->idEmpresa}", "incentivoempresa.vigente = 1"]);

    if(is_array($voMercado)){
        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->produtoIncentivado;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->capacidadeInstalada;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->producao;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->faturamento;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->emprego;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return $i->oIncentivoempresa->cnae;  }, $voMercado));

        $row[] = join("\n", array_map(function($i){ return (empty($i->quantidadeRegional) ? 0 : $i->quantidadeRegional)." | ".(empty($i->quantidadeNacional) ? 0 : $i->quantidadeNacional)." | ".(empty($i->quantidadeExterior) ? 0 : $i->quantidadeExterior) ;  }, $voMercado));


    } else{
        $row = array_merge($row, ["", "", "", "", "", "", ""]);
    }

    //dados de origem de insumos
    $voOrigem = $oControle->getAllOrigeminsumos(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($voOrigem)){
        $row[] = join("\n", array_map(function($i){ return $i->oInsumos->descricao;  }, $voOrigem));

        $row[] = join("\n", array_map(function($i){ return (empty($i->quantidadeRegional) ? 0 : $i->quantidadeRegional)." | ".(empty($i->quantidadeNacional) ? 0 : $i->quantidadeNacional)." | ".(empty($i->quantidadeExterior) ? 0 : $i->quantidadeExterior) ;  }, $voOrigem));


    } else{
        $row = array_merge($row, ["", ""]);
    }

    //dados financeiros
    $oFinanceiro = $oControle->getRowCadastrofinanceiro(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if($oFinanceiro instanceof Cadastrofinanceiro){
        $f = [
            $oFinanceiro->faturamentoBruto,
            $oFinanceiro->faturamentoProdIncentivados,
            $oFinanceiro->imobilizadoTotal,
            $oFinanceiro->investimentoCapitalFixo,
            $oFinanceiro->remuneracaoCapitalProprio,
            $oFinanceiro->remuneracaoCapitalTerceiros,
            $oFinanceiro->pessoasEncargos,
            $oFinanceiro->impostosTaxasContribuicoes,
            $oFinanceiro->valorIcms,
            $oFinanceiro->valorIssqn,
            $oFinanceiro->valorIRtotal,
            $oFinanceiro->valorDescontoIR,
            $oFinanceiro->irDescontada,
            $oFinanceiro->reservaIncentivo,
            $oFinanceiro->reservaExercicio,
            $oFinanceiro->reservaInvestimento,
            $oFinanceiro->empregosDiretos,
            $oFinanceiro->maoObraIndiretaFixa,
            $oFinanceiro->terceirizadosExistentes,
            $oFinanceiro->despesaTerceiro,
            $oFinanceiro->maoObraDireta,
        ];

        $row = array_merge($row, $f);

    } else{
        $row = array_merge($row, ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""]);
    }

    //dados projetos
    $oProjetos = $oControle->getAllProjsocioambiental(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($oProjetos)){
        $row[] = join("\n", array_map(function($i){ return $i->nome;  }, $oProjetos));

        $row[] = join("\n", array_map(function($i){ return $i->totalDespesas;  }, $oProjetos));

        $row[] = join("\n", array_map(function($i){ return $i->quantidadePessoas;  }, $oProjetos));
    } else{
        $row = array_merge($row, ["", "", ""]);
    }

    //dados destinacao sustentavel
    $oPolitica = $oControle->getAllPoliticaambiental(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($oPolitica)){
        $row[] = join("\n", array_map(function($i){ return $i->residuosGerados;  }, $oPolitica));

        $row[] = join("\n", array_map(function($i){ return $i->quantGerado." ".$i->unidadeQg;  }, $oPolitica));

        $row[] = join("\n", array_map(function($i){ return $i->quantTratado." ".$i->unidadeQt;  }, $oPolitica));
    } else{
        $row = array_merge($row, ["", "", ""]);
    }

    $csvFile[] = $row;
}

$filename = 'relatorio-siav-'.date("d-m-Y");

$filepath =  $filename.'.csv';

$fp = fopen($filepath, 'w+');

foreach ($csvFile as $linha) {
    foreach ($linha as $k => $coluna){
        $linha[$k] = utf8_decode($coluna);
    }

    fputcsv($fp,$linha,";");
}

header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '.csv"');
header('Content-Length: ' . filesize($filepath));

echo readfile($filepath);

fclose($fp);
