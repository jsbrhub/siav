<?php
class ArquivoprojetoMAP {

	static function getMetaData() {
		return ['arquivoprojeto' => ['idArquivoProj', 
'idProjeto', 
'nomeArquivo', 
'novoNome', 
'link', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'projsocioambiental' => ['idProjeto', 
'idEmpresa', 
'nomeProjeto', 
'descricaoAtividade', 
'totalDespesas', 
'quantidadePessoas', 
'observacoes', 
'dataHoraAlteracao', 
'usuarioAlteracao']];
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

	static function objToRs($oArquivoprojeto){
		$reg['idArquivoProj'] = $oArquivoprojeto->idArquivoProj;
		$oProjsocioambiental = $oArquivoprojeto->oProjsocioambiental;
		$reg['idProjeto'] = $oProjsocioambiental->idProjeto;
		$reg['nomeArquivo'] = $oArquivoprojeto->nomeArquivo;
		$reg['novoNome'] = $oArquivoprojeto->novoNome;
		$reg['link'] = $oArquivoprojeto->link;
		$reg['dataHoraAlteracao'] = $oArquivoprojeto->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoprojeto->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivoprojeto){
		$oProjsocioambiental = $oArquivoprojeto->oProjsocioambiental;
		$reg['idProjeto'] = $oProjsocioambiental->idProjeto;
		$reg['nomeArquivo'] = $oArquivoprojeto->nomeArquivo;
		$reg['novoNome'] = $oArquivoprojeto->novoNome;
		$reg['link'] = $oArquivoprojeto->link;
		$reg['dataHoraAlteracao'] = $oArquivoprojeto->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivoprojeto->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivoprojeto = new Arquivoprojeto();
		$oArquivoprojeto->idArquivoProj = $reg['arquivoprojeto_idArquivoProj'];

		$oProjsocioambiental = new Projsocioambiental();
		$oProjsocioambiental->idProjeto = $reg['projsocioambiental_idProjeto'];
		$oProjsocioambiental->nomeProjeto = $reg['projsocioambiental_nomeProjeto'];
		$oProjsocioambiental->descricaoAtividade = $reg['projsocioambiental_descricaoAtividade'];
		$oProjsocioambiental->totalDespesas = $reg['projsocioambiental_totalDespesas'];
		$oProjsocioambiental->quantidadePessoas = $reg['projsocioambiental_quantidadePessoas'];
		$oProjsocioambiental->observacoes = $reg['projsocioambiental_observacoes'];
		$oProjsocioambiental->dataHoraAlteracao = $reg['projsocioambiental_dataHoraAlteracao'];
		$oProjsocioambiental->usuarioAlteracao = $reg['projsocioambiental_usuarioAlteracao'];
		$oArquivoprojeto->oProjsocioambiental = $oProjsocioambiental;
		$oArquivoprojeto->nomeArquivo = $reg['arquivoprojeto_nomeArquivo'];
		$oArquivoprojeto->novoNome = $reg['arquivoprojeto_novoNome'];
		$oArquivoprojeto->link = $reg['arquivoprojeto_link'];
		$oArquivoprojeto->dataHoraAlteracao = $reg['arquivoprojeto_dataHoraAlteracao'];
		$oArquivoprojeto->usuarioAlteracao = $reg['arquivoprojeto_usuarioAlteracao'];
		return $oArquivoprojeto;		   
	}
}
