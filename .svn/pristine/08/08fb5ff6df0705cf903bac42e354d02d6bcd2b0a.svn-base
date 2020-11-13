<?php
class IncentivosexcelMAP {

	static function getMetaData() {
		return ['incentivosexcel' => ['idincentivo', 
'sudam_numero', 
'empresa', 
'cnpj', 
'situacao', 
'municipio', 
'uf', 
'setor', 
'mob_di', 
'mob_in', 
'mob_real', 
'objetivo', 
'cap_instalada', 
'unidade', 
'incentivo', 
'modalidade', 
'procurador', 
'data_laudo', 
'numero_laudo', 
'capital_fixo', 
'capital_giro', 
'enq', 
'declaracao_data', 
'declaracao_numero', 
'resolucao_data', 
'resolucao_numero', 
'recursos_proprios', 
'sudam_irpj', 
'acionistas', 
'total']];
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

	static function objToRs($oIncentivosexcel){
		$reg['idincentivo'] = $oIncentivosexcel->idincentivo;
		$reg['sudam_numero'] = $oIncentivosexcel->sudam_numero;
		$reg['empresa'] = $oIncentivosexcel->empresa;
		$reg['cnpj'] = $oIncentivosexcel->cnpj;
		$reg['situacao'] = $oIncentivosexcel->situacao;
		$reg['municipio'] = $oIncentivosexcel->municipio;
		$reg['uf'] = $oIncentivosexcel->uf;
		$reg['setor'] = $oIncentivosexcel->setor;
		$reg['mob_di'] = $oIncentivosexcel->mob_di;
		$reg['mob_in'] = $oIncentivosexcel->mob_in;
		$reg['mob_real'] = $oIncentivosexcel->mob_real;
		$reg['objetivo'] = $oIncentivosexcel->objetivo;
		$reg['cap_instalada'] = $oIncentivosexcel->cap_instalada;
		$reg['unidade'] = $oIncentivosexcel->unidade;
		$reg['incentivo'] = $oIncentivosexcel->incentivo;
		$reg['modalidade'] = $oIncentivosexcel->modalidade;
		$reg['procurador'] = $oIncentivosexcel->procurador;
		$reg['data_laudo'] = $oIncentivosexcel->data_laudo;
		$reg['numero_laudo'] = $oIncentivosexcel->numero_laudo;
		$reg['capital_fixo'] = $oIncentivosexcel->capital_fixo;
		$reg['capital_giro'] = $oIncentivosexcel->capital_giro;
		$reg['enq'] = $oIncentivosexcel->enq;
		$reg['declaracao_data'] = $oIncentivosexcel->declaracao_data;
		$reg['declaracao_numero'] = $oIncentivosexcel->declaracao_numero;
		$reg['resolucao_data'] = $oIncentivosexcel->resolucao_data;
		$reg['resolucao_numero'] = $oIncentivosexcel->resolucao_numero;
		$reg['recursos_proprios'] = $oIncentivosexcel->recursos_proprios;
		$reg['sudam_irpj'] = $oIncentivosexcel->sudam_irpj;
		$reg['acionistas'] = $oIncentivosexcel->acionistas;
		$reg['total'] = $oIncentivosexcel->total;
		return $reg;		   
	}

	static function objToRsInsert($oIncentivosexcel){
		$reg['sudam_numero'] = $oIncentivosexcel->sudam_numero;
		$reg['empresa'] = $oIncentivosexcel->empresa;
		$reg['cnpj'] = $oIncentivosexcel->cnpj;
		$reg['situacao'] = $oIncentivosexcel->situacao;
		$reg['municipio'] = $oIncentivosexcel->municipio;
		$reg['uf'] = $oIncentivosexcel->uf;
		$reg['setor'] = $oIncentivosexcel->setor;
		$reg['mob_di'] = $oIncentivosexcel->mob_di;
		$reg['mob_in'] = $oIncentivosexcel->mob_in;
		$reg['mob_real'] = $oIncentivosexcel->mob_real;
		$reg['objetivo'] = $oIncentivosexcel->objetivo;
		$reg['cap_instalada'] = $oIncentivosexcel->cap_instalada;
		$reg['unidade'] = $oIncentivosexcel->unidade;
		$reg['incentivo'] = $oIncentivosexcel->incentivo;
		$reg['modalidade'] = $oIncentivosexcel->modalidade;
		$reg['procurador'] = $oIncentivosexcel->procurador;
		$reg['data_laudo'] = $oIncentivosexcel->data_laudo;
		$reg['numero_laudo'] = $oIncentivosexcel->numero_laudo;
		$reg['capital_fixo'] = $oIncentivosexcel->capital_fixo;
		$reg['capital_giro'] = $oIncentivosexcel->capital_giro;
		$reg['enq'] = $oIncentivosexcel->enq;
		$reg['declaracao_data'] = $oIncentivosexcel->declaracao_data;
		$reg['declaracao_numero'] = $oIncentivosexcel->declaracao_numero;
		$reg['resolucao_data'] = $oIncentivosexcel->resolucao_data;
		$reg['resolucao_numero'] = $oIncentivosexcel->resolucao_numero;
		$reg['recursos_proprios'] = $oIncentivosexcel->recursos_proprios;
		$reg['sudam_irpj'] = $oIncentivosexcel->sudam_irpj;
		$reg['acionistas'] = $oIncentivosexcel->acionistas;
		$reg['total'] = $oIncentivosexcel->total;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oIncentivosexcel = new Incentivosexcel();
		$oIncentivosexcel->idincentivo = $reg['incentivosexcel_idincentivo'];
		$oIncentivosexcel->sudam_numero = $reg['incentivosexcel_sudam_numero'];
		$oIncentivosexcel->empresa = $reg['incentivosexcel_empresa'];
		$oIncentivosexcel->cnpj = $reg['incentivosexcel_cnpj'];
		$oIncentivosexcel->situacao = $reg['incentivosexcel_situacao'];
		$oIncentivosexcel->municipio = $reg['incentivosexcel_municipio'];
		$oIncentivosexcel->uf = $reg['incentivosexcel_uf'];
		$oIncentivosexcel->setor = $reg['incentivosexcel_setor'];
		$oIncentivosexcel->mob_di = $reg['incentivosexcel_mob_di'];
		$oIncentivosexcel->mob_in = $reg['incentivosexcel_mob_in'];
		$oIncentivosexcel->mob_real = $reg['incentivosexcel_mob_real'];
		$oIncentivosexcel->objetivo = $reg['incentivosexcel_objetivo'];
		$oIncentivosexcel->cap_instalada = $reg['incentivosexcel_cap_instalada'];
		$oIncentivosexcel->unidade = $reg['incentivosexcel_unidade'];
		$oIncentivosexcel->incentivo = $reg['incentivosexcel_incentivo'];
		$oIncentivosexcel->modalidade = $reg['incentivosexcel_modalidade'];
		$oIncentivosexcel->procurador = $reg['incentivosexcel_procurador'];
		$oIncentivosexcel->data_laudo = $reg['incentivosexcel_data_laudo'];
		$oIncentivosexcel->numero_laudo = $reg['incentivosexcel_numero_laudo'];
		$oIncentivosexcel->capital_fixo = $reg['incentivosexcel_capital_fixo'];
		$oIncentivosexcel->capital_giro = $reg['incentivosexcel_capital_giro'];
		$oIncentivosexcel->enq = $reg['incentivosexcel_enq'];
		$oIncentivosexcel->declaracao_data = $reg['incentivosexcel_declaracao_data'];
		$oIncentivosexcel->declaracao_numero = $reg['incentivosexcel_declaracao_numero'];
		$oIncentivosexcel->resolucao_data = $reg['incentivosexcel_resolucao_data'];
		$oIncentivosexcel->resolucao_numero = $reg['incentivosexcel_resolucao_numero'];
		$oIncentivosexcel->recursos_proprios = $reg['incentivosexcel_recursos_proprios'];
		$oIncentivosexcel->sudam_irpj = $reg['incentivosexcel_sudam_irpj'];
		$oIncentivosexcel->acionistas = $reg['incentivosexcel_acionistas'];
		$oIncentivosexcel->total = $reg['incentivosexcel_total'];
		return $oIncentivosexcel;		   
	}
}
