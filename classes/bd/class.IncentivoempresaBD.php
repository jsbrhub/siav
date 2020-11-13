<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Incentivoempresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.IncentivoempresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.IncentivoempresaBDBase.php');

class IncentivoempresaBD extends IncentivoempresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function inserirIncentivoExcel($oIncentivoempresa){
        $sql = "
				insert into incentivoempresa(
				idIncentivoEmpresa,idEmpresa,idIncentivo,idModalidade,produtoIncentivado,fonteOrigem,cnpj,cnae,faturamento,emprego,
				producao,
				idUnidadeProducao,capacidadeInstalada,unidadeDescricao,idUnidadeCapacidade,ano,vigente,anoInicial,anoFinal, 
				dataHoraAlteracao,usuarioAlteracao
				)
				values(
				NULL,'$oIncentivoempresa[0]','$oIncentivoempresa[1]','$oIncentivoempresa[2]','$oIncentivoempresa[3]','$oIncentivoempresa[4]','$oIncentivoempresa[5]','$oIncentivoempresa[6]','$oIncentivoempresa[7]','$oIncentivoempresa[8]','$oIncentivoempresa[9]','$oIncentivoempresa[10]','$oIncentivoempresa[11]','$oIncentivoempresa[12]','$oIncentivoempresa[13]','$oIncentivoempresa[14]','$oIncentivoempresa[15]','$oIncentivoempresa[16]','$oIncentivoempresa[17]','$oIncentivoempresa[18]','$oIncentivoempresa[19]'
					)";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                Util::trace($sql);
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return -1;
        }
    }


    function listarIncentivosByCnpjVigencia($cnpj = null,$statusVigencia){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj = incentivoempresa.cnpj AND
					empresa.vigente = '$statusVigencia' ";

        if($cnpj !== null){
            $sql .= " AND empresa.cnpj like '%$cnpj%' ";
        }

        $sql .= " GROUP by empresa.razaoSocial asc";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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

    //consulta usando o "LIKE" - não exata
    function listarIncentivosByRazaoSocialVigencia($razaoSocial = null,$statusVigencia){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from
					incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
				
                where
					empresa.cnpj = incentivoempresa.cnpj AND
					empresa.vigente = '$statusVigencia'";

        if($razaoSocial !== null){
            $sql .= "AND empresa.razaoSocial like '%$razaoSocial%'";
        }

        $sql .= " GROUP by empresa.razaoSocial asc";


        //Util::trace($sql,false);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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

    //consulta exata
    function getIncentivosByCnpjVigencia($cnpj,$statusVigencia){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from 
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj = '$cnpj' AND
					empresa.cnpj = incentivoempresa.cnpj AND
					empresa.vigente = '$statusVigencia' 
					GROUP BY incentivoempresa.produtoIncentivado
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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



    //consulta exata
    function getIncentivosByCnpjVigenciaCadastro($cnpj,$statusVigencia){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from 
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj = '$cnpj' AND
					empresa.cnpj = incentivoempresa.cnpj AND
					empresa.vigente = '$statusVigencia' AND
					incentivoempresa.idIncentivo <> '1' AND incentivoempresa.idIncentivo <> '5'
					GROUP BY incentivoempresa.produtoIncentivado
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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



    function getIncentivoByIdEmpresa($idEmpresa){
        $sql = "
                select 
					".IncentivoempresaMAP::dataToSelect()." 
                from
					incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade)    
                where
					incentivoempresa.idEmpresa = $idEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return IncentivoempresaMAP::rsToObj($aReg);
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

    function updateModalidadeIncentivo($idIncentivoempresa,$idModalidade,$idIncentivo){
        $sql = "
                update 
                    incentivoempresa 
                set
                    incentivoempresa.idModalidade = '$idModalidade', incentivoempresa.idIncentivo = '$idIncentivo'
                where
                    incentivoempresa.idIncentivoEmpresa = '$idIncentivoempresa'";

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

    function listarIncentivosByIdEmpresa($idEmpresa){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					incentivoempresa.idEmpresa = '$idEmpresa' AND
					incentivoempresa.fonteOrigem = 'WEB' AND
					incentivoempresa.vigente = '1' 
					";
//Util::trace($sql,false);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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

    function listarIncentivosByCnpjEmpresa($cnpj){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					incentivoempresa.cnpj = '$cnpj' AND
					incentivoempresa.fonteOrigem = 'WEB' AND
					incentivoempresa.vigente = '1' 
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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


    function updateUnidadeCap($idIncentivoEmpresa,$idUnidadeCap){
        $sql = "
                update 
                    incentivoempresa 
                set
                   idUnidadeCapacidade = '$idUnidadeCap'
                where
                    idIncentivoEmpresa = '$idIncentivoEmpresa'";
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

    function updateUnidadeProd($idIncentivoEmpresa,$idUnidadeProd){
        $sql = "
                update 
                    incentivoempresa 
                set
                   idUnidadeProducao = '$idUnidadeProd'
                where
                    idIncentivoEmpresa = '$idIncentivoEmpresa'";
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


    function listarIncentivosIdEmpresa($idEmpresa){
        $sql = "
				select 
					".IncentivoempresaMAP::dataToSelect()." 
               from
				incentivoempresa 
				left join empresa 
					on (incentivoempresa.idEmpresa = empresa.idEmpresa)
				left join incentivos 
					on (incentivoempresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (incentivoempresa.idModalidade = modalidade.idModalidade) 
                where
					incentivoempresa.idEmpresa = '$idEmpresa' 
					";
//Util::trace($sql,false);
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = IncentivoempresaMAP::rsToObj($aReg);
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