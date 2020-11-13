<?php
class EmpresacontroleBDBase {
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
	
    function inserir($oEmpresacontrole){
		$reg = EmpresacontroleMAP::objToRs($oEmpresacontrole);
		$aCampo = array_keys($reg);
		$sql = "
				insert into empresacontrole(
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
               // Util::trace($this->msg);
				return false;
			}


			return $this->oConexao->lastID();

		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
           // Util::trace($this->msg);
			return false;
		}
	}
	
	function alterar($oEmpresacontrole){
    	$reg = EmpresacontroleMAP::objToRs($oEmpresacontrole);
        $sql = "
                update 
                    empresacontrole 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaControle") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idEmpresaControle = {$reg['idEmpresaControle']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idEmpresaControle") continue;
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
	
	function excluir($idEmpresaControle){
        $sql = "
                delete from
                    empresacontrole 
                where
                    idEmpresaControle = $idEmpresaControle";

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
	
	function get($idEmpresaControle){
        $sql = "
                select 
					".EmpresacontroleMAP::dataToSelect()." 
                from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa) 
                where
					empresacontrole.idEmpresaControle = $idEmpresaControle";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return EmpresacontroleMAP::rsToObj($aReg);
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
					".EmpresacontroleMAP::dataToSelect()." 
                from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa)";
                                        
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
                return EmpresacontroleMAP::rsToObj($aReg);
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
					".EmpresacontroleMAP::dataToSelect()." 
				from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa)";
        
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
                    $aObj[] = EmpresacontroleMAP::rsToObj($aReg);
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
        $sql = "select count(*) from empresacontrole";
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
					".EmpresacontroleMAP::dataToSelect()." 
				from
					empresacontrole 
				left join campanha 
					on (empresacontrole.idCampanha = campanha.idCampanha)
				left join empresa 
					on (empresacontrole.idEmpresa = empresa.idEmpresa)
                where
					".EmpresacontroleMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = EmpresacontroleMAP::rsToObj($aReg);
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