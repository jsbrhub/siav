<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Origeminsumos.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.OrigeminsumosMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.OrigeminsumosBDBase.php');

class OrigeminsumosBD extends OrigeminsumosBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getListaOrigemInsumosPorEmpresa($idEmpresa){
        $sql = "
				select
					".OrigeminsumosMAP::dataToSelect()." 
				 from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo) 
				where
				    origeminsumos.idEmpresa = '$idEmpresa'
				";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = OrigeminsumosMAP::rsToObj($aReg);
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

    function getOrigemByIdInsumoIdEmpresa($idInsumo,$idEmpresa){
        $sql = "
                select 
					".OrigeminsumosMAP::dataToSelect()." 
                from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo) 
                where
					origeminsumos.idEmpresa = $idEmpresa AND
					origeminsumos.idInsumo = $idInsumo
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return OrigeminsumosMAP::rsToObj($aReg);
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