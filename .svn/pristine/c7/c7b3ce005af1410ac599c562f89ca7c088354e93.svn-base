<?php
class ArquivopoliticaMAP {

	static function getMetaData() {
		return ['arquivopolitica' => ['idArquivoPol', 
'idPolitica', 
'nomeArquivo', 
'novoNome', 
'link', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'politicaambiental' => ['idPolitica', 
'idEmpresa', 
'residuosGerados', 
'descricaoTratamento', 
'quantGerado', 
'unidadeQg', 
'descricaoQg', 
'quantTratado', 
'unidadeQt', 
'descricaoQt', 
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

	static function objToRs($oArquivopolitica){
		$reg['idArquivoPol'] = $oArquivopolitica->idArquivoPol;
		$oPoliticaambiental = $oArquivopolitica->oPoliticaambiental;
		$reg['idPolitica'] = $oPoliticaambiental->idPolitica;
		$reg['nomeArquivo'] = $oArquivopolitica->nomeArquivo;
		$reg['novoNome'] = $oArquivopolitica->novoNome;
		$reg['link'] = $oArquivopolitica->link;
		$reg['dataHoraAlteracao'] = $oArquivopolitica->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivopolitica->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivopolitica){
		$oPoliticaambiental = $oArquivopolitica->oPoliticaambiental;
		$reg['idPolitica'] = $oPoliticaambiental->idPolitica;
		$reg['nomeArquivo'] = $oArquivopolitica->nomeArquivo;
		$reg['novoNome'] = $oArquivopolitica->novoNome;
		$reg['link'] = $oArquivopolitica->link;
		$reg['dataHoraAlteracao'] = $oArquivopolitica->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivopolitica->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivopolitica = new Arquivopolitica();
		$oArquivopolitica->idArquivoPol = $reg['arquivopolitica_idArquivoPol'];

		$oPoliticaambiental = new Politicaambiental();
		$oPoliticaambiental->idPolitica = $reg['politicaambiental_idPolitica'];
		$oPoliticaambiental->residuosGerados = $reg['politicaambiental_residuosGerados'];
		$oPoliticaambiental->descricaoTratamento = $reg['politicaambiental_descricaoTratamento'];
		$oPoliticaambiental->quantGerado = $reg['politicaambiental_quantGerado'];
		$oPoliticaambiental->unidadeQg = $reg['politicaambiental_unidadeQg'];
		$oPoliticaambiental->descricaoQg = $reg['politicaambiental_descricaoQg'];
		$oPoliticaambiental->quantTratado = $reg['politicaambiental_quantTratado'];
		$oPoliticaambiental->unidadeQt = $reg['politicaambiental_unidadeQt'];
		$oPoliticaambiental->descricaoQt = $reg['politicaambiental_descricaoQt'];
		$oPoliticaambiental->dataHoraAlteracao = $reg['politicaambiental_dataHoraAlteracao'];
		$oPoliticaambiental->usuarioAlteracao = $reg['politicaambiental_usuarioAlteracao'];
		$oArquivopolitica->oPoliticaambiental = $oPoliticaambiental;
		$oArquivopolitica->nomeArquivo = $reg['arquivopolitica_nomeArquivo'];
		$oArquivopolitica->novoNome = $reg['arquivopolitica_novoNome'];
		$oArquivopolitica->link = $reg['arquivopolitica_link'];
		$oArquivopolitica->dataHoraAlteracao = $reg['arquivopolitica_dataHoraAlteracao'];
		$oArquivopolitica->usuarioAlteracao = $reg['arquivopolitica_usuarioAlteracao'];
		return $oArquivopolitica;		   
	}
}
