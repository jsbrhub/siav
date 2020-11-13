<?php
class ModalidadeMAP {

	static function getMetaData() {
		return ['modalidade' => ['idModalidade', 
'idIncentivo', 
'descricao'], 
'incentivos' => ['idIncentivo', 
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

	static function objToRs($oModalidade){
		$reg['idModalidade'] = $oModalidade->idModalidade;
		$oIncentivos = $oModalidade->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$reg['descricao'] = $oModalidade->descricao;
		return $reg;		   
	}

	static function objToRsInsert($oModalidade){
		$oIncentivos = $oModalidade->oIncentivos;
		$reg['idIncentivo'] = $oIncentivos->idIncentivo;
		$reg['descricao'] = $oModalidade->descricao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oModalidade = new Modalidade();
		$oModalidade->idModalidade = $reg['modalidade_idModalidade'];

		$oIncentivos = new Incentivos();
		$oIncentivos->idIncentivo = $reg['incentivos_idIncentivo'];
		$oIncentivos->incentivo = $reg['incentivos_incentivo'];
		$oModalidade->oIncentivos = $oIncentivos;
		$oModalidade->descricao = $reg['modalidade_descricao'];
		return $oModalidade;		   
	}
}
