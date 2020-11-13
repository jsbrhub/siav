<?php
class Pesquisadesenvolvimento {
	
	public $idPesquisa;
	public $oEmpresa;
	public $nomeProjeto;
	public $descricaoAtividade;
	public $totalDespesas;
	public $quantidadePessoas;
	public $observacoes;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idPesquisa = NULL, Empresa $oEmpresa = NULL, $nomeProjeto = NULL, $descricaoAtividade = NULL, $totalDespesas = NULL, $quantidadePessoas = NULL, $observacoes = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idPesquisa = $idPesquisa;
		$this->oEmpresa = $oEmpresa;
		$this->nomeProjeto = $nomeProjeto;
		$this->descricaoAtividade = $descricaoAtividade;
		$this->totalDespesas = $totalDespesas;
		$this->quantidadePessoas = $quantidadePessoas;
		$this->observacoes = $observacoes;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}