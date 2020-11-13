<?php
class AuxiliarMAP {

	static function getMetaData() {
		return ['auxiliar' => ['idAuxiliar', 
'cnpj', 
'empresa', 
'emailEmpresa', 
'municipio', 
'tipologia', 
'uf', 
'setor', 
'tipoIncentivo', 
'motivoIncentivo', 
'atividadeIncentivada', 
'anoAprovacao', 
'capitalFixo', 
'capitalGiro', 
'moDir', 
'moInd', 
'moReal', 
'enq']];
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

	static function objToRs($oAuxiliar){
		$reg['idAuxiliar'] = $oAuxiliar->idAuxiliar;
		$reg['cnpj'] = $oAuxiliar->cnpj;
		$reg['empresa'] = $oAuxiliar->empresa;
		$reg['emailEmpresa'] = $oAuxiliar->emailEmpresa;
		$reg['municipio'] = $oAuxiliar->municipio;
		$reg['tipologia'] = $oAuxiliar->tipologia;
		$reg['uf'] = $oAuxiliar->uf;
		$reg['setor'] = $oAuxiliar->setor;
		$reg['tipoIncentivo'] = $oAuxiliar->tipoIncentivo;
		$reg['motivoIncentivo'] = $oAuxiliar->motivoIncentivo;
		$reg['atividadeIncentivada'] = $oAuxiliar->atividadeIncentivada;
		$reg['anoAprovacao'] = $oAuxiliar->anoAprovacao;
		$reg['capitalFixo'] = $oAuxiliar->capitalFixo;
		$reg['capitalGiro'] = $oAuxiliar->capitalGiro;
		$reg['moDir'] = $oAuxiliar->moDir;
		$reg['moInd'] = $oAuxiliar->moInd;
		$reg['moReal'] = $oAuxiliar->moReal;
		$reg['enq'] = $oAuxiliar->enq;
		return $reg;		   
	}

	static function objToRsInsert($oAuxiliar){
		$reg['cnpj'] = $oAuxiliar->cnpj;
		$reg['empresa'] = $oAuxiliar->empresa;
		$reg['emailEmpresa'] = $oAuxiliar->emailEmpresa;
		$reg['municipio'] = $oAuxiliar->municipio;
		$reg['tipologia'] = $oAuxiliar->tipologia;
		$reg['uf'] = $oAuxiliar->uf;
		$reg['setor'] = $oAuxiliar->setor;
		$reg['tipoIncentivo'] = $oAuxiliar->tipoIncentivo;
		$reg['motivoIncentivo'] = $oAuxiliar->motivoIncentivo;
		$reg['atividadeIncentivada'] = $oAuxiliar->atividadeIncentivada;
		$reg['anoAprovacao'] = $oAuxiliar->anoAprovacao;
		$reg['capitalFixo'] = $oAuxiliar->capitalFixo;
		$reg['capitalGiro'] = $oAuxiliar->capitalGiro;
		$reg['moDir'] = $oAuxiliar->moDir;
		$reg['moInd'] = $oAuxiliar->moInd;
		$reg['moReal'] = $oAuxiliar->moReal;
		$reg['enq'] = $oAuxiliar->enq;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAuxiliar = new Auxiliar();
		$oAuxiliar->idAuxiliar = $reg['auxiliar_idAuxiliar'];
		$oAuxiliar->cnpj = $reg['auxiliar_cnpj'];
		$oAuxiliar->empresa = $reg['auxiliar_empresa'];
		$oAuxiliar->emailEmpresa = $reg['auxiliar_emailEmpresa'];
		$oAuxiliar->municipio = $reg['auxiliar_municipio'];
		$oAuxiliar->tipologia = $reg['auxiliar_tipologia'];
		$oAuxiliar->uf = $reg['auxiliar_uf'];
		$oAuxiliar->setor = $reg['auxiliar_setor'];
		$oAuxiliar->tipoIncentivo = $reg['auxiliar_tipoIncentivo'];
		$oAuxiliar->motivoIncentivo = $reg['auxiliar_motivoIncentivo'];
		$oAuxiliar->atividadeIncentivada = $reg['auxiliar_atividadeIncentivada'];
		$oAuxiliar->anoAprovacao = $reg['auxiliar_anoAprovacao'];
		$oAuxiliar->capitalFixo = $reg['auxiliar_capitalFixo'];
		$oAuxiliar->capitalGiro = $reg['auxiliar_capitalGiro'];
		$oAuxiliar->moDir = $reg['auxiliar_moDir'];
		$oAuxiliar->moInd = $reg['auxiliar_moInd'];
		$oAuxiliar->moReal = $reg['auxiliar_moReal'];
		$oAuxiliar->enq = $reg['auxiliar_enq'];
		return $oAuxiliar;		   
	}
}
