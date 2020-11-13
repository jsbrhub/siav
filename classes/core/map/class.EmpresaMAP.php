<?php
class EmpresaMAP {

	static function getMetaData() {
		return ['empresa' => ['idEmpresa', 
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
'municipio' => ['idMunicipio', 
'regiao', 
'uf', 
'municipio', 
'microregiao', 
'tipologia', 
'status'], 
'situacao' => ['idSituacao', 
'situacao'], 
'incentivos' => ['idIncentivo', 
'incentivo'], 
'modalidade' => ['idModalidade', 
'idIncentivo', 
'descricao']];
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

	static function objToRs($oEmpresa){
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oMunicipio = $oEmpresa->oMunicipio;
		$reg['idMunicipio'] = $oMunicipio->idMunicipio;
		$oSituacao = $oEmpresa->oSituacao;
		$reg['idSituacao'] = $oSituacao->idSituacao;
		$oIncentivos = $oEmpresa->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$oModalidade = $oEmpresa->oModalidade;
		$reg['idModalidade'] = $oModalidade->idModalidade;
		$reg['cnpj'] = $oEmpresa->cnpj;
		$reg['cnpjMatriz'] = $oEmpresa->cnpjMatriz;
		$reg['anoBase'] = $oEmpresa->anoBase;
		$reg['anoAprovacao'] = $oEmpresa->anoAprovacao;
		$reg['razaoSocial'] = $oEmpresa->razaoSocial;
		$reg['telefone'] = $oEmpresa->telefone;
		$reg['fax'] = $oEmpresa->fax;
		$reg['email'] = $oEmpresa->email;
		$reg['fonteOrigem'] = $oEmpresa->fonteOrigem;
		$reg['latitude'] = $oEmpresa->latitude;
		$reg['longitude'] = $oEmpresa->longitude;
		$reg['endereco'] = $oEmpresa->endereco;
		$reg['numero'] = $oEmpresa->numero;
		$reg['complemento'] = $oEmpresa->complemento;
		$reg['bairro'] = $oEmpresa->bairro;
		$reg['cep'] = $oEmpresa->cep;
		$reg['setor'] = $oEmpresa->setor;
		$reg['enq'] = $oEmpresa->enq;
		$reg['numSudam'] = $oEmpresa->numSudam;
		$reg['procurador'] = $oEmpresa->procurador;
		$reg['laudoData'] = $oEmpresa->laudoData;
		$reg['laudoNumero'] = $oEmpresa->laudoNumero;
		$reg['anoCalendario'] = $oEmpresa->anoCalendario;
		$reg['resolucaoData'] = $oEmpresa->resolucaoData;
		$reg['resolucaoNumero'] = $oEmpresa->resolucaoNumero;
		$reg['declaracaoData'] = $oEmpresa->declaracaoData;
		$reg['declaracaoNumero'] = $oEmpresa->declaracaoNumero;
		$reg['situacaoCadastro'] = $oEmpresa->situacaoCadastro;
		$reg['projetoSocial'] = $oEmpresa->projetoSocial;
		$reg['politicaAmbiental'] = $oEmpresa->politicaAmbiental;
		$reg['vigente'] = $oEmpresa->vigente;
		$reg['anoVigencia'] = $oEmpresa->anoVigencia;
		$reg['dataHoraAlteracao'] = $oEmpresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oEmpresa->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oEmpresa){
		$oMunicipio = $oEmpresa->oMunicipio;
		$reg['idMunicipio'] = $oMunicipio->idMunicipio;
		$oSituacao = $oEmpresa->oSituacao;
		$reg['idSituacao'] = $oSituacao->idSituacao;
		$oIncentivos = $oEmpresa->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$oModalidade = $oEmpresa->oModalidade;
		$reg['idModalidade'] = $oModalidade->idModalidade;
		$reg['cnpj'] = $oEmpresa->cnpj;
		$reg['cnpjMatriz'] = $oEmpresa->cnpjMatriz;
		$reg['anoBase'] = $oEmpresa->anoBase;
		$reg['anoAprovacao'] = $oEmpresa->anoAprovacao;
		$reg['razaoSocial'] = $oEmpresa->razaoSocial;
		$reg['telefone'] = $oEmpresa->telefone;
		$reg['fax'] = $oEmpresa->fax;
		$reg['email'] = $oEmpresa->email;
		$reg['fonteOrigem'] = $oEmpresa->fonteOrigem;
		$reg['latitude'] = $oEmpresa->latitude;
		$reg['longitude'] = $oEmpresa->longitude;
		$reg['endereco'] = $oEmpresa->endereco;
		$reg['numero'] = $oEmpresa->numero;
		$reg['complemento'] = $oEmpresa->complemento;
		$reg['bairro'] = $oEmpresa->bairro;
		$reg['cep'] = $oEmpresa->cep;
		$reg['setor'] = $oEmpresa->setor;
		$reg['enq'] = $oEmpresa->enq;
		$reg['numSudam'] = $oEmpresa->numSudam;
		$reg['procurador'] = $oEmpresa->procurador;
		$reg['laudoData'] = $oEmpresa->laudoData;
		$reg['laudoNumero'] = $oEmpresa->laudoNumero;
		$reg['anoCalendario'] = $oEmpresa->anoCalendario;
		$reg['resolucaoData'] = $oEmpresa->resolucaoData;
		$reg['resolucaoNumero'] = $oEmpresa->resolucaoNumero;
		$reg['declaracaoData'] = $oEmpresa->declaracaoData;
		$reg['declaracaoNumero'] = $oEmpresa->declaracaoNumero;
		$reg['situacaoCadastro'] = $oEmpresa->situacaoCadastro;
		$reg['projetoSocial'] = $oEmpresa->projetoSocial;
		$reg['politicaAmbiental'] = $oEmpresa->politicaAmbiental;
		$reg['vigente'] = $oEmpresa->vigente;
		$reg['anoVigencia'] = $oEmpresa->anoVigencia;
		$reg['dataHoraAlteracao'] = $oEmpresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oEmpresa->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEmpresa = new Empresa();
		$oEmpresa->idEmpresa = $reg['empresa_idEmpresa'];

		$oMunicipio = new Municipio();
		$oMunicipio->idMunicipio = $reg['municipio_idMunicipio'];
		$oMunicipio->regiao = $reg['municipio_regiao'];
		$oMunicipio->uf = $reg['municipio_uf'];
		$oMunicipio->municipio = $reg['municipio_municipio'];
		$oMunicipio->microregiao = $reg['municipio_microregiao'];
		$oMunicipio->tipologia = $reg['municipio_tipologia'];
		$oMunicipio->status = $reg['municipio_status'];
		$oEmpresa->oMunicipio = $oMunicipio;

		$oSituacao = new Situacao();
		$oSituacao->idSituacao = $reg['situacao_idSituacao'];
		$oSituacao->situacao = $reg['situacao_situacao'];
		$oEmpresa->oSituacao = $oSituacao;

		$oIncentivos = new Incentivos();
		$oIncentivos->idIncentivo = $reg['incentivos_idIncentivo'];
		$oIncentivos->incentivo = $reg['incentivos_incentivo'];
		$oEmpresa->oIncentivos = $oIncentivos;

		$oModalidade = new Modalidade();
		$oModalidade->idModalidade = $reg['modalidade_idModalidade'];
		$oModalidade->descricao = $reg['modalidade_descricao'];
		$oEmpresa->oModalidade = $oModalidade;
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
		return $oEmpresa;		   
	}
}
