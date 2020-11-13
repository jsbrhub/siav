<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$listaArquivos = $oControle->listaDocumentosEmpresa($idEmpresa);
$retorno = [];
// ================= Cadastrar Arquivoempresa ========================= 

if($_REQUEST['dados'] == 'documento'){
    $infoDoc = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
    if($infoDoc->nomeArquivo != ''){
        $linkArquivo = '<ul><li><a href="files/'.$infoDoc->novoNome.'" target="_blank">'.$infoDoc->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerDocumento('.$infoDoc->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    }
    $retorno['infoDoc'] = $infoDoc;
    $retorno['linkArquivo'] = $linkArquivo;
    echo json_encode($retorno);
    exit;
}


if($_REQUEST['dados']== 'excluir'){
    $infoArquivo = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
    $arrayTipoArquivo = array('2','3','4','5','6');
   //
    if(in_array($infoArquivo->oTipoarquivo->idTipoArquivo,$arrayTipoArquivo)){
        //Util::trace($infoArquivo);
        unlink("files/".$infoArquivo->novoNome);
        $infoArquivo->novoNome = '';
        $infoArquivo->nomeArquivo = '';
        $ArquivoempresaBD = new ArquivoempresaBD();
        $postArquivoEmpresa = Util::populate(new Arquivoempresa(),$infoArquivo);
        if(!$ArquivoempresaBD->alterar($postArquivoEmpresa)){
            $retorno['msg'] = "3";
        }else{
            $infoDoc =  $oControle->getArquivoempresa($infoArquivo->idArquivoEmpresa);
            $retorno['msg'] = "2";
            $retorno['infoDoc'] = $infoDoc;
        }

    }else{
        unlink("files/".$infoArquivo->novoNome);
        if(!$oControle->excluiArquivoempresa($_REQUEST['idArquivoEmpresa'])){
            $retorno['msg'] = "1";
        }else{
            $retorno['msg'] = "0";
        }
    }
    echo json_encode($retorno);
    exit;
}

if($_REQUEST['dados']== 'excluirSomenteArquivo'){
    $infoArquivo = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);

        unlink("files/".$infoArquivo->novoNome);
        $infoArquivo->novoNome = '';
        $infoArquivo->nomeArquivo = '';
        $ArquivoempresaBD = new ArquivoempresaBD();
        $postArquivoEmpresa = Util::populate(new Arquivoempresa(),$infoArquivo);
        if(!$ArquivoempresaBD->alterar($postArquivoEmpresa)){
            $retorno['msg'] = "3";
        }else{
            $infoDoc =  $oControle->getArquivoempresa($infoArquivo->idArquivoEmpresa);
            $retorno['msg'] = "2";
            $retorno['infoDoc'] = $infoDoc;
        }


    echo json_encode($retorno);
    exit;
}






if($_REQUEST['dados'] == 'cadastro'){

    $novoTipo = $_REQUEST['tipoArquivo'];
    $oTipoArquivo = ['tipo' => $novoTipo];
    $TipoArquivoBD = new TipoarquivoBD();
    $postTipoArquivo = Util::populate(new Tipoarquivo(),$oTipoArquivo);
    $novoIdTipoArquivo = $TipoArquivoBD->inserir($postTipoArquivo);
    $ArquivoempresaBD = new ArquivoempresaBD();
    $Arquivoempresa_POST = ['oEmpresa' => new Empresa($_REQUEST['idEmpresa']),'oTipoarquivo' => new Tipoarquivo($novoIdTipoArquivo),'nomeArquivo' =>
        $_FILES['arquivoDocumento']['name'], 'novoNome' => $new_name, 'descricao' => $_REQUEST['descricao'],'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
    $oArquivoempresa = Util::populate(new Arquivoempresa(), $Arquivoempresa_POST);
    $novoIdArquivoEmpresa = $ArquivoempresaBD->inserir($oArquivoempresa);

    $retorno['idArquivoEmpresa'] = $novoIdArquivoEmpresa;
    $infoArquivo = $oControle->getArquivoempresa($novoIdArquivoEmpresa);
    $itemTabela = '<tr id="tr-id'.$infoArquivo->idArquivoEmpresa.'">
                                    <td data-tipo><strong>'.$infoArquivo->oTipoarquivo->tipo.'</strong></td>
                                    <td data-descricao>'.$infoArquivo->descricao.'</td>
                                    <td data-nome><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm" onclick="addDocumento('.$infoArquivo->idArquivoEmpresa.')"><i class="glyphicon glyphicon-pencil"></i></button>
                                        <button class="btn btn-primary btn-sm" onclick="excluirArquivoEmpresa('.$infoArquivo->idArquivoEmpresa.')"><i class="glyphicon glyphicon-trash"></i></button>
                                    </td>
                </tr>';
    $retorno['itemTabela'] = $itemTabela;

    if (!empty($_FILES['arquivoDocumento'])) {
        $uploadDir = 'files/';
        $tempFile   = $_FILES['arquivoDocumento']['tmp_name'];
        $tempFileSize   = $_FILES['arquivoDocumento']['size'];
        $maxSize = '104857600';
        $ext = strtolower(substr($_FILES['arquivoDocumento']['name'], -4)); //Pegando extensão do arquivo
        $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
        $targetFile = $uploadDir . $new_name;
        $fileName = $_FILES['arquivoDocumento']['name'];
        $fileTypes = array('pdf','PDF','jpg','JPG', 'png', 'PNG'); // Allowed file extensions
        $fileParts = pathinfo($_FILES['arquivoDocumento']['name']);
        if (in_array($fileParts['extension'], $fileTypes)) {
            if($tempFileSize <= $maxSize) {
                move_uploaded_file($tempFile, $targetFile);

            }else{
                $retorno['erro'] = '1'; //tamanho máximo excedido
            }
        }else {
            $retorno['erro'] = '2'; //formato não aceito
        }
    }

    $retorno['infoArquivo'] = $infoArquivo;
    $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerDocumento('.$infoArquivo->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    $retorno['linkArquivo'] = $linkArquivo;
    echo json_encode($retorno);
    exit;

}
if($_REQUEST['dados'] == 'edicao'){

    $oTipoArquivo = $oControle->getTipoarquivo($_REQUEST['idTipoArquivo']);
    $oTipoArquivo->tipo = $_REQUEST['tipoArquivo'];
    $TipoArquivoBD = new TipoarquivoBD();
    $postTipoArquivo = Util::populate(new Tipoarquivo(),$oTipoArquivo);
    $novoIdTipoArquivo = $TipoArquivoBD->alterar($postTipoArquivo);

    //Util::trace($_FILES['arquivoDocumento']['na']);

    if ($_FILES['arquivoDocumento']['name'] == '') { //se vier vazio o file, ele vai atualizar a descrição.


        $oArquivoempresa = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
        $arrayTipoArquivo = array('2','3','4','5','6');
        //
        if(in_array($oArquivoempresa->oTipoarquivo->idTipoArquivo,$arrayTipoArquivo)){
            if($oArquivoempresa->nomeArquivo == ''){
               $retorno['erro'] = '3';
               echo json_encode($retorno);
               exit;
            }
        }else{
            $oArquivoempresa->descricao = $_REQUEST['descricao'];
            $ArquivoempresaBD = new ArquivoempresaBD();
            $oArquivoempresa = Util::populate(new Arquivoempresa(), $oArquivoempresa);
            $ArquivoempresaBD->alterar($oArquivoempresa);
            $retorno['idArquivoEmpresa'] = $_REQUEST['idArquivoEmpresa'];
            $infoArquivo = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
        }

    }else{
        $uploadDir = 'files/';
        $tempFile   = $_FILES['arquivoDocumento']['tmp_name'];
        $tempFileSize   = $_FILES['arquivoDocumento']['size'];
        $maxSize = '104857600';
        $ext = strtolower(substr($_FILES['arquivoDocumento']['name'], -4)); //Pegando extensão do arquivo
        $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
        $targetFile = $uploadDir . $new_name;
        $fileName = $_FILES['arquivoDocumento']['name'];
        $fileTypes = array('pdf','PDF','jpg','JPG', 'png', 'PNG'); // Allowed file extensions
        $fileParts = pathinfo($_FILES['arquivoDocumento']['name']);
        if (in_array($fileParts['extension'], $fileTypes)) {
            if($tempFileSize <= $maxSize) {
                move_uploaded_file($tempFile, $targetFile);
                $ArquivoempresaBD = new ArquivoempresaBD();
                $Arquivoempresa_POST = ['nomeArquivo' => $_FILES['arquivoDocumento']['name'], 'novoNome' => $new_name, 'descricao' => $_REQUEST['descricao'],'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['cnpj']];
                // Util::trace($_REQUEST['idArquivoEmpresa']);
                $oArquivoempresaget = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
                $oArquivoempresa = Util::populate($oArquivoempresaget, $Arquivoempresa_POST);
                $ArquivoempresaBD->alterar($oArquivoempresa);
                $retorno['idArquivoEmpresa'] = $_REQUEST['idArquivoEmpresa'];
                $infoArquivo = $oControle->getArquivoempresa($_REQUEST['idArquivoEmpresa']);
            }else{
                $retorno['erro'] = '1'; //tamanho máximo excedido
            }
        }else {
            $retorno['erro'] = '2'; //formato não aceito
        }
    }


    if(!$retorno['erro']){
        $retorno['erro'] = '';
    }

    $retorno['infoArquivo'] = $infoArquivo;

    $retorno['listaArquivo'] = '<ul><li><a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a> - [<a class="pointer" title="Remover" onclick="removerDocumento('.$infoArquivo->idArquivoEmpresa.')" ><span class="glyphicon glyphicon-trash btn-sm"></span></a>]</li></ul>';
    $linkArquivo = '<a href="files/'.$infoArquivo->novoNome.'" target="_blank">'.$infoArquivo->nomeArquivo.'</a>';
    $retorno['linkArquivo'] = $linkArquivo;
    echo json_encode($retorno);
    exit;
}






?>
<script>
    $(document).ready(function(){
        $('.p-hover').popover({});
    })


</script>
<div class="bg-grey border-radius mt-10 p-10">
    <div class="row ">
        <div class="col-md-10 mt-10">
            <div class="form-group pull-left">
                <button id="addDocumento" class="btn btn-primary btn-sm" onclick="addDocumento(0)"><i class="glyphicon
        glyphicon-plus"></i>&nbsp;&nbsp;Cadastrar</button>
            </div>
        </div>
        <div class="col-md-2 mb-button">
            <div class="form-group pull-right">
                <button class="btn btn-link btn-warning" title="Ajuda?" onclick="ajudaDocumentos()"><span
                            class="glyphicon
                    glyphicon-info-sign font-22"></span></button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-dismissible fade in alert-info no-display" id="alertaDocumento">
                <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                <p class="font-12" id="documentoMsg"><strong></strong></p>
            </div>
        </div>
    </div>
    <table class="table table-striped font-12 grey " id="documentosEmpresa">
        <thead>
        <tr class="bg-grey grey font-13">
            <th>Tipo de Documento</th>
            <th>Descrição Documento</th>
            <th>Arquivo</th>
            <th></th>
        </tr>
        </thead>
        <tbody id="body-documentos">
        <?php
        if($listaArquivos){
           foreach ($listaArquivos as $arquivo) {
               $tipoArquivo = $arquivo->oTipoarquivo->idTipoArquivo;
               $obrigatorio = '';
               $buttonExcluir = '<button class="btn btn-primary btn-sm" onclick="excluirArquivoEmpresa('.$arquivo->idArquivoEmpresa.')"><i class="glyphicon glyphicon-trash"></i></button>';
               switch ($tipoArquivo){
                   case "2":
                       $desabilitado = "disabled";
                       $obrigatorio = "*";
                       $buttonExcluir = '';
                       break;
                   case "3":
                       $desabilitado = "disabled";
                       $obrigatorio = "*";
                       $buttonExcluir = '';
                       break;
                   case "4":
                       $desabilitado = "disabled";
                       $obrigatorio = "*";
                       $buttonExcluir = '';
                       break;
                   case "5":
                       $desabilitado = "disabled";
                       $obrigatorio = "*";
                       $buttonExcluir = '';
                       break;
                   case "6":
                       $desabilitado = "disabled";
                       $obrigatorio = "*";
                       $buttonExcluir = '';
                       break;
               }
                ?>
                <tr id="tr-id<?=$arquivo->idArquivoEmpresa?>">
                    <td data-tipo><strong><?=$arquivo->oTipoarquivo->tipo?> <?=$obrigatorio?></strong></td>
                    <td data-descricao><?=$arquivo->descricao?></td>
                    <td data-nome><a href="files/<?=$arquivo->novoNome?>" target="_blank"><?=$arquivo->nomeArquivo?></a>  <?php if(!file_exists("files/{$arquivo->novoNome}")){ ?> <i class="p-hover glyphicon glyphicon-remove" style="color: red; cursor: pointer" data-trigger="hover" data-toggle="popover" data-content="Este arquivo não foi carregado corretamente, exclua-o e carregue novamente."></i>  <?php } ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="addDocumento(<?=$arquivo->idArquivoEmpresa?>)"><i class="glyphicon glyphicon-pencil"></i></button>
                        <?=$buttonExcluir?>
                    </td>
                </tr>
                <?php
           }
        }
        ?>
        </tbody>
    </table>
</div>

<div class="modal fade no-display" id="ajudaDocumentos" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Ajuda - Documentos</h4>
            </div>
            <div class="modal-body bg-grey">
                <?php
                include "ajudaDocumentos.php";
                ?>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default grey font-12" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade no-display" id="modalDocumentos" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content font-12 grey">
            <div class="modal-header">
                <h4 class="modal-title">Anexar Documento</h4>
            </div>
            <div class="modal-body bg-grey">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-dismissible fade in alert-info no-display" id="alertaDocumentoModal">
                            <button type="button" class="close" aria-label="Close" onclick="$(this).parent().hide();">×</button>
                            <p class="font-12" id="documentoMsgModal"><strong></strong></p>
                        </div>
                    </div>
                </div>

                <form role="form" onsubmit="return false;" id="form-documento" class="" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tipoArquivo">Tipo de Documento *:</label>
                                <input type="text" class="form-control input-sm" id="tipoArquivo" name="tipoArquivo"
                                          value=""/>
                                <input type="hidden" class="form-control input-sm" id="idArquivoEmpresa" name="idArquivoEmpresa" value="" >
                                <input type="hidden" class="form-control input-sm" id="idTipoArquivo" name="idTipoArquivo" value="" >
                                <input type="hidden" class="form-control input-sm" id="idEmpresa" name="idEmpresa" value="<?=$idEmpresa?>" >
                                <input type="hidden" class="form-control input-sm" id="dataHoraAlteracao" name="dataHoraAlteracao"
                                       value="<?=date("d/m/Y H:i:s")?>">
                                <input type="hidden" class="form-control input-sm" id="usuarioAlteracao" name="usuarioAlteracao"
                                       value="<?=$_SESSION['usuarioAtual']['login']?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descricao">Descrição do Documento *:</label>
                                <textarea class="form-control input-sm" id="descricao" name="descricao"
                                          value=""  required oninvalid="setCustomValidity('Digite a Descrição do Documento.')"
                                          oninput="setCustomValidity('')" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row " id="anexarDocumento">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="arquivoDocumento" class="font-12 grey">Anexar Documento *: </label>
                                <input type="file" id="arquivoDocumento" name="arquivoDocumento" class="filestyle font-12" data-icon="false"  required>
                                <small id="fileHelp" class="form-text text-muted">Tam.Máx.:30MB - Tipo Arquivo: Bitmap, JPG, PDF e PNG</small>

                            </div>
                        </div>

                    </div>
                    <div class="row no-display" id="listaArquivoDocumento">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label class="font-12 grey">Documento Anexado:</label>
                                <div id="arquivoDoc"></div>

                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>&nbsp; </label>
                                <button class="btn btn-primary btn-sm mt-25" id="btnDocumento" onclick="carregarDocumento()">Carregar Documento e Salvar &nbsp;&nbsp;
                                    &nbsp; <i
                                            class="glyphicon
                                    glyphicon-refresh  spin hidden spin-loader"></i> </button>

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