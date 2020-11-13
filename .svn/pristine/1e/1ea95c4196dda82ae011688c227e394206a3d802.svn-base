<?php
class TermoresponsabilidadeBDBase {
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
	
    function inserir($oTermoresponsabilidade){
		$reg = TermoresponsabilidadeMAP::objToRs($oTermoresponsabilidade);
		$aCampo = array_keys($reg);
		$sql = "
				insert into termoresponsabilidade(
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
	
	function alterar($oTermoresponsabilidade){
    	$reg = TermoresponsabilidadeMAP::objToRs($oTermoresponsabilidade);
        $sql = "
                update 
                    termoresponsabilidade 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idTermo") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idTermo = {$reg['idTermo']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idTermo") continue;
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
	
	function excluir($idTermo){
        $sql = "
                delete from
                    termoresponsabilidade 
                where
                    idTermo = $idTermo";

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
	
	function get($idTermo){
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
					termoresponsabilidade.idTermo = $idTermo";
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
        
        function getRow($aFiltro = NULL, $aOrdenacao = NULL){
        $sql = "
                select 
					".TermoresponsabilidadeMAP::dataToSelect()." 
                from
					termoresponsabilidade 
				left join campanha 
					on (termoresponsabilidade.idCampanha = campanha.idCampanha)
				left join empresa 
					on (termoresponsabilidade.idEmpresa = empresa.idEmpresa)";
                                        
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
	
    function getAll($aFiltro = NULL, $aOrdenacao = NULL){
        $sql = "
				select
					".TermoresponsabilidadeMAP::dataToSelect()." 
				from
					termoresponsabilidade 
				left join campanha 
					on (termoresponsabilidade.idCampanha = campanha.idCampanha)
				left join empresa 
					on (termoresponsabilidade.idEmpresa = empresa.idEmpresa)";
        
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
                    $aObj[] = TermoresponsabilidadeMAP::rsToObj($aReg);
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
        $sql = "select count(*) from termoresponsabilidade";
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
					".TermoresponsabilidadeMAP::dataToSelect()." 
				from
					termoresponsabilidade 
				left join campanha 
					on (termoresponsabilidade.idCampanha = campanha.idCampanha)
				left join empresa 
					on (termoresponsabilidade.idEmpresa = empresa.idEmpresa)
                where
					".TermoresponsabilidadeMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = TermoresponsabilidadeMAP::rsToObj($aReg);
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