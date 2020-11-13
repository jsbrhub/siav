<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Arquivo.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.ArquivoMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.ArquivoBDBase.php');

class ArquivoBD extends ArquivoBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function inserirArquivo($nomeArquivo,$novoNome,$dataImportacao,$situacao,$status,$dataHoraAlteracao,$usuario){

        $sql = "INSERT INTO arquivo (
arquivo.idArquivo, arquivo.nomeArquivo, arquivo.novoNome, arquivo.dataImportacao, arquivo.situacao, arquivo.status, arquivo.dataHoraAlteracao, arquivo.usuarioAlteracao) VALUES (NULL, '$nomeArquivo', '$novoNome', '$dataImportacao', '$situacao', '$status', '$dataHoraAlteracao', '$usuario');";

        try{
            $this->oConexao->executePrepare($sql);

            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }



    function updateSituacao($idArquivo,$situacao){

        $sql = "UPDATE arquivo SET arquivo.situacao = '$situacao' WHERE arquivo.idArquivo = $idArquivo";
        try{
            $this->oConexao->executePrepare($sql);

            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }


}