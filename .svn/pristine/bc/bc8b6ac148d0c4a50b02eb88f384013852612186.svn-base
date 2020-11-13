<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 06/10/2017
 * Time: 10:33
 */
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();

$status = $_REQUEST['status'];

$listaRetificacoes = $oControle->retornaRetificacoesByStatus($status);

if($listaRetificacoes){
    echo '<div class="bg-grey p-10 content-table">
            <table class="table table-striped" id="tabelaEmpresas">
			<thead>
				<tr class="bg-grey grey font-13">
					<th>CNPJ</th>
					<th>Razão Social</th>
					<th>Ano Base</th>
					<th>Motivo</th>
					<th>Data Solicitação</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="listaConsultaEmpresa">';
   foreach ($listaRetificacoes as $retificacao){
            $formataCnpj = Util::formataCNPJ($retificacao->cnpj);
            $empresa = $oControle->getInfoAtualEmpresa($retificacao->cnpj);
            $razaoSocial = $empresa->razaoSocial;
            $anoBase = $retificacao->anoBase;
            $motivo = $retificacao->motivo;
            $dataSolicitacao = $retificacao->dataSolicitacao;
            $dataSolicitacao = DateTime::createFromFormat("Y-m-d H:i:s",$dataSolicitacao);
            $dataSol = $dataSolicitacao->format("d/m/Y");

            $idRetEmpresa = $retificacao->idRetEmpresa;

               switch ($retificacao->status) {
                   case '1': //enviado
                       $img = "<img src='img/status_0.png' title='Pendente'>";
                       $link = "analisarRet('$idRetEmpresa','$retificacao->status')";
                       $title = "Analisar Retificação";
                       $icone = "glyphicon glyphicon-eye-open";
                       break;
                   case '2': //em análise
                       $img = "<img src='img/status_1.png' title='Em Análise'>";
                       $link = "analisarRet('$idRetEmpresa','$retificacao->status')";
                       $title = "Analisar Retificação";
                       $icone = "glyphicon glyphicon-pencil";
                       break;
                   case '3': //aprovado pela sudam
                       $img = "<img src='img/status_3.png' title='Aprovada'>";
                       $link = "visualizarRet('$idRetEmpresa')";
                       $title = "Analisar Retificação";
                       $icone = "glyphicon glyphicon-search";
                       break;
                   case '4': //Negado pela sudam
                       $img = "<img src='img/status_4.png' title='Indeferida'>";
                       $link = "visualizarRet('$idRetEmpresa')";
                       $title = "Analisar Retificação";
                       $icone = "glyphicon glyphicon-search";
                       break;
                   case '5': //retificado
                       $img = "<img src='img/status_5.png' title='Retificada'>";
                       $link = "visualizarRet('$idRetEmpresa')";
                       $title = "Analisar Retificação";
                       $icone = "glyphicon glyphicon-search";
                       break;
               }



       echo '<tr class="font-12" id="tr-id'.$idRetEmpresa.'">' .
           '<td nowrap="yes">' . $formataCnpj . '</td>' .
           '<td>' . $razaoSocial . '</td>' .
           '<td>
' . $anoBase . '</td>' .
           '<td>' . $motivo . '</td>' .
           '<td>' . $dataSol . '</td>' .
           '<td class="text-center">' . $img . '</td>' .
           '<td><a class="btn btn-primary" onclick="'.$link.'" style="cursor:pointer" title="'.$title
           .'"><i class="'.$icone.'"></i></a></td>' .
           '</tr>';
   }
    echo'</tbody>
		</table> </div>';
}else{
    echo "1";
}