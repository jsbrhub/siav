<?php
class Auxiliar {
	
	public $idAuxiliar;
	public $cnpj;
	public $empresa;
	public $emailEmpresa;
	public $municipio;
	public $tipologia;
	public $uf;
	public $setor;
	public $tipoIncentivo;
	public $motivoIncentivo;
	public $atividadeIncentivada;
	public $anoAprovacao;
	public $capitalFixo;
	public $capitalGiro;
	public $moDir;
	public $moInd;
	public $moReal;
	public $enq;
	
	function __construct($idAuxiliar = NULL, $cnpj = NULL, $empresa = NULL, $emailEmpresa = NULL, $municipio = NULL, $tipologia = NULL, $uf = NULL, $setor = NULL, $tipoIncentivo = NULL, $motivoIncentivo = NULL, $atividadeIncentivada = NULL, $anoAprovacao = NULL, $capitalFixo = NULL, $capitalGiro = NULL, $moDir = NULL, $moInd = NULL, $moReal = NULL, $enq = NULL){
		$this->idAuxiliar = $idAuxiliar;
		$this->cnpj = $cnpj;
		$this->empresa = $empresa;
		$this->emailEmpresa = $emailEmpresa;
		$this->municipio = $municipio;
		$this->tipologia = $tipologia;
		$this->uf = $uf;
		$this->setor = $setor;
		$this->tipoIncentivo = $tipoIncentivo;
		$this->motivoIncentivo = $motivoIncentivo;
		$this->atividadeIncentivada = $atividadeIncentivada;
		$this->anoAprovacao = $anoAprovacao;
		$this->capitalFixo = $capitalFixo;
		$this->capitalGiro = $capitalGiro;
		$this->moDir = $moDir;
		$this->moInd = $moInd;
		$this->moReal = $moReal;
		$this->enq = $enq;
	}
}