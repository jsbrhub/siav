<?php
class Retificacaoempresa {
	
	public $idRetEmpresa;
	public $oEmpresa;
	public $cnpj;
	public $anoBase;
	public $motivo;
	public $justificativa;
	public $status;
	public $dataSolicitacao;
	public $usuarioSolicitacao;
	
	function __construct($idRetEmpresa = NULL, Empresa $oEmpresa = NULL, $cnpj = NULL, $anoBase = NULL, $motivo = NULL, $justificativa = NULL, $status = NULL, $dataSolicitacao = NULL, $usuarioSolicitacao = NULL){
		$this->idRetEmpresa = $idRetEmpresa;
		$this->oEmpresa = $oEmpresa;
		$this->cnpj = $cnpj;
		$this->anoBase = $anoBase;
		$this->motivo = $motivo;
		$this->justificativa = $justificativa;
		$this->status = $status;
		$this->dataSolicitacao = $dataSolicitacao;
		$this->usuarioSolicitacao = $usuarioSolicitacao;
	}
}