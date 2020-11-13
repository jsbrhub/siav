<?php
class Empresacampanha {
	
	public $idEmpresaCampanha;
	public $oCampanha;
	public $cnpj;
	public $status;
	
	function __construct($idEmpresaCampanha = NULL, Campanha $oCampanha = NULL, $cnpj = NULL, $status = NULL){
		$this->idEmpresaCampanha = $idEmpresaCampanha;
		$this->oCampanha = $oCampanha;
		$this->cnpj = $cnpj;
		$this->status = $status;
	}
}