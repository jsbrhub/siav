<?php
class PoliticaambientalMAP {

	static function getMetaData() {
		return ['politicaambiental' => ['idPolitica', 
'idEmpresa', 
'residuosGerados', 
'descricaoTratamento', 
'quantGerado', 
'unidadeQg', 
'descricaoQg', 
'quantTratado', 
'unidadeQt', 
'descricaoQt', 
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
'usuarioAlteracao']];
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

	static function objToRs($oPoliticaambiental){
		$reg['idPolitica'] = $oPoliticaambiental->idPolitica;
		$oEmpresa = $oPoliticaambiental->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['residuosGerados'] = $oPoliticaambiental->residuosGerados;
		$reg['descricaoTratamento'] = $oPoliticaambiental->descricaoTratamento;
		$reg['quantGerado'] = $oPoliticaambiental->quantGerado;
		$reg['unidadeQg'] = $oPoliticaambiental->unidadeQg;
		$reg['descricaoQg'] = $oPoliticaambiental->descricaoQg;
		$reg['quantTratado'] = $oPoliticaambiental->quantTratado;
		$reg['unidadeQt'] = $oPoliticaambiental->unidadeQt;
		$reg['descricaoQt'] = $oPoliticaambiental->descricaoQt;
		$reg['dataHoraAlteracao'] = $oPoliticaambiental->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oPoliticaambiental->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oPoliticaambiental){
		$oEmpresa = $oPoliticaambiental->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['residuosGerados'] = $oPoliticaambiental->residuosGerados;
		$reg['descricaoTratamento'] = $oPoliticaambiental->descricaoTratamento;
		$reg['quantGerado'] = $oPoliticaambiental->quantGerado;
		$reg['unidadeQg'] = $oPoliticaambiental->unidadeQg;
		$reg['descricaoQg'] = $oPoliticaambiental->descricaoQg;
		$reg['quantTratado'] = $oPoliticaambiental->quantTratado;
		$reg['unidadeQt'] = $oPoliticaambiental->unidadeQt;
		$reg['descricaoQt'] = $oPoliticaambiental->descricaoQt;
		$reg['dataHoraAlteracao'] = $oPoliticaambiental->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oPoliticaambiental->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPoliticaambiental = new Politicaambiental();
		$oPoliticaambiental->idPolitica = $reg['politicaambiental_idPolitica'];

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
		$oPoliticaambiental->oEmpresa = $oEmpresa;
		$oPoliticaambiental->residuosGerados = $reg['politicaambiental_residuosGerados'];
		$oPoliticaambiental->descricaoTratamento = $reg['politicaambiental_descricaoTratamento'];
		$oPoliticaambiental->quantGerado = $reg['politicaambiental_quantGerado'];
		$oPoliticaambiental->unidadeQg = $reg['politicaambiental_unidadeQg'];
		$oPoliticaambiental->descricaoQg = $reg['politicaambiental_descricaoQg'];
		$oPoliticaambiental->quantTratado = $reg['politicaambiental_quantTratado'];
		$oPoliticaambiental->unidadeQt = $reg['politicaambiental_unidadeQt'];
		$oPoliticaambiental->descricaoQt = $reg['politicaambiental_descricaoQt'];
		$oPoliticaambiental->dataHoraAlteracao = $reg['politicaambiental_dataHoraAlteracao'];
		$oPoliticaambiental->usuarioAlteracao = $reg['politicaambiental_usuarioAlteracao'];
		return $oPoliticaambiental;		   
	}
}
