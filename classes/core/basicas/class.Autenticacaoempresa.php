<?php
class Autenticacaoempresa {
	
	public $idAutenticacao;
	public $cnpj;
	public $senha;
	public $email;
	public $senhaProv;
	
	function __construct($idAutenticacao = NULL, $cnpj = NULL, $senha = NULL, $email = NULL, $senhaProv = NULL){
		$this->idAutenticacao = $idAutenticacao;
		$this->cnpj = $cnpj;
		$this->senha = $senha;
		$this->email = $email;
		$this->senhaProv = $senhaProv;
	}
}