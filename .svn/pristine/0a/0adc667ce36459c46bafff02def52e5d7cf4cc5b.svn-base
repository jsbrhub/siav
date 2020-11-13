<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 06/11/2017
 * Time: 11:49
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
$tipoErro = [];
$erro = 0;

if($_REQUEST['dados'] == 'concluir'){
    $infoEmpresa = $oControle->getEmpresa($_REQUEST['idEmpresa']);
    $infoFinanceiro = $oControle->getFinanceiroByEmpresa($_REQUEST['idEmpresa']);
    $listaContatos = $oControle->getTodosContatosEmpresa($_REQUEST['idEmpresa']);
    $listaAcionistas = $oControle->getAcionistasByEmpresa($_REQUEST['idEmpresa']);
    $listaIncentivos = $oControle->listarIncentivosByIdEmpresa($infoEmpresa->idEmpresa);
    $listaInsumos = $oControle->getListaOrigemInsumosPorEmpresa($_REQUEST['idEmpresa']);
    $listaDocumentos = $oControle->listaDocumentosEmpresa($_REQUEST['idEmpresa']);

    $cnpj = $_SESSION["usuarioAtual"]["cnpj"];


    if(empty($cnpj)){
        $oEmpresa = $oControle->getEmpresa($_REQUEST["idEmpresa"]);

        $cnpj = $oEmpresa->cnpj;
    }



    //Util::trace($infoEmpresa,false);
    //Util::trace($infoFinanceiro,false);
  //  Util::trace($listaContatos,false);
   // Util::trace($listaAcionistas,false);
    //Util::trace($listaIncentivos,false);
    //Util::trace($listaDocumentos,false);


    if(!$listaContatos){
        $tipoErro['contato'] = '1';
        ++$erro;
    }else{
        $quantContato = count($listaContatos);
       // Util::trace($quantContato,false);
        if($quantContato < '2'){
            $tipoErro['contato'] = '1';
            ++$erro;
        }else{
            $tipoErro['contato'] = '';
        }
    }

    if(!$listaAcionistas){
        $tipoErro['acionista'] = '1';
        ++$erro;
    }else{
        $tipoErro['acionista'] = '';
    }


    if($listaIncentivos){
        foreach ($listaIncentivos as $incentivo){
            if(!$incentivo->produtoIncentivado){ ++$erro;  $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->cnae){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->faturamento){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->emprego){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->producao){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->idUnidadeCapacidade){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->capacidadeInstalada){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->idUnidadeProducao){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->anoInicial){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }
            if(!$incentivo->anoFinal){ ++$erro; $tipoErro['incentivoEmpresa'] = '1'; }

            if($tipoErro['incentivoEmpresa'] != '1'){
                $tipoErro['incentivoEmpresa'] = '';
            }


          $atoDeclaratorio = $oControle->getAtoDecByIdIncentivoEmpresa($incentivo->idIncentivoEmpresa);
          if(!$atoDeclaratorio){

              $tipoErro['atoDeclaratorio'] = $atoDeclaratorioErro = '1';
              ++$erro;
          }else{
              if(!file_exists("files/".$atoDeclaratorio->novoNome)){
                  $tipoErro['atoDeclaratorio'] =$atoDeclaratorioErro = '1';
                  ++$erro;
              } else
                $tipoErro['atoDeclaratorio'] = '';
          }

          $mercadoConsumidor = $oControle->getListaMercadPorIncentivo($incentivo->idIncentivoEmpresa);

          if($mercadoConsumidor){
              $erroMercado = 0;
              $m1 = $mercadoConsumidor->quantidadeRegional;
              $m2 = $mercadoConsumidor->quantidadeNacional;
              $m3 = $mercadoConsumidor->quantidadeExterior;
              $totalm = $m1+$m2+$m3;
              if(($totalm == 100 || $totalm == 0) && $tipoErro['mercadoConsumidor'] == '' ){
                  $tipoErro['mercadoConsumidor'] = '';
              }else{
                  $tipoErro['mercadoConsumidor'] = ++$erroMercado;
                  //echo "entrei m";
                  ++$erro;
              }
          }
        }



    } else {
        ++$erro;  $tipoErro['incentivoEmpresa'] = '1';
    }
    if($listaInsumos){
        foreach ($listaInsumos as $insumo){
            $erroInsumo = 0;
            $q1 = $insumo->quantidadeRegional;
            $q2 = $insumo->quantidadeNacional;
            $q3 = $insumo->quantidadeExterior;
            $totalq = $q1+$q2+$q3;
           // Util::trace($totalq,false);
            if(($totalq == 100 || $totalq == 0) && $tipoErro['origemInsumo'] == '') {

                $tipoErro['origemInsumo'] = '';

            }else{
                $tipoErro['origemInsumo'] = ++$erroInsumo;
                //echo "entrei q";
                ++$erro;
            }
        }
    }
    if($infoEmpresa->projetoSocial != '1'){
        $listaProjeto = $oControle->getAllProjetosByEmpresa($_REQUEST['idEmpresa']);
        if(!$listaProjeto){
            $tipoErro['projeto'] = '1';
            ++$erro;
        }else{
            $tipoErro['projeto'] = '';
        }

    }else{
        $tipoErro['projeto'] = '';
    }

    if($infoEmpresa->politicaAmbiental != '1'){
        $listaPolitica = $oControle->getAllPoliticaByEmpresa($_REQUEST['idEmpresa']);
        if(!$listaPolitica){
            $tipoErro['politica'] = '1';
            ++$erro;
        }else {
            $tipoErro['politica'] = '';
        }
    }else{
        $tipoErro['politica'] = '';
    }


    if($listaDocumentos){

            foreach ($listaDocumentos as $documento){
                if(!$documento->nomeArquivo){
                    $tipoErro['documento'] = '1';
                    ++$erro;
                }

                if(!file_exists("files/".$documento->novoNome)){
                    $tipoErro['documento_arquivo_existe'] = '1';
                    ++$erro;
                }
            }
            if($tipoErro['documento'] != '1'){
                $tipoErro['documento'] = '';
            }

            if($tipoErro['documento_arquivo_existe'] != '1'){
                $tipoErro['documento_arquivo_existe'] = '';
            }
    }

    $voEmpresaCampanhaResposnaveis = $oControle->getAllEmpresaCampanhaResponsaveis([
        "empresacampanha.cnpj = '{$cnpj}'",
        "empresa_campanha_responsaveis.situacao in (0,1)",
        "empresa_campanha_responsaveis.idCampanha = '{$_REQUEST["idCampanha"]}'"

    ]);

    if($voEmpresaCampanhaResposnaveis === false){
        $tipoErro['responsaveis'] = '1';
        ++$erro;
    } else {
        $tipoErro['responsaveis'] = '';
    }



    if(is_array($voEmpresaCampanhaResposnaveis)){

        foreach ($voEmpresaCampanhaResposnaveis as $oResponsaveis){
            $idResponsaveis[] = $oResponsaveis->idEmpresaCampanhaResponsaveis;
            $responsaveis[$oResponsaveis->situacao][] = $oResponsaveis->idEmpresaCampanhaResponsaveis;
        }

        if(is_array($responsaveis[0])){
            $tipoErro['responsaveis_enviar'] = '1';

            ++$erro;

            $tipoErro['responsaveis_assinatura'] = '1';

        } else {
            $tipoErro['responsaveis_enviar'] = '';


            $voNaoAssinados = $oControle->getAllEmpresaCampanhaResponsaveis([
                "(idEmpresaCampanhaResponsaveis not in (select idEmpresaCampanhaResponsaveis from responsaveis_assinaturas where idEmpresaCampanhaResponsaveis in (".join(",", $idResponsaveis).")) )",
                "empresa_campanha_responsaveis.situacao in (0,1)",
                "empresa_campanha_responsaveis.idCampanha = '{$_REQUEST["idCampanha"]}'",
                "empresacampanha.cnpj = '{$cnpj}'"
            ]);



            if(is_array($voNaoAssinados)){
                $tipoErro['responsaveis_assinatura'] = '1';
                ++$erro;
            } else {
                $tipoErro['responsaveis_assinatura'] = '';
            }
        }

    }

    //força erro de assinatura de responsaveis
    #$tipoErro['responsaveis_assinatura'] = '1';
    #$erro = 1;


    if($atoDeclaratorioErro == "1")
        $tipoErro['atoDeclaratorio'] = "1";

  //  Util::trace($tipoErro);

    if($erro > 0) {
        $retorno['erro'] = $erro;
        $retorno['idEmpresa'] = $_REQUEST['idEmpresa'];
        $retorno['tipoErro'] = $tipoErro;
        echo json_encode($retorno);
        exit;
    }else{
        $erro = '';
        $retorno['erro'] = $erro;
        $retorno['idEmpresa'] = $_REQUEST['idEmpresa'];

        $verificaRetificacao = $oControle->verificaIdEmpresaRet($_REQUEST['idEmpresa']); //verifica se a empresa tem retificação
        if($verificaRetificacao){
            $oControle->updateStatusRet($verificaRetificacao->oRetificacaoempresa->idRetEmpresa,'5');
            $oControle->updateStatusHistorico($verificaRetificacao->idHistRet,'2');
            $verificaControle = $oControle->getControleByIdEmpresa($_REQUEST['idEmpresa']);
            $idCampanha = $verificaControle->oCampanha->idCampanha;
            $hash = md5($_REQUEST['idEmpresa'].'0'.$idCampanha.'0'.date("Y.m.d H.s.i"));
            $postTermo = ['oCampanha' => new Campanha($idCampanha), 'oEmpresa' => new Empresa($_REQUEST['idEmpresa']), 'cnpj' =>
                $verificaControle->oEmpresa->cnpj, 'comprovante' =>$hash, 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAlteracao']];
            $TermoresponsabilidadeBD = new TermoresponsabilidadeBD();
            $oTermo = Util::populate(new Termoresponsabilidade(),$postTermo);
            $TermoresponsabilidadeBD->inserir($oTermo);
            $retorno['idHistRet'] = $verificaRetificacao->idHistRet;
        }else{
            $idCampanha = $_REQUEST['idCampanha'];
            $retorno['idHistRet'] = 0;
            $oControle->updateHashComprovante($_REQUEST['idEmpresa'], $idCampanha);
            $oControle->updateStatusEmpresaCampanha($idCampanha, $infoEmpresa->cnpj, '3');
        }
        $infoCampanha = $oControle->getCampanha($idCampanha);
        $oControle->updateSituacaoCadastroEmpresa($_REQUEST['idEmpresa'],'2');
        $checaControle = $oControle->getControleByIdEmpresa( $_REQUEST['idEmpresa']);
        $retorno['idCampanha'] = $idCampanha;
        if($checaControle)$idEmpresaControle = $checaControle->idEmpresaControle;
        $oControle->updateControleConclusao($idEmpresaControle);
        $retorno['anoBase'] = $infoCampanha->anoBase;
        unset($retorno['tipoErro']);
        echo json_encode($retorno);
        exit;
    }


}
?>
<div class="">
    <div class="row p-20">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="well well-lg font-12 grey"><strong> <i class="glyphicon glyphicon-hand-right"></i> <span id="msgConclusao">Antes de concluir a
                        atualização, certifique-se que todas as abas foram preenchidas corretamente e de acordo com as normas do edital.</span></strong></div>
        </div>
        <div class="col-md-1"></div>
    </div>
    <form role="form" onsubmit="return false;" id="form-concluir" class="" >
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
<!--                <button class="btn btn-primary btn-sm mt-25" id="btnDocumento" onclick="gerarComprovantePDF(1,1)"> <i-->
<!--                            class="glyphicon-->
<!--                glyphicon-hand-right"></i>&nbsp;&nbsp;-->
<!--                    Imprimir Comprovante &nbsp;&nbsp;-->
<!--                    &nbsp; <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i> </button>-->
            </div>
        </div>
        <div class="col-md-4 text-center">
            <div class="form-group">
                <a href="#" data-enviar-para-responsaveis="<?= $_GET["idCampanha"]; ?>" class="btn btn-primary">Enviar para responsáveis pela empresa</a>
                <br />
                <br />
                <button class="btn btn-primary btn-sm mt-25" id="btnDocumento" onclick="concluirAtualizacao(<?=$idEmpresa?>,<?=$_GET["idCampanha"]?>)"> <i
                class="glyphicon
                glyphicon-hand-right"></i>&nbsp;&nbsp;
                    Concluir Atualização &nbsp;&nbsp;
                    &nbsp; <i class="glyphicon glyphicon-refresh  spin hidden spin-loader"></i> </button>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

            </div>
        </div>
    </div>
    </form>
    <div  class="row p-20 no-display" id="conclusao">
        <div class="panel panel-danger" id="pendenciasList">
            <div class="panel-heading">Lista de Pendências</div>
            <div class="panel-body">
                <div class="col-md-12 font-12 grey">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="contato_">
                                <ul>
                                    <strong> <li id="concMsgContato" ></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="acionista_">
                                <ul>
                                    <strong><li id="concMsgAcionista"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="incentivo_">
                                <ul>
                                    <strong><li id="concMsgIncentivo"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="AtoDec_">
                                <ul>
                                    <strong><li id="concMsgAtoDec"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="origem_">
                                <ul>
                                    <strong><li id="concMsgOrigem"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="mercado_">
                                <ul>
                                    <strong><li id="concMsgMercado"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="documento_">
                                <ul>
                                    <strong><li id="concMsgDocumento"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="documento_arquivo_existe_">
                                <ul>
                                    <strong><li id="concMsgDocumentoArquivoExiste"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="projeto_">
                                <ul>
                                    <strong><li id="concMsgProjeto"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="politica_">
                                <ul>
                                    <strong><li id="concMsgPolitica"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="responsaveis_">
                                <ul>
                                    <strong><li id="concMsgResponsaveis"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="responsaveis_enviar_">
                                <ul>
                                    <strong><li id="concMsgResponsaveisEnviar"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group no-display" id="responsaveis_assinatura_">
                                <ul>
                                    <strong><li id="concMsgResponsaveisAssinatura"></li></strong>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>