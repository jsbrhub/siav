<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Responsaveis.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ResponsaveisMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ResponsaveisBDBase.php');

class ResponsaveisBD extends ResponsaveisBDBase{
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