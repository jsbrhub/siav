<?php
class Arquivopesquisa {
	
	public $idArquivoPesq;
	public $oPesquisadesenvolvimento;
	public $nomeArquivo;
	public $novoNome;
	public $link;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idArquivoPesq = NULL, Pesquisadesenvolvimento $oPesquisadesenvolvimento = NULL, $nomeArquivo = NULL, $novoNome = NULL, $link = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idArquivoPesq = $idArquivoPesq;
		$this->oPesquisadesenvolvimento = $oPesquisadesenvolvimento;
		$this->nomeArquivo = $nomeArquivo;
		$this->novoNome = $novoNome;
		$this->link = $link;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}