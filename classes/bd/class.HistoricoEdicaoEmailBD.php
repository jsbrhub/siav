<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.HistoricoEdicaoEmail.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.HistoricoEdicaoEmailMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.HistoricoEdicaoEmailBDBase.php');

class HistoricoEdicaoEmailBD extends HistoricoEdicaoEmailBDBase{
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