<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Situacao.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.SituacaoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.SituacaoBDBase.php');

class SituacaoBD extends SituacaoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function retornaSituacao($situacao){
        $sql = "
                select 
					".SituacaoMAP::dataToSelect()." 
                from
					situacao 
                where
					situacao.situacao like '%$situacao%'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return SituacaoMAP::rsToObj($aReg);
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
	
    
}