<?php
class Alerta {
	
	public $idAlerta;
	public $oCampanha;
	public $assunto;
	public $texto;
	public $tipoSelecao;
	public $totalEmpresas;
	public $situacao;
	public $usuarioAlteracao;
	public $dataHoraAlteracao;
	
	function __construct($idAlerta = NULL, Campanha $oCampanha = NULL, $assunto = NULL, $texto = NULL, $tipoSelecao = NULL, $totalEmpresas = NULL, $situacao = NULL, $usuarioAlteracao = NULL, $dataHoraAlteracao = NULL){
		$this->idAlerta = $idAlerta;
		$this->oCampanha = $oCampanha;
		$this->assunto = $assunto;
		$this->texto = $texto;
		$this->tipoSelecao = $tipoSelecao;
		$this->totalEmpresas = $totalEmpresas;
		$this->situacao = $situacao;
		$this->usuarioAlteracao = $usuarioAlteracao;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
	}
}