<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 11/09/2017
 * Time: 09:56
 */

/*
 *
 *
    idEmpresa - NULL
    idMunicipio - $oEmpresa[0]
    idSituacao - $oEmpresa[1]
    idIncentivo - $oEmpresa[2]
    idModalidade - $oEmpresa[3]
    cnpj - $oEmpresa[4]
    cnpjMatriz - $oEmpresa[5]
    anoBase - $oEmpresa[6]
    anoAprovacao - $oEmpresa[7]
    razaoSocial - $oEmpresa[8]
    telefone - $oEmpresa[9]
    fax - $oEmpresa[10]
    email - $oEmpresa[11]
    fonteOrigem - $oEmpresa[12]
    latitude - $oEmpresa[13]
    longitude - $oEmpresa[14]
    endereco - $oEmpresa[15]
    complemento - $oEmpresa[16]
    bairro - $oEmpresa[17]
    cep - $oEmpresa[18]
    setor - $oEmpresa[19]
    enq - $oEmpresa[20]
    numSudam - $oEmpresa[21]
    situacaoArquivo - $oEmpresa[22]
    procurador - $oEmpresa[23]
    laudoData - $oEmpresa[24]
    laudoNumero - $oEmpresa[25]
    anoCalendario - $oEmpresa[26]
    resolucaoData - $oEmpresa[27]
    resolucaoNumero - $oEmpresa[28]
    declaracaoData - $oEmpresa[29]
    declaracaoNumero - $oEmpresa[30]
    situacaoCadastro - $oEmpresa[31]
    projetoSocial - $oEmpresa[32]
    politicaAmbiental - $oEmpresa[33]
    vigente - $oEmpresa[34]
    anoVigencia - $oEmpresa[35]
    dataHoraAlteracao - $oEmpresa[36]
    usuarioAlteracao - $oEmpresa[37]

 *
 *
 */

$incentivosExcel = $oControle->getAllIncentivosexcel();
$dataHoraAlteracao = date("Y-m-d h:i:s");
$usuarioAlteracao = "siav";
$dataAtual = date("Y-m-d");

function dateDifference($date_1 , $date_2 , $differenceFormat = '%y' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);

}

