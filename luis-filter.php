<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 08/10/2018
 * Time: 16:07
 */


$ar = [
    "uf" => [
        [
            "banco" => "bradesco",
            "total" => 120
        ],
        [
            "banco" => "itau",
            "total" => 500
        ]
    ]
];


$retorno = array_filter($ar["uf"], function($valor, $chave) use (&$ar){
    if($valor["banco"] == "bradesco"){
        $ar["uf"][$chave]["novo_valor"] = "teste";
    }
}, ARRAY_FILTER_USE_BOTH);
