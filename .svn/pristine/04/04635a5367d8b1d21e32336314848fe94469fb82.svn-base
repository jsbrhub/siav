<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 08/10/2019
 * Time: 16:09
 */

require_once "classes/class.Controle.php";

$oControle = new Controle();

if(isset($_SESSION["usuarioAtual"])){
    $oControle->alteraSenhaEmpresa($_SESSION["usuarioAtual"]["email"], $_POST["senha"], $_SESSION["usuarioAtual"]["cnpj"]);

    echo json_encode([
        "success" => true,
        "msg"     => "Sua Senha foi alterada com sucesso!"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "msg"     => "Houve um prolema na operação, tente novamente mais tarde!"
    ]);
}
