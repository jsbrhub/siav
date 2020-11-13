<?php
require_once(dirname(__FILE__) . '/bd/class.AcionistaBD.php');
require_once(dirname(__FILE__) . '/bd/class.AlertaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivoBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivoempresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivopoliticaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivopesquisaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivoprojetoBD.php');
require_once(dirname(__FILE__) . '/bd/class.ArquivoretificacaoBD.php');
require_once(dirname(__FILE__) . '/bd/class.AtodeclaratorioBD.php');
require_once(dirname(__FILE__) . '/bd/class.AutenticacaoempresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.CadastrofinanceiroBD.php');
require_once(dirname(__FILE__) . '/bd/class.CampanhaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ContatoempresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.DetalhearquivoBD.php');
require_once(dirname(__FILE__) . '/bd/class.EmpresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.EmpresaalertaBD.php');
require_once(dirname(__FILE__) . '/bd/class.EmpresacampanhaBD.php');
require_once(dirname(__FILE__) . '/bd/class.EmpresaCampanhaResponsaveisBD.php');
require_once(dirname(__FILE__) . '/bd/class.EmpresacontroleBD.php');
require_once(dirname(__FILE__) . '/bd/class.HistoricoEdicaoEmailBD.php');
require_once(dirname(__FILE__) . '/bd/class.HistoricoretificacaoBD.php');
require_once(dirname(__FILE__) . '/bd/class.IncentivoempresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.IncentivosBD.php');
require_once(dirname(__FILE__) . '/bd/class.IncentivosexcelBD.php');
require_once(dirname(__FILE__) . '/bd/class.InsumosBD.php');
require_once(dirname(__FILE__) . '/bd/class.MercadoconsumidorBD.php');
require_once(dirname(__FILE__) . '/bd/class.ModalidadeBD.php');
require_once(dirname(__FILE__) . '/bd/class.MunicipioBD.php');
require_once(dirname(__FILE__) . '/bd/class.OrigeminsumosBD.php');
require_once(dirname(__FILE__) . '/bd/class.PoliticaambientalBD.php');
require_once(dirname(__FILE__) . '/bd/class.ProjsocioambientalBD.php');
require_once(dirname(__FILE__) . '/bd/class.PesquisadesenvolvimentoBD.php');
require_once(dirname(__FILE__) . '/bd/class.ResponsaveisEmpresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.ResponsaveisBD.php');
require_once(dirname(__FILE__) . '/bd/class.ResponsaveisAssinaturasBD.php');
require_once(dirname(__FILE__) . '/bd/class.RetificacaoempresaBD.php');
require_once(dirname(__FILE__) . '/bd/class.RetificacaosudamBD.php');
require_once(dirname(__FILE__) . '/bd/class.SituacaoBD.php');
require_once(dirname(__FILE__) . '/bd/class.TermoresponsabilidadeBD.php');
require_once(dirname(__FILE__) . '/bd/class.TipoarquivoBD.php');
require_once(dirname(__FILE__) . '/bd/class.UnidademedidaBD.php');
//require_once(dirname(__FILE__).'/class.Seguranca.php');
require_once(dirname(__FILE__) . '/core/class.Conexao.php');
require_once(dirname(__FILE__) . '/core/class.Util.php');
require_once(dirname(__FILE__) . '/class.ValidadorFormulario.php');
require_once(dirname(__FILE__) . '/class.DadosFormulario.php');
require_once(dirname(__FILE__) . '/class.CustomControle.php');

error_reporting(~E_NOTICE & ~E_WARNING);

class Controle extends CustomControle
{

    public $msg;

    protected $_conexao;

    function __construct($validadeSession = true)
    {
        session_start();

        $this->_conexao = new Conexao();

        if($validadeSession){
            if(!isset($_SESSION["usuarioAtual"]) && !isset($_SESSION["usuarioLogado"]) && !in_array(basename($_SERVER['PHP_SELF']), ['cadastro-externo-responsavel.php', 'emailRecuperaSenha.php'])) {
                echo "<script>
                         alert('Sessão Expirada');
                         
                         window.location='/';
                      </script>";
                exit;
            }

            if(empty($_SESSION["usuarioAtual"]["login"]) && !empty($_SESSION["usuarioLogado"]) && !in_array(basename($_SERVER['PHP_SELF']), ["empresas-relacionadas.php", "loga-empresa-relacionada.php", "loga-responsavel.php"])){
                header("Location: /empresas-relacionadas");
            }
        }

        parent::__construct();
    }

    /**
     * Fecha a conexao com o BD
     *
     * @return void
     */
    function fecharConexao()
    {
        $conexao = new Conexao();
        $conexao->close();
    }

    /**
     * Recupera as configurações de produção
     *
     * @return string[]
     */
    function getConfigProducao()
    {
        $aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);
        return $aConfig['producao'];
    }

    /**
     * Recupera as configurações de conexão LDAP
     *
     * @return string[]
     */
    function getConfigLDAP()
    {
        $aConfig = parse_ini_file(dirname(__FILE__) . "/core/config.ini", true);
        return $aConfig['LDAP'];
    }

    /**
     * Cria instancia para a classe seguranca
     *
     * @return Seguranca
     */
    function get_seguranca()
    {
        return new Seguranca();
    }

    /**
     * Autentica o Usuario
     * @param string $login
     * @param string $senha
     * @return object
     */
    /*
    function autenticaUsuario($login, $senha){

        $oUsuarioBD = new UsuarioBD();
        $oSeguranca = $this->get_seguranca();
        $oUsuario = $oUsuarioBD->autenticaUsuario($login, $senha);
        if(!$oUsuario){
            $this->msg = $oUsuarioBD->msg;
            return false;
        }

        $_SESSION['usuarioAtual'] = $oUsuario;
        //print "<pre>"; print_r($oUsuario); print "</pre>";
        // ========== Carregando Coleção dos Grupos do Usuário ==========
        //print_r($this->getAllGruposUsuario($resultado->get_idUsuario()));
        $_SESSION['aGrupoUsuario'] = $oSeguranca->getAllGruposUsuario($oUsuario->oPessoa->idPessoa);
        if(count($_SESSION['aGrupoUsuario']) > 0){
            $_SESSION['aMenu'] = $oSeguranca->menuUsuario($_SESSION['aGrupoUsuario']);
        } else {
            $this->msg = "Nenhum dado de permissão de acesso cadastrado";
            return false;
        }
        unset($oUsuario);

        return true;
    }*/

    /**
     * Autentica a Empresa
     * @param string $cnpj
     * @param string $senha
     * @return object
     */


    function autenticaEmpresa($cnpj, $senha)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->autenticaEmpresa($cnpj, $senha);
    }

    function enviaEmailResponsavelAssinatura($oResponsavel, $cnpj){

        require_once(dirname(__FILE__) .'/../phpMailer/PHPMailerAutoload.php');

        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

        $mail->CharSet = 'UTF-8';

        $mail->SMTPDebug = 0;

        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.sudam.gov.br';

        $mail->Port = 25;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "siav@sudam.gov.br";

        $mail->Password = "siav*2017";

        $mail->setFrom('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addReplyTo('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addAddress($oResponsavel->email);

        $mail->Subject = "SIAV - Avaliação de documento";

        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');

        $mail->Body = "Existe um documento atribuído a você no Sistema de Avaliação de Incentivos Fiscais referente a empresa de  CNPJ <b>".Util::formataCNPJ($cnpj)."</b> pendente de assinatura, <a href='http://siav.sudam.gov.br/' >acesse o link</a> para acessar o sistema e avaliar os dados.";

        $mail->IsHTML(true); // send as HTML

        $mail->Send();
    }


    function enviaEmailCadastroResponsavel($oResponsavel, $cnpj){

        require_once(dirname(__FILE__) .'/../phpMailer/PHPMailerAutoload.php');

        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false,'verify_peer_name' => false,'allow_self_signed' => true));

        $mail->CharSet = 'UTF-8';

        $mail->SMTPDebug = 0;

        $mail->Debugoutput = 'html';

        $mail->Host = 'smtp.sudam.gov.br';

        $mail->Port = 25;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "siav@sudam.gov.br";

        $mail->Password = "siav*2017";

        $mail->setFrom('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addReplyTo('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addAddress($oResponsavel->email);

        $mail->Subject = "SIAV - Pré-cadastro";

        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');

        $mail->Body = "Você foi pré-cadastrado como responsável pelas informações do CNPJ ".Util::formataCNPJ($cnpj)." no sistema de avaliação de incentivos fiscais, <a href='http://siav.sudam.gov.br/cadastro-externo-responsavel?token=".md5($oResponsavel->idResponsaveis)."' >conclua seu cadastro</a> para poder realizar futuras avaliações.";

        $mail->IsHTML(true); // send as HTML

        $mail->Send();
    }


    /**
     * Autentica o Responsavel
     * @param string $login
     * @param string $senha
     * @return object
     */


    function autenticaResponsavel($login, $senha)
    {
        $oResponsavel = $this->getRowResponsaveisEmpresa([
            "(responsaveis.cpf_passaporte = '{$login}' OR responsaveis.login = '{$login}')",
            "responsaveis.senha = md5('{$senha}')",
            "responsaveis.situacao = 1",
            "responsaveis_empresa.situacao = 1"
        ]);



        if($oResponsavel instanceof ResponsaveisEmpresa){
            $_SESSION['usuarioAtual'] =[
                "tipo_perfil" => "responsavel",
                "idResponsaveis" => $oResponsavel->oResponsaveis->idResponsaveis,
                "cnpj" => $oResponsavel->cnpj,
                "cpf_passaporte" => $oResponsavel->oResponsaveis->cpf_passaporte,
                "nome" => $oResponsavel->oResponsaveis->nome,
                "login" => $oResponsavel->oResponsaveis->login
            ];

            return true;
        } else {
            $this->msg = "Usuário ou Senha inválido(a)";

            return false;
        }
    }


    function isUserCtiCgav()
    {
        return true;

        foreach ($_SESSION["usuarioAtual"]["permissoes"] as $userGroup) {

            if ((strpos(strtolower($userGroup), "ou=cti") !== false) || (strpos(strtolower($userGroup), "ou=cgav") !== false) || (strpos(strtolower($userGroup), "ou=cti_grp") !== false) || (strpos(strtolower($userGroup), "ou=stefanini") !== false))
                return true;
        }

        $this->msg = "Não tem permissão";
        return false;
    }


    /**
     * Autentica o Usuario via LDAP
     * @param string $login
     * @param string $senha
     * @return object
     */
    function autenticaUsuarioLDAP($login, $senha)
    {
        $aConfig = $this->getConfigLDAP();

        try {
            // Conexão com servidor AD.
            $ad = ldap_connect($aConfig['servidor']);

            // Versao do protocolo
            ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Usara as referencias do servidor AD, neste caso nao
            ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);

            // Bind to the directory server.
            $bd = @ldap_bind($ad, $aConfig['dominio'] . "\\" . $login, $senha) or die("Não foi possível pesquisa no AD.");
            if ($bd) {
                //die("$login, $senha");
                // DEFINE O DN DO SERVIDOR LDAP
                $dn = "ou={$aConfig['dominio']}, dc={$aConfig['dominio']}, dc={$aConfig['dc']}";
                $filter = "(|(member=$login)(sAMAccountName=$login))";
                //$filter = "(|(sn=$usuario*)(givenname=$usuario*)(uid=$usuario))";
                // EXECUTA O FILTRO NO SERVIDOR LDAP
                //print "$ad, $dn, $filter";
                $sr = ldap_search($ad, $dn, $filter);
                // PEGA AS INFORMAÇÕES QUE O FILTRO RETORNOU

                $info = ldap_get_entries($ad, $sr);

                $_SESSION['usuarioAtual']['login'] = $info[0]['samaccountname'][0];
                $_SESSION['usuarioAtual']['email'] = $info[0]['mail'][0];
                $_SESSION['usuarioAtual']['nome'] = $info[0]['displayname'][0];
                $_SESSION['usuarioAtual']['permissoes'] = $info[0]['memberof'];
                //Util::trace($info);

                // ======== Formatando data vinda via LDAP ===========
                $fileTime = $info[0]['lastlogon'][0];
                $winSecs = (int)($fileTime / 10000000); // divide by 10 000 000 to get seconds
                $unixTimestamp = ($winSecs - 11644473600); // 1.1.1600 -> 1.1.1970 difference in seconds

                $_SESSION['usuarioAtual']['ultimoLogon'] = date("d/m/Y h:i:s", $unixTimestamp);

                //Util::trace($_SESSION['usuarioAtual']); exit;
            } else {
                $this->msg = "Não conectado ao Servidor.";
                return false;
            }
            return true;

        } catch (Exception $e) {
            $this->msg = $e->getMessage();
            return false;
        }
//        $_SESSION['usuarioAtual']['login'] 	= 'raquel.ohashi';
//        $_SESSION['usuarioAtual']['email'] 	=  'raqohashi@gmail.com';
//               $_SESSION['usuarioAtual']['nome'] 	= 'Raquel Ohashi';

        return true;
    }
