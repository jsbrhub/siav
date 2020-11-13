<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivoempresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivoempresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivoempresaBDBase.php');

class ArquivoempresaBD extends ArquivoempresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function retornaArquivoProjetoByEmpresa($idEmpresa){
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
					arquivoempresa.idEmpresa = $idEmpresa AND arquivoempresa.idTipoArquivo = '1' ";
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

    function retornaArquivoPesquisaByEmpresa($idEmpresa){
        $sql = "select 
					".ArquivoempresaMAP::dataToSelect()." 
                from
					arquivoempresa 
				left join empresa 
					on (arquivoempresa.idEmpresa = empresa.idEmpresa)
				left join tipoarquivo 
					on (arquivoempresa.idTipoArquivo = tipoarquivo.idTipoArquivo) 
                where
					arquivoempresa.idEmpresa = $idEmpresa AND arquivoempresa.idTipoArquivo = '11'";
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


    function retornaArquivoPoliticaByEmpresa($idEmpresa){
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
					arquivoempresa.idEmpresa = $idEmpresa AND
					 arquivoempresa.idTipoArquivo = '8'
					";
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


    function listaDocumentosEmpresa($idEmpresa){
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
					arquivoempresa.idEmpresa = $idEmpresa 
				order by
				    arquivoempresa.idTipoArquivo ASC
					";
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


    function listaArquivoRetificacaoEmpresa($idEmpresa){
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
					arquivoempresa.idEmpresa = $idEmpresa AND
					 arquivoempresa.idTipoArquivo = '9' 
					
					";
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