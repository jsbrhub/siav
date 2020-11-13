<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Incentivos.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.IncentivosMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.IncentivosBDBase.php');

class IncentivosBD extends IncentivosBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    
}