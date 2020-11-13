<?php
require_once("classes/class.Controle.php");

$oControle = new Controle();
$dataHoraAlteracao = date("Y-m-d H:i:s");
// ================= Cadastrar Retificacaosudam =========================
$retorno = [];
if($_REQUEST['idRetEmpresa']) {

    //Util::trace($_REQUEST);
    $idRetEmpresa = $_REQUEST['idRetEmpresa'];
    $oRetificacaosudamBD = new RetificacaosudamBD(); // chamo o bd
    $POST = ['oRetificacaoempresa' => new Retificacaoempresa($idRetEmpresa), 'justificativa' => $_REQUEST['just'], 'status' => $_REQUEST['status']
        , 'dataAlteracao' => $dataHoraAlteracao, 'usuarioAlteracao' => $_SESSION['usuarioAtual']['login']]; //status 1 -
    $oRetificacaosudam = Util::populate(new Retificacaosudam(), $POST);
    if ($idRetSudam = $oRetificacaosudamBD->inserir($oRetificacaosudam)) {
        $infoRet = $oControle->getRetificacaoempresa($_REQUEST['idRetEmpresa']);
        $emailEmpresa = $oControle->infoAutenticacao($infoRet->oEmpresa->cnpj);
        $anoBase = $infoRet->anoBase;
        $email = $emailEmpresa->email;
        if ($_REQUEST['status'] == '1') {
            $solicitacao = "aprovada";
            $novoStatus = '3';
        } else {
            $solicitacao = "indeferida";
            $novoStatus = '4';
        }
                //duplicar os registros com a finalidade de manter histórico conforme solicitação do cliente
                $idEmpresa = $infoRet->oEmpresa->idEmpresa;
                $verificaControle = $oControle->getControleByIdEmpresa($idEmpresa);
                $oControle->updateStatusRet($idRetEmpresa, $novoStatus);


if($solicitacao == 'aprovada') {
    $oEmpresa = $oControle->getEmpresa($idEmpresa);
    $oFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
    $listaContatos = $oControle->getTodosContatosEmpresa($idEmpresa);
    $listaAcionistas = $oControle->getAcionistasByEmpresa($idEmpresa);
    $listaIncentivos = $oControle->listarIncentivosByIdEmpresa($idEmpresa);
    $listaInsumos = $oControle->getListaOrigemInsumosPorEmpresa($idEmpresa);
    $listaDocumentos = $oControle->listaDocumentosEmpresa($idEmpresa);
    $listaProjeto = $oControle->getAllProjetosByEmpresa($idEmpresa);
    $listaPolitica = $oControle->getAllPoliticaByEmpresa($idEmpresa);
    if ($oEmpresa) {
        $oEmpresa->idEmpresa = null;
        if($oEmpresa->projetoSocial == '1'){
            $oEmpresa->projetoSocial = 1;
        }
        if($oEmpresa->politicaAmbiental == '1'){
            $oEmpresa->politicaAmbiental = 1;
        }
        $POST_empresa = Util::populate(new Empresa(), $oEmpresa);
        $empresaBD = new EmpresaBD();
        $idEmpresaRet = $empresaBD->inserir($POST_empresa);

        $POST_empresaControle = ['oCampanha' => new Campanha($verificaControle->oCampanha->idCampanha), 'oEmpresa' => new Empresa($idEmpresaRet), 'cnpj' =>
            $verificaControle->oEmpresa->cnpj, 'status' => '1', 'dataInsercao' => date("Y-m-d H:i:s")];
        $oEmpresacontroleBD = new EmpresacontroleBD();
        $oEmpresacontrole = Util::populate(new Empresacontrole(), $POST_empresaControle);
        $oEmpresacontroleBD->inserir($oEmpresacontrole); //insere na tab. controle


        $oFinanceiro = $oControle->getFinanceiroByEmpresa($idEmpresa);
        $oFinanceiro->oEmpresa->idEmpresa = $idEmpresaRet;
        $oFinanceiro->idCadastroFinanceiro = null;
        $POST_financeiro = Util::populate(new Cadastrofinanceiro(), $oFinanceiro);
        $financeiroBD = new CadastrofinanceiroBD();
        $financeiroBD->inserir($POST_financeiro);
        if ($listaContatos) {
            foreach ($listaContatos as $contato) {
                $contato->oEmpresa->idEmpresa = $idEmpresaRet;
                $contato->idContatoEmpresa = null;

                $postContato = Util::populate(new Contatoempresa(), $contato);
                // Util::trace($postContato);
                $contatoBD = new ContatoempresaBD();
                $contatoBD->inserir($postContato);
            }
        }
        if ($listaAcionistas) {
            foreach ($listaAcionistas as $acionista) {
                $acionista->oEmpresa->idEmpresa = $idEmpresaRet;
                $acionista->idAcionista = null;
                $postAcionista = Util::populate(new Acionista(), $acionista);
                $acionistaBD = new AcionistaBD();
                $acionistaBD->inserir($postAcionista);
            }
        }

        if ($listaIncentivos) {
            foreach ($listaIncentivos as $incentivo) {
                $incentivo->oEmpresa->idEmpresa = $idEmpresaRet;
                $atoDeclaratorio = $oControle->getAtoDecByIdIncentivoEmpresa($incentivo->idIncentivoEmpresa);
                $mercadoConsumidor = $oControle->getListaMercadPorIncentivo($incentivo->idIncentivoEmpresa);
                $file = 'files/' . $atoDeclaratorio->novoNome;
                $ext = strtolower(substr($atoDeclaratorio->novoNome, -4)); //Pegando extensão do arquivo
                $new_name = md5(date("Y.m.d-H.i.s")) . $ext;
                $newfile = 'files/' . $new_name;
                copy($file, $newfile);

                $incentivo->idIncentivoEmpresa = null;
                $incentivoBD = new IncentivoempresaBD();
                $postIncentivo = Util::populate(new Incentivoempresa(), $incentivo);
                $idIncentivo = $incentivoBD->inserir($postIncentivo);


                $atoDeclaratorio->oIncentivoempresa->idIncentivoEmpresa = $idIncentivo;
                $atoDeclaratorio->novoNome = $new_name;
                $atoDeclaratorio->idAtoDeclaratorio = null;
                $postAto = Util::populate(new Atodeclaratorio(), $atoDeclaratorio);
                $atoDeclaratorioBD = new AtodeclaratorioBD();
                $atoDeclaratorioBD->inserir($postAto);

                $mercadoConsumidor->oIncentivoempresa->idIncentivoEmpresa = $idIncentivo;
                $mercadoConsumidor->idMercado = null;
                $postMercado = Util::populate(new Mercadoconsumidor(), $mercadoConsumidor);
                $mercadoConsumidorBD = new MercadoconsumidorBD();
                $mercadoConsumidorBD->inserir($postMercado);

            }
        }

        if ($listaInsumos) {
            foreach ($listaInsumos as $insumo) {
                $insumo->oEmpresa->idEmpresa = $idEmpresaRet;
                $insumo->idOrigemInsumos = null;
                $postOrigem = Util::populate(new Origeminsumos(), $insumo);
                $OrigeminsumosBD = new OrigeminsumosBD();
                $OrigeminsumosBD->inserir($postOrigem);
            }
        }
        if ($listaDocumentos) {
            foreach ($listaDocumentos as $documento) {
                $file_doc = 'files/' . $documento->novoNome;
                $ext_doc = strtolower(substr($documento->novoNome, -4)); //Pegando extensão do arquivo
                $new_name_doc = md5(date("Y.m.d-H.i.s")) . $ext_doc;
                $newfile_doc = 'files/' . $new_name_doc;
                copy($file_doc, $newfile_doc);
                $documento->oEmpresa->idEmpresa = $idEmpresaRet;
                $documento->novoNome = $new_name_doc;
                $documento->idArquivoEmpresa = null;
                $postArquivo = Util::populate(new Arquivoempresa(), $documento);
                $ArquivoempresaBD = new ArquivoempresaBD();
                $ArquivoempresaBD->inserir($postArquivo);
            }
        }

        if ($listaProjeto) {
            foreach ($listaProjeto as $projeto) {
                $arqProj = $oControle->getArquivosByProjeto($projeto->idProjeto);

                $projeto->oEmpresa->idEmpresa = $idEmpresaRet;
                $projeto->idProjeto = null;
                $projetoBD = new ProjsocioambientalBD();
                $postProjeto = Util::populate(new Projsocioambiental(), $projeto);
                $idProjeto = $projetoBD->inserir($postProjeto);

                if ($arqProj) {
                    $file_proj = 'files/' . $arqProj->novoNome;
                    $ext_proj = strtolower(substr($arqProj->novoNome, -4)); //Pegando extensão do arquivo
                    $new_name_proj = md5(date("Y.m.d-H.i.s")) . $ext_proj;
                    $newfile_proj = 'files/' . $new_name_proj;
                    copy($file_proj, $newfile_proj);
                    $arqProj->oProjsocioambiental->idProjeto = $idProjeto;
                    $arqProj->novoNome = $new_name_proj;
                    $arqProj->idArqivoProj = null;
                    $postArqProj = Util::populate(new Arquivoprojeto(), $arqProj);
                    $ArquivoprojetoBD = new ArquivoprojetoBD();
                    $ArquivoprojetoBD->inserir($postArqProj);


                }
            }
        }


        if ($listaPolitica) {
            foreach ($listaPolitica as $politica) {
                $arqPol = $oControle->getArquivosByPolitica($politica->idPolitica);

                $politica->oEmpresa->idEmpresa = $idEmpresaRet;
                $politica->idPolitica = null;
                $postPolitica = Util::populate(new Politicaambiental(), $politica);
                $politicaBD = new PoliticaambientalBD();
                $idPolitica = $politicaBD->inserir($postPolitica);

                if ($arqPol) {
                    $file_pol = 'files/' . $arqPol->novoNome;
                    $ext_pol = strtolower(substr($arqPol->novoNome, -4)); //Pegando extensão do arquivo
                    $new_name_pol = md5(date("Y.m.d-H.i.s")) . $ext_pol;
                    $newfile_pol = 'files/' . $new_name_pol;
                    copy($file_pol, $newfile_pol);
                    $arqPol->oPoliticaambiental->idPolitica = $idPolitica;
                    $arqPol->novoNome = $new_name_proj;
                    $arqPol->idArquivoPol = null;
                    $postArqPol = Util::populate(new Arquivopolitica(), $arqPol);
                    $ArquivopoliticaBD = new ArquivopoliticaBD();
                    $ArquivopoliticaBD->inserir($postArqPol);

                }
            }
        }

    }
    $HistoricoretificacaoBD = new HistoricoretificacaoBD();
    $historico_POST = ['oRetificacaoempresa' => new Retificacaoempresa($idRetEmpresa), 'oRetificacaosudam' => new Retificacaosudam($idRetSudam), 'oEmpresa' => new Empresa($infoRet->oEmpresa->idEmpresa), 'idEmpresaRet' => $idEmpresaRet, 'anoBase' => $infoRet->anoBase, 'cnpj' => $infoRet->cnpj, 'status' => '1', 'dataHoraAlteracao' => date("Y-m-d H:i:s"), 'usuarioAlteracao' => $_SESSION['usuarioAtual']['login']];
    $oHistoricoretificacao = Util::populate(new Historicoretificacao(), $historico_POST);
    $HistoricoretificacaoBD->inserir($oHistoricoretificacao);

    $link = "http://siav.sudam.gov.br/";
    $mensagem .= "<img src=\"cid:SUDAM\"/>";
    $mensagem .= "<br \><br \><br \>Você recebeu uma mensagem de e-mail da SUDAM.";
    $mensagem .= "<br><br>A retificação solicitada para o Ano Base <strong>" . $anoBase . "</strong>, foi <strong>"
        . $solicitacao . "
        </strong>! <br>Acesse o site da SUDAM para mais detalhes.";
    $mensagem .= " <br \><a href='$link'> <strong>Clique aqui para acessar o site.</strong></a>";
    $mensagem .= "<br \><br \><br \>Esta é uma mensagem automática, não responda!";
    $assunto = "Sua solicitacação foi " . $solicitacao . ".";
    // echo  $email;
    try {

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
        $mail->addAddress($email);
        $mail->Subject = $assunto;
        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');
        $mail->Body = $mensagem;
        //$mail->msgHTML($mensagem);
        $mail->IsHTML(true); // send as HTML
        $mail->Send();
        $retorno['msg'] = '0';
    } catch (phpmailerException $e) {
        $retorno['e'] = $e;
    }
    echo json_encode($retorno);
    exit;
}else{

                    $link = "http://siav.sudam.gov.br/";
                    $mensagem .= "<img src=\"cid:SUDAM\"/>";
                    $mensagem .= "<br \><br \><br \>Você recebeu uma mensagem de e-mail da SUDAM.";
                    $mensagem .= "<br><br>A retificação solicitada para o Ano Base <strong>" . $anoBase . "</strong>, foi <strong>"
                        . $solicitacao . "
        </strong>! <br>Acesse o site da SUDAM para mais detalhes.";
                    $mensagem .= " <br \><a href='$link'> <strong>Clique aqui para acessar o site.</strong></a>";
                    $mensagem .= "<br \><br \><br \>Esta é uma mensagem automática, não responda!";
                    $assunto = "Sua solicitacação foi " . $solicitacao . ".";
                   // echo  $email;
                    try {

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
                        $mail->addAddress($email);
                        $mail->Subject = $assunto;
                        $mail->AddEmbeddedImage('img/SUDAM_mini.png', 'SIAV - SUDAM');
                        $mail->Body = $mensagem;
                        //$mail->msgHTML($mensagem);
                        $mail->IsHTML(true); // send as HTML
                        $mail->Send();
                        $retorno['msg'] = '0';
                    } catch (phpmailerException $e) {
                        $retorno['e'] = $e;
                    }
                    echo json_encode($retorno);
                    exit;
                }
        }

}

