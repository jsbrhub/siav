<?php
class Empresaalerta {
	
	public $idEmpresaAlerta;
	public $oAlerta;
	public $oEmpresa;
	public $oCampanha;
	
	function __construct($idEmpresaAlerta = NULL, Alerta $oAlerta = NULL, Empresa $oEmpresa = NULL, Campanha $oCampanha = NULL){
		$this->idEmpresaAlerta = $idEmpresaAlerta;
		$this->oAlerta = $oAlerta;
		$this->oEmpresa = $oEmpresa;
		$this->oCampanha = $oCampanha;
	}
}