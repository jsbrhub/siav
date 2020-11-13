<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Municipio.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.MunicipioMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.MunicipioBDBase.php');

class MunicipioBD extends MunicipioBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function getMunicipioUf($municipio,$uf){
        $municipio = trim($municipio);
        $municipio = addslashes($municipio);
        $uf = trim($uf);
        $sql = "
                select 
					".MunicipioMAP::dataToSelect()." 
                from
					municipio 
                where
					municipio.municipio like '%$municipio%' AND
					municipio.uf like '%$uf%'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return MunicipioMAP::rsToObj($aReg);
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


    function getMunicipioByUf($uf){
        $sql = "
                select 
					".MunicipioMAP::dataToSelect()." 
                from
					municipio 
                where
					municipio.uf = '$uf' 
				order by municipio.municipio ASC";

       // Util::trace($sql);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = MunicipioMAP::rsToObj($aReg);
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

    function listaUf(){
        $sql = "select 
					".MunicipioMAP::dataToSelect()."
                from
					municipio 
                group by municipio.uf";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = MunicipioMAP::rsToObj($aReg);
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