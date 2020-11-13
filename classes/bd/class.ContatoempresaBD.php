<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Contatoempresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ContatoempresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ContatoempresaBDBase.php');

class ContatoempresaBD extends ContatoempresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getContatoRecente($idEmpresa){
        $sql = "
                select 
					".ContatoempresaMAP::dataToSelect()." 
                from
					contatoempresa 
				left join empresa 
					on (contatoempresa.idEmpresa = empresa.idEmpresa) 
                where
					contatoempresa.idEmpresa = $idEmpresa order by contatoempresa.dataHoraAlteracao;
				    	";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ContatoempresaMAP::rsToObj($aReg);
            } else {
                $this->msg = "Nenhum registro encontrado!";
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function getTodosContatosEmpresa($idEmpresa){
        $sql = "
				select
					".ContatoempresaMAP::dataToSelect()." 
				from
					contatoempresa 
				left join empresa 
					on (contatoempresa.idEmpresa = empresa.idEmpresa)
				where
				    contatoempresa.idEmpresa = '$idEmpresa' ";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ContatoempresaMAP::rsToObj($aReg);
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