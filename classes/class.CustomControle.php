<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 27/09/2018
 * Time: 14:30
 */

require_once (dirname(__FILE__).'/class.Template.php');

require_once (dirname(__FILE__).'/../phpMailer/PHPMailerAutoload.php');

class CustomControle
{

    protected $oConn;

    function __construct()
    {
        $this->oConn = new Conexao();
    }

    function getTemplate(){
        $tpl = new Template("");
    }

    function atualizaCnpjResponsaveis($cnpjAntigo, $cnpjNovo){
        $sql = "
                update 
                    responsaveis_empresa 
                set
                    cnpj = :cnpj
                where
                    cnpj = {$cnpjAntigo}";
        try{
            $this->oConn->executePrepare($sql, [":cnpj" => $cnpjNovo]);
            if($this->oConn->msg != ""){
                $this->msg = $this->oConn->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function limpaCnpjPadraoAcionistas($idEmpresa){


        $sql = "
                update 
                    acionista 
                set
                    cnpj_padrao = :cnpj_padrao
                where
                    idEmpresa = {$idEmpresa}";
        try{
            $this->oConn->executePrepare($sql, [":cnpj_padrao" => "0"]);
            if($this->oConn->msg != ""){
                $this->msg = $this->oConn->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function enviaEmailRecuperarSenha($cnpj, $novaSenha){
        $tpl = new Template(dirname(__FILE__)."/../templates/emails/recuperar-senha.tpl");

        $oAutenticacaoempresa = $this->getRowAutenticacaoempresa(["cnpj = '{$cnpj}'"]);

        if($oAutenticacaoempresa instanceof Autenticacaoempresa){

            if(empty($oAutenticacaoempresa->email))
                return false;

            $tpl->cnpj = Util::formataCNPJ($cnpj);

            $tpl->senha = $novaSenha;

            $corpo = $tpl->parse();

            if($this->smtpMail($oAutenticacaoempresa->email, "Senha de acesso ao SIAV - SUDAM.", $corpo)){
                return true;
            } else{
                return false;
            }

        } else {
            return false;
        }
    }

    function enviaEmailRecuperarSenhaResponsavel($cpf, $novaSenha){
        $tpl = new Template(dirname(__FILE__)."/../templates/emails/recuperar-senha-responsavel.tpl");

        $oResponsavel = $this->getRowResponsaveis(["cpf_passaporte = '{$cpf}'", "situacao = 1"]);

        if($oResponsavel instanceof Responsaveis){

            if(empty($oResponsavel->email))
                return false;

            $tpl->cpf_passaporte = Util::formataCPF($cpf);

            $tpl->senha = $novaSenha;

            $corpo = $tpl->parse();

            if($this->smtpMail($oResponsavel->email, "Senha de acesso ao SIAV - SUDAM.", $corpo)){
                return true;
            } else{
                return false;
            }

        } else {
            return false;
        }
    }



    function enviaEmailAlerta(Alerta $oAlerta, $cnpj){
        $tpl = new Template(dirname(__FILE__)."/../templates/emails/alerta.tpl");

        $oAutenticacaoempresa = $this->getRowAutenticacaoempresa(["cnpj = '{$cnpj}'"]);

        if($oAutenticacaoempresa instanceof Autenticacaoempresa){

            if(empty($oAutenticacaoempresa->email)){
                $this->msg = "Cnpj não contém Email (". Util::formataCNPJ($cnpj).")";

                return false;
            }

            $tpl->cnpj = Util::formataCNPJ($cnpj);

            $tpl->data_inicio = Util::formataDataBancoForm($oAlerta->oCampanha->dataInicio);

            $tpl->data_fim = Util::formataDataBancoForm($oAlerta->oCampanha->dataFim);

            $tpl->campanha = $oAlerta->oCampanha->campanha;

            $tpl->ano_base = $oAlerta->oCampanha->anoBase;

            $tpl->texto = $oAlerta->texto;

            if(!empty($oAutenticacaoempresa->senhaProv)){

                $tpl->token = md5("{$oAutenticacaoempresa->cnpj}-{$oAutenticacaoempresa->idAutenticacao}");

                $tpl->block("BLOCK_LINK_SENHA");
            } else
                $tpl->block("BLOCK_LINK_LOGIN");

            $corpo = $tpl->parse();

            if($this->smtpMail($oAutenticacaoempresa->email, $oAlerta->assunto, $corpo)){
                $oEmpresaalerta = Util::populate(new Empresaalerta(), [
                    "oAlerta" => new Alerta($oAlerta->idAlerta),
                    "oCampanha" => $oAlerta->oCampanha,
                    "cnpj" => $cnpj
                ]);

                //seta o corpo fora do populate para nao remover caracteres html
                $oEmpresaalerta->corpo = $corpo;

                $oEmpresaalertaBD = new EmpresaalertaBD();

                $oEmpresaalertaBD->inserir($oEmpresaalerta);

                return true;
            } else{
                $this->msg = "Erro ao enviar alerta para o email '{$oAutenticacaoempresa->email}'";

                return false;
            }

        } else {
            return false;
        }
    }

    function customGetAllEmpresaalerta($aFiltro = NULL, $aOrdenacao = NULL){
        $sql = "
				select
					".EmpresaalertaMAP::dataToSelect().",
					empresaalerta.dt_registro as empresaalerta_dt_registro,
					".AutenticacaoempresaMAP::dataToSelect()."  
				from
					empresaalerta 
				left join alerta 
					on (empresaalerta.idAlerta = alerta.idAlerta)
				left join campanha 
					on (empresaalerta.idCampanha = campanha.idCampanha)
				left join autenticacaoempresa 
					on (empresaalerta.cnpj = autenticacaoempresa.cnpj)	";

        if(count($aFiltro)>0){
            $sql .= " where ";
            $sql .= implode(" and ", $aFiltro);
        }

        if(count($aOrdenacao)>0){
            $sql .= " order by ";
            $sql .= implode(",", $aOrdenacao);
        }
        try{
            $this->oConn->execute($sql);
            $aObj = array();
            if($this->oConn->numRows() != 0){
                while ($aReg = $this->oConn->fetchReg()){
                    $aObjNormal = EmpresaalertaMAP::rsToObj($aReg);

                    $aObjNormal->oAutenticacaoempresa = AutenticacaoempresaMAP::rsToObj($aReg);

                    unset($aObjNormal->oAutenticacaoempresa->senha);

                    unset($aObjNormal->oAutenticacaoempresa->senhaProv);

                    $aObj[] = $aObjNormal;
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    /**
     * Carregar Colecao de dados de Empresa
     *
     * @access public
     * @param int $idCampanha id da campanha
     * @return Empresa[]
     */
    function getEmpresasCampanhaCSV($idCampanha){
        $sql = "SELECT
                    ".EmpresaMAP::dataToSelect()." 
                FROM 
                    empresacampanha  
                LEFT JOIN 
                    empresacontrole  ON empresacontrole.idCampanha = empresacampanha.idCampanha AND empresacontrole.cnpj = empresacampanha.cnpj
                LEFT JOIN 
                    empresa ON empresa.idEmpresa = empresacontrole.idEmpresa 
                LEFT JOIN 
                    municipio ON municipio.idMunicipio = empresa.idMunicipio
                LEFT JOIN 
                    situacao ON situacao.idSituacao = empresa.idSituacao
                LEFT JOIN 
                    incentivos ON incentivos.idIncentivo = empresa.idIncentivo
                LEFT JOIN 
                    modalidade ON modalidade.idModalidade = empresa.idModalidade     
                WHERE ";


        if($idCampanha != "todas")
            $sql .= "empresacampanha.idCampanha = {$idCampanha} AND ";

            $sql .= "ifnull(empresa.vigente,1) = 1 AND 
                     empresa.razaoSocial IS NOT NULL AND
                     empresa.cnpj IS NOT NULL
                GROUP BY
                    empresacampanha.cnpj";
        try{
            $this->oConn->execute($sql);
            $aObj = array();
            if($this->oConn->numRows() != 0){
                while ($aReg = $this->oConn->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function getEmpresasCSV(){
        $sql = "SELECT 
                    empresa.razaoSocial empresa_razaoSocial, 
                    empresa.cnpj empresa_cnpj, 
                    empresa.telefone empresa_telefone,
                    empresa.fax empresa_fax,
                    empresa.fonteOrigem empresa_fonteOrigem,
                    municipio.municipio municipio_municipio,
                    municipio.uf municipio_uf,
                    autenticacaoempresa.email empresa_email
                FROM empresa 
                LEFT JOIN municipio ON municipio.idMunicipio = empresa.idMunicipio 
                LEFT JOIN autenticacaoempresa ON autenticacaoempresa.cnpj = empresa.cnpj
                WHERE 
                    IFNULL(empresa.vigente, 1) = 1 
                GROUP BY empresa.cnpj 
                ORDER BY empresa.razaoSocial ASC";

        try{
            $this->oConn->execute($sql);
            $aObj = array();
            if($this->oConn->numRows() != 0){
                while ($aReg = $this->oConn->fetchReg()){
                    $aObj[] = EmpresaMAP::rsToObj($aReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

    function customGetAllAlerta($aFiltro = NULL, $aOrdenacao = NULL){
            $sql = "select
					".AlertaMAP::dataToSelect().",
					(SELECT count(1) FROM empresaalerta AS ea WHERE ea.idAlerta = alerta.idAlerta ) as alerta_totalEmpresas
				from
					alerta 
				left join campanha 
					on (alerta.idCampanha = campanha.idCampanha)";

            if(count($aFiltro)>0){
                $sql .= " where ";
                $sql .= implode(" and ", $aFiltro);
            }

            if(count($aOrdenacao)>0){
                $sql .= " order by ";
                $sql .= implode(",", $aOrdenacao);
            }
            try{
                $this->oConn->execute($sql);
                $aObj = array();
                if($this->oConn->numRows() != 0){
                    while ($aReg = $this->oConn->fetchReg()){
                        $aObj[] = AlertaMAP::rsToObj($aReg);
                    }
                    return $aObj;
                } else {
                    return false;
                }
            }
            catch(PDOException $e){
                $this->msg = $e->getMessage();
                return false;
            }

    }

    function smtpMail($to, $subject, $message){
        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

        $mail->CharSet = 'UTF-8';

        $mail->SMTPDebug = 0;

        $mail->Host = 'smtp.sudam.gov.br';

        $mail->Port = 25;

        $mail->SMTPSecure = 'tls';

        $mail->SMTPAuth = true;

        $mail->Username = "siav@sudam.gov.br";

        $mail->Password = "siav*2017";

        $mail->setFrom('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addReplyTo('siav@sudam.gov.br', 'SIAV - SUDAM');

        $mail->addAddress($to);

        $mail->Subject = $subject;

        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');

        $mail->Body = $message;

        //$mail->msgHTML($mensagem);
        $mail->IsHTML(true); // send as HTML

        return $mail->Send();
    }
}