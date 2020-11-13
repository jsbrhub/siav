<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Atodeclaratorio.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.AtodeclaratorioMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.AtodeclaratorioBDBase.php');

class AtodeclaratorioBD extends AtodeclaratorioBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getAtoDecByIdIncentivoEmpresa($idIncentivoEmpresa){
        $sql = "
                select 
					".AtodeclaratorioMAP::dataToSelect()." 
                from
					atodeclaratorio 
				left join incentivoempresa 
					on (atodeclaratorio.idIncentivoEmpresa = incentivoempresa.idIncentivoEmpresa) 
                where
					atodeclaratorio.idIncentivoEmpresa = $idIncentivoEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return AtodeclaratorioMAP::rsToObj($aReg);
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