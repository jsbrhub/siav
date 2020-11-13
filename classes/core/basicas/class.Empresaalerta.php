<?php
class Empresaalerta {
	
	public $idEmpresaAlerta;
	public $oAlerta;
	public $oCampanha;
	public $cnpj;
	public $corpo;

	function __construct($idEmpresaAlerta = NULL, Alerta $oAlerta = NULL, Campanha $oCampanha = NULL, $cnpj = NULL, $corpo = NULL){
		$this->idEmpresaAlerta = $idEmpresaAlerta;
		$this->oAlerta = $oAlerta;
		$this->oCampanha = $oCampanha;
		$this->cnpj = $cnpj;
		$this->corpo = $corpo;
	}
}