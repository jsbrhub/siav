<?php
class IncentivoempresaBDBase {
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
	
    function inserir($oIncentivoempresa){
		$reg = IncentivoempresaMAP::objToRs($oIncentivoempresa);
		$aCampo = array_keys($reg);
		$sql = "
				insert into incentivoempresa(
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
	
	function alterar($oIncentivoempresa){
    	$reg = IncentivoempresaMAP::objToRs($oIncentivoempresa);
        $sql = "
                update 
                    incentivoempresa 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idIncentivoEmpresa") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idIncentivoEmpresa = {$reg['idIncentivoEmpresa']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idIncentivoEmpresa") continue;
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
	
	function excluir($idIncentivoEmpresa){
        $sql = "
                delete from
                    incentivoempresa 
                where
                    idIncentivoEmpresa = $idIncentivoEmpresa";

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
	
	function get($idIncentivoEmpresa){
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
					incentivoempresa.idIncentivoEmpresa = $idIncentivoEmpresa";
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
        
        function getRow($aFiltro = NULL, $aOrdenacao = NULL){
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
					on (incentivoempresa.idModalidade = modalidade.idModalidade)";
                                        
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
	
    function getAll($aFiltro = NULL, $aOrdenacao = NULL){
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
					on (incentivoempresa.idModalidade = modalidade.idModalidade)";
        
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

    function totalColecao(){
        $sql = "select count(*) from incentivoempresa";
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
					".IncentivoempresaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
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