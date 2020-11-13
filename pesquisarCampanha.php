<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 04/10/2017
 * Time: 10:43
 */
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();

$tipoPesquisa = $_REQUEST['tipoPesquisa'];



if($tipoPesquisa == '1'){
    $campanha = $_REQUEST['campanha'];
    $anoBase = $_REQUEST['anoBase'];
    $situacao = $_REQUEST['situacao'];
    $listaDados = $oControle->pesquisarCampanha($campanha,$anoBase,$situacao);
    //Util::trace($listaDados);
    if($listaDados){
        echo '<div class="bg-grey p-10 content-table">
            <table class="table table-striped" id="tabelaEmpresas">
			<thead>
				<tr class="bg-grey grey font-13">
					<th>Campanha</th>
					<th>Inicial</th>
					<th>Final</th>
					<th nowrap>Ano Base</th>
					<th>Empresas </th>
					<th >Emails Enviados </th>
					<th>Não Iniciados</th>
					<th>Iniciados</th>
					<th>Não Concluídos</th>
					<th>Concluídos</th>
					<th>Situação</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="listaConsultaEmpresa">';
        foreach ($listaDados as $itemCampanha){
                $idCampanha = $itemCampanha->idCampanha;
                $nomeCampanha = $itemCampanha->campanha;
                $dataInicial = Util::formataDataBancoForm($itemCampanha->dataInicio);
                $dataFinal = Util::formataDataBancoForm($itemCampanha->dataFim);
                $anoBaseCampanha = $itemCampanha->anoBase;
                $alertasCampanha = $oControle->getAlertasByCampanha($idCampanha);
                $listaEmpresaCampanha = $oControle->getTodasEmpresasCampanha($idCampanha);

                $emailsEnviados = $oControle->getAllAutenticacaoempresa(["cnpj in (SELECT cnpj FROM empresaalerta WHERE idCampanha = {$idCampanha} group by cnpj)"]);

                if(!$listaEmpresaCampanha){
                    (!$itemCampanha->totalEmpresas)? $totalEmpresas = 0: $totalEmpresas = $itemCampanha->totalEmpresas;
                }else{
                    $totalEmpresas =  count($listaEmpresaCampanha);
                }


                if($totalEmpresas == 0){
                    $linkTotal = '<span id="totEmpresas" class="label label-primary font-12">0</span>';
                }else{
                    $linkTotal = '<a onclick="visualizarEmpresas('.$idCampanha.',1);" >
                                   <span id="totEmpresas" class="label label-primary font-12" style="cursor: pointer">'
                        .($totalEmpresas).
                        '</span></a>';
                }

                $naoIniciados = $naoIniciados = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status = 1)"]);//não iniciados;//não iniciados

                $cadastrosConcluidos = ($oControle->getEmpresasCampanhaByStatus($idCampanha,'3'));//concluidos

                $cadastrosPendentes = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status in (1,2))"]);

                $cadastrosIniciados = ($oControle->getEmpresasCampanhaByStatus($idCampanha,'2')); //iniciados

                if($itemCampanha->situacao == '4'){ //encerrada
                    $cadastrosPendentes = ($oControle->getEmpresasCampanhaByStatus($idCampanha,'4'));
                }



                if($cadastrosConcluidos){
                    $cadastrosConcluidos = count($cadastrosConcluidos);
                    $linkConcluidos = '<a onclick="visualizarEmpresas('.$idCampanha.',2);" >
                                   <span id="empConcluidos" class="label label-primary font-12" style="cursor: pointer">'
                        .($cadastrosConcluidos).'</span></a>';
                }else{
                    $cadastrosConcluidos = '0';
                    $linkConcluidos = '<span id="empConcluidos" class="label label-primary font-12">'.($cadastrosConcluidos).
                        '</span>';

                }
                if($cadastrosPendentes){
                    $totalPendentes = count($cadastrosPendentes);
                }else{
                    $totalPendentes = '0';
                }
                if($cadastrosIniciados){$cadastrosIniciados = count($cadastrosIniciados); }else{ $cadastrosIniciados = '0';}

                if($totalPendentes != ''){
                    $linkPendentes =  '<a onclick="visualizarEmpresas('.$idCampanha.',3);" >
                                   <span id="empPendentes" class="label label-primary font-12" style="cursor: pointer">
                                   '.($totalPendentes).'</span></a>';
                }
                else{
                    $linkPendentes =  '<span id="empPendentes" class="label label-primary font-12">
                                   '.($totalPendentes).'</span>';
                }
                if(!$alertasCampanha){
                    $linkVisualizar = '<a class="btn btn-primary btn-sm" onclick="visualizarAlerta(' . $idCampanha . ')" style="cursor:pointer;margin: 0 5px;
                    " title="Visualizar Alertas" disabled="yes"><i class="glyphicon glyphicon-search"></i></a>';
                }else {
                    $linkVisualizar = '<a class="btn btn-primary btn-sm" data-vizualizar-alertas data-campanha="'.$idCampanha.'" style="cursor:pointer;margin: 0 5px;
                    " title="Visualizar Alertas"><i class="glyphicon glyphicon-search"></i></a>';

                }

                $situacao = $itemCampanha->situacao;
                switch ($situacao){
                    case 1:
                        $descSituacao = "Pré-Ativa";
                        $desativarExclusao = '';
                        $desativarEdicao = '';
                        break;
                    case 2:
                        $descSituacao = "Ativa";
                        $desativarExclusao = 'disabled';
                        $desativarEdicao = '';
                        break;
                    case 3:
                        $descSituacao = "Inativa";
                        $desativarExclusao = 'disabled';
                        $desativarEdicao = 'disabled';
                        break;
                    case 4:
                        $descSituacao = "Encerrada";
                        $desativarExclusao = 'disabled';
                        $desativarEdicao = 'disabled';
                        break;
                }

            echo '<tr class="font-12" id="tr-id'.$idCampanha.'">' .
                '<td data-nome-campanha >' . $nomeCampanha . '</td>' .
                '<td data-inicial >' . $dataInicial . '</td>' .
                '<td data-final>' . $dataFinal . '</td>' .
                '<td data-ano-base >
' . $anoBaseCampanha . '</td>' .
                '<td data-link-total >' . $linkTotal . '</td>' .
                '<td data-link-total ><span onclick="visualizarEmpresas('.$idCampanha.',6);" id="empEmailEnviado" style="cursor: pointer" class="label label-primary font-12">' . (is_array($emailsEnviados) ? count($emailsEnviados) : "0") . '</span></td>' .
                '<td data-nao-iniciado ><span onclick="visualizarEmpresas('.$idCampanha.',5);" id="empNaoIniciados" style="cursor: pointer" class="label label-primary font-12">' . (is_array($naoIniciados) ? count($naoIniciados) : "0") . '</span></td>' .
                '<td data-iniciado ><span onclick="visualizarEmpresas('.$idCampanha.',4);" id="empIniciados" style="cursor: pointer" class="label label-primary font-12">' . $cadastrosIniciados . '</span></td>' .
                '<td >' . $linkPendentes . '</td>' .
                '<td >' . $linkConcluidos . '</td>' .
                '<td data-situacao >' . $descSituacao . '</td>' .
                '<td nowrap>
                    <a href="editarCampanha.php?idCampanha='.$idCampanha.'" class="btn btn-primary btn-sm"  style="cursor:pointer" title="Editar Campanha" '.$desativarEdicao.' ><i class="glyphicon glyphicon-pencil"></i></a>
                    '.$linkVisualizar.'
                    <a class="btn btn-primary btn-sm"  onclick="excluirCampanha('.$idCampanha.')" style="cursor:pointer" title="Excluir Campanha" '.$desativarExclusao.'><i class="glyphicon glyphicon-trash"></i></a>
                 </td>' .
                '</tr>';
        }
        echo'</tbody>
		</table> </div>';

    }else{
        echo "0";
    }
}
//echo $tipoPesquisa;
if($tipoPesquisa == '2'){

    $empresa = $_REQUEST['empresa'];
    $status = $_REQUEST['status'];

        $listaDados = $oControle->pesquisaCampanhasEmpresa($empresa,$status);
       // Util::trace($listaDados);


    if($listaDados){
        echo '<div class="bg-grey p-10 content-table">
            <table class="table table-striped" id="tabelaEmpresas">
			<thead>
				<tr class="bg-grey grey font-13">
					<th>CNPJ</th>
					<th>Razão Social</th>
					<th>Campanha</th>
					<th>Data Inicial</th>
					<th>Data Final</th>
					<th>Ano Base</th>
					<th>Situação</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="listaConsultaEmpresa">';
        foreach ($listaDados as $empresaCamp){
            $cnpj_empresa = $empresaCamp->cnpj;
            $itemEmpresa = $oControle->getInfoAtualEmpresa($cnpj_empresa);

            $cnpj = Util::formataCNPJ($itemEmpresa->cnpj);
            $razaoSocial = $itemEmpresa->razaoSocial;
            $campanha = $empresaCamp->oCampanha->campanha;
            $dataInicial = Util::formataDataBancoForm($empresaCamp->oCampanha->dataInicio);
            $dataFinal = Util::formataDataBancoForm($empresaCamp->oCampanha->dataFim);
            $anoBase = $empresaCamp->oCampanha->anoBase;
            $status = $empresaCamp->status;
            $idCampanha = $empresaCamp->oCampanha->idCampanha;



            switch ($status){
                case 1:
                    $descSituacao = "Pendente";
                    break;
                case 2:
                    $descSituacao = "Iniciado";
                    break;
                case 3:
                    $descSituacao = "Concluído";
                    break;
                case 4:
                    $descSituacao = "Expirado";
                    break;
            }


            echo '<tr class="font-12">' .
                '<td nowrap="yes">' . $cnpj . '</td>' .
                '<td>' . $razaoSocial . '</td>' .
                '<td>' . $campanha . '</td>' .
                '<td>' . $dataInicial . '</td>' .
                '<td>' . $dataFinal . '</td>' .
                '<td>' . $anoBase . '</td>' .
                '<td>' . $descSituacao . '</td>' .
                '<td>
                    <a class="btn btn-primary btn-sm" onclick="dadosEmpresa('.$itemEmpresa->cnpj.','.$idCampanha.','
                .$status.')" style="cursor:pointer" 
                    title="Visualizar Dados Empresa"><i 
                    class="glyphicon glyphicon-search"></i></a>
                    </td>' .
                '</tr>';
        }
        echo'</tbody>
		</table> </div>';



    }else{
        echo "0";
    }
}

