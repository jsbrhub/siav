<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Historicoretificacao.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.HistoricoretificacaoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.HistoricoretificacaoBDBase.php');

class HistoricoretificacaoBD extends HistoricoretificacaoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function verificaStatusRetificaoByIdEmpresa($idEmpresa,$status){
        $sql = "
                select 
					".HistoricoretificacaoMAP::dataToSelect()." 
                from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa) 
                where
					historicoretificacao.idEmpresaRet = $idEmpresa AND
					retificacaoempresa.status = '$status'
					
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return HistoricoretificacaoMAP::rsToObj($aReg);
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

    function listaRegistrosByCNPJStatus($cnpj,$status){
        $sql = "
				select
					".HistoricoretificacaoMAP::dataToSelect()." 
				from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa)
				where
				   historicoretificacao.cnpj = '$cnpj' AND 	
				   historicoretificacao.status = '$status'
				order by historicoretificacao.anoBase ASC
				   
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = HistoricoretificacaoMAP::rsToObj($aReg);
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

    function retornaHistoricoRetificacaoByRetEmpresa($idRetEmpresa){
        $sql = "
                select 
					".HistoricoretificacaoMAP::dataToSelect()." 
                from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa) 
                where
					historicoretificacao.idRetEmpresa = $idRetEmpresa 
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return HistoricoretificacaoMAP::rsToObj($aReg);
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

    function updateStatusHistoricoByRetEmpresa($idRetEmpresa,$status){
        $sql = "
                update 
                    historicoretificacao 
                set
                   historicoretificacao.status = '$status'
                where
                    historicoretificacao.idRetEmpresa = '$idRetEmpresa'";

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

    function updateStatusHistorico($idHistRet,$status){
        $data = date("Y-m-d H:i:s");
        $sql = "
                update 
                    historicoretificacao 
                set
                   historicoretificacao.status = '$status',
                   historicoretificacao.dataHoraAlteracao = '$data'
                where
                    historicoretificacao.idHistRet = '$idHistRet'";

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

    function verificaIdEmpresaRet($idEmpresaRet){
        $sql = "
                select 
					".HistoricoretificacaoMAP::dataToSelect()." 
                from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa) 
                where
					historicoretificacao.idEmpresaRet = $idEmpresaRet 
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return HistoricoretificacaoMAP::rsToObj($aReg);
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