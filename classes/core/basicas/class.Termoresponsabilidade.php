<?php
class Termoresponsabilidade {
	
	public $idTermo;
	public $oCampanha;
	public $oEmpresa;
	public $cnpj;
	public $comprovante;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idTermo = NULL, Campanha $oCampanha = NULL, Empresa $oEmpresa = NULL, $cnpj = NULL, $comprovante = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idTermo = $idTermo;
		$this->oCampanha = $oCampanha;
		$this->oEmpresa = $oEmpresa;
		$this->cnpj = $cnpj;
		$this->comprovante = $comprovante;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}