<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Mercadoconsumidor.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.MercadoconsumidorMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.MercadoconsumidorBDBase.php');

class MercadoconsumidorBD extends MercadoconsumidorBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getListaMercadPorIncentivo($idIncentivoEmpresa){
        $sql = "
				select
					".MercadoconsumidorMAP::dataToSelect()." 
				from
					mercadoconsumidor 
				left join incentivoempresa 
					on (mercadoconsumidor.idIncentivoEmpresa = incentivoempresa.idIncentivoEmpresa)
				where
				    mercadoconsumidor.idIncentivoEmpresa = $idIncentivoEmpresa
				";


        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return MercadoconsumidorMAP::rsToObj($aReg);
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