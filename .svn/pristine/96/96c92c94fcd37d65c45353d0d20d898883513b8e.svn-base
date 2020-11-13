<?php
class CampanhaMAP {

	static function getMetaData() {
		return ['campanha' => ['idCampanha', 
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

	static function objToRs($oCampanha){
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['campanha'] = $oCampanha->campanha;
		$reg['anoBase'] = $oCampanha->anoBase;
		$reg['dataInicio'] = $oCampanha->dataInicio;
		$reg['dataFim'] = $oCampanha->dataFim;
		$reg['totalEmpresas'] = $oCampanha->totalEmpresas;
		$reg['situacao'] = $oCampanha->situacao;
		$reg['usuarioAlteracao'] = $oCampanha->usuarioAlteracao;
		$reg['dataHoraAlteracao'] = $oCampanha->dataHoraAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oCampanha){
		$reg['campanha'] = $oCampanha->campanha;
		$reg['anoBase'] = $oCampanha->anoBase;
		$reg['dataInicio'] = $oCampanha->dataInicio;
		$reg['dataFim'] = $oCampanha->dataFim;
		$reg['totalEmpresas'] = $oCampanha->totalEmpresas;
		$reg['situacao'] = $oCampanha->situacao;
		$reg['usuarioAlteracao'] = $oCampanha->usuarioAlteracao;
		$reg['dataHoraAlteracao'] = $oCampanha->dataHoraAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
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
		return $oCampanha;		   
	}
}