if($_REQUEST['tipo']){
$tipo =  $_REQUEST['tipo'];
$idCampanha = $_REQUEST['idCampanha'];
    switch ($tipo){
        case "1":
            $listaEmpresas = $oControle->getTodasEmpresasCampanha($idCampanha);
            break;
        case "2":
            $listaEmpresas = $oControle->getEmpresasCampanhaByStatus($idCampanha,'3');
            break;
        case "3":
            $listaEmpresas = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status in (1,2))"]);
            break;
        case "4":
            $listaEmpresas = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status = 2)"]);
            break;
        case "5":
            $listaEmpresas = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresacampanha WHERE idCampanha = {$idCampanha} AND status = 1)"]);
            break;
        case "6":
            $listaEmpresas = $oControle->getAllAutenticacaoempresa(["email <> ''", "email is not null", "cnpj in (SELECT cnpj FROM empresaalerta WHERE idCampanha = {$idCampanha} group by cnpj)"]);
            break;
    }

    if($listaEmpresas){
        //Util::trace($listaEmpresas);
        echo '<div class="bg-grey p-10 content-table">
            <table class="table table-striped" id="tabelaEmpresas">
			<thead>
				<tr class="bg-grey grey font-13">
					<th></th>
					<th>CNPJ</th>
					<th>Razão Social</th>
					<th>Cidade / UF</th>
					<th>Email</th>
					<th>Fone</th>
					<th></th>
				</tr>
			</thead>
			<tbody id="listaConsultaEmpresa">';
        foreach ($listaEmpresas as $k => $itemListaEmpresa){
            $cnpj = $itemListaEmpresa->cnpj;
            $empresa = $oControle->getInfoAtualEmpresa($cnpj);
            $formataCnpj = Util::formataCNPJ($empresa->cnpj);
            $endereco = $empresa->endereco; if(!$endereco)$endereco = '-';
            $bairro = $empresa->bairro; if(!$bairro)$bairro = '-';
            $cep = $empresa->cep; if(!$cep)$cep = '-';
            $cidade = $empresa->oMunicipio->municipio.' / '.$empresa->oMunicipio->uf; if(!$cidade)$cidade = '-';
            $tel = $empresa->telefone; if(!$tel)$tel = '-';

            if(in_array($tipo,["1", "2"]))
                $itemListaEmpresa = $oControle->getRowAutenticacaoempresa(["cnpj = '{$cnpj}'"]);

            $email = empty($itemListaEmpresa->email) ? $empresa->email : $itemListaEmpresa->email;

            $btnEditarEmail = "<i class='glyphicon glyphicon-edit mail-edit right'></i>";

            $contato =  $oControle->getContatoempresa($empresa->idEmpresa);
            $contato = $contato->contato; if(!$contato)$contato = '-';
            echo '<tr class="font-12">' .
                '<td >' . ($k+1) . '</td>' .
                '<td nowrap="yes"> <a href="dadosEmpresa.php?actionID='.base64_encode($empresa->idEmpresa).'" target="_blank" >' . $formataCnpj . '</a></td>' .
                '<td>' . $empresa->razaoSocial . '</td>' .
                '<td>' . $cidade . '</td>' .
                '<td data-cnpj="'.$cnpj.'"><span>'.$email.'</span>'  . $btnEditarEmail . '</td>' .
                '<td nowrap>' . $tel . '</td>' .
                '<td nowrap>'.(!empty($email) ? '<a href="#" data-campanha="'.$idCampanha.'" data-cnpj="'.$cnpj.'" class="glyphicon glyphicon-send send-unic-alert primary" ></a>' : '').'</td>' .
                '</tr>';

        }
        echo'</tbody>
		</table> </div>
		<div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <a href="relatorio/relGeral.php?tipo='.$tipo.'&idCampanha='.$idCampanha.'" id="btnImprimir" target="_blank" 
                                        class="btn btn-primary btn-sm mt-10"><span class="glyphicon glyphicon-print"></span> &nbsp;&nbsp;Imprimir</a>
                                    </div>
                                </div>
                            </div>
		';

    }else{
        echo "0";
    }

}

