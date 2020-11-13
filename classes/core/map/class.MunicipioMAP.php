<?php
class MunicipioMAP {

	static function getMetaData() {
		return ['municipio' => ['idMunicipio', 
'regiao', 
'uf', 
'municipio', 
'microregiao', 
'tipologia', 
'status']];
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

	static function objToRs($oMunicipio){
		$reg['idMunicipio'] = $oMunicipio->idMunicipio;
		$reg['regiao'] = $oMunicipio->regiao;
		$reg['uf'] = $oMunicipio->uf;
		$reg['municipio'] = $oMunicipio->municipio;
		$reg['microregiao'] = $oMunicipio->microregiao;
		$reg['tipologia'] = $oMunicipio->tipologia;
		$reg['status'] = $oMunicipio->status;
		return $reg;		   
	}

	static function objToRsInsert($oMunicipio){
		$reg['regiao'] = $oMunicipio->regiao;
		$reg['uf'] = $oMunicipio->uf;
		$reg['municipio'] = $oMunicipio->municipio;
		$reg['microregiao'] = $oMunicipio->microregiao;
		$reg['tipologia'] = $oMunicipio->tipologia;
		$reg['status'] = $oMunicipio->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oMunicipio = new Municipio();
		$oMunicipio->idMunicipio = $reg['municipio_idMunicipio'];
		$oMunicipio->regiao = $reg['municipio_regiao'];
		$oMunicipio->uf = $reg['municipio_uf'];
		$oMunicipio->municipio = $reg['municipio_municipio'];
		$oMunicipio->microregiao = $reg['municipio_microregiao'];
		$oMunicipio->tipologia = $reg['municipio_tipologia'];
		$oMunicipio->status = $reg['municipio_status'];
		return $oMunicipio;		   
	}
}
