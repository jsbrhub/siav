<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Empresaalerta.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.EmpresaalertaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.EmpresaalertaBDBase.php');

class EmpresaalertaBD extends EmpresaalertaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function verificaAlertaByEmpresaCampanha($cnpj,$idCampanha){
        $sql = "
                select 
					".EmpresaalertaMAP::dataToSelect()." 
                from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha) 
                where
					empresaalerta.cnpj = '$cnpj' and empresaalerta.idCampanha = '$idCampanha'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresaalertaMAP::rsToObj($aReg);
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