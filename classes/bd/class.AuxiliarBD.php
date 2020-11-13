<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Auxiliar.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.AuxiliarMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.AuxiliarBDBase.php');

class AuxiliarBD extends AuxiliarBDBase{
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