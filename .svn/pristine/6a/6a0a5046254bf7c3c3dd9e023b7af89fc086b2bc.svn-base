<?php
class ResponsaveisMAP {

	static function getMetaData() {
		return ['responsaveis' => ['idResponsaveis', 
'nome', 
'estrangeiro', 
'cpf_passaporte', 
'rg', 
'orgao_expedidor', 
'cidade', 
'estado', 
'cep', 
'endereco', 
'email', 
'cargo', 
'conselho_regional', 
'login', 
'senha', 
'arquivo', 
'situacao', 
'data_cad_externo', 
'data_cad_empresa']];
	}
	
	static function dataToSelect() {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
			}
		}
	
		return implode(",\n", $aux);
	}
	
	static function filterLike($valor) {
		foreach(self::getMetaData() as $tabela => $aCampo){
			foreach($aCampo as $sCampo){
				$aux[] = "$tabela.$sCampo like '$valor'";
			}
		}
	
		return implode("\nor ", $aux);
	}

	static function objToRs($oResponsaveis){
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$reg['nome'] = $oResponsaveis->nome;
		$reg['estrangeiro'] = $oResponsaveis->estrangeiro;
		$reg['cpf_passaporte'] = $oResponsaveis->cpf_passaporte;
		$reg['rg'] = $oResponsaveis->rg;
		$reg['orgao_expedidor'] = $oResponsaveis->orgao_expedidor;
		$reg['cidade'] = $oResponsaveis->cidade;
		$reg['estado'] = $oResponsaveis->estado;
		$reg['cep'] = $oResponsaveis->cep;
		$reg['endereco'] = $oResponsaveis->endereco;
		$reg['email'] = $oResponsaveis->email;
		$reg['cargo'] = $oResponsaveis->cargo;
		$reg['conselho_regional'] = $oResponsaveis->conselho_regional;
		$reg['login'] = $oResponsaveis->login;
		$reg['senha'] = $oResponsaveis->senha;
		$reg['arquivo'] = $oResponsaveis->arquivo;
		$reg['situacao'] = $oResponsaveis->situacao;
		$reg['data_cad_externo'] = $oResponsaveis->data_cad_externo;
		$reg['data_cad_empresa'] = $oResponsaveis->data_cad_empresa;
		return $reg;		   
	}

	static function objToRsInsert($oResponsaveis){
		$reg['nome'] = $oResponsaveis->nome;
		$reg['estrangeiro'] = $oResponsaveis->estrangeiro;
		$reg['cpf_passaporte'] = $oResponsaveis->cpf_passaporte;
		$reg['rg'] = $oResponsaveis->rg;
		$reg['orgao_expedidor'] = $oResponsaveis->orgao_expedidor;
		$reg['cidade'] = $oResponsaveis->cidade;
		$reg['estado'] = $oResponsaveis->estado;
		$reg['cep'] = $oResponsaveis->cep;
		$reg['endereco'] = $oResponsaveis->endereco;
		$reg['email'] = $oResponsaveis->email;
		$reg['cargo'] = $oResponsaveis->cargo;
		$reg['conselho_regional'] = $oResponsaveis->conselho_regional;
		$reg['login'] = $oResponsaveis->login;
		$reg['senha'] = $oResponsaveis->senha;
		$reg['arquivo'] = $oResponsaveis->arquivo;
		$reg['situacao'] = $oResponsaveis->situacao;
		$reg['data_cad_externo'] = $oResponsaveis->data_cad_externo;
		$reg['data_cad_empresa'] = $oResponsaveis->data_cad_empresa;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oResponsaveis = new Responsaveis();
		$oResponsaveis->idResponsaveis = $reg['responsaveis_idResponsaveis'];
		$oResponsaveis->nome = $reg['responsaveis_nome'];
		$oResponsaveis->estrangeiro = $reg['responsaveis_estrangeiro'];
		$oResponsaveis->cpf_passaporte = $reg['responsaveis_cpf_passaporte'];
		$oResponsaveis->rg = $reg['responsaveis_rg'];
		$oResponsaveis->orgao_expedidor = $reg['responsaveis_orgao_expedidor'];
		$oResponsaveis->cidade = $reg['responsaveis_cidade'];
		$oResponsaveis->estado = $reg['responsaveis_estado'];
		$oResponsaveis->cep = $reg['responsaveis_cep'];
		$oResponsaveis->endereco = $reg['responsaveis_endereco'];
		$oResponsaveis->email = $reg['responsaveis_email'];
		$oResponsaveis->cargo = $reg['responsaveis_cargo'];
		$oResponsaveis->conselho_regional = $reg['responsaveis_conselho_regional'];
		$oResponsaveis->login = $reg['responsaveis_login'];
		$oResponsaveis->senha = $reg['responsaveis_senha'];
		$oResponsaveis->arquivo = $reg['responsaveis_arquivo'];
		$oResponsaveis->situacao = $reg['responsaveis_situacao'];
		$oResponsaveis->data_cad_externo = $reg['responsaveis_data_cad_externo'];
		$oResponsaveis->data_cad_empresa = $reg['responsaveis_data_cad_empresa'];
		return $oResponsaveis;		   
	}
}
