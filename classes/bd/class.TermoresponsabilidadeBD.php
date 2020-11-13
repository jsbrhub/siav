<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Termoresponsabilidade.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.TermoresponsabilidadeMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.TermoresponsabilidadeBDBase.php');

class TermoresponsabilidadeBD extends TermoresponsabilidadeBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function verificaTermoResponsabilidade($cnpj,$idCampanha){
        $sql = "
                select 
					".TermoresponsabilidadeMAP::dataToSelect()." 
                from
					termoresponsabilidade 
				left join campanha 
					on (termoresponsabilidade.idCampanha = campanha.idCampanha)
				left join empresa 
					on (termoresponsabilidade.idEmpresa = empresa.idEmpresa) 
                where
					termoresponsabilidade.cnpj = '$cnpj' AND
					termoresponsabilidade.idCampanha = '$idCampanha' 
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return TermoresponsabilidadeMAP::rsToObj($aReg);
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

    function updateIdEmpresaTermo($idCampanha,$cnpj,$idEmpresa){
        $sql = "
                update
                    termoresponsabilidade
                set
                   idEmpresa = '$idEmpresa'
                where
                    termoresponsabilidade.idCampanha = '$idCampanha' AND termoresponsabilidade.cnpj = '$cnpj'";


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

    function updateHashComprovante($idEmpresa,$idCampanha){
        $hash = md5($idEmpresa.'0'.$idCampanha.'0'.date("Y.m.d H.s.i"));
        $date = date("Y-m-d H:i:s");
        $sql = "update
                    termoresponsabilidade
                set
                   termoresponsabilidade.comprovante = '$hash'  ,
                   termoresponsabilidade.dataHoraAlteracao='$date'
                where
                    termoresponsabilidade.idEmpresa = '$idEmpresa' AND termoresponsabilidade.idCampanha = '$idCampanha' ";


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


    function retornaHash($idEmpresa){
        $sql = "
                select 
					".TermoresponsabilidadeMAP::dataToSelect()." 
                from
					termoresponsabilidade 
				left join campanha 
					on (termoresponsabilidade.idCampanha = campanha.idCampanha)
				left join empresa 
					on (termoresponsabilidade.idEmpresa = empresa.idEmpresa) 
                where
					termoresponsabilidade.idEmpresa = '$idEmpresa' AND
					(termoresponsabilidade.comprovante <> '' OR termoresponsabilidade.comprovante <> NULL OR termoresponsabilidade.comprovante <> '0' )
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return TermoresponsabilidadeMAP::rsToObj($aReg);
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