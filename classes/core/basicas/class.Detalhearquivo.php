<?php
class Detalhearquivo {
	
	public $idDetalheArquivo;
	public $oArquivo;
	public $descricao;
	public $linha;
	
	function __construct($idDetalheArquivo = NULL, Arquivo $oArquivo = NULL, $descricao = NULL, $linha = NULL){
		$this->idDetalheArquivo = $idDetalheArquivo;
		$this->oArquivo = $oArquivo;
		$this->descricao = $descricao;
		$this->linha = $linha;
	}
}