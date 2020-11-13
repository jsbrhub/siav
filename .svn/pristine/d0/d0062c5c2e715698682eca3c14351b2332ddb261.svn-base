<?php
class IncentivosMAP {

	static function getMetaData() {
		return ['incentivos' => ['idIncentivo', 
'incentivo']];
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

	static function objToRs($oIncentivos){
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$reg['incentivo'] = $oIncentivos->incentivo;
		return $reg;		   
	}

	static function objToRsInsert($oIncentivos){
		$reg['incentivo'] = $oIncentivos->incentivo;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oIncentivos = new Incentivos();
		$oIncentivos->idIncentivo = $reg['incentivos_idIncentivo'];
		$oIncentivos->incentivo = $reg['incentivos_incentivo'];
		return $oIncentivos;		   
	}
}
