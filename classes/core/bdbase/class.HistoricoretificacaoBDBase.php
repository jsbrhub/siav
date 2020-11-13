<?php
class HistoricoretificacaoBDBase {
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
	
    function inserir($oHistoricoretificacao){
		$reg = HistoricoretificacaoMAP::objToRs($oHistoricoretificacao);
		$aCampo = array_keys($reg);
		$sql = "
				insert into historicoretificacao(
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
	
	function alterar($oHistoricoretificacao){
    	$reg = HistoricoretificacaoMAP::objToRs($oHistoricoretificacao);
        $sql = "
                update 
                    historicoretificacao 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idHistRet") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idHistRet = {$reg['idHistRet']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idHistRet") continue;
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
	
	function excluir($idHistRet){
        $sql = "
                delete from
                    historicoretificacao 
                where
                    idHistRet = $idHistRet";

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
	
	function get($idHistRet){
        $sql = "
                select 
					".HistoricoretificacaoMAP::dataToSelect()." 
                from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa) 
                where
					historicoretificacao.idHistRet = $idHistRet";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return HistoricoretificacaoMAP::rsToObj($aReg);
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
					".HistoricoretificacaoMAP::dataToSelect()." 
                from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa)";
                                        
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
                return HistoricoretificacaoMAP::rsToObj($aReg);
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
					".HistoricoretificacaoMAP::dataToSelect()." 
				from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa)";
        
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
                    $aObj[] = HistoricoretificacaoMAP::rsToObj($aReg);
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
        $sql = "select count(*) from historicoretificacao";
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
					".HistoricoretificacaoMAP::dataToSelect()." 
				from
					historicoretificacao 
				left join retificacaoempresa 
					on (historicoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
				left join retificacaosudam 
					on (historicoretificacao.idRetSudam = retificacaosudam.idRetSudam)
				left join empresa 
					on (historicoretificacao.idEmpresa = empresa.idEmpresa)
                where
					".HistoricoretificacaoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = HistoricoretificacaoMAP::rsToObj($aReg);
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