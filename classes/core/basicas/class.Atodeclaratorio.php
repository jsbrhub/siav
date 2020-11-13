<?php
class Atodeclaratorio {
	
	public $idAtoDeclaratorio;
	public $oIncentivoempresa;
	public $nomeArquivo;
	public $novoNome;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idAtoDeclaratorio = NULL, Incentivoempresa $oIncentivoempresa = NULL, $nomeArquivo = NULL, $novoNome = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idAtoDeclaratorio = $idAtoDeclaratorio;
		$this->oIncentivoempresa = $oIncentivoempresa;
		$this->nomeArquivo = $nomeArquivo;
		$this->novoNome = $novoNome;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}