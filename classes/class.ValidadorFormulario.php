<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormularioCadastroAcionista(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idAcionista == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome invalido!";
			return false;
		}	
		if($cpf == ''){
			$this->msg = "Cpf invalido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroAddResponsaveis(&$post){
	    global $oControle;

        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v)
            $$i = $v;

        if($idResponsaveis == ''){
            $this->msg = "Um usuário responsavel deve ser selecionado!";
            return false;
        }

        if($idCampanha == ''){
            $this->msg = "Uma campanha deve ser selecionada!";
            return false;
        }

        $checkDuplicated = $oControle->getRowEmpresaCampanhaResponsaveis([
            "empresacampanha.idCampanha = {$idCampanha}",
            "empresacampanha.cnpj = '{$_SESSION["usuarioAtual"]["cnpj"]}'",
            "responsaveis.idResponsaveis = '{$idResponsaveis}'",
            "empresa_campanha_responsaveis.situacao in (0,1)"
        ]);

        if($checkDuplicated instanceof EmpresaCampanhaResponsaveis){
            $this->msg = "Este Responsavel já está cadastrado!";
            return false;
        }

        return true;

    }

	function validaFormularioCadastroResponsaveisEmpresa(&$post, $acao=''){
	    global $oControle;

		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v)
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao


		if($cnpj == ''){
			$this->msg = "não foi encontrado CNPJ para vinculo!";
			return false;
		}
		if($nome == ''){
			$this->msg = "Nome deve ser preenchido!";
			return false;
		}
		if($cpf_passaporte == ''){
			$this->msg = "CPF deve ser preenchido!";
			return false;
		}
		if($email == ''){
			$this->msg = "Email deve ser preenchido!";
			return false;
		}

        if(empty($idResponsaveis)){
            $oResposavelEmpresa = $oControle->getRowResponsaveisEmpresa([
                "responsaveis_empresa.situacao != -1",
                "responsaveis.situacao != -1",
                "(responsaveis.cpf_passaporte = '{$cpf_passaporte}' OR responsaveis.email = '{$email}') ",
                "responsaveis_empresa.cnpj = '{$cnpj}'"
            ]);

            if($oResposavelEmpresa instanceof ResponsaveisEmpresa){
                $this->msg = "Este usuário já faz parte de sua lista de responsáveis!";

                $this->oResponsaveis = $oResposavelEmpresa->oResponsaveis;

                return false;
            }
        }

		return true;
	}

    function validaFormularioCadastroResponsaveis(&$post, $acao=''){
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v)
            $$i = $v;
        // valida formulario - Inicia comentado para facilitar depuracao

        if(empty($idResponsaveis)){
            if($cnpj == ''){
                $this->msg = "não foi encontrado CNPJ para vinculo!";
                return false;
            }
        }

        if($nome == ''){
            $this->msg = "Nome deve ser preenchido!";
            return false;
        }
        if($cpf_passaporte == ''){
            $this->msg = "CPF deve ser preenchido!";
            return false;
        }
        if($email == ''){
            $this->msg = "Email deve ser preenchido!";
            return false;
        }

        return true;
    }

	function validaFormularioCadastroAlerta(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idAlerta == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idCampanha == ''){
			$this->msg = "Campanha invalido!";
			return false;
		}	
		if($assunto == ''){
			$this->msg = "Assunto invalido!";
			return false;
		}	
		if($texto == ''){
			$this->msg = "Texto invalido!";
			return false;
		}	
		if($tipoSelecao == ''){
			$this->msg = "TipoSelecao invalido!";
			return false;
		}	
		if($totalEmpresas == ''){
			$this->msg = "TotalEmpresas invalido!";
			return false;
		}	
		if($situacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}
	function validaFormularioCadastroUpdateEmail(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v)
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao

        if($email == ''){
            $this->msg = "Campo Email deve ser preenchido!";
            return false;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->msg = "Email informado não é válido!";
            return false;
        }


        if($cnpj == ''){
            $this->msg = "Nenhum CNPJ informado!";
            return false;
        }

        if(empty($_SESSION["usuarioAtual"])){
            $this->msg = "Sessão expirada, você deve realizar loin novamente no sistema!";
            return false;
        }


		return true;
	}

    function validaFormularioEnvioAlerta(&$post, $acao=''){
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v)
            $$i = $v;
        // valida formulario - Inicia comentado para facilitar depuracao

        if($idCampanha == ''){
            $this->msg = "Nenhuma Campanha foi informada!";
            return false;
        }

        if($texto == ''){
            $this->msg = "o Corpo da mensagem não pode ser vazio!";
            return false;
        }

        if($assunto == ''){
            $this->msg = "O campo Assunto não pode ser vazio!";
            return false;
        }

        if(empty($_SESSION["usuarioAtual"])){
            $this->msg = "Sessão expirada, você deve realizar login novamente no sistema!";
            return false;
        }


        return true;
    }

	function validaFormularioCadastroArquivo(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idArquivo == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($nomeArquivo == ''){
			$this->msg = "Nome invalido!";
			return false;
		}	
		if($novoNome == ''){
			$this->msg = "NovoNome invalido!";
			return false;
		}	
		if($dataImportacao == ''){
			$this->msg = "DataImportacao invalido!";
			return false;
		}	
		if($situacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroArquivoempresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idArquivoEmpresa == ''){
				$this->msg = "IdArquivoEmpresa invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($idTipoArquivo == ''){
			$this->msg = "Tipoarquivo invalido!";
			return false;
		}	
		if($nomeArquivo == ''){
			$this->msg = "NomeArquivo invalido!";
			return false;
		}	
		if($novoNome == ''){
			$this->msg = "NovoNome invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroArquivoretificacao(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idArqRet == ''){
				$this->msg = "IdArqRet invalido!";
				return false;
			}
		}
		if($idRetEmpresa == ''){
			$this->msg = "Retificacaoempresa invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($nomeArquivo == ''){
			$this->msg = "NomeArquivo invalido!";
			return false;
		}	
		if($novoNome == ''){
			$this->msg = "NovoNome invalido!";
			return false;
		}	
		if($link == ''){
			$this->msg = "Link invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroAtodeclaratorio(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idAtoDeclaratorio == ''){
				$this->msg = "IdAtoDeclaratorio invalido!";
				return false;
			}
		}
		if($idIncentivoEmpresa == ''){
			$this->msg = "Incentivoempresa invalido!";
			return false;
		}	
		if($nomeArquivo == ''){
			$this->msg = "NomeArquivo invalido!";
			return false;
		}	
		if($novoNome == ''){
			$this->msg = "NovoNome invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroAutenticacaoempresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idAutenticacao == ''){
				$this->msg = "IdAutenticacao invalido!";
				return false;
			}
		}
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha invalido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroCadastrofinanceiro(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idCadastroFinanceiro == ''){
				$this->msg = "IdCadastroFinanceiro invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($ehEstimado == ''){
			$this->msg = "EhEstimado invalido!";
			return false;
		}	
		if($faturamentoBruto == ''){
			$this->msg = "FaturamentoBruto invalido!";
			return false;
		}	
		if($imobilizadoTotal == ''){
			$this->msg = "ImobilizadoTotal invalido!";
			return false;
		}	
		if($reservaExercicio == ''){
			$this->msg = "ReservaExercicio invalido!";
			return false;
		}	
		if($irDescontada == ''){
			$this->msg = "IrDescontada invalido!";
			return false;
		}	
		if($valorIcms == ''){
			$this->msg = "ValorIcms invalido!";
			return false;
		}	
		if($valorIssqn == ''){
			$this->msg = "ValorIssqn invalido!";
			return false;
		}	
		if($empregosDiretos == ''){
			$this->msg = "EmpregosDiretos invalido!";
			return false;
		}	
		if($despesaTerceiro == ''){
			$this->msg = "DespesaTerceiro invalido!";
			return false;
		}	
		if($terceirizadosExistentes == ''){
			$this->msg = "TerceirizadosExistentes invalido!";
			return false;
		}	
		if($pessoasEncargos == ''){
			$this->msg = "PessoasEncargos invalido!";
			return false;
		}	
		if($impostosTaxasContribuicoes == ''){
			$this->msg = "ImpostosTaxasContribuicoes invalido!";
			return false;
		}	
		if($remuneracaoCapitalTerceiros == ''){
			$this->msg = "RemuneracaoCapitalTerceiros invalido!";
			return false;
		}	
		if($remuneracaoCapitalProprio == ''){
			$this->msg = "RemuneracaoCapitalProprio invalido!";
			return false;
		}	
		if($investimentoCapitalFixo == ''){
			$this->msg = "InvestimentoCapitalFixo invalido!";
			return false;
		}	
		if($faturamentoProdIncentivados == ''){
			$this->msg = "FaturamentoProdIncentivados invalido!";
			return false;
		}	
		if($reservaInvestimento == ''){
			$this->msg = "ReservaInvestimento invalido!";
			return false;
		}	
		if($valorIRtotal == ''){
			$this->msg = "ValorIRtotal invalido!";
			return false;
		}	
		if($capitalGiro == ''){
			$this->msg = "CapitalGiro invalido!";
			return false;
		}	
		if($capitalFixo == ''){
			$this->msg = "CapitalFixo invalido!";
			return false;
		}	
		if($maoObraDireta == ''){
			$this->msg = "MaoObraDireta invalido!";
			return false;
		}	
		if($maoObraIndiretaFixa == ''){
			$this->msg = "MaoObraIndiretaFixa invalido!";
			return false;
		}	
		if($maoObraReal == ''){
			$this->msg = "MaoObraReal invalido!";
			return false;
		}	
		if($recursosProprios == ''){
			$this->msg = "RecursosProprios invalido!";
			return false;
		}	
		if($previsaoIsencao == ''){
			$this->msg = "PrevisaoIsencao invalido!";
			return false;
		}	
		if($acionistas == ''){
			$this->msg = "Acionistas invalido!";
			return false;
		}	
		if($totalReinvestimento == ''){
			$this->msg = "TotalReinvestimento invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroCampanha(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idCampanha == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($campanha == ''){
			$this->msg = "Campanha invalido!";
			return false;
		}	
		if($anoBase == ''){
			$this->msg = "AnoBase invalido!";
			return false;
		}	
		if($dataInicio == ''){
			$this->msg = "DataInicio invalido!";
			return false;
		}	
		if($dataFim == ''){
			$this->msg = "DataFim invalido!";
			return false;
		}	
		if($totalEmpresas == ''){
			$this->msg = "TotalEmpresas invalido!";
			return false;
		}	
		if($situacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroContatoempresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idContatoEmpresa == ''){
				$this->msg = "IdContatoEmpresa invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($contato == ''){
			$this->msg = "Contato invalido!";
			return false;
		}	
		if($funcao == ''){
			$this->msg = "Funcao invalido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email invalido!";
			return false;
		}	
		if($telefone == ''){
			$this->msg = "Telefone invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroDetalhearquivo(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idDetalheArquivo == ''){
				$this->msg = "IdDetalheArquivo invalido!";
				return false;
			}
		}
		if($idArquivo == ''){
			$this->msg = "Arquivo invalido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao invalido!";
			return false;
		}	
		if($linha == ''){
			$this->msg = "Linha invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroEmpresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idEmpresa == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idMunicipio == ''){
			$this->msg = "Municipio invalido!";
			return false;
		}	
		if($idSituacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		if($idIncentivo == ''){
			$this->msg = "Incentivos invalido!";
			return false;
		}	
		if($idModalidade == ''){
			$this->msg = "Modalidade invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($cnpjMatriz == ''){
			$this->msg = "CnpjMatriz invalido!";
			return false;
		}	
		if($anoBase == ''){
			$this->msg = "AnoBase invalido!";
			return false;
		}	
		if($anoAprovacao == ''){
			$this->msg = "AnoAprovacao invalido!";
			return false;
		}	
		if($razaoSocial == ''){
			$this->msg = "RazaoSocial invalido!";
			return false;
		}	
		if($telefone == ''){
			$this->msg = "Telefone invalido!";
			return false;
		}	
		if($fax == ''){
			$this->msg = "Fax invalido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email invalido!";
			return false;
		}	
		if($fonteOrigem == ''){
			$this->msg = "FonteOrigem invalido!";
			return false;
		}	
		if($latitude == ''){
			$this->msg = "Latitude invalido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude invalido!";
			return false;
		}	
		if($endereco == ''){
			$this->msg = "Endereco invalido!";
			return false;
		}	
		if($complemento == ''){
			$this->msg = "Complemento invalido!";
			return false;
		}	
		if($bairro == ''){
			$this->msg = "Bairro invalido!";
			return false;
		}	
		if($cep == ''){
			$this->msg = "Cep invalido!";
			return false;
		}	
		if($setor == ''){
			$this->msg = "Setor invalido!";
			return false;
		}	
		if($enq == ''){
			$this->msg = "Enq invalido!";
			return false;
		}	
		if($numSudam == ''){
			$this->msg = "NumSudam invalido!";
			return false;
		}	
		if($procurador == ''){
			$this->msg = "Procurador invalido!";
			return false;
		}	
		if($laudoData == ''){
			$this->msg = "LaudoData invalido!";
			return false;
		}	
		if($laudoNumero == ''){
			$this->msg = "LaudoNumero invalido!";
			return false;
		}	
		if($anoCalendario == ''){
			$this->msg = "AnoCalendario invalido!";
			return false;
		}	
		if($resolucaoData == ''){
			$this->msg = "ResolucaoData invalido!";
			return false;
		}	
		if($resolucaoNumero == ''){
			$this->msg = "ResolucaoNumero invalido!";
			return false;
		}	
		if($declaracaoData == ''){
			$this->msg = "DeclaracaoData invalido!";
			return false;
		}	
		if($declaracaoNumero == ''){
			$this->msg = "DeclaracaoNumero invalido!";
			return false;
		}	
		if($situacaoCadastro == ''){
			$this->msg = "SituacaoCadastro invalido!";
			return false;
		}	
		if($projetoSocial == ''){
			$this->msg = "ProjetoSocial invalido!";
			return false;
		}	
		if($politicaAmbiental == ''){
			$this->msg = "PoliticaAmbiental invalido!";
			return false;
		}	
		if($vigente == ''){
			$this->msg = "Vigente invalido!";
			return false;
		}	
		if($anoVigencia == ''){
			$this->msg = "AnoVigencia invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroEmpresaalerta(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idEmpresaAlerta == ''){
				$this->msg = "IdEmpresaAlerta invalido!";
				return false;
			}
		}
		if($idAlerta == ''){
			$this->msg = "Alerta invalido!";
			return false;
		}	
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($idCampanha == ''){
			$this->msg = "Campanha invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroEmpresacampanha(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idEmpresaCampanha == ''){
				$this->msg = "IdEmpresaCampanha invalido!";
				return false;
			}
		}
		if($idCampanha == ''){
			$this->msg = "Campanha invalido!";
			return false;
		}	
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroEmpresacontrole(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idEmpresaControle == ''){
				$this->msg = "IdEmpresaControle invalido!";
				return false;
			}
		}
		if($idCampanha == ''){
			$this->msg = "Campanha invalido!";
			return false;
		}	
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		if($dataInsercao == ''){
			$this->msg = "DataInsercao invalido!";
			return false;
		}	
		if($dataAlteracao == ''){
			$this->msg = "DataAlteracao invalido!";
			return false;
		}	
		if($dataConclusao == ''){
			$this->msg = "DataConclusao invalido!";
			return false;
		}	
		*/
		return true;		
	}

    function validaFormularioCadastroHistoricoEdicaoEmail(&$post, $acao=''){
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v)
            $$i = $v;
        // valida formulario - Inicia comentado para facilitar depuracao
        /*
        if($acao == 2){
            if($idHistoricoEdicaoEmail == ''){
                $this->msg = "Id invalido!";
                return false;
            }
        }
        if($email_antigo == ''){
            $this->msg = "Email_antigo invalido!";
            return false;
        }
        if($email_novo == ''){
            $this->msg = "Email_novo invalido!";
            return false;
        }
        if($usuario == ''){
            $this->msg = "Usuario invalido!";
            return false;
        }
        if($dt_alteracao == ''){
            $this->msg = "Dt_alteracao invalido!";
            return false;
        }
        if($cnpj == ''){
            $this->msg = "Cnpj invalido!";
            return false;
        }
        */
        return true;
    }

	function validaFormularioCadastroHistoricoretificacao(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idHistRet == ''){
				$this->msg = "IdHistRet invalido!";
				return false;
			}
		}
		if($idRetEmpresa == ''){
			$this->msg = "Retificacaoempresa invalido!";
			return false;
		}	
		if($idRetSudam == ''){
			$this->msg = "Retificacaosudam invalido!";
			return false;
		}	
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($idEmpresaRet == ''){
			$this->msg = "IdEmpresaRet invalido!";
			return false;
		}	
		if($anoBase == ''){
			$this->msg = "AnoBase invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroIncentivoempresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idIncentivoEmpresa == ''){
				$this->msg = "IdIncentivoEmpresa invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($produtoIncentivado == ''){
			$this->msg = "ProdutoIncentivado invalido!";
			return false;
		}	
		if($fonteOrigem == ''){
			$this->msg = "FonteOrigem invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($cnae == ''){
			$this->msg = "Cnae invalido!";
			return false;
		}	
		if($faturamento == ''){
			$this->msg = "Faturamento invalido!";
			return false;
		}	
		if($emprego == ''){
			$this->msg = "Emprego invalido!";
			return false;
		}	
		if($producao == ''){
			$this->msg = "Producao invalido!";
			return false;
		}	
		if($idUnidadeProducao == ''){
			$this->msg = "IdUnidadeProducao invalido!";
			return false;
		}	
		if($capacidadeInstalada == ''){
			$this->msg = "CapacidadeInstalada invalido!";
			return false;
		}	
		if($unidadeDescricao == ''){
			$this->msg = "UnidadeDescricao invalido!";
			return false;
		}	
		if($idUnidadeCapacidade == ''){
			$this->msg = "IdUnidadeCapacidade invalido!";
			return false;
		}	
		if($ano == ''){
			$this->msg = "Ano invalido!";
			return false;
		}	
		if($vigente == ''){
			$this->msg = "Vigente invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroIncentivos(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idIncentivo == ''){
				$this->msg = "IdIncentivo invalido!";
				return false;
			}
		}
		if($incentivo == ''){
			$this->msg = "Incentivo invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroIncentivosexcel(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idincentivo == ''){
				$this->msg = "Idincentivo invalido!";
				return false;
			}
		}
		if($sudam_numero == ''){
			$this->msg = "Sudam_numero invalido!";
			return false;
		}	
		if($empresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($situacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		if($municipio == ''){
			$this->msg = "Municipio invalido!";
			return false;
		}	
		if($uf == ''){
			$this->msg = "Uf invalido!";
			return false;
		}	
		if($setor == ''){
			$this->msg = "Setor invalido!";
			return false;
		}	
		if($mob_di == ''){
			$this->msg = "Mob_di invalido!";
			return false;
		}	
		if($mob_in == ''){
			$this->msg = "Mob_in invalido!";
			return false;
		}	
		if($mob_real == ''){
			$this->msg = "Mob_real invalido!";
			return false;
		}	
		if($objetivo == ''){
			$this->msg = "Objetivo invalido!";
			return false;
		}	
		if($cap_instalada == ''){
			$this->msg = "Cap_instalada invalido!";
			return false;
		}	
		if($unidade == ''){
			$this->msg = "Unidade invalido!";
			return false;
		}	
		if($incentivo == ''){
			$this->msg = "Incentivo invalido!";
			return false;
		}	
		if($modalidade == ''){
			$this->msg = "Modalidade invalido!";
			return false;
		}	
		if($procurador == ''){
			$this->msg = "Procurador invalido!";
			return false;
		}	
		if($data_laudo == ''){
			$this->msg = "Data_laudo invalido!";
			return false;
		}	
		if($numero_laudo == ''){
			$this->msg = "Numero_laudo invalido!";
			return false;
		}	
		if($capital_fixo == ''){
			$this->msg = "Capital_fixo invalido!";
			return false;
		}	
		if($capital_giro == ''){
			$this->msg = "Capital_giro invalido!";
			return false;
		}	
		if($enq == ''){
			$this->msg = "Enq invalido!";
			return false;
		}	
		if($declaracao_data == ''){
			$this->msg = "Declaracao_data invalido!";
			return false;
		}	
		if($declaracao_numero == ''){
			$this->msg = "Declaracao_numero invalido!";
			return false;
		}	
		if($resolucao_data == ''){
			$this->msg = "Resolucao_data invalido!";
			return false;
		}	
		if($resolucao_numero == ''){
			$this->msg = "Resolucao_numero invalido!";
			return false;
		}	
		if($recursos_proprios == ''){
			$this->msg = "Recursos_proprios invalido!";
			return false;
		}	
		if($sudam_irpj == ''){
			$this->msg = "Sudam_irpj invalido!";
			return false;
		}	
		if($acionistas == ''){
			$this->msg = "Acionistas invalido!";
			return false;
		}	
		if($total == ''){
			$this->msg = "Total invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroInsumos(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idInsumo == ''){
				$this->msg = "IdInsumo invalido!";
				return false;
			}
		}
		if($descricao == ''){
			$this->msg = "Descricao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroMercadoconsumidor(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idMercado == ''){
				$this->msg = "IdMercado invalido!";
				return false;
			}
		}
		if($idIncentivoEmpresa == ''){
			$this->msg = "Incentivoempresa invalido!";
			return false;
		}	
		if($quantidadeRegional == ''){
			$this->msg = "QuantidadeRegional invalido!";
			return false;
		}	
		if($valorRegional == ''){
			$this->msg = "ValorRegional invalido!";
			return false;
		}	
		if($quantidadeNacional == ''){
			$this->msg = "QuantidadeNacional invalido!";
			return false;
		}	
		if($valorNacional == ''){
			$this->msg = "ValorNacional invalido!";
			return false;
		}	
		if($quantidadeExterior == ''){
			$this->msg = "QuantidadeExterior invalido!";
			return false;
		}	
		if($valorExterior == ''){
			$this->msg = "ValorExterior invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroModalidade(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idModalidade == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($idIncentivo == ''){
			$this->msg = "Incentivos invalido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroMunicipio(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idMunicipio == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($regiao == ''){
			$this->msg = "Regiao invalido!";
			return false;
		}	
		if($uf == ''){
			$this->msg = "Uf invalido!";
			return false;
		}	
		if($municipio == ''){
			$this->msg = "Municipio invalido!";
			return false;
		}	
		if($microregiao == ''){
			$this->msg = "Microregiao invalido!";
			return false;
		}	
		if($tipologia == ''){
			$this->msg = "Tipologia invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroOrigeminsumos(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idOrigemInsumos == ''){
				$this->msg = "IdOrigemInsumos invalido!";
				return false;
			}
		}
		if($idInsumo == ''){
			$this->msg = "Insumos invalido!";
			return false;
		}	
		if($idIncentivoEmpresa == ''){
			$this->msg = "Incentivoempresa invalido!";
			return false;
		}	
		if($quantidadeRegional == ''){
			$this->msg = "QuantidadeRegional invalido!";
			return false;
		}	
		if($quantidadeNacional == ''){
			$this->msg = "QuantidadeNacional invalido!";
			return false;
		}	
		if($quantidadeExterior == ''){
			$this->msg = "QuantidadeExterior invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroPoliticaambiental(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idPolitica == ''){
				$this->msg = "IdPolitica invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($residuosGerados == ''){
			$this->msg = "ResiduosGerados invalido!";
			return false;
		}	
		if($descricaoTratamento == ''){
			$this->msg = "DescricaoTratamento invalido!";
			return false;
		}	
		if($quantGerado == ''){
			$this->msg = "QuantGerado invalido!";
			return false;
		}	
		if($unidadeQg == ''){
			$this->msg = "UnidadeQg invalido!";
			return false;
		}	
		if($quantTratado == ''){
			$this->msg = "QuantTratado invalido!";
			return false;
		}	
		if($unidadeQt == ''){
			$this->msg = "UnidadeQt invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroProjsocioambiental(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idProjeto == ''){
				$this->msg = "IdProjeto invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($nomeProjeto == ''){
			$this->msg = "NomeProjeto invalido!";
			return false;
		}	
		if($descricaoAtividade == ''){
			$this->msg = "DescricaoAtividade invalido!";
			return false;
		}	
		if($totalDespesas == ''){
			$this->msg = "TotalDespesas invalido!";
			return false;
		}	
		if($quantidadePessoas == ''){
			$this->msg = "QuantidadePessoas invalido!";
			return false;
		}	
		if($observacoes == ''){
			$this->msg = "Observacoes invalido!";
			return false;
		}	
		if($dataHoraAlteracao == ''){
			$this->msg = "DataHoraAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

    function validaFormularioCadastroPesquisadesenvolvimento(&$post, $acao=''){
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v)
            $$i = $v;
        // valida formulario - Inicia comentado para facilitar depuracao
        /*
        if($acao == 2){
            if($idProjeto == ''){
                $this->msg = "IdProjeto invalido!";
                return false;
            }
        }
        if($idEmpresa == ''){
            $this->msg = "Empresa invalido!";
            return false;
        }
        if($nomeProjeto == ''){
            $this->msg = "NomeProjeto invalido!";
            return false;
        }
        if($descricaoAtividade == ''){
            $this->msg = "DescricaoAtividade invalido!";
            return false;
        }
        if($totalDespesas == ''){
            $this->msg = "TotalDespesas invalido!";
            return false;
        }
        if($quantidadePessoas == ''){
            $this->msg = "QuantidadePessoas invalido!";
            return false;
        }
        if($observacoes == ''){
            $this->msg = "Observacoes invalido!";
            return false;
        }
        if($dataHoraAlteracao == ''){
            $this->msg = "DataHoraAlteracao invalido!";
            return false;
        }
        if($usuarioAlteracao == ''){
            $this->msg = "UsuarioAlteracao invalido!";
            return false;
        }
        */
        return true;
    }

	function validaFormularioCadastroRetificacaoempresa(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idRetEmpresa == ''){
				$this->msg = "IdRetEmpresa invalido!";
				return false;
			}
		}
		if($idEmpresa == ''){
			$this->msg = "Empresa invalido!";
			return false;
		}	
		if($cnpj == ''){
			$this->msg = "Cnpj invalido!";
			return false;
		}	
		if($anoBase == ''){
			$this->msg = "AnoBase invalido!";
			return false;
		}	
		if($motivo == ''){
			$this->msg = "Motivo invalido!";
			return false;
		}	
		if($justificativa == ''){
			$this->msg = "Justificativa invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		if($dataSolicitacao == ''){
			$this->msg = "DataSolicitacao invalido!";
			return false;
		}	
		if($usuarioSolicitacao == ''){
			$this->msg = "UsuarioSolicitacao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroRetificacaosudam(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idRetSudam == ''){
				$this->msg = "IdRetSudam invalido!";
				return false;
			}
		}
		if($idRetEmpresa == ''){
			$this->msg = "Retificacaoempresa invalido!";
			return false;
		}	
		if($justificativa == ''){
			$this->msg = "Justificativa invalido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status invalido!";
			return false;
		}	
		if($dataAlteracao == ''){
			$this->msg = "DataAlteracao invalido!";
			return false;
		}	
		if($usuarioAlteracao == ''){
			$this->msg = "UsuarioAlteracao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroSituacao(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idSituacao == ''){
				$this->msg = "Id invalido!";
				return false;
			}
		}
		if($situacao == ''){
			$this->msg = "Situacao invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroTipoarquivo(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idTipoArquivo == ''){
				$this->msg = "IdTipoArquivo invalido!";
				return false;
			}
		}
		if($tipo == ''){
			$this->msg = "Tipo invalido!";
			return false;
		}	
		if($formato == ''){
			$this->msg = "Formato invalido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormularioCadastroUnidademedida(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/* 
		if($acao == 2){
			if($idUnidade == ''){
				$this->msg = "IdUnidade invalido!";
				return false;
			}
		}
		if($nome == ''){
			$this->msg = "Nome invalido!";
			return false;
		}	
		if($sigla == ''){
			$this->msg = "Sigla invalido!";
			return false;
		}	
		*/
		return true;		
	}

}