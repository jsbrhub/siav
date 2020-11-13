<?php ini_set('memory_limit','1024M');
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();

$tipoConsulta = $_REQUEST['consulta'];

$empresa = $_REQUEST['empresa'];

if($tipoConsulta == '1'){  //consultar


    $empresa = !empty($empresa) ?  Util::limpaCPF_CNPJ($empresa) : null;


    if(is_numeric($empresa)){
        $validarEmpresa = Util::validaCNPJ($empresa);
        if(!$validarEmpresa){
            echo "1";
            exit;
        }else{
            $listaEmpresas = $oControle->listarRegistrosEmpresaByCnpj($empresa);
            if(!$listaEmpresas){ echo "2"; exit; }
        }
    }else{
        $listaEmpresas = $oControle->listarRegistrosEmpresaByRazaoSocial($empresa);
        if(!$listaEmpresas){ echo "2"; exit; }
    }

    if($listaEmpresas){

      //  Util::trace($listaEmpresas);
        echo '<div class="bg-grey p-10 content-table">
            <table class="table table-striped  font-12 grey" id="tabelaEmpresas">
			<thead>
				<tr class="bg-grey grey font-13">
					<th>CNPJ</th>
					<th>Razão Social</th>
					<th>Ano Aprovação</th>
					<th>Ano Base</th>
					<th>Incentivo Vigente</th>
					<th>Fonte Origem</th>
					<th>Retificação</th>
					<th colspan="2">Visualizar</th>
					
				</tr>
			</thead>
			<tbody id="listaConsultaEmpresa">';

            foreach ($listaEmpresas as $itemLista){
                $formataCnpj = Util::formataCNPJ($itemLista->cnpj);
                $fonteOrigem = $itemLista->fonteOrigem;
                $anoAprovacao = $itemLista->anoAprovacao; if(!$anoAprovacao){ $anoAprovacao = "-";}
                $anoBase = $itemLista->anoBase; if(!$anoBase){ $anoBase = "-";}
                if($fonteOrigem == 'WEB'){
                    $listaDocs = $oControle->listaDocumentosEmpresa($itemLista->idEmpresa);
                    if($listaDocs){
                        $documentos = "";
                        foreach ($listaDocs as $doc){
                            if($doc->nomeArquivo != '') {
                                $documentos .= "<li class='font-11 grey'><a href='files/" . $doc->novoNome . "' target='_blank''>" . $doc->nomeArquivo . "</a> </li>";
                            }
                        }
                        if($documentos!='')
                            $docs = '<a class="btn btn-primary btn-sm bt-popover popover-autosize" target="_blank" data-content="'.$documentos.'" style="cursor:pointer" 
                    title="Documentos" id="docsConsulta"><i class="glyphicon glyphicon-book"></i></a>';
                    }else{
                        $docs = '';
                    }
                }else{
                    $docs = '';
                }
                $retificacao = $oControle->getRefiticacaoByIdEmpresa($itemLista->idEmpresa);
                //
               // Util::trace($retificacao,false);
                //Util::trace($retificacao->status,false);
                if($itemLista->vigente == '0'){
                    $vigente = "Não";
                }else{
                    $vigente = "Sim";
                }

                    if($retificacao != ''){
                        //$img = "<img src='img/retificado.png' title='Com retificação'>";
                        switch ($retificacao->status){
                            case '':
                                $img = "<img src='img/status_0.png' title='Não Solicitada'>";
                                break;
                            case '1': //enviado
                                $img = "<img src='img/status_1.png' title='Recebida'>";
                                break;
                            case '2': //em análise
                                $img = "<img src='img/status_2.png' title='Em Análise'>";
                                break;
                            case '3': //aprovado pela sudam
                                $img = "<img src='img/status_3.png' title='Aprovada'>";
                                break;
                            case '4': //Negado pela sudam
                                $img = "<img src='img/status_4.png' title='Indeferida'>";
                                break;
                            case '5': //retificado
                                $img = "<img src='img/status_5.png' title='Retificada'>";
                                break;
                        }
                        }else{
                        $img = "<img src='img/status_0.png' title='Não Solicitada'>";
                    }
                switch ($fonteOrigem){
                    case "Arquivo Excel":
                        $link = "dadosArquivo.php?actionID=".base64_encode($itemLista->idEmpresa);
                        //$link = "dadosArquivo.php?idEmpresa=".$itemLista->idEmpresa;
                        break;
                    case "Arquivo Excel Questionario":
                        $link = "dadosArquivoQuest.php?actionID=".base64_encode($itemLista->idEmpresa);
                        //$link = "dadosArquivoQuest.php?idEmpresa=".$itemLista->idEmpresa;
                        break;
                    case "WEB":
                        $link = "dadosEmpresa.php?actionID=".base64_encode($itemLista->idEmpresa);
                        break;
                }

                echo '<tr class="font-12 grey">' .
                    '<td nowrap="yes">' . $formataCnpj . '</td>' .
                    '<td>' . ($itemLista->razaoSocial) . '</td>' .
                    '<td>' . $anoAprovacao . '</td>' .
                    '<td>
' . $anoBase . '</td>' .
                    '<td>
' . $vigente . '</td>' .
                    '<td>' . $fonteOrigem . '</td>' .
                    '<td class="text-center">' . $img . '</td>' .
                    '<td>
                    <a class="btn btn-primary btn-sm" target="_blank" href="'.$link.'" style="cursor:pointer" 
                    title="Visualizar Dados"><i class="glyphicon glyphicon-eye-open"></i></a>
                    
                    </td>
                    <td>'.$docs.'</td>
                    </tr>';
            }
			echo'</tbody>
		</table> </div>';
    }
}
if($tipoConsulta == '2'){

    $empresa = !empty($empresa) ? Util::limpaCPF_CNPJ($empresa) : null;

    if(is_numeric($empresa)){
        $validarEmpresa = Util::validaCNPJ($empresa);
        if(!$validarEmpresa){
            echo "1";
            exit;
        }else{
            $listaEmpresas = $oControle->listarIncentivosByCnpjVigencia($empresa,'1');
            if(!$listaEmpresas){ echo "2"; exit; }
        }
    }else{
        $listaEmpresas = $oControle->listarIncentivosByRazaoSocialVigencia($empresa,'1');
        if(!$listaEmpresas){ echo "2"; exit; }
    }

    if($listaEmpresas){
        //Util::trace($listaEmpresas);
        echo ' <div class="bg-grey p-10 content-table">
                <table class="table table-hover font-12 grey">
                <thead>
                <tr>
                    <th></th>
                    <th>CNPJ</th>
                    <th>Razão Social</th>

                </tr>
                </thead>

                <tbody>';
        foreach ($listaEmpresas as $itemLista){
            $formataCnpj = Util::formataCNPJ($itemLista->oEmpresa->cnpj);
            $itemListaEmpresa = "#itemListaEmpresa".$itemLista->oEmpresa->idEmpresa;
            $target = "itemListaEmpresa".$itemLista->oEmpresa->idEmpresa;
            echo '<tr data-toggle="collapse" data-target="'.$itemListaEmpresa.'" class="clickable" style="cursor: pointer">
                    <td><span class="glyphicon glyphicon-chevron-down"></span></td>
                    <td>'. $formataCnpj .'</td>
                    <td>'. $itemLista->oEmpresa->razaoSocial .'</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="'.$target.'" class="collapse">
                            <table class="table table-striped font-12 responstable">
                                <thead>
                                    <tr>
                                        <th>Incentivo/Modalidade</th>
                                        <th>Produto / Objetivo Incentivo</th>
                                        <th>Ano Aprovação</th>
                                        <th>Ano Encerramento</th>
                                        <th>Finaliza (dias)</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                $retornaIncentivos = $oControle->getIncentivosByCnpjVigencia($itemLista->oEmpresa->cnpj,'1');
                                   foreach ($retornaIncentivos as $itemIncentivo){
                                       $infoEmpresa = $oControle->getEmpresa($itemIncentivo->oEmpresa->idEmpresa);
                                       $incentivo = $infoEmpresa->oIncentivos->incentivo;
                                       $modalidade = $infoEmpresa->oModalidade->descricao;
                                       if($modalidade != $incentivo){
                                           $descIncentivo = $incentivo.' - '.$modalidade;
                                       }else{
                                           $descIncentivo = $infoEmpresa->oIncentivos->incentivo;
                                       }
                                       $laudoData = $itemIncentivo->oEmpresa->laudoData;
                                       $resolucaoData = $itemIncentivo->oEmpresa->resolucaoData;
                                       $declaracaoData = $itemIncentivo->oEmpresa->declaracaoData;
                                       if($laudoData != '0000-00-00'){
                                           list($ano,$mes,$dia) = explode("-",$laudoData);
                                           $anoVigencia = $itemIncentivo->oEmpresa->anoVigencia;
                                           $dataLimite = $anoVigencia.'-'.$mes.'-'.$dia;
                                           $quantidadeDias = Util::dateDifference($laudoData,$dataLimite,'%a');
                                       }
                                       if($resolucaoData != '0000-00-00'){
                                           list($ano,$mes,$dia) = explode("-",$resolucaoData);
                                           $anoVigencia = $itemIncentivo->oEmpresa->anoVigencia;
                                           $dataLimite = $anoVigencia.'-'.$mes.'-'.$dia;
                                           $quantidadeDias = Util::dateDifference($resolucaoData,$dataLimite,'%a');
                                       }
                                       if($declaracaoData != '0000-00-00'){
                                           list($ano,$mes,$dia) = explode("-",$declaracaoData);
                                           $anoVigencia = $itemIncentivo->oEmpresa->anoVigencia;
                                           $dataLimite = $anoVigencia.'-'.$mes.'-'.$dia;
                                           $quantidadeDias = Util::dateDifference($declaracaoData,$dataLimite,'%a');
                                       }

                                    echo '<tr>
                                        <td>'.$descIncentivo.'</td>
                                        <td>'.$itemIncentivo->produtoIncentivado.'</td>
                                        <td>'.$itemIncentivo->oEmpresa->anoAprovacao.'</td>
                                        <td>'.$itemIncentivo->oEmpresa->anoVigencia.'</td>
                                        <td>'.$quantidadeDias.'</td>
                                    </tr>';
                                   }
                                echo '</tbody>
                            </table>
                        </div>
                    </td>
                </tr>
';


        }
        echo '</tbody>
            </table>
            </div>';
    }
}

