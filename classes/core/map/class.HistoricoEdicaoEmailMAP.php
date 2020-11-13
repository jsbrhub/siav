<?php
class HistoricoEdicaoEmailMAP {

	static function getMetaData() {
		return ['historico_edicao_email' => ['idHistoricoEdicaoEmail', 
'email_antigo', 
'email_novo', 
'usuario', 
'dt_alteracao', 
'cnpj']];
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

	static function objToRs($oHistoricoEdicaoEmail){
		$reg['idHistoricoEdicaoEmail'] = $oHistoricoEdicaoEmail->idHistoricoEdicaoEmail;
		$reg['email_antigo'] = $oHistoricoEdicaoEmail->email_antigo;
		$reg['email_novo'] = $oHistoricoEdicaoEmail->email_novo;
		$reg['usuario'] = $oHistoricoEdicaoEmail->usuario;
		$reg['dt_alteracao'] = $oHistoricoEdicaoEmail->dt_alteracao;
		$reg['cnpj'] = $oHistoricoEdicaoEmail->cnpj;
		return $reg;		   
	}

	static function objToRsInsert($oHistoricoEdicaoEmail){
		$reg['email_antigo'] = $oHistoricoEdicaoEmail->email_antigo;
		$reg['email_novo'] = $oHistoricoEdicaoEmail->email_novo;
		$reg['usuario'] = $oHistoricoEdicaoEmail->usuario;
		$reg['dt_alteracao'] = $oHistoricoEdicaoEmail->dt_alteracao;
		$reg['cnpj'] = $oHistoricoEdicaoEmail->cnpj;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oHistoricoEdicaoEmail = new HistoricoEdicaoEmail();
		$oHistoricoEdicaoEmail->idHistoricoEdicaoEmail = $reg['historico_edicao_email_idHistoricoEdicaoEmail'];
		$oHistoricoEdicaoEmail->email_antigo = $reg['historico_edicao_email_email_antigo'];
		$oHistoricoEdicaoEmail->email_novo = $reg['historico_edicao_email_email_novo'];
		$oHistoricoEdicaoEmail->usuario = $reg['historico_edicao_email_usuario'];
		$oHistoricoEdicaoEmail->dt_alteracao = $reg['historico_edicao_email_dt_alteracao'];
		$oHistoricoEdicaoEmail->cnpj = $reg['historico_edicao_email_cnpj'];
		return $oHistoricoEdicaoEmail;		   
	}
}
