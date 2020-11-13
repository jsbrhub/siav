<?php
class EmpresacampanhaBDBase {
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
	
    function inserir($oEmpresacampanha){
		$reg = EmpresacampanhaMAP::objToRs($oEmpresacampanha);
		$aCampo = array_keys($reg);
		$sql = "
				insert into empresacampanha(
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
	
	function alterar($oEmpresacampanha){
    	$reg = EmpresacampanhaMAP::objToRs($oEmpresacampanha);
        $sql = "
                update 
                    empresacampanha 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaCampanha") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idEmpresaCampanha = {$reg['idEmpresaCampanha']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaCampanha") continue;
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
	
	function excluir($idEmpresaCampanha){
        $sql = "
                delete from
                    empresacampanha 
                where
                    idEmpresaCampanha = $idEmpresaCampanha";

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
	
	function get($idEmpresaCampanha){
        $sql = "
                select 
					".EmpresacampanhaMAP::dataToSelect()." 
                from
					empresacampanha 
				left join campanha 
					on (empresacampanha.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacampanha.idEmpresa = empresa.idEmpresa) 
                where
					empresacampanha.idEmpresaCampanha = $idEmpresaCampanha";
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
        
        function getRow($aFiltro = NULL, $aOrdenacao = NULL){
        $sql = "
                select 
					".EmpresacampanhaMAP::dataToSelect()." 
                from
					empresacampanha 
				left join campanha 
					on (empresacampanha.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacampanha.idEmpresa = empresa.idEmpresa)";
                                        
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
	
    function getAll($aFiltro = NULL, $aOrdenacao = NULL){
        $sql = "
				select
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha 
				left join campanha 
					on (empresacampanha.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacampanha.idEmpresa = empresa.idEmpresa)";
        
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

    function totalColecao(){
        $sql = "select count(*) from empresacampanha";
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
					".EmpresacampanhaMAP::dataToSelect()." 
				from
					empresacampanha 
				left join campanha 
					on (empresacampanha.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacampanha.idEmpresa = empresa.idEmpresa)
                where
					".EmpresacampanhaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
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