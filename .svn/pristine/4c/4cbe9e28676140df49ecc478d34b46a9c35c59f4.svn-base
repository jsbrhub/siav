<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Unidademedida.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.UnidademedidaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.UnidademedidaBDBase.php');

class UnidademedidaBD extends UnidademedidaBDBase{
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