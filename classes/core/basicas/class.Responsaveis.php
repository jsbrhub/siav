<?php
class Responsaveis {
	
	public $idResponsaveis;
	public $nome;
	public $estrangeiro;
	public $cpf_passaporte;
	public $rg;
	public $orgao_expedidor;
	public $cidade;
	public $estado;
	public $cep;
	public $endereco;
	public $email;
	public $cargo;
	public $conselho_regional;
	public $login;
	public $senha;
	public $arquivo;
	public $situacao;
	public $data_cad_externo;
	public $data_cad_empresa;
	
	function __construct($idResponsaveis = NULL, $nome = NULL, $estrangeiro = NULL, $cpf_passaporte = NULL, $rg = NULL, $orgao_expedidor = NULL, $cidade = NULL, $estado = NULL, $cep = NULL, $endereco = NULL, $email = NULL, $cargo = NULL, $conselho_regional = NULL, $login = NULL, $senha = NULL, $arquivo = NULL, $situacao = NULL, $data_cad_externo = NULL, $data_cad_empresa = NULL){
		$this->idResponsaveis = $idResponsaveis;
		$this->nome = $nome;
		$this->estrangeiro = $estrangeiro;
		$this->cpf_passaporte = $cpf_passaporte;
		$this->rg = $rg;
		$this->orgao_expedidor = $orgao_expedidor;
		$this->cidade = $cidade;
		$this->estado = $estado;
		$this->cep = $cep;
		$this->endereco = $endereco;
		$this->email = $email;
		$this->cargo = $cargo;
		$this->conselho_regional = $conselho_regional;
		$this->login = $login;
		$this->senha = $senha;
		$this->arquivo = $arquivo;
		$this->situacao = $situacao;
		$this->data_cad_externo = $data_cad_externo;
		$this->data_cad_empresa = $data_cad_empresa;
	}
}