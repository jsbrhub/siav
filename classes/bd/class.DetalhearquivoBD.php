<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Detalhearquivo.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.DetalhearquivoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.DetalhearquivoBDBase.php');

class DetalhearquivoBD extends DetalhearquivoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function inserirDetalhe($cdArquivo,$descricao,$linha){
        $sql = "INSERT INTO detalhearquivo (idDetalhearquivo, idArquivo, descricao,linha) 
                VALUES ( NULL, '$cdArquivo', '$descricao', '$linha');";
        try{
            $this->oConexao->executePrepare($sql);
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


    function listaDetalhesByArquivo($idArquivo){
        $sql = "
                select 
					".DetalhearquivoMAP::dataToSelect()." 
                from
					detalhearquivo 
				left join arquivo 
					on (detalhearquivo.idArquivo = arquivo.idArquivo) 
                where
					detalhearquivo.idArquivo = $idArquivo";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($aReg = $this->oConexao->fetchReg()){
                    $aObj[] = DetalhearquivoMAP::rsToObj($aReg);
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