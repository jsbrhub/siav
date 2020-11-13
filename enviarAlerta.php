<?php
/**
 * Created by PhpStorm.
 * User: raquel.ohashi
 * Date: 03/10/2017
 * Time: 13:27
 */
require_once("classes/class.Controle.php");
$oControle = new Controle();

set_time_limit(0);

if (isset($_REQUEST['alerta']['tipoSelecao'])) {


    $tipoSelecao = $_REQUEST['alerta']['tipoSelecao'];
    $idAlerta = $_REQUEST['alerta']['idAlerta'];
    $oAlertaBD = new AlertaBD();
//Util::trace($_REQUEST);
    if (empty($idAlerta)) {

        $oAlerta = Util::populate(new Alerta(), $_REQUEST['alerta']);
        $oAlerta->situacao = 1;
        $oAlerta->dataHoraAlteracao = date("Y-m-d h:i:s");
        $oAlerta->texto = $_REQUEST["alerta"]["texto"];
        $oAlerta->oCampanha = new Campanha($_REQUEST['alerta']['idCampanha']);
        $idAlerta = $oAlertaBD->inserir($oAlerta);
    } else {
        $oAlerta = Util::populate(new Alerta(), $_REQUEST['alerta']);
        $oAlerta->situacao = '2';
        $oAlerta->dataHoraAlteracao = date("Y-m-d h:i:s");
        $oAlerta->texto = $_REQUEST["alerta"]["texto"];
        $oAlerta->oCampanha = new Campanha($_POST['alerta']['idCampanha']);
        if (!$oAlertaBD->alterar($oAlerta)) {
            echo $oAlertaBD->msg;
            exit();
        }
    }

    $infoAlerta = $oControle->getAlerta($idAlerta);


    if ($infoAlerta) {
        $assunto = $infoAlerta->assunto;
        $texto = $infoAlerta->texto;
        $idCampanha = $infoAlerta->oCampanha->idCampanha;
        $infoCampanha = $oControle->getCampanha($idCampanha);
        $texto = $infoCampanha->campanha . " - Ano Base: " . $infoCampanha->anoBase . " <br><br>" . $texto;

    }
    if ($tipoSelecao == '1') { //enviar alerta para todas as empresas
        $listaEmpresas = $oControle->getTodasEmpresasCampanha($idCampanha);

        if ($listaEmpresas) {
            $contadorEmpresas = count($listaEmpresas);
            $oControle->updateTotalEmpresasAlerta($idAlerta, $contadorEmpresas);
            $oControle->updateSituacaoAlerta($idAlerta, '2'); //update situação do alerta
            $oControle->updateSituacaoCampanha($idCampanha, '2'); //tornando a campanha ATIVA
            $oEmpresaalertaBD = new EmpresaalertaBD();
            $oAutenticaEmpresaBD = new AutenticacaoempresaBD();
            foreach ($listaEmpresas as $k => $empresa) {
                $cnpj = $empresa->cnpj;

                $infoAutenticaEmpresa = $oAutenticaEmpresaBD->getRow(["cnpj = '{$cnpj}'"]);

                $email = $infoAutenticaEmpresa->email;

                $senha = $infoAutenticaEmpresa->senhaProv;

//                $verificaAlertaEnviado = $oControle->verificaAlertaByEmpresaCampanha($cnpj, $idCampanha);
                // Util::trace($verificaAlertaEnviado);
//                if ($verificaAlertaEnviado != '') {
//                    $mens_senha = "";
//                } else {
//                    $mens_senha = "<br \><br \>" . "Para acessar o sistema utilize o seu CNPJ e a seguinte senha de acesso gerada automaticamente: "
//                        . "<strong>" . $senha . "</strong>";
//                }
                if ($email) {

                    $link = empty($senha) ? "http://siav.sudam.gov.br/" : "http://siav.sudam.gov.br/empresa?token=".md5("{$infoAutenticaEmpresa->cnpj}-{$infoAutenticaEmpresa->idAutenticacao}"); ;

                    $mensagem = "<img src=\"cid:SUDAM\"/>";
                    $mensagem .= "<br \><br \><br \>Você recebeu uma mensagem de e-mail da SUDAM, referente ao CNPJ: <b>".Util::formataCNPJ($cnpj)."</b> .";
                    $mensagem .= "<br><br>Uma nova campanha para atualização cadastral será iniciada a partir do dia <strong>"
                        . Util::formataDataBancoForm($infoCampanha->dataInicio) . "</strong> até o dia <strong>"
                        . Util::formataDataBancoForm($infoCampanha->dataFim) . ".</strong>";
                    $mensagem .= "<br \><br \><p>" . $texto . "</p>";
                    $mensagem .= " <br \><a href='$link'> <strong>Acesse o site.</strong></a> por este link para realizar login.";
                    $mensagem .= "<br \><br \><br \>Esta é uma mensagem automática, não responda!";
                    // Util::trace($mensagem);
                    try {
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
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
                        $mail->addAddress($email);
                        $mail->Subject = $assunto;
                        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');
                        $mail->Body = $mensagem;
                        //$mail->msgHTML($mensagem);
                        $mail->IsHTML(true); // send as HTML

                        $mail->Send();

                        if($k%5 == 0)
                            sleep(3);
                        //retorno devolvido para  o ajax caso sucesso
                        $echo = 0;
                    } catch (phpmailerException $e) {
                        $echo = 1;
                    }

                    $POST_EmpresaAlerta = ['oAlerta' => new Alerta($idAlerta), 'oCampanha' => new Campanha($idCampanha), 'cnpj' => $cnpj];

                    $oEmpresaalerta = Util::populate(new Empresaalerta(), $POST_EmpresaAlerta);

                    $idEmpresaAlerta = $oEmpresaalertaBD->inserir($oEmpresaalerta);

                } else {
                    $echo = 1;
                }

            }

        }


    }
    if ($tipoSelecao == '2') { //enviar somente para empresas que não iniciaram o cadastro
        $listaEmpresas = $oControle->getEmpresasCampanhaCadastrosPendentes($idCampanha);
        //$listaEmpresas = $oControle->getTodasEmpresasCampanha($idCampanha);
        if ($listaEmpresas) {
            $contadorEmpresas = count($listaEmpresas);
            $oControle->updateTotalEmpresasAlerta($idAlerta, $contadorEmpresas);
            $oControle->updateSituacaoAlerta($idAlerta, '2'); //update situação do alerta
            $oControle->updateSituacaoCampanha($idCampanha, '2'); //ativa a campanha
            $oEmpresaalertaBD = new EmpresaalertaBD();
            $oAutenticaEmpresaBD = new AutenticacaoempresaBD();
            foreach ($listaEmpresas as $k => $empresa) {
                $cnpj = $empresa->cnpj;

                $infoAutenticaEmpresa = $oAutenticaEmpresaBD->getRow(["cnpj = '{$cnpj}'"]);

                $email = $infoAutenticaEmpresa->email;

                $senha = $infoAutenticaEmpresa->senhaProv;

                $link = empty($senha) ? "http://siav.sudam.gov.br/" : "http://siav.sudam.gov.br/empresa?token=".md5("$infoAutenticaEmpresa->cnpj-$infoAutenticaEmpresa->idAutenticacao"); ;

                //Util::trace($verificaAlertaEnviado);
//                if ($verificaAlertaEnviado != '') {
//                    $mens_senha = "";
//                } else {
//                    $mens_senha = "<br \><br \>" . "Para acessar o sistema utilize o seu CNPJ e a seguinte senha de acesso gerada automaticamente: "
//                        . "<strong>" . $senha . "</strong>";
//
//                }
                //Util::trace($senha);
//                $novasenha = Util::geraSenha(8);
//                $oControle->alteraSenhaEmpresa($email,$novasenha,$cnpj);
                if ($email) {
                    $mensagem = "<img src=\"cid:SUDAM\"/>";
                    $mensagem .= "<br \><br \><br \>Você recebeu uma mensagem de e-mail da SUDAM, referente ao CNPJ: <b>".Util::formataCNPJ($cnpj)."</b>.";
                    $mensagem .= "<br><br>Uma nova campanha para atualização cadastral será iniciada a partir do dia <strong>"
                        . Util::formataDataBancoForm($infoCampanha->dataInicio) . "</strong> até o dia <strong>"
                        . Util::formataDataBancoForm($infoCampanha->dataFim) . ".</strong>";
                    $mensagem .= "<br \><br \>" . $texto;
                    $mensagem .= " <br \><a href='$link'> <strong>Acesse o site.</strong></a> por este link para realizar login.";
                    $mensagem .= "<br \><br \><br \>Esta é uma mensagem automática, não responda!";
                    //Util::trace($mensagem);

                    try {
                        $mail = new PHPMailer;
                        $mail->isSMTP();
                        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
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
                        $mail->addAddress($email);
                        $mail->Subject = $assunto;
                        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');
                        $mail->Body = $mensagem;
                        //$mail->msgHTML($mensagem);
                        $mail->IsHTML(true); // send as HTML
                        $mail->Send();

                        if($k%5 == 0)
                            sleep(3);

                        $echo = 0; //retorno devolvido para o ajax caso sucesso
                    } catch (phpmailerException $e) {
                        $echo = 1;
                    }

                    $POST_EmpresaAlerta = ['oAlerta' => new Alerta($idAlerta), 'oCampanha' => new Campanha($idCampanha), 'cnpj' => $cnpj];
                    //Util::trace($POST_EmpresaAlerta);

                    $oEmpresaalerta = Util::populate(new Empresaalerta(), $POST_EmpresaAlerta);

                    $idEmpresaAlerta = $oEmpresaalertaBD->inserir($oEmpresaalerta);

                } else {
                    $echo = 1;
                }
            }
        } else {
            $echo = 1;
        }
    }
    echo $echo;
}


