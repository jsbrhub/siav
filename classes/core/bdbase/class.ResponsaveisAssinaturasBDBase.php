<?php
class ResponsaveisAssinaturasBDBase {
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
	
    function inserir($oResponsaveisAssinaturas){
		$reg = ResponsaveisAssinaturasMAP::objToRs($oResponsaveisAssinaturas);
		$aCampo = array_keys($reg);
		$sql = "
				insert into responsaveis_assinaturas(
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
	
	function alterar($oResponsaveisAssinaturas){
    	$reg = ResponsaveisAssinaturasMAP::objToRs($oResponsaveisAssinaturas);
        $sql = "
                update 
                    responsaveis_assinaturas 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idResponsaveisAssinaturas") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idResponsaveisAssinaturas = {$reg['idResponsaveisAssinaturas']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idResponsaveisAssinaturas") continue;
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
	
	function excluir($idResponsaveisAssinaturas){
        $sql = "
                delete from
                    responsaveis_assinaturas 
                where
                    idResponsaveisAssinaturas = $idResponsaveisAssinaturas";

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
	
	function get($idResponsaveisAssinaturas){
        $sql = "
                select 
					".ResponsaveisAssinaturasMAP::dataToSelect()." 
                from
					responsaveis_assinaturas 
				left join responsaveis 
					on (responsaveis_assinaturas.idResponsaveis = responsaveis.idResponsaveis)
				left join empresa_campanha_responsaveis 
					on (responsaveis_assinaturas.idEmpresaCampanhaResponsaveis = empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis) 
                where
					responsaveis_assinaturas.idResponsaveisAssinaturas = $idResponsaveisAssinaturas";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ResponsaveisAssinaturasMAP::rsToObj($aReg);
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
					".ResponsaveisAssinaturasMAP::dataToSelect()." 
                from
					responsaveis_assinaturas 
				left join responsaveis 
					on (responsaveis_assinaturas.idResponsaveis = responsaveis.idResponsaveis)
				left join empresa_campanha_responsaveis 
					on (responsaveis_assinaturas.idEmpresaCampanhaResponsaveis = empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis)";
                                        
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
                return ResponsaveisAssinaturasMAP::rsToObj($aReg);
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
					".ResponsaveisAssinaturasMAP::dataToSelect()." 
				from
					responsaveis_assinaturas 
				left join responsaveis 
					on (responsaveis_assinaturas.idResponsaveis = responsaveis.idResponsaveis)
				left join empresa_campanha_responsaveis 
					on (responsaveis_assinaturas.idEmpresaCampanhaResponsaveis = empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis)";
        
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
                    $aObj[] = ResponsaveisAssinaturasMAP::rsToObj($aReg);
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
        $sql = "select count(*) from responsaveis_assinaturas";
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
					".ResponsaveisAssinaturasMAP::dataToSelect()." 
				from
					responsaveis_assinaturas 
				left join responsaveis 
					on (responsaveis_assinaturas.idResponsaveis = responsaveis.idResponsaveis)
				left join empresa_campanha_responsaveis 
					on (responsaveis_assinaturas.idEmpresaCampanhaResponsaveis = empresa_campanha_responsaveis.idEmpresaCampanhaResponsaveis)
                where
					".ResponsaveisAssinaturasMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ResponsaveisAssinaturasMAP::rsToObj($aReg);
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