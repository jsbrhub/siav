<?php
class EmpresaalertaMAP {

	static function getMetaData() {
		return ['empresaalerta' => ['idEmpresaAlerta', 
'idAlerta', 
'idCampanha', 
'cnpj',
'corpo'],
'alerta' => ['idAlerta', 
'idCampanha', 
'assunto', 
'texto', 
'tipoSelecao', 
'totalEmpresas', 
'situacao', 
'usuarioAlteracao', 
'dataHoraAlteracao'], 
'campanha' => ['idCampanha', 
'campanha', 
'anoBase', 
'dataInicio', 
'dataFim', 
'totalEmpresas', 
'situacao', 
'usuarioAlteracao', 
'dataHoraAlteracao']];
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

	static function objToRs($oEmpresaalerta){
		$reg['idEmpresaAlerta'] = $oEmpresaalerta->idEmpresaAlerta;
		$oAlerta = $oEmpresaalerta->oAlerta;
		$reg['idAlerta'] = $oAlerta->idAlerta;
		$oCampanha = $oEmpresaalerta->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['cnpj'] = $oEmpresaalerta->cnpj;
		$reg['corpo'] = $oEmpresaalerta->corpo;
		return $reg;
	}

	static function objToRsInsert($oEmpresaalerta){
		$oAlerta = $oEmpresaalerta->oAlerta;
		$reg['idAlerta'] = $oAlerta->idAlerta;
		$oCampanha = $oEmpresaalerta->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['cnpj'] = $oEmpresaalerta->cnpj;
		$reg['corpo'] = $oEmpresaalerta->corpo;
		return $reg;
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEmpresaalerta = new Empresaalerta();
		$oEmpresaalerta->idEmpresaAlerta = $reg['empresaalerta_idEmpresaAlerta'];

		$oAlerta = new Alerta();
		$oAlerta->idAlerta = $reg['alerta_idAlerta'];
		$oAlerta->assunto = $reg['alerta_assunto'];
		$oAlerta->texto = $reg['alerta_texto'];
		$oAlerta->tipoSelecao = $reg['alerta_tipoSelecao'];
		$oAlerta->totalEmpresas = $reg['alerta_totalEmpresas'];
		$oAlerta->situacao = $reg['alerta_situacao'];
		$oAlerta->usuarioAlteracao = $reg['alerta_usuarioAlteracao'];
		$oEmpresaalerta->oAlerta = $oAlerta;

		$oCampanha = new Campanha();
		$oCampanha->idCampanha = $reg['campanha_idCampanha'];
		$oCampanha->campanha = $reg['campanha_campanha'];
		$oCampanha->anoBase = $reg['campanha_anoBase'];
		$oCampanha->dataInicio = $reg['campanha_dataInicio'];
		$oCampanha->dataFim = $reg['campanha_dataFim'];
		$oCampanha->totalEmpresas = $reg['campanha_totalEmpresas'];
		$oCampanha->situacao = $reg['campanha_situacao'];
		$oCampanha->usuarioAlteracao = $reg['campanha_usuarioAlteracao'];
		$oCampanha->dataHoraAlteracao = $reg['campanha_dataHoraAlteracao'];
		$oEmpresaalerta->oCampanha = $oCampanha;
		$oEmpresaalerta->cnpj = $reg['empresaalerta_cnpj'];
		$oEmpresaalerta->corpo = $reg['empresaalerta_corpo'];
		$oEmpresaalerta->dt_registro = $reg['empresaalerta_dt_registro'];
		return $oEmpresaalerta;
	}
}
