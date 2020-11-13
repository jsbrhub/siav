<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 01/02/2019
 * Time: 14:35
 */

require_once "classes/class.Controle.php";

$oControle = new Controle();

$oEmpresa = $oControle->getRowEmpresa(["empresa.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'", "fonteOrigem = 'SIN'", "vigente = 1"]);

echo json_encode($oEmpresa);