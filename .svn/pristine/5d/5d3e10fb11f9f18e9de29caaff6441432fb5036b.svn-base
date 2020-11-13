<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Retificacaosudam.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.RetificacaosudamMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.RetificacaosudamBDBase.php');

class RetificacaosudamBD extends RetificacaosudamBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getRetificaoSudamByIdRetEmpresa($idRetEmpresa){
        $sql = "
                select 
					" .RetificacaosudamMAP::dataToSelect(). "  
                from   
					retificacaosudam 
				left join retificacaoempresa 
					on (retificacaosudam.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where        
					retificacaosudam.idRetEmpresa = '$idRetEmpresa'";
        //Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return RetificacaosudamMAP::rsToObj($aReg);
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

    function retificacaoAprovadaComMenos15Dias($cnpj){
        $sql = "
                select 
					" .RetificacaosudamMAP::dataToSelect(). "  
                from   
					retificacaosudam 
				left join retificacaoempresa 
					on (retificacaosudam.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where        
					retificacaoempresa.cnpj = '$cnpj' AND
					retificacaoempresa.status = '3' AND
					DATEDIFF(retificacaosudam.dataAlteracao,CURDATE()) < 15
					";
        //Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return RetificacaosudamMAP::rsToObj($aReg);
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
    function listaRetificacoesAprovadaComMais15Dias(){
        $sql = "
                select 
					" .RetificacaosudamMAP::dataToSelect(). "  
                from   
					retificacaosudam 
				left join retificacaoempresa 
					on (retificacaosudam.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where        
					retificacaoempresa.status = '3' AND
					DATEDIFF(retificacaosudam.dataAlteracao,CURDATE()) > 15
					";
        //Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = RetificacaosudamMAP::rsToObj($aReg);
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

    function listaRetificacoesAprovadaRetificada($cnpj){
        $sql = "
                select 
					" .RetificacaosudamMAP::dataToSelect(). "  
                from   
					retificacaosudam 
				left join retificacaoempresa 
					on (retificacaosudam.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where        
					retificacaoempresa.cnpj = '$cnpj' AND
					(retificacaoempresa.status = '3' OR
					retificacaoempresa.status = '5') 				
					
					";
        //Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return RetificacaosudamMAP::rsToObj($aReg);
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


    function listaRetificacoesAprovadasRetificadas($cnpj){
        $sql = "
                select 
					" .RetificacaosudamMAP::dataToSelect(). "  
                from   
					retificacaosudam 
				left join retificacaoempresa 
					on (retificacaosudam.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where        
					retificacaoempresa.cnpj = '$cnpj' AND
					(retificacaoempresa.status = '3' OR
					retificacaoempresa.status = '5') 				
					
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = RetificacaosudamMAP::rsToObj($aReg);
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