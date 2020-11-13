<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.ResponsaveisAssinaturas.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ResponsaveisAssinaturasMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ResponsaveisAssinaturasBDBase.php');

class ResponsaveisAssinaturasBD extends ResponsaveisAssinaturasBDBase{
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