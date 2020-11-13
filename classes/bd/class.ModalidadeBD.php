<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Modalidade.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ModalidadeMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ModalidadeBDBase.php');

class ModalidadeBD extends ModalidadeBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getIncentivoByModalidade($modalidade,$incentivo){
        $modalidade = trim($modalidade);
        $incentivo = trim($incentivo);
        $sql = "
                select 
					".ModalidadeMAP::dataToSelect()." 
                from
					modalidade,incentivos
                where
					modalidade.descricao like '%$modalidade%' AND 
					incentivos.incentivo like '%$incentivo%' AND
					incentivos.idIncentivo = modalidade.idIncentivo";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ModalidadeMAP::rsToObj($aReg);
            } else {
                $this->msg = "Nenhum registro encontrado para Modalidade ou Incentivo Informado!";
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }



}