$aRetificacaoempresa = $oControle->getAllRetificacaoempresa();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/modals.php");?>
	<div class="container">
		<?php 
		require_once("includes/titulo.php"); 
		require_once("includes/menu.php"); 
		?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li><a href="admRetificacaosudam.php">Retificacaosudam</a></li>
			<li class="active">Cadastrar Retificacaosudam</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idRetEmpresa">Retificacaoempresa</label>
	<select name="idRetEmpresa" id="idRetEmpresa" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aRetificacaoempresa as $oRetificacaoempresa){
	?>
		<option value="<?=$oRetificacaoempresa->idRetEmpresa?>"><?=$oRetificacaoempresa->usuarioSolicitacao?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
    <label for="justificativa">Justificativa</label>
    <textarea name="justificativa" class="form-control" id="justificativa" cols="80" rows="10"></textarea>
</div>
<div class="form-group">
	<label for="status">Status</label>
	<input type="text" class="form-control" id="status" name="status" value="" />
</div>

                            <label for="dataAlteracao">DataAlteracao</label>
                            <?php $oControle->componenteCalendario('dataAlteracao', NULL, NULL, true)?>
<div class="form-group">
	<label for="usuarioAlteracao">UsuarioAlteracao</label>
	<input type="text" class="form-control" id="usuarioAlteracao" name="usuarioAlteracao" value="" />
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admRetificacaosudam.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Retificacaosudam" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>