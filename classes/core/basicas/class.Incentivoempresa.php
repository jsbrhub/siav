<?php
class Incentivoempresa {
	
	public $idIncentivoEmpresa;
	public $oEmpresa;
	public $oIncentivos;
	public $oModalidade;
	public $produtoIncentivado;
	public $fonteOrigem;
	public $cnpj;
	public $cnae;
	public $faturamento;
	public $emprego;
	public $producao;
	public $idUnidadeProducao;
	public $capacidadeInstalada;
	public $unidadeDescricao;
	public $idUnidadeCapacidade;
	public $ano;
	public $vigente;
	public $anoInicial;
	public $anoFinal;
	public $observacao;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idIncentivoEmpresa = NULL, Empresa $oEmpresa = NULL, Incentivos $oIncentivos = NULL, Modalidade $oModalidade = NULL, $produtoIncentivado = NULL, $fonteOrigem = NULL, $cnpj = NULL, $cnae = NULL, $faturamento = NULL, $emprego = NULL, $producao = NULL, $idUnidadeProducao = NULL, $capacidadeInstalada = NULL, $unidadeDescricao = NULL, $idUnidadeCapacidade = NULL, $ano = NULL, $vigente = NULL, $anoInicial = NULL, $anoFinal = NULL, $observacao = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idIncentivoEmpresa = $idIncentivoEmpresa;
		$this->oEmpresa = $oEmpresa;
		$this->oIncentivos = $oIncentivos;
		$this->oModalidade = $oModalidade;
		$this->produtoIncentivado = $produtoIncentivado;
		$this->fonteOrigem = $fonteOrigem;
		$this->cnpj = $cnpj;
		$this->cnae = $cnae;
		$this->faturamento = $faturamento;
		$this->emprego = $emprego;
		$this->producao = $producao;
		$this->idUnidadeProducao = $idUnidadeProducao;
		$this->capacidadeInstalada = $capacidadeInstalada;
		$this->unidadeDescricao = $unidadeDescricao;
		$this->idUnidadeCapacidade = $idUnidadeCapacidade;
		$this->ano = $ano;
		$this->vigente = $vigente;
		$this->anoInicial = $anoInicial;
		$this->anoFinal = $anoFinal;
		$this->observacao = $observacao;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}