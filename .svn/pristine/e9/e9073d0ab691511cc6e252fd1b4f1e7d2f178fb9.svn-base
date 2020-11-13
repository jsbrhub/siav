<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Campanha.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.CampanhaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.CampanhaBDBase.php');

class CampanhaBD extends CampanhaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function updateSituacaoCampanha($idCampanha,$situacao){

        $sql = "
                update 
                    campanha 
                set
                    campanha.situacao = '$situacao' 
                    WHERE 
                    campanha.idCampanha = $idCampanha                   ";


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

    function updateTotalEmpresasCampanha($idCampanha,$totalEmpresas){

        $sql = "
                update 
                    campanha 
                set
                    campanha.totalEmpresas = '$totalEmpresas' 
                    WHERE 
                    campanha.idCampanha = $idCampanha                   ";


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



    function pesquisarCampanha($campanha,$anoBase,$situacao){

        if(($campanha != '') && ($anoBase != '') && ($situacao != '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.campanha like '%$campanha%' AND
				    campanha.anoBase = '$anoBase' AND
				    campanha.situacao = '$situacao' 
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }
        if(($campanha != '') && ($anoBase == '') && ($situacao == '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.campanha like '%$campanha%' 
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }

        if(($campanha == '') && ($anoBase != '') && ($situacao == '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.anoBase = '$anoBase'
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }

        if(($campanha == '') && ($anoBase == '') && ($situacao != '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.situacao = '$situacao'
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }

        if(($campanha != '') && ($anoBase != '') && ($situacao == '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.campanha like '%$campanha%' AND
				    campanha.anoBase = '$anoBase'
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }

        if(($campanha != '') && ($anoBase == '') && ($situacao != '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.campanha like '%$campanha%' AND
				    campanha.situacao = '$situacao'
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }

        if(($campanha == '') && ($anoBase != '') && ($situacao != '')){
            $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				   campanha.anoBase = '$anoBase' AND
				    campanha.situacao = '$situacao'
				    order by campanha.dataFim ASC, campanha.campanha ASC, campanha.anoBase ASC
				
					";
        }
      //  Util::trace($sql,false);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = CampanhaMAP::rsToObj($aReg);
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



    function retornaCampanhasAtivas(){
        $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.situacao = '2' AND 
				    campanha.dataFim >= CURDATE()
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = CampanhaMAP::rsToObj($aReg);
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


    function retornaCampanhasAtivasExp15Dias(){
        $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.situacao = '2' AND
				    DATEDIFF(campanha.dataFim,CURDATE()) < 15
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = CampanhaMAP::rsToObj($aReg);
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


    function listaCampanhasAtivas(){
        $sql = "
				select
					".CampanhaMAP::dataToSelect()." 
				from
					campanha 
				where	
				    campanha.situacao = '2' 
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = CampanhaMAP::rsToObj($aReg);
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