<?php
class EmpresaBDBase {
    public $oConexao;
    public $msg;

    function __construct(Conexao $oConexao){
        try{
            $this->oConexao = $oConexao;
        } 
        catch (PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
	
    function inserir($oEmpresa){
		$reg = EmpresaMAP::objToRs($oEmpresa);
		$aCampo = array_keys($reg);
		$sql = "
				insert into empresa(
					".implode(',', $aCampo)."
				)
				values(
					:".implode(", :", $aCampo).")";

		foreach($reg as $cv=>$vl)
			$regTemp[":$cv"] = ($vl=='') ? NULL : $vl;

		try{
			$this->oConexao->executePrepare($sql, $regTemp);
			if($this->oConexao->msg != ""){
				$this->msg = $this->oConexao->msg;
				return false;
			}
			return $this->oConexao->lastID();
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	function alterar($oEmpresa){
    	$reg = EmpresaMAP::objToRs($oEmpresa);
        $sql = "
                update 
                    empresa 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresa") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idEmpresa = {$reg['idEmpresa']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresa") continue;
            $regTemp[":$cv"] = ($vl=='') ? NULL : $vl;
        }
        try{
            $this->oConexao->executePrepare($sql, $regTemp);
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
	
	function excluir($idEmpresa){
        $sql = "
                delete from
                    empresa 
                where
                    idEmpresa = $idEmpresa";

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
	
	function get($idEmpresa){
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
					empresa.idEmpresa = $idEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                $this->oConexao->close();
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
        
        function getRow($aFiltro = NULL, $aOrdenacao = NULL){
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
					on (empresa.idModalidade = modalidade.idModalidade)";
                                        
        if(count($aFiltro)>0){
            $sql .= " where ";
            $sql .= implode(" and ", $aFiltro);
        }
        
        if(count($aOrdenacao)>0){
            $sql .= " order by ";
            $sql .= implode(",", $aOrdenacao);
        }                                
                                        
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
	
    function getAll($aFiltro = NULL, $aOrdenacao = NULL){
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
					on (empresa.idModalidade = modalidade.idModalidade)";
        
        if(count($aFiltro)>0){
            $sql .= " where ";
            $sql .= implode(" and ", $aFiltro);
        }
        
        if(count($aOrdenacao)>0){
            $sql .= " order by ";
            $sql .= implode(",", $aOrdenacao);
        }
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

    function totalColecao(){
        $sql = "select count(*) from empresa";
        try{
            $this->oConexao->execute($sql);
            $aReg = $this->oConexao->fetchReg();
            return (int) $aReg[0];
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
	
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

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
					".EmpresaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
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