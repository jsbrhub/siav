<?php
class Politicaambiental {
	
	public $idPolitica;
	public $oEmpresa;
	public $residuosGerados;
	public $descricaoTratamento;
	public $quantGerado;
	public $unidadeQg;
	public $descricaoQg;
	public $quantTratado;
	public $unidadeQt;
	public $descricaoQt;
	public $dataHoraAlteracao;
	public $usuarioAlteracao;
	
	function __construct($idPolitica = NULL, Empresa $oEmpresa = NULL, $residuosGerados = NULL, $descricaoTratamento = NULL, $quantGerado = NULL, $unidadeQg = NULL, $descricaoQg = NULL, $quantTratado = NULL, $unidadeQt = NULL, $descricaoQt = NULL, $dataHoraAlteracao = NULL, $usuarioAlteracao = NULL){
		$this->idPolitica = $idPolitica;
		$this->oEmpresa = $oEmpresa;
		$this->residuosGerados = $residuosGerados;
		$this->descricaoTratamento = $descricaoTratamento;
		$this->quantGerado = $quantGerado;
		$this->unidadeQg = $unidadeQg;
		$this->descricaoQg = $descricaoQg;
		$this->quantTratado = $quantTratado;
		$this->unidadeQt = $unidadeQt;
		$this->descricaoQt = $descricaoQt;
		$this->dataHoraAlteracao = $dataHoraAlteracao;
		$this->usuarioAlteracao = $usuarioAlteracao;
	}
}