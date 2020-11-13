<?php
class AtodeclaratorioMAP {

	static function getMetaData() {
		return ['atodeclaratorio' => ['idAtoDeclaratorio', 
'idIncentivoEmpresa', 
'nomeArquivo', 
'novoNome', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'incentivoempresa' => ['idIncentivoEmpresa', 
'idEmpresa', 
'produtoIncentivado', 
'fonteOrigem', 
'cnpj', 
'cnae', 
'faturamento', 
'emprego', 
'producao', 
'idUnidadeProducao', 
'capacidadeInstalada', 
'unidadeDescricao', 
'idUnidadeCapacidade', 
'ano', 
'vigente', 
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

	static function objToRs($oAtodeclaratorio){
		$reg['idAtoDeclaratorio'] = $oAtodeclaratorio->idAtoDeclaratorio;
		$oIncentivoempresa = $oAtodeclaratorio->oIncentivoempresa;
		$reg['idIncentivoEmpresa'] = $oIncentivoempresa->idIncentivoEmpresa;
		$reg['nomeArquivo'] = $oAtodeclaratorio->nomeArquivo;
		$reg['novoNome'] = $oAtodeclaratorio->novoNome;
		$reg['dataHoraAlteracao'] = $oAtodeclaratorio->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oAtodeclaratorio->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oAtodeclaratorio){
		$oIncentivoempresa = $oAtodeclaratorio->oIncentivoempresa;
		$reg['idIncentivoEmpresa'] = $oIncentivoempresa->idIncentivoEmpresa;
		$reg['nomeArquivo'] = $oAtodeclaratorio->nomeArquivo;
		$reg['novoNome'] = $oAtodeclaratorio->novoNome;
		$reg['dataHoraAlteracao'] = $oAtodeclaratorio->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oAtodeclaratorio->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAtodeclaratorio = new Atodeclaratorio();
		$oAtodeclaratorio->idAtoDeclaratorio = $reg['atodeclaratorio_idAtoDeclaratorio'];

		$oIncentivoempresa = new Incentivoempresa();
		$oIncentivoempresa->idIncentivoEmpresa = $reg['incentivoempresa_idIncentivoEmpresa'];
		$oIncentivoempresa->produtoIncentivado = $reg['incentivoempresa_produtoIncentivado'];
		$oIncentivoempresa->fonteOrigem = $reg['incentivoempresa_fonteOrigem'];
		$oIncentivoempresa->cnpj = $reg['incentivoempresa_cnpj'];
		$oIncentivoempresa->cnae = $reg['incentivoempresa_cnae'];
		$oIncentivoempresa->faturamento = $reg['incentivoempresa_faturamento'];
		$oIncentivoempresa->emprego = $reg['incentivoempresa_emprego'];
		$oIncentivoempresa->producao = $reg['incentivoempresa_producao'];
		$oIncentivoempresa->idUnidadeProducao = $reg['incentivoempresa_idUnidadeProducao'];
		$oIncentivoempresa->capacidadeInstalada = $reg['incentivoempresa_capacidadeInstalada'];
		$oIncentivoempresa->unidadeDescricao = $reg['incentivoempresa_unidadeDescricao'];
		$oIncentivoempresa->idUnidadeCapacidade = $reg['incentivoempresa_idUnidadeCapacidade'];
		$oIncentivoempresa->ano = $reg['incentivoempresa_ano'];
		$oIncentivoempresa->vigente = $reg['incentivoempresa_vigente'];
		$oIncentivoempresa->dataHoraAlteracao = $reg['incentivoempresa_dataHoraAlteracao'];
		$oIncentivoempresa->usuarioAlteracao = $reg['incentivoempresa_usuarioAlteracao'];
		$oAtodeclaratorio->oIncentivoempresa = $oIncentivoempresa;
		$oAtodeclaratorio->nomeArquivo = $reg['atodeclaratorio_nomeArquivo'];
		$oAtodeclaratorio->novoNome = $reg['atodeclaratorio_novoNome'];
		$oAtodeclaratorio->dataHoraAlteracao = $reg['atodeclaratorio_dataHoraAlteracao'];
		$oAtodeclaratorio->usuarioAlteracao = $reg['atodeclaratorio_usuarioAlteracao'];
		return $oAtodeclaratorio;		   
	}
}
