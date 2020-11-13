<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivopolitica.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivopoliticaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivopoliticaBDBase.php');

class ArquivopoliticaBD extends ArquivopoliticaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getArquivosByPolitica($idPolitica){
        $sql = "
                select 
					".ArquivopoliticaMAP::dataToSelect()." 
                from
					arquivopolitica 
				left join politicaambiental 
					on (arquivopolitica.idPolitica = politicaambiental.idPolitica) 
                where
					arquivopolitica.idPolitica = $idPolitica";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivopoliticaMAP::rsToObj($aReg);
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