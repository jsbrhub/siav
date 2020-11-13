<?php
class Cadastrofinanceiro {
	
	public $idCadastroFinanceiro;
	public $oEmpresa;
	public $ehEstimado;
	public $faturamentoBruto;
	public $imobilizadoTotal;
	public $reservaExercicio;
	public $irDescontada;
	public $valorIcms;
	public $valorIssqn;
	public $empregosDiretos;
	public $despesaTerceiro;
	public $terceirizadosExistentes;
	public $pessoasEncargos;
	public $impostosTaxasContribuicoes;
	public $remuneracaoCapitalTerceiros;
	public $remuneracaoCapitalProprio;
	public $investimentoCapitalFixo;
	public $faturamentoProdIncentivados;
	public $reservaInvestimento;
	public $valorIRtotal;
	public $capitalGiro;
	public $capitalFixo;
	public $maoObraDireta;
	public $maoObraIndiretaFixa;
	public $maoObraReal;
	public $recursosProprios;
	public $previsaoIsencao;
	public $acionistas;
	public $totalReinvestimento;
	public $valorDescontoIR;
	public $reservaIncentivo;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idCadastroFinanceiro = NULL, Empresa $oEmpresa = NULL, $ehEstimado = NULL, $faturamentoBruto = NULL, $imobilizadoTotal = NULL, $reservaExercicio = NULL, $irDescontada = NULL, $valorIcms = NULL, $valorIssqn = NULL, $empregosDiretos = NULL, $despesaTerceiro = NULL, $terceirizadosExistentes = NULL, $pessoasEncargos = NULL, $impostosTaxasContribuicoes = NULL, $remuneracaoCapitalTerceiros = NULL, $remuneracaoCapitalProprio = NULL, $investimentoCapitalFixo = NULL, $faturamentoProdIncentivados = NULL, $reservaInvestimento = NULL, $valorIRtotal = NULL, $capitalGiro = NULL, $capitalFixo = NULL, $maoObraDireta = NULL, $maoObraIndiretaFixa = NULL, $maoObraReal = NULL, $recursosProprios = NULL, $previsaoIsencao = NULL, $acionistas = NULL, $totalReinvestimento = NULL, $valorDescontoIR = NULL, $reservaIncentivo = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idCadastroFinanceiro = $idCadastroFinanceiro;
		$this->oEmpresa = $oEmpresa;
		$this->ehEstimado = $ehEstimado;
		$this->faturamentoBruto = $faturamentoBruto;
		$this->imobilizadoTotal = $imobilizadoTotal;
		$this->reservaExercicio = $reservaExercicio;
		$this->irDescontada = $irDescontada;
		$this->valorIcms = $valorIcms;
		$this->valorIssqn = $valorIssqn;
		$this->empregosDiretos = $empregosDiretos;
		$this->despesaTerceiro = $despesaTerceiro;
		$this->terceirizadosExistentes = $terceirizadosExistentes;
		$this->pessoasEncargos = $pessoasEncargos;
		$this->impostosTaxasContribuicoes = $impostosTaxasContribuicoes;
		$this->remuneracaoCapitalTerceiros = $remuneracaoCapitalTerceiros;
		$this->remuneracaoCapitalProprio = $remuneracaoCapitalProprio;
		$this->investimentoCapitalFixo = $investimentoCapitalFixo;
		$this->faturamentoProdIncentivados = $faturamentoProdIncentivados;
		$this->reservaInvestimento = $reservaInvestimento;
		$this->valorIRtotal = $valorIRtotal;
		$this->capitalGiro = $capitalGiro;
		$this->capitalFixo = $capitalFixo;
		$this->maoObraDireta = $maoObraDireta;
		$this->maoObraIndiretaFixa = $maoObraIndiretaFixa;
		$this->maoObraReal = $maoObraReal;
		$this->recursosProprios = $recursosProprios;
		$this->previsaoIsencao = $previsaoIsencao;
		$this->acionistas = $acionistas;
		$this->totalReinvestimento = $totalReinvestimento;
		$this->valorDescontoIR = $valorDescontoIR;
		$this->reservaIncentivo = $reservaIncentivo;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}