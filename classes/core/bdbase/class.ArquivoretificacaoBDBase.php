<?php
class ArquivoretificacaoBDBase {
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
	
    function inserir($oArquivoretificacao){
		$reg = ArquivoretificacaoMAP::objToRs($oArquivoretificacao);
		$aCampo = array_keys($reg);
		$sql = "
				insert into arquivoretificacao(
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
	
	function alterar($oArquivoretificacao){
    	$reg = ArquivoretificacaoMAP::objToRs($oArquivoretificacao);
        $sql = "
                update 
                    arquivoretificacao 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idArqRet") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idArqRet = {$reg['idArqRet']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idArqRet") continue;
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
	
	function excluir($idArqRet){
        $sql = "
                delete from
                    arquivoretificacao 
                where
                    idArqRet = $idArqRet";

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
	
	function get($idArqRet){
        $sql = "
                select 
					".ArquivoretificacaoMAP::dataToSelect()." 
                from
					arquivoretificacao 
				left join retificacaoempresa 
					on (arquivoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa) 
                where
					arquivoretificacao.idArqRet = $idArqRet";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivoretificacaoMAP::rsToObj($aReg);
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
					".ArquivoretificacaoMAP::dataToSelect()." 
                from
					arquivoretificacao 
				left join retificacaoempresa 
					on (arquivoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)";
                                        
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
                return ArquivoretificacaoMAP::rsToObj($aReg);
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
					".ArquivoretificacaoMAP::dataToSelect()." 
				from
					arquivoretificacao 
				left join retificacaoempresa 
					on (arquivoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)";
        
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
                    $aObj[] = ArquivoretificacaoMAP::rsToObj($aReg);
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
        $sql = "select count(*) from arquivoretificacao";
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
					".ArquivoretificacaoMAP::dataToSelect()." 
				from
					arquivoretificacao 
				left join retificacaoempresa 
					on (arquivoretificacao.idRetEmpresa = retificacaoempresa.idRetEmpresa)
                where
					".ArquivoretificacaoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ArquivoretificacaoMAP::rsToObj($aReg);
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