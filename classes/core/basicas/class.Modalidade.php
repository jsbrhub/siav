<?php
class Modalidade {
	
	public $idModalidade;
	public $oIncentivos;
	public $descricao;
	
	function __construct($idModalidade = NULL, Incentivos $oIncentivos = NULL, $descricao = NULL){
		$this->idModalidade = $idModalidade;
		$this->oIncentivos = $oIncentivos;
		$this->descricao = $descricao;
	}
}