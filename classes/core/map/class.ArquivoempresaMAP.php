<?php
class ArquivoempresaMAP {

	static function getMetaData() {
		return ['arquivoempresa' => ['idArquivoEmpresa', 
'idEmpresa', 
'idTipoArquivo', 
'nomeArquivo', 
'novoNome', 
'descricao', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'empresa' => ['idEmpresa', 
'idMunicipio', 
'idSituacao', 
'idIncentivo', 
'idModalidade', 
'cnpj', 
'cnpjMatriz', 
'anoBase', 
'anoAprovacao', 
'razaoSocial', 
'telefone', 
'fax', 
'email', 
'fonteOrigem', 
'latitude', 
'longitude', 
'endereco', 
'numero', 
'complemento', 
'bairro', 
'cep', 
'setor', 
'enq', 
'numSudam', 
'procurador', 
'laudoData', 
'laudoNumero', 
'anoCalendario', 
'resolucaoData', 
'resolucaoNumero', 
'declaracaoData', 
'declaracaoNumero', 
'situacaoCadastro', 
'projetoSocial', 
'politicaAmbiental', 
'vigente', 
'anoVigencia', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'tipoarquivo' => ['idTipoArquivo', 
'tipo', 
'formato']];
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

	static function objToRs($oArquivoempresa){
		$reg['idArquivoEmpresa'] = $oArquivoempresa->idArquivoEmpresa;
		$oEmpresa = $oArquivoempresa->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oTipoarquivo = $oArquivoempresa->oTipoarquivo;
		$reg['idTipoArquivo'] = $oTipoarquivo->idTipoArquivo;
		$reg['nomeArquivo'] = $oArquivoempresa->nomeArquivo;
		$reg['novoNome'] = $oArquivoempresa->novoNome;
		$reg['descricao'] = $oArquivoempresa->descricao;
		$reg['dataHoraAlteracao'] = $oArquivoempresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoempresa->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivoempresa){
		$oEmpresa = $oArquivoempresa->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oTipoarquivo = $oArquivoempresa->oTipoarquivo;
		$reg['idTipoArquivo'] = $oTipoarquivo->idTipoArquivo;
		$reg['nomeArquivo'] = $oArquivoempresa->nomeArquivo;
		$reg['novoNome'] = $oArquivoempresa->novoNome;
		$reg['descricao'] = $oArquivoempresa->descricao;
		$reg['dataHoraAlteracao'] = $oArquivoempresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoempresa->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivoempresa = new Arquivoempresa();
		$oArquivoempresa->idArquivoEmpresa = $reg['arquivoempresa_idArquivoEmpresa'];

		$oEmpresa = new Empresa();
		$oEmpresa->idEmpresa = $reg['empresa_idEmpresa'];
		$oEmpresa->cnpj = $reg['empresa_cnpj'];
		$oEmpresa->cnpjMatriz = $reg['empresa_cnpjMatriz'];
		$oEmpresa->anoBase = $reg['empresa_anoBase'];
		$oEmpresa->anoAprovacao = $reg['empresa_anoAprovacao'];
		$oEmpresa->razaoSocial = $reg['empresa_razaoSocial'];
		$oEmpresa->telefone = $reg['empresa_telefone'];
		$oEmpresa->fax = $reg['empresa_fax'];
		$oEmpresa->email = $reg['empresa_email'];
		$oEmpresa->fonteOrigem = $reg['empresa_fonteOrigem'];
		$oEmpresa->latitude = $reg['empresa_latitude'];
		$oEmpresa->longitude = $reg['empresa_longitude'];
		$oEmpresa->endereco = $reg['empresa_endereco'];
		$oEmpresa->numero = $reg['empresa_numero'];
		$oEmpresa->complemento = $reg['empresa_complemento'];
		$oEmpresa->bairro = $reg['empresa_bairro'];
		$oEmpresa->cep = $reg['empresa_cep'];
		$oEmpresa->setor = $reg['empresa_setor'];
		$oEmpresa->enq = $reg['empresa_enq'];
		$oEmpresa->numSudam = $reg['empresa_numSudam'];
		$oEmpresa->procurador = $reg['empresa_procurador'];
		$oEmpresa->laudoData = $reg['empresa_laudoData'];
		$oEmpresa->laudoNumero = $reg['empresa_laudoNumero'];
		$oEmpresa->anoCalendario = $reg['empresa_anoCalendario'];
		$oEmpresa->resolucaoData = $reg['empresa_resolucaoData'];
		$oEmpresa->resolucaoNumero = $reg['empresa_resolucaoNumero'];
		$oEmpresa->declaracaoData = $reg['empresa_declaracaoData'];
		$oEmpresa->declaracaoNumero = $reg['empresa_declaracaoNumero'];
		$oEmpresa->situacaoCadastro = $reg['empresa_situacaoCadastro'];
		$oEmpresa->projetoSocial = $reg['empresa_projetoSocial'];
		$oEmpresa->politicaAmbiental = $reg['empresa_politicaAmbiental'];
		$oEmpresa->vigente = $reg['empresa_vigente'];
		$oEmpresa->anoVigencia = $reg['empresa_anoVigencia'];
		$oEmpresa->dataHoraAlteracao = $reg['empresa_dataHoraAlteracao'];
		$oEmpresa->usuarioAlteracao = $reg['empresa_usuarioAlteracao'];
		$oArquivoempresa->oEmpresa = $oEmpresa;

		$oTipoarquivo = new Tipoarquivo();
		$oTipoarquivo->idTipoArquivo = $reg['tipoarquivo_idTipoArquivo'];
		$oTipoarquivo->tipo = $reg['tipoarquivo_tipo'];
		$oTipoarquivo->formato = $reg['tipoarquivo_formato'];
		$oArquivoempresa->oTipoarquivo = $oTipoarquivo;
		$oArquivoempresa->nomeArquivo = $reg['arquivoempresa_nomeArquivo'];
		$oArquivoempresa->novoNome = $reg['arquivoempresa_novoNome'];
		$oArquivoempresa->descricao = $reg['arquivoempresa_descricao'];
		$oArquivoempresa->dataHoraAlteracao = $reg['arquivoempresa_dataHoraAlteracao'];
		$oArquivoempresa->usuarioAlteracao = $reg['arquivoempresa_usuarioAlteracao'];
		return $oArquivoempresa;		   
	}
}
