<?php
class ArquivopesquisaMAP {

	static function getMetaData() {
		return ['arquivopesquisa' => ['idArquivoPesq', 
'idPesquisa', 
'nomeArquivo', 
'novoNome', 
'link', 
'dataHoraAlteracao', 
'usuarioAlteracao'], 
'pesquisadesenvolvimento' => ['idPesquisa', 
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

	static function objToRs($oArquivopesquisa){
		$reg['idArquivoPesq'] = $oArquivopesquisa->idArquivoPesq;
		$oPesquisadesenvolvimento = $oArquivopesquisa->oPesquisadesenvolvimento;
		$reg['idPesquisa'] = $oPesquisadesenvolvimento->idPesquisa;
		$reg['nomeArquivo'] = $oArquivopesquisa->nomeArquivo;
		$reg['novoNome'] = $oArquivopesquisa->novoNome;
		$reg['link'] = $oArquivopesquisa->link;
		$reg['dataHoraAlteracao'] = $oArquivopesquisa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivopesquisa->usuarioAlteracao;
		return $reg;		   
	}

	static function objToRsInsert($oArquivopesquisa){
		$oPesquisadesenvolvimento = $oArquivopesquisa->oPesquisadesenvolvimento;
		$reg['idPesquisa'] = $oPesquisadesenvolvimento->idPesquisa;
		$reg['nomeArquivo'] = $oArquivopesquisa->nomeArquivo;
		$reg['novoNome'] = $oArquivopesquisa->novoNome;
		$reg['link'] = $oArquivopesquisa->link;
		$reg['dataHoraAlteracao'] = $oArquivopesquisa->dataHoraAlteracao;
		$reg['usuarioAlteracao'] = $oArquivopesquisa->usuarioAlteracao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oArquivopesquisa = new Arquivopesquisa();
		$oArquivopesquisa->idArquivoPesq = $reg['arquivopesquisa_idArquivoPesq'];

		$oPesquisadesenvolvimento = new Pesquisadesenvolvimento();
		$oPesquisadesenvolvimento->idPesquisa = $reg['pesquisadesenvolvimento_idPesquisa'];
		$oPesquisadesenvolvimento->nomeProjeto = $reg['pesquisadesenvolvimento_nomeProjeto'];
		$oPesquisadesenvolvimento->descricaoAtividade = $reg['pesquisadesenvolvimento_descricaoAtividade'];
		$oPesquisadesenvolvimento->totalDespesas = $reg['pesquisadesenvolvimento_totalDespesas'];
		$oPesquisadesenvolvimento->quantidadePessoas = $reg['pesquisadesenvolvimento_quantidadePessoas'];
		$oPesquisadesenvolvimento->observacoes = $reg['pesquisadesenvolvimento_observacoes'];
		$oPesquisadesenvolvimento->dataHoraAlteracao = $reg['pesquisadesenvolvimento_dataHoraAlteracao'];
		$oPesquisadesenvolvimento->usuarioAlteracao = $reg['pesquisadesenvolvimento_usuarioAlteracao'];
		$oArquivopesquisa->oPesquisadesenvolvimento = $oPesquisadesenvolvimento;
		$oArquivopesquisa->nomeArquivo = $reg['arquivopesquisa_nomeArquivo'];
		$oArquivopesquisa->novoNome = $reg['arquivopesquisa_novoNome'];
		$oArquivopesquisa->link = $reg['arquivopesquisa_link'];
		$oArquivopesquisa->dataHoraAlteracao = $reg['arquivopesquisa_dataHoraAlteracao'];
		$oArquivopesquisa->usuarioAlteracao = $reg['arquivopesquisa_usuarioAlteracao'];
		return $oArquivopesquisa;		   
	}
}
