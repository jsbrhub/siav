<?php
class IncentivoempresaMAP {

	static function getMetaData() {
		return ['incentivoempresa' => ['idIncentivoEmpresa', 
'idEmpresa', 
'idIncentivo', 
'idModalidade', 
'produtoIncentivado', 
'fonteOrigem', 
'cnpj', 
'cnae', 
'faturamento', 
'emprego', 
'producao', 
'idUnidadeProducao', 
'capacidadeInstalada', 
'unidadeDescricao', 
'idUnidadeCapacidade', 
'ano', 
'vigente', 
'anoInicial', 
'anoFinal',
'observacao',
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
'usuarioAlteracao'], 
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

	static function objToRs($oIncentivoempresa){
		$reg['idIncentivoEmpresa'] = $oIncentivoempresa->idIncentivoEmpresa;
		$oEmpresa = $oIncentivoempresa->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oIncentivos = $oIncentivoempresa->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$oModalidade = $oIncentivoempresa->oModalidade;
		$reg['idModalidade'] = $oModalidade->idModalidade;
		$reg['produtoIncentivado'] = $oIncentivoempresa->produtoIncentivado;
		$reg['fonteOrigem'] = $oIncentivoempresa->fonteOrigem;
		$reg['cnpj'] = $oIncentivoempresa->cnpj;
		$reg['cnae'] = $oIncentivoempresa->cnae;
		$reg['faturamento'] = $oIncentivoempresa->faturamento;
		$reg['emprego'] = $oIncentivoempresa->emprego;
		$reg['producao'] = $oIncentivoempresa->producao;
		$reg['idUnidadeProducao'] = $oIncentivoempresa->idUnidadeProducao;
		$reg['capacidadeInstalada'] = $oIncentivoempresa->capacidadeInstalada;
		$reg['unidadeDescricao'] = $oIncentivoempresa->unidadeDescricao;
		$reg['idUnidadeCapacidade'] = $oIncentivoempresa->idUnidadeCapacidade;
		$reg['ano'] = $oIncentivoempresa->ano;
		$reg['vigente'] = $oIncentivoempresa->vigente;
		$reg['anoInicial'] = $oIncentivoempresa->anoInicial;
		$reg['anoFinal'] = $oIncentivoempresa->anoFinal;
		$reg['observacao'] = $oIncentivoempresa->observacao;
		$reg['dataHoraAlteracao'] = $oIncentivoempresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oIncentivoempresa->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oIncentivoempresa){
		$oEmpresa = $oIncentivoempresa->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oIncentivos = $oIncentivoempresa->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$oModalidade = $oIncentivoempresa->oModalidade;
		$reg['idModalidade'] = $oModalidade->idModalidade;
		$reg['produtoIncentivado'] = $oIncentivoempresa->produtoIncentivado;
		$reg['fonteOrigem'] = $oIncentivoempresa->fonteOrigem;
		$reg['cnpj'] = $oIncentivoempresa->cnpj;
		$reg['cnae'] = $oIncentivoempresa->cnae;
		$reg['faturamento'] = $oIncentivoempresa->faturamento;
		$reg['emprego'] = $oIncentivoempresa->emprego;
		$reg['producao'] = $oIncentivoempresa->producao;
		$reg['idUnidadeProducao'] = $oIncentivoempresa->idUnidadeProducao;
		$reg['capacidadeInstalada'] = $oIncentivoempresa->capacidadeInstalada;
		$reg['unidadeDescricao'] = $oIncentivoempresa->unidadeDescricao;
		$reg['idUnidadeCapacidade'] = $oIncentivoempresa->idUnidadeCapacidade;
		$reg['ano'] = $oIncentivoempresa->ano;
		$reg['vigente'] = $oIncentivoempresa->vigente;
		$reg['anoInicial'] = $oIncentivoempresa->anoInicial;
		$reg['anoFinal'] = $oIncentivoempresa->anoFinal;
		$reg['observacao'] = $oIncentivoempresa->observacao;
		$reg['dataHoraAlteracao'] = $oIncentivoempresa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oIncentivoempresa->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oIncentivoempresa = new Incentivoempresa();
		$oIncentivoempresa->idIncentivoEmpresa = $reg['incentivoempresa_idIncentivoEmpresa'];

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
		$oIncentivoempresa->oEmpresa = $oEmpresa;

		$oIncentivos = new Incentivos();
		$oIncentivos->idIncentivo = $reg['incentivos_idIncentivo'];
		$oIncentivos->incentivo = $reg['incentivos_incentivo'];
		$oIncentivoempresa->oIncentivos = $oIncentivos;

		$oModalidade = new Modalidade();
		$oModalidade->idModalidade = $reg['modalidade_idModalidade'];
		$oModalidade->descricao = $reg['modalidade_descricao'];
		$oIncentivoempresa->oModalidade = $oModalidade;
		$oIncentivoempresa->produtoIncentivado = $reg['incentivoempresa_produtoIncentivado'];
		$oIncentivoempresa->fonteOrigem = $reg['incentivoempresa_fonteOrigem'];
		$oIncentivoempresa->cnpj = $reg['incentivoempresa_cnpj'];
		$oIncentivoempresa->cnae = $reg['incentivoempresa_cnae'];
		$oIncentivoempresa->faturamento = $reg['incentivoempresa_faturamento'];
		$oIncentivoempresa->emprego = $reg['incentivoempresa_emprego'];
		$oIncentivoempresa->producao = $reg['incentivoempresa_producao'];
		$oIncentivoempresa->idUnidadeProducao = $reg['incentivoempresa_idUnidadeProducao'];
		$oIncentivoempresa->capacidadeInstalada = $reg['incentivoempresa_capacidadeInstalada'];
		$oIncentivoempresa->unidadeDescricao = $reg['incentivoempresa_unidadeDescricao'];
		$oIncentivoempresa->idUnidadeCapacidade = $reg['incentivoempresa_idUnidadeCapacidade'];
		$oIncentivoempresa->ano = $reg['incentivoempresa_ano'];
		$oIncentivoempresa->vigente = $reg['incentivoempresa_vigente'];
		$oIncentivoempresa->anoInicial = $reg['incentivoempresa_anoInicial'];
		$oIncentivoempresa->anoFinal = $reg['incentivoempresa_anoFinal'];
		$oIncentivoempresa->observacao = $reg['incentivoempresa_observacao'];
		$oIncentivoempresa->dataHoraAlteracao = $reg['incentivoempresa_dataHoraAlteracao'];
		$oIncentivoempresa->usuarioAlteracao = $reg['incentivoempresa_usuarioAlteracao'];
		return $oIncentivoempresa;		   
	}
}
