<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 02/10/2017
 * Time: 09:25
 */
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();
$retorno = [];
if(isset($_REQUEST['idEmpresa'])){
    $empresa = $oControle->getEmpresa($_REQUEST['idEmpresa']);
    if($empresa){
        $formataCnpj = Util::formataCNPJ($empresa->cnpj);
        $endereco = $empresa->endereco; if(!$endereco)$endereco = '-';
        $bairro = $empresa->bairro; if(!$bairro)$bairro = '-';
        $cep = $empresa->cep; if(!$cep)$cep = '-';
        $cidade = $empresa->oMunicipio->municipio.' / '.$empresa->oMunicipio->uf; if(!$cidade)$cidade = '-';
        $tel = $empresa->telefone; if(!$tel)$tel = '-';
        $email = $empresa->email; if(!$email)$email = '-';
        $contato =  $oControle->getContatoempresa($empresa->idEmpresa);
        $contato = $contato->contato; if(!$contato)$contato = '-';
            echo '<tr class="font-12">' .
                '<td nowrap="yes">' . $formataCnpj . '</td>' .
                '<td>' . ($empresa->razaoSocial) . '</td>' .
                '<td>' . $cidade . '</td>' .
                '<td><input type="hidden" id="idEmp[]" name="idEmp[]" value="' . $empresa->idEmpresa . '" /> <span id="EMP' . $empresa->cnpj . '" name="EMP' . $empresa->cnpj . '" ></span>
              <button type="button" onclick="remove(this)" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button></td>' .
                '</tr>';

    }else{
        echo "1";
        exit;
    }
}

if(isset($_REQUEST['acao'])){

    if($_REQUEST['acao'] == 'del'){

        $infoEmpresaCampanha = $oControle->getEmpresacampanha($_REQUEST['idEmpresaCampanha']);
        $infoCampanha = $oControle->getCampanha($infoEmpresaCampanha->oCampanha->idCampanha);

        //Util::trace($infoCampanha);
        if($infoCampanha->situacao == '1'){
            $oControle->excluiEmpresacampanha($_REQUEST['idEmpresaCampanha']);
            $totalEmpresasCampanha = $oControle->getTodasEmpresasCampanha($_REQUEST['idCampanha']);
            if(is_array($totalEmpresasCampanha)) {
                $total = count($oControle->getTodasEmpresasCampanha($_REQUEST['idCampanha']));
                $oControle->updateTotalEmpresasCampanha($_REQUEST['idCampanha'],$total);

                $retorno['total'] = $total;
                echo json_encode($retorno);
                exit;
            }else{
                $retorno['total'] = '0';
                echo json_encode($retorno);
                exit;
            }
        }else{
            $retorno['data'] = '1';
            echo json_encode($retorno);
            exit;
        }

    }

    if($_REQUEST['acao'] == 'todas'){
        $todasEmpresas = $oControle->retornaEmpresasVigentesGroupByCnpj();
        if($todasEmpresas) {
            echo count($todasEmpresas);
        }
    }

    if($_REQUEST['acao'] == 'concluir'){


        //Util::trace($_REQUEST['acao']);
        if($_REQUEST['empresa'] == 'todas' &&  $_REQUEST['todasEmpresas'] == '1'){
            $idCampanha = $_REQUEST['idCampanha'];
            $oControle->limparEmpresaCampanha($idCampanha);
            $todasEmpresas = $oControle->retornaEmpresasVigentesGroupByCnpj();
            $oEmpresaCampanhaBD = new EmpresacampanhaBD(); //  chamo o bd
            if($todasEmpresas)
            foreach ($todasEmpresas as $empresa){
                $cnpj = $empresa->cnpj;
                $POST = ['oCampanha' => new Campanha($idCampanha),'cnpj' =>$cnpj, 'status' => '1']; //status 1 - pendente
                $oEmpresaCampanha = Util::populate(new Empresacampanha(),$POST); //chamo o objeto incentivos
                $oEmpresaCampanhaBD->inserir($oEmpresaCampanha); //faço o insert
            }
            $totalEmpresasCampanha = $oControle->getTodasEmpresasCampanha($idCampanha);
           // Util::trace($todasEmpresas);
            if($totalEmpresasCampanha) {
                $tot = is_array($totalEmpresasCampanha) ?  count($totalEmpresasCampanha) : '0';
                $oControle->updateTotalEmpresasCampanha($idCampanha,$totalEmpresasCampanha);
                $retorno['totalEmpresas'] = $tot;
                $retorno['todasEmpresas'] = '1';
            }else{
                $retorno['totalEmpresas'] = "0";
                $retorno['todasEmpresas'] = "0";
            }
            echo json_encode($retorno);
            exit;
        }
        if($_REQUEST['empresa'] == 'selecionadas'){
            $listaEmpresas = $_POST['idEmp'];
            $idCampanha = $_REQUEST['idCampanha'];
            if($_REQUEST['todasEmpresas'] == '1'){
                $empresasAdicionadas = $oControle->getTodasEmpresasCampanha($idCampanha);
                if($empresasAdicionadas){
                    $oControle->limparEmpresaCampanha($idCampanha);
                }
            }
            //Util::trace($idCampanha);
            $oEmpresaCampanhaBD = new EmpresacampanhaBD();
            if($listaEmpresas)
            foreach ($listaEmpresas as $idEmpresa){
                $infoEmpresa = $oControle->getEmpresa($idEmpresa);
                $cnpj = $infoEmpresa->cnpj;
               // Util::trace($listaEmpresas);

                $checaEmpresaCam = $oControle->checaEmpresaCampanha($idCampanha,$cnpj);
                if(!$checaEmpresaCam){
                    $POST = ['oCampanha' => new Campanha($idCampanha),'cnpj' =>$cnpj, 'status' => '1']; //status 1 -
                    // pendente
                    $oEmpresaCampanha = Util::populate(new Empresacampanha(),$POST); //chamo o objeto incentivos
                    if(!$oEmpresaCampanhaBD->inserir($oEmpresaCampanha)){
                        echo $oEmpresaCampanhaBD->msg;
                        //exit();
                    } //faço o insert
                }
            }

            $totalEmpresasCampanha = $oControle->getTodasEmpresasCampanha($idCampanha);
           // Util::trace($totalEmpresasCampanha);
            if($totalEmpresasCampanha) {
                $tot = is_array($totalEmpresasCampanha) ?  count($totalEmpresasCampanha) : '0';
                $oControle->updateTotalEmpresasCampanha($idCampanha,$totalEmpresasCampanha);
                $retorno['totalEmpresas'] = $tot;
                $retorno['todasEmpresas'] = '0';
            }else{
                $retorno['totalEmpresas'] = "0";
                $retorno['todasEmpresas'] = '0';
            }
            echo json_encode($retorno);
            exit;
        }
    }
}

