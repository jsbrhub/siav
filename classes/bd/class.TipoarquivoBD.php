<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Tipoarquivo.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.TipoarquivoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.TipoarquivoBDBase.php');

class TipoarquivoBD extends TipoarquivoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getListaBasicaTipoArquivoEmpresa(){
        $sql = "
				select
					".TipoarquivoMAP::dataToSelect()." 
				from
					tipoarquivo WHERE 
					idTipoArquivo = '2' OR  
					idTipoArquivo = '3' OR  
					idTipoArquivo = '4' OR  
					idTipoArquivo = '5' OR  
					idTipoArquivo = '6' 					
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = TipoarquivoMAP::rsToObj($aReg);
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