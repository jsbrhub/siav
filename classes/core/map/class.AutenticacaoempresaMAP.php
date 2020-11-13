<?php
class AutenticacaoempresaMAP {

	static function getMetaData() {
		return ['autenticacaoempresa' => ['idAutenticacao', 
'cnpj', 
'senha', 
'email', 
'senhaProv']];
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

	static function objToRs($oAutenticacaoempresa){
		$reg['idAutenticacao'] = $oAutenticacaoempresa->idAutenticacao;
		$reg['cnpj'] = $oAutenticacaoempresa->cnpj;
		$reg['senha'] = $oAutenticacaoempresa->senha;
		$reg['email'] = $oAutenticacaoempresa->email;
		$reg['senhaProv'] = $oAutenticacaoempresa->senhaProv;
		return $reg;		   
	}

	static function objToRsInsert($oAutenticacaoempresa){
		$reg['cnpj'] = $oAutenticacaoempresa->cnpj;
		$reg['senha'] = $oAutenticacaoempresa->senha;
		$reg['email'] = $oAutenticacaoempresa->email;
		$reg['senhaProv'] = $oAutenticacaoempresa->senhaProv;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAutenticacaoempresa = new Autenticacaoempresa();
		$oAutenticacaoempresa->idAutenticacao = $reg['autenticacaoempresa_idAutenticacao'];
		$oAutenticacaoempresa->cnpj = $reg['autenticacaoempresa_cnpj'];
		$oAutenticacaoempresa->senha = $reg['autenticacaoempresa_senha'];
		$oAutenticacaoempresa->email = $reg['autenticacaoempresa_email'];
		$oAutenticacaoempresa->senhaProv = $reg['autenticacaoempresa_senhaProv'];
		return $oAutenticacaoempresa;		   
	}
}
