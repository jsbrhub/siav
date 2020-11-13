<?php
class AcionistaMAP {

	static function getMetaData() {
		return ['acionista' => ['idAcionista', 
'idEmpresa', 
'nome', 
'cpfCnpj', 
'cnpj_padrao',
'tipoPessoa',
'email', 
'estrangeiro', 
'passaporte', 
'funcao', 
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

	static function objToRs($oAcionista){
		$reg['idAcionista'] = $oAcionista->idAcionista;
		$oEmpresa = $oAcionista->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['nome'] = $oAcionista->nome;
		$reg['cpfCnpj'] = $oAcionista->cpfCnpj;
		$reg['cnpj_padrao'] = $oAcionista->cnpj_padrao;
		$reg['tipoPessoa'] = $oAcionista->tipoPessoa;
		$reg['email'] = $oAcionista->email;
		$reg['estrangeiro'] = $oAcionista->estrangeiro;
		$reg['passaporte'] = $oAcionista->passaporte;
		$reg['funcao'] = $oAcionista->funcao;
		$reg['dataHoraAlteracao'] = $oAcionista->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oAcionista->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oAcionista){
		$oEmpresa = $oAcionista->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['nome'] = $oAcionista->nome;
		$reg['cpfCnpj'] = $oAcionista->cpfCnpj;
		$reg['cnpj_padrao'] = $oAcionista->cnpj_padrao;
		$reg['tipoPessoa'] = $oAcionista->tipoPessoa;
		$reg['email'] = $oAcionista->email;
		$reg['estrangeiro'] = $oAcionista->estrangeiro;
		$reg['passaporte'] = $oAcionista->passaporte;
		$reg['funcao'] = $oAcionista->funcao;
		$reg['dataHoraAlteracao'] = $oAcionista->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oAcionista->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAcionista = new Acionista();
		$oAcionista->idAcionista = $reg['acionista_idAcionista'];

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
		$oAcionista->oEmpresa = $oEmpresa;
		$oAcionista->nome = $reg['acionista_nome'];
		$oAcionista->cpfCnpj = $reg['acionista_cpfCnpj'];
		$oAcionista->cnpj_padrao = $reg['acionista_cnpj_padrao'];
		$oAcionista->tipoPessoa = $reg['acionista_tipoPessoa'];
		$oAcionista->email = $reg['acionista_email'];
		$oAcionista->estrangeiro = $reg['acionista_estrangeiro'];
		$oAcionista->passaporte = $reg['acionista_passaporte'];
		$oAcionista->funcao = $reg['acionista_funcao'];
		$oAcionista->dataHoraAlteracao = $reg['acionista_dataHoraAlteracao'];
		$oAcionista->usuarioAlteracao = $reg['acionista_usuarioAlteracao'];
		return $oAcionista;		   
	}
}
