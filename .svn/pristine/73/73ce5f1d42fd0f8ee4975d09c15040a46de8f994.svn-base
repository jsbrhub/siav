<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 10/03/2020
 * Time: 10:43
 */

require_once "classes/class.Controle.php";

set_time_limit(0);

ini_set("memory_limit", "1G");

$oControle = new Controle(false);

if(empty($_GET["idCampanha"]))
    exit("parametro idCampanha ausente");

$idCampanha = $_GET["idCampanha"];

$voEmpresas = $oControle->getEmpresasCampanhaCSV($idCampanha);

$conn = new Conexao();


$csvHeaders = [
    "empresa" => [
        "loop" => 1,
        "fields" => [
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
            "complemento"
        ]
    ],
    "contato" => [
        "loop" => 0,
        "fields" => [
            "Contato",
            "Funcao",
            "Email",
            "Fone"
        ]
    ],
    "acionistas" => [
        "loop" => 0,
        "fields" => [
            "Sócio/Acionista",
            "Funcao",
            "Documento",
            "estrangeiro",
            "email",
        ]
    ],
    "responsaveis" => [
        "loop" => 0,
        "fields" => [
            "Responsavel",
            "Documento",
            "Email"
        ]
    ],
    "mercado" => [
        "loop" => 0,
        "fields" => [
            "Produto",
            "capacidade Instalada",
            "Produção",
            "faturamento",
            "empregos",
            "CNAE",
            "regional",
            "Nacional",
            "Exterior"
        ]
    ],
    "insumos" => [
        "loop" => 0,
        "fields" => [
            "Insumo",
            "Regional",
            "Nacional",
            "Exterior"
        ]
    ],
    "financeiro" => [
        "loop" => 1,
        "fields" => [
            "Faturamento Bruto",
            "Faturamento Produtos",
            "Imobilizado Total",
            "Investimento em capital fixo",
            "Remuneração do capital próprio",
            "Remuneração do capital de terceiros",
            "Pessoal e encargos",
            "Impostos taxas e contribuições",
            "Pago ICMS",
            "Pago ISSQN",
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
            "Empregos Diretos Oriundos do Município em 31/12"
        ]
    ],
    "projetos" => [
        "loop" => 0,
        "fields" => [
            "Projeto Social",
            "Total de despesas",
            "Quantidade de pessoas"
        ]
    ],
    "politica" => [
        "loop" => 0,
        "fields" => [
            "Residuos gerados",
            "Qtd Gerado",
            "Qtd Tratado"
        ]
    ]
];


