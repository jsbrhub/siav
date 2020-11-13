<?php
class OrigeminsumosBDBase {
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
	
    function inserir($oOrigeminsumos){
		$reg = OrigeminsumosMAP::objToRs($oOrigeminsumos);
		$aCampo = array_keys($reg);
		$sql = "
				insert into origeminsumos(
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
	
	function alterar($oOrigeminsumos){
    	$reg = OrigeminsumosMAP::objToRs($oOrigeminsumos);
        $sql = "
                update 
                    origeminsumos 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idOrigemInsumos") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idOrigemInsumos = {$reg['idOrigemInsumos']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idOrigemInsumos") continue;
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
	
	function excluir($idOrigemInsumos){
        $sql = "
                delete from
                    origeminsumos 
                where
                    idOrigemInsumos = $idOrigemInsumos";

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
	
	function get($idOrigemInsumos){
        $sql = "
                select 
					".OrigeminsumosMAP::dataToSelect()." 
                from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo) 
                where
					origeminsumos.idOrigemInsumos = $idOrigemInsumos";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return OrigeminsumosMAP::rsToObj($aReg);
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
					".OrigeminsumosMAP::dataToSelect()." 
                from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo)";
                                        
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
                return OrigeminsumosMAP::rsToObj($aReg);
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
					".OrigeminsumosMAP::dataToSelect()." 
				from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo)";
        
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
                    $aObj[] = OrigeminsumosMAP::rsToObj($aReg);
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
        $sql = "select count(*) from origeminsumos";
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
					".OrigeminsumosMAP::dataToSelect()." 
				from
					origeminsumos 
				left join empresa 
					on (origeminsumos.idEmpresa = empresa.idEmpresa)
				left join insumos 
					on (origeminsumos.idInsumo = insumos.idInsumo)
                where
					".OrigeminsumosMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = OrigeminsumosMAP::rsToObj($aReg);
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