<?php
class DadosFormulario {

    static function formularioCadastroResponsaveis($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idResponsaveis"] = strip_tags(addslashes(trim($post["idResponsaveis"])));
        }
        $post["nome"] = strip_tags(addslashes(trim($post["nome"])));
        $post["estrangeiro"] = strip_tags(addslashes(trim($post["estrangeiro"])));
        $post["cpf_passaporte"] = strip_tags(addslashes(trim($post["cpf_passaporte"])));
        $post["rg"] = strip_tags(addslashes(trim($post["rg"])));
        $post["orgao_expedidor"] = strip_tags(addslashes(trim($post["orgao_expedidor"])));
        $post["cidade"] = strip_tags(addslashes(trim($post["cidade"])));
        $post["estado"] = strip_tags(addslashes(trim($post["estado"])));
        $post["cep"] = strip_tags(addslashes(trim($post["cep"])));
        $post["endereco"] = strip_tags(addslashes(trim($post["endereco"])));
        $post["email"] = strip_tags(addslashes(trim($post["email"])));
        $post["cargo"] = strip_tags(addslashes(trim($post["cargo"])));
        $post["conselho_regional"] = strip_tags(addslashes(trim($post["conselho_regional"])));
        $post["login"] = strip_tags(addslashes(trim($post["login"])));
        $post["senha"] = strip_tags(addslashes(trim($post["senha"])));
        $post["arquivo"] = strip_tags(addslashes(trim($post["arquivo"])));
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));
        $post["data_cad_externo"] = strip_tags(addslashes(trim($post["data_cad_externo"])));
        $post["data_cad_empresa"] = strip_tags(addslashes(trim($post["data_cad_empresa"])));

        return $post;
    }

    static function formularioCadastroAcionista($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['acionista'];

        if($acao == 2){
            $post["idAcionista"] = strip_tags(addslashes(trim($post["idAcionista"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["nome"] = strip_tags(addslashes(trim($post["nome"])));
        $post["cpfCnpj"] = strip_tags(addslashes(trim($post["cpfCnpj"])));
        $post["tipoPessoa"] = strip_tags(addslashes(trim($post["tipoPessoa"])));
        $post["email"] = strip_tags(addslashes(trim($post["email"])));
        $post["estrangeiro"] = strip_tags(addslashes(trim($post["estrangeiro"])));
        $post["passaporte"] = strip_tags(addslashes(trim($post["passaporte"])));
        $post["funcao"] = strip_tags(addslashes(trim($post["funcao"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroAlerta($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['alerta'];

        if($acao == 2){
            $post["idAlerta"] = strip_tags(addslashes(trim($post["idAlerta"])));
        }
        $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        $post["assunto"] = strip_tags(addslashes(trim($post["assunto"])));
        $post["texto"] = strip_tags(addslashes(trim($post["texto"])));
        $post["tipoSelecao"] = strip_tags(addslashes(trim($post["tipoSelecao"])));
        $post["totalEmpresas"] = strip_tags(addslashes(trim($post["totalEmpresas"])));
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));

        return $post;
    }

    static function formularioCadastroArquivo($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idArquivo"] = strip_tags(addslashes(trim($post["idArquivo"])));
        }
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["dataImportacao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataImportacao"]))));
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroArquivoempresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idArquivoEmpresa"] = strip_tags(addslashes(trim($post["idArquivoEmpresa"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["idTipoArquivo"] = strip_tags(addslashes(trim($post["idTipoArquivo"])));
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroArquivopolitica($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idArquivoPol"] = strip_tags(addslashes(trim($post["idArquivoPol"])));
        }
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["link"] = strip_tags(addslashes(trim($post["link"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroArquivoprojeto($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idArquivoProj"] = strip_tags(addslashes(trim($post["idArquivoProj"])));
        }
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["link"] = strip_tags(addslashes(trim($post["link"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroArquivoretificacao($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idArqRet"] = strip_tags(addslashes(trim($post["idArqRet"])));
        }
        $post["idRetEmpresa"] = strip_tags(addslashes(trim($post["idRetEmpresa"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["link"] = strip_tags(addslashes(trim($post["link"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroAtodeclaratorio($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idAtoDeclaratorio"] = strip_tags(addslashes(trim($post["idAtoDeclaratorio"])));
        }
        $post["idIncentivoEmpresa"] = strip_tags(addslashes(trim($post["idIncentivoEmpresa"])));
        $post["nomeArquivo"] = strip_tags(addslashes(trim($post["nomeArquivo"])));
        $post["novoNome"] = strip_tags(addslashes(trim($post["novoNome"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroAutenticacaoempresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idAutenticacao"] = strip_tags(addslashes(trim($post["idAutenticacao"])));
        }
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["senha"] = strip_tags(addslashes(trim($post["senha"])));
        $post["email"] = strip_tags(addslashes(trim($post["email"])));

        return $post;
    }

    static function formularioCadastroCadastrofinanceiro($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['financeiro'];

        if($acao == 2){
            $post["idCadastroFinanceiro"] = strip_tags(addslashes(trim($post["idCadastroFinanceiro"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["ehEstimado"] = strip_tags(addslashes(trim($post["ehEstimado"])));
        $post["faturamentoBruto"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["faturamentoBruto"]))));
        $post["faturamentoProdIncentivados"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["faturamentoProdIncentivados"]))));
        $post["imobilizadoTotal"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["imobilizadoTotal"]))));
        $post["investimentoCapitalFixo"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["investimentoCapitalFixo"]))));
        $post["remuneracaoCapitalProprio"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["remuneracaoCapitalProprio"]))));
        $post["remuneracaoCapitalTerceiros"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["remuneracaoCapitalTerceiros"]))));
        $post["pessoasEncargos"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["pessoasEncargos"]))));
        $post["impostosTaxasContribuicoes"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["impostosTaxasContribuicoes"]))));
        $post["valorIcms"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valorIcms"]))));
        $post["valorIssqn"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valorIssqn"]))));
        $post["valorDescontoIR"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valorDescontoIR"]))));
        $post["irDescontada"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["irDescontada"]))));
        $post["reservaIncentivo"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["reservaIncentivo"]))));
        $post["reservaExercicio"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["reservaExercicio"]))));
        $post["reservaInvestimento"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["reservaInvestimento"]))));
        $post["despesaTerceiro"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["despesaTerceiro"]))));
        $post["empregosDiretos"] = strip_tags(addslashes(trim($post["empregosDiretos"])));
        $post["terceirizadosExistentes"] = strip_tags(addslashes(trim($post["terceirizadosExistentes"])));
        $post["valorIRtotal"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valorIRtotal"]))));
        $post["maoObraDireta"] = strip_tags(addslashes(trim($post["maoObraDireta"])));
        $post["maoObraIndiretaFixa"] = strip_tags(addslashes(trim($post["maoObraIndiretaFixa"])));
        $post["maoObraReal"] = strip_tags(addslashes(trim($post["maoObraReal"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroCampanha($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['campanha'];

        if($acao == 2){
            $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        }
        $post["campanha"] = strip_tags(addslashes(trim($post["campanha"])));
        $post["anoBase"] = strip_tags(addslashes(trim($post["anoBase"])));
        $post["dataInicio"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["dataInicio"]))));
        $post["dataFim"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["dataFim"]))));
        $post["totalEmpresas"] = strip_tags(addslashes(trim($post["totalEmpresas"])));
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));

        return $post;
    }

    static function formularioCadastroContatoempresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['contato'];

        if($acao == 2){
            $post["idContatoEmpresa"] = strip_tags(addslashes(trim($post["idContatoEmpresa"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["contato"] = strip_tags(addslashes(trim($post["contato"])));
        $post["funcao"] = strip_tags(addslashes(trim($post["funcao"])));
        $post["email"] = strip_tags(addslashes(trim($post["email"])));
        $post["telefone"] = strip_tags(addslashes(trim($post["telefone"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroDetalhearquivo($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idDetalheArquivo"] = strip_tags(addslashes(trim($post["idDetalheArquivo"])));
        }
        $post["idArquivo"] = strip_tags(addslashes(trim($post["idArquivo"])));
        $post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
        $post["linha"] = strip_tags(addslashes(trim($post["linha"])));

        return $post;
    }

    static function formularioCadastroEmpresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['empresa'];

        if($acao == 2){
            $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        }
        $post["idMunicipio"] = strip_tags(addslashes(trim($post["idMunicipio"])));
        $post["idSituacao"] = strip_tags(addslashes(trim($post["idSituacao"])));
        $post["idIncentivo"] = strip_tags(addslashes(trim($post["idIncentivo"])));
        $post["idModalidade"] = strip_tags(addslashes(trim($post["idModalidade"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["cnpjMatriz"] = strip_tags(addslashes(trim($post["cnpjMatriz"])));
        $post["anoBase"] = strip_tags(addslashes(trim($post["anoBase"])));
        $post["anoAprovacao"] = strip_tags(addslashes(trim($post["anoAprovacao"])));
        $post["razaoSocial"] = strip_tags(addslashes(trim($post["razaoSocial"])));
        $post["telefone"] = strip_tags(addslashes(trim($post["telefone"])));
        $post["fax"] = strip_tags(addslashes(trim($post["fax"])));
        $post["email"] = strip_tags(addslashes(trim($post["email"])));
        $post["fonteOrigem"] = strip_tags(addslashes(trim($post["fonteOrigem"])));
        $post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
        $post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
        $post["endereco"] = strip_tags(addslashes(trim($post["endereco"])));
        $post["numero"] = strip_tags(addslashes(trim($post["numero"])));
        $post["complemento"] = strip_tags(addslashes(trim($post["complemento"])));
        $post["bairro"] = strip_tags(addslashes(trim($post["bairro"])));
        $post["cep"] = strip_tags(addslashes(trim($post["cep"])));
        $post["setor"] = strip_tags(addslashes(trim($post["setor"])));
        $post["enq"] = strip_tags(addslashes(trim($post["enq"])));
        $post["numSudam"] = strip_tags(addslashes(trim($post["numSudam"])));
        $post["procurador"] = strip_tags(addslashes(trim($post["procurador"])));
        $post["laudoData"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["laudoData"]))));
        $post["laudoNumero"] = strip_tags(addslashes(trim($post["laudoNumero"])));
        $post["anoCalendario"] = strip_tags(addslashes(trim($post["anoCalendario"])));
        $post["resolucaoData"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["resolucaoData"]))));
        $post["resolucaoNumero"] = strip_tags(addslashes(trim($post["resolucaoNumero"])));
        $post["declaracaoData"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["declaracaoData"]))));
        $post["declaracaoNumero"] = strip_tags(addslashes(trim($post["declaracaoNumero"])));
        $post["situacaoCadastro"] = strip_tags(addslashes(trim($post["situacaoCadastro"])));
        $post["projetoSocial"] = strip_tags(addslashes(trim($post["projetoSocial"])));
        $post["politicaAmbiental"] = strip_tags(addslashes(trim($post["politicaAmbiental"])));
        $post["vigente"] = strip_tags(addslashes(trim($post["vigente"])));
        $post["anoVigencia"] = strip_tags(addslashes(trim($post["anoVigencia"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroEmpresaalerta($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idEmpresaAlerta"] = strip_tags(addslashes(trim($post["idEmpresaAlerta"])));
        }
        $post["idAlerta"] = strip_tags(addslashes(trim($post["idAlerta"])));
        $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));

        return $post;
    }

    static function formularioCadastroEmpresacampanha($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idEmpresaCampanha"] = strip_tags(addslashes(trim($post["idEmpresaCampanha"])));
        }
        $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));

        return $post;
    }

    static function formularioCadastroEmpresacontrole($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idEmpresaControle"] = strip_tags(addslashes(trim($post["idEmpresaControle"])));
        }
        $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));
        $post["dataInsercao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataInsercao"]))));
        $post["dataAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataAlteracao"]))));
        $post["dataConclusao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataConclusao"]))));

        return $post;
    }

    static function formularioCadastroHistoricoEdicaoEmail($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idHistoricoEdicaoEmail"] = strip_tags(addslashes(trim($post["idHistoricoEdicaoEmail"])));
        }
        $post["email_antigo"] = strip_tags(addslashes(trim($post["email_antigo"])));
        $post["email_novo"] = strip_tags(addslashes(trim($post["email_novo"])));
        $post["usuario"] = empty($post["usuario"]) ? $_SESSION["usuarioAtual"]["login"] : strip_tags(addslashes(trim($post["usuario"])));
        $post["dt_alteracao"] = empty($post["dt_alteracao"]) ? date("Y-m-d H:i:s") : Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dt_alteracao"]))));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));

        return $post;
    }

    static function formularioCadastroHistoricoretificacao($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idHistRet"] = strip_tags(addslashes(trim($post["idHistRet"])));
        }
        $post["idRetEmpresa"] = strip_tags(addslashes(trim($post["idRetEmpresa"])));
        $post["idRetSudam"] = strip_tags(addslashes(trim($post["idRetSudam"])));
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["idEmpresaRet"] = strip_tags(addslashes(trim($post["idEmpresaRet"])));
        $post["anoBase"] = strip_tags(addslashes(trim($post["anoBase"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroIncentivoempresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['produto'];

		if($acao == 2){
			$post["idIncentivoEmpresa"] = strip_tags(addslashes(trim($post["idIncentivoEmpresa"])));
		}
		$post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
		$post["idIncentivo"] = strip_tags(addslashes(trim($post["idIncentivo"])));
		$post["idModalidade"] = strip_tags(addslashes(trim($post["idModalidade"])));
		$post["produtoIncentivado"] = strip_tags(addslashes(trim($post["produtoIncentivado"])));
		$post["fonteOrigem"] = strip_tags(addslashes(trim($post["fonteOrigem"])));
		$post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
		$post["cnae"] = strip_tags(addslashes(trim($post["cnae"])));
		$post["emprego"] = strip_tags(addslashes(trim($post["emprego"])));
		$post["producao"] = strip_tags(addslashes(trim($post["producao"])));
		$post["faturamento"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["faturamento"]))));
		$post["idUnidadeProducao"] = strip_tags(addslashes(trim($post["idUnidadeProducao"])));
		$post["capacidadeInstalada"] = strip_tags(addslashes(trim($post["capacidadeInstalada"])));
		$post["unidadeDescricao"] = strip_tags(addslashes(trim($post["unidadeDescricao"])));
		$post["idUnidadeCapacidade"] = strip_tags(addslashes(trim($post["idUnidadeCapacidade"])));
		$post["ano"] = strip_tags(addslashes(trim($post["ano"])));
		$post["vigente"] = strip_tags(addslashes(trim($post["vigente"])));
		$post["anoInicial"] = strip_tags(addslashes(trim($post["anoInicial"])));
		$post["anoFinal"] = strip_tags(addslashes(trim($post["anoFinal"])));
		$post["observacao"] = strip_tags(addslashes(trim($post["observacao"])));
		$post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
		$post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));
		$post["vigente"] = "1";

		return $post;
	}

    static function formularioCadastroIncentivos($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idIncentivo"] = strip_tags(addslashes(trim($post["idIncentivo"])));
        }
        $post["incentivo"] = strip_tags(addslashes(trim($post["incentivo"])));

        return $post;
    }

    static function formularioCadastroIncentivosexcel($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idincentivo"] = strip_tags(addslashes(trim($post["idincentivo"])));
        }
        $post["sudam_numero"] = strip_tags(addslashes(trim($post["sudam_numero"])));
        $post["empresa"] = strip_tags(addslashes(trim($post["empresa"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));
        $post["municipio"] = strip_tags(addslashes(trim($post["municipio"])));
        $post["uf"] = strip_tags(addslashes(trim($post["uf"])));
        $post["setor"] = strip_tags(addslashes(trim($post["setor"])));
        $post["mob_di"] = strip_tags(addslashes(trim($post["mob_di"])));
        $post["mob_in"] = strip_tags(addslashes(trim($post["mob_in"])));
        $post["mob_real"] = strip_tags(addslashes(trim($post["mob_real"])));
        $post["objetivo"] = strip_tags(addslashes(trim($post["objetivo"])));
        $post["cap_instalada"] = strip_tags(addslashes(trim($post["cap_instalada"])));
        $post["unidade"] = strip_tags(addslashes(trim($post["unidade"])));
        $post["incentivo"] = strip_tags(addslashes(trim($post["incentivo"])));
        $post["modalidade"] = strip_tags(addslashes(trim($post["modalidade"])));
        $post["procurador"] = strip_tags(addslashes(trim($post["procurador"])));
        $post["data_laudo"] = strip_tags(addslashes(trim($post["data_laudo"])));
        $post["numero_laudo"] = strip_tags(addslashes(trim($post["numero_laudo"])));
        $post["capital_fixo"] = strip_tags(addslashes(trim($post["capital_fixo"])));
        $post["capital_giro"] = strip_tags(addslashes(trim($post["capital_giro"])));
        $post["enq"] = strip_tags(addslashes(trim($post["enq"])));
        $post["declaracao_data"] = strip_tags(addslashes(trim($post["declaracao_data"])));
        $post["declaracao_numero"] = strip_tags(addslashes(trim($post["declaracao_numero"])));
        $post["resolucao_data"] = strip_tags(addslashes(trim($post["resolucao_data"])));
        $post["resolucao_numero"] = strip_tags(addslashes(trim($post["resolucao_numero"])));
        $post["recursos_proprios"] = strip_tags(addslashes(trim($post["recursos_proprios"])));
        $post["sudam_irpj"] = strip_tags(addslashes(trim($post["sudam_irpj"])));
        $post["acionistas"] = strip_tags(addslashes(trim($post["acionistas"])));
        $post["total"] = strip_tags(addslashes(trim($post["total"])));

        return $post;
    }

    static function formularioCadastroInsumos($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idInsumo"] = strip_tags(addslashes(trim($post["idInsumo"])));
        }
        $post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));

        return $post;
    }

    static function formularioCadastroMercadoconsumidor($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['mercado'];

        if($acao == 2){
            $post["idMercado"] = strip_tags(addslashes(trim($post["idMercado"])));
        }
        $post["idIncentivoEmpresa"] = strip_tags(addslashes(trim($post["idIncentivoEmpresa"])));
        $post["quantidadeRegional"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeRegional"]))));
        $post["valorRegional"] = strip_tags(addslashes(trim($post["valorRegional"])));
        $post["quantidadeNacional"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeNacional"]))));
        $post["valorNacional"] = strip_tags(addslashes(trim($post["valorNacional"])));
        $post["quantidadeExterior"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeExterior"]))));
        $post["valorExterior"] = strip_tags(addslashes(trim($post["valorExterior"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroModalidade($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        $post["idModalidade"] = strip_tags(addslashes(trim($post["idModalidade"])));
        $post["idIncentivo"] = strip_tags(addslashes(trim($post["idIncentivo"])));
        $post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));

        return $post;
    }

    static function formularioCadastroMunicipio($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idMunicipio"] = strip_tags(addslashes(trim($post["idMunicipio"])));
        }
        $post["regiao"] = strip_tags(addslashes(trim($post["regiao"])));
        $post["uf"] = strip_tags(addslashes(trim($post["uf"])));
        $post["municipio"] = strip_tags(addslashes(trim($post["municipio"])));
        $post["microregiao"] = strip_tags(addslashes(trim($post["microregiao"])));
        $post["tipologia"] = strip_tags(addslashes(trim($post["tipologia"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));

        return $post;
    }

    static function formularioCadastroOrigeminsumos($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['origem'];

        if($acao == 2){
            $post["idOrigemInsumos"] = strip_tags(addslashes(trim($post["idOrigemInsumos"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["idInsumo"] = strip_tags(addslashes(trim($post["idInsumo"])));
        $post["quantidadeRegional"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeRegional"]))));
        $post["quantidadeNacional"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeNacional"]))));
        $post["quantidadeExterior"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantidadeExterior"]))));

        return $post;
    }

    static function formularioCadastroPoliticaambiental($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['politica'];

        if($acao == 2){
            $post["idPolitica"] = strip_tags(addslashes(trim($post["idPolitica"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["residuosGerados"] = strip_tags(addslashes(trim($post["residuosGerados"])));
        $post["descricaoTratamento"] = strip_tags(addslashes(trim($post["descricaoTratamento"])));
        $post["quantGerado"] =  Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantGerado"]))));
        $post["unidadeQg"] = strip_tags(addslashes(trim($post["unidadeQg"])));
        $post["descricaoQg"] = strip_tags(addslashes(trim($post["descricaoQg"])));
        $post["quantTratado"] =  Util::formataMoedaBanco(strip_tags(addslashes(trim($post["quantTratado"]))));
        $post["unidadeQt"] = strip_tags(addslashes(trim($post["unidadeQt"])));
        $post["descricaoQt"] = strip_tags(addslashes(trim($post["descricaoQt"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroProjsocioambiental($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['projeto'];

        if($acao == 2){
            $post["idProjeto"] = strip_tags(addslashes(trim($post["idProjeto"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["nomeProjeto"] = strip_tags(addslashes(trim($post["nomeProjeto"])));
        $post["descricaoAtividade"] = strip_tags(addslashes(trim($post["descricaoAtividade"])));
        $post["quantidadePessoas"] = strip_tags(addslashes(trim($post["quantidadePessoas"])));
        $post["totalDespesas"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["totalDespesas"]))));
        $post["observacoes"] = strip_tags(addslashes(trim($post["observacoes"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroPesquisadesenvolvimento($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['projeto'];

        if($acao == 2){
            $post["idPesquisa"] = strip_tags(addslashes(trim($post["idPesquisa"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["nomeProjeto"] = strip_tags(addslashes(trim($post["nomeProjeto"])));
        $post["descricaoAtividade"] = strip_tags(addslashes(trim($post["descricaoAtividade"])));
        $post["quantidadePessoas"] = strip_tags(addslashes(trim($post["quantidadePessoas"])));
        $post["totalDespesas"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["totalDespesas"]))));
        $post["observacoes"] = strip_tags(addslashes(trim($post["observacoes"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroRetificacaoempresa($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST['retEmpresa'];

        if($acao == 2){
            $post["idRetEmpresa"] = strip_tags(addslashes(trim($post["idRetEmpresa"])));
        }
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["anoBase"] = strip_tags(addslashes(trim($post["anoBase"])));
        $post["motivo"] = strip_tags(addslashes(trim($post["motivo"])));
        $post["justificativa"] = strip_tags(addslashes(trim($post["justificativa"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));
        $post["dataSolicitacao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataSolicitacao"]))));
        $post["usuarioSolicitacao"] = strip_tags(addslashes(trim($post["usuarioSolicitacao"])));
        return $post;
    }

    static function formularioCadastroRetificacaosudam($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idRetSudam"] = strip_tags(addslashes(trim($post["idRetSudam"])));
        }
        $post["idRetEmpresa"] = strip_tags(addslashes(trim($post["idRetEmpresa"])));
        $post["justificativa"] = strip_tags(addslashes(trim($post["justificativa"])));
        $post["status"] = strip_tags(addslashes(trim($post["status"])));
        $post["dataAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroSituacao($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idSituacao"] = strip_tags(addslashes(trim($post["idSituacao"])));
        }
        $post["situacao"] = strip_tags(addslashes(trim($post["situacao"])));

        return $post;
    }

	static function formularioCadastroTermoresponsabilidade($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST['termoResponsabilidade'];

        if($acao == 2){
            $post["idTermo"] = strip_tags(addslashes(trim($post["idTermo"])));
        }
        $post["idCampanha"] = strip_tags(addslashes(trim($post["idCampanha"])));
        $post["idEmpresa"] = strip_tags(addslashes(trim($post["idEmpresa"])));
        $post["cnpj"] = strip_tags(addslashes(trim($post["cnpj"])));
        $post["comprovante"] = strip_tags(addslashes(trim($post["comprovante"])));
        $post["dataHoraAlteracao"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAlteracao"]))));
        $post["usuarioAlteracao"] = strip_tags(addslashes(trim($post["usuarioAlteracao"])));

        return $post;
    }

    static function formularioCadastroTipoarquivo($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idTipoArquivo"] = strip_tags(addslashes(trim($post["idTipoArquivo"])));
        }
        $post["tipo"] = strip_tags(addslashes(trim($post["tipo"])));
        $post["formato"] = strip_tags(addslashes(trim($post["formato"])));

        return $post;
    }

    static function formularioCadastroUnidademedida($post=NULL, $acao=''){
        if($post == NULL)
            $post = $_REQUEST;

        if($acao == 2){
            $post["idUnidade"] = strip_tags(addslashes(trim($post["idUnidade"])));
        }
        $post["nome"] = strip_tags(addslashes(trim($post["nome"])));
        $post["sigla"] = strip_tags(addslashes(trim($post["sigla"])));

        return $post;
    }

}
