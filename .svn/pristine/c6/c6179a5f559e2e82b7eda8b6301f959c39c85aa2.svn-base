<?php
class ArquivoretificacaoMAP {

	static function getMetaData() {
		return ['arquivoretificacao' => ['idArqRet', 
'idRetEmpresa', 
'cnpj', 
'nomeArquivo', 
'novoNome', 
'link', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'retificacaoempresa' => ['idRetEmpresa', 
'idEmpresa', 
'cnpj', 
'anoBase', 
'motivo', 
'justificativa', 
'status', 
'dataSolicitacao', 
'usuarioSolicitacao']];
	}
	
	static function dataToSelect() {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
			}
		}
	
		return implode(",\n", $aux);
	}
	
	static function filterLike($valor) {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo like '$valor'";
			}
		}
	
		return implode("\nor ", $aux);
	}

	static function objToRs($oArquivoretificacao){
		$reg['idArqRet'] = $oArquivoretificacao->idArqRet;
		$oRetificacaoempresa = $oArquivoretificacao->oRetificacaoempresa;
		$reg['idRetEmpresa'] = $oRetificacaoempresa->idRetEmpresa;
		$reg['cnpj'] = $oArquivoretificacao->cnpj;
		$reg['nomeArquivo'] = $oArquivoretificacao->nomeArquivo;
		$reg['novoNome'] = $oArquivoretificacao->novoNome;
		$reg['link'] = $oArquivoretificacao->link;
		$reg['dataHoraAlteracao'] = $oArquivoretificacao->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoretificacao->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivoretificacao){
		$oRetificacaoempresa = $oArquivoretificacao->oRetificacaoempresa;
		$reg['idRetEmpresa'] = $oRetificacaoempresa->idRetEmpresa;
		$reg['cnpj'] = $oArquivoretificacao->cnpj;
		$reg['nomeArquivo'] = $oArquivoretificacao->nomeArquivo;
		$reg['novoNome'] = $oArquivoretificacao->novoNome;
		$reg['link'] = $oArquivoretificacao->link;
		$reg['dataHoraAlteracao'] = $oArquivoretificacao->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoretificacao->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivoretificacao = new Arquivoretificacao();
		$oArquivoretificacao->idArqRet = $reg['arquivoretificacao_idArqRet'];

		$oRetificacaoempresa = new Retificacaoempresa();
		$oRetificacaoempresa->idRetEmpresa = $reg['retificacaoempresa_idRetEmpresa'];
		$oRetificacaoempresa->cnpj = $reg['retificacaoempresa_cnpj'];
		$oRetificacaoempresa->anoBase = $reg['retificacaoempresa_anoBase'];
		$oRetificacaoempresa->motivo = $reg['retificacaoempresa_motivo'];
		$oRetificacaoempresa->justificativa = $reg['retificacaoempresa_justificativa'];
		$oRetificacaoempresa->status = $reg['retificacaoempresa_status'];
		$oRetificacaoempresa->dataSolicitacao = $reg['retificacaoempresa_dataSolicitacao'];
		$oRetificacaoempresa->usuarioSolicitacao = $reg['retificacaoempresa_usuarioSolicitacao'];
		$oArquivoretificacao->oRetificacaoempresa = $oRetificacaoempresa;
		$oArquivoretificacao->cnpj = $reg['arquivoretificacao_cnpj'];
		$oArquivoretificacao->nomeArquivo = $reg['arquivoretificacao_nomeArquivo'];
		$oArquivoretificacao->novoNome = $reg['arquivoretificacao_novoNome'];
		$oArquivoretificacao->link = $reg['arquivoretificacao_link'];
		$oArquivoretificacao->dataHoraAlteracao = $reg['arquivoretificacao_dataHoraAlteracao'];
		$oArquivoretificacao->usuarioAlteracao = $reg['arquivoretificacao_usuarioAlteracao'];
		return $oArquivoretificacao;		   
	}
}
