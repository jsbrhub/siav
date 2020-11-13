<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 14/11/2017
 * Time: 13:48
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();

$idEmpresa = $_REQUEST['id'];
$tipo = [];
$erro = 0;

if($idEmpresa){
    $oEmpresa = $oControle->getEmpresa($idEmpresa);
    $oFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
    $listaContatos = $oControle->getTodosContatosEmpresa($idEmpresa);
    $listaAcionistas = $oControle->getAcionistasByEmpresa($idEmpresa);
    $listaIncentivos = $oControle->listarIncentivosIdEmpresa($idEmpresa);
    $listaInsumos = $oControle->getListaOrigemInsumosPorEmpresa($idEmpresa);
    $listaDocumentos = $oControle->listaDocumentosEmpresa($idEmpresa);
    $listaProjeto = $oControle->getAllProjetosByEmpresa($idEmpresa);
    $listaPolitica = $oControle->getAllPoliticaByEmpresa($idEmpresa);

    Util::trace($oEmpresa,false);
    Util::trace($oFinanceiro,false);
    Util::trace($listaContatos,false);
    Util::trace($listaAcionistas,false);
    Util::trace($listaIncentivos,false);
    Util::trace($listaInsumos,false);
    Util::trace($listaDocumentos,false);
    Util::trace($listaProjeto,false);
    Util::trace($listaPolitica,false);


    if($oEmpresa){
        if($listaIncentivos) {
            foreach ($listaIncentivos as $incentivo) {

                $atoDeclaratorio = $oControle->getAtoDecByIdIncentivoEmpresa($incentivo->idIncentivoEmpresa);
                if($atoDeclaratorio){
                    if(!$oControle->excluiAtodeclaratorio($atoDeclaratorio->idAtoDeclaratorio)){
                        Util::trace($oControle->msg);
                        $tipo['erro'] = 'atodeclaratorio';
                        ++$erro;
                    }
                }

                $mercadoConsumidor = $oControle->getListaMercadPorIncentivo($incentivo->idIncentivoEmpresa);
                if($mercadoConsumidor){
                    if(!$oControle->excluiMercadoconsumidor($mercadoConsumidor->idMercado)){
                        Util::trace($oControle->msg);
                        $tipo['erro'] = 'mercadoconsumidor';
                        ++$erro;
                    }
                }

                if(!$oControle->excluiIncentivoempresa($incentivo->idIncentivoEmpresa)){
                    Util::trace($oControle->msg);
                    $tipo['erro'] = 'incentivoempresa';
                    ++$erro;
                }


            }
        }


        if($oFinanceiro){
            if(!$oControle->excluiCadastrofinanceiro($oFinanceiro->idCadastroFinanceiro)){
                Util::trace($oControle->msg);
                $tipo['erro'] = 'financeiro';
                ++$erro;
            }
        }

        if($listaContatos){
            foreach ($listaContatos as $contato){
                if(!$oControle->excluiContatoempresa($contato->idContatoEmpresa)){
                    Util::trace($oControle->msg);
                    $tipo['erro'] = 'contato';
                    ++$erro;
                }
            }
        }
        if($listaAcionistas){
            foreach ($listaAcionistas as $acionista){
                if(!$oControle->excluiAcionista($acionista->idAcionista)){
                    Util::trace($oControle->msg);
                    $tipo['erro'] = 'acionista';
                    ++$erro;
                }
            }
        }


        if($listaInsumos){
            foreach ($listaInsumos as $insumo){
                if(!$oControle->excluiOrigeminsumos($insumo->idOrigemInsumos)){
                    Util::trace($oControle->msg);
                    $tipo['erro'] = 'origeminsumos';
                    ++$erro;
                }
            }
        }
        if($listaDocumentos){
            foreach ($listaDocumentos as $documento){
                if(!$oControle->excluiArquivoempresa($documento->idArquivoEmpresa)){
                    Util::trace($oControle->msg);
                    $tipo['erro'] = 'arquivoempresa';
                    ++$erro;
                }

            }
        }

        if($listaProjeto){
            foreach ($listaProjeto as $projeto){
                $listaArqProj = $oControle->getArquivosByProjeto($projeto->idProjeto);

                if($listaArqProj){



                        if(!$oControle->excluiArquivoprojeto($listaArqProj->idArquivoProj)){
                            Util::trace($oControle->msg);
                            $tipo['erro'] = 'arquivoprojeto';
                            ++$erro;

                        }

                }
               if(!$oControle->excluiProjsocioambiental($projeto->idProjeto)){
                   Util::trace($oControle->msg);
                   $tipo['erro'] = 'projeto';
                    ++$erro;
               }
            }
        }


        if($listaPolitica){
            foreach ($listaPolitica as $politica){
                    $listaArqPol = $oControle->getArquivosByPolitica($politica->idPolitica);
                    if($listaArqPol){
                            if(!$oControle->excluiArquivopolitica($listaArqPol->idArquivoPol)){
                                Util::trace($oControle->msg);
                                $tipo['erro'] = 'arquivopolitica';
                                ++$erro;
                            }


                    }
                    if(!$oControle->excluiPoliticaambiental($politica->idPolitica)){
                        Util::trace($oControle->msg);
                        $tipo['erro'] = 'politica';
                        ++$erro;
                    }
                }
            }
        }


    }

    Util::trace($erro,false);
if($erro == 0){
    $verificaControle = $oControle->getControleByIdEmpresa($idEmpresa);
    if($verificaControle){
        $oControle->excluiEmpresacontrole($verificaControle->idEmpresaControle);
    }
    $oControle->excluiEmpresa($idEmpresa);
    Util::trace($oControle->msg,false);
    echo "excluido com sucesso";
}else{
   echo $erro;

    Util::trace($tipo,false);
    Util::trace($oControle->msg);
}
