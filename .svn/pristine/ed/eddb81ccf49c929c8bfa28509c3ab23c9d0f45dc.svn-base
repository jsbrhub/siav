<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
$cnpj = $_SESSION['usuarioAtual']['cnpj'];
$listaRetificacoes = $oControle->listaRetificacoesEmpresa($cnpj) ;
//$listaAnoBase = $oControle->listaEmpresaByCNPJStatus($cnpj,'2');
$listaAnoBase = $oControle->listaEmpresaByCNPJStatusWeb($cnpj,'2');
//Util::trace($listaAnoBase);

if($_REQUEST['dados'] == 'cadastro'){
    print ($idRetEmpresa = $oControle->cadastraRetificacaoempresa()) ? "" : $oControle->msg;
    $idEmpresa = $_REQUEST['retEmpresa']['idEmpresa'];
    $listaArquivos = $oControle->listaArquivoRetificacaoEmpresa($idEmpresa);
    if($listaArquivos){
        foreach ($listaArquivos as $arq){
            $ArquivoRetificacaoBD = new ArquivoretificacaoBD();
            $ArquivoRetificacao_POST = ['oRetificacaoempresa' => new Retificacaoempresa($idRetEmpresa),'cnpj' => $_SESSION['usuarioAtual']['cnpj'], 'nomeArquivo' => $arq->nomeArquivo, 'novoNome' => $arq->novoNome, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
            $oArquivoretificacao = Util::populate(new Arquivoretificacao(),$ArquivoRetificacao_POST);
            $ArquivoRetificacaoBD->inserir($oArquivoretificacao);
            $oControle->excluiArquivoempresa($arq->idArquivoEmpresa);
        }
    }
    $infoRetEmpresa = $oControle->getRetificacaoempresa($idRetEmpresa);
    $img = '<img src="img/status_0.png" title="Solicitação Enviada" />';
    $itemLista = '<tr id="tr-id'.$idRetEmpresa.'">
                        <td>'.Util::formataCNPJ($infoRetEmpresa->cnpj).'</td>
                        <td>'.$infoRetEmpresa->oEmpresa->razaoSocial.'</td>
                        <td>'.$infoRetEmpresa->anoBase.'</td>
                        <td>'.$infoRetEmpresa->motivo.'</td>
                        <td>'.$img.'</td>
                        <td>'.Util::formataDataHoraBancoForm($infoRetEmpresa->dataSolicitacao).'</td>
                        <td>
                            <button class="btn btn-primary btn-sm" title="Editar" 
                        onclick="editarRetEmp('.$idRetEmpresa.')"><i class="glyphicon glyphicon-pencil"></i></button>&nbsp;&nbsp;
                            <button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>&nbsp;&nbsp;
                            <button class="btn btn-primary btn-sm" title="Excluir" 
                        onclick="removerRetEmp('.$idRetEmpresa.')"><i class="glyphicon glyphicon-trash"></i></button></td>
                  </tr>';
    $retorno['idRetEmpresa'] = $idRetEmpresa;
    $retorno['infoRet'] = $infoRetEmpresa;
    $retorno['itemLista']= $itemLista;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'empresaControle'){
    $empresaControle = $oControle->getEmpresacontrole($_REQUEST['idEmpresaControle']);
    $retorno['idEmpresa'] = $empresaControle->oEmpresa->idEmpresa;
    $retorno['anoBase'] = $empresaControle->oCampanha->anoBase;
    echo json_encode($retorno);
    exit;
}
if($_REQUEST['dados'] == 'pendencias'){


    $checarRegistrosConcluidos = $oControle->retornaCadastrosWebByCnpjStatus($cnpj,'2');
    if(!is_array($checarRegistrosConcluidos)){
        $retorno['pendencias'] = 2; //não tem cadastro concluido
        echo json_encode($retorno);
        exit;
    }else {
        $pendencias = $oControle->verificaPendenciasRetificacao($cnpj);
        if (!$pendencias) {
            $verificaCampanha60Dias = $oControle->verificaDataFinal60Dias($cnpj); //verifica se a data final da campanha tem até 60 dias em relação a data atual
            if (!is_array($verificaCampanha60Dias)) {
                $retorno['pendencias'] = 3; //campanhas estão com mais de 60 dias finalizadas
            } else {
                $retorno['pendencias'] = 0; //tudo ok
            }
        } else {
            $retorno['pendencias'] = 1; //tem retificacao pendente
        }
        echo json_encode($retorno);
        exit;
    }
}

if (($_FILES['arquivoRetEmpresa']['name'] != '')) {
    $uploadDir = 'files/';
    $tempFile   = $_FILES['arquivoRetEmpresa']['tmp_name'];
    $tempFileSize   = $_FILES['arquivoRetEmpresa']['size'];
    $maxSize = '31457280';
    $ext = strtolower(substr($_FILES['arquivoRetEmpresa']['name'], -4)); //Pegando extensão do arquivo
    $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
    $targetFile = $uploadDir . $new_name;
    $fileName = $_FILES['arquivoRetEmpresa']['name'];
    $fileTypes = array('pdf','PDF','jpg','JPG','jpeg','JPEG','png','PNG','bmp','BMP'); // Allowed file extensions
    $fileParts = pathinfo($_FILES['arquivoRetEmpresa']['name']);

    if (in_array($fileParts['extension'], $fileTypes)) {
        if($tempFileSize <= $maxSize) {
            move_uploaded_file($tempFile, $targetFile);
            if(!$_REQUEST['retEmpresa']['idRetEmpresa']){
                if(!$_REQUEST['retEmpresa']['idEmpresa']){
                    $infoEmpresa = $oControle->getInfoAtualEmpresa($cnpj);
                    $idEmpresa = $infoEmpresa->idEmpresa;
                    $_SESSION['idEmpresa'] = $infoEmpresa->idEmpresa;
                }else{
                    $idEmpresa = $_REQUEST['retEmpresa']['idEmpresa'];
                }
                $ArquivoempresaBD = new ArquivoempresaBD();
                $Arquivoempresa_POST = ['oEmpresa' => new Empresa($idEmpresa),'oTipoarquivo' =>new Tipoarquivo('9'), 'nomeArquivo' =>
                    $_FILES['arquivoRetEmpresa']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
                $idArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);
                $retorno['idArquivoEmpresa'] = $idArquivoEmpresa;
                $listaArquivos = $oControle->listaArquivoRetificacaoEmpresa($idEmpresa);
            }else{
                $idRetEmpresa = $_REQUEST['retEmpresa']['idRetEmpresa'];
                $ArquivoRetificacaoBD = new ArquivoretificacaoBD();
                $ArquivoRetificacao_POST = ['oRetificacaoempresa' => new Retificacaoempresa($idRetEmpresa),'cnpj' => $_SESSION['usuarioAtual']['cnpj'], 'nomeArquivo' => $_FILES['arquivoRetEmpresa']['name'], 'novoNome' => $new_name, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                $oArquivoretificacao = Util::populate(new Arquivoretificacao(),$ArquivoRetificacao_POST);
                $iArqRet = $ArquivoRetificacaoBD->inserir($oArquivoretificacao);
                $infoArquivo = $oControle->getArquivoretificacao($iArqRet);
                $listaArquivos = $oControle->getArquivosRetificacao($idRetEmpresa);
            }
            if($listaArquivos){
                $listagem = '';
                foreach ($listaArquivos as $arq){
                    if(!$idRetEmpresa){
                        $idArquivo = $arq->idArquivoEmpresa;
                    }else{
                        $idArquivo = $arq->idArqRet;
                    }

                    $listagem .= '<li><a href="files/'.$arq->novoNome.'" target="_blank">'.$arq->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoRet('.$idArquivo.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li>';
                }
            }
            $retorno['listaArquivo'] = '<ul>'.$listagem.'</ul>';
            //$retorno['erro'] = '0';
            echo json_encode($retorno);
            exit;
        }else{
            $retorno['erro'] = '1'; //tamanho máximo excedido
            echo json_encode($retorno);
            exit;
        }
    } else {
        $retorno['erro'] = '2'; //formato não aceito
        echo json_encode($retorno);
        exit;
    }
    //exit();
}
if($_REQUEST['dados'] == 'excluir'){
    $infoRetEmpresa = $oControle->getRetificacaoempresa($_REQUEST['idRetEmpresa']);
    if($infoRetEmpresa->status == '1') {
        $listaArquivos = $oControle->getArquivosRetificacao($_REQUEST['idRetEmpresa']);
        if ($listaArquivos) {
            foreach ($listaArquivos as $arquivo) {
                $oControle->excluiArquivoretificacao($arquivo->idArqRet);
            }
        }
        if (!$oControle->excluiRetificacaoempresa($_REQUEST['idRetEmpresa'])) {
            $retorno['msg'] = 1;
        } else {
            $retorno['msg'] = 0;
        }
    }
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'visualizar'){
    $infoRetEmpresa = $oControle->getRetificacaoempresa($_REQUEST['idRetEmpresa']);
    $listaArquivos = $oControle->getArquivosRetificacao($_REQUEST['idRetEmpresa']);
    if($listaArquivos){
        $listagem = '';
        foreach ($listaArquivos as $arq){
            $idArquivo = $arq->idArqRet;
            $listagem .= '<li><a href="files/'.$arq->novoNome.'" target="_blank">'.$arq->nomeArquivo.'</a> </li>';
        }
        $listagem = '<ul>'.$listagem.'</ul>';
    }else{
        $listagem = '';
    }
    $infoRetEmpresa->dataSolicitacao = Util::formataDataHoraBancoForm($infoRetEmpresa->dataSolicitacao);

    $infoRetSudam = $oControle->getRetificaoSudamByIdRetEmpresa($_REQUEST['idRetEmpresa']);


    $retorno['listaArquivo'] = $listagem;
    $retorno['infoRet'] = $infoRetEmpresa;
    $retorno['infoRetSudam'] = $infoRetSudam;

    echo json_encode($retorno);
    exit;
}


if($_REQUEST['dados'] == 'excluirArquivo'){
    $infoArquivo = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
    if(!$oControle->excluiArquivoempresa($_REQUEST['idArquivoEmpresa'])){ $retorno['msg'] = "1"; } else {  $retorno['msg'] = "0"; }
    $listaArquivos = $oControle->listaArquivoRetificacaoEmpresa($infoArquivo->oEmpresa->idEmpresa);
    if($listaArquivos){
        $listagem = '';
        foreach ($listaArquivos as $arq){
            $listagem .= '<li><a href="files/'.$arq->novoNome.'" target="_blank">'.$arq->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoRet('.$arq->idArqRet.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li>';
        }
    }
    $retorno['listaArquivo'] = $listagem;
    echo json_encode($retorno);
    exit;
}


if($_REQUEST['dados'] == 'excluirArquivoRet'){
    $infoArquivo = $oControle->getArquivoretificacao($_REQUEST['idArqRet']);
    $idRetEmpresa = $_REQUEST['idRetEmpresa'];
    if(!$oControle->excluiArquivoretificacao($_REQUEST['idArqRet'])){ $retorno['msg'] = "1"; } else {  $retorno['msg'] = "0"; }
    $listaArquivos = $oControle->getArquivosRetificacao($idRetEmpresa);
    if($listaArquivos){
        $listagem = '';
        foreach ($listaArquivos as $arq){
            $listagem .= '<li><a href="files/'.$arq->novoNome.'" target="_blank">'.$arq->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoRet('.$arq->idArqRet.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li>';
        }
    }
    $retorno['listaArquivo'] = $listagem;
    echo json_encode($retorno);
    exit;
}


if($_REQUEST['dados'] == 'retificacao'){

    $infoRetEmpresa = $oControle->getRetificacaoempresa($_REQUEST['idRetEmpresa']);
    $listaArquivos = $oControle->getArquivosRetificacao($_REQUEST['idRetEmpresa']);
    $cnpj = $_SESSION['usuarioAtual']['cnpj'];
    $listaAnoBase = $oControle->listaEmpresaByCNPJStatus($cnpj,'2');
    if($listaAnoBase){
        foreach ($listaAnoBase as $empresaControle){
            if($empresaControle->oCampanha->anoBase == $infoRetEmpresa->anoBase){
                $idEmpresaControle = $empresaControle->idEmpresaControle;
                break;
            }

        }
    }
    $retorno['idEmpresaControle'] = $idEmpresaControle;
   // Util::trace($infoRetEmpresa);
    if($listaArquivos){
        $listagem = '';
        foreach ($listaArquivos as $arq){
            $idArquivo = $arq->idArqRet;
            $listagem .= '<li><a href="files/'.$arq->novoNome.'" target="_blank">'.$arq->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerArquivoRetEd('.$arq->idArqRet.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li>';
        }
        $listagem = '<ul>'.$listagem.'</ul>';
    }else{
        $listagem = '';
    }
    $retorno['infoRet'] = $infoRetEmpresa;
    $retorno['listaArquivo'] = $listagem;
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados'] == 'edicao'){
   // Util::trace($_REQUEST);
    $infoRetEmpresa = $oControle->getRetificacaoempresa($_REQUEST['retEmpresa']['idRetEmpresa']);
    if($infoRetEmpresa->status == '1' ){
        if(!$idRetEmpresa = $oControle->alteraRetificacaoempresa()){
            $retorno['msg'] = $oControle->msg;
        }
    }else{
        $retorno['erro'] = '1';
    }

    $infoRetAtual = $oControle->getRetificacaoempresa($idRetEmpresa);
    $infoRetAtual->dataSolicitacao = Util::formataDataBancoForm($infoRetAtual->dataSolicitacao);
    $retorno['infoRet'] = $infoRetAtual;
    echo json_encode($retorno);
    exit;

}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
    <link rel="stylesheet" href="js/datepicker/css/bootstrap-datepicker.css">
    <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script src="js/retificacao.js"></script>
    <script>
        $('input[required]').on('invalid', function() {
            this.setCustomValidity($(this).data("required-message"));
        });
    </script>
</head>
<body>
<?php require_once("includes/modals.php"); include ("includes/topo.php"); ?>
	<div class="container">
        <?php require_once("includes/menu.php");?>
        <div class="bg-grey p-10 border-radius">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group font-12 grey">
                        <strong>Solicitar Retificação de Dados</strong>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 ">
                    <div class="form-group pull-left">
                        <button id="addRetificacaoEmp" class="btn btn-primary btn-sm" onclick="addRetificacaoEmpresa(<?=$_SESSION['usuarioAtual']['cnpj']?>)
                                "><i
                                    class="glyphicon
        glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <div class="form-group pull-right">
                        <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaRetificacao()"><span
                                    class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-dismissible fade in alert-info no-display" id="retEmpresaAlerta">
                        <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                        <p class="font-12" id="retEmpresaMsg"><strong></strong></p>
                    </div>
                </div>
            </div>
        <div class="p-10 border-radius content-table <?=(!$listaRetificacoes)? 'no-display':''?>" id="divRetEmpresa">
            <div class="bg-grey p-10 font-11" id="legenda">

                <div class="col-lg-2"><img src="img/status_0.png"> - Solicitação Enviada
                </div>
                <div class="col-lg-2"><img src="img/status_1.png"> - Solicitação em Análise
                </div>
                <div class="col-lg-2"><img src="img/status_2.png"> - Solicitação Expirada
                </div>
                <div class="col-lg-2"><img src="img/status_3.png"> - Solicitação Aprovada
                </div>
                <div class="col-lg-2"><img src="img/status_4.png"> - Solicitação Indeferida
                </div>
                <div class="col-lg-2"><img src="img/status_5.png"> - Dados Retificados
                </div>
                <div style="clear: both"></div>
            </div>
                <table class="table table-striped font-12 grey" id="tabelaEmpresas">
                    <thead>
                    <tr class="bg-grey grey font-13">
                        <th>CNPJ</th>
                        <th>Razão Social</th>
                        <th>Ano Base</th>
                        <th>Motivo</th>
                        <th>Status</th>
                        <th>Data da Solicitação</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="body-retificacoes">
                    <?php
                    if($listaRetificacoes) {
                    foreach ($listaRetificacoes as $retificacao) {
                        $status = $retificacao->status;
                        switch ($status){
                            case '0':
                                $img = '<img src="img/status_2.png" title="Solicitação Expirada">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '';
                                $excluir = '';
                                break;
                            case '1':
                                $img = '<img src="img/status_0.png" title="Solicitação Enviada">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '<button class="btn btn-primary btn-sm" title="Editar" 
                        onclick="editarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-pencil"></i></button>';
                                $excluir = '<button class="btn btn-primary btn-sm" title="Excluir" 
                        onclick="removerRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-trash"></i></button>';
                                break;
                            case '2':
                                $img = '<img src="img/status_1.png" title="Solicitação em Análise">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '';
                                $excluir = '';
                                break;
                            case '3':
                                $img = '<img src="img/status_3.png" title="Solicitação Aprovada">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '';
                                $excluir = '';
                                break;
                            case '4':
                                $img = '<img src="img/status_4.png" title="Solicitação Indeferida">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '';
                                $excluir = '';
                                break;
                            case '5':
                                $img = '<img src="img/status_5.png" title="Dados Cadastrais Retificados">';
                                $visualizar = '<button class="btn btn-primary btn-sm" title="Visualizar" 
                        onclick="visualizarRetEmp('.$retificacao->idRetEmpresa.')"><i class="glyphicon glyphicon-eye-open"></i></button>';
                                $editar = '';
                                $excluir = '';
                                break;
                        }
                        ?>
                        <tr id="tr-id<?=$retificacao->idRetEmpresa?>">
                            <td><?=Util::formataCNPJ($retificacao->cnpj)?></td>
                            <td><?=$retificacao->oEmpresa->razaoSocial?></td>
                            <td data-anoBase><?=$retificacao->anoBase?></td>
                            <td data-motivo><?=$retificacao->motivo?></td>
                            <td><?=$img?></td>
                            <td data-hora><?=Util::formataDataHoraBancoForm($retificacao->dataSolicitacao)?></td>
                            <td><?=$editar?>&nbsp;&nbsp;<?=$visualizar?>&nbsp;&nbsp;<?=$excluir?></td>
                        </tr>

                        <?php
                    } }
                    ?>
                    </tbody>
                </table>
        </div>
        </div>
        <div class="modal fade no-display" id="ajudaRetificacao" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <h4 class="modal-title">Ajuda - Retificação</h4>
                    </div>
                    <div class="modal-body bg-grey">
                        <?php
                        include "ajudaRetificacao.php";
                        ?>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade no-display" id="modalRetificacaoEmpresa" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <h4 class="modal-title">Solicitar Retificação de Dados</h4>
                    </div>
                    <div class="modal-body bg-grey">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-dismissible fade in alert-info no-display" id="alertaRetEmpresaModal">
                                    <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                                    <p class="font-12" id="retEmpresaMsgModal"><strong></strong></p>
                                </div>
                            </div>
                        </div>
                        <form role="form" onsubmit="return false;" id="form-ret-emp" class="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="motivo">Motivo da Soliticação *:</label>
                                        <input type="text" class="form-control input-sm" id="motivo" name="retEmpresa[motivo]" value="" required oninvalid="setCustomValidity('Digite o Motivo da Solicitação.')" oninput="setCustomValidity('')" >
                                        <input type="hidden" class="form-control input-sm" id="idEmpresa" name="retEmpresa[idEmpresa]" value="" >
                                        <input type="hidden" class="form-control input-sm" id="idRetEmpresa" name="retEmpresa[idRetEmpresa]" value="" >
                                        <input type="hidden" class="form-control input-sm" id="anoBase" name="retEmpresa[anoBase]" value="" >
                                        <input type="hidden" class="form-control input-sm" id="cnpj" name="retEmpresa[cnpj]" value="<?=$_SESSION['usuarioAtual']['cnpj']?>" >
                                        <input type="hidden" class="form-control input-sm" id="status" name="retEmpresa[status]" value="1" >
                                        <input type="hidden" class="form-control input-sm" id="dataSolicitacao" name="retEmpresa[dataSolicitacao]"
                                               value="<?= date("d/m/Y H:i:s")?>">
                                        <input type="hidden" class="form-control input-sm" id="usuarioSolicitacao" name="retEmpresa[usuarioSolicitacao]"
                                               value="<?=$_SESSION['usuarioAtual']['login']?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="anoBase">Selecione o Ano Base *:</label>
                                        <select  class="form-control input-sm"  id="selecioneAnoBase" name="selecioneAnoBase"  required oninvalid="setCustomValidity('Selecione o Ano Base.')" oninput="setCustomValidity('')" onchange="retornaEmpresa(this.value)">
                                            <option value="">Selecione</option>
                                            <?php
                                            if($listaAnoBase){
                                                foreach ($listaAnoBase as $anoBase){ ?>
                                                    <option value="<?=$anoBase->idEmpresaControle?>"><?=$anoBase->oCampanha->anoBase?></option>
                                               <?php
                                                }
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="justificativa">Justificativa *:</label>
                                        <textarea class="form-control input-sm" id="justificativa" name="retEmpresa[justificativa]"  value=""
                                                  rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row " id="anexarRetEmpresa">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="arquivoRetEmpresa" class="font-12 grey">Anexar Arquivo: </label>
                                        <input type="file" id="arquivoRetEmpresa" name="arquivoRetEmpresa" class="filestyle font-12" data-icon="false" >
                                        <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: Bitmap, JPEG, PNG ou PDF</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>&nbsp; </label>
                                        <button class="btn btn-primary btn-sm mt-25" id="btnArquivoRet" onclick="carregaArquivoRet()">Carregar Arquivo &nbsp;
                                            &nbsp;&nbsp; <i
                                                    class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>

                                    </div>
                                </div>
                            </div>
                            <div class="row no-display" id="listaArquivoRet">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="font-12 grey">Lista de Arquivos</label>
                                        <div id="arquivoRet"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button id="btnCadRet"  type="submit" onclick="cadRetEmpresa()"  class="btn btn-primary btn-sm"><span class="glyphicon
                                glyphicon-ok"></span> &nbsp;&nbsp;Salvar</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <span class="font-10">* Preenchimento obrigatório.</span>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade no-display" id="modalVisualizarRetEmpresa" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content font-12 grey">
                    <div class="modal-header">
                        <h4 class="modal-title">Retificação de Dados</h4>
                    </div>
                    <div class="modal-body bg-grey">
                        <form role="form" onsubmit="return false;" id="form-ret-emp-vis" class="" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="motivo">Motivo da Soliticação:</label>
                                        <input type="text" class="form-control input-sm" id="motivoVis" name="motivoVis" value="" disabled >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="anoBase">Ano Base:</label>
                                        <input  class="form-control input-sm"  id="anoBaseVis" name="anoBaseVis"  value="" disabled/>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="justificativa">Justificativa:</label>
                                        <textarea class="form-control input-sm" id="justificativaVis" name="justificativaVis"  value=""
                                                  rows="3" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="anoBase">Data da Solicitacão:</label>
                                        <input  class="form-control input-sm"  id="dataSolicitacaoVis" name="dataSolicitacaoVis"  value="" disabled/>

                                    </div>
                                </div>
                            </div>
                            <div class="row no-display" id="listaArquivoRetVis">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="font-12 grey">Lista de Arquivos</label>
                                        <div id="arquivoRetVis"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="analiseSudam">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="analise">Análise:</label>
                                        <textarea class="form-control input-sm" id="analiseVis" name="analiseVis"  value=""
                                                  rows="3" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>


	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>