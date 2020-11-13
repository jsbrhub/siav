<?php
class DetalhearquivoMAP {

	static function getMetaData() {
		return ['detalhearquivo' => ['idDetalheArquivo', 
'idArquivo', 
'descricao', 
'linha'], 
'arquivo' => ['idArquivo', 
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

	static function objToRs($oDetalhearquivo){
		$reg['idDetalheArquivo'] = $oDetalhearquivo->idDetalheArquivo;
		$oArquivo = $oDetalhearquivo->oArquivo;
		$reg['idArquivo'] = $oArquivo->idArquivo;
		$reg['descricao'] = $oDetalhearquivo->descricao;
		$reg['linha'] = $oDetalhearquivo->linha;
		return $reg;		   
	}

	static function objToRsInsert($oDetalhearquivo){
		$oArquivo = $oDetalhearquivo->oArquivo;
		$reg['idArquivo'] = $oArquivo->idArquivo;
		$reg['descricao'] = $oDetalhearquivo->descricao;
		$reg['linha'] = $oDetalhearquivo->linha;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oDetalhearquivo = new Detalhearquivo();
		$oDetalhearquivo->idDetalheArquivo = $reg['detalhearquivo_idDetalheArquivo'];

		$oArquivo = new Arquivo();
		$oArquivo->idArquivo = $reg['arquivo_idArquivo'];
		$oArquivo->nomeArquivo = $reg['arquivo_nomeArquivo'];
		$oArquivo->novoNome = $reg['arquivo_novoNome'];
		$oArquivo->dataImportacao = $reg['arquivo_dataImportacao'];
		$oArquivo->situacao = $reg['arquivo_situacao'];
		$oArquivo->status = $reg['arquivo_status'];
		$oArquivo->dataHoraAlteracao = $reg['arquivo_dataHoraAlteracao'];
		$oArquivo->usuarioAlteracao = $reg['arquivo_usuarioAlteracao'];
		$oDetalhearquivo->oArquivo = $oArquivo;
		$oDetalhearquivo->descricao = $reg['detalhearquivo_descricao'];
		$oDetalhearquivo->linha = $reg['detalhearquivo_linha'];
		return $oDetalhearquivo;		   
	}
}
