<?php
class ResponsaveisEmpresaMAP {

	static function getMetaData() {
		return ['responsaveis_empresa' => ['idResponsaveis', 
'cnpj', 
'data_vinculo', 
'situacao'], 
'responsaveis' => ['idResponsaveis', 
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

	static function objToRs($oResponsaveisEmpresa){
		$oResponsaveis = $oResponsaveisEmpresa->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$reg['cnpj'] = $oResponsaveisEmpresa->cnpj;
		$reg['data_vinculo'] = $oResponsaveisEmpresa->data_vinculo;
		$reg['situacao'] = $oResponsaveisEmpresa->situacao;
		return $reg;		   
	}

	static function objToRsInsert($oResponsaveisEmpresa){
		$oResponsaveis = $oResponsaveisEmpresa->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$reg['cnpj'] = $oResponsaveisEmpresa->cnpj;
		$reg['data_vinculo'] = $oResponsaveisEmpresa->data_vinculo;
		$reg['situacao'] = $oResponsaveisEmpresa->situacao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oResponsaveisEmpresa = new ResponsaveisEmpresa();

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
		$oResponsaveisEmpresa->oResponsaveis = $oResponsaveis;
		$oResponsaveisEmpresa->cnpj = $reg['responsaveis_empresa_cnpj'];
		$oResponsaveisEmpresa->data_vinculo = $reg['responsaveis_empresa_data_vinculo'];
		$oResponsaveisEmpresa->situacao = $reg['responsaveis_empresa_situacao'];
		return $oResponsaveisEmpresa;		   
	}
}
