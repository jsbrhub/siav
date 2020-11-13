<?php
class Incentivosexcel {
	
	public $idincentivo;
	public $sudam_numero;
	public $empresa;
	public $cnpj;
	public $situacao;
	public $municipio;
	public $uf;
	public $setor;
	public $mob_di;
	public $mob_in;
	public $mob_real;
	public $objetivo;
	public $cap_instalada;
	public $unidade;
	public $incentivo;
	public $modalidade;
	public $procurador;
	public $data_laudo;
	public $numero_laudo;
	public $capital_fixo;
	public $capital_giro;
	public $enq;
	public $declaracao_data;
	public $declaracao_numero;
	public $resolucao_data;
	public $resolucao_numero;
	public $recursos_proprios;
	public $sudam_irpj;
	public $acionistas;
	public $total;
	
	function __construct($idincentivo = NULL, $sudam_numero = NULL, $empresa = NULL, $cnpj = NULL, $situacao = NULL, $municipio = NULL, $uf = NULL, $setor = NULL, $mob_di = NULL, $mob_in = NULL, $mob_real = NULL, $objetivo = NULL, $cap_instalada = NULL, $unidade = NULL, $incentivo = NULL, $modalidade = NULL, $procurador = NULL, $data_laudo = NULL, $numero_laudo = NULL, $capital_fixo = NULL, $capital_giro = NULL, $enq = NULL, $declaracao_data = NULL, $declaracao_numero = NULL, $resolucao_data = NULL, $resolucao_numero = NULL, $recursos_proprios = NULL, $sudam_irpj = NULL, $acionistas = NULL, $total = NULL){
		$this->idincentivo = $idincentivo;
		$this->sudam_numero = $sudam_numero;
		$this->empresa = $empresa;
		$this->cnpj = $cnpj;
		$this->situacao = $situacao;
		$this->municipio = $municipio;
		$this->uf = $uf;
		$this->setor = $setor;
		$this->mob_di = $mob_di;
		$this->mob_in = $mob_in;
		$this->mob_real = $mob_real;
		$this->objetivo = $objetivo;
		$this->cap_instalada = $cap_instalada;
		$this->unidade = $unidade;
		$this->incentivo = $incentivo;
		$this->modalidade = $modalidade;
		$this->procurador = $procurador;
		$this->data_laudo = $data_laudo;
		$this->numero_laudo = $numero_laudo;
		$this->capital_fixo = $capital_fixo;
		$this->capital_giro = $capital_giro;
		$this->enq = $enq;
		$this->declaracao_data = $declaracao_data;
		$this->declaracao_numero = $declaracao_numero;
		$this->resolucao_data = $resolucao_data;
		$this->resolucao_numero = $resolucao_numero;
		$this->recursos_proprios = $recursos_proprios;
		$this->sudam_irpj = $sudam_irpj;
		$this->acionistas = $acionistas;
		$this->total = $total;
	}
}