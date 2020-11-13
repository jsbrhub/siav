<?php
class ResponsaveisAssinaturasMAP {

	static function getMetaData() {
		return ['responsaveis_assinaturas' => ['idResponsaveisAssinaturas', 
'idResponsaveis', 
'idEmpresaCampanhaResponsaveis', 
'cnpj', 
'data_assinatura', 
'tipo_documento', 
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
'data_cad_empresa'], 
'empresa_campanha_responsaveis' => ['idEmpresaCampanhaResponsaveis', 
'idCampanha', 
'idEmpresaCampanha', 
'idResponsaveis', 
'situacao']];
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

	static function objToRs($oResponsaveisAssinaturas){
		$reg['idResponsaveisAssinaturas'] = $oResponsaveisAssinaturas->idResponsaveisAssinaturas;
		$oResponsaveis = $oResponsaveisAssinaturas->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$oEmpresaCampanhaResponsaveis = $oResponsaveisAssinaturas->oEmpresaCampanhaResponsaveis;
		$reg['idEmpresaCampanhaResponsaveis'] = $oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis;
		$reg['cnpj'] = $oResponsaveisAssinaturas->cnpj;
		$reg['data_assinatura'] = $oResponsaveisAssinaturas->data_assinatura;
		$reg['tipo_documento'] = $oResponsaveisAssinaturas->tipo_documento;
		$reg['situacao'] = $oResponsaveisAssinaturas->situacao;
		return $reg;		   
	}

	static function objToRsInsert($oResponsaveisAssinaturas){
		$oResponsaveis = $oResponsaveisAssinaturas->oResponsaveis;
		$reg['idResponsaveis'] = $oResponsaveis->idResponsaveis;
		$oEmpresaCampanhaResponsaveis = $oResponsaveisAssinaturas->oEmpresaCampanhaResponsaveis;
		$reg['idEmpresaCampanhaResponsaveis'] = $oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis;
		$reg['cnpj'] = $oResponsaveisAssinaturas->cnpj;
		$reg['data_assinatura'] = $oResponsaveisAssinaturas->data_assinatura;
		$reg['tipo_documento'] = $oResponsaveisAssinaturas->tipo_documento;
		$reg['situacao'] = $oResponsaveisAssinaturas->situacao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oResponsaveisAssinaturas = new ResponsaveisAssinaturas();
		$oResponsaveisAssinaturas->idResponsaveisAssinaturas = $reg['responsaveis_assinaturas_idResponsaveisAssinaturas'];

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
		$oResponsaveisAssinaturas->oResponsaveis = $oResponsaveis;

		$oEmpresaCampanhaResponsaveis = new EmpresaCampanhaResponsaveis();
		$oEmpresaCampanhaResponsaveis->idEmpresaCampanhaResponsaveis = $reg['empresa_campanha_responsaveis_idEmpresaCampanhaResponsaveis'];
		$oEmpresaCampanhaResponsaveis->situacao = $reg['empresa_campanha_responsaveis_situacao'];
		$oResponsaveisAssinaturas->oEmpresaCampanhaResponsaveis = $oEmpresaCampanhaResponsaveis;
		$oResponsaveisAssinaturas->cnpj = $reg['responsaveis_assinaturas_cnpj'];
		$oResponsaveisAssinaturas->data_assinatura = $reg['responsaveis_assinaturas_data_assinatura'];
		$oResponsaveisAssinaturas->tipo_documento = $reg['responsaveis_assinaturas_tipo_documento'];
		$oResponsaveisAssinaturas->situacao = $reg['responsaveis_assinaturas_situacao'];
		return $oResponsaveisAssinaturas;		   
	}
}
