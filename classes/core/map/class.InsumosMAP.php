<?php
class InsumosMAP {

	static function getMetaData() {
		return ['insumos' => ['idInsumo', 
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

	static function objToRs($oInsumos){
		$reg['idInsumo'] = $oInsumos->idInsumo;
		$reg['descricao'] = $oInsumos->descricao;
		return $reg;		   
	}

	static function objToRsInsert($oInsumos){
		$reg['descricao'] = $oInsumos->descricao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oInsumos = new Insumos();
		$oInsumos->idInsumo = $reg['insumos_idInsumo'];
		$oInsumos->descricao = $reg['insumos_descricao'];
		return $oInsumos;		   
	}
}