foreach ($incentivosExcel as $incentivo):
    //verifica as datas e anos
    if($incentivo->data_laudo != ''){
        $anoAprovacao = current(explode("-",$incentivo->data_laudo));
        $diferenca = dateDifference($incentivo->data_laudo,$dataAtual);
        if($diferenca <= 10){
            $vigente = 1;
            $anoVigencia = $anoAprovacao + 10;
        }else{
            $vigente = 0;
            $anoVigencia = $anoAprovacao + 10;
        }

    }
    if($incentivo->resolucao_data != ''){
        $anoCalendario = current(explode("-",$incentivo->resolucao_data));
        $anoAprovacao = current(explode("-",$incentivo->resolucao_data));
        $diferenca = dateDifference($incentivo->resolucao_data,$dataAtual);
        if($diferenca <= 10){
            $vigente = 1;
            $anoVigencia = $anoAprovacao + 10;
        }else{
            $vigente = 0;
            $anoVigencia = $anoAprovacao + 10;
        }

    }
    if($incentivo->declaracao_data != ''){
        $anoAprovacao = current(explode("-",$incentivo->declaracao_data));
        $diferenca = dateDifference($incentivo->resolucao_data,$dataAtual);
        if($diferenca <= 10){
            $vigente = 1;
            $anoVigencia = $anoAprovacao + 10;
        }else{
            $vigente = 0;
            $anoVigencia = $anoAprovacao + 10;
        }

    }

    //verifico o tipo de incentivo e modalidade
    $verificaModalidade = $oControle->getIncentivoByModalidade($incentivo->modalidade,$incentivo->incentivo);
        if($verificaModalidade){
          // Util::trace($verificaModalidade,false);
            $idModalidade = $verificaModalidade->idModalidade;
            $idIncentivo = $verificaModalidade->oIncentivos->idIncentivo;
        }
    $verificaSituacao = $oControle->retornaSituacao($incentivo->situacao);
        if($verificaSituacao){
            $idSituacao = $verificaSituacao->idSituacao;
        }

    $verificaMunicipio = $oControle->getMunicipioUf($incentivo->municipio,$incentivo->uf);
        if($verificaMunicipio){
            $idMunicipio = $verificaMunicipio->idMunicipio;
        }

        if(!$incentivo->data_laudo){
            $data_laudo = "0000-00-00";
        }else{$data_laudo = $incentivo->data_laudo;}
        if(!$incentivo->resolucao_data){
            $data_resolucao = "0000-00-00";
        }else{$data_resolucao = $incentivo->resolucao_data;}
        if(!$incentivo->declaracao_data){
            $data_declaracao = "0000-00-00";
        }else{$data_declaracao = $incentivo->declaracao_data;}

    // $oEmpresa = new stdClass();
    $oEmpresa = array(
        0 =>$idMunicipio, //planilha //idMunicipio
        1 =>$idSituacao, //planilha //idSituacao
        2 =>$idIncentivo, //planilha //	idIncentivo
        3 =>$idModalidade, //planilha //idModalidade
        4 =>$incentivo->cnpj, //planilha //	cnpj
        5 =>'', //null //	cnpjMatriz
        6 =>0, //anoBase
        7 =>$anoAprovacao,//anoAprovacao
        8 =>addslashes($incentivo->empresa), //razaoSocial
        9 =>'', //null //	telefone
        10 =>'', //null //fax
        11 =>'', //null //email
        12 =>'Arquivo Excel', //ArquivoExcel //fonteOrigem
        13 =>'', //null //latitude
        14 =>'', //null //longitude
        15 =>'', //null //endereco
        16 =>'', //null //	complemento
        17 =>'', //null //bairro
        18 =>'', //null 	cep
        19 =>$incentivo->setor, //planilha //	setor
        20 =>addslashes($incentivo->enq), //planilha //enq
        21 =>$incentivo->sudam_numero, //planilha //	numSudam
        22 =>addslashes($incentivo->procurador), //planilha //procurador
        23 =>$data_laudo, //planilha //laudoData
        24 =>$incentivo->numero_laudo, //planilha //laudoNumero
        25 =>$anoCalendario, //planilha verificar ano da Resolucao //anoCalendario
        26 =>$data_resolucao, //planilha verificar ano da Resolucao //resolucaoData
        27 =>$incentivo->resolucao_numero, //planilha verificar ano da Resolucao // resolucaoNumero
        28 =>$data_declaracao, //planilha verificar ano da Resolucao //declaracaoNumero
        29 =>$incentivo->declaracao_numero, //planilha verificar ano da Resolucao //declaracaoNumero
        30 =>'3', //tipo 3 - dados oriundos do arquivo excel //situacaoCadastro
        31 =>'0', //null //	projetoSocial
        32 =>'0', //null //politicaAmbiental
        33 =>$vigente, //está vigente ou não (resultado do calculo da data) //	vigente
        34 =>$anoVigencia, //ano final da vigência (resultado do calculo da data) //anoVigencia
        35 =>$dataHoraAlteracao, //dataHora //	dataHoraAlteracao
        36 =>$usuarioAlteracao, //usuario //usuarioAlteracao
        );
    //Util::trace($oEmpresa,false);

    $idEmpresa = $oControle->inserirEmpresaExcel($oEmpresa);


    if(($incentivo->capital_giro != '')){
        $capital_giro = Util::formataMoedaBanco($incentivo->capital_giro);
    }else{$capital_giro = 0;}
    if(($incentivo->capital_fixo != '')){
        $capital_fixo = Util::formataMoedaBanco($incentivo->capital_fixo);
    }else{$capital_fixo = 0;}
    if(is_numeric($incentivo->mob_di)){
        $mob_di = $incentivo->mob_di;
    }else{$mob_di = 0;}
    if(is_numeric($incentivo->mob_in)){
        $mob_in = $incentivo->mob_in;
    }else{$mob_in = 0;}
    if(is_numeric($incentivo->mob_real)){
        $mob_real= $incentivo->mob_real;
    }else{$mob_real = 0;}
    if(($incentivo->recursos_proprios != '')){
        $recursos_proprios= Util::formataMoedaBanco($incentivo->recursos_proprios);
    }else{$recursos_proprios = 0;}
    if(($incentivo->sudam_irpj != '')){
        $sudam_irpj = Util::formataMoedaBanco($incentivo->sudam_irpj);
    }else{$sudam_irpj = 0;}
    if(($incentivo->acionistas != '')){
        $acionistas = Util::formataMoedaBanco($incentivo->acionistas);
    }else{$acionistas = 0;}
    if(($incentivo->total != '')){
        $total = Util::formataMoedaBanco($incentivo->total);
    }else{$total = 0;}
    Util::trace("CNPJ: ".$incentivo->cnpj,false);
    Util::trace("---- bd cap giro:".$incentivo->capital_giro,false);
    Util::trace("formatado:".$capital_giro,false);
    Util::trace("---- bd cap fixo:".$incentivo->capital_fixo,false);
    Util::trace("formatado:".$capital_fixo,false);
    Util::trace("---- bd rec.prop:".$incentivo->recursos_proprios,false);
    Util::trace("formatacao: ".$recursos_proprios,false);
    Util::trace("---- bd irpj:".$incentivo->sudam_irpj,false);
    Util::trace("formatado:".$sudam_irpj,false);
    Util::trace("---- bd acionistas:".$incentivo->acionistas,false);
    Util::trace("formatado:".$acionistas,false);
    Util::trace("---- bd total:".$incentivo->total,false);
    Util::trace("formatado:".$total,false);
    echo "<br>-----------------------------";
    $oCadastroFinanceiro = array(
        0 =>$idEmpresa,
        1 =>0, //eh estimado
        2 =>0, //faturamentobruto
        3 =>0, //imobilizado total
        4 =>0, //reserva exercício
        5 =>0, //irDescontada
        6 =>0, //valor ICMS
        7 =>0,//valor ISSQN
        8 =>0,//empregos diretos
        9 =>0, //despesa terceiros
        10 =>0, //terceirizados existentes
        11 =>0, //pessoas encargos
        12 =>0, //impostos taxas e contribuições
        13 =>0, //remuneracao capital terceiros
        14 =>0, //remuneracao capital proprio
        15 =>0, //investimento capital fixo
        16 =>0, //faturamento prod incentivados
        17 =>0, //reserva investimento
        18 =>0, //valor ir total
        19 =>$capital_giro, //capital de giro
        20 =>$capital_fixo, //capital fixo
        21 =>$mob_di, //maoObraDireta
        22 =>$mob_in, //maoObraIndiretaFixa
        23 =>$mob_real, //maoObraReal
        24 =>$recursos_proprios, //recursosProprios
        25 =>$sudam_irpj, //previsaoIsencao
        26 =>$acionistas, //acionistas
        27 =>$total, //totalReinvestimento
        28 =>$dataHoraAlteracao, //dataHoraAlteracao
        29 =>$usuarioAlteracao //usuarioAlteracao
    );
    if(!$idEmpresa){
       echo "erro"; exit();
    }
    if($idEmpresa)
       $idCadastroFinanceiro = $oControle->inserirFinanceiroExcel($oCadastroFinanceiro);
  // Util::trace($oCadastroFinanceiro,false);




    $oIncentivoEmpresa = array(
        0 =>$idEmpresa,
        1 =>addslashes($incentivo->objetivo), //produtoIncentivado
        2 =>'Arquivo Excel', //fonteOrigem
        3 =>$incentivo->cnpj, //cnpj
        4 =>'', //cnae
        5 =>0, //faturamento
        6 =>0, //emprego
        7 =>'',//producao
        8 =>0,//idUnidadeProducao
        9 =>$incentivo->cap_instalada, //capacidadeInstalada
        10 =>addslashes($incentivo->unidade), //unidadeDescricao
        11 =>0, //	idUnidadeCapacidade
        12 =>$anoAprovacao, //	ano
        13 =>$vigente, //vigente
        14 =>$dataHoraAlteracao, //dataHoraAlteracao
        15 =>$usuarioAlteracao //	usuarioAlteracao
    );
   // Util::trace($oIncentivoEmpresa);
    if($idEmpresa)
        $idIncentivoEmpresa = $oControle->inserirIncentivoExcel($oIncentivoEmpresa);
    //Util::trace($idIncentivoEmpresa,false);

    Util::trace($idEmpresa,false);
endforeach;