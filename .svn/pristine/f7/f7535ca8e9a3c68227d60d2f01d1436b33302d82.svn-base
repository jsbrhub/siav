<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Retificacaoempresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.RetificacaoempresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.RetificacaoempresaBDBase.php');

class RetificacaoempresaBD extends RetificacaoempresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getRefiticacaoByIdEmpresa($idEmpresa){
        $sql = "
				select 
					".RetificacaoempresaMAP::dataToSelect()." 
				from
					retificacaoempresa 
				left join empresa 
					on (retificacaoempresa.idEmpresa = empresa.idEmpresa)
				WHERE 
				retificacaoempresa.idEmpresa = '$idEmpresa' 
				ORDER BY
				retificacaoempresa.dataSolicitacao DESC
				";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return RetificacaoempresaMAP::rsToObj($aReg);
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

    function retornaTodasRetificacoes(){
        $sql = "
				select 
					".RetificacaoempresaMAP::dataToSelect()." 
				from
					retificacaoempresa 
				left join empresa 
					on (retificacaoempresa.idEmpresa = empresa.idEmpresa)
				
				ORDER BY retificacaoempresa.dataSolicitacao desc
				";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = RetificacaoempresaMAP::rsToObj($aReg);
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


    function retornaRetificacoesByStatus($status){
        $sql = "
				select 
					".RetificacaoempresaMAP::dataToSelect()." 
				from
					retificacaoempresa 
				left join empresa 
					on (retificacaoempresa.idEmpresa = empresa.idEmpresa)
				WHERE 
				retificacaoempresa.status = '$status' 
				ORDER BY retificacaoempresa.dataSolicitacao desc
				
				";
      //  Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = RetificacaoempresaMAP::rsToObj($aReg);
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

    function updateStatusRet($idRetEmpresa,$status){
        $sql = "
                update 
                    retificacaoempresa 
                set
                     retificacaoempresa.status = '$status' 
                where
                    retificacaoempresa.idRetEmpresa = $idRetEmpresa ";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function listaRetificacoesEmpresa($cnpj){
        $sql = "
				select 
					".RetificacaoempresaMAP::dataToSelect()." 
				from
					retificacaoempresa 
				left join empresa 
					on (retificacaoempresa.idEmpresa = empresa.idEmpresa)
				WHERE retificacaoempresa.cnpj = '$cnpj'
				
				ORDER BY retificacaoempresa.dataSolicitacao desc
				";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = RetificacaoempresaMAP::rsToObj($aReg);
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


    function verificaPendenciasRetificacao($cnpj){
        $sql = "
				select 
					".RetificacaoempresaMAP::dataToSelect()." 
				from
					retificacaoempresa 
				left join empresa 
					on (retificacaoempresa.idEmpresa = empresa.idEmpresa)
				WHERE 
				retificacaoempresa.cnpj = '$cnpj' AND
				(retificacaoempresa.status = '1' OR retificacaoempresa.status = '2' OR retificacaoempresa.status = '3')
				";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return RetificacaoempresaMAP::rsToObj($aReg);
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