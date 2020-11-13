<?php
class ArquivoMAP {

	static function getMetaData() {
		return ['arquivo' => ['idArquivo', 
'nomeArquivo', 
'novoNome', 
'dataImportacao', 
'situacao', 
'status', 
'dataHoraAlteracao', 
'usuarioAlteracao']];
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

	static function objToRs($oArquivo){
		$reg['idArquivo'] = $oArquivo->idArquivo;
		$reg['nomeArquivo'] = $oArquivo->nomeArquivo;
		$reg['novoNome'] = $oArquivo->novoNome;
		$reg['dataImportacao'] = $oArquivo->dataImportacao;
		$reg['situacao'] = $oArquivo->situacao;
		$reg['status'] = $oArquivo->status;
		$reg['dataHoraAlteracao'] = $oArquivo->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivo->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivo){
		$reg['nomeArquivo'] = $oArquivo->nomeArquivo;
		$reg['novoNome'] = $oArquivo->novoNome;
		$reg['dataImportacao'] = $oArquivo->dataImportacao;
		$reg['situacao'] = $oArquivo->situacao;
		$reg['status'] = $oArquivo->status;
		$reg['dataHoraAlteracao'] = $oArquivo->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivo->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivo = new Arquivo();
		$oArquivo->idArquivo = $reg['arquivo_idArquivo'];
		$oArquivo->nomeArquivo = $reg['arquivo_nomeArquivo'];
		$oArquivo->novoNome = $reg['arquivo_novoNome'];
		$oArquivo->dataImportacao = $reg['arquivo_dataImportacao'];
		$oArquivo->situacao = $reg['arquivo_situacao'];
		$oArquivo->status = $reg['arquivo_status'];
		$oArquivo->dataHoraAlteracao = $reg['arquivo_dataHoraAlteracao'];
		$oArquivo->usuarioAlteracao = $reg['arquivo_usuarioAlteracao'];
		return $oArquivo;		   
	}
}
