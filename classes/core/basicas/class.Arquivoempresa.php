<?php
class Arquivoempresa {
	
	public $idArquivoEmpresa;
	public $oEmpresa;
	public $oTipoarquivo;
	public $nomeArquivo;
	public $novoNome;
	public $descricao;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idArquivoEmpresa = NULL, Empresa $oEmpresa = NULL, Tipoarquivo $oTipoarquivo = NULL, $nomeArquivo = NULL, $novoNome = NULL, $descricao = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idArquivoEmpresa = $idArquivoEmpresa;
		$this->oEmpresa = $oEmpresa;
		$this->oTipoarquivo = $oTipoarquivo;
		$this->nomeArquivo = $nomeArquivo;
		$this->novoNome = $novoNome;
		$this->descricao = $descricao;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}