if($tipoConsulta == '3'){

    $empresa = !empty($empresa) ?  Util::limpaCPF_CNPJ($empresa) : null;

    if(is_numeric($empresa)){
        $validarEmpresa = Util::validaCNPJ($empresa);
        if(!$validarEmpresa){
            echo "1";
            exit;
        }else{
            $listaEmpresas = $oControle->listarIncentivosByCnpjVigencia($empresa,'0');
            if(!$listaEmpresas){ echo "2"; exit; }
        }
    }else{
        $listaEmpresas = $oControle->listarIncentivosByRazaoSocialVigencia($empresa,'0');
        if(!$listaEmpresas){ echo "2"; exit; }
    }

    if($listaEmpresas){
        //Util::trace($listaEmpresas);
        echo '<div class="bg-grey p-10 content-table ">
                <table class="table table-hover font-12 grey">
                <thead>
                <tr>
                    <th></th>
                    <th>CNPJ</th>
                    <th>Razão Social</th>

                </tr>
                </thead>

                <tbody>';
        foreach ($listaEmpresas as $itemLista){
            $formataCnpj = Util::formataCNPJ($itemLista->oEmpresa->cnpj);
            $itemListaEmpresa = "#itemListaEmpresa".$itemLista->oEmpresa->idEmpresa;
            $target = "itemListaEmpresa".$itemLista->oEmpresa->idEmpresa;
            echo '<tr data-toggle="collapse" data-target="'.$itemListaEmpresa.'" class="clickable" style="cursor: pointer">
                    <td><span class="glyphicon glyphicon-chevron-down"></td>
                    <td>'. $formataCnpj .'</td>
                    <td>'. $itemLista->oEmpresa->razaoSocial .'</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div id="'.$target.'" class="collapse">
                            <table class="table table-striped font-12 responstable">
                                <thead>
                                    <tr>
                                        <th>Incentivo/Modalidade</th>
                                        <th>Produto / Objetivo Incentivo</th>
                                        <th>Ano Aprovação</th>
                                        <th>Ano Encerramento</th>
                                        <th>Finaliza (dias)</th>
                                    </tr>
                                </thead>
                                <tbody>';
            $retornaIncentivos = $oControle->getIncentivosByCnpjVigencia($itemLista->oEmpresa->cnpj,'0');
            foreach ($retornaIncentivos as $itemIncentivo){
                $infoEmpresa = $oControle->getEmpresa($itemIncentivo->oEmpresa->idEmpresa);
                // Util::trace($infoEmpresa,false);
                $incentivo = $infoEmpresa->oIncentivos->incentivo;
                $modalidade = $infoEmpresa->oModalidade->descricao;
                if($modalidade != $incentivo){
                    $descIncentivo = $incentivo.' - '.$modalidade;
                }else{
                    $descIncentivo = $infoEmpresa->oIncentivos->incentivo;
                }

                $quantidadeDias = 'Encerrado';

                echo '<tr>
                                        <td>'.$descIncentivo.'</td>
                                        <td>'.$itemIncentivo->produtoIncentivado.'</td>
                                        <td>'.$itemIncentivo->oEmpresa->anoAprovacao.'</td>
                                        <td>'.$itemIncentivo->oEmpresa->anoVigencia.'</td>
                                        <td>'.$quantidadeDias.'</td>
                                    </tr>';
            }
            echo '</tbody>
                            </table>
                        </div>
                    </td>
                </tr>
';


        }
        echo '</tbody>
            </table></div>';
    }
}