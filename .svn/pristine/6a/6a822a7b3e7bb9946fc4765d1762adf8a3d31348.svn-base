<?php
/**
 * Created by PhpStorm.
 * User: marcelo.reis
 * Date: 09/10/2019
 * Time: 15:40
 */

require_once "classes/class.Controle.php";


$oControle = new Controle();

$listaEmpresas = $oControle->getTodasEmpresasCampanha(14);

$oAutenticaEmpresaBD = new AutenticacaoempresaBD();

foreach ($listaEmpresas as $k => $empresa) {
    $cnpj = $empresa->cnpj;

//    echo "{$cnpj} <br />";

//    $infoEmpresa = $oControle->getEmpresa($empresa->oEmpresa-

    $infoAutenticaEmpresa = $oAutenticaEmpresaBD->getRow(["cnpj = '{$cnpj}'"]);

    echo "{$k} - {$cnpj} - {$infoAutenticaEmpresa->email} <br />";

    $email = $infoAutenticaEmpresa->email;

//    Util::trace($infoAutenticaEmpresa, false);

//    echo "{$cnpj} - {$email}<br />"; //01637895018422 - 01637895000132

    $senha = $infoAutenticaEmpresa->senhaProv;

    $link = empty($senha) ? "http://siav.sudam.gov.br/" : "http://siav.sudam.gov.br/empresa?token=".md5("$infoAutenticaEmpresa->cnpj-$infoAutenticaEmpresa->idAutenticacao"); ;

    if ($email && !in_array($cnpj, ["84512037000199", "76487032005437", "06996299000162"])) {



        $mensagem = "<img src=\"cid:SUDAM\"/>";
        $mensagem .= "<br \><br \><br \>Você recebeu uma mensagem de e-mail da SUDAM.";
        $mensagem .= "<br><br>Uma nova campanha para atualização cadastral será iniciada a partir do dia <strong>"
            . Util::formataDataBancoForm($infoCampanha->dataInicio) . "</strong> até o dia <strong>"
            . Util::formataDataBancoForm($infoCampanha->dataFim) . ".</strong>";
        $mensagem .= "<br \><br \><p>" . $texto . "</p>";
        $mensagem .= " <br \><a href='$link'> <strong>Acesse o site.</strong></a> por este link para realizar login.";
        $mensagem .= "<br \><br \><br \>Esta é uma mensagem automática, não responda!";
        // Util::trace($mensagem);
//        try {
//            $mail = new PHPMailer;
//            $mail->isSMTP();
//            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
//            $mail->CharSet = 'UTF-8';
//            $mail->SMTPDebug = 0;
//            $mail->Debugoutput = 'html';
//            $mail->Host = 'smtp.sudam.gov.br';
//            $mail->Port = 25;
//            $mail->SMTPSecure = 'tls';
//            $mail->SMTPAuth = true;
//            $mail->Username = "siav@sudam.gov.br";
//            $mail->Password = "siav*2017";
//            $mail->setFrom('siav@sudam.gov.br', 'SIAV - SUDAM');
//            $mail->addReplyTo('siav@sudam.gov.br', 'SIAV - SUDAM');
//            $mail->addAddress($email);
//            $mail->Subject = $assunto;
//            $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');
//            $mail->Body = $mensagem;
//            //$mail->msgHTML($mensagem);
//            $mail->IsHTML(true); // send as HTML
//
//            $mail->Send();
//            if($k%2 == 0)
//                sleep(3);
//            //retorno devolvido para  o ajax caso sucesso
//            $echo = 0;
//        } catch (phpmailerException $e) {
//            $echo = 1;
//        }

//        $POST_EmpresaAlerta = ['oAlerta' => new Alerta($idAlerta), 'oCampanha' => new Campanha($idCampanha), 'cnpj' => $cnpj];
//
//        $oEmpresaalerta = Util::populate(new Empresaalerta(), $POST_EmpresaAlerta);
//
//        $idEmpresaAlerta = $oEmpresaalertaBD->inserir($oEmpresaalerta);





    }
}