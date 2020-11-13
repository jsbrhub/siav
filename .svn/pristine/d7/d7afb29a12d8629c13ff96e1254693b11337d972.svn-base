<?php
class ArquivoempresaBDBase {
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
	
    function inserir($oArquivoempresa){
		$reg = ArquivoempresaMAP::objToRs($oArquivoempresa);
		$aCampo = array_keys($reg);
		$sql = "
				insert into arquivoempresa(
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
	
	function alterar($oArquivoempresa){
    	$reg = ArquivoempresaMAP::objToRs($oArquivoempresa);
        $sql = "
                update 
                    arquivoempresa 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idArquivoEmpresa") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idArquivoEmpresa = {$reg['idArquivoEmpresa']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idArquivoEmpresa") continue;
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
	
	function excluir($idArquivoEmpresa){
        $sql = "
                delete from
                    arquivoempresa 
                where
                    idArquivoEmpresa = $idArquivoEmpresa";

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
	
	function get($idArquivoEmpresa){
        $sql = "
                select 
					".ArquivoempresaMAP::dataToSelect()." 
                from
					arquivoempresa 
				left join empresa 
					on (arquivoempresa.idEmpresa = empresa.idEmpresa)
				left join tipoarquivo 
					on (arquivoempresa.idTipoArquivo = tipoarquivo.idTipoArquivo) 
                where
					arquivoempresa.idArquivoEmpresa = $idArquivoEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivoempresaMAP::rsToObj($aReg);
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
					".ArquivoempresaMAP::dataToSelect()." 
                from
					arquivoempresa 
				left join empresa 
					on (arquivoempresa.idEmpresa = empresa.idEmpresa)
				left join tipoarquivo 
					on (arquivoempresa.idTipoArquivo = tipoarquivo.idTipoArquivo)";
                                        
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
                return ArquivoempresaMAP::rsToObj($aReg);
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
					".ArquivoempresaMAP::dataToSelect()." 
				from
					arquivoempresa 
				left join empresa 
					on (arquivoempresa.idEmpresa = empresa.idEmpresa)
				left join tipoarquivo 
					on (arquivoempresa.idTipoArquivo = tipoarquivo.idTipoArquivo)";
        
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
                    $aObj[] = ArquivoempresaMAP::rsToObj($aReg);
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
        $sql = "select count(*) from arquivoempresa";
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
					".ArquivoempresaMAP::dataToSelect()." 
				from
					arquivoempresa 
				left join empresa 
					on (arquivoempresa.idEmpresa = empresa.idEmpresa)
				left join tipoarquivo 
					on (arquivoempresa.idTipoArquivo = tipoarquivo.idTipoArquivo)
                where
					".ArquivoempresaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ArquivoempresaMAP::rsToObj($aReg);
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