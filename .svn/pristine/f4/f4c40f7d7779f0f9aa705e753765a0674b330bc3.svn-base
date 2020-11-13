<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Empresacampanha.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.EmpresacampanhaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.EmpresacampanhaBDBase.php');

class EmpresacampanhaBD extends EmpresacampanhaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }


    function getTodasEmpresasCampanha($idCampanha){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , campanha
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresacampanha.idCampanha = '$idCampanha' AND 
				    empresacampanha.status <> -1
				    group by empresacampanha.idEmpresaCampanha 
				    ";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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


    function getEmpresasCampanhaByStatus($idCampanha,$status){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , campanha
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresacampanha.idCampanha = '$idCampanha' AND
				    empresacampanha.status = '$status'
				    group by empresacampanha.idEmpresaCampanha 
				    ";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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




    function limparEmpresaCampanha($idCampanha){
        $sql = "
                delete from
                    empresacampanha 
                where
                    idCampanha = $idCampanha";

        try{
            $this->oConexao->execute($sql);
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

    function checaEmpresaCampanha($idCampanha,$cnpj){
        $sql = "
                select 
					".EmpresacampanhaMAP::dataToSelect()." 
                from
					empresacampanha , campanha
                where
                    empresacampanha.idCampanha = campanha.idCampanha AND
					empresacampanha.idCampanha = $idCampanha AND
					empresacampanha.cnpj = '$cnpj'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresacampanhaMAP::rsToObj($aReg);
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

    function verificaDataFinal60Dias($cnpj){
        $sql = "
                select 
					".EmpresacampanhaMAP::dataToSelect()." 
                from
					empresacampanha , campanha
                where
                    empresacampanha.idCampanha = campanha.idCampanha AND
					empresacampanha.cnpj = '$cnpj' AND
					DATEDIFF(campanha.dataFim,CURDATE()) < 60
					order by campanha.campanha ASC, campanha.anoBase ASC
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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




    function getEmpresasCampanhaCadastrosPendentes($idCampanha){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresacampanha.idCampanha = '$idCampanha' AND
				   ( empresacampanha.status = '1' OR empresacampanha.status = '2' OR empresacampanha.status = '4')
				   group by idEmpresaCampanha order by empresa.razaoSocial asc
				  
				    ";

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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



    function pesquisaCampanhasEmpresa($empresa,$status){
        if(is_numeric($empresa)){
            $cnpj = $empresa;
        }else{
            $razaoSocial = $empresa;
        }

        if($empresa == '' && $status == '1'){ // concluidos - todos
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj 
				    group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }
        if($empresa == '' && $status == '2'){ // concluidos - todos
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresacampanha.status = '3'  			
				    group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }
        if($empresa == '' && $status == '3'){ // nao concluidos - todos
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				   ( empresacampanha.status = '1' OR empresacampanha.status = '2' OR empresacampanha.status = '4') 			
				   group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";

        }

        if($cnpj != '' && $status == '1'){ //todos
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresa.cnpj LIKE '%$cnpj%'
				    group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }

        if($cnpj != '' && $status == '2'){ // concluidos + cnpj
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresacampanha.status = '3' 
				    empresa.cnpj LIKE '%$cnpj%'
				    group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }

        if($cnpj != '' && $status == '3'){ //nao concluidos + cnpj
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				   ( empresacampanha.status = '1' OR empresacampanha.status = '2' OR empresacampanha.status = '4') AND
				   empresa.cnpj LIKE '%$cnpj%'
				   group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }
        if($cnpj != '' && $status == ''){ //nao concluidos + cnpj
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				   empresa.cnpj LIKE '%$cnpj%'
				   group by empresacampanha.idEmpresaCampanha order by empresa.razaoSocial asc";
        }

        if($razaoSocial != '' && $status == '1'){ //todos - razao social
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresa.razaoSocial LIKE '%$razaoSocial%' 
				    group by empresacampanha.idEmpresaCampanha order by empresa.anoBase desc, empresa.razaoSocial asc";
        }

        if($razaoSocial != '' && $status == '2'){ // concluidos + razao social
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresacampanha.status = '3'  AND
				    empresa.razaoSocial LIKE '%$razaoSocial%' 
				    group by empresacampanha.idEmpresaCampanha order by empresa.anoBase desc, empresa.razaoSocial asc";
        }

        if($razaoSocial != '' && $status == '3'){ // não concluidos + razao social
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    ( empresacampanha.status = '1' OR empresacampanha.status = '2' OR empresacampanha.status = '4') AND
				    empresa.razaoSocial LIKE '%$razaoSocial%' 
				    group by empresacampanha.idEmpresaCampanha order by empresa.anoBase desc, empresa.razaoSocial asc";
        }
        if($razaoSocial != '' && $status == ''){ // não concluidos + razao social
            $sql = "select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha , empresa , campanha
			
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND
				    empresa.cnpj = empresacampanha.cnpj AND
				    empresa.razaoSocial LIKE '%$razaoSocial%' 
				    group by empresacampanha.idEmpresaCampanha order by empresa.anoBase desc, empresa.razaoSocial asc";
        }

        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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

    function retornaCampanhasAtivasEmpresaLogada($cnpj){
         $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha, campanha 
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND	
				    campanha.situacao = '2' AND
				    (campanha.dataInicio <= CURDATE() ) AND
				    campanha.dataFim >= CURDATE() AND
				    empresacampanha.cnpj = '$cnpj' AND
				    empresacampanha.status not in (3, -1)
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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

    function retornaCampanhasAtivasEmpresaLogadaConcluido($cnpj){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha, campanha 
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND	
				    empresacampanha.cnpj = '$cnpj' AND
				    empresacampanha.status = '3'
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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


    function updateStatusEmpresaCampanha($idCampanha,$cnpj,$status){
        $sql = "
                update 
                    empresacampanha 
                set
                   empresacampanha.status = '$status'
                where
                    empresacampanha.idCampanha = '$idCampanha' AND empresacampanha.cnpj = '$cnpj' ";
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

    function retornaCampanhaEmpresaSituacao($cnpj,$situacao){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha, campanha 
				where
				    empresacampanha.idCampanha = campanha.idCampanha AND	
				    campanha.situacao = '$situacao' AND
				    empresacampanha.cnpj = '$cnpj'
				    order by campanha.campanha ASC, campanha.anoBase ASC
				
					";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacampanhaMAP::rsToObj($aReg);
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