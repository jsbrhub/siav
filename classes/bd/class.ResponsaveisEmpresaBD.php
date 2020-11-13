<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.ResponsaveisEmpresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ResponsaveisEmpresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ResponsaveisEmpresaBDBase.php');

class ResponsaveisEmpresaBD extends ResponsaveisEmpresaBDBase{
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