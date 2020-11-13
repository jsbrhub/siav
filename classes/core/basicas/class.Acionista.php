<?php
class Acionista {
	
	public $idAcionista;
	public $oEmpresa;
	public $nome;
	public $cpfCnpj;
	public $cnpj_padrao;
	public $tipoPessoa;
	public $email;
	public $estrangeiro;
	public $passaporte;
	public $funcao;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idAcionista = NULL, Empresa $oEmpresa = NULL, $nome = NULL, $cpfCnpj = NULL, $cnpj_padrao = NULL, $tipoPessoa = NULL, $email = NULL, $estrangeiro = NULL, $passaporte = NULL, $funcao = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idAcionista = $idAcionista;
		$this->oEmpresa = $oEmpresa;
		$this->nome = $nome;
		$this->cpfCnpj = $cpfCnpj;
		$this->cnpj_padrao = $cnpj_padrao;
		$this->tipoPessoa = $tipoPessoa;
		$this->email = $email;
		$this->estrangeiro = $estrangeiro;
		$this->passaporte = $passaporte;
		$this->funcao = $funcao;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}