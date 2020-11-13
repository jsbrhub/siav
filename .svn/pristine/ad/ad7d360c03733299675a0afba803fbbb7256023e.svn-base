<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivoprojeto.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivoprojetoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivoprojetoBDBase.php');

class ArquivoprojetoBD extends ArquivoprojetoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getArquivosByProjeto($idProjeto){
        $sql = "
				select
					".ArquivoprojetoMAP::dataToSelect()." 
				from
					arquivoprojeto 
				left join projsocioambiental 
					on (arquivoprojeto.idProjeto = projsocioambiental.idProjeto)
				where arquivoprojeto.idProjeto = $idProjeto";

        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivoprojetoMAP::rsToObj($aReg);
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