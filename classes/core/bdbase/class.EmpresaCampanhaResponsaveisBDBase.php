<?php
class EmpresaCampanhaResponsaveisBDBase {
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
	
    function inserir($oEmpresaCampanhaResponsaveis){
		$reg = EmpresaCampanhaResponsaveisMAP::objToRs($oEmpresaCampanhaResponsaveis);
		$aCampo = array_keys($reg);
		$sql = "
				insert into empresa_campanha_responsaveis(
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
	
	function alterar($oEmpresaCampanhaResponsaveis){
    	$reg = EmpresaCampanhaResponsaveisMAP::objToRs($oEmpresaCampanhaResponsaveis);
        $sql = "
                update 
                    empresa_campanha_responsaveis 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaCampanhaResponsaveis") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idEmpresaCampanhaResponsaveis = {$reg['idEmpresaCampanhaResponsaveis']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaCampanhaResponsaveis") continue;
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
	
	function excluir($idEmpresaCampanhaResponsaveis){
        $sql = "
                delete from
                    empresa_campanha_responsaveis 
                where
                    idEmpresaCampanhaResponsaveis = $idEmpresaCampanhaResponsaveis";

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
	
	function get($idEmpresaCampanhaResponsaveis){
        $sql = "
                select 
					".EmpresaCampanhaResponsaveisMAP::dataToSelect()." 
                from
					empresa_campanha_responsaveis 
				left join campanha 
					on (empresa_campanha_responsaveis.idCampanha = campanha.idCampanha)
				left join empresacampanha 
					on (empresa_campanha_responsaveis.idEmpresaCampanha = empresacampanha.idEmpresaCampanha)
				left join responsaveis 
					on (empresa_campanha_responsaveis.idResponsaveis = responsaveis.idResponsaveis) 
                where
					empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis = $idEmpresaCampanhaResponsaveis";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresaCampanhaResponsaveisMAP::rsToObj($aReg);
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
					".EmpresaCampanhaResponsaveisMAP::dataToSelect()." 
                from
					empresa_campanha_responsaveis 
				left join campanha 
					on (empresa_campanha_responsaveis.idCampanha = campanha.idCampanha)
				left join empresacampanha 
					on (empresa_campanha_responsaveis.idEmpresaCampanha = empresacampanha.idEmpresaCampanha)
				left join responsaveis 
					on (empresa_campanha_responsaveis.idResponsaveis = responsaveis.idResponsaveis)";
                                        
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
                return EmpresaCampanhaResponsaveisMAP::rsToObj($aReg);
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
					".EmpresaCampanhaResponsaveisMAP::dataToSelect()." 
				from
					empresa_campanha_responsaveis 
				left join campanha 
					on (empresa_campanha_responsaveis.idCampanha = campanha.idCampanha)
				left join empresacampanha 
					on (empresa_campanha_responsaveis.idEmpresaCampanha = empresacampanha.idEmpresaCampanha)
				left join responsaveis 
					on (empresa_campanha_responsaveis.idResponsaveis = responsaveis.idResponsaveis)";
        
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
                    $aObj[] = EmpresaCampanhaResponsaveisMAP::rsToObj($aReg);
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
        $sql = "select count(*) from empresa_campanha_responsaveis";
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
					".EmpresaCampanhaResponsaveisMAP::dataToSelect()." 
				from
					empresa_campanha_responsaveis 
				left join campanha 
					on (empresa_campanha_responsaveis.idCampanha = campanha.idCampanha)
				left join empresacampanha 
					on (empresa_campanha_responsaveis.idEmpresaCampanha = empresacampanha.idEmpresaCampanha)
				left join responsaveis 
					on (empresa_campanha_responsaveis.idResponsaveis = responsaveis.idResponsaveis)
                where
					".EmpresaCampanhaResponsaveisMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaCampanhaResponsaveisMAP::rsToObj($aReg);
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