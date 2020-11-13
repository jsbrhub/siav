<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 14/11/2019
 * Time: 10:36
 */

require_once "classes/class.Controle.php";


$oControle = new Controle();

$emrpesasNaoEncontradas = [];

$row = 1;
if (($handle = fopen("siav-arquivo-teste.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {


        if($row > 1 ){

            $cnpj = Util::limpaCPF_CNPJ($data[6]);

            $oEmpresa = $oControle->getRowEmpresa(["cnpj = '{$cnpj}'"]);

            if(!$oEmpresa instanceof Empresa){

                $emrpesasNaoEncontradas[] = $data;

                $empresaBD = new EmpresaBD();

                $oEmpresa = Util::populate(new Empresa(), [
                    "numSudam" => "59004/000532/2016-25",
                    "cnpj" => $cnpj,
                    "setor" => $data[2],
                    "razaoSocial" => $data[1],
                    "procurador" => $data[3],
                    "laudoNumero" => $data[4],
                    "vigente" => "1",
                    "fonteOrigem" => "WEB",
                    "oSituacao" => new Situacao("4"),
                    "dataHoraAlteracao" => date("Y-m-d H:i:s"),
                    "situacaoCadastro" => "3"
                ]);

//                Util::trace($oEmpresa);

                $idEmpresa = $empresaBD->inserir($oEmpresa);


                $autenticacaoBD = new AutenticacaoempresaBD();


                $oAutenticacao = Util::populate(new Autenticacaoempresa(), [
                   "cnpj" => $cnpj,
                   "senha" => md5('123456'),
                   "email" => $data[7],
                   "senhaProv" => '123456'
                ]);

                $idAutenticacao = $autenticacaoBD->inserir($oAutenticacao);


                $empresaCampanhaBD = new EmpresacampanhaBD();

                $oEmpersaCampanha = Util::populate(new Empresacampanha(), [
                    "oCampanha" => new Campanha("14"),
                    "cnpj" => $cnpj,
                    "status" => "1"
                ]);


                $idEmpresaCampanha = $empresaCampanhaBD->inserir($oEmpersaCampanha);

            }
        }
        $row++;
    }
    fclose($handle);
}


Util::trace($emrpesasNaoEncontradas);
