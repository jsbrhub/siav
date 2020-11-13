<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivopesquisa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivopesquisaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivopesquisaBDBase.php');

class ArquivopesquisaBD extends ArquivopesquisaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getArquivosByPesquisa($idProjeto){
        $sql = "
				select
					".ArquivopesquisaMAP::dataToSelect()." 
				from
					arquivopesquisa 
				left join pesquisadesenvolvimento 
					on (arquivopesquisa.idPesquisa = pesquisadesenvolvimento.idPesquisa)
				where arquivopesquisa.idPesquisa = $idProjeto";

        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivopesquisaMAP::rsToObj($aReg);
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