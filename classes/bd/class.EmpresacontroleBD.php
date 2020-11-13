<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Empresacontrole.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.EmpresacontroleMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.EmpresacontroleBDBase.php');

class EmpresacontroleBD extends EmpresacontroleBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function verificaEmpresaCampanhaSituacao($idCampanha,$cnpj){
        $sql = "
                select 
					".EmpresacontroleMAP::dataToSelect()." 
                from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa) 
                where
					empresacontrole.cnpj = '$cnpj' AND
					empresacontrole.idCampanha = '$idCampanha'
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresacontroleMAP::rsToObj($aReg);
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

    function getControleByIdEmpresa($idEmpresa){
        $sql = "
                select 
					".EmpresacontroleMAP::dataToSelect()." 
                from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa) 
                where
					empresacontrole.idEmpresa = $idEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresacontroleMAP::rsToObj($aReg);
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

    function updateDataAlteracao($idEmpresaConrole){
        $dataAtual = date("Y-m-d H:i:s");
        $sql = "
                update 
                    empresacontrole 
                set
                dataAlteracao = '$dataAtual'
                where
                    idEmpresaControle = $idEmpresaConrole";


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

    function updateControleConclusao($idEmpresaConrole){
        $dataAtual = date("Y-m-d H:i:s");
        $sql = "
                update 
                    empresacontrole 
                set
                status = '2',
                dataConclusao = '$dataAtual'
                where
                    idEmpresaControle = $idEmpresaConrole";


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

    function listaEmpresaByCNPJStatus($cnpj,$status){
        $sql = "
				select
					".EmpresacontroleMAP::dataToSelect()." 
				from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa)
				where
				    empresacontrole.cnpj = '$cnpj' AND
				    empresacontrole.status = '$status' 
				order by campanha.anoBase ASC
					";



        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacontroleMAP::rsToObj($aReg);
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


    function listaEmpresaByCNPJStatusWeb($cnpj,$status){
        $sql = "
				select
					".EmpresacontroleMAP::dataToSelect()." 
				from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa)
				left join historicoretificacao
				    on (historicoretificacao.cnpj = empresacontrole.cnpj)
				
				where
				    empresacontrole.cnpj = '$cnpj' AND
				    empresacontrole.status = '$status' AND
				    empresa.situacaoCadastro = '2' AND
				    (historicoretificacao.idEmpresaRet <> empresacontrole.idEmpresa OR historicoretificacao.idEmpresaRet is NULL)
				ORDER by campanha.anoBase ASC
					";



        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacontroleMAP::rsToObj($aReg);
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