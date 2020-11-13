<?php
class Campanha {
	
	public $idCampanha;
	public $campanha;
	public $anoBase;
	public $dataInicio;
	public $dataFim;
	public $totalEmpresas;
	public $situacao;
	public $usuarioAlteracao;
	public $dataHoraAlteracao;
	
	function __construct($idCampanha = NULL, $campanha = NULL, $anoBase = NULL, $dataInicio = NULL, $dataFim = NULL, $totalEmpresas = NULL, $situacao = NULL, $usuarioAlteracao = NULL, $dataHoraAlteracao = NULL){
		$this->idCampanha = $idCampanha;
		$this->campanha = $campanha;
		$this->anoBase = $anoBase;
		$this->dataInicio = $dataInicio;
		$this->dataFim = $dataFim;
		$this->totalEmpresas = $totalEmpresas;
		$this->situacao = $situacao;
		$this->usuarioAlteracao = $usuarioAlteracao;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
	}
}