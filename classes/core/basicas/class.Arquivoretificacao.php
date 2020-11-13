<?php
class Arquivoretificacao {
	
	public $idArqRet;
	public $oRetificacaoempresa;
	public $cnpj;
	public $nomeArquivo;
	public $novoNome;
	public $link;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idArqRet = NULL, Retificacaoempresa $oRetificacaoempresa = NULL, $cnpj = NULL, $nomeArquivo = NULL, $novoNome = NULL, $link = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idArqRet = $idArqRet;
		$this->oRetificacaoempresa = $oRetificacaoempresa;
		$this->cnpj = $cnpj;
		$this->nomeArquivo = $nomeArquivo;
		$this->novoNome = $novoNome;
		$this->link = $link;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}