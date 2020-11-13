<?php
class RetificacaosudamMAP {

	static function getMetaData() {
		return ['retificacaosudam' => ['idRetSudam', 
'idRetEmpresa', 
'justificativa', 
'status', 
'dataAlteracao', 
'usuarioAlteracao'], 
'retificacaoempresa' => ['idRetEmpresa', 
'idEmpresa', 
'cnpj', 
'anoBase', 
'motivo', 
'justificativa', 
'status', 
'dataSolicitacao', 
'usuarioSolicitacao']];
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

	static function objToRs($oRetificacaosudam){
		$reg['idRetSudam'] = $oRetificacaosudam->idRetSudam;
		$oRetificacaoempresa = $oRetificacaosudam->oRetificacaoempresa;
		$reg['idRetEmpresa'] = $oRetificacaoempresa->idRetEmpresa;
		$reg['justificativa'] = $oRetificacaosudam->justificativa;
		$reg['status'] = $oRetificacaosudam->status;
		$reg['dataAlteracao'] = $oRetificacaosudam->dataAlteracao;
		$reg['usuarioAlteracao'] = $oRetificacaosudam->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oRetificacaosudam){
		$oRetificacaoempresa = $oRetificacaosudam->oRetificacaoempresa;
		$reg['idRetEmpresa'] = $oRetificacaoempresa->idRetEmpresa;
		$reg['justificativa'] = $oRetificacaosudam->justificativa;
		$reg['status'] = $oRetificacaosudam->status;
		$reg['dataAlteracao'] = $oRetificacaosudam->dataAlteracao;
		$reg['usuarioAlteracao'] = $oRetificacaosudam->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oRetificacaosudam = new Retificacaosudam();
		$oRetificacaosudam->idRetSudam = $reg['retificacaosudam_idRetSudam'];

		$oRetificacaoempresa = new Retificacaoempresa();
		$oRetificacaoempresa->idRetEmpresa = $reg['retificacaoempresa_idRetEmpresa'];
		$oRetificacaoempresa->cnpj = $reg['retificacaoempresa_cnpj'];
		$oRetificacaoempresa->anoBase = $reg['retificacaoempresa_anoBase'];
		$oRetificacaoempresa->motivo = $reg['retificacaoempresa_motivo'];
		$oRetificacaoempresa->justificativa = $reg['retificacaoempresa_justificativa'];
		$oRetificacaoempresa->status = $reg['retificacaoempresa_status'];
		$oRetificacaoempresa->dataSolicitacao = $reg['retificacaoempresa_dataSolicitacao'];
		$oRetificacaoempresa->usuarioSolicitacao = $reg['retificacaoempresa_usuarioSolicitacao'];
		$oRetificacaosudam->oRetificacaoempresa = $oRetificacaoempresa;
		$oRetificacaosudam->justificativa = $reg['retificacaosudam_justificativa'];
		$oRetificacaosudam->status = $reg['retificacaosudam_status'];
		$oRetificacaosudam->dataAlteracao = $reg['retificacaosudam_dataAlteracao'];
		$oRetificacaosudam->usuarioAlteracao = $reg['retificacaosudam_usuarioAlteracao'];
		return $oRetificacaosudam;		   
	}
}
