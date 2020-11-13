<?php
class Arquivoprojeto {
	
	public $idArquivoProj;
	public $oProjsocioambiental;
	public $nomeArquivo;
	public $novoNome;
	public $link;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idArquivoProj = NULL, Projsocioambiental $oProjsocioambiental = NULL, $nomeArquivo = NULL, $novoNome = NULL, $link = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idArquivoProj = $idArquivoProj;
		$this->oProjsocioambiental = $oProjsocioambiental;
		$this->nomeArquivo = $nomeArquivo;
		$this->novoNome = $novoNome;
		$this->link = $link;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}