<?php
class SituacaoMAP {

	static function getMetaData() {
		return ['situacao' => ['idSituacao', 
'situacao']];
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

	static function objToRs($oSituacao){
		$reg['idSituacao'] = $oSituacao->idSituacao;
		$reg['situacao'] = $oSituacao->situacao;
		return $reg;		   
	}

	static function objToRsInsert($oSituacao){
		$reg['situacao'] = $oSituacao->situacao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSituacao = new Situacao();
		$oSituacao->idSituacao = $reg['situacao_idSituacao'];
		$oSituacao->situacao = $reg['situacao_situacao'];
		return $oSituacao;		   
	}
}