if($_REQUEST['dados'] == 'alerta'){
    $idCampanha = $_REQUEST['idCampanha'];
    $listaAlertas = $oControle->getAlertasByCampanha($idCampanha);
    if($listaAlertas){
        echo '<div class="row mh-10 p-10 content-table border-radius">';
        foreach ($listaAlertas as $alerta){
            ($alerta->situacao == '1') ? $situacaoAlerta = 'Rascunho' : $situacaoAlerta = 'Enviado';
            echo '
            <table class="table table-striped  font-12">
                        <thead>
                            <th>Ano Base: '.$alerta->oCampanha->anoBase.'</th>
                            <th>Quantidade de Empresas: <span class="badge">'.$alerta->totalEmpresas.'</span></th>
                            <th>Enviado em: '.Util::formataDataHoraBancoForm($alerta->dataHoraAlteracao).'</th>
                            <th>Status: '.$situacaoAlerta.'</th>
                        </thead>
                        <tbody>
                            <tr>
                            <td colspan="5">Campanha: <strong>'.$alerta->oCampanha->campanha.'</strong></td>
                            </tr>
                            <tr>
                            <td colspan="5">Assunto: <strong>'.$alerta->assunto.'</strong></td>
                            </tr>
                            <tr>
                            <td colspan="5">Mensagem: <strong>'.$alerta->texto.'</strong></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr class="hr-class-blue"/>
            ';
        }
        echo '</div>';


    }

}


if($_REQUEST['dados'] == 'empresa'){
    $cnpj = $_REQUEST['cnpj'];
    $idCampanha = $_REQUEST['idCampanha'];
    $infoEmpresa = $oControle->verificaEmpresaCampanhaSituacao($idCampanha,$cnpj);
    if($infoEmpresa){

    }

}


