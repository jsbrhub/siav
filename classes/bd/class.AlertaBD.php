<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Alerta.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.AlertaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.AlertaBDBase.php');

class AlertaBD extends AlertaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getRascunhoRecente($idCampanha){
        $sql = "
                select 
					".AlertaMAP::dataToSelect()." 
                from
					alerta 
				left join campanha 
					on (alerta.idCampanha = campanha.idCampanha) 
                where
                alerta.idCampanha = $idCampanha AND 
                alerta.situacao = '1'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return AlertaMAP::rsToObj($aReg);
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

    function getAlertasByCampanha($idCampanha){
        $sql = "
				select
					".AlertaMAP::dataToSelect()." 
				from
					alerta 
				left join campanha 
					on (alerta.idCampanha = campanha.idCampanha)
				where
				    alerta.idCampanha = '$idCampanha' order by alerta.dataHoraAlteracao DESC";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = AlertaMAP::rsToObj($aReg);
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

    function updateTotalEmpresasAlerta($idAlerta,$totalEmpresas){

        $sql = "
                update 
                    alerta 
                set
                  alerta.totalEmpresas = '$totalEmpresas'
                WHERE 
                  alerta.idAlerta = $idAlerta
                    ";

        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }


    function updateSituacaoAlerta($idAlerta,$situacao){

        $sql = "
                update 
                    alerta 
                set
                  alerta.situacao = '$situacao'
                WHERE 
                  alerta.idAlerta = $idAlerta
                    ";

        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }


}