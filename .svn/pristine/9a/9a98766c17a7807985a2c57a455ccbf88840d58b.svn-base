<?php
class UnidademedidaMAP {

	static function getMetaData() {
		return ['unidademedida' => ['idUnidade', 
'nome', 
'sigla']];
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

	static function objToRs($oUnidademedida){
		$reg['idUnidade'] = $oUnidademedida->idUnidade;
		$reg['nome'] = $oUnidademedida->nome;
		$reg['sigla'] = $oUnidademedida->sigla;
		return $reg;		   
	}

	static function objToRsInsert($oUnidademedida){
		$reg['nome'] = $oUnidademedida->nome;
		$reg['sigla'] = $oUnidademedida->sigla;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUnidademedida = new Unidademedida();
		$oUnidademedida->idUnidade = $reg['unidademedida_idUnidade'];
		$oUnidademedida->nome = $reg['unidademedida_nome'];
		$oUnidademedida->sigla = $reg['unidademedida_sigla'];
		return $oUnidademedida;		   
	}
}
