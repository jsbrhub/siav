<?php
class ArquivopesquisaBDBase {
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
	
    function inserir($oArquivopesquisa){
		$reg = ArquivopesquisaMAP::objToRs($oArquivopesquisa);
		$aCampo = array_keys($reg);
		$sql = "
				insert into arquivopesquisa(
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
	
	function alterar($oArquivopesquisa){
    	$reg = ArquivopesquisaMAP::objToRs($oArquivopesquisa);
        $sql = "
                update 
                    arquivopesquisa 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idArquivoPesq") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idArquivoPesq = {$reg['idArquivoPesq']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idArquivoPesq") continue;
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
	
	function excluir($idArquivoPesq){
        $sql = "
                delete from
                    arquivopesquisa 
                where
                    idArquivoPesq = $idArquivoPesq";

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
	
	function get($idArquivoPesq){
        $sql = "
                select 
					".ArquivopesquisaMAP::dataToSelect()." 
                from
					arquivopesquisa 
				left join pesquisadesenvolvimento 
					on (arquivopesquisa.idPesquisa = pesquisadesenvolvimento.idPesquisa) 
                where
					arquivopesquisa.idArquivoPesq = $idArquivoPesq";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return ArquivopesquisaMAP::rsToObj($aReg);
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
					".ArquivopesquisaMAP::dataToSelect()." 
                from
					arquivopesquisa 
				left join pesquisadesenvolvimento 
					on (arquivopesquisa.idPesquisa = pesquisadesenvolvimento.idPesquisa)";
                                        
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
                return ArquivopesquisaMAP::rsToObj($aReg);
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
					".ArquivopesquisaMAP::dataToSelect()." 
				from
					arquivopesquisa 
				left join pesquisadesenvolvimento 
					on (arquivopesquisa.idPesquisa = pesquisadesenvolvimento.idPesquisa)";
        
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
                    $aObj[] = ArquivopesquisaMAP::rsToObj($aReg);
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
        $sql = "select count(*) from arquivopesquisa";
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
					".ArquivopesquisaMAP::dataToSelect()." 
				from
					arquivopesquisa 
				left join pesquisadesenvolvimento 
					on (arquivopesquisa.idPesquisa = pesquisadesenvolvimento.idPesquisa)
                where
					".ArquivopesquisaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = ArquivopesquisaMAP::rsToObj($aReg);
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