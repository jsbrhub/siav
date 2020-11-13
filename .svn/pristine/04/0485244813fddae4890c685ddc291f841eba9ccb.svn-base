<?php
ini_set('memory_limit', '512M');
ini_set('max_execution_time', '3600');
ini_set('max_input_time', '-1');
require_once("../../classes/class.Controle.php");
require ("PHPExcel.php");
$oControle = new Controle();
$dataImport = date("Y-m-d H:i:s");
$login = $_SESSION['usuarioAtual']['login'];
$contaErro = 0;

if($_REQUEST) {
	    if (!empty($_FILES['arquivo']) && $_FILES['arquivo']['type'] == "application/vnd.ms-excel") {
            $dir = 'files/'; //Diretório para uploads
            date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
            $ext = strtolower(substr($_FILES['arquivo']['name'], -4)); //Pegando extensão do arquivo
            $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
            move_uploaded_file($_FILES['arquivo']['tmp_name'], $dir . $new_name);
            $temp_file = $dir . $new_name;
            $nome = $_FILES['arquivo']['name'];
            $dataImport = date("Y-m-d H:i:s");

            $cdArquivo = $oControle->inserirArquivo($nome,$new_name,$dataImport,1,1,$dataImport,$login);
            $objPHPExcel = PHPExcel_IOFactory::load($temp_file);
            $dataArr = array();

	        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
	            $worksheetTitle = $worksheet->getTitle();
	            $highestRow = $worksheet->getHighestRow(); // e.g. 10
	            $highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
	            $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);

               for ($row = 1; $row <= $highestRow; ++$row) {
                   for ($col = 0; $col < $highestColumnIndex; ++$col) {
                       if(PHPExcel_Shared_Date::isDateTime($worksheet->getCellByColumnAndRow($col, $row))){
                           $val = date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($worksheet->getCellByColumnAndRow($col, $row)->getValue()));
                       }else{
                           $cell = $worksheet->getCellByColumnAndRow($col, $row);
                           $val = $cell->getValue();
                       }
                       if ($val != '') {
                           $dataArr[$row][$col] = $val;

                       }
                   }
                   if($highestColumnIndex >1){
                       $totalCol = $highestColumnIndex;
                   }
               }
	        }
	       // Util::trace($totalCol,false);

	        if($totalCol < 29){

                $redirect = "../../cadArquivo.php?ms=4";
                header("location:$redirect");
                exit();


            }

            if($totalCol > 29){

                $redirect = "../../cadArquivo.php?ms=5";
                header("location:$redirect");
                exit();
            }
            if($totalCol == 29){
                unset($dataArr[1]);

                foreach ($dataArr as $val) {
                    //Util::trace($val);
                    $oControle->inserirLinha($val);
                }

                $listaExcel = $oControle->getAllIncentivosexcel();
            }

	        if($listaExcel) {
	            foreach ($listaExcel as $excel) {
                    $id = $excel->idincentivo;
	                $sudam_numero = $excel->sudam_numero;
	                $razaoSocial = $excel->empresa;
	                $cnpj = Util::limpaCPF_CNPJ($excel->cnpj);
	                $situacao = trim($excel->situacao);
	                $municipio = addslashes(trim($excel->municipio));
	                $uf = trim($excel->uf);
	                $setor = $excel->setor;
	                $mob_di = $excel->mob_di;
	                $mob_in = $excel->mob_in;
                    $mob_real = $excel->mob_real;
                    $objetivo = $excel->objetivo;
                    $cap_instalada = $excel->cap_instalada;
                    $unidade = $excel->unidade;
                    $incentivo = trim($excel->incentivo);
                    $modalidade = trim($excel->modalidade);
                    $procurador = $excel->procurador;
                    $laudo_data = trim($excel->data_laudo);
                    $laudo_numero = $excel->numero_laudo;
                    $capital_fixo = $excel->capital_fixo;
                    $capital_giro = $excel->capital_giro;
                    $enq = $excel->enq;
                    $declaracao_data = trim($excel->declaracao_data);
                    $declaracao_numero = $excel->declaracao_numero;
                    $resolucao_data = trim($excel->resolucao_data);
                    $resolucao_numero = $excel->resolucao_numero;
                    $recursos_proprios = $excel->recursos_proprios;
                    $sudam_irpj = $excel->sudam_irpj;
                    $acionistas = $excel->acionistas;
                    $total = $excel->total;

                   // Util::trace($excel,false);
                   // Util::trace($excel,false);
	                ///VALIDAÇÕES
	                //Util::trace($excel->idincentivo,false);
	                //verifica campos em branco
	                if ($cnpj == '') {
                        $descricao_erro = "O CNPJ está em branco";
	                    $linha = $id + 1;
	                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
	                    $contaErro++;
	                }else{
	                    $validaCnjp = Util::validaCNPJ($cnpj);
	                    if(!$validaCnjp){
                            $descricao_erro = $cnpj. " - CNPJ Inválido";
	                        $linha = $id + 1;
	                        $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
	                        $contaErro++;
	                    }
	                }
	                if ($razaoSocial == '') {
                        $descricao_erro = "O campo Empresa está em branco";
	                    $linha = $id + 1;
	                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
	                    $contaErro++;
	                }

	                if ($municipio == '') {
                        $descricao_erro = "O campo Município está em branco";
	                    $linha = $id + 1;
	                    $oControle->inserirDetalhe($cdArquivo, ($descricao_erro), $linha);
	                    $contaErro++;
	                }else{
	                    $consultaMun = $oControle->getMunicipioUf($municipio,$uf);
                       // Util::trace($consultaMun,false);
	                    if(!$consultaMun){
	                        $descricao_erro = $municipio. (" - Município inválido. ");
	                        $linha = $id + 1;
	                        $oControle->inserirDetalhe($cdArquivo, $descricao_erro, $linha);
	                        $contaErro++;
	                    }
	                }
	                if ($uf == '') {
	                    $descricao_erro = "O campo UF está em branco";
	                    $linha = $id + 1;
	                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
	                    $contaErro++;
	                }

	                if ($incentivo == '') {
                        $descricao_erro = "O campo Incentivo está em branco";
	                    $linha = $id + 1;
	                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
	                    $contaErro++;
	                }else{
	                    if($modalidade == ''){
                            $descricao_erro = "O campo Modalidade está em branco";
                            $linha = $id + 1;
                            $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                            $contaErro++;
                        }else{
	                        $verificaIncentivoModalidade = $oControle->getIncentivoByModalidade($modalidade,$incentivo);
                            if ($verificaIncentivoModalidade == '') {
                                $descricao_erro = $incentivo." e ". $modalidade.  " - Incentivo/Modalidade inválidos.";
                                $linha = $id + 1;
                                $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                $contaErro++;
                                }
                        }
                    }

                   if($incentivo){

	                    switch ($incentivo){
                            case "Redução":
                                if($laudo_data == ''){
                                    $descricao_erro = "Para o incentivo de Redução é necessário informar a Data do Laudo";
                                    $linha = $id + 1;
                                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                    $contaErro++;
                                }
                                break;
                            case "Isenção":
                                if($laudo_data == ''){
                                    $descricao_erro = "Para o incentivo de Isenção é necessário informar a Data do Laudo";
                                    $linha = $id + 1;
                                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                    $contaErro++;
                                }
                                break;
                            case "Depreciação Acelerada":
                                if($laudo_data == ''){
                                    $descricao_erro = "Para o incentivo de Depreciação Acelerada é necessário informar a Data do Laudo";
                                    $linha = $id + 1;
                                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                    $contaErro++;
                                }
                                break;
                            case "AFRMM":
                                if($declaracao_data == ''){
                                    $descricao_erro = "Para o incentivo AFRMM é necessário informar a Data da Declaração";
                                    $linha = $id + 1;
                                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                    $contaErro++;
                                }
                                break;
                            case "Reinvestimento":
                                if($resolucao_data == ''){
                                    $descricao_erro = "Para o incentivo de Reinvestimento é necessário informar a Data da Resolução";
                                    $linha = $id + 1;
                                    $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                                    $contaErro++;
                                }
                                break;

                        }
                   }

                   if($situacao == ''){
                       $descricao_erro = "É necessário informar a Situação do Incentivo.";
                       $linha = $id + 1;
                       $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                       $contaErro++;
                   }else{
                       $verificaSituacao = $oControle->retornaSituacao($incentivo->situacao);
                       //$teste = $teste + 1;
                       if($verificaSituacao == ''){
                           $descricao_erro = "A situação do incentivo não está de acordo com o modelo exigido para importação.";
                           $linha = $id + 1;
                           $oControle->inserirDetalhe($cdArquivo,($descricao_erro), $linha);
                           $contaErro++;
                       }
                   }

	            }
	        }

	        if ($contaErro == 0) {
                $dataHoraAlteracao = date("Y-m-d h:i:s");
                $usuarioAlteracao = $_SESSION['usuarioAtual']['login'];
                $dataAtual = date("Y-m-d");
	            $listaValidada = $oControle->getAllIncentivosexcel();
	            foreach ($listaValidada as $incentivo){
                    if($incentivo->data_laudo != ''){
                        $anoAprovacao = current(explode("-",$incentivo->data_laudo));
                        $diferenca = Util::dateDifference($incentivo->data_laudo,$dataAtual);
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
                        $diferenca = Util::dateDifference($incentivo->resolucao_data,$dataAtual);
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
                        $diferenca = Util::dateDifference($incentivo->resolucao_data,$dataAtual);
                        if($diferenca <= 10){
                            $vigente = 1;
                            $anoVigencia = $anoAprovacao + 10;
                        }else{
                            $vigente = 0;
                            $anoVigencia = $anoAprovacao + 10;
                        }

                    }

                    $verificaModalidade = $oControle->getIncentivoByModalidade(trim($incentivo->modalidade),
                    trim($incentivo->incentivo));
                    if($verificaModalidade){
                        $idModalidade = $verificaModalidade->idModalidade;
                        $idIncentivo = $verificaModalidade->oIncentivos->idIncentivo;
                    }else{
                        Util::trace($oControle->msg);
                    }
                    $verificaSituacao = $oControle->retornaSituacao(trim($incentivo->situacao));
                    if($verificaSituacao){
                        $idSituacao = $verificaSituacao->idSituacao;
                    }else{
                        Util::trace($oControle->msg);
                    }

                    $verificaMunicipio = $oControle->getMunicipioUf($incentivo->municipio,$incentivo->uf);
                    if($verificaMunicipio){
                        $idMunicipio = $verificaMunicipio->idMunicipio;
                    }else{
                        Util::trace($oControle->msg);
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

                    $oEmpresa = array(
                        0 =>$idMunicipio, //planilha //idMunicipio
                        1 =>$idSituacao, //planilha //idSituacao
                        2 =>$idIncentivo, //planilha //	idIncentivo
                        3 =>$idModalidade, //planilha //idModalidade
                        4 =>Util::limpaCPF_CNPJ($incentivo->cnpj), //planilha //	cnpj
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
                        16 =>'', //null //endereco
                        17 =>'', //null //	complemento
                        18 =>'', //null //bairro
                        19 =>'', //null 	cep
                        20 =>$incentivo->setor, //planilha //	setor
                        21 =>addslashes($incentivo->enq), //planilha //enq
                        22 =>$incentivo->sudam_numero, //planilha //	numSudam
                        23 =>addslashes($incentivo->procurador), //planilha //procurador
                        24 =>$data_laudo, //planilha //laudoData
                        25 =>$incentivo->numero_laudo, //planilha //laudoNumero
                        26 =>$anoCalendario, //planilha verificar ano da Resolucao //anoCalendario
                        27 =>$data_resolucao, //planilha verificar ano da Resolucao //resolucaoData
                        28 =>$incentivo->resolucao_numero, //planilha verificar ano da Resolucao // resolucaoNumero
                        29 =>$data_declaracao, //planilha verificar ano da Resolucao //declaracaoNumero
                        30 =>$incentivo->declaracao_numero, //planilha verificar ano da Resolucao //declaracaoNumero
                        31 =>'3', //tipo 3 - dados oriundos do arquivo excel //situacaoCadastro
                        32 =>'0', //null //	projetoSocial
                        33 =>'0', //null //politicaAmbiental
                        34 =>$vigente, //está vigente ou não (resultado do calculo da data) //	vigente
                        35 =>$anoVigencia, //ano final da vigência (resultado do calculo da data) //anoVigencia
                        36 =>$dataHoraAlteracao, //dataHora //	dataHoraAlteracao
                        37 =>$usuarioAlteracao, //usuario //usuarioAlteracao
                    );
                    $idEmpresa = $oControle->inserirEmpresaExcel($oEmpresa);

                    //validação de login e email
                    //só insere se não estiver na base de dados
                    $validaLogin = $oControle->infoAutenticacao(Util::limpaCPF_CNPJ($incentivo->cnpj));
                    if(!$validaLogin){
                        $infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj);
                        if($infoEmpresa){
                            $oControle->insereUsuarioEmpresa($cnpj,$infoEmpresa->email);
                        }else{
                            $oControle->insereUsuarioEmpresa($cnpj,"");
                        }
                    }



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
                        28 =>0, //valorDescontoIR
                        29 =>0, //reservaIncentivo
                        30 =>$dataHoraAlteracao, //dataHoraAlteracao
                        31 =>$usuarioAlteracao //usuarioAlteracao
                    );
                    if($idEmpresa)
                        $idCadastroFinanceiro = $oControle->inserirFinanceiroExcel($oCadastroFinanceiro);

                    $oIncentivoEmpresa = array(
                        0 =>$idEmpresa,
                        1 =>$idIncentivo,
                        2 =>$idModalidade,
                        3 =>addslashes($incentivo->objetivo), //produtoIncentivado
                        4 =>'Arquivo Excel', //fonteOrigem
                        5 =>$incentivo->cnpj, //cnpj
                        6 =>'', //cnae
                        7 =>0, //faturamento
                        8 =>0, //emprego
                        9 =>'',//producao
                        10 =>0,//idUnidadeProducao
                        11 =>$incentivo->cap_instalada, //capacidadeInstalada
                        12 =>addslashes($incentivo->unidade), //unidadeDescricao
                        13 =>0, //	idUnidadeCapacidade
                        14 =>$anoAprovacao, //	ano
                        15 =>$vigente, //vigente
                        16 =>'', //ano inicial da fruicao
                        17 =>'', //ano final da fruicao
                        18 =>$dataHoraAlteracao, //dataHoraAlteracao
                        19 =>$usuarioAlteracao //	usuarioAlteracao
                    );

                    if($idEmpresa)
                        $idIncentivoEmpresa = $oControle->inserirIncentivoExcel($oIncentivoEmpresa);

                }

                $oControle->updateSituacao($cdArquivo,'2');
	            $oControle->truncateExcel();
	            $redirect = "../../cadArquivo.php?ms=3";
	            header("location:$redirect");

	        }else{
                $oControle->truncateExcel();
	          	$redirect = "../../cadArquivo.php?ms=2";
	            header("location:$redirect");
	            exit();
	        }
	    }else{
	        $redirect = "../../cadArquivo.php?ms=1";
	        header("location:$redirect");
	        exit;

	    }

}

