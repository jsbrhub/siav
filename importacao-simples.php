<?php
/**
 * Created by PhpStorm.
 * User: Pança
 * Date: 03/11/2020
 * Time: 13:57
 */

require_once "classes/class.Controle.php";

$conn = new Conexao();

$oControle = new Controle();

if (($handle = fopen("empresas-importacao.csv", "r")) !== FALSE) {

    $sqlAutenticacao ="insert into autenticacaoempresa (cnpj, email) values ";

    $sqlEmpresa ="insert into empresa (cnpj, razaoSocial, anoAprovacao, email, vigente) values ";

    $sqlCampanha = "insert into empresacampanha (idCampanha, cnpj, status) values ";

    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

        if($x == 0)
            $h = $data;
        else{
            $line = array_combine($h, $data);

            $oEmpresa = $oControle->getRowAutenticacaoempresa(["cnpj = '{$line["cnpj"]}'"]);

            if(!$oEmpresa instanceof Autenticacaoempresa){
                $sqlAutenticacaoPart[] = "('{$line["cnpj"]}', '{$line["email"]}')";

                $sqlEmpresapart[] = "('{$line["cnpj"]}', '{$line["razaoSocial"]}', '{$line["anoAprovacao"]}','{$line["email"]}', 1)";

                $sqlCampanhaPart[] = "(17, '{$line["cnpj"]}', 1)";
            }
        }

        $x++;
    }

    $conn->execute($sqlAutenticacao.join($sqlAutenticacaoPart, ","));

    $conn->execute($sqlEmpresa.join($sqlEmpresapart, ","));

    $conn->execute($sqlCampanha.join($sqlCampanhaPart, ","));

    fclose($handle);
}

