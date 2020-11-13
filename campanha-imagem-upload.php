<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 30/09/2019
 * Time: 16:48
 */

if(isset($_FILES["imagem"]) && !empty($_FILES["imagem"]["name"])){
    copy($_FILES["imagem"]["tmp_name"], "img/campanhas/{$_POST["idCampanha"]}-{$_FILES["imagem"]["name"]}");
}

if(!empty($_POST["idCampanha"]) || !empty($_GET["idCampanha"])){
    $files = glob("img/campanhas/{$_POST["idCampanha"]}-*");

    echo json_encode($files);
}