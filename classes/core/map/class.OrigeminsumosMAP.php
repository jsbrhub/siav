<?php
class OrigeminsumosMAP {

	static function getMetaData() {
		return ['origeminsumos' => ['idOrigemInsumos', 
'idEmpresa', 
'idInsumo', 
'quantidadeRegional', 
'quantidadeNacional', 
'quantidadeExterior'], 
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
'insumos' => ['idInsumo', 
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

	static function objToRs($oOrigeminsumos){
		$reg['idOrigemInsumos'] = $oOrigeminsumos->idOrigemInsumos;
		$oEmpresa = $oOrigeminsumos->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oInsumos = $oOrigeminsumos->oInsumos;
		$reg['idInsumo'] = $oInsumos->idInsumo;
		$reg['quantidadeRegional'] = $oOrigeminsumos->quantidadeRegional;
		$reg['quantidadeNacional'] = $oOrigeminsumos->quantidadeNacional;
		$reg['quantidadeExterior'] = $oOrigeminsumos->quantidadeExterior;
		return $reg;		   
	}

	static function objToRsInsert($oOrigeminsumos){
		$oEmpresa = $oOrigeminsumos->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$oInsumos = $oOrigeminsumos->oInsumos;
		$reg['idInsumo'] = $oInsumos->idInsumo;
		$reg['quantidadeRegional'] = $oOrigeminsumos->quantidadeRegional;
		$reg['quantidadeNacional'] = $oOrigeminsumos->quantidadeNacional;
		$reg['quantidadeExterior'] = $oOrigeminsumos->quantidadeExterior;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oOrigeminsumos = new Origeminsumos();
		$oOrigeminsumos->idOrigemInsumos = $reg['origeminsumos_idOrigemInsumos'];

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
		$oOrigeminsumos->oEmpresa = $oEmpresa;

		$oInsumos = new Insumos();
		$oInsumos->idInsumo = $reg['insumos_idInsumo'];
		$oInsumos->descricao = $reg['insumos_descricao'];
		$oOrigeminsumos->oInsumos = $oInsumos;
		$oOrigeminsumos->quantidadeRegional = $reg['origeminsumos_quantidadeRegional'];
		$oOrigeminsumos->quantidadeNacional = $reg['origeminsumos_quantidadeNacional'];
		$oOrigeminsumos->quantidadeExterior = $reg['origeminsumos_quantidadeExterior'];
		return $oOrigeminsumos;		   
	}
}
