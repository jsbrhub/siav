<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.EmpresaCampanhaResponsaveis.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.EmpresaCampanhaResponsaveisMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.EmpresaCampanhaResponsaveisBDBase.php');

class EmpresaCampanhaResponsaveisBD extends EmpresaCampanhaResponsaveisBDBase{
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