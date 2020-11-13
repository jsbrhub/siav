<?php
require_once(dirname(dirname(__FILE__)).'/core/basicas/class.Cadastrofinanceiro.php');
require_once(dirname(dirname(__FILE__)).'/core/map/class.CadastrofinanceiroMAP.php');
require_once(dirname(dirname(__FILE__)).'/core/bdbase/class.CadastrofinanceiroBDBase.php');

class CadastrofinanceiroBD extends CadastrofinanceiroBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }

    function inserirFinanceiroExcel($oCadastrofinanceiro){

        $sql = "
				insert into cadastrofinanceiro(idCadastroFinanceiro,idEmpresa,ehEstimado,faturamentoBruto,imobilizadoTotal,	reservaExercicio,irDescontada,valorIcms,valorIssqn,empregosDiretos,despesaTerceiro,terceirizadosExistentes,pessoasEncargos,impostosTaxasContribuicoes,remuneracaoCapitalTerceiros,remuneracaoCapitalProprio,investimentoCapitalFixo,faturamentoProdIncentivados,reservaInvestimento,valorIRtotal,capitalGiro,capitalFixo,maoObraDireta,maoObraIndiretaFixa,maoObraReal,recursosProprios,previsaoIsencao,
 acionistas,totalReinvestimento, valorDescontoIR, reservaIncentivo,dataHoraAlteracao,usuarioAlteracao)
				values(
				NULL,'$oCadastrofinanceiro[0]','$oCadastrofinanceiro[1]','$oCadastrofinanceiro[2]','$oCadastrofinanceiro[3]','$oCadastrofinanceiro[4]','$oCadastrofinanceiro[5]','$oCadastrofinanceiro[6]','$oCadastrofinanceiro[7]','$oCadastrofinanceiro[8]','$oCadastrofinanceiro[9]','$oCadastrofinanceiro[10]','$oCadastrofinanceiro[11]','$oCadastrofinanceiro[12]','$oCadastrofinanceiro[13]','$oCadastrofinanceiro[14]','$oCadastrofinanceiro[15]','$oCadastrofinanceiro[16]','$oCadastrofinanceiro[17]','$oCadastrofinanceiro[18]','$oCadastrofinanceiro[19]','$oCadastrofinanceiro[20]','$oCadastrofinanceiro[21]','$oCadastrofinanceiro[22]','$oCadastrofinanceiro[23]','$oCadastrofinanceiro[24]','$oCadastrofinanceiro[25]','$oCadastrofinanceiro[26]','$oCadastrofinanceiro[27]','$oCadastrofinanceiro[28]','$oCadastrofinanceiro[29]','$oCadastrofinanceiro[30]','$oCadastrofinanceiro[31]'
					)";
        try{
            $this->oConexao->executePrepare($sql);
            if($this->oConexao->msg != ""){
                Util::trace($sql);
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return $this->oConexao->lastID();
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return -1;
        }
    }

    function getFinanceiroByEmpresa($idEmpresa){
        $sql = "
                select 
					".CadastrofinanceiroMAP::dataToSelect()." 
                from
					cadastrofinanceiro 
				left join empresa 
					on (cadastrofinanceiro.idEmpresa = empresa.idEmpresa) 
                where
					cadastrofinanceiro.idEmpresa = $idEmpresa";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $aReg = $this->oConexao->fetchReg();
                return CadastrofinanceiroMAP::rsToObj($aReg);
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

}