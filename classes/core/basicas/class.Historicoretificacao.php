<?php
class Historicoretificacao {
	
	public $idHistRet;
	public $oRetificacaoempresa;
	public $oRetificacaosudam;
	public $oEmpresa;
	public $idEmpresaRet;
	public $anoBase;
	public $cnpj;
	public $status;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idHistRet = NULL, Retificacaoempresa $oRetificacaoempresa = NULL, Retificacaosudam $oRetificacaosudam = NULL, Empresa $oEmpresa = NULL, $idEmpresaRet = NULL, $anoBase = NULL, $cnpj = NULL, $status = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idHistRet = $idHistRet;
		$this->oRetificacaoempresa = $oRetificacaoempresa;
		$this->oRetificacaosudam = $oRetificacaosudam;
		$this->oEmpresa = $oEmpresa;
		$this->idEmpresaRet = $idEmpresaRet;
		$this->anoBase = $anoBase;
		$this->cnpj = $cnpj;
		$this->status = $status;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}