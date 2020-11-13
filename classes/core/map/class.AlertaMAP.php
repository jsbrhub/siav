<?php
class AlertaMAP {

	static function getMetaData() {
		return ['alerta' => ['idAlerta', 
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

	static function objToRs($oAlerta){
		$reg['idAlerta'] = $oAlerta->idAlerta;
		$oCampanha = $oAlerta->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['assunto'] = $oAlerta->assunto;
		$reg['texto'] = $oAlerta->texto;
		$reg['tipoSelecao'] = $oAlerta->tipoSelecao;
		$reg['totalEmpresas'] = $oAlerta->totalEmpresas;
		$reg['situacao'] = $oAlerta->situacao;
		$reg['usuarioAlteracao'] = $oAlerta->usuarioAlteracao;
		$reg['dataHoraAlteracao'] = $oAlerta->dataHoraAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oAlerta){
		$oCampanha = $oAlerta->oCampanha;
		$reg['idCampanha'] = $oCampanha->idCampanha;
		$reg['assunto'] = $oAlerta->assunto;
		$reg['texto'] = $oAlerta->texto;
		$reg['tipoSelecao'] = $oAlerta->tipoSelecao;
		$reg['totalEmpresas'] = $oAlerta->totalEmpresas;
		$reg['situacao'] = $oAlerta->situacao;
		$reg['usuarioAlteracao'] = $oAlerta->usuarioAlteracao;
		$reg['dataHoraAlteracao'] = $oAlerta->dataHoraAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAlerta = new Alerta();
		$oAlerta->idAlerta = $reg['alerta_idAlerta'];

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
		$oAlerta->oCampanha = $oCampanha;
		$oAlerta->assunto = $reg['alerta_assunto'];
		$oAlerta->texto = $reg['alerta_texto'];
		$oAlerta->tipoSelecao = $reg['alerta_tipoSelecao'];
		$oAlerta->totalEmpresas = $reg['alerta_totalEmpresas'];
		$oAlerta->situacao = $reg['alerta_situacao'];
		$oAlerta->usuarioAlteracao = $reg['alerta_usuarioAlteracao'];
		$oAlerta->dataHoraAlteracao = $reg['alerta_dataHoraAlteracao'];
		return $oAlerta;		   
	}
}