// ============ Funcoes de Cadastro ==================

    /**
     * Cadastrar Acionista
     *
     * @access public
     * @return bool
     */
    public function cadastraAcionista()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAcionista();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAcionista($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oAcionista = new Acionista($idAcionista, $oEmpresa, $nome, $cpfCnpj, $cnpj_padrao, $tipoPessoa, $email, $estrangeiro, $passaporte, $funcao, $dataHoraAlteracao, $usuarioAlteracao);
        $oAcionistaBD = new AcionistaBD();
        if (!$id = $oAcionistaBD->inserir($oAcionista)) {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Alerta
     *
     * @access public
     * @return bool
     */
    public function cadastraAlerta()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAlerta();
        // Util::trace($post);
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAlerta($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oAlerta = new Alerta($idAlerta, $oCampanha, $assunto, $texto, $tipoSelecao, $totalEmpresas, $situacao, $usuarioAlteracao, $dataHoraAlteracao);
        $oAlertaBD = new AlertaBD();

        $oAlerta->texto = $_POST["alerta"]["texto"];

        if (!$id = $oAlertaBD->inserir($oAlerta)) {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;

    }

    /**
     * Cadastrar Arquivo
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivo();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivo($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oArquivo = new Arquivo($idArquivo, $nomeArquivo, $novoNome, $dataImportacao, $situacao, $status, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoBD = new ArquivoBD();
        if (!$oArquivoBD->inserir($oArquivo)) {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Arquivoempresa
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoempresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoempresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oTipoarquivo = new Tipoarquivo($idTipoArquivo);
        $oArquivoempresa = new Arquivoempresa($idArquivoEmpresa, $oEmpresa, $oTipoarquivo, $nomeArquivo, $novoNome, $descricao, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoempresaBD = new ArquivoempresaBD();
        if (!$oArquivoempresaBD->inserir($oArquivoempresa)) {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Arquivopolitica
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivopolitica()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivopolitica();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivopolitica($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oPoliticaambiental = new Politicaambiental($idPolitica);
        $oArquivopolitica = new Arquivopolitica($idArquivoPol, $oPoliticaambiental, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        if (!$oArquivopoliticaBD->inserir($oArquivopolitica)) {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Arquivoprojeto
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivoprojeto()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoprojeto();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoprojeto($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oProjsocioambiental = new Projsocioambiental($idProjeto);
        $oArquivoprojeto = new Arquivoprojeto($idArquivoProj, $oProjsocioambiental, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if (!$oArquivoprojetoBD->inserir($oArquivoprojeto)) {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Arquivopesquisa
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivopesquisa($params = NULL){
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivopesquisa($params);
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroArquivopesquisa($post)){
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oPesquisadesenvolvimento = new Pesquisadesenvolvimento($idPesquisa);
        $oArquivopesquisa = new Arquivopesquisa($idArquivoPesq,$oPesquisadesenvolvimento,$nomeArquivo,$novoNome,$link,$dataHoraAlteracao,$usuarioAlteracao);
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if(!$oArquivopesquisaBD->inserir($oArquivopesquisa)){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }


    /**
     * Cadastrar Arquivoretificacao
     *
     * @access public
     * @return bool
     */
    public function cadastraArquivoretificacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoretificacao();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoretificacao($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oArquivoretificacao = new Arquivoretificacao($idArqRet, $oRetificacaoempresa, $cnpj, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if (!$oArquivoretificacaoBD->inserir($oArquivoretificacao)) {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Atodeclaratorio
     *
     * @access public
     * @return bool
     */
    public function cadastraAtodeclaratorio()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAtodeclaratorio();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAtodeclaratorio($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa);
        $oAtodeclaratorio = new Atodeclaratorio($idAtoDeclaratorio, $oIncentivoempresa, $nomeArquivo, $novoNome, $dataHoraAlteracao, $usuarioAlteracao);
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if (!$oAtodeclaratorioBD->inserir($oAtodeclaratorio)) {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Autenticacaoempresa
     *
     * @access public
     * @return bool
     */
    public function cadastraAutenticacaoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAutenticacaoempresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAutenticacaoempresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oAutenticacaoempresa = new Autenticacaoempresa($idAutenticacao, $cnpj, $senha, $email, $senhaProv);
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if (!$oAutenticacaoempresaBD->inserir($oAutenticacaoempresa)) {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Cadastrofinanceiro
     *
     * @access public
     * @return bool
     */
    public function cadastraCadastrofinanceiro()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroCadastrofinanceiro();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroCadastrofinanceiro($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oCadastrofinanceiro = new Cadastrofinanceiro($idCadastroFinanceiro, $oEmpresa, $ehEstimado, $faturamentoBruto, $imobilizadoTotal, $reservaExercicio, $irDescontada, $valorIcms, $valorIssqn, $empregosDiretos, $despesaTerceiro, $terceirizadosExistentes, $pessoasEncargos, $impostosTaxasContribuicoes, $remuneracaoCapitalTerceiros, $remuneracaoCapitalProprio, $investimentoCapitalFixo, $faturamentoProdIncentivados, $reservaInvestimento, $valorIRtotal, $capitalGiro, $capitalFixo, $maoObraDireta, $maoObraIndiretaFixa, $maoObraReal, $recursosProprios, $previsaoIsencao, $acionistas, $totalReinvestimento, $valorDescontoIR, $reservaIncentivo, $dataHoraAlteracao, $usuarioAlteracao);
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if (!$id = $oCadastrofinanceiroBD->inserir($oCadastrofinanceiro)) {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Campanha
     *
     * @access public
     * @return bool
     */
    public function cadastraCampanha()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroCampanha();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroCampanha($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha, $campanha, $anoBase, $dataInicio, $dataFim, $totalEmpresas, $situacao, $usuarioAlteracao, $dataHoraAlteracao);
        $oCampanhaBD = new CampanhaBD();
        if (!$id = $oCampanhaBD->inserir($oCampanha)) {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Contatoempresa
     *
     * @access public
     * @return bool
     */
    public function cadastraContatoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroContatoempresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroContatoempresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oContatoempresa = new Contatoempresa($idContatoEmpresa, $oEmpresa, $contato, $funcao, $email, $telefone, $dataHoraAlteracao, $usuarioAlteracao);
        $oContatoempresaBD = new ContatoempresaBD();
        if (!$id = $oContatoempresaBD->inserir($oContatoempresa)) {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Detalhearquivo
     *
     * @access public
     * @return bool
     */
    public function cadastraDetalhearquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroDetalhearquivo();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroDetalhearquivo($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oArquivo = new Arquivo($idArquivo);
        $oDetalhearquivo = new Detalhearquivo($idDetalheArquivo, $oArquivo, $descricao, $linha);
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if (!$oDetalhearquivoBD->inserir($oDetalhearquivo)) {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Empresa
     *
     * @access public
     * @return bool
     */
    public function cadastraEmpresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oMunicipio = new Municipio($idMunicipio);
        $oSituacao = new Situacao($idSituacao);
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade);
        $oEmpresa = new Empresa($idEmpresa, $oMunicipio, $oSituacao, $oIncentivos, $oModalidade, $cnpj, $cnpjMatriz, $anoBase, $anoAprovacao, $razaoSocial, $telefone, $fax, $email, $fonteOrigem, $latitude, $longitude, $endereco, $numero, $complemento, $bairro, $cep, $setor, $enq, $numSudam, $procurador, $laudoData, $laudoNumero, $anoCalendario, $resolucaoData, $resolucaoNumero, $declaracaoData, $declaracaoNumero, $situacaoCadastro, $projetoSocial, $politicaAmbiental, $vigente, $anoVigencia, $dataHoraAlteracao, $usuarioAlteracao);
        $oEmpresaBD = new EmpresaBD();
        if (!$id = $oEmpresaBD->inserir($oEmpresa)) {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Empresaalerta
     *
     * @access public
     * @return bool
     */
    public function cadastraEmpresaalerta()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresaalerta();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresaalerta($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oAlerta = new Alerta($idAlerta);
        $oCampanha = new Campanha($idCampanha);
        $oEmpresaalerta = new Empresaalerta($idEmpresaAlerta, $oAlerta, $oCampanha, $cnpj);
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if (!$oEmpresaalertaBD->inserir($oEmpresaalerta)) {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Empresacampanha
     *
     * @access public
     * @return bool
     */
    public function cadastraEmpresacampanha()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresacampanha();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresacampanha($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresacampanha = new Empresacampanha($idEmpresaCampanha, $oCampanha, $cnpj, $status);
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if (!$oEmpresacampanhaBD->inserir($oEmpresacampanha)) {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Empresacontrole
     *
     * @access public
     * @return bool
     */
    public function cadastraEmpresacontrole()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresacontrole();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresacontrole($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresa = new Empresa($idEmpresa);
        $oEmpresacontrole = new Empresacontrole($idEmpresaControle, $oCampanha, $oEmpresa, $cnpj, $status, $dataInsercao, $dataAlteracao, $dataConclusao);
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if (!$oEmpresacontroleBD->inserir($oEmpresacontrole)) {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar HistoricoEdicaoEmail
     *
     * @access public
     * @return bool
     */
    public function cadastraHistoricoEdicaoEmail($post = null){
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroHistoricoEdicaoEmail($post);
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroHistoricoEdicaoEmail($post)){
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oHistoricoEdicaoEmail = new HistoricoEdicaoEmail($idHistoricoEdicaoEmail,$email_antigo,$email_novo,$usuario,$dt_alteracao,$cnpj);
        $oHistoricoEdicaoEmailBD = new HistoricoEdicaoEmailBD();
        if(!$oHistoricoEdicaoEmailBD->inserir($oHistoricoEdicaoEmail)){
            $this->msg = $oHistoricoEdicaoEmailBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Historicoretificacao
     *
     * @access public
     * @return bool
     */
    public function cadastraHistoricoretificacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroHistoricoretificacao();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroHistoricoretificacao($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oRetificacaosudam = new Retificacaosudam($idRetSudam);
        $oEmpresa = new Empresa($idEmpresa);
        $oHistoricoretificacao = new Historicoretificacao($idHistRet, $oRetificacaoempresa, $oRetificacaosudam, $oEmpresa, $idEmpresaRet, $anoBase, $cnpj, $status, $dataHoraAlteracao, $usuarioAlteracao);
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if (!$oHistoricoretificacaoBD->inserir($oHistoricoretificacao)) {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Incentivoempresa
     *
     * @access public
     * @return bool
     */
    public function cadastraIncentivoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivoempresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivoempresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade);
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa, $oEmpresa, $oIncentivos, $oModalidade, $produtoIncentivado, $fonteOrigem, $cnpj, $cnae, $faturamento, $emprego, $producao, $idUnidadeProducao, $capacidadeInstalada, $unidadeDescricao, $idUnidadeCapacidade, $ano, $vigente, $anoInicial, $anoFinal, $observacao, $dataHoraAlteracao, $usuarioAlteracao);
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if (!$oIncentivoempresa->idIncentivoEmpresa = $oIncentivoempresaBD->inserir($oIncentivoempresa)) {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $oIncentivoempresa->idIncentivoEmpresa;
    }

    /**
     * Cadastrar Incentivos
     *
     * @access public
     * @return bool
     */
    public function cadastraIncentivos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivos();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivos($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivos = new Incentivos($idIncentivo, $incentivo);
        $oIncentivosBD = new IncentivosBD();
        if (!$oIncentivosBD->inserir($oIncentivos)) {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Incentivosexcel
     *
     * @access public
     * @return bool
     */
    public function cadastraIncentivosexcel()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivosexcel();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivosexcel($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivosexcel = new Incentivosexcel($idincentivo, $sudam_numero, $empresa, $cnpj, $situacao, $municipio, $uf, $setor, $mob_di, $mob_in, $mob_real, $objetivo, $cap_instalada, $unidade, $incentivo, $modalidade, $procurador, $data_laudo, $numero_laudo, $capital_fixo, $capital_giro, $enq, $declaracao_data, $declaracao_numero, $resolucao_data, $resolucao_numero, $recursos_proprios, $sudam_irpj, $acionistas, $total);
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if (!$oIncentivosexcelBD->inserir($oIncentivosexcel)) {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Insumos
     *
     * @access public
     * @return bool
     */
    public function cadastraInsumos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroInsumos();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroInsumos($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oInsumos = new Insumos($idInsumo, $descricao);
        $oInsumosBD = new InsumosBD();
        if (!$oInsumosBD->inserir($oInsumos)) {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Mercadoconsumidor
     *
     * @access public
     * @return bool
     */
    public function cadastraMercadoconsumidor()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroMercadoconsumidor();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroMercadoconsumidor($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa);
        $oMercadoconsumidor = new Mercadoconsumidor($idMercado, $oIncentivoempresa, $quantidadeRegional, $valorRegional, $quantidadeNacional, $valorNacional, $quantidadeExterior, $valorExterior, $dataHoraAlteracao, $usuarioAlteracao);
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if (!$oMercadoconsumidorBD->inserir($oMercadoconsumidor)) {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Modalidade
     *
     * @access public
     * @return bool
     */
    public function cadastraModalidade()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroModalidade();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroModalidade($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade, $oIncentivos, $descricao);
        $oModalidadeBD = new ModalidadeBD();
        if (!$oModalidadeBD->inserir($oModalidade)) {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Municipio
     *
     * @access public
     * @return bool
     */
    public function cadastraMunicipio()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroMunicipio();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroMunicipio($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oMunicipio = new Municipio($idMunicipio, $regiao, $uf, $municipio, $microregiao, $tipologia, $status);
        $oMunicipioBD = new MunicipioBD();
        if (!$oMunicipioBD->inserir($oMunicipio)) {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Origeminsumos
     *
     * @access public
     * @return bool
     */
    public function cadastraOrigeminsumos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroOrigeminsumos();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroOrigeminsumos($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oInsumos = new Insumos($idInsumo);
        $oOrigeminsumos = new Origeminsumos($idOrigemInsumos, $oEmpresa, $oInsumos, $quantidadeRegional, $quantidadeNacional, $quantidadeExterior);
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if (!$id = $oOrigeminsumosBD->inserir($oOrigeminsumos)) {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Politicaambiental
     *
     * @access public
     * @return bool
     */
    public function cadastraPoliticaambiental()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroPoliticaambiental();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroPoliticaambiental($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oPoliticaambiental = new Politicaambiental($idPolitica, $oEmpresa, $residuosGerados, $descricaoTratamento, $quantGerado, $unidadeQg, $descricaoQg, $quantTratado, $unidadeQt, $descricaoQt, $dataHoraAlteracao, $usuarioAlteracao);
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if (!$id = $oPoliticaambientalBD->inserir($oPoliticaambiental)) {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Projsocioambiental
     *
     * @access public
     * @return bool
     */
    public function cadastraProjsocioambiental()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroProjsocioambiental();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroProjsocioambiental($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oProjsocioambiental = new Projsocioambiental($idProjeto, $oEmpresa, $nomeProjeto, $descricaoAtividade, $totalDespesas, $quantidadePessoas, $observacoes, $dataHoraAlteracao, $usuarioAlteracao);
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if (!$id = $oProjsocioambientalBD->inserir($oProjsocioambiental)) {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Pesquisadesenvolvimento
     *
     * @access public
     * @return bool
     */
    public function cadastraPesquisadesenvolvimento($params = NULL){
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroPesquisadesenvolvimento($params);
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroPesquisadesenvolvimento($post)){
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oPesquisadesenvolvimento = new Pesquisadesenvolvimento($idPesquisa,$oEmpresa,$nomeProjeto,$descricaoAtividade,$totalDespesas,$quantidadePessoas,$observacoes,$dataHoraAlteracao,$usuarioAlteracao);
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if(!$id = $oPesquisadesenvolvimentoBD->inserir($oPesquisadesenvolvimento)){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Retificacaoempresa
     *
     * @access public
     * @return bool
     */
    public function cadastraRetificacaoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroRetificacaoempresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroRetificacaoempresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa, $oEmpresa, $cnpj, $anoBase, $motivo, $justificativa, $status, $dataSolicitacao, $usuarioSolicitacao);
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if (!$id = $oRetificacaoempresaBD->inserir($oRetificacaoempresa)) {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Retificacaosudam
     *
     * @access public
     * @return bool
     */
    public function cadastraRetificacaosudam()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroRetificacaosudam();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroRetificacaosudam($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oRetificacaosudam = new Retificacaosudam($idRetSudam, $oRetificacaoempresa, $justificativa, $status, $dataAlteracao, $usuarioAlteracao);
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if (!$oRetificacaosudamBD->inserir($oRetificacaosudam)) {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Situacao
     *
     * @access public
     * @return bool
     */
    public function cadastraSituacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroSituacao();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroSituacao($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oSituacao = new Situacao($idSituacao, $situacao);
        $oSituacaoBD = new SituacaoBD();
        if (!$oSituacaoBD->inserir($oSituacao)) {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }


    /**
     * Cadastrar Termoresponsabilidade
     *
     * @access public
     * @return bool
     */
    public function cadastraTermoresponsabilidade()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroTermoresponsabilidade();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        /* $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroTermoresponsabilidade($post)){
            $this->msg = $oValidador->msg;
            return false;
        }*/
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresa = new Empresa($idEmpresa);
        $oTermoresponsabilidade = new Termoresponsabilidade($idTermo, $oCampanha, $oEmpresa, $cnpj, $comprovante, $dataHoraAlteracao, $usuarioAlteracao);
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if (!$id = $oTermoresponsabilidadeBD->inserir($oTermoresponsabilidade)) {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return $id;
    }

    /**
     * Cadastrar Tipoarquivo
     *
     * @access public
     * @return bool
     */
    public function cadastraTipoarquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroTipoarquivo();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroTipoarquivo($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oTipoarquivo = new Tipoarquivo($idTipoArquivo, $tipo, $formato);
        $oTipoarquivoBD = new TipoarquivoBD();
        if (!$oTipoarquivoBD->inserir($oTipoarquivo)) {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar Unidademedida
     *
     * @access public
     * @return bool
     */
    public function cadastraUnidademedida()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroUnidademedida();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroUnidademedida($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oUnidademedida = new Unidademedida($idUnidade, $nome, $sigla);
        $oUnidademedidaBD = new UnidademedidaBD();
        if (!$oUnidademedidaBD->inserir($oUnidademedida)) {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

// ============ Funcoes de Alteracao =================

    /**
     * Alterar dados de Acionista
     *
     * @access public
     * @return bool
     */
    public function alteraAcionista()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAcionista(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAcionista($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oAcionista = new Acionista($idAcionista, $oEmpresa, $nome, $cpfCnpj, $cnpj_padrao, $tipoPessoa, $email, $estrangeiro, $passaporte, $funcao, $dataHoraAlteracao, $usuarioAlteracao);
        $oAcionistaBD = new AcionistaBD();
        if (!$oAcionistaBD->alterar($oAcionista)) {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return $idAcionista;
    }

    /**
     * Alterar dados de Alerta
     *
     * @access public
     * @return bool
     */
    public function alteraAlerta()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAlerta(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAlerta($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oAlerta = new Alerta($idAlerta, $oCampanha, $assunto, $texto, $tipoSelecao, $totalEmpresas, $situacao, $usuarioAlteracao, $dataHoraAlteracao);
        $oAlertaBD = new AlertaBD();

        $oAlerta->texto = $_POST["alerta"]["texto"];

        if (!$oAlertaBD->alterar($oAlerta)) {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Arquivo
     *
     * @access public
     * @return bool
     */
    public function alteraArquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivo(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivo($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oArquivo = new Arquivo($idArquivo, $nomeArquivo, $novoNome, $dataImportacao, $situacao, $status, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoBD = new ArquivoBD();
        if (!$oArquivoBD->alterar($oArquivo)) {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Arquivoempresa
     *
     * @access public
     * @return bool
     */
    public function alteraArquivoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoempresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoempresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oTipoarquivo = new Tipoarquivo($idTipoArquivo);
        $oArquivoempresa = new Arquivoempresa($idArquivoEmpresa, $oEmpresa, $oTipoarquivo, $nomeArquivo, $novoNome, $descricao, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoempresaBD = new ArquivoempresaBD();
        if (!$oArquivoempresaBD->alterar($oArquivoempresa)) {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return true;
    }


    /**
     * Alterar dados de Arquivopolitica
     *
     * @access public
     * @return bool
     */
    public function alteraArquivopolitica()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivopolitica(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivopolitica($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oPoliticaambiental = new Politicaambiental($idPolitica);
        $oArquivopolitica = new Arquivopolitica($idArquivoPol, $oPoliticaambiental, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if (!$oArquivopoliticaBD->alterar($oArquivopolitica)) {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Arquivoprojeto
     *
     * @access public
     * @return bool
     */
    public function alteraArquivoprojeto()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoprojeto(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoprojeto($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oProjsocioambiental = new Projsocioambiental($idProjeto);
        $oArquivoprojeto = new Arquivoprojeto($idArquivoProj, $oProjsocioambiental, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if (!$oArquivoprojetoBD->alterar($oArquivoprojeto)) {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Arquivopesquisa
     *
     * @access public
     * @return bool
     */
    public function alteraArquivopesquisa($params = NULL){
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivopesquisa($params, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroArquivopesquisa($post,2)){
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oPesquisadesenvolvimento = new Pesquisadesenvolvimento($idPesquisa);
        $oArquivopesquisa = new Arquivopesquisa($idArquivoPesq,$oPesquisadesenvolvimento,$nomeArquivo,$novoNome,$link,$dataHoraAlteracao,$usuarioAlteracao);
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if(!$oArquivopesquisaBD->alterar($oArquivopesquisa)){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        return true;
    }


    /**
     * Alterar dados de Arquivoretificacao
     *
     * @access public
     * @return bool
     */
    public function alteraArquivoretificacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroArquivoretificacao(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroArquivoretificacao($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oArquivoretificacao = new Arquivoretificacao($idArqRet, $oRetificacaoempresa, $cnpj, $nomeArquivo, $novoNome, $link, $dataHoraAlteracao, $usuarioAlteracao);
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if (!$oArquivoretificacaoBD->alterar($oArquivoretificacao)) {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Atodeclaratorio
     *
     * @access public
     * @return bool
     */
    public function alteraAtodeclaratorio()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAtodeclaratorio(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAtodeclaratorio($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa);
        $oAtodeclaratorio = new Atodeclaratorio($idAtoDeclaratorio, $oIncentivoempresa, $nomeArquivo, $novoNome, $dataHoraAlteracao, $usuarioAlteracao);
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if (!$oAtodeclaratorioBD->alterar($oAtodeclaratorio)) {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Autenticacaoempresa
     *
     * @access public
     * @return bool
     */
    public function alteraAutenticacaoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroAutenticacaoempresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroAutenticacaoempresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oAutenticacaoempresa = new Autenticacaoempresa($idAutenticacao, $cnpj, $senha, $email, $senhaProv);
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if (!$oAutenticacaoempresaBD->alterar($oAutenticacaoempresa)) {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Cadastrofinanceiro
     *
     * @access public
     * @return bool
     */
    public function alteraCadastrofinanceiro()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroCadastrofinanceiro(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroCadastrofinanceiro($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oCadastrofinanceiro = new Cadastrofinanceiro($idCadastroFinanceiro, $oEmpresa, $ehEstimado, $faturamentoBruto, $imobilizadoTotal, $reservaExercicio, $irDescontada, $valorIcms, $valorIssqn, $empregosDiretos, $despesaTerceiro, $terceirizadosExistentes, $pessoasEncargos, $impostosTaxasContribuicoes, $remuneracaoCapitalTerceiros, $remuneracaoCapitalProprio, $investimentoCapitalFixo, $faturamentoProdIncentivados, $reservaInvestimento, $valorIRtotal, $capitalGiro, $capitalFixo, $maoObraDireta, $maoObraIndiretaFixa, $maoObraReal, $recursosProprios, $previsaoIsencao, $acionistas, $totalReinvestimento, $valorDescontoIR, $reservaIncentivo, $dataHoraAlteracao, $usuarioAlteracao);
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if (!$oCadastrofinanceiroBD->alterar($oCadastrofinanceiro)) {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $idCadastroFinanceiro;
    }

    /**
     * Alterar dados de Campanha
     *
     * @access public
     * @return bool
     */
    public function alteraCampanha()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroCampanha(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroCampanha($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha, $campanha, $anoBase, $dataInicio, $dataFim, $totalEmpresas, $situacao, $usuarioAlteracao, $dataHoraAlteracao);
        $oCampanhaBD = new CampanhaBD();
        if (!$oCampanhaBD->alterar($oCampanha)) {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $idCampanha;
    }

    /**
     * Alterar dados de Contatoempresa
     *
     * @access public
     * @return bool
     */
    public function alteraContatoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroContatoempresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroContatoempresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oContatoempresa = new Contatoempresa($idContatoEmpresa, $oEmpresa, $contato, $funcao, $email, $telefone, $dataHoraAlteracao, $usuarioAlteracao);
        $oContatoempresaBD = new ContatoempresaBD();
        if (!$oContatoempresaBD->alterar($oContatoempresa)) {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $idContatoEmpresa;
    }

    /**
     * Alterar dados de Detalhearquivo
     *
     * @access public
     * @return bool
     */
    public function alteraDetalhearquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroDetalhearquivo(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroDetalhearquivo($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oArquivo = new Arquivo($idArquivo);
        $oDetalhearquivo = new Detalhearquivo($idDetalheArquivo, $oArquivo, $descricao, $linha);
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if (!$oDetalhearquivoBD->alterar($oDetalhearquivo)) {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Empresa
     *
     * @access public
     * @return bool
     */
    public function alteraEmpresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oMunicipio = new Municipio($idMunicipio);
        $oSituacao = new Situacao($idSituacao);
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade);
        $oEmpresa = new Empresa($idEmpresa, $oMunicipio, $oSituacao, $oIncentivos, $oModalidade, $cnpj, $cnpjMatriz, $anoBase, $anoAprovacao, $razaoSocial, $telefone, $fax, $email, $fonteOrigem, $latitude, $longitude, $endereco, $numero, $complemento, $bairro, $cep, $setor, $enq, $numSudam, $procurador, $laudoData, $laudoNumero, $anoCalendario, $resolucaoData, $resolucaoNumero, $declaracaoData, $declaracaoNumero, $situacaoCadastro, $projetoSocial, $politicaAmbiental, $vigente, $anoVigencia, $dataHoraAlteracao, $usuarioAlteracao);
        $oEmpresaBD = new EmpresaBD();
        if (!$oEmpresaBD->alterar($oEmpresa)) {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $idEmpresa;
    }

    /**
     * Alterar dados de Empresaalerta
     *
     * @access public
     * @return bool
     */
    public function alteraEmpresaalerta()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresaalerta(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresaalerta($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oAlerta = new Alerta($idAlerta);
        $oCampanha = new Campanha($idCampanha);
        $oEmpresaalerta = new Empresaalerta($idEmpresaAlerta, $oAlerta, $oCampanha, $cnpj);
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if (!$oEmpresaalertaBD->alterar($oEmpresaalerta)) {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Empresacampanha
     *
     * @access public
     * @return bool
     */
    public function alteraEmpresacampanha()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresacampanha(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresacampanha($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresacampanha = new Empresacampanha($idEmpresaCampanha, $oCampanha, $cnpj, $status);
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if (!$oEmpresacampanhaBD->alterar($oEmpresacampanha)) {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Empresacontrole
     *
     * @access public
     * @return bool
     */
    public function alteraEmpresacontrole()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroEmpresacontrole(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroEmpresacontrole($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresa = new Empresa($idEmpresa);
        $oEmpresacontrole = new Empresacontrole($idEmpresaControle, $oCampanha, $oEmpresa, $cnpj, $status, $dataInsercao, $dataAlteracao, $dataConclusao);
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if (!$oEmpresacontroleBD->alterar($oEmpresacontrole)) {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Historicoretificacao
     *
     * @access public
     * @return bool
     */
    public function alteraHistoricoretificacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroHistoricoretificacao(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroHistoricoretificacao($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oRetificacaosudam = new Retificacaosudam($idRetSudam);
        $oEmpresa = new Empresa($idEmpresa);
        $oHistoricoretificacao = new Historicoretificacao($idHistRet, $oRetificacaoempresa, $oRetificacaosudam, $oEmpresa, $idEmpresaRet, $anoBase, $cnpj, $status, $dataHoraAlteracao, $usuarioAlteracao);
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if (!$oHistoricoretificacaoBD->alterar($oHistoricoretificacao)) {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Incentivoempresa
     *
     * @access public
     * @return bool
     */
    public function alteraIncentivoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivoempresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivoempresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade);
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa, $oEmpresa, $oIncentivos, $oModalidade, $produtoIncentivado, $fonteOrigem, $cnpj, $cnae, $faturamento, $emprego, $producao, $idUnidadeProducao, $capacidadeInstalada, $unidadeDescricao, $idUnidadeCapacidade, $ano, $vigente, $anoInicial, $anoFinal, $observacao, $dataHoraAlteracao, $usuarioAlteracao);
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if (!$oIncentivoempresaBD->alterar($oIncentivoempresa)) {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $idIncentivoEmpresa;
    }

    /**
     * Alterar dados de Incentivos
     *
     * @access public
     * @return bool
     */
    public function alteraIncentivos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivos(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivos($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivos = new Incentivos($idIncentivo, $incentivo);
        $oIncentivosBD = new IncentivosBD();
        if (!$oIncentivosBD->alterar($oIncentivos)) {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Incentivosexcel
     *
     * @access public
     * @return bool
     */
    public function alteraIncentivosexcel()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroIncentivosexcel(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroIncentivosexcel($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivosexcel = new Incentivosexcel($idincentivo, $sudam_numero, $empresa, $cnpj, $situacao, $municipio, $uf, $setor, $mob_di, $mob_in, $mob_real, $objetivo, $cap_instalada, $unidade, $incentivo, $modalidade, $procurador, $data_laudo, $numero_laudo, $capital_fixo, $capital_giro, $enq, $declaracao_data, $declaracao_numero, $resolucao_data, $resolucao_numero, $recursos_proprios, $sudam_irpj, $acionistas, $total);
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if (!$oIncentivosexcelBD->alterar($oIncentivosexcel)) {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Insumos
     *
     * @access public
     * @return bool
     */
    public function alteraInsumos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroInsumos(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroInsumos($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oInsumos = new Insumos($idInsumo, $descricao);
        $oInsumosBD = new InsumosBD();
        if (!$oInsumosBD->alterar($oInsumos)) {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Mercadoconsumidor
     *
     * @access public
     * @return bool
     */
    public function alteraMercadoconsumidor()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroMercadoconsumidor(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroMercadoconsumidor($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivoempresa = new Incentivoempresa($idIncentivoEmpresa);
        $oMercadoconsumidor = new Mercadoconsumidor($idMercado, $oIncentivoempresa, $quantidadeRegional, $valorRegional, $quantidadeNacional, $valorNacional, $quantidadeExterior, $valorExterior, $dataHoraAlteracao, $usuarioAlteracao);
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if (!$oMercadoconsumidorBD->alterar($oMercadoconsumidor)) {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return $idMercado;
    }

    /**
     * Alterar dados de Modalidade
     *
     * @access public
     * @return bool
     */
    public function alteraModalidade()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroModalidade(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroModalidade($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oIncentivos = new Incentivos($idIncentivo);
        $oModalidade = new Modalidade($idModalidade, $oIncentivos, $descricao);
        $oModalidadeBD = new ModalidadeBD();
        if (!$oModalidadeBD->alterar($oModalidade)) {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Municipio
     *
     * @access public
     * @return bool
     */
    public function alteraMunicipio()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroMunicipio(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroMunicipio($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oMunicipio = new Municipio($idMunicipio, $regiao, $uf, $municipio, $microregiao, $tipologia, $status);
        $oMunicipioBD = new MunicipioBD();
        if (!$oMunicipioBD->alterar($oMunicipio)) {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Origeminsumos
     *
     * @access public
     * @return bool
     */
    public function alteraOrigeminsumos()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroOrigeminsumos(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroOrigeminsumos($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oInsumos = new Insumos($idInsumo);
        $oOrigeminsumos = new Origeminsumos($idOrigemInsumos, $oEmpresa, $oInsumos, $quantidadeRegional, $quantidadeNacional, $quantidadeExterior);
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if (!$oOrigeminsumosBD->alterar($oOrigeminsumos)) {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $idOrigemInsumos;
    }

    /**
     * Alterar dados de Politicaambiental
     *
     * @access public
     * @return bool
     */
    public function alteraPoliticaambiental()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroPoliticaambiental(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroPoliticaambiental($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oPoliticaambiental = new Politicaambiental($idPolitica, $oEmpresa, $residuosGerados, $descricaoTratamento, $quantGerado, $unidadeQg, $descricaoQg, $quantTratado, $unidadeQt, $descricaoQt, $dataHoraAlteracao, $usuarioAlteracao);
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if (!$oPoliticaambientalBD->alterar($oPoliticaambiental)) {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return $idPolitica;
    }

    /**
     * Alterar dados de Projsocioambiental
     *
     * @access public
     * @return bool
     */
    public function alteraProjsocioambiental()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroProjsocioambiental(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroProjsocioambiental($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oProjsocioambiental = new Projsocioambiental($idProjeto, $oEmpresa, $nomeProjeto, $descricaoAtividade, $totalDespesas, $quantidadePessoas, $observacoes, $dataHoraAlteracao, $usuarioAlteracao);
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if (!$oProjsocioambientalBD->alterar($oProjsocioambiental)) {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $idProjeto;
    }

    /**
     * Alterar dados de Pesquisadesenvolvimento
     *
     * @access public
     * @return bool
     */
    public function alteraPesquisadesenvolvimento($params = NULL){
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroPesquisadesenvolvimento($params, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if(!$oValidador->validaFormularioCadastroPesquisadesenvolvimento($post,2)){
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oPesquisadesenvolvimento = new Pesquisadesenvolvimento($idPesquisa,$oEmpresa,$nomeProjeto,$descricaoAtividade,$totalDespesas,$quantidadePessoas,$observacoes,$dataHoraAlteracao,$usuarioAlteracao);
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if(!$oPesquisadesenvolvimentoBD->alterar($oPesquisadesenvolvimento)){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        return $idPesquisa;
    }

    /**
     * Alterar dados de Retificacaoempresa
     *
     * @access public
     * @return bool
     */
    public function alteraRetificacaoempresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroRetificacaoempresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroRetificacaoempresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oEmpresa = new Empresa($idEmpresa);
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa, $oEmpresa, $cnpj, $anoBase, $motivo, $justificativa, $status, $dataSolicitacao, $usuarioSolicitacao);
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if (!$oRetificacaoempresaBD->alterar($oRetificacaoempresa)) {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $idRetEmpresa;
    }

    /**
     * Alterar dados de Retificacaosudam
     *
     * @access public
     * @return bool
     */
    public function alteraRetificacaosudam()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroRetificacaosudam(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroRetificacaosudam($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oRetificacaoempresa = new Retificacaoempresa($idRetEmpresa);
        $oRetificacaosudam = new Retificacaosudam($idRetSudam, $oRetificacaoempresa, $justificativa, $status, $dataAlteracao, $usuarioAlteracao);
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if (!$oRetificacaosudamBD->alterar($oRetificacaosudam)) {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Situacao
     *
     * @access public
     * @return bool
     */
    public function alteraSituacao()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroSituacao(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroSituacao($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oSituacao = new Situacao($idSituacao, $situacao);
        $oSituacaoBD = new SituacaoBD();
        if (!$oSituacaoBD->alterar($oSituacao)) {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return true;
    }


    /**
     * Alterar dados de Termoresponsabilidade
     *
     * @access public
     * @return bool
     */
    public function alteraTermoresponsabilidade()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroTermoresponsabilidade(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroTermoresponsabilidade($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oCampanha = new Campanha($idCampanha);
        $oEmpresa = new Empresa($idEmpresa);
        $oTermoresponsabilidade = new Termoresponsabilidade($idTermo, $oCampanha, $oEmpresa, $cnpj, $comprovante, $dataHoraAlteracao, $usuarioAlteracao);
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if (!$oTermoresponsabilidadeBD->alterar($oTermoresponsabilidade)) {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return true;
    }


    /**
     * Alterar dados de Tipoarquivo
     *
     * @access public
     * @return bool
     */
    public function alteraTipoarquivo()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroTipoarquivo(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroTipoarquivo($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oTipoarquivo = new Tipoarquivo($idTipoArquivo, $tipo, $formato);
        $oTipoarquivoBD = new TipoarquivoBD();
        if (!$oTipoarquivoBD->alterar($oTipoarquivo)) {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de Unidademedida
     *
     * @access public
     * @return bool
     */
    public function alteraUnidademedida()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroUnidademedida(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroUnidademedida($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oUnidademedida = new Unidademedida($idUnidade, $nome, $sigla);
        $oUnidademedidaBD = new UnidademedidaBD();
        if (!$oUnidademedidaBD->alterar($oUnidademedida)) {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        return true;
    }

// ============ Funcoes de Exclusao =================

    /**
     * Excluir Acionista
     *
     * @access public
     * @param integer $idAcionista
     * @return bool
     */
    public function excluiAcionista($idAcionista)
    {
        $oAcionistaBD = new AcionistaBD();
        if (!$oAcionistaBD->excluir($idAcionista)) {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Alerta
     *
     * @access public
     * @param integer $idAlerta
     * @return bool
     */
    public function excluiAlerta($idAlerta)
    {
        $oAlertaBD = new AlertaBD();
        if (!$oAlertaBD->excluir($idAlerta)) {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivo
     *
     * @access public
     * @param integer $idArquivo
     * @return bool
     */
    public function excluiArquivo($idArquivo)
    {
        $oArquivoBD = new ArquivoBD();
        if (!$oArquivoBD->excluir($idArquivo)) {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivoempresa
     *
     * @access public
     * @param integer $idArquivoempresa
     * @return bool
     */
    public function excluiArquivoempresa($idArquivoempresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if (!$oArquivoempresaBD->excluir($idArquivoempresa)) {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivopolitica
     *
     * @access public
     * @param integer $idArquivopolitica
     * @return bool
     */
    public function excluiArquivopolitica($idArquivopolitica)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if (!$oArquivopoliticaBD->excluir($idArquivopolitica)) {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivoprojeto
     *
     * @access public
     * @param integer $idArquivoprojeto
     * @return bool
     */
    public function excluiArquivoprojeto($idArquivoprojeto)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if (!$oArquivoprojetoBD->excluir($idArquivoprojeto)) {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivopesquisa
     *
     * @access public
     * @param integer $idArquivopesquisa
     * @return bool
     */
    public function excluiArquivopesquisa($idArquivopesquisa){
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if(!$oArquivopesquisaBD->excluir($idArquivopesquisa)){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Arquivoretificacao
     *
     * @access public
     * @param integer $idArquivoretificacao
     * @return bool
     */
    public function excluiArquivoretificacao($idArquivoretificacao)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if (!$oArquivoretificacaoBD->excluir($idArquivoretificacao)) {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Atodeclaratorio
     *
     * @access public
     * @param integer $idAtodeclaratorio
     * @return bool
     */
    public function excluiAtodeclaratorio($idAtodeclaratorio)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if (!$oAtodeclaratorioBD->excluir($idAtodeclaratorio)) {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Autenticacaoempresa
     *
     * @access public
     * @param integer $idAutenticacaoempresa
     * @return bool
     */
    public function excluiAutenticacaoempresa($idAutenticacaoempresa)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if (!$oAutenticacaoempresaBD->excluir($idAutenticacaoempresa)) {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Cadastrofinanceiro
     *
     * @access public
     * @param integer $idCadastrofinanceiro
     * @return bool
     */
    public function excluiCadastrofinanceiro($idCadastrofinanceiro)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if (!$oCadastrofinanceiroBD->excluir($idCadastrofinanceiro)) {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Campanha
     *
     * @access public
     * @param integer $idCampanha
     * @return bool
     */
    public function excluiCampanha($idCampanha)
    {
        $oCampanhaBD = new CampanhaBD();
        if (!$oCampanhaBD->excluir($idCampanha)) {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Contatoempresa
     *
     * @access public
     * @param integer $idContatoempresa
     * @return bool
     */
    public function excluiContatoempresa($idContatoempresa)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        if (!$oContatoempresaBD->excluir($idContatoempresa)) {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Detalhearquivo
     *
     * @access public
     * @param integer $idDetalhearquivo
     * @return bool
     */
    public function excluiDetalhearquivo($idDetalhearquivo)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if (!$oDetalhearquivoBD->excluir($idDetalhearquivo)) {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Empresa
     *
     * @access public
     * @param integer $idEmpresa
     * @return bool
     */
    public function excluiEmpresa($idEmpresa)
    {
        $oEmpresaBD = new EmpresaBD();
        if (!$oEmpresaBD->excluir($idEmpresa)) {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Empresaalerta
     *
     * @access public
     * @param integer $idEmpresaalerta
     * @return bool
     */
    public function excluiEmpresaalerta($idEmpresaalerta)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if (!$oEmpresaalertaBD->excluir($idEmpresaalerta)) {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Empresacampanha
     *
     * @access public
     * @param integer $idEmpresacampanha
     * @return bool
     */
    public function excluiEmpresacampanha($idEmpresacampanha)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if (!$oEmpresacampanhaBD->excluir($idEmpresacampanha)) {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Empresacontrole
     *
     * @access public
     * @param integer $idEmpresacontrole
     * @return bool
     */
    public function excluiEmpresacontrole($idEmpresacontrole)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if (!$oEmpresacontroleBD->excluir($idEmpresacontrole)) {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Historicoretificacao
     *
     * @access public
     * @param integer $idHistoricoretificacao
     * @return bool
     */
    public function excluiHistoricoretificacao($idHistoricoretificacao)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if (!$oHistoricoretificacaoBD->excluir($idHistoricoretificacao)) {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Incentivoempresa
     *
     * @access public
     * @param integer $idIncentivoempresa
     * @return bool
     */
    public function excluiIncentivoempresa($idIncentivoempresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if (!$oIncentivoempresaBD->excluir($idIncentivoempresa)) {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Incentivos
     *
     * @access public
     * @param integer $idIncentivos
     * @return bool
     */
    public function excluiIncentivos($idIncentivos)
    {
        $oIncentivosBD = new IncentivosBD();
        if (!$oIncentivosBD->excluir($idIncentivos)) {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Incentivosexcel
     *
     * @access public
     * @param integer $idIncentivosexcel
     * @return bool
     */
    public function excluiIncentivosexcel($idIncentivosexcel)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if (!$oIncentivosexcelBD->excluir($idIncentivosexcel)) {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Insumos
     *
     * @access public
     * @param integer $idInsumos
     * @return bool
     */
    public function excluiInsumos($idInsumos)
    {
        $oInsumosBD = new InsumosBD();
        if (!$oInsumosBD->excluir($idInsumos)) {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Mercadoconsumidor
     *
     * @access public
     * @param integer $idMercadoconsumidor
     * @return bool
     */
    public function excluiMercadoconsumidor($idMercadoconsumidor)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if (!$oMercadoconsumidorBD->excluir($idMercadoconsumidor)) {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Modalidade
     *
     * @access public
     * @param integer $idModalidade
     * @return bool
     */
    public function excluiModalidade($idModalidade)
    {
        $oModalidadeBD = new ModalidadeBD();
        if (!$oModalidadeBD->excluir($idModalidade)) {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Municipio
     *
     * @access public
     * @param integer $idMunicipio
     * @return bool
     */
    public function excluiMunicipio($idMunicipio)
    {
        $oMunicipioBD = new MunicipioBD();
        if (!$oMunicipioBD->excluir($idMunicipio)) {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Origeminsumos
     *
     * @access public
     * @param integer $idOrigeminsumos
     * @return bool
     */
    public function excluiOrigeminsumos($idOrigeminsumos)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if (!$oOrigeminsumosBD->excluir($idOrigeminsumos)) {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Politicaambiental
     *
     * @access public
     * @param integer $idPoliticaambiental
     * @return bool
     */
    public function excluiPoliticaambiental($idPoliticaambiental)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if (!$oPoliticaambientalBD->excluir($idPoliticaambiental)) {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Projsocioambiental
     *
     * @access public
     * @param integer $idProjsocioambiental
     * @return bool
     */
    public function excluiProjsocioambiental($idProjsocioambiental)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if (!$oProjsocioambientalBD->excluir($idProjsocioambiental)) {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Pesquisadesenvolvimento
     *
     * @access public
     * @param integer $idPesquisadesenvolvimento
     * @return bool
     */
    public function excluiPesquisadesenvolvimento($idPesquisadesenvolvimento){
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if(!$oPesquisadesenvolvimentoBD->excluir($idPesquisadesenvolvimento)){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Retificacaoempresa
     *
     * @access public
     * @param integer $idRetificacaoempresa
     * @return bool
     */
    public function excluiRetificacaoempresa($idRetificacaoempresa)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if (!$oRetificacaoempresaBD->excluir($idRetificacaoempresa)) {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Retificacaosudam
     *
     * @access public
     * @param integer $idRetificacaosudam
     * @return bool
     */
    public function excluiRetificacaosudam($idRetificacaosudam)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if (!$oRetificacaosudamBD->excluir($idRetificacaosudam)) {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Situacao
     *
     * @access public
     * @param integer $idSituacao
     * @return bool
     */
    public function excluiSituacao($idSituacao)
    {
        $oSituacaoBD = new SituacaoBD();
        if (!$oSituacaoBD->excluir($idSituacao)) {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Termoresponsabilidade
     *
     * @access public
     * @param integer $idTermoresponsabilidade
     * @return bool
     */
    public function excluiTermoresponsabilidade($idTermoresponsabilidade)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if (!$oTermoresponsabilidadeBD->excluir($idTermoresponsabilidade)) {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Tipoarquivo
     *
     * @access public
     * @param integer $idTipoarquivo
     * @return bool
     */
    public function excluiTipoarquivo($idTipoarquivo)
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        if (!$oTipoarquivoBD->excluir($idTipoarquivo)) {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir Unidademedida
     *
     * @access public
     * @param integer $idUnidademedida
     * @return bool
     */
    public function excluiUnidademedida($idUnidademedida)
    {
        $oUnidademedidaBD = new UnidademedidaBD();
        if (!$oUnidademedidaBD->excluir($idUnidademedida)) {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        return true;
    }

// ============ Funcoes de Selecao =================

    /**
     * Selecionar registro de EmpresaCampanhaResponsaveis
     *
     * @access public
     * @param integer $idEmpresaCampanhaResponsaveis
     * @return EmpresaCampanhaResponsaveis
     */
    public function getEmpresaCampanhaResponsaveis($idEmpresaCampanhaResponsaveis){
        $oEmpresaCampanhaResponsaveisBD = new EmpresaCampanhaResponsaveisBD();
        if($oEmpresaCampanhaResponsaveisBD->msg != ''){
            $this->msg = $oEmpresaCampanhaResponsaveisBD->msg;
            return false;
        }
        return $oEmpresaCampanhaResponsaveisBD->get($idEmpresaCampanhaResponsaveis);
    }

    /**
     * Selecionar registro de Acionista
     *
     * @access public
     * @param integer $idAcionista
     * @return Acionista
     */
    public function getAcionista($idAcionista)
    {
        $oAcionistaBD = new AcionistaBD();
        if ($oAcionistaBD->msg != '') {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return $oAcionistaBD->get($idAcionista);
    }

    /**
     * Selecionar registro de Alerta
     *
     * @access public
     * @param integer $idAlerta
     * @return Alerta
     */
    public function getAlerta($idAlerta)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->get($idAlerta);
    }

    /**
     * Selecionar registro de Arquivo
     *
     * @access public
     * @param integer $idArquivo
     * @return Arquivo
     */
    public function getArquivo($idArquivo)
    {
        $oArquivoBD = new ArquivoBD();
        if ($oArquivoBD->msg != '') {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return $oArquivoBD->get($idArquivo);
    }

    /**
     * Selecionar registro de Arquivoempresa
     *
     * @access public
     * @param integer $idArquivoEmpresa
     * @return Arquivoempresa
     */
    public function getArquivoempresa($idArquivoEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->get($idArquivoEmpresa);
    }

    /**
     * Selecionar registro de Arquivopolitica
     *
     * @access public
     * @param integer $idArquivoPol
     * @return Arquivopolitica
     */
    public function getArquivopolitica($idArquivoPol)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if ($oArquivopoliticaBD->msg != '') {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return $oArquivopoliticaBD->get($idArquivoPol);
    }

    /**
     * Selecionar registro de Arquivoprojeto
     *
     * @access public
     * @param integer $idArquivoProj
     * @return Arquivoprojeto
     */
    public function getArquivoprojeto($idArquivoProj)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if ($oArquivoprojetoBD->msg != '') {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return $oArquivoprojetoBD->get($idArquivoProj);
    }

    /**
     * Selecionar registro de Arquivopesquisa
     *
     * @access public
     * @param integer $idArquivoPesq
     * @return Arquivopesquisa
     */
    public function getArquivopesquisa($idArquivoPesq){
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if($oArquivopesquisaBD->msg != ''){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        return $oArquivopesquisaBD->get($idArquivoPesq);
    }

    /**
     * Selecionar registro de Arquivoretificacao
     *
     * @access public
     * @param integer $idArqRet
     * @return Arquivoretificacao
     */
    public function getArquivoretificacao($idArqRet)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if ($oArquivoretificacaoBD->msg != '') {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return $oArquivoretificacaoBD->get($idArqRet);
    }

    /**
     * Selecionar registro de Atodeclaratorio
     *
     * @access public
     * @param integer $idAtoDeclaratorio
     * @return Atodeclaratorio
     */
    public function getAtodeclaratorio($idAtoDeclaratorio)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if ($oAtodeclaratorioBD->msg != '') {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return $oAtodeclaratorioBD->get($idAtoDeclaratorio);
    }

    /**
     * Selecionar registro de Autenticacaoempresa
     *
     * @access public
     * @param integer $idAutenticacao
     * @return Autenticacaoempresa
     */
    public function getAutenticacaoempresa($idAutenticacao)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->get($idAutenticacao);
    }

    /**
     * Selecionar registro de Cadastrofinanceiro
     *
     * @access public
     * @param integer $idCadastroFinanceiro
     * @return Cadastrofinanceiro
     */
    public function getCadastrofinanceiro($idCadastroFinanceiro)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if ($oCadastrofinanceiroBD->msg != '') {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $oCadastrofinanceiroBD->get($idCadastroFinanceiro);
    }

    /**
     * Selecionar registro de Campanha
     *
     * @access public
     * @param integer $idCampanha
     * @return Campanha
     */
    public function getCampanha($idCampanha)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->get($idCampanha);
    }

    /**
     * Selecionar registro de Contatoempresa
     *
     * @access public
     * @param integer $idContatoEmpresa
     * @return Contatoempresa
     */
    public function getContatoempresa($idContatoEmpresa)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        if ($oContatoempresaBD->msg != '') {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $oContatoempresaBD->get($idContatoEmpresa);
    }

    /**
     * Selecionar registro de Detalhearquivo
     *
     * @access public
     * @param integer $idDetalheArquivo
     * @return Detalhearquivo
     */
    public function getDetalhearquivo($idDetalheArquivo)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if ($oDetalhearquivoBD->msg != '') {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return $oDetalhearquivoBD->get($idDetalheArquivo);
    }

    /**
     * Selecionar registro de Empresa
     *
     * @access public
     * @param integer $idEmpresa
     * @return Empresa
     */
    public function getEmpresa($idEmpresa)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->get($idEmpresa);
    }

    /**
     * Selecionar registro de Empresaalerta
     *
     * @access public
     * @param integer $idEmpresaAlerta
     * @return Empresaalerta
     */
    public function getEmpresaalerta($idEmpresaAlerta)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if ($oEmpresaalertaBD->msg != '') {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return $oEmpresaalertaBD->get($idEmpresaAlerta);
    }

    /**
     * Selecionar registro de Empresacampanha
     *
     * @access public
     * @param integer $idEmpresaCampanha
     * @return Empresacampanha
     */
    public function getEmpresacampanha($idEmpresaCampanha)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->get($idEmpresaCampanha);
    }

    /**
     * Selecionar registro de Empresacontrole
     *
     * @access public
     * @param integer $idEmpresaControle
     * @return Empresacontrole
     */
    public function getEmpresacontrole($idEmpresaControle)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->get($idEmpresaControle);
    }

    /**
     * Selecionar registro de HistoricoEdicaoEmail
     *
     * @access public
     * @param integer $idHistoricoEdicaoEmail
     * @return HistoricoEdicaoEmail
     */
    public function getHistoricoEdicaoEmail($idHistoricoEdicaoEmail){
        $oHistoricoEdicaoEmailBD = new HistoricoEdicaoEmailBD();
        if($oHistoricoEdicaoEmailBD->msg != ''){
            $this->msg = $oHistoricoEdicaoEmailBD->msg;
            return false;
        }
        return $oHistoricoEdicaoEmailBD->get($idHistoricoEdicaoEmail);
    }

    /**
     * Selecionar registro de Historicoretificacao
     *
     * @access public
     * @param integer $idHistRet
     * @return Historicoretificacao
     */
    public function getHistoricoretificacao($idHistRet)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->get($idHistRet);
    }

    /**
     * Selecionar registro de Incentivoempresa
     *
     * @access public
     * @param integer $idIncentivoEmpresa
     * @return Incentivoempresa
     */
    public function getIncentivoempresa($idIncentivoEmpresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->get($idIncentivoEmpresa);
    }

    /**
     * Selecionar registro de Incentivos
     *
     * @access public
     * @param integer $idIncentivo
     * @return Incentivos
     */
    public function getIncentivos($idIncentivo)
    {
        $oIncentivosBD = new IncentivosBD();
        if ($oIncentivosBD->msg != '') {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        return $oIncentivosBD->get($idIncentivo);
    }

    /**
     * Selecionar registro de Incentivosexcel
     *
     * @access public
     * @param integer $idincentivo
     * @return Incentivosexcel
     */
    public function getIncentivosexcel($idincentivo)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if ($oIncentivosexcelBD->msg != '') {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return $oIncentivosexcelBD->get($idincentivo);
    }

    /**
     * Selecionar registro de Insumos
     *
     * @access public
     * @param integer $idInsumo
     * @return Insumos
     */
    public function getInsumos($idInsumo)
    {
        $oInsumosBD = new InsumosBD();
        if ($oInsumosBD->msg != '') {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return $oInsumosBD->get($idInsumo);
    }

    /**
     * Selecionar registro de Mercadoconsumidor
     *
     * @access public
     * @param integer $idMercado
     * @return Mercadoconsumidor
     */
    public function getMercadoconsumidor($idMercado)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if ($oMercadoconsumidorBD->msg != '') {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return $oMercadoconsumidorBD->get($idMercado);
    }

    /**
     * Selecionar registro de Modalidade
     *
     * @access public
     * @param integer $idModalidade
     * @return Modalidade
     */
    public function getModalidade($idModalidade)
    {
        $oModalidadeBD = new ModalidadeBD();
        if ($oModalidadeBD->msg != '') {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return $oModalidadeBD->get($idModalidade);
    }

    /**
     * Selecionar registro de Municipio
     *
     * @access public
     * @param integer $idMunicipio
     * @return Municipio
     */
    public function getMunicipio($idMunicipio)
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->get($idMunicipio);
    }

    /**
     * Selecionar registro de Origeminsumos
     *
     * @access public
     * @param integer $idOrigemInsumos
     * @return Origeminsumos
     */
    public function getOrigeminsumos($idOrigemInsumos)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if ($oOrigeminsumosBD->msg != '') {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $oOrigeminsumosBD->get($idOrigemInsumos);
    }

    /**
     * Selecionar registro de Politicaambiental
     *
     * @access public
     * @param integer $idPolitica
     * @return Politicaambiental
     */
    public function getPoliticaambiental($idPolitica)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if ($oPoliticaambientalBD->msg != '') {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return $oPoliticaambientalBD->get($idPolitica);
    }

    /**
     * Selecionar registro de Projsocioambiental
     *
     * @access public
     * @param integer $idProjeto
     * @return Projsocioambiental
     */
    public function getProjsocioambiental($idProjeto)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if ($oProjsocioambientalBD->msg != '') {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $oProjsocioambientalBD->get($idProjeto);
    }

    /**
     * Selecionar registro de Pesquisadesenvolvimento
     *
     * @access public
     * @param integer $idPesquisa
     * @return Pesquisadesenvolvimento
     */
    public function getPesquisadesenvolvimento($idPesquisa){
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if($oPesquisadesenvolvimentoBD->msg != ''){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        return $oPesquisadesenvolvimentoBD->get($idPesquisa);
    }

    /**
     * Selecionar registro de Retificacaoempresa
     *
     * @access public
     * @param integer $idRetEmpresa
     * @return Retificacaoempresa
     */
    public function getRetificacaoempresa($idRetEmpresa)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->get($idRetEmpresa);
    }

    /**
     * Selecionar registro de Retificacaosudam
     *
     * @access public
     * @param integer $idRetSudam
     * @return Retificacaosudam
     */
    public function getRetificacaosudam($idRetSudam)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->get($idRetSudam);
    }

    /**
     * Selecionar registro de Situacao
     *
     * @access public
     * @param integer $idSituacao
     * @return Situacao
     */
    public function getSituacao($idSituacao)
    {
        $oSituacaoBD = new SituacaoBD();
        if ($oSituacaoBD->msg != '') {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return $oSituacaoBD->get($idSituacao);
    }

    /**
     * Selecionar registro de Termoresponsabilidade
     *
     * @access public
     * @param integer $idTermo
     * @return Termoresponsabilidade
     */
    public function getTermoresponsabilidade($idTermo)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->get($idTermo);
    }

    /**
     * Selecionar registro de Tipoarquivo
     *
     * @access public
     * @param integer $idTipoArquivo
     * @return Tipoarquivo
     */
    public function getTipoarquivo($idTipoArquivo)
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        if ($oTipoarquivoBD->msg != '') {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return $oTipoarquivoBD->get($idTipoArquivo);
    }

    /**
     * Selecionar registro de Unidademedida
     *
     * @access public
     * @param integer $idUnidade
     * @return Unidademedida
     */
    public function getUnidademedida($idUnidade)
    {
        $oUnidademedidaBD = new UnidademedidaBD();
        if ($oUnidademedidaBD->msg != '') {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        return $oUnidademedidaBD->get($idUnidade);
    }

    // ============ Funcoes de Cadastro ==================

    /**
     * Cadastrar Responsaveis
     *
     * @access public
     * @return bool
     */
    public function cadastraResponsaveis()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveis();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveis($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis, $nome, $estrangeiro, $cpf_passaporte, $rg, $orgao_expedidor, $cidade, $estado, $cep, $endereco, $email, $cargo, $conselho_regional, $login, $senha, $arquivo, $situacao, $data_cad_externo, $data_cad_empresa);
        $oResponsaveisBD = new ResponsaveisBD();
        if (!$oResponsaveisBD->inserir($oResponsaveis)) {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar ResponsaveisAssinaturas
     *
     * @access public
     * @return bool
     */
    public function cadastraResponsaveisAssinaturas()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveisAssinaturas();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveisAssinaturas($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis);
        $oResponsaveisAssinaturas = new ResponsaveisAssinaturas($idResponsaveisAssinaturas, $oResponsaveis, $cnpj, $data_assinatura, $tipo_documento, $situacao);
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if (!$oResponsaveisAssinaturasBD->inserir($oResponsaveisAssinaturas)) {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

    /**
     * Cadastrar ResponsaveisEmpresa
     *
     * @access public
     * @return bool
     */
    public function cadastraResponsaveisEmpresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveisEmpresa();
        $_SESSION["post"] = $post;
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveisEmpresa($post)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis);
        $oResponsaveisEmpresa = new ResponsaveisEmpresa($oResponsaveis, $cnpj, $data_vinculo, $situacao);
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if (!$oResponsaveisEmpresaBD->inserir($oResponsaveisEmpresa)) {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        unset($_SESSION["post"]);
        return true;
    }

// ============ Funcoes de Alteracao =================

    /**
     * Alterar dados de Responsaveis
     *
     * @access public
     * @return bool
     */
    public function alteraResponsaveis()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveis(NULL, 2);

        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveis($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis, $nome, $estrangeiro, $cpf_passaporte, $rg, $orgao_expedidor, $cidade, $estado, $cep, $endereco, $email, $cargo, $conselho_regional, $login, $senha, $arquivo, $situacao, $data_cad_externo, $data_cad_empresa);

        $oResponsaveisBD = new ResponsaveisBD();
        if (!$oResponsaveisBD->alterar($oResponsaveis)) {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de ResponsaveisAssinaturas
     *
     * @access public
     * @return bool
     */
    public function alteraResponsaveisAssinaturas()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveisAssinaturas(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveisAssinaturas($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis);
        $oResponsaveisAssinaturas = new ResponsaveisAssinaturas($idResponsaveisAssinaturas, $oResponsaveis, $cnpj, $data_assinatura, $tipo_documento, $situacao);
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if (!$oResponsaveisAssinaturasBD->alterar($oResponsaveisAssinaturas)) {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Alterar dados de ResponsaveisEmpresa
     *
     * @access public
     * @return bool
     */
    public function alteraResponsaveisEmpresa()
    {
        // recebe dados do formulario
        $post = DadosFormulario::formularioCadastroResponsaveisEmpresa(NULL, 2);
        // valida dados do formulario
        $oValidador = new ValidadorFormulario();
        if (!$oValidador->validaFormularioCadastroResponsaveisEmpresa($post, 2)) {
            $this->msg = $oValidador->msg;
            return false;
        }
        // cria variaveis para validacao com as chaves do array
        foreach ($post as $i => $v) $$i = $v;
        // cria objeto para grava-lo no BD
        $oResponsaveis = new Responsaveis($idResponsaveis);
        $oResponsaveisEmpresa = new ResponsaveisEmpresa($oResponsaveis, $cnpj, $data_vinculo, $situacao);
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if (!$oResponsaveisEmpresaBD->alterar($oResponsaveisEmpresa)) {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        return true;
    }

// ============ Funcoes de Exclusao =================

    /**
     * Excluir Responsaveis
     *
     * @access public
     * @param integer $idResponsaveis
     * @return bool
     */
    public function excluiResponsaveis($idResponsaveis)
    {
        $oResponsaveisBD = new ResponsaveisBD();
        if (!$oResponsaveisBD->excluir($idResponsaveis)) {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir ResponsaveisAssinaturas
     *
     * @access public
     * @param integer $idResponsaveisAssinaturas
     * @return bool
     */
    public function excluiResponsaveisAssinaturas($idResponsaveisAssinaturas)
    {
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if (!$oResponsaveisAssinaturasBD->excluir($idResponsaveisAssinaturas)) {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        return true;
    }

    /**
     * Excluir ResponsaveisEmpresa
     *
     * @access public
     * @param integer $idResponsaveisEmpresa
     * @return bool
     */
    public function excluiResponsaveisEmpresa($idResponsaveisEmpresa)
    {
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if (!$oResponsaveisEmpresaBD->excluir($idResponsaveisEmpresa)) {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        return true;
    }

// ============ Funcoes de Selecao =================

    /**
     * Selecionar registro de Responsaveis
     *
     * @access public
     * @param integer $idResponsaveis
     * @return Responsaveis
     */
    public function getResponsaveis($idResponsaveis)
    {
        $oResponsaveisBD = new ResponsaveisBD();
        if ($oResponsaveisBD->msg != '') {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        return $oResponsaveisBD->get($idResponsaveis);
    }

    /**
     * Selecionar registro de ResponsaveisAssinaturas
     *
     * @access public
     * @param integer $idResponsaveisAssinaturas
     * @return ResponsaveisAssinaturas
     */
    public function getResponsaveisAssinaturas($idResponsaveisAssinaturas)
    {
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if ($oResponsaveisAssinaturasBD->msg != '') {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        return $oResponsaveisAssinaturasBD->get($idResponsaveisAssinaturas);
    }

    /**
     * Selecionar registro de ResponsaveisEmpresa
     *
     * @access public
     * @return ResponsaveisEmpresa
     */
    public function getResponsaveisEmpresa()
    {
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if ($oResponsaveisEmpresaBD->msg != '') {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        return $oResponsaveisEmpresaBD->get();
    }

// ============ Funcoes de Colecao =================


    /**
     * Carregar Colecao de dados de EmpresaCampanhaResponsaveis
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return EmpresaCampanhaResponsaveis[]
     */
    public function getAllEmpresaCampanhaResponsaveis($aFiltro = NULL, $aOrdenacao = NULL){
        $oEmpresaCampanhaResponsaveisBD = new EmpresaCampanhaResponsaveisBD($this->oConn);
        if($oEmpresaCampanhaResponsaveisBD->msg != ''){
            $this->msg = $oEmpresaCampanhaResponsaveisBD->msg;
            return false;
        }
        return $oEmpresaCampanhaResponsaveisBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo EmpresaCampanhaResponsaveis
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return EmpresaCampanhaResponsaveis
     */
    public function getRowEmpresaCampanhaResponsaveis($aFiltro = NULL, $aOrdenacao = NULL){
        $oEmpresaCampanhaResponsaveisBD = new EmpresaCampanhaResponsaveisBD();
        if($oEmpresaCampanhaResponsaveisBD->msg != ''){
            $this->msg = $oEmpresaCampanhaResponsaveisBD->msg;
            return false;
        }
        return $oEmpresaCampanhaResponsaveisBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Responsaveis
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Responsaveis[]
     */
    public function getAllResponsaveis($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisBD = new ResponsaveisBD();
        if ($oResponsaveisBD->msg != '') {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        return $oResponsaveisBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Responsaveis
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Responsaveis[]
     */
    public function getRowResponsaveis($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisBD = new ResponsaveisBD();
        if ($oResponsaveisBD->msg != '') {
            $this->msg = $oResponsaveisBD->msg;
            return false;
        }
        return $oResponsaveisBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de ResponsaveisAssinaturas
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return ResponsaveisAssinaturas[]
     */
    public function getAllResponsaveisAssinaturas($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if ($oResponsaveisAssinaturasBD->msg != '') {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        return $oResponsaveisAssinaturasBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo ResponsaveisAssinaturas
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return ResponsaveisAssinaturas[]
     */
    public function getRowResponsaveisAssinaturas($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        if ($oResponsaveisAssinaturasBD->msg != '') {
            $this->msg = $oResponsaveisAssinaturasBD->msg;
            return false;
        }
        return $oResponsaveisAssinaturasBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de ResponsaveisEmpresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return ResponsaveisEmpresa[]
     */
    public function getAllResponsaveisEmpresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if ($oResponsaveisEmpresaBD->msg != '') {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        return $oResponsaveisEmpresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo ResponsaveisEmpresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return ResponsaveisEmpresa[]
     */
    public function getRowResponsaveisEmpresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        if ($oResponsaveisEmpresaBD->msg != '') {
            $this->msg = $oResponsaveisEmpresaBD->msg;
            return false;
        }
        return $oResponsaveisEmpresaBD->getRow($aFiltro, $aOrdenacao);
    }

// ============ Funcoes de Consulta =================

    /**
     * Consultar registros de Responsaveis
     *
     * @access public
     * @param string $valor
     * @return Responsaveis
     */
    public function consultarResponsaveis($valor)
    {
        $oResponsaveisBD = new ResponsaveisBD();
        return $oResponsaveisBD->consultar($valor);
    }

    /**
     * Consultar registros de ResponsaveisAssinaturas
     *
     * @access public
     * @param string $valor
     * @return ResponsaveisAssinaturas
     */
    public function consultarResponsaveisAssinaturas($valor)
    {
        $oResponsaveisAssinaturasBD = new ResponsaveisAssinaturasBD();
        return $oResponsaveisAssinaturasBD->consultar($valor);
    }

    /**
     * Consultar registros de ResponsaveisEmpresa
     *
     * @access public
     * @param string $valor
     * @return ResponsaveisEmpresa
     */
    public function consultarResponsaveisEmpresa($valor)
    {
        $oResponsaveisEmpresaBD = new ResponsaveisEmpresaBD();
        return $oResponsaveisEmpresaBD->consultar($valor);
    }

// ============ Funcoes de Colecao =================

    /**
     * Carregar Colecao de dados de Acionista
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Acionista[]
     */
    public function getAllAcionista($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAcionistaBD = new AcionistaBD($this->oConn);
        if ($oAcionistaBD->msg != '') {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return $oAcionistaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Acionista
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Acionista[]
     */
    public function getRowAcionista($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAcionistaBD = new AcionistaBD();
        if ($oAcionistaBD->msg != '') {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return $oAcionistaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Alerta
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Alerta[]
     */
    public function getAllAlerta($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Alerta
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Alerta[]
     */
    public function getRowAlerta($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Arquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivo[]
     */
    public function getAllArquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoBD = new ArquivoBD();
        if ($oArquivoBD->msg != '') {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return $oArquivoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Arquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivo[]
     */
    public function getRowArquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoBD = new ArquivoBD();
        if ($oArquivoBD->msg != '') {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return $oArquivoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Arquivoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoempresa[]
     */
    public function getAllArquivoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Arquivoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoempresa[]
     */
    public function getRowArquivoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Arquivopolitica
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivopolitica[]
     */
    public function getAllArquivopolitica($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if ($oArquivopoliticaBD->msg != '') {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return $oArquivopoliticaBD->getAll($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Arquivopesquisa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivopesquisa[]
     */
    public function getAllArquivopesquisa($aFiltro = NULL, $aOrdenacao = NULL){
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if($oArquivopesquisaBD->msg != ''){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        return $oArquivopesquisaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Arquivopolitica
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivopolitica[]
     */
    public function getRowArquivopolitica($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if ($oArquivopoliticaBD->msg != '') {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return $oArquivopoliticaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Arquivoprojeto
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoprojeto[]
     */
    public function getAllArquivoprojeto($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if ($oArquivoprojetoBD->msg != '') {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return $oArquivoprojetoBD->getAll($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Objeto do tipo Arquivopesquisa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivopesquisa
     */
    public function getRowArquivopesquisa($aFiltro = NULL, $aOrdenacao = NULL){
        $oArquivopesquisaBD = new ArquivopesquisaBD($this->_conexao);
        if($oArquivopesquisaBD->msg != ''){
            $this->msg = $oArquivopesquisaBD->msg;
            return false;
        }
        return $oArquivopesquisaBD->getRow($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Arquivoprojeto
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoprojeto[]
     */
    public function getRowArquivoprojeto($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if ($oArquivoprojetoBD->msg != '') {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return $oArquivoprojetoBD->getRow($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Colecao de dados de Arquivoretificacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoretificacao[]
     */
    public function getAllArquivoretificacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if ($oArquivoretificacaoBD->msg != '') {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return $oArquivoretificacaoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Arquivoretificacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Arquivoretificacao[]
     */
    public function getRowArquivoretificacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if ($oArquivoretificacaoBD->msg != '') {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return $oArquivoretificacaoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Atodeclaratorio
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Atodeclaratorio[]
     */
    public function getAllAtodeclaratorio($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if ($oAtodeclaratorioBD->msg != '') {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return $oAtodeclaratorioBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Atodeclaratorio
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Atodeclaratorio
     */
    public function getRowAtodeclaratorio($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if ($oAtodeclaratorioBD->msg != '') {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return $oAtodeclaratorioBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Autenticacaoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Autenticacaoempresa[]
     */
    public function getAllAutenticacaoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Autenticacaoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Autenticacaoempresa
     */
    public function getRowAutenticacaoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Cadastrofinanceiro
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Cadastrofinanceiro[]
     */
    public function getAllCadastrofinanceiro($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if ($oCadastrofinanceiroBD->msg != '') {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $oCadastrofinanceiroBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Cadastrofinanceiro
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Cadastrofinanceiro
     */
    public function getRowCadastrofinanceiro($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD($this->oConn);
        if ($oCadastrofinanceiroBD->msg != '') {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $oCadastrofinanceiroBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Campanha
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Campanha[]
     */
    public function getAllCampanha($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Campanha
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Campanha
     */
    public function getRowCampanha($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Contatoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Contatoempresa[]
     */
    public function getAllContatoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oContatoempresaBD = new ContatoempresaBD($this->oConn);
        if ($oContatoempresaBD->msg != '') {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $oContatoempresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Contatoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Contatoempresa[]
     */
    public function getRowContatoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        if ($oContatoempresaBD->msg != '') {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $oContatoempresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Detalhearquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Detalhearquivo[]
     */
    public function getAllDetalhearquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if ($oDetalhearquivoBD->msg != '') {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return $oDetalhearquivoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Detalhearquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Detalhearquivo[]
     */
    public function getRowDetalhearquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if ($oDetalhearquivoBD->msg != '') {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return $oDetalhearquivoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Empresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresa[]
     */
    public function getAllEmpresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Empresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresa[]
     */
    public function getRowEmpresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Empresaalerta
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresaalerta[]
     */
    public function getAllEmpresaalerta($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if ($oEmpresaalertaBD->msg != '') {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return $oEmpresaalertaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Empresaalerta
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresaalerta[]
     */
    public function getRowEmpresaalerta($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if ($oEmpresaalertaBD->msg != '') {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return $oEmpresaalertaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Empresacampanha
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresacampanha[]
     */
    public function getAllEmpresacampanha($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Empresacampanha
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresacampanha
     */
    public function getRowEmpresacampanha($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Empresacontrole
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresacontrole[]
     */
    public function getAllEmpresacontrole($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Empresacontrole
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Empresacontrole
     */
    public function getRowEmpresacontrole($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de HistoricoEdicaoEmail
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return HistoricoEdicaoEmail[]
     */
    public function getAllHistoricoEdicaoEmail($aFiltro = NULL, $aOrdenacao = NULL){
        $oHistoricoEdicaoEmailBD = new HistoricoEdicaoEmailBD();
        if($oHistoricoEdicaoEmailBD->msg != ''){
            $this->msg = $oHistoricoEdicaoEmailBD->msg;
            return false;
        }
        return $oHistoricoEdicaoEmailBD->getAll($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Historicoretificacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Historicoretificacao[]
     */
    public function getAllHistoricoretificacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo HistoricoEdicaoEmail
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return HistoricoEdicaoEmail
     */
    public function getRowHistoricoEdicaoEmail($aFiltro = NULL, $aOrdenacao = NULL){
        $oHistoricoEdicaoEmailBD = new HistoricoEdicaoEmailBD();
        if($oHistoricoEdicaoEmailBD->msg != ''){
            $this->msg = $oHistoricoEdicaoEmailBD->msg;
            return false;
        }
        return $oHistoricoEdicaoEmailBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Objeto do tipo Historicoretificacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Historicoretificacao[]
     */
    public function getRowHistoricoretificacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Incentivoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivoempresa[]
     */
    public function getAllIncentivoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Incentivoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivoempresa[]
     */
    public function getRowIncentivoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Incentivos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivos[]
     */
    public function getAllIncentivos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivosBD = new IncentivosBD();
        if ($oIncentivosBD->msg != '') {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        return $oIncentivosBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Incentivos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivos[]
     */
    public function getRowIncentivos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivosBD = new IncentivosBD();
        if ($oIncentivosBD->msg != '') {
            $this->msg = $oIncentivosBD->msg;
            return false;
        }
        return $oIncentivosBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Incentivosexcel
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivosexcel[]
     */
    public function getAllIncentivosexcel($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if ($oIncentivosexcelBD->msg != '') {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return $oIncentivosexcelBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Incentivosexcel
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Incentivosexcel[]
     */
    public function getRowIncentivosexcel($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if ($oIncentivosexcelBD->msg != '') {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return $oIncentivosexcelBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Insumos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Insumos[]
     */
    public function getAllInsumos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oInsumosBD = new InsumosBD();
        if ($oInsumosBD->msg != '') {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return $oInsumosBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Insumos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Insumos[]
     */
    public function getRowInsumos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oInsumosBD = new InsumosBD();
        if ($oInsumosBD->msg != '') {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return $oInsumosBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Mercadoconsumidor
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Mercadoconsumidor[]
     */
    public function getAllMercadoconsumidor($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD($this->oConn);
        if ($oMercadoconsumidorBD->msg != '') {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return $oMercadoconsumidorBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Mercadoconsumidor
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Mercadoconsumidor[]
     */
    public function getRowMercadoconsumidor($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if ($oMercadoconsumidorBD->msg != '') {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return $oMercadoconsumidorBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Modalidade
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Modalidade[]
     */
    public function getAllModalidade($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oModalidadeBD = new ModalidadeBD();
        if ($oModalidadeBD->msg != '') {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return $oModalidadeBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Modalidade
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Modalidade[]
     */
    public function getRowModalidade($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oModalidadeBD = new ModalidadeBD();
        if ($oModalidadeBD->msg != '') {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return $oModalidadeBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Municipio
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Municipio[]
     */
    public function getAllMunicipio($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Municipio
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Municipio[]
     */
    public function getRowMunicipio($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Origeminsumos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Origeminsumos[]
     */
    public function getAllOrigeminsumos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD($this->oConn);
        if ($oOrigeminsumosBD->msg != '') {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $oOrigeminsumosBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Origeminsumos
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Origeminsumos[]
     */
    public function getRowOrigeminsumos($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if ($oOrigeminsumosBD->msg != '') {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $oOrigeminsumosBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Politicaambiental
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Politicaambiental[]
     */
    public function getAllPoliticaambiental($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD($this->oConn);
        if ($oPoliticaambientalBD->msg != '') {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return $oPoliticaambientalBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Politicaambiental
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Politicaambiental[]
     */
    public function getRowPoliticaambiental($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if ($oPoliticaambientalBD->msg != '') {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return $oPoliticaambientalBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Projsocioambiental
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Projsocioambiental[]
     */
    public function getAllProjsocioambiental($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD($this->oConn);
        if ($oProjsocioambientalBD->msg != '') {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $oProjsocioambientalBD->getAll($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Pesquisadesenvolvimento
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Pesquisadesenvolvimento[]
     */
    public function getAllPesquisadesenvolvimento($aFiltro = NULL, $aOrdenacao = NULL){
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if($oPesquisadesenvolvimentoBD->msg != ''){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        return $oPesquisadesenvolvimentoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Projsocioambiental
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Projsocioambiental[]
     */
    public function getRowProjsocioambiental($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if ($oProjsocioambientalBD->msg != '') {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $oProjsocioambientalBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Objeto do tipo Pesquisadesenvolvimento
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Pesquisadesenvolvimento
     */
    public function getRowPesquisadesenvolvimento($aFiltro = NULL, $aOrdenacao = NULL){
        $oPesquisadesenvolvimentoBD = new PesquisadesenvolvimentoBD($this->_conexao);
        if($oPesquisadesenvolvimentoBD->msg != ''){
            $this->msg = $oPesquisadesenvolvimentoBD->msg;
            return false;
        }
        return $oPesquisadesenvolvimentoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Retificacaoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Retificacaoempresa[]
     */
    public function getAllRetificacaoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Retificacaoempresa
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Retificacaoempresa[]
     */
    public function getRowRetificacaoempresa($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Retificacaosudam
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Retificacaosudam[]
     */
    public function getAllRetificacaosudam($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Retificacaosudam
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Retificacaosudam[]
     */
    public function getRowRetificacaosudam($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Situacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Situacao[]
     */
    public function getAllSituacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oSituacaoBD = new SituacaoBD();
        if ($oSituacaoBD->msg != '') {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return $oSituacaoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Situacao
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Situacao[]
     */
    public function getRowSituacao($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oSituacaoBD = new SituacaoBD();
        if ($oSituacaoBD->msg != '') {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return $oSituacaoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Termoresponsabilidade
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Termoresponsabilidade[]
     */
    public function getAllTermoresponsabilidade($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Termoresponsabilidade
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Termoresponsabilidade[]
     */
    public function getRowTermoresponsabilidade($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->getRow($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Colecao de dados de Tipoarquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Tipoarquivo[]
     */
    public function getAllTipoarquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        if ($oTipoarquivoBD->msg != '') {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return $oTipoarquivoBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Tipoarquivo
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Tipoarquivo[]
     */
    public function getRowTipoarquivo($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        if ($oTipoarquivoBD->msg != '') {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return $oTipoarquivoBD->getRow($aFiltro, $aOrdenacao);
    }

    /**
     * Carregar Colecao de dados de Unidademedida
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Unidademedida[]
     */
    public function getAllUnidademedida($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oUnidademedidaBD = new UnidademedidaBD();
        if ($oUnidademedidaBD->msg != '') {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        return $oUnidademedidaBD->getAll($aFiltro, $aOrdenacao);
    }


    /**
     * Carregar Objeto do tipo Unidademedida
     *
     * @access public
     * @param string[] $aFiltro Filtro de consulta
     * @param string[] $aOrdenacao Ordenação dos campos
     * @return Unidademedida[]
     */
    public function getRowUnidademedida($aFiltro = NULL, $aOrdenacao = NULL)
    {
        $oUnidademedidaBD = new UnidademedidaBD();
        if ($oUnidademedidaBD->msg != '') {
            $this->msg = $oUnidademedidaBD->msg;
            return false;
        }
        return $oUnidademedidaBD->getRow($aFiltro, $aOrdenacao);
    }

// ============ Funcoes de Consulta =================

    /**
     * Consultar registros de Acionista
     *
     * @access public
     * @param string $valor
     * @return Acionista
     */
    public function consultarAcionista($valor)
    {
        $oAcionistaBD = new AcionistaBD();
        return $oAcionistaBD->consultar($valor);
    }

    /**
     * Consultar registros de Alerta
     *
     * @access public
     * @param string $valor
     * @return Alerta
     */
    public function consultarAlerta($valor)
    {
        $oAlertaBD = new AlertaBD();
        return $oAlertaBD->consultar($valor);
    }

    /**
     * Consultar registros de Arquivo
     *
     * @access public
     * @param string $valor
     * @return Arquivo
     */
    public function consultarArquivo($valor)
    {
        $oArquivoBD = new ArquivoBD();
        return $oArquivoBD->consultar($valor);
    }

    /**
     * Consultar registros de Arquivoempresa
     *
     * @access public
     * @param string $valor
     * @return Arquivoempresa
     */
    public function consultarArquivoempresa($valor)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        return $oArquivoempresaBD->consultar($valor);
    }


    /**
     * Consultar registros de Arquivopolitica
     *
     * @access public
     * @param string $valor
     * @return Arquivopolitica
     */
    public function consultarArquivopolitica($valor)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        return $oArquivopoliticaBD->consultar($valor);
    }

    /**
     * Consultar registros de Arquivoprojeto
     *
     * @access public
     * @param string $valor
     * @return Arquivoprojeto
     */
    public function consultarArquivoprojeto($valor)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        return $oArquivoprojetoBD->consultar($valor);
    }


    /**
     * Consultar registros de Arquivoretificacao
     *
     * @access public
     * @param string $valor
     * @return Arquivoretificacao
     */
    public function consultarArquivoretificacao($valor)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        return $oArquivoretificacaoBD->consultar($valor);
    }

    /**
     * Consultar registros de Atodeclaratorio
     *
     * @access public
     * @param string $valor
     * @return Atodeclaratorio
     */
    public function consultarAtodeclaratorio($valor)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        return $oAtodeclaratorioBD->consultar($valor);
    }

    /**
     * Consultar registros de Autenticacaoempresa
     *
     * @access public
     * @param string $valor
     * @return Autenticacaoempresa
     */
    public function consultarAutenticacaoempresa($valor)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        return $oAutenticacaoempresaBD->consultar($valor);
    }

    /**
     * Consultar registros de Cadastrofinanceiro
     *
     * @access public
     * @param string $valor
     * @return Cadastrofinanceiro
     */
    public function consultarCadastrofinanceiro($valor)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        return $oCadastrofinanceiroBD->consultar($valor);
    }

    /**
     * Consultar registros de Campanha
     *
     * @access public
     * @param string $valor
     * @return Campanha
     */
    public function consultarCampanha($valor)
    {
        $oCampanhaBD = new CampanhaBD();
        return $oCampanhaBD->consultar($valor);
    }

    /**
     * Consultar registros de Contatoempresa
     *
     * @access public
     * @param string $valor
     * @return Contatoempresa
     */
    public function consultarContatoempresa($valor)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        return $oContatoempresaBD->consultar($valor);
    }

    /**
     * Consultar registros de Detalhearquivo
     *
     * @access public
     * @param string $valor
     * @return Detalhearquivo
     */
    public function consultarDetalhearquivo($valor)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        return $oDetalhearquivoBD->consultar($valor);
    }

    /**
     * Consultar registros de Empresa
     *
     * @access public
     * @param string $valor
     * @return Empresa
     */
    public function consultarEmpresa($valor)
    {
        $oEmpresaBD = new EmpresaBD();
        return $oEmpresaBD->consultar($valor);
    }

    /**
     * Consultar registros de Empresaalerta
     *
     * @access public
     * @param string $valor
     * @return Empresaalerta
     */
    public function consultarEmpresaalerta($valor)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        return $oEmpresaalertaBD->consultar($valor);
    }

    /**
     * Consultar registros de Empresacampanha
     *
     * @access public
     * @param string $valor
     * @return Empresacampanha
     */
    public function consultarEmpresacampanha($valor)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        return $oEmpresacampanhaBD->consultar($valor);
    }

    /**
     * Consultar registros de Empresacontrole
     *
     * @access public
     * @param string $valor
     * @return Empresacontrole
     */
    public function consultarEmpresacontrole($valor)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        return $oEmpresacontroleBD->consultar($valor);
    }

    /**
     * Consultar registros de Historicoretificacao
     *
     * @access public
     * @param string $valor
     * @return Historicoretificacao
     */
    public function consultarHistoricoretificacao($valor)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        return $oHistoricoretificacaoBD->consultar($valor);
    }

    /**
     * Consultar registros de Incentivoempresa
     *
     * @access public
     * @param string $valor
     * @return Incentivoempresa
     */
    public function consultarIncentivoempresa($valor)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        return $oIncentivoempresaBD->consultar($valor);
    }

    /**
     * Consultar registros de Incentivos
     *
     * @access public
     * @param string $valor
     * @return Incentivos
     */
    public function consultarIncentivos($valor)
    {
        $oIncentivosBD = new IncentivosBD();
        return $oIncentivosBD->consultar($valor);
    }

    /**
     * Consultar registros de Incentivosexcel
     *
     * @access public
     * @param string $valor
     * @return Incentivosexcel
     */
    public function consultarIncentivosexcel($valor)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        return $oIncentivosexcelBD->consultar($valor);
    }

    /**
     * Consultar registros de Insumos
     *
     * @access public
     * @param string $valor
     * @return Insumos
     */
    public function consultarInsumos($valor)
    {
        $oInsumosBD = new InsumosBD();
        return $oInsumosBD->consultar($valor);
    }

    /**
     * Consultar registros de Mercadoconsumidor
     *
     * @access public
     * @param string $valor
     * @return Mercadoconsumidor
     */
    public function consultarMercadoconsumidor($valor)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        return $oMercadoconsumidorBD->consultar($valor);
    }

    /**
     * Consultar registros de Modalidade
     *
     * @access public
     * @param string $valor
     * @return Modalidade
     */
    public function consultarModalidade($valor)
    {
        $oModalidadeBD = new ModalidadeBD();
        return $oModalidadeBD->consultar($valor);
    }

    /**
     * Consultar registros de Municipio
     *
     * @access public
     * @param string $valor
     * @return Municipio
     */
    public function consultarMunicipio($valor)
    {
        $oMunicipioBD = new MunicipioBD();
        return $oMunicipioBD->consultar($valor);
    }

    /**
     * Consultar registros de Origeminsumos
     *
     * @access public
     * @param string $valor
     * @return Origeminsumos
     */
    public function consultarOrigeminsumos($valor)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        return $oOrigeminsumosBD->consultar($valor);
    }

    /**
     * Consultar registros de Politicaambiental
     *
     * @access public
     * @param string $valor
     * @return Politicaambiental
     */
    public function consultarPoliticaambiental($valor)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD();
        return $oPoliticaambientalBD->consultar($valor);
    }

    /**
     * Consultar registros de Projsocioambiental
     *
     * @access public
     * @param string $valor
     * @return Projsocioambiental
     */
    public function consultarProjsocioambiental($valor)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        return $oProjsocioambientalBD->consultar($valor);
    }

    /**
     * Consultar registros de Retificacaoempresa
     *
     * @access public
     * @param string $valor
     * @return Retificacaoempresa
     */
    public function consultarRetificacaoempresa($valor)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        return $oRetificacaoempresaBD->consultar($valor);
    }

    /**
     * Consultar registros de Retificacaosudam
     *
     * @access public
     * @param string $valor
     * @return Retificacaosudam
     */
    public function consultarRetificacaosudam($valor)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        return $oRetificacaosudamBD->consultar($valor);
    }

    /**
     * Consultar registros de Situacao
     *
     * @access public
     * @param string $valor
     * @return Situacao
     */
    public function consultarSituacao($valor)
    {
        $oSituacaoBD = new SituacaoBD();
        return $oSituacaoBD->consultar($valor);
    }

    /**
     * Consultar registros de Termoresponsabilidade
     *
     * @access public
     * @param string $valor
     * @return Termoresponsabilidade
     */
    public function consultarTermoresponsabilidade($valor)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        return $oTermoresponsabilidadeBD->consultar($valor);
    }

    /**
     * Consultar registros de Tipoarquivo
     *
     * @access public
     * @param string $valor
     * @return Tipoarquivo
     */
    public function consultarTipoarquivo($valor)
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        return $oTipoarquivoBD->consultar($valor);
    }

    /**
     * Consultar registros de Unidademedida
     *
     * @access public
     * @param string $valor
     * @return Unidademedida
     */
    public function consultarUnidademedida($valor)
    {
        $oUnidademedidaBD = new UnidademedidaBD();
        return $oUnidademedidaBD->consultar($valor);
    }

// =============== Componentes ==================

    /**
     * Componente que exibe calendário
     *
     * @param string $nomeCampo
     * @param date $valorInicial
     * @param string $adicional
     * @param bool $hora
     * @return void
     */
    function componenteCalendario($nomeCampo, $valorInicial = NULL, $complemento = NULL, $hora = false)
    {
        include(dirname(dirname(__FILE__)) . "/componentes/componenteCalendario.php");
    }

    /**
     * Componente que exibe mensagem na tela
     *
     * @param string $msg
     * @param string $tipo
     * @access public
     * @return void
     */
    public function componenteMsg($msg, $tipo = "erro")
    {
        include(dirname(dirname(__FILE__)) . "/componentes/componenteMsg.php");
    }

    /**
     * Componente de lista de UFs
     *
     * @param string $nomeCampo
     * @param string $valor
     * @access public
     * @return void
     */
    public function componenteListaUf($nomeCampo, $valor = NULL)
    {
        include(dirname(dirname(__FILE__)) . "/componentes/componenteListaUf.php");
    }


    /*
	 *
	 * MÉTODOS NOVOS
	 *
	 */

    //insere registro vindo do excel
    public function inserirEmpresaExcel($oEmpresa)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->inserirEmpresaExcel($oEmpresa);
    }

    //retorna a modalidade e incentivo
    public function getIncentivoByModalidade($modalidade, $incentivo)
    {
        $oModalidadeBD = new ModalidadeBD();
        if ($oModalidadeBD->msg != '') {
            $this->msg = $oModalidadeBD->msg;
            return false;
        }
        return $oModalidadeBD->getIncentivoByModalidade($modalidade, $incentivo);
    }

    //retorna a situacao de acordo com a descrição
    public function retornaSituacao($situacao)
    {
        $oSituacaoBD = new SituacaoBD();
        if ($oSituacaoBD->msg != '') {
            $this->msg = $oSituacaoBD->msg;
            return false;
        }
        return $oSituacaoBD->retornaSituacao($situacao);
    }

    //retorna o municipio de acordo com descricao e uf
    public function getMunicipioUf($municipio, $uf)
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->getMunicipioUf($municipio, $uf);
    }

    //insere informações da planilha
    public function inserirFinanceiroExcel($oCadastrofinanceiro)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if ($oCadastrofinanceiroBD->msg != '') {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $oCadastrofinanceiroBD->inserirFinanceiroExcel($oCadastrofinanceiro);
    }

    //insere informações da planilha
    public function inserirIncentivoExcel($oIncentivoempresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->inserirIncentivoExcel($oIncentivoempresa);
    }

    //informações sobre login da empresa
    function infoAutenticacao($cnpj)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->infoAutenticacao($cnpj);
    }


    //recuperação de senha - retorna email da empresa
    function infoAutenticacaoByEmailCnpj($email, $cnpj)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->infoAutenticacaoByEmailCnpj($email, $cnpj);
    }


    //esqueceu a senha
    function alteraSenhaEmpresa($email, $senha, $cnpj)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->alteraSenhaEmpresa($email, $senha, $cnpj);
    }

    //retorna infos mais atuais da empresa
    public function getInfoAtualEmpresa($cnpj)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->getInfoAtualEmpresa($cnpj);
    }


    //troca senha do usuário empresa após estar logado
    function trocaSenhaEmpresa($cnpj, $senha, $novaSenha)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->trocaSenhaEmpresa($cnpj, $senha, $novaSenha);
    }


//insere dados oriundos do arquivo excel
    public function inserirLinha($vetor)
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if ($oIncentivosexcelBD->msg != '') {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return $oIncentivosexcelBD->inserirLinha($vetor);
    }


    //insere informações do arquivo excel
    public function inserirArquivo($nomeArquivo, $novoNome, $dataImportacao, $situacao, $status, $dataHoraAlteracao, $usuario)
    {
        $oArquivoBD = new ArquivoBD();
        if ($oArquivoBD->msg != '') {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return $oArquivoBD->inserirArquivo($nomeArquivo, $novoNome, $dataImportacao, $situacao, $status, $dataHoraAlteracao, $usuario);
    }


    //atualiza status do arquivo
    public function updateSituacao($idArquivo, $situacao)
    {
        $oArquivoBD = new ArquivoBD();
        if ($oArquivoBD->msg != '') {
            $this->msg = $oArquivoBD->msg;
            return false;
        }
        return $oArquivoBD->updateSituacao($idArquivo, $situacao);
    }


    //insere infos do arquivo
    public function inserirDetalhe($cdArquivo, $descricao, $linha)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if ($oDetalhearquivoBD->msg != '') {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return $oDetalhearquivoBD->inserirDetalhe($cdArquivo, $descricao, $linha);
    }


    //retorna detalhes pelo idArquivo
    public function listaDetalhesByArquivo($idArquivo)
    {
        $oDetalhearquivoBD = new DetalhearquivoBD();
        if ($oDetalhearquivoBD->msg != '') {
            $this->msg = $oDetalhearquivoBD->msg;
            return false;
        }
        return $oDetalhearquivoBD->listaDetalhesByArquivo($idArquivo);
    }


    //limpar base que foi preenchida com o arquivo excel
    public function truncateExcel()
    {
        $oIncentivosexcelBD = new IncentivosexcelBD();
        if ($oIncentivosexcelBD->msg != '') {
            $this->msg = $oIncentivosexcelBD->msg;
            return false;
        }
        return $oIncentivosexcelBD->truncateExcel();
    }


    //insere usuario empresa
    function insereUsuarioEmpresa($cnpj, $email)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->insereUsuarioEmpresa($cnpj, $email);
    }


    //retorna lista de empresas agrupadas por CNPJ
    public function retornaEmpresasGroupByCnpj()
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->retornaEmpresasGroupByCnpj();
    }


    //retorna lista de registros de acordo com o cnpj
    public function listarRegistrosEmpresaByCnpj($cnpj)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->listarRegistrosEmpresaByCnpj($cnpj);
    }


    //retorna lista de registros de acordo com a Razão Social
    public function listarRegistrosEmpresaByRazaoSocial($razaoSocial)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->listarRegistrosEmpresaByRazaoSocial($razaoSocial);
    }

    //retorna a retificação de acordo com o idEmpresa
    public function getRefiticacaoByIdEmpresa($idEmpresa)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->getRefiticacaoByIdEmpresa($idEmpresa);
    }


    public function listarIncentivosByCnpjVigencia($cnpj = null, $statusVigencia)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->listarIncentivosByCnpjVigencia($cnpj, $statusVigencia);
    }

    public function listarIncentivosByRazaoSocialVigencia($razaoSocial = null, $statusVigencia)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->listarIncentivosByRazaoSocialVigencia($razaoSocial, $statusVigencia);
    }


    public function getIncentivosByCnpjVigencia($cnpj, $statusVigencia)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->getIncentivosByCnpjVigencia($cnpj, $statusVigencia);
    }

    public function getIncentivosByCnpjVigenciaCadastro($cnpj, $statusVigencia)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->getIncentivosByCnpjVigenciaCadastro($cnpj, $statusVigencia);
    }

    //retorna lista de registros de acordo com CNPJ, vigentes, de acordo com o ano mais recente
    public function getEmpresasVigentesByCnpj($cnpj)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->getEmpresasVigentesByCnpj($cnpj);
    }

    //retorna lista de registros de acordo com Razao Social, vigentes, de acordo com o ano mais recente
    public function getEmpresasVigentesByRazaoSocial($razaoSocial)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->getEmpresasVigentesByRazaoSocial($razaoSocial);
    }

    //retorna todas as empresas cadastradas numa campanha
    public function getTodasEmpresasCampanha($idCampanha)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->getTodasEmpresasCampanha($idCampanha);
    }


    public function getContatoRecente($idEmpresa)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        if ($oContatoempresaBD->msg != '') {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $oContatoempresaBD->getContatoRecente($idEmpresa);
    }

    public function retornaEmpresasVigentesGroupByCnpj()
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->retornaEmpresasVigentesGroupByCnpj();
    }

    public function limparEmpresaCampanha($idCampanha)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->limparEmpresaCampanha($idCampanha);
    }

    public function checaEmpresaCampanha($idCampanha, $cnpj)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->checaEmpresaCampanha($idCampanha, $cnpj);
    }


    public function getRascunhoRecente($idCampanha)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->getRascunhoRecente($idCampanha);
    }

    public function getAlertasByCampanha($idCampanha)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->getAlertasByCampanha($idCampanha);
    }

    public function updateTotalEmpresasAlerta($idAlerta, $totalEmpresas)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->updateTotalEmpresasAlerta($idAlerta, $totalEmpresas);
    }

    public function updateSituacaoAlerta($idAlerta, $situacao)
    {
        $oAlertaBD = new AlertaBD();
        if ($oAlertaBD->msg != '') {
            $this->msg = $oAlertaBD->msg;
            return false;
        }
        return $oAlertaBD->updateSituacaoAlerta($idAlerta, $situacao);
    }


    public function getEmpresasCampanhaCadastrosPendentes($idCampanha)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->getEmpresasCampanhaCadastrosPendentes($idCampanha);
    }

    public function updateSituacaoCampanha($idCampanha, $situacao)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->updateSituacaoCampanha($idCampanha, $situacao);
    }

    public function updateTotalEmpresasCampanha($idCampanha, $totalEmpresas)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->updateTotalEmpresasCampanha($idCampanha, $totalEmpresas);
    }

    public function pesquisarCampanha($campanha, $anoBase, $situacao)
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->pesquisarCampanha($campanha, $anoBase, $situacao);
    }

    public function getEmpresasCampanhaByStatus($idCampanha, $status)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->getEmpresasCampanhaByStatus($idCampanha, $status);
    }


    public function pesquisaCampanhasEmpresa($empresa, $status)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->pesquisaCampanhasEmpresa($empresa, $status);
    }

    public function retornaRetificacoesByStatus($status)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->retornaRetificacoesByStatus($status);
    }

    public function getRetificaoSudamByIdRetEmpresa($idRetEmpresa)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->getRetificaoSudamByIdRetEmpresa($idRetEmpresa);
    }

    public function getArquivosRetificacao($idRetEmpresa)
    {
        $oArquivoretificacaoBD = new ArquivoretificacaoBD();
        if ($oArquivoretificacaoBD->msg != '') {
            $this->msg = $oArquivoretificacaoBD->msg;
            return false;
        }
        return $oArquivoretificacaoBD->getArquivosRetificacao($idRetEmpresa);
    }


    public function updateStatusRet($idRetEmpresa, $status)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->updateStatusRet($idRetEmpresa, $status);
    }

    public function retornaCampanhasAtivas()
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->retornaCampanhasAtivas();
    }


    public function retornaCampanhasAtivasExp15Dias()
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->retornaCampanhasAtivasExp15Dias();
    }


    public function verificaEmpresaCampanhaSituacao($idCampanha, $cnpj)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->verificaEmpresaCampanhaSituacao($idCampanha, $cnpj);
    }

    public function retornaCampanhasAtivasEmpresaLogada($cnpj)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->retornaCampanhasAtivasEmpresaLogada($cnpj);
    }


    public function retornaIncentivosByCnpjStatus($cnpj, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->retornaIncentivosByCnpjStatus($cnpj, $status);
    }


    public function getIncentivoByIdEmpresa($idEmpresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->getIncentivoByIdEmpresa($idEmpresa);
    }


    public function getMunicipioByUf($uf)
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->getMunicipioByUf($uf);
    }

    public function listaUf()
    {
        $oMunicipioBD = new MunicipioBD();
        if ($oMunicipioBD->msg != '') {
            $this->msg = $oMunicipioBD->msg;
            return false;
        }
        return $oMunicipioBD->listaUf();
    }

    public function updateModalidadeIncentivo($idIncentivoempresa, $idModalidade, $idIncentivo)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->updateModalidadeIncentivo($idIncentivoempresa, $idModalidade, $idIncentivo);
    }

    public function getControleByIdEmpresa($idEmpresa)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->getControleByIdEmpresa($idEmpresa);
    }

    public function updateDataAlteracao($idEmpresaConrole)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->updateDataAlteracao($idEmpresaConrole);
    }

    public function verificaTermoResponsabilidade($cnpj, $idCampanha)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->verificaTermoResponsabilidade($cnpj, $idCampanha);
    }


    public function getTodosContatosEmpresa($idEmpresa)
    {
        $oContatoempresaBD = new ContatoempresaBD();
        if ($oContatoempresaBD->msg != '') {
            $this->msg = $oContatoempresaBD->msg;
            return false;
        }
        return $oContatoempresaBD->getTodosContatosEmpresa($idEmpresa);
    }

    public function getAcionistasByEmpresa($idEmpresa)
    {
        $oAcionistaBD = new AcionistaBD();
        if ($oAcionistaBD->msg != '') {
            $this->msg = $oAcionistaBD->msg;
            return false;
        }
        return $oAcionistaBD->getAcionistasByEmpresa($idEmpresa);
    }

    public function listarIncentivosByIdEmpresa($idEmpresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->listarIncentivosByIdEmpresa($idEmpresa);
    }

    public function listarIncentivosByCnpjEmpresa($cnpj)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->listarIncentivosByCnpjEmpresa($cnpj);
    }

    public function updateUnidadeCap($idIncentivoEmpresa, $idUnidadeCap)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->updateUnidadeCap($idIncentivoEmpresa, $idUnidadeCap);
    }

    public function updateUnidadeProd($idIncentivoEmpresa, $idUnidadeProd)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->updateUnidadeProd($idIncentivoEmpresa, $idUnidadeProd);
    }


    public function getAtoDecByIdIncentivoEmpresa($idIncentivoEmpresa)
    {
        $oAtodeclaratorioBD = new AtodeclaratorioBD();
        if ($oAtodeclaratorioBD->msg != '') {
            $this->msg = $oAtodeclaratorioBD->msg;
            return false;
        }
        return $oAtodeclaratorioBD->getAtoDecByIdIncentivoEmpresa($idIncentivoEmpresa);
    }


    public function getListaMercadPorIncentivo($idIncentivoEmpresa)
    {
        $oMercadoconsumidorBD = new MercadoconsumidorBD();
        if ($oMercadoconsumidorBD->msg != '') {
            $this->msg = $oMercadoconsumidorBD->msg;
            return false;
        }
        return $oMercadoconsumidorBD->getListaMercadPorIncentivo($idIncentivoEmpresa);
    }

    public function getListaOrigemInsumosPorEmpresa($idEmpresa)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if ($oOrigeminsumosBD->msg != '') {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $oOrigeminsumosBD->getListaOrigemInsumosPorEmpresa($idEmpresa);
    }


    public function updateIdEmpresaTermo($idCampanha, $cnpj, $idEmpresa)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->updateIdEmpresaTermo($idCampanha, $cnpj, $idEmpresa);
    }

    public function updateHashComprovante($idEmpresa, $idCampanha)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->updateHashComprovante($idEmpresa, $idCampanha);
    }

    public function updateStatusEmpresaCampanha($idCampanha, $cnpj, $status)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->updateStatusEmpresaCampanha($idCampanha, $cnpj, $status);
    }

    public function getFinanceiroByEmpresa($idEmpresa)
    {
        $oCadastrofinanceiroBD = new CadastrofinanceiroBD();
        if ($oCadastrofinanceiroBD->msg != '') {
            $this->msg = $oCadastrofinanceiroBD->msg;
            return false;
        }
        return $oCadastrofinanceiroBD->getFinanceiroByEmpresa($idEmpresa);
    }

    public function getAllProjetosByEmpresa($idEmpresa)
    {
        $oProjsocioambientalBD = new ProjsocioambientalBD();
        if ($oProjsocioambientalBD->msg != '') {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $oProjsocioambientalBD->getAllProjetosByEmpresa($idEmpresa);
    }

    public function getAllPesquisasByEmpresa($idEmpresa)
    {
        $oProjsocioambientalBD = new PesquisadesenvolvimentoBD();
        if ($oProjsocioambientalBD->msg != '') {
            $this->msg = $oProjsocioambientalBD->msg;
            return false;
        }
        return $oProjsocioambientalBD->getAllPesquisasByEmpresa($idEmpresa);
    }

    public function updateProjetoEmpresa($idEmpresa, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->updateProjetoEmpresa($idEmpresa, $status);
    }

    public function updatePesquisaEmpresa($idEmpresa, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->updatePesquisaEmpresa($idEmpresa, $status);
    }

    public function updatePoliticaEmpresa($idEmpresa, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->updatePoliticaEmpresa($idEmpresa, $status);
    }


    public function getArquivosByProjeto($idProjeto)
    {
        $oArquivoprojetoBD = new ArquivoprojetoBD();
        if ($oArquivoprojetoBD->msg != '') {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return $oArquivoprojetoBD->getArquivosByProjeto($idProjeto);
    }

    public function getArquivosByPesquisa($idProjeto)
    {
        $oArquivoprojetoBD = new ArquivopesquisaBD();
        if ($oArquivoprojetoBD->msg != '') {
            $this->msg = $oArquivoprojetoBD->msg;
            return false;
        }
        return $oArquivoprojetoBD->getArquivosByPesquisa($idProjeto);
    }


    public function retornaArquivoProjetoByEmpresa($idEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->retornaArquivoProjetoByEmpresa($idEmpresa);
    }

    public function retornaArquivoPesquisaByEmpresa($idEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->retornaArquivoPesquisaByEmpresa($idEmpresa);
    }

    public function retornaArquivoPoliticaByEmpresa($idEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->retornaArquivoPoliticaByEmpresa($idEmpresa);
    }

    public function getAllPoliticaByEmpresa($idEmpresa)
    {
        $oPoliticaambientalBD = new PoliticaambientalBD();
        if ($oPoliticaambientalBD->msg != '') {
            $this->msg = $oPoliticaambientalBD->msg;
            return false;
        }
        return $oPoliticaambientalBD->getAllPoliticaByEmpresa($idEmpresa);
    }


    public function getArquivosByPolitica($idPolitica)
    {
        $oArquivopoliticaBD = new ArquivopoliticaBD();
        if ($oArquivopoliticaBD->msg != '') {
            $this->msg = $oArquivopoliticaBD->msg;
            return false;
        }
        return $oArquivopoliticaBD->getArquivosByPolitica($idPolitica);
    }


    public function getListaBasicaTipoArquivoEmpresa()
    {
        $oTipoarquivoBD = new TipoarquivoBD();
        if ($oTipoarquivoBD->msg != '') {
            $this->msg = $oTipoarquivoBD->msg;
            return false;
        }
        return $oTipoarquivoBD->getListaBasicaTipoArquivoEmpresa();
    }

    public function listaDocumentosEmpresa($idEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->listaDocumentosEmpresa($idEmpresa);
    }


    public function retornaHash($idEmpresa)
    {
        $oTermoresponsabilidadeBD = new TermoresponsabilidadeBD();
        if ($oTermoresponsabilidadeBD->msg != '') {
            $this->msg = $oTermoresponsabilidadeBD->msg;
            return false;
        }
        return $oTermoresponsabilidadeBD->retornaHash($idEmpresa);
    }


    public function updateControleConclusao($idEmpresaConrole)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->updateControleConclusao($idEmpresaConrole);
    }

    public function getOrigemByIdInsumoIdEmpresa($idInsumo, $idEmpresa)
    {
        $oOrigeminsumosBD = new OrigeminsumosBD();
        if ($oOrigeminsumosBD->msg != '') {
            $this->msg = $oOrigeminsumosBD->msg;
            return false;
        }
        return $oOrigeminsumosBD->getOrigemByIdInsumoIdEmpresa($idInsumo, $idEmpresa);
    }


    public function listaRetificacoesEmpresa($cnpj)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->listaRetificacoesEmpresa($cnpj);
    }

    public function listaRegistrosByCNPJStatus($cnpj, $status)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->listaRegistrosByCNPJStatus($cnpj, $status);
    }


    public function updateSituacaoCadastroEmpresa($idEmpresa, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->updateSituacaoCadastroEmpresa($idEmpresa, $status);
    }


    public function listaEmpresaByCNPJStatus($cnpj, $status)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->listaEmpresaByCNPJStatus($cnpj, $status);
    }


    public function verificaPendenciasRetificacao($cnpj)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->verificaPendenciasRetificacao($cnpj);
    }

    public function listaArquivoRetificacaoEmpresa($idEmpresa)
    {
        $oArquivoempresaBD = new ArquivoempresaBD();
        if ($oArquivoempresaBD->msg != '') {
            $this->msg = $oArquivoempresaBD->msg;
            return false;
        }
        return $oArquivoempresaBD->listaArquivoRetificacaoEmpresa($idEmpresa);
    }

    /*public function verificaCampanhaEmpresa($cnpj){
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if($oEmpresacontroleBD->msg != ''){
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->verificaCampanhaEmpresa($cnpj);
    }*/

    public function listaRetificacoesEmpresaByCnpjStatus($cnpj, $status)
    {
        $oRetificacaoempresaBD = new RetificacaoempresaBD();
        if ($oRetificacaoempresaBD->msg != '') {
            $this->msg = $oRetificacaoempresaBD->msg;
            return false;
        }
        return $oRetificacaoempresaBD->listaRetificacoesEmpresaByCnpjStatus($cnpj, $status);
    }

    public function retificacaoAprovadaComMenos15Dias($cnpj)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->retificacaoAprovadaComMenos15Dias($cnpj);
    }

    public function listaRetificacoesAprovadaComMais15Dias()
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->listaRetificacoesAprovadaComMais15Dias();
    }

    public function retornaHistoricoRetificacaoByRetEmpresa($idRetEmpresa)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->retornaHistoricoRetificacaoByRetEmpresa($idRetEmpresa);
    }

    public function updateStatusHistoricoByRetEmpresa($idRetEmpresa, $status)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->updateStatusHistoricoByRetEmpresa($idRetEmpresa, $status);
    }

    public function listaCampanhasAtivas()
    {
        $oCampanhaBD = new CampanhaBD();
        if ($oCampanhaBD->msg != '') {
            $this->msg = $oCampanhaBD->msg;
            return false;
        }
        return $oCampanhaBD->listaCampanhasAtivas();
    }


    public function verificaIdEmpresaRet($idEmpresaRet)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->verificaIdEmpresaRet($idEmpresaRet);
    }

    public function updateStatusHistorico($idHistRet, $status)
    {
        $oHistoricoretificacaoBD = new HistoricoretificacaoBD();
        if ($oHistoricoretificacaoBD->msg != '') {
            $this->msg = $oHistoricoretificacaoBD->msg;
            return false;
        }
        return $oHistoricoretificacaoBD->updateStatusHistorico($idHistRet, $status);
    }


    public function getListaBasicaInsumos()
    {
        $oInsumosBD = new InsumosBD();
        if ($oInsumosBD->msg != '') {
            $this->msg = $oInsumosBD->msg;
            return false;
        }
        return $oInsumosBD->getListaBasicaInsumos();
    }


    public function retornaRegistrosWeb()
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->retornaRegistrosWeb();
    }

    public function listarIncentivosIdEmpresa($idEmpresa)
    {
        $oIncentivoempresaBD = new IncentivoempresaBD();
        if ($oIncentivoempresaBD->msg != '') {
            $this->msg = $oIncentivoempresaBD->msg;
            return false;
        }
        return $oIncentivoempresaBD->listarIncentivosIdEmpresa($idEmpresa);
    }

    public function listaRetificacoesAprovadaRetificada($cnpj)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->listaRetificacoesAprovadaRetificada($cnpj);
    }

    public function listaRetificacoesAprovadasRetificadas($cnpj)
    {
        $oRetificacaosudamBD = new RetificacaosudamBD();
        if ($oRetificacaosudamBD->msg != '') {
            $this->msg = $oRetificacaosudamBD->msg;
            return false;
        }
        return $oRetificacaosudamBD->listaRetificacoesAprovadasRetificadas($cnpj);
    }


    public function retornaCampanhaEmpresaSituacao($cnpj, $situacao)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->retornaCampanhaEmpresaSituacao($cnpj, $situacao);
    }

    public function retornaCampanhasAtivasEmpresaLogadaConcluido($cnpj)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->retornaCampanhasAtivasEmpresaLogadaConcluido($cnpj);
    }

    public function verificaDataFinal60Dias($cnpj)
    {
        $oEmpresacampanhaBD = new EmpresacampanhaBD();
        if ($oEmpresacampanhaBD->msg != '') {
            $this->msg = $oEmpresacampanhaBD->msg;
            return false;
        }
        return $oEmpresacampanhaBD->verificaDataFinal60Dias($cnpj);
    }


    public function listaEmpresaByCNPJStatusWeb($cnpj, $status)
    {
        $oEmpresacontroleBD = new EmpresacontroleBD();
        if ($oEmpresacontroleBD->msg != '') {
            $this->msg = $oEmpresacontroleBD->msg;
            return false;
        }
        return $oEmpresacontroleBD->listaEmpresaByCNPJStatusWeb($cnpj, $status);
    }


    public function retornaCadastrosWebByCnpjStatus($cnpj, $status)
    {
        $oEmpresaBD = new EmpresaBD();
        if ($oEmpresaBD->msg != '') {
            $this->msg = $oEmpresaBD->msg;
            return false;
        }
        return $oEmpresaBD->retornaCadastrosWebByCnpjStatus($cnpj, $status);
    }

    public function updateEmail($cnpj, $email)
    {
        $oAutenticacaoempresaBD = new AutenticacaoempresaBD();
        if ($oAutenticacaoempresaBD->msg != '') {
            $this->msg = $oAutenticacaoempresaBD->msg;
            return false;
        }
        return $oAutenticacaoempresaBD->updateEmail($cnpj, $email);
    }

    public function verificaAlertaByEmpresaCampanha($cnpj, $idCampanha)
    {
        $oEmpresaalertaBD = new EmpresaalertaBD();
        if ($oEmpresaalertaBD->msg != '') {
            $this->msg = $oEmpresaalertaBD->msg;
            return false;
        }
        return $oEmpresaalertaBD->verificaAlertaByEmpresaCampanha($cnpj, $idCampanha);
    }

} //oControle


