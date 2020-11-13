<?php
class MercadoconsumidorMAP {

	static function getMetaData() {
		return ['mercadoconsumidor' => ['idMercado', 
'idIncentivoEmpresa', 
'quantidadeRegional', 
'valorRegional', 
'quantidadeNacional', 
'valorNacional', 
'quantidadeExterior', 
'valorExterior', 
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

	static function objToRs($oMercadoconsumidor){
		$reg['idMercado'] = $oMercadoconsumidor->idMercado;
		$oIncentivoempresa = $oMercadoconsumidor->oIncentivoempresa;
		$reg['idIncentivoEmpresa'] = $oIncentivoempresa->idIncentivoEmpresa;
		$reg['quantidadeRegional'] = $oMercadoconsumidor->quantidadeRegional;
		$reg['valorRegional'] = $oMercadoconsumidor->valorRegional;
		$reg['quantidadeNacional'] = $oMercadoconsumidor->quantidadeNacional;
		$reg['valorNacional'] = $oMercadoconsumidor->valorNacional;
		$reg['quantidadeExterior'] = $oMercadoconsumidor->quantidadeExterior;
		$reg['valorExterior'] = $oMercadoconsumidor->valorExterior;
		$reg['dataHoraAlteracao'] = $oMercadoconsumidor->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oMercadoconsumidor->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oMercadoconsumidor){
		$oIncentivoempresa = $oMercadoconsumidor->oIncentivoempresa;
		$reg['idIncentivoEmpresa'] = $oIncentivoempresa->idIncentivoEmpresa;
		$reg['quantidadeRegional'] = $oMercadoconsumidor->quantidadeRegional;
		$reg['valorRegional'] = $oMercadoconsumidor->valorRegional;
		$reg['quantidadeNacional'] = $oMercadoconsumidor->quantidadeNacional;
		$reg['valorNacional'] = $oMercadoconsumidor->valorNacional;
		$reg['quantidadeExterior'] = $oMercadoconsumidor->quantidadeExterior;
		$reg['valorExterior'] = $oMercadoconsumidor->valorExterior;
		$reg['dataHoraAlteracao'] = $oMercadoconsumidor->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oMercadoconsumidor->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oMercadoconsumidor = new Mercadoconsumidor();
		$oMercadoconsumidor->idMercado = $reg['mercadoconsumidor_idMercado'];

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
		$oMercadoconsumidor->oIncentivoempresa = $oIncentivoempresa;
		$oMercadoconsumidor->quantidadeRegional = $reg['mercadoconsumidor_quantidadeRegional'];
		$oMercadoconsumidor->valorRegional = $reg['mercadoconsumidor_valorRegional'];
		$oMercadoconsumidor->quantidadeNacional = $reg['mercadoconsumidor_quantidadeNacional'];
		$oMercadoconsumidor->valorNacional = $reg['mercadoconsumidor_valorNacional'];
		$oMercadoconsumidor->quantidadeExterior = $reg['mercadoconsumidor_quantidadeExterior'];
		$oMercadoconsumidor->valorExterior = $reg['mercadoconsumidor_valorExterior'];
		$oMercadoconsumidor->dataHoraAlteracao = $reg['mercadoconsumidor_dataHoraAlteracao'];
		$oMercadoconsumidor->usuarioAlteracao = $reg['mercadoconsumidor_usuarioAlteracao'];
		return $oMercadoconsumidor;		   
	}
}
