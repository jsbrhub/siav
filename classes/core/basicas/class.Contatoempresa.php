<?php
class Contatoempresa {
	
	public $idContatoEmpresa;
	public $oEmpresa;
	public $contato;
	public $funcao;
	public $email;
	public $telefone;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idContatoEmpresa = NULL, Empresa $oEmpresa = NULL, $contato = NULL, $funcao = NULL, $email = NULL, $telefone = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idContatoEmpresa = $idContatoEmpresa;
		$this->oEmpresa = $oEmpresa;
		$this->contato = $contato;
		$this->funcao = $funcao;
		$this->email = $email;
		$this->telefone = $telefone;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}