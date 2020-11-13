<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Empresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.EmpresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.EmpresaBDBase.php');

class EmpresaBD extends EmpresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function inserirEmpresaExcel($oEmpresa){

        $sql = "
				insert into empresa(
				idEmpresa,idMunicipio,idSituacao,idIncentivo,idModalidade,cnpj,cnpjMatriz,
				anoBase,anoAprovacao,razaoSocial,telefone,fax,email,fonteOrigem,latitude,longitude,endereco,
				numero,complemento,
				bairro,cep,setor,enq,numSudam,procurador,laudoData,laudoNumero,anoCalendario,resolucaoData,
				resolucaoNumero,declaracaoData,declaracaoNumero,situacaoCadastro,projetoSocial,politicaAmbiental, 
				vigente,anoVigencia,dataHoraAlteracao,usuarioAlteracao
				)
				values(
				NULL,'$oEmpresa[0]','$oEmpresa[1]','$oEmpresa[2]','$oEmpresa[3]','$oEmpresa[4]','$oEmpresa[5]','$oEmpresa[6]','$oEmpresa[7]','$oEmpresa[8]','$oEmpresa[9]','$oEmpresa[10]','$oEmpresa[11]','$oEmpresa[12]','$oEmpresa[13]','$oEmpresa[14]','$oEmpresa[15]','$oEmpresa[16]','$oEmpresa[17]','$oEmpresa[18]','$oEmpresa[19]','$oEmpresa[20]','$oEmpresa[21]','$oEmpresa[22]','$oEmpresa[23]','$oEmpresa[24]','$oEmpresa[25]','$oEmpresa[26]','$oEmpresa[27]','$oEmpresa[28]','$oEmpresa[29]','$oEmpresa[30]','$oEmpresa[31]','$oEmpresa[32]','$oEmpresa[33]','$oEmpresa[34]','$oEmpresa[35]','$oEmpresa[36]','$oEmpresa[37]'
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



    function getInfoAtualEmpresa($cnpj){
        $sql = "
                select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj = '$cnpj' order by empresa.anoBase desc , empresa.anoAprovacao desc limit 1";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresaMAP::rsToObj($aReg);
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

    function retornaEmpresasGroupByCnpj(){
            $sql = "
				select
					".EmpresaMAP::dataToSelect()." 
				from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade)
					GROUP BY cnpj
					";

            try{
                $this->oConexao->execute($sql);
                $aObj = array();
                if($this->oConexao->numRows() != 0){
                    while ($aReg = $this->oConexao->fetchReg()){
                        $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function listarRegistrosEmpresaByCnpj($cnpj = null){
        $sql = "
				select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) ";

        if($cnpj !== null){
            $sql .= "where
					    empresa.cnpj like '%$cnpj%' ";
        }


        $sql .= "order by empresa.razaoSocial asc, empresa.anoBase desc , empresa.anoAprovacao desc";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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

    function listarRegistrosEmpresaByRazaoSocial($razaoSocial = null){
        $sql = "
				select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) ";


        if($razaoSocial !== null){
            $sql .= "where
					    empresa.razaoSocial like '%$razaoSocial%' ";
        }

        $sql .= "order by empresa.razaoSocial asc, empresa.anoBase desc , empresa.anoAprovacao desc";


        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function getEmpresasVigentesByCnpj($cnpj){
        $sql = "
				select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj like '%$cnpj%' AND
					empresa.vigente = '1'
					group by empresa.cnpj order by empresa.anoBase desc, empresa.anoAprovacao desc
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function getEmpresasVigentesByRazaoSocial($razaoSocial){
        $sql = "
				select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.razaoSocial like '%$razaoSocial%' AND
					empresa.vigente = '1'
					group by empresa.cnpj order by empresa.anoBase desc, empresa.anoAprovacao desc
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function retornaEmpresasVigentesGroupByCnpj(){
        $sql = "
				select
					".EmpresaMAP::dataToSelect()." 
				from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade)
				where
				    empresa.vigente = '1'
					GROUP BY cnpj ORDER by empresa.razaoSocial ASC
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function retornaIncentivosByCnpjStatus($cnpj,$status){
        $sql = "
				select
					".EmpresaMAP::dataToSelect()." 
				from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade)
				WHERE
				    empresa.cnpj = '$cnpj' AND 
				    empresa.vigente = '$status'
					GROUP BY empresa.idModalidade
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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


    function updateProjetoEmpresa($idEmpresa,$status){
        $sql = "
                update 
                    empresa 
                set
                  empresa.projetoSocial = '$status'
                where
                    empresa.idEmpresa = $idEmpresa";


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

    function updatePesquisaEmpresa($idEmpresa,$status){
        $sql = "
                update 
                    empresa 
                set
                  empresa.pesquisaDesenvolvimento = '$status'
                where
                    empresa.idEmpresa = $idEmpresa";


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

    function updatePoliticaEmpresa($idEmpresa,$status){
        $sql = "
                update 
                    empresa 
                set
                  empresa.politicaAmbiental = '$status'
                where
                    empresa.idEmpresa = $idEmpresa";


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


    function updateSituacaoCadastroEmpresa($idEmpresa,$status){
        $sql = "update 
                  empresa 
                set
                  empresa.situacaoCadastro = '$status'
                where
                  empresa.idEmpresa = $idEmpresa";
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


    function retornaRegistrosWeb(){
        $sql = "
				select
					".EmpresaMAP::dataToSelect()." 
				from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade)
				where
				    empresa.fonteOrigem = 'WEB' 
				order by 
				    empresa.anoBase DESC, 
				    empresa.razaoSocial ASC
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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




    function retornaCadastrosWebByCnpjStatus($cnpj,$status){
        $sql = "
				select 
					".EmpresaMAP::dataToSelect()." 
                from
					empresa 
				left join municipio 
					on (empresa.idMunicipio = municipio.idMunicipio)
				left join situacao 
					on (empresa.idSituacao = situacao.idSituacao)
				left join incentivos 
					on (empresa.idIncentivo = incentivos.idIncentivo)
				left join modalidade 
					on (empresa.idModalidade = modalidade.idModalidade) 
                where
					empresa.cnpj like '%$cnpj%' AND
					empresa.fonteOrigem = 'WEB' AND
					empresa.situacaoCadastro = '$status'
					order by empresa.anoBase desc, empresa.anoAprovacao desc
					";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
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