<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Projsocioambiental.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ProjsocioambientalMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ProjsocioambientalBDBase.php');

class ProjsocioambientalBD extends ProjsocioambientalBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getAllProjetosByEmpresa($idEmpresa){
        $sql = "
				select
					".ProjsocioambientalMAP::dataToSelect()." 
				from
					projsocioambiental 
				left join empresa 
					on (projsocioambiental.idEmpresa = empresa.idEmpresa)
				where
				    projsocioambiental.idEmpresa = $idEmpresa	
					";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ProjsocioambientalMAP::rsToObj($aReg);
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