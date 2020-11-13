<?php
class PesquisadesenvolvimentoMAP {

	static function getMetaData() {
		return ['pesquisadesenvolvimento' => ['idPesquisa', 
'idEmpresa', 
'nomeProjeto', 
'descricaoAtividade', 
'totalDespesas', 
'quantidadePessoas', 
'observacoes', 
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

	static function objToRs($oPesquisadesenvolvimento){
		$reg['idPesquisa'] = $oPesquisadesenvolvimento->idPesquisa;
		$oEmpresa = $oPesquisadesenvolvimento->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['nomeProjeto'] = $oPesquisadesenvolvimento->nomeProjeto;
		$reg['descricaoAtividade'] = $oPesquisadesenvolvimento->descricaoAtividade;
		$reg['totalDespesas'] = $oPesquisadesenvolvimento->totalDespesas;
		$reg['quantidadePessoas'] = $oPesquisadesenvolvimento->quantidadePessoas;
		$reg['observacoes'] = $oPesquisadesenvolvimento->observacoes;
		$reg['dataHoraAlteracao'] = $oPesquisadesenvolvimento->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oPesquisadesenvolvimento->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oPesquisadesenvolvimento){
		$oEmpresa = $oPesquisadesenvolvimento->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['nomeProjeto'] = $oPesquisadesenvolvimento->nomeProjeto;
		$reg['descricaoAtividade'] = $oPesquisadesenvolvimento->descricaoAtividade;
		$reg['totalDespesas'] = $oPesquisadesenvolvimento->totalDespesas;
		$reg['quantidadePessoas'] = $oPesquisadesenvolvimento->quantidadePessoas;
		$reg['observacoes'] = $oPesquisadesenvolvimento->observacoes;
		$reg['dataHoraAlteracao'] = $oPesquisadesenvolvimento->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oPesquisadesenvolvimento->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPesquisadesenvolvimento = new Pesquisadesenvolvimento();
		$oPesquisadesenvolvimento->idPesquisa = $reg['pesquisadesenvolvimento_idPesquisa'];

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
		$oPesquisadesenvolvimento->oEmpresa = $oEmpresa;
		$oPesquisadesenvolvimento->nomeProjeto = $reg['pesquisadesenvolvimento_nomeProjeto'];
		$oPesquisadesenvolvimento->descricaoAtividade = $reg['pesquisadesenvolvimento_descricaoAtividade'];
		$oPesquisadesenvolvimento->totalDespesas = $reg['pesquisadesenvolvimento_totalDespesas'];
		$oPesquisadesenvolvimento->quantidadePessoas = $reg['pesquisadesenvolvimento_quantidadePessoas'];
		$oPesquisadesenvolvimento->observacoes = $reg['pesquisadesenvolvimento_observacoes'];
		$oPesquisadesenvolvimento->dataHoraAlteracao = $reg['pesquisadesenvolvimento_dataHoraAlteracao'];
		$oPesquisadesenvolvimento->usuarioAlteracao = $reg['pesquisadesenvolvimento_usuarioAlteracao'];
		return $oPesquisadesenvolvimento;		   
	}
}
