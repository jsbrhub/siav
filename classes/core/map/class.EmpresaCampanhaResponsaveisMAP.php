<?php
class EmpresaCampanhaResponsaveisMAP {

	static function getMetaData() {
		return ['empresa_campanha_responsaveis' => ['idEmpresaCampanhaResponsaveis', 
'idCampanha', 
'idEmpresaCampanha', 
'idResponsaveis', 
'situacao'], 
'campanha' => ['idCampanha', 
'campanha', 
'anoBase', 
'dataInicio', 
'dataFim', 
'totalEmpresas', 
'situacao', 
'usuarioAlteracao', 
'dataHoraAlteracao'], 
'empresacampanha' => ['idEmpresaCampanha', 
'idCampanha', 
'cnpj', 
'status'], 
'responsaveis' => ['idResponsaveis', 
'nome', 
'estrangeiro', 
'cpf_passaporte', 
'rg', 
'orgao_expedidor', 
'cidade', 
'estado', 
'cep', 
'endereco', 
'email', 
'cargo', 
'conselho_regional', 
'login', 
'senha', 
'arquivo', 
'situacao', 
'data_cad_externo', 
'data_cad_empresa']];
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

	static function objToRs($oEmpresaCampanhaResponsaveis){
		$reg['idEmpresaCampanhaResponsaveis'] = $oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis;
		$oCampanha = $oEmpresaCampanhaResponsaveis->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$oEmpresacampanha = $oEmpresaCampanhaResponsaveis->oEmpresacampanha;
		$reg['idEmpresaCampanha'] = $oEmpresacampanha->idEmpresaCampanha;
		$oResponsaveis = $oEmpresaCampanhaResponsaveis->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$reg['situacao'] = $oEmpresaCampanhaResponsaveis->situacao;
		return $reg;		   
	}

	static function objToRsInsert($oEmpresaCampanhaResponsaveis){
		$oCampanha = $oEmpresaCampanhaResponsaveis->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$oEmpresacampanha = $oEmpresaCampanhaResponsaveis->oEmpresacampanha;
		$reg['idEmpresaCampanha'] = $oEmpresacampanha->idEmpresaCampanha;
		$oResponsaveis = $oEmpresaCampanhaResponsaveis->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$reg['situacao'] = $oEmpresaCampanhaResponsaveis->situacao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEmpresaCampanhaResponsaveis = new EmpresaCampanhaResponsaveis();
		$oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis = $reg['empresa_campanha_responsaveis_idEmpresaCampanhaResponsaveis'];

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
		$oEmpresaCampanhaResponsaveis->oCampanha = $oCampanha;

		$oEmpresacampanha = new Empresacampanha();
		$oEmpresacampanha->idEmpresaCampanha = $reg['empresacampanha_idEmpresaCampanha'];
		$oEmpresacampanha->cnpj = $reg['empresacampanha_cnpj'];
		$oEmpresacampanha->status = $reg['empresacampanha_status'];
		$oEmpresaCampanhaResponsaveis->oEmpresacampanha = $oEmpresacampanha;

		$oResponsaveis = new Responsaveis();
		$oResponsaveis->idResponsaveis = $reg['responsaveis_idResponsaveis'];
		$oResponsaveis->nome = $reg['responsaveis_nome'];
		$oResponsaveis->estrangeiro = $reg['responsaveis_estrangeiro'];
		$oResponsaveis->cpf_passaporte = $reg['responsaveis_cpf_passaporte'];
		$oResponsaveis->rg = $reg['responsaveis_rg'];
		$oResponsaveis->orgao_expedidor = $reg['responsaveis_orgao_expedidor'];
		$oResponsaveis->cidade = $reg['responsaveis_cidade'];
		$oResponsaveis->estado = $reg['responsaveis_estado'];
		$oResponsaveis->cep = $reg['responsaveis_cep'];
		$oResponsaveis->endereco = $reg['responsaveis_endereco'];
		$oResponsaveis->email = $reg['responsaveis_email'];
		$oResponsaveis->cargo = $reg['responsaveis_cargo'];
		$oResponsaveis->conselho_regional = $reg['responsaveis_conselho_regional'];
		$oResponsaveis->login = $reg['responsaveis_login'];
		$oResponsaveis->senha = $reg['responsaveis_senha'];
		$oResponsaveis->arquivo = $reg['responsaveis_arquivo'];
		$oResponsaveis->situacao = $reg['responsaveis_situacao'];
		$oResponsaveis->data_cad_externo = $reg['responsaveis_data_cad_externo'];
		$oResponsaveis->data_cad_empresa = $reg['responsaveis_data_cad_empresa'];
		$oEmpresaCampanhaResponsaveis->oResponsaveis = $oResponsaveis;
		$oEmpresaCampanhaResponsaveis->situacao = $reg['empresa_campanha_responsaveis_situacao'];
		return $oEmpresaCampanhaResponsaveis;		   
	}
}
