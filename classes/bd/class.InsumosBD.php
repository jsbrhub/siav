<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Insumos.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.InsumosMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.InsumosBDBase.php');

class InsumosBD extends InsumosBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getListaBasicaInsumos(){
        $sql = "
				select
					".InsumosMAP::dataToSelect()." 
				from
					insumos
				where
				    idInsumo = '1' OR  
				    idInsumo = '2' OR  
				    idInsumo = '3' OR  
				    idInsumo = '6'  
				    ";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = InsumosMAP::rsToObj($aReg);
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