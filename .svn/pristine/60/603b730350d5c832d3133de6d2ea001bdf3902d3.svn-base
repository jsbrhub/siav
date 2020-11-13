<?php
class TipoarquivoMAP {

	static function getMetaData() {
		return ['tipoarquivo' => ['idTipoArquivo', 
'tipo', 
'formato']];
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

	static function objToRs($oTipoarquivo){
		$reg['idTipoArquivo'] = $oTipoarquivo->idTipoArquivo;
		$reg['tipo'] = $oTipoarquivo->tipo;
		$reg['formato'] = $oTipoarquivo->formato;
		return $reg;		   
	}

	static function objToRsInsert($oTipoarquivo){
		$reg['tipo'] = $oTipoarquivo->tipo;
		$reg['formato'] = $oTipoarquivo->formato;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTipoarquivo = new Tipoarquivo();
		$oTipoarquivo->idTipoArquivo = $reg['tipoarquivo_idTipoArquivo'];
		$oTipoarquivo->tipo = $reg['tipoarquivo_tipo'];
		$oTipoarquivo->formato = $reg['tipoarquivo_formato'];
		return $oTipoarquivo;		   
	}
}
