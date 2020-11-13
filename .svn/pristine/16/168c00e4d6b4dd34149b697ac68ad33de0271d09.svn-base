<?php
class EmpresacampanhaMAP {

	static function getMetaData() {
		return ['empresacampanha' => ['idEmpresaCampanha', 
'idCampanha', 
'cnpj', 
'status'], 
'campanha' => ['idCampanha', 
'campanha', 
'anoBase', 
'dataInicio', 
'dataFim', 
'totalEmpresas', 
'situacao', 
'usuarioAlteracao', 
'dataHoraAlteracao']];
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

	static function objToRs($oEmpresacampanha){
		$reg['idEmpresaCampanha'] = $oEmpresacampanha->idEmpresaCampanha;
		$oCampanha = $oEmpresacampanha->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['cnpj'] = $oEmpresacampanha->cnpj;
		$reg['status'] = $oEmpresacampanha->status;
		return $reg;		   
	}

	static function objToRsInsert($oEmpresacampanha){
		$oCampanha = $oEmpresacampanha->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['cnpj'] = $oEmpresacampanha->cnpj;
		$reg['status'] = $oEmpresacampanha->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEmpresacampanha = new Empresacampanha();
		$oEmpresacampanha->idEmpresaCampanha = $reg['empresacampanha_idEmpresaCampanha'];

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
		$oEmpresacampanha->oCampanha = $oCampanha;
		$oEmpresacampanha->cnpj = $reg['empresacampanha_cnpj'];
		$oEmpresacampanha->status = $reg['empresacampanha_status'];
		return $oEmpresacampanha;		   
	}
}
