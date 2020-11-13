<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Acionista.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.AcionistaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.AcionistaBDBase.php');

class AcionistaBD extends AcionistaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getAcionistasByEmpresa($idEmpresa){
        $sql = "
				select
					".AcionistaMAP::dataToSelect()." 
				from
					acionista 
				left join empresa 
					on (acionista.idEmpresa = empresa.idEmpresa)
				where
				    acionista.idEmpresa = '$idEmpresa'
				";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = AcionistaMAP::rsToObj($aReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
    
}