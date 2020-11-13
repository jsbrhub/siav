<?php
class EmpresacontroleMAP {

	static function getMetaData() {
		return ['empresacontrole' => ['idEmpresaControle', 
'idCampanha', 
'idEmpresa', 
'cnpj', 
'status', 
'dataInsercao', 
'dataAlteracao', 
'dataConclusao'], 
'campanha' => ['idCampanha', 
'campanha', 
'anoBase', 
'dataInicio', 
'dataFim', 
'totalEmpresas', 
'situacao', 
'usuarioAlteracao', 
'dataHoraAlteracao'], 
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

	static function objToRs($oEmpresacontrole){
		$reg['idEmpresaControle'] = $oEmpresacontrole->idEmpresaControle;
		$oCampanha = $oEmpresacontrole->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$oEmpresa = $oEmpresacontrole->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['cnpj'] = $oEmpresacontrole->cnpj;
		$reg['status'] = $oEmpresacontrole->status;
		$reg['dataInsercao'] = $oEmpresacontrole->dataInsercao;
		$reg['dataAlteracao'] = $oEmpresacontrole->dataAlteracao;
		$reg['dataConclusao'] = $oEmpresacontrole->dataConclusao;
		return $reg;		   
	}

	static function objToRsInsert($oEmpresacontrole){
		$oCampanha = $oEmpresacontrole->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$oEmpresa = $oEmpresacontrole->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['cnpj'] = $oEmpresacontrole->cnpj;
		$reg['status'] = $oEmpresacontrole->status;
		$reg['dataInsercao'] = $oEmpresacontrole->dataInsercao;
		$reg['dataAlteracao'] = $oEmpresacontrole->dataAlteracao;
		$reg['dataConclusao'] = $oEmpresacontrole->dataConclusao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEmpresacontrole = new Empresacontrole();
		$oEmpresacontrole->idEmpresaControle = $reg['empresacontrole_idEmpresaControle'];

		$oCampanha = new Campanha();
		$oCampanha->idCampanha = $reg['campanha_idCampanha'];
		$oCampanha->campanha = $reg['campanha_campanha'];
		$oCampanha->anoBase = $reg['campanha_anoBase'];
		$oCampanha->dataInicio = $reg['campanha_dataInicio'];
		$oCampanha->dataFim = $reg['campanha_dataFim'];
		$oCampanha->totalEmpresas = $reg['campanha_totalEmpresas'];
		$oCampanha->situacao = $reg['campanha_situacao'];
		$oCampanha->usuarioAlteracao = $reg['campanha_usuarioAlteracao'];
		$oCampanha->dataHoraAlteracao = $reg['campanha_dataHoraAlteracao'];
		$oEmpresacontrole->oCampanha = $oCampanha;

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
		$oEmpresacontrole->oEmpresa = $oEmpresa;
		$oEmpresacontrole->cnpj = $reg['empresacontrole_cnpj'];
		$oEmpresacontrole->status = $reg['empresacontrole_status'];
		$oEmpresacontrole->dataInsercao = $reg['empresacontrole_dataInsercao'];
		$oEmpresacontrole->dataAlteracao = $reg['empresacontrole_dataAlteracao'];
		$oEmpresacontrole->dataConclusao = $reg['empresacontrole_dataConclusao'];
		return $oEmpresacontrole;		   
	}
}
