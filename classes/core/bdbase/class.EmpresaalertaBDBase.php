<?php
class EmpresaalertaBDBase {
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
	
    function inserir($oEmpresaalerta){
		$reg = EmpresaalertaMAP::objToRs($oEmpresaalerta);
		$aCampo = array_keys($reg);
		$sql = "
				insert into empresaalerta(
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
	
	function alterar($oEmpresaalerta){
    	$reg = EmpresaalertaMAP::objToRs($oEmpresaalerta);
        $sql = "
                update 
                    empresaalerta 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaAlerta") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idEmpresaAlerta = {$reg['idEmpresaAlerta']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaAlerta") continue;
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
	
	function excluir($idEmpresaAlerta){
        $sql = "
                delete from
                    empresaalerta 
                where
                    idEmpresaAlerta = $idEmpresaAlerta";

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
	
	function get($idEmpresaAlerta){
        $sql = "
                select 
					".EmpresaalertaMAP::dataToSelect()." 
                from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha) 
                where
					empresaalerta.idEmpresaAlerta = $idEmpresaAlerta";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresaalertaMAP::rsToObj($aReg);
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
					".EmpresaalertaMAP::dataToSelect()." 
                from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha)";
                                        
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
                return EmpresaalertaMAP::rsToObj($aReg);
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
					".EmpresaalertaMAP::dataToSelect()."
				from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha)";
        
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
                    $aObj[] = EmpresaalertaMAP::rsToObj($aReg);
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
        $sql = "select count(*) from empresaalerta";
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
					".EmpresaalertaMAP::dataToSelect()." 
				from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha)
                where
					".EmpresaalertaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresaalertaMAP::rsToObj($aReg);
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