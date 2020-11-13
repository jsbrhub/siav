<?php
class CadastrofinanceiroMAP {

	static function getMetaData() {
		return ['cadastrofinanceiro' => ['idCadastroFinanceiro', 
'idEmpresa', 
'ehEstimado', 
'faturamentoBruto', 
'imobilizadoTotal', 
'reservaExercicio', 
'irDescontada', 
'valorIcms', 
'valorIssqn', 
'empregosDiretos', 
'despesaTerceiro', 
'terceirizadosExistentes', 
'pessoasEncargos', 
'impostosTaxasContribuicoes', 
'remuneracaoCapitalTerceiros', 
'remuneracaoCapitalProprio', 
'investimentoCapitalFixo', 
'faturamentoProdIncentivados', 
'reservaInvestimento', 
'valorIRtotal', 
'capitalGiro', 
'capitalFixo', 
'maoObraDireta', 
'maoObraIndiretaFixa', 
'maoObraReal', 
'recursosProprios', 
'previsaoIsencao', 
'acionistas', 
'totalReinvestimento', 
'valorDescontoIR', 
'reservaIncentivo', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'empresa' => ['idEmpresa', 
'idMunicipio', 
'idSituacao', 
'idIncentivo', 
'idModalidade', 
'cnpj', 
'cnpjMatriz', 
'anoBase', 
'anoAprovacao', 
'razaoSocial', 
'telefone', 
'fax', 
'email', 
'fonteOrigem', 
'latitude', 
'longitude', 
'endereco', 
'complemento', 
'bairro', 
'cep', 
'setor', 
'enq', 
'numSudam', 
'procurador', 
'laudoData', 
'laudoNumero', 
'anoCalendario', 
'resolucaoData', 
'resolucaoNumero', 
'declaracaoData', 
'declaracaoNumero', 
'situacaoCadastro', 
'projetoSocial', 
'politicaAmbiental', 
'vigente', 
'anoVigencia', 
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

	static function objToRs($oCadastrofinanceiro){
		$reg['idCadastroFinanceiro'] = $oCadastrofinanceiro->idCadastroFinanceiro;
		$oEmpresa = $oCadastrofinanceiro->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['ehEstimado'] = $oCadastrofinanceiro->ehEstimado;
		$reg['faturamentoBruto'] = $oCadastrofinanceiro->faturamentoBruto;
		$reg['imobilizadoTotal'] = $oCadastrofinanceiro->imobilizadoTotal;
		$reg['reservaExercicio'] = $oCadastrofinanceiro->reservaExercicio;
		$reg['irDescontada'] = $oCadastrofinanceiro->irDescontada;
		$reg['valorIcms'] = $oCadastrofinanceiro->valorIcms;
		$reg['valorIssqn'] = $oCadastrofinanceiro->valorIssqn;
		$reg['empregosDiretos'] = $oCadastrofinanceiro->empregosDiretos;
		$reg['despesaTerceiro'] = $oCadastrofinanceiro->despesaTerceiro;
		$reg['terceirizadosExistentes'] = $oCadastrofinanceiro->terceirizadosExistentes;
		$reg['pessoasEncargos'] = $oCadastrofinanceiro->pessoasEncargos;
		$reg['impostosTaxasContribuicoes'] = $oCadastrofinanceiro->impostosTaxasContribuicoes;
		$reg['remuneracaoCapitalTerceiros'] = $oCadastrofinanceiro->remuneracaoCapitalTerceiros;
		$reg['remuneracaoCapitalProprio'] = $oCadastrofinanceiro->remuneracaoCapitalProprio;
		$reg['investimentoCapitalFixo'] = $oCadastrofinanceiro->investimentoCapitalFixo;
		$reg['faturamentoProdIncentivados'] = $oCadastrofinanceiro->faturamentoProdIncentivados;
		$reg['reservaInvestimento'] = $oCadastrofinanceiro->reservaInvestimento;
		$reg['valorIRtotal'] = $oCadastrofinanceiro->valorIRtotal;
		$reg['capitalGiro'] = $oCadastrofinanceiro->capitalGiro;
		$reg['capitalFixo'] = $oCadastrofinanceiro->capitalFixo;
		$reg['maoObraDireta'] = $oCadastrofinanceiro->maoObraDireta;
		$reg['maoObraIndiretaFixa'] = $oCadastrofinanceiro->maoObraIndiretaFixa;
		$reg['maoObraReal'] = $oCadastrofinanceiro->maoObraReal;
		$reg['recursosProprios'] = $oCadastrofinanceiro->recursosProprios;
		$reg['previsaoIsencao'] = $oCadastrofinanceiro->previsaoIsencao;
		$reg['acionistas'] = $oCadastrofinanceiro->acionistas;
		$reg['totalReinvestimento'] = $oCadastrofinanceiro->totalReinvestimento;
		$reg['valorDescontoIR'] = $oCadastrofinanceiro->valorDescontoIR;
		$reg['reservaIncentivo'] = $oCadastrofinanceiro->reservaIncentivo;
		$reg['dataHoraAlteracao'] = $oCadastrofinanceiro->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oCadastrofinanceiro->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oCadastrofinanceiro){
		$oEmpresa = $oCadastrofinanceiro->oEmpresa;
		$reg['idEmpresa'] = $oEmpresa->idEmpresa;
		$reg['ehEstimado'] = $oCadastrofinanceiro->ehEstimado;
		$reg['faturamentoBruto'] = $oCadastrofinanceiro->faturamentoBruto;
		$reg['imobilizadoTotal'] = $oCadastrofinanceiro->imobilizadoTotal;
		$reg['reservaExercicio'] = $oCadastrofinanceiro->reservaExercicio;
		$reg['irDescontada'] = $oCadastrofinanceiro->irDescontada;
		$reg['valorIcms'] = $oCadastrofinanceiro->valorIcms;
		$reg['valorIssqn'] = $oCadastrofinanceiro->valorIssqn;
		$reg['empregosDiretos'] = $oCadastrofinanceiro->empregosDiretos;
		$reg['despesaTerceiro'] = $oCadastrofinanceiro->despesaTerceiro;
		$reg['terceirizadosExistentes'] = $oCadastrofinanceiro->terceirizadosExistentes;
		$reg['pessoasEncargos'] = $oCadastrofinanceiro->pessoasEncargos;
		$reg['impostosTaxasContribuicoes'] = $oCadastrofinanceiro->impostosTaxasContribuicoes;
		$reg['remuneracaoCapitalTerceiros'] = $oCadastrofinanceiro->remuneracaoCapitalTerceiros;
		$reg['remuneracaoCapitalProprio'] = $oCadastrofinanceiro->remuneracaoCapitalProprio;
		$reg['investimentoCapitalFixo'] = $oCadastrofinanceiro->investimentoCapitalFixo;
		$reg['faturamentoProdIncentivados'] = $oCadastrofinanceiro->faturamentoProdIncentivados;
		$reg['reservaInvestimento'] = $oCadastrofinanceiro->reservaInvestimento;
		$reg['valorIRtotal'] = $oCadastrofinanceiro->valorIRtotal;
		$reg['capitalGiro'] = $oCadastrofinanceiro->capitalGiro;
		$reg['capitalFixo'] = $oCadastrofinanceiro->capitalFixo;
		$reg['maoObraDireta'] = $oCadastrofinanceiro->maoObraDireta;
		$reg['maoObraIndiretaFixa'] = $oCadastrofinanceiro->maoObraIndiretaFixa;
		$reg['maoObraReal'] = $oCadastrofinanceiro->maoObraReal;
		$reg['recursosProprios'] = $oCadastrofinanceiro->recursosProprios;
		$reg['previsaoIsencao'] = $oCadastrofinanceiro->previsaoIsencao;
		$reg['acionistas'] = $oCadastrofinanceiro->acionistas;
		$reg['totalReinvestimento'] = $oCadastrofinanceiro->totalReinvestimento;
		$reg['valorDescontoIR'] = $oCadastrofinanceiro->valorDescontoIR;
		$reg['reservaIncentivo'] = $oCadastrofinanceiro->reservaIncentivo;
		$reg['dataHoraAlteracao'] = $oCadastrofinanceiro->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oCadastrofinanceiro->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCadastrofinanceiro = new Cadastrofinanceiro();
		$oCadastrofinanceiro->idCadastroFinanceiro = $reg['cadastrofinanceiro_idCadastroFinanceiro'];

		$oEmpresa = new Empresa();
		$oEmpresa->idEmpresa = $reg['empresa_idEmpresa'];
		$oEmpresa->cnpj = $reg['empresa_cnpj'];
		$oEmpresa->cnpjMatriz = $reg['empresa_cnpjMatriz'];
		$oEmpresa->anoBase = $reg['empresa_anoBase'];
		$oEmpresa->anoAprovacao = $reg['empresa_anoAprovacao'];
		$oEmpresa->razaoSocial = $reg['empresa_razaoSocial'];
		$oEmpresa->telefone = $reg['empresa_telefone'];
		$oEmpresa->fax = $reg['empresa_fax'];
		$oEmpresa->email = $reg['empresa_email'];
		$oEmpresa->fonteOrigem = $reg['empresa_fonteOrigem'];
		$oEmpresa->latitude = $reg['empresa_latitude'];
		$oEmpresa->longitude = $reg['empresa_longitude'];
		$oEmpresa->endereco = $reg['empresa_endereco'];
		$oEmpresa->complemento = $reg['empresa_complemento'];
		$oEmpresa->bairro = $reg['empresa_bairro'];
		$oEmpresa->cep = $reg['empresa_cep'];
		$oEmpresa->setor = $reg['empresa_setor'];
		$oEmpresa->enq = $reg['empresa_enq'];
		$oEmpresa->numSudam = $reg['empresa_numSudam'];
		$oEmpresa->procurador = $reg['empresa_procurador'];
		$oEmpresa->laudoData = $reg['empresa_laudoData'];
		$oEmpresa->laudoNumero = $reg['empresa_laudoNumero'];
		$oEmpresa->anoCalendario = $reg['empresa_anoCalendario'];
		$oEmpresa->resolucaoData = $reg['empresa_resolucaoData'];
		$oEmpresa->resolucaoNumero = $reg['empresa_resolucaoNumero'];
		$oEmpresa->declaracaoData = $reg['empresa_declaracaoData'];
		$oEmpresa->declaracaoNumero = $reg['empresa_declaracaoNumero'];
		$oEmpresa->situacaoCadastro = $reg['empresa_situacaoCadastro'];
		$oEmpresa->projetoSocial = $reg['empresa_projetoSocial'];
		$oEmpresa->politicaAmbiental = $reg['empresa_politicaAmbiental'];
		$oEmpresa->vigente = $reg['empresa_vigente'];
		$oEmpresa->anoVigencia = $reg['empresa_anoVigencia'];
		$oEmpresa->dataHoraAlteracao = $reg['empresa_dataHoraAlteracao'];
		$oEmpresa->usuarioAlteracao = $reg['empresa_usuarioAlteracao'];
		$oCadastrofinanceiro->oEmpresa = $oEmpresa;
		$oCadastrofinanceiro->ehEstimado = $reg['cadastrofinanceiro_ehEstimado'];
		$oCadastrofinanceiro->faturamentoBruto = $reg['cadastrofinanceiro_faturamentoBruto'];
		$oCadastrofinanceiro->imobilizadoTotal = $reg['cadastrofinanceiro_imobilizadoTotal'];
		$oCadastrofinanceiro->reservaExercicio = $reg['cadastrofinanceiro_reservaExercicio'];
		$oCadastrofinanceiro->irDescontada = $reg['cadastrofinanceiro_irDescontada'];
		$oCadastrofinanceiro->valorIcms = $reg['cadastrofinanceiro_valorIcms'];
		$oCadastrofinanceiro->valorIssqn = $reg['cadastrofinanceiro_valorIssqn'];
		$oCadastrofinanceiro->empregosDiretos = $reg['cadastrofinanceiro_empregosDiretos'];
		$oCadastrofinanceiro->despesaTerceiro = $reg['cadastrofinanceiro_despesaTerceiro'];
		$oCadastrofinanceiro->terceirizadosExistentes = $reg['cadastrofinanceiro_terceirizadosExistentes'];
		$oCadastrofinanceiro->pessoasEncargos = $reg['cadastrofinanceiro_pessoasEncargos'];
		$oCadastrofinanceiro->impostosTaxasContribuicoes = $reg['cadastrofinanceiro_impostosTaxasContribuicoes'];
		$oCadastrofinanceiro->remuneracaoCapitalTerceiros = $reg['cadastrofinanceiro_remuneracaoCapitalTerceiros'];
		$oCadastrofinanceiro->remuneracaoCapitalProprio = $reg['cadastrofinanceiro_remuneracaoCapitalProprio'];
		$oCadastrofinanceiro->investimentoCapitalFixo = $reg['cadastrofinanceiro_investimentoCapitalFixo'];
		$oCadastrofinanceiro->faturamentoProdIncentivados = $reg['cadastrofinanceiro_faturamentoProdIncentivados'];
		$oCadastrofinanceiro->reservaInvestimento = $reg['cadastrofinanceiro_reservaInvestimento'];
		$oCadastrofinanceiro->valorIRtotal = $reg['cadastrofinanceiro_valorIRtotal'];
		$oCadastrofinanceiro->capitalGiro = $reg['cadastrofinanceiro_capitalGiro'];
		$oCadastrofinanceiro->capitalFixo = $reg['cadastrofinanceiro_capitalFixo'];
		$oCadastrofinanceiro->maoObraDireta = $reg['cadastrofinanceiro_maoObraDireta'];
		$oCadastrofinanceiro->maoObraIndiretaFixa = $reg['cadastrofinanceiro_maoObraIndiretaFixa'];
		$oCadastrofinanceiro->maoObraReal = $reg['cadastrofinanceiro_maoObraReal'];
		$oCadastrofinanceiro->recursosProprios = $reg['cadastrofinanceiro_recursosProprios'];
		$oCadastrofinanceiro->previsaoIsencao = $reg['cadastrofinanceiro_previsaoIsencao'];
		$oCadastrofinanceiro->acionistas = $reg['cadastrofinanceiro_acionistas'];
		$oCadastrofinanceiro->totalReinvestimento = $reg['cadastrofinanceiro_totalReinvestimento'];
		$oCadastrofinanceiro->valorDescontoIR = $reg['cadastrofinanceiro_valorDescontoIR'];
		$oCadastrofinanceiro->reservaIncentivo = $reg['cadastrofinanceiro_reservaIncentivo'];
		$oCadastrofinanceiro->dataHoraAlteracao = $reg['cadastrofinanceiro_dataHoraAlteracao'];
		$oCadastrofinanceiro->usuarioAlteracao = $reg['cadastrofinanceiro_usuarioAlteracao'];
		return $oCadastrofinanceiro;		   
	}
}
