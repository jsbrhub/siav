<?php
class Mercadoconsumidor {
	
	public $idMercado;
	public $oIncentivoempresa;
	public $quantidadeRegional;
	public $valorRegional;
	public $quantidadeNacional;
	public $valorNacional;
	public $quantidadeExterior;
	public $valorExterior;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idMercado = NULL, Incentivoempresa $oIncentivoempresa = NULL, $quantidadeRegional = NULL, $valorRegional = NULL, $quantidadeNacional = NULL, $valorNacional = NULL, $quantidadeExterior = NULL, $valorExterior = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idMercado = $idMercado;
		$this->oIncentivoempresa = $oIncentivoempresa;
		$this->quantidadeRegional = $quantidadeRegional;
		$this->valorRegional = $valorRegional;
		$this->quantidadeNacional = $quantidadeNacional;
		$this->valorNacional = $valorNacional;
		$this->quantidadeExterior = $quantidadeExterior;
		$this->valorExterior = $valorExterior;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}