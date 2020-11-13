<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Pesquisadesenvolvimento.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.PesquisadesenvolvimentoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.PesquisadesenvolvimentoBDBase.php');

class PesquisadesenvolvimentoBD extends PesquisadesenvolvimentoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getAllPesquisasByEmpresa($idEmpresa){
        $sql = "
				select
					".PesquisadesenvolvimentoMAP::dataToSelect()." 
				from
					pesquisadesenvolvimento 
				left join empresa 
					on (pesquisadesenvolvimento.idEmpresa = empresa.idEmpresa)
				where
				    pesquisadesenvolvimento.idEmpresa = $idEmpresa	
					";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = PesquisadesenvolvimentoMAP::rsToObj($aReg);
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