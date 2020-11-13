<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Politicaambiental.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.PoliticaambientalMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.PoliticaambientalBDBase.php');

class PoliticaambientalBD extends PoliticaambientalBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getAllPoliticaByEmpresa($idEmpresa){
        $sql = "
				select
					".PoliticaambientalMAP::dataToSelect()." 
				from
					politicaambiental 
				left join empresa 
					on (politicaambiental.idEmpresa = empresa.idEmpresa)
				where politicaambiental.idEmpresa = $idEmpresa
				";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = PoliticaambientalMAP::rsToObj($aReg);
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