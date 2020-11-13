<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivoretificacao.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivoretificacaoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivoretificacaoBDBase.php');

class ArquivoretificacaoBD extends ArquivoretificacaoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getArquivosRetificacao($idRetEmpresa){
        $sql = "
                select 
					".ArquivoretificacaoMAP::dataToSelect()." 
                from
					arquivoretificacao 
				left join retificacaoempresa 
					on (arquivoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where
					arquivoretificacao.idRetEmpresa = $idRetEmpresa";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ArquivoretificacaoMAP::rsToObj($aReg);
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