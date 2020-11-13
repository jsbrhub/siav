<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 05/10/2018
 * Time: 09:35
 */

require_once "../classes/class.Controle.php";

$oControle = new Controle();

$oValidator = new ValidadorFormulario();

$r = [
    "success" => true
];

if(count($_POST)){

    if($oValidator->validaFormularioCadastroAddResponsaveis($_POST)){

        $oEmpresaCampanha = $oControle->getRowEmpresacampanha([
            "campanha.idCampanha = '{$_POST["idCampanha"]}'",
            "empresacampanha.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'"
        ]);


        if($oEmpresaCampanha instanceof Empresacampanha){
            $ECRBD = new EmpresaCampanhaResponsaveisBD();

            $oEmpresaCampanhaResponsaveis = Util::populate(new EmpresaCampanhaResponsaveis(), [
                "oCampanha" => new Campanha($_POST["idCampanha"]),
                "oResponsaveis" => $oControle->getResponsaveis($_POST["idResponsaveis"]),
                "oEmpresacampanha" => new Empresacampanha($oEmpresaCampanha->idEmpresaCampanha),
                "situacao" => "0"
            ]);

            if($oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis = $ECRBD->inserir($oEmpresaCampanhaResponsaveis)){

                $r = [
                    "success" => true,
                    "msg" => "Operação Realizada com sucesso",
                    "data" => [
                        "idEmpresaCampanhaResponsaveis" => $oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis,
                        "nome" => $oEmpresaCampanhaResponsaveis->oResponsaveis->nome,
                        "cpf_passaporte" => $oEmpresaCampanhaResponsaveis->oResponsaveis->cpf_passaporte,
                        "email" => $oEmpresaCampanhaResponsaveis->oResponsaveis->email,
                        "idResponsaveis" => $oEmpresaCampanhaResponsaveis->oResponsaveis->idResponsaveis,
                    ]
                ];
            }
        }



    } else {
        $r = [
            "success" => false,
            "msg" => $oValidator->msg
        ];
    }
}


if(!empty($_GET["acao"])){
    switch ($_GET["acao"]){
        case "excluir":
            $ECRBD = new EmpresaCampanhaResponsaveisBD();

            $oEmpresaCampanhaResponsaveis = $oControle->getEmpresaCampanhaResponsaveis($_GET["idEmpresaCampanhaResponsaveis"]);

            if($oEmpresaCampanhaResponsaveis instanceof EmpresaCampanhaResponsaveis){


                $oEmpresaCampanhaResponsaveis->situacao = "-1";

                $ECRBD->alterar($oEmpresaCampanhaResponsaveis);

                $r = [
                    "success" => true,
                    "msg" => "Operação realizada com sucesso",
                    "data" => $oEmpresaCampanhaResponsaveis
                ];
            }

            break;
    }
}



echo json_encode($r, JSON_UNESCAPED_UNICODE);