foreach ($voEmpresas as $k => $oEmpresa){

    $linha = $k+1;

    //dados empresa
    insertTemp("empresa", [
        $oEmpresa->razaoSocial,
        "@".$oEmpresa->cnpj,
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
    ], $linha, $conn);

    //dados de contato
    $voContatos = $oControle->getAllContatoempresa(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($voContatos)){
        $a = [];

        foreach ($voContatos as $oContatos){
            $a[] = [
                $oContatos->contato,
                $oContatos->funcao,
                $oContatos->email,
                $oContatos->telefone,
            ];
        }

        insertTemp("contato", $a, $linha, $conn);

        if(count($voContatos) > $csvHeaders["contato"]["loop"])
            $csvHeaders["contato"]["loop"] = count($voContatos);
    }
//
//    //dados de socio acionista
    $voAcionistas = $oControle->getAllAcionista(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if(is_array($voAcionistas)){
        $a = [];
        foreach ($voAcionistas as $oAcionistas){
            $a[] = [
                $oAcionistas->nome,
                $oAcionistas->funcao,
                '@'.$oAcionistas->cpfCnpj,
                $oAcionistas->estrangeiro = ($oAcionistas->estrangeiro == "1") ? "SIM" : "NÃO",
                $oAcionistas->email
            ];
        }

        insertTemp("acionistas", $a, $linha, $conn);

        if(count($voAcionistas) > $csvHeaders["acionistas"]["loop"])
            $csvHeaders["acionistas"]["loop"] = count($voAcionistas);
    }

//    //dados de responsaveis
    $voResponsaveis = $oControle->getAllEmpresaCampanhaResponsaveis(["empresacampanha.idCampanha = {$idCampanha}", "empresacampanha.cnpj = '{$oEmpresa->cnpj}'", "empresa_campanha_responsaveis.situacao = 1"]);
//
    if(is_array($voResponsaveis)){
        $a = [];

        foreach ($voResponsaveis as $oResponsaveis){
            $a[] = [
                $oResponsaveis->oResponsaveis->nome,
                '@'.$oResponsaveis->oResponsaveis->cpf_passaporte,
                $oResponsaveis->oResponsaveis->email
            ];
        }

        insertTemp("responsaveis", $a, $linha, $conn);

        if(count($voResponsaveis) > $csvHeaders["responsaveis"]["loop"])
            $csvHeaders["responsaveis"]["loop"] = count($voResponsaveis);
    }

    //dados de incentivos / Mercado
    $voMercado = $oControle->getAllMercadoconsumidor(["incentivoempresa.idEmpresa = {$oEmpresa->idEmpresa}", "incentivoempresa.vigente = 1"]);

    if(is_array($voMercado)){
        $a = [];

        foreach ($voMercado as $oMercado){
            $a[] = [
                $oMercado->oIncentivoempresa->produtoIncentivado,
                $oMercado->oIncentivoempresa->capacidadeInstalada,
                $oMercado->oIncentivoempresa->producao,
                $oMercado->oIncentivoempresa->faturamento,
                $oMercado->oIncentivoempresa->emprego,
                $oMercado->oIncentivoempresa->cnae,
                $oMercado->quantidadeRegional,
                $oMercado->quantidadeNacional,
                $oMercado->quantidadeExterior
            ];
        }

        insertTemp("mercado", $a, $linha, $conn);

        if(count($voMercado) > $csvHeaders["mercado"]["loop"])
            $csvHeaders["mercado"]["loop"] = count($voMercado);
    }


    //dados de origem de insumos
    $voOrigem = $oControle->getAllOrigeminsumos(["empresa.idEmpresa = {$oEmpresa->idEmpresa} group by insumos.idInsumo"]);
//
    if(is_array($voOrigem)){
        $a = [];

        foreach ($voOrigem as $oOrigem){
            $a[] = [
                $oOrigem->oInsumos->descricao,
                $oOrigem->quantidadeRegional,
                $oOrigem->quantidadeNacional,
                $oOrigem->quantidadeExterior
            ];
        }

        insertTemp("insumos", $a, $linha, $conn);

        if(count($voOrigem) > $csvHeaders["insumos"]["loop"])
            $csvHeaders["insumos"]["loop"] = count($voOrigem);
    }

    //dados financeiros
    $oFinanceiro = $oControle->getRowCadastrofinanceiro(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);

    if($oFinanceiro instanceof Cadastrofinanceiro){
        insertTemp("financeiro", [
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
        ], $linha, $conn);

    } else{
        insertTemp("financeiro", ["", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", ""], $linha, $conn);
    }



    //dados projetos
    $voProjetos = $oControle->getAllProjsocioambiental(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);
//
    if(is_array($voProjetos)){
        $a = [];

        foreach ($voProjetos as $oProjetos){
            $a[] = [
                $oProjetos->nomeProjeto,
                $oProjetos->totalDespesas,
                $oProjetos->quantidadePessoas
            ];
        }

        insertTemp("projetos", $a, $linha, $conn);

        if(count($voProjetos) > $csvHeaders["projetos"]["loop"])
            $csvHeaders["projetos"]["loop"] = count($voProjetos);
    }

    //dados destinacao sustentavel
    $voPolitica = $oControle->getAllPoliticaambiental(["empresa.idEmpresa = {$oEmpresa->idEmpresa}"]);
//
    if(is_array($voPolitica)){
        $a = [];

        foreach ($voPolitica as $oPolitica){
            $a[] = [
                $oPolitica->descricaoTratamento,
                $oPolitica->quantGerado,
                $oPolitica->quantTratado
            ];
        }

        insertTemp("politica", $a, $linha, $conn);

        if(count($voPolitica) > $csvHeaders["politica"]["loop"])
            $csvHeaders["politica"]["loop"] = count($voPolitica);
    }
}


$filename = 'relatorio-siav-'.date("d-m-Y");

$filepath =  $filename.'.csv';
$head = createHeaderCsv($csvHeaders);

$fp = fopen($filepath, 'w+');

if($linha > 0){

    fputcsv($fp,$head,";");

    for($x = 1; $x <= $linha; $x++){
        $linhaBanco = getTemp($x, $conn);

        $linhaCsv = [];

        foreach ($linhaBanco as $categoria => $item){
            $totalCategoria = count($linhaBanco[$categoria]);

            if($totalCategoria > 1){
                foreach ($item as $unidade){
                    $linhaCsv = array_merge($linhaCsv, $unidade);
                }

                while($totalCategoria < $csvHeaders[$categoria]["loop"]){
                    $linhaCsv = array_merge($linhaCsv, array_fill(0, count($csvHeaders[$categoria]["fields"]), ''));

                    $totalCategoria++;
                }


            } else {
                $totalCategoria = count($linhaBanco[$categoria]);

                if($totalCategoria > 0){
                    $vsDados = array_shift($item);

                    $linhaCsv = array_merge($linhaCsv, $vsDados);
                }

                while($totalCategoria < $csvHeaders[$categoria]["loop"]){
                    $linhaCsv = array_merge($linhaCsv, array_fill(0, count($csvHeaders[$categoria]["fields"]), ''));

                    $totalCategoria++;
                }
            }
        }

        //preenche as colunas que não existem com espacos vazios
        if(count($linhaCsv) < count($head)){
            $diff = count($head) - count($linhaCsv);

            $linhaCsv = array_merge($linhaCsv, array_fill(0, $diff, ''));
        }


        fputcsv($fp,$linhaCsv,";");

    }
}

//limpa dados da tabela
clearTemp($conn);

header('Content-Type: application/octet-stream');

header('Content-Disposition: attachment; filename="' . $filename . '.csv"');

header('Content-Length: ' . filesize($filepath));

echo "\xEF\xBB\xBF";

echo readfile($filepath);

fclose($fp);


function clearTemp($conn = null){
    if(!$conn)
        $conn = new Conexao();

    $conn->execute("DELETE FROM geracao_relatorio WHERE idCampanha = {$_GET["idCampanha"]} AND usuario = '{$_SESSION["usuarioAtual"]["login"]}'");
}

function createHeaderCsv($headerCofig){
    $h = [];

    foreach ($headerCofig as $aHead){
        for($x= 0; $x < $aHead["loop"]; $x++){
            $sufix = ($aHead["loop"] == 1 ) ? "" : "_".($x + 1);

            foreach ($aHead["fields"] as $c){
                $h[] = $c.$sufix;
            }
        }
    }

    return $h;
}

function getTemp($linha, $conn = null){
    if(!$conn)
        $conn = new Conexao();

    $conn->execute("SELECT * FROM geracao_relatorio WHERE linha = '{$linha}' AND usuario = '{$_SESSION["usuarioAtual"]["login"]}' AND idCampanha = '{$_GET["idCampanha"]}' ORDER BY linha ASC, idGeracaoRelatorio ASC");

    $response = [
        "empresa" =>      [],
        "contato" =>      [],
        "acionistas" =>   [],
        "responsaveis" => [],
        "mercado" =>      [],
        "insumos" =>      [],
        "financeiro" =>   [],
        "projetos" =>     [],
        "politica" =>     []
    ];


    if($conn->numRows() > 0){
        while ($reg = $conn->fetchReg()){
            $reg["valor"] = str_replace(["\r\n", "\r", "\n"], " ", $reg["valor"]);

            $o = json_decode($reg["valor"], 1, 512, JSON_UNESCAPED_UNICODE);

            $response[$reg["categoria"]][] = $o;
        }

    } else
        $response = [];

    return $response;
}


function insertTemp($categ,array $obj, $linha, $conn = null){

    if(!$conn)
        $conn = new Conexao();

    if(is_array($obj[0])){
        foreach ($obj as $k => $item){
            $o = str_replace(["'", "#", "--", ";", "INSERT", "UPDATE", "DELETE", "SELECT"], "", json_encode($item, JSON_UNESCAPED_UNICODE));

            $obj[$k] = "(NULL, '{$_GET["idCampanha"]}', '{$categ}', {$linha}, '{$o}', '{$_SESSION["usuarioAtual"]["login"]}')";
        }

        $sql .= join(",", $obj);
    } else {
        $o = str_replace(["'", "#", "--", ";", "INSERT", "UPDATE", "DELETE", "SELECT"], "", json_encode($obj, JSON_UNESCAPED_UNICODE));

        $sql = "(NULL, '{$_GET["idCampanha"]}', '{$categ}', {$linha}, '{$o}', '{$_SESSION["usuarioAtual"]["login"]}')";
    }

    $r = $conn->execute("INSERT INTO geracao_relatorio VALUES {$sql}");

    return ($r) ? true : false;
}

function removeSpecialChars($conn = null){
    if(!$conn)
        $conn = new Conexao();

    $conn->execute("UPDATE geracao_relatorio SET valor = REPLACE(valor, '\r\n', ' ')");
}
