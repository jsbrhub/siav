<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Autenticacaoempresa.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.AutenticacaoempresaMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.AutenticacaoempresaBDBase.php');

class AutenticacaoempresaBD extends AutenticacaoempresaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function autenticaEmpresa($cnpj,$senha){
        $cnpj = Util::limpaCampo($cnpj);
        $senha = md5($senha);

        $sql = "
                select 
					".AutenticacaoempresaMAP::dataToSelect()." 
                from
					autenticacaoempresa 
                where
					autenticacaoempresa.cnpj = '$cnpj' and autenticacaoempresa.senha = '$senha'";
        try{
            $this->oConexao->execute($sql);
            $oReg = $this->oConexao->fetchReg();
           // Util::trace($oReg);
            if ($oReg) {
                $_SESSION['usuarioAtual']['login'] = $oReg['autenticacaoempresa_cnpj'];
                $_SESSION['usuarioAtual']['cnpj'] = $oReg['autenticacaoempresa_cnpj'];
                $_SESSION['usuarioAtual']['email'] = $oReg['autenticacaoempresa_email'];
                return true;
            } else {
                $this->msg = "Usuário ou Senha inválido(a)";
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function infoAutenticacao($cnpj){
        $sql = "
                select 
					".AutenticacaoempresaMAP::dataToSelect()." 
                from
					autenticacaoempresa 
                where
					autenticacaoempresa.cnpj = '$cnpj'";

        try{


            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                $this->oConexao->close();
                return AutenticacaoempresaMAP::rsToObj($aReg);
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


    function infoAutenticacaoByEmailCnpj($email,$cnpj){
        $sql = "
                select 
					".AutenticacaoempresaMAP::dataToSelect()." 
                from
					autenticacaoempresa 
                where
					autenticacaoempresa.cnpj = '$cnpj' AND
					autenticacaoempresa.email = '$email'";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return AutenticacaoempresaMAP::rsToObj($aReg);
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



    function alteraSenhaEmpresa($email,$senha,$cnpj){
        $senha = md5($senha);
        $sql = "
                update 
                    autenticacaoempresa 
                set
                    autenticacaoempresa.senha = '$senha',
                    autenticacaoempresa.senhaProv = NULL 
                where
                    autenticacaoempresa.email = '$email' AND 
                    autenticacaoempresa.cnpj = '$cnpj'";


        try{
            $this->oConexao->executePrepare($sql);
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


    function trocaSenhaEmpresa($cnpj,$senha,$novaSenha){
        $senha = md5($senha);
        $novaSenha = md5($novaSenha);
        $sql = "update 
                    autenticacaoempresa 
                set
                    autenticacaoempresa.senha = '$novaSenha'
                where
                    autenticacaoempresa.cnpj = '$cnpj' AND 
                    autenticacaoempresa.senha = '$senha'";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
               // Util::trace($sql,false);
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


    function updateEmail($cnpj,$email){
        $sql = "update 
                    autenticacaoempresa 
                set
                    autenticacaoempresa.email = '$email'
                where
                    autenticacaoempresa.cnpj = '$cnpj'";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                // Util::trace($sql,false);
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


    function insereUsuarioEmpresa($cnpj,$email){
        $senha = 'e10adc3949ba59abbe56e057f20f883e';
        $sql = "insert into  
                    autenticacaoempresa (idAutenticacao,cnpj,senha,email)
                VALUES (NULL,'$cnpj','$senha','$email')";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                //Util::trace($sql,false);
